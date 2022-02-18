<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Hospital;
use App\Models\User;

class MohController extends Controller
{
    //# Get all hospitals to manage
    public function manageHospitals(Request $request)
    {
        $hospitals = Hospital::all();
        return view('moh.manage-hospitals', compact('hospitals'));
    }

    //# Update hospitals
    public function updateHospitals(Request $request)
    {
        // return 78;
        // return $request;
        $success = true;
        foreach (array_combine($request->id, $request->is_isolation) as $id => $is_isolation) {
            if (!Hospital::find($id)->update(['is_isolation' => $is_isolation])) {
                $success = false;
            }
        }
        if ($success)
            return redirect('/staff/moh/manage-hospitals')->with('message', 'Hospitals updated successfully');
        else
            return redirect('/staff/moh/manage-hospitals')->with('message', 'Hospitals could not be updated');
    }

    //# Get all hospitals to manage each hospital's doctors
    public function manageDoctors(Request $request)
    {
        $hospitals = Hospital::all();
        return view('moh.manage-doctors', compact('hospitals'));
    }

    //# Get all doctors working in a hospital
    public function getDoctors(Request $request, $id)
    {
        $doctors = Hospital::find($id)->clerks()->get();
        $doctors = json_encode($doctors);
        // print_r($doctors);
        echo $doctors;
    }

    //# Remove doctor from a hospital
    public function removeDoctor(Request $request, $id)
    {
        $doctor = User::find($id)->update([
            'hospital_id' => null,
        ]);
        echo $doctor;
    }

    //# Add new doctor to a hospital
    public function addDoctor(Request $request)
    {
        if (!$request->hospital_id)
            return redirect('/staff/moh/manage-doctors')->with('message', 'Please select a hospital');
        $hospital = Hospital::find($request->hospital_id);
        if ($hospital)
            $added = User::where('national_id', $request->national_id)->update([
                'hospital_id' => $hospital->id,
            ]);
        else
            $added = false;
        // return $added;
        if ($added)
            return redirect('/staff/moh/manage-doctors')->with('message', 'Doctor added successfully');
        else
            return redirect('/staff/moh/manage-doctors')->with('message', 'Doctor could not be added');
    }

    //# Get all campaigns
    public function manageCampaigns(Request $request)
    {
        $campaigns = Campaign::where('start_date', '>', now())->get();
        return view('moh.manage-campaigns')->with('campaigns', $campaigns); //compact('campaigns'));
    }

    //# Add new campaign
    public function addCampaign(Request $request)
    {
        // return $request->all();
        if ($request->end_date < $request->start_date)
            return redirect('/staff/moh/manage-campaigns')->with('message', 'End date cannot be before start date');
        if (!$request->type)
            return redirect('/staff/moh/manage-campaigns')->with('message', 'Please select a campaign type');
        if (!$request->location)
            return redirect('/staff/moh/manage-campaigns')->with('message', 'Please select a location');


        //# Check if doctors with given IDs exist
        foreach ($request->doctors as $doctor) {
            $user = User::where('national_id', $doctor)->first();
            if (!$user)
                return redirect('/staff/moh/manage-campaigns')->with('message', 'Doctor with ID ' . $doctor . ' does not exist');
        }

        //# Create new campaign
        $campaign = Campaign::create([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'location' => preg_replace(array('/\(/', '/\)/'), array('', ''), $request->location),
            'address' => $request->address,
        ]);

        //# Assign doctors to campaign
        foreach ($request->doctors as $doctor) {
            $doctor_id = User::where('national_id', $doctor)->first()->id;
            $campaign->doctors()->attach($doctor_id, ['start_date' => $request->start_date, 'end_date' => $request->end_date]);
        }

        if ($campaign)
            return redirect('/staff/moh/manage-campaigns')->with('message', 'Campaign added successfully');
        else
            return redirect('/staff/moh/manage-campaigns')->with('message', 'Campaign could not be added');
    }
}
