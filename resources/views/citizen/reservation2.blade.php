<x-base-layout>
    <div class="mt-6">
        <h1 class="ml-5 text-left text-4xl text-white" style="text-shadow: 2px 2px 8px #000000;">
            Vaccination Reserve
        </h1>
        
        <div class="mx-auto text-center mt-2">
            <p class="inline-block text-center text-xl bg-white font-bold rounded-full text-blue-500 w-8 h-8 pt-1">1</p>
            <div class="inline-block mx-3 bg-black w-10 h-1 mb-1 bg-opacity-50"></div>
            <p class="inline-block text-center text-xl bg-blue-500 font-bold rounded-full text-white w-8 h-8 pt-1">2</p>
        </div>

        @if ($errors->any())
            <div>
                <div class="font-medium text-red-600">
                    {{ __('Whoops! Something went wrong.') }}
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="text-white text-center mt-2">Select a location</p>

        <div id="campaign_selection" class="text-center text-xl mt-2 hidden">
            <h3>You have selected: <span class="text-white">Campaign Name</span></h3>
        </div>

        <div class="mx-auto text-center mt-5">
            <div id="map" class="mt-8 rounded-md border-solid border-4 border-black" style="width: 80%; height: 600px; max-height: 90vh; margin: 0 auto;"></div>
            <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api') }}&callback=initMap" defer></script>
            <script>
                function selectCampaign(campaign) {
                    document.getElementById('campaign_selection').classList.remove('hidden');
                    document.getElementById('campaign_selection').children[0].children[0].innerHTML = campaign[0];
                    
                    document.getElementById('procceed_button').removeAttribute('disabled');
                    document.getElementById('procceed_form').action = '/reserve/final/' + campaign[3];
                }

                function initMap() {
                    var locations = [
                        @foreach($campaigns as $campaign)
                            ["{{ preg_replace('/\s+/', ' ', trim($campaign->address)); }}", {{ $campaign->location }}, {{$campaign->id}}],
                        @endforeach
                    ];

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 6,
                        center: new google.maps.LatLng(26.8206, 30.8025)
                    });
                    
                    var infowindow = new google.maps.InfoWindow();
                    var marker, i;
                    
                    for (i = 0; i < locations.length; i++) {  
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                            map: map
                        });
                        
                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                infowindow.setContent(locations[i][0]);
                                infowindow.open(map, marker);
                                selectCampaign(locations[i]);
                            }
                        })(marker, i));
                    }
                }
            </script>
        </div>

        <div class="mt-6">
            <div class="mt-3 mx-auto text-right mr-5">
                <form action="/reserve/final/-1" method="POST" id="procceed_form">
                    <div>
                        <span> Select Date: </span>
                        <input type="date" id="datepicker" class="text-center text-xl" name="date">
                    </div>
                    @csrf
                    <x-button type="submit" disabled id="procceed_button">
                        Procceed
                    </x-button>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>