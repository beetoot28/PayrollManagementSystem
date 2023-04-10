<div class="inline-flex items-center justify-center z-20 top-0 w-full absolute h-full -mt-2" style="display: none;" x-show="update_record" x-transition.duration.400ms>
    <div class="w-2/5 bg-white rounded-lg shadow-md opacity-100 p-3">

        <div class="flex justify-between">
            <span class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3" x-text="modal_title"></span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 font-semibold hover:text-red-300 cursor-pointer" x-on:click="update_record = false, s_id = '', s_amount = '', s_note = '', modal_title = ''">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
        <!-- ERROR MESSAGE -->
        <template x-if="empdr_error">
            <div class="bg-red-100 overflow-hidden shadow-sm sm:rounded-md px-3 py-1 text-center mb-2">
                <span class="text-red-400 text-md font-bold" x-text="settings_msg"></span>
            </div>
        </template>

        <!-- SUCCESS MESSAGE -->
        <template x-if="empdr_success">
            <div class="bg-green-100 overflow-hidden shadow-sm sm:rounded-md px-3 py-1 text-center mb-2">
                <span class="text-green-400 text-md font-bold" x-text="settings_msg"></span>
            </div>
        </template>

        <!-- INPUTS -->
        <div class="flex flex-col space-y-3">
            <div class="flex flex-row space-x-3">
                <div class="mb-1 lg:mb-0 w-full relative">
                    <label for="e_date_dr" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Date <span class="text-red-400 text-md invisible">*</span></label>
                    <input id="e_date_dr" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-model="s_date" disabled autocomplete="off">
                </div>
                <div class="mb-1 lg:mb-0 w-full relative">
                    <label for="e_amount_dr" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Amount <span class="text-red-400 text-md">*</span></label>
                    <input id="e_amount_dr" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-model="s_amount" autocomplete="off">
                </div>
            </div>
            <div class="flex flex-row space-x-3">
                <div class="mb-1 lg:mb-0 w-full">
                    <label for="e_note_dr" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Note </label>
                    <textarea id="e_note_dr" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-model="s_note" autocomplete="off"></textarea>
                </div>
            </div>

            <button type="button" class="px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                x-on:click="{{ $active_tab == 2 ? 'save_update_employees_dr' : ($active_tab == 3 ? 'save_update_employees_ocdr' : ($active_tab == 4 ? 'save_update_employees_duefrom' : '')) }}" x-ref="submit_update_employees_dr">
                Save
            </button>
        </div>
    </div>
</div>

