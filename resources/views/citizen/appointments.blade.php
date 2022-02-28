<x-app-layout>
    <div class="mt-6">
        <h1 class="ml-5 text-left text-4xl text-white text-center" style="text-shadow: 2px 2px 8px #000000;">
            My Appointments
        </h1>

        <!-- List appointments -->
        <div class="ml-5 mt-6">
            <div class="flex flex-wrap">
                @foreach ($appointments as $appointment)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <div class="flex flex-wrap">
                            <div class="">
                                <h3 class="text-left text-lg text-gray-800">
                                    Appointment at: {{ $appointment->pivot->date }}
                                </h3>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="">
                                <h3 class="text-left text-lg text-gray-800">
                                    {{ $appointment->address }}
                                </h3>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="">
                                <a href="/appointments/{{ $appointment->pivot->id }}/cancel" class="text-red-500">
                                    Cancel
                                </a>
                            </div>
                    </div>
                    <hr />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>