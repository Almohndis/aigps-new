<x-app-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-9">
        <div class="notification">
            @if (session('message'))
                {{ session('message') }}
            @endif
        </div>
        <div class="pt-8 sm:pt-0">
            <h1>All hospitals</h1>
            <h2>Select a hospital to manage its doctors</h2><br>
            <select name="hospital" id="list">
                <option value="" selected hidden disabled>Please select a hospital</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
            <form action="/staff/moh/manage-hospitals/update" method="POST">
                @csrf
                <table>
                    <th>
                    <td>#</td>
                    <td>Name</td>
                    <td>National ID</td>
                    <td></td>
                    </th>
                </table>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
    <script>
        window.onload = () => {

            //#list is the id of the select element
            const list = document.getElementById('list');

            //# Get doctors of the selected hospital
            function getDoctors() {
                let headerId = document.createElement('td');
                headerId.innerHTML = '#';
                let headerName = document.createElement('td');
                headerName.innerHTML = 'Name';
                let headerNid = document.createElement('td');
                headerNid.innerHTML = 'National ID';
                let headerAction = document.createElement('td');
                headerAction.innerHTML = 'Action';
                let headerTr = document.createElement('tr');
                headerTr.appendChild(headerId);
                headerTr.appendChild(headerName);
                headerTr.appendChild(headerNid);
                headerTr.appendChild(headerAction);
                let id = list.value;
                let xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    let data = xhttp.response;
                    console.log(data);
                    let table = document.querySelector('table');
                    for (let i = 0; i < data.length; i++) {
                        let id = document.createElement('td');
                        id.innerHTML = i + 1;
                        let name = document.createElement('td');
                        name.innerHTML = data[i].name;
                        let national_id = document.createElement('td');
                        national_id.innerHTML = data[i].national_id;
                        let button = document.createElement('td');
                        let btn = document.createElement('input');
                        btn.setAttribute('type', 'button');
                        btn.value = 'Remove';
                        btn.addEventListener('click', () => {
                            deleteDoctor(data[i].id);
                        });
                        button.appendChild(btn);
                        let tr = document.createElement('tr');
                        tr.appendChild(id);
                        tr.appendChild(name);
                        tr.appendChild(national_id);
                        tr.appendChild(button);
                        table.appendChild(tr);
                    }
                }
                xhttp.open("GET", "/staff/moh/manage-doctors/" + id);
                xhttp.responseType = 'json';
                xhttp.send();
            }

            //#delete doctor
            function deleteDoctor(id) {
                if (confirm('Are you sure you want to remove this doctor from hospital?')) {
                    let xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        getDoctors();
                        if (xhttp.response) {
                            document.getElementsByClassName('notification')[0].innerHTML =
                                'Doctor removed successfully';
                        } else {
                            document.getElementsByClassName('notification')[0].innerHTML =
                                'Something went wrong, please try again';
                        }
                    }
                    xhttp.open("GET", "/staff/moh/manage-doctors/remove-doctor/" + id);
                    xhttp.send();
                }
            }

            list.addEventListener('change', getDoctors);

        }
    </script>
</x-app-layout>
