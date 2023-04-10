<div class="inline-flex items-center justify-center z-20 top-0 w-full absolute h-full -mt-2" style="display: none;" x-show="update_remarks" x-transition.duration.400ms>
    <div class="w-2/5 bg-white rounded-lg shadow-md opacity-100 p-3">

        <div class="flex justify-between">
            {{-- <span class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">Update Remarks</span> --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-blue-700 w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-7 h-7 cursor-pointer rounded-md p-1 hover:bg-gray-300 hover:text-gray-800 text-gray-600 font-semibold "
                x-on:click="update_remarks = false, temp_remarks = ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <!-- INPUTS -->
        <div class="flex flex-col space-y-3 mt-5">
            <div class="flex flex-row space-x-3">
                <div class="mb-1 lg:mb-0 w-full relative">
                    <label for="p_remarks" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Remarks </label>
                    <textarea id="p_remarks" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-model="temp_remarks" autocomplete="off"></textarea>
                </div>
            </div>

            <button type="button" class="px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                x-on:click="f_update_remarks, changes_detected = true" x-ref="update_button">
                Save
            </button>
        </div>
    </div>
</div>


