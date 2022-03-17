<x-base-layout>
    <script>
        function Scrolldown() {
            window.scroll(0, 300);
        }
        window.onload = Scrolldown;
    </script>


    <img src="/contact.jpg" class="contact-header">
    <div class="divide2"></div>
    <div class="wrap2"></div>
    <h1 class="ml-5 text-left text-4xl text-white" style="text-shadow: 2px 2px 8px #000000;">
        Contact Us
    </h1>


    <div class="h-screen" id="contact-info">
        <div class="text-2xl text-black font-bold ml-10" id="contact-title">Get In Touch</div>

        <div class="grid grid-cols-2">
            <div>
                <div class="text-xl text-black ml-20">Our Emails:</div>
                <div class="text-md text-blue-800 ml-24 underline">AIGPS@gmail.com</div>
                <div class="text-md text-blue-800 ml-24 underline">AIGPS@hotmail.com</div>
            </div>
            <div>
                <div class="text-xl text-black ml-20">Our Hotline:</div>
                <div class="text-md text-blue-800 ml-24 underline">15911</div>
            </div>

            <div class="mt-10">
                <div class="text-xl text-black ml-20">Our Working hours:</div>
                <div class="text-md text-blue-800 ml-24">Everyday except Friday</div>
                <div class="text-md text-blue-800 ml-24">8:00AM - 8:00PM</div>
            </div>
        </div>
    </div>

</x-base-layout>
