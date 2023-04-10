<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background-image: url('/images/bg_color.png')">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg" style="background-image: url('/images/form_color.png')">
        {{ $slot }}
    </div>
</div>
