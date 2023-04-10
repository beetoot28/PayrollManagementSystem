<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: none;" x-show="active_tab == 1" x-transition:enter.duration.500ms>
    <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">
            <p class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">Set Authorization Code</p>
            <!-- ERROR MESSAGE -->
            <template x-if="auth_error">
                <div class="bg-red-100 overflow-hidden shadow-sm sm:rounded-md px-3 py-1 text-center mb-2">
                    <span class="text-red-400 text-md font-bold" x-text="settings_msg"></span>
                </div>
            </template>

            <!-- SUCCESS MESSAGE -->
            <template x-if="auth_success">
                <div class="bg-green-100 overflow-hidden shadow-sm sm:rounded-md px-3 py-1 text-center mb-2">
                    <span class="text-green-400 text-md font-bold" x-text="settings_msg"></span>
                </div>
            </template>

            <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5 mb-3 ">
                <div class="mb-1 lg:mb-0 w-full">
                    <label for="s_auth_code" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Passcode <span class="text-red-400 text-md">*</span></label>
                    <input id="s_auth_code" type="password" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-ref="s_auth_code" autocomplete="off">
                </div>
                <div class="mb-1 lg:mb-0 w-full">
                    <label for="s_confirm_auth_code" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Passcode <span class="text-red-400 text-md">*</span></label>
                    <input id="s_confirm_auth_code" type="password" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-ref="s_confirm_auth_code" autocomplete="off">
                </div>
                <button type="button" class="px-3 ml-2 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-0 lg:mt-5" x-on:click="save_authorization_code" x-ref="submit_authcode">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
