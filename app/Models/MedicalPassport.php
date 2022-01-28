<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalPassport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vaccine_name',
        'vaccine_date',
    ];

    //# Inverse relation to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
