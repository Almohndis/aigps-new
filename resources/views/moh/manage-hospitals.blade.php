<x-app-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-9">
        <div class="notification">
            @if (session('message'))
                {{ session('message') }}
            @endif
        </div>
        <div class="pt-8 sm:pt-0">

            <div>
                <h1>Add new hospital</h1>
                <form action="/staff/moh/manage-hospitals/add" method="POST">
                    @csrf
                    <label for="hospital">Hospital name</label>
                    <input required type="text" name="name"><br>
                    <label for="city">City</label>
                    <select required name="city" id="city">
                        <option value="" hidden selected disabled>Select city</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select><br>
                    <label for="capacity">Capacity</label>
                    <input required type="number" name="capacity"><br>
                    <input type="checkbox" name="is_isolation"> Isolation<br>

                    <input type="submit" value="Add hospital">

                </form>
            </div>

            <h1>All hospitals</h1>
            <h2>Determine which hospital to be an isolation</h2><br>
            <form action="/staff/moh/manage-hospitals/update" method="POST">
                @csrf
                <table>
                    <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Total capacity</th>
                    <th>Intensive care beds</th>
                    <th>Available intensive care beds</th>
                    <th>Available regular beds</th>
                    <th>Isolation</th>
                    </tr>
                    @foreach ($hospitals as $hospital)
                        <tr>
                            <input type="hidden" class="id" value="{{ $hospital->id }}" name="id[]">
                            <td>{{ $hospital->id }}</td>
                            <td>{{ $hospital->name }}</td>
                            <td>{{ $hospital->city }}</td>
                            <td>{{ $hospital->capacity }}</td>
                            {{-- <td>{{ $hospital->care_beds }}</td>
                            <td>{{ $hospital->avail_care_beds }}</td>
                            <td>{{ $hospital->available_beds }}</td> --}}
                            <td><input type="number" min="0" max="1" name="is_isolation[]"
                                    value="{{ $hospital->is_isolation }}"> </td>
                        </tr>
                    @endforeach
                </table>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
    <script src="{{ asset('js/manage-hospitals.js') }}"></script>
</x-app-layout>
