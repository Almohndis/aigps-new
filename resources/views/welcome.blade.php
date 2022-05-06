<x-app-layout>
    <link href="{{asset('css/welcome.css')}}" rel="stylesheet">
    {{-- <style>
        #bgvid{
            width: 100%;
        }
    </style>
    <video playsinline autoplay muted loop id="bgvid">
        <source src="Vaccine Dusk.webm" type="video/webm">
        <source src="Vaccine Dusk.mp4" type="video/mp4">
      </video> --}}
    <div class="aigps-welcome-content text-center">
        <h1 class="text-black aigps-title">AIGPS</h1>

        <p class="text-dark mt-1">
            The new AI system that is used as a tool <br> to support the fight against any viral pandemic.
        </p>

        <div class="flex my-md">
            <a href="/reserve" class="shadow btn btn-success btn-md">
                Reserve Vaccine
            </a>

            <a href="/gallery" class="shadow btn btn-dark btn-md ms-2">
                Visit Gallery
            </a>
        </div>
    </div>
</x-app-layout>
