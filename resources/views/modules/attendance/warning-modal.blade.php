<!-- Button trigger modal -->
<div style="display: none;" x-show="show_warning">
    <div class="inline-flex items-center justify-center w-full h-full z-20 top-0 absolute bg-gray-50 bg-opacity-50">
        <div class="w-2/5 bg-white rounded-lg shadow-md opacity-100 p-3">
            <div class="flex justify-end">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 font-semibold hover:text-red-300 cursor-pointer" x-on:click="show_warning = false">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="flex items-center mx-auto justify-center bg-yellow-100 rounded-full w-32 h-32">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32 text-yellow-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>
            <p class="mt-5 text-center text-2xl text-gray-700">Are you sure you want to leave this page?</p>
            <div class="flex flex-col items-center justify-center mt-7">
                <button type="button" class="mx-auto rounded-full px-6 py-3 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-0 active:bg-blue-800 transition duration-150 ease-in-out" x-on:click="show_warning = false">No, stay on this page</button>
                <a href="{{ route('create-attendances') }}" class="hover:text-yellow-400 pt-3 text-gray-700 font-bold">Yes, I want to leave this page</a>
            </div>
        </div>
    </div>
</div>
