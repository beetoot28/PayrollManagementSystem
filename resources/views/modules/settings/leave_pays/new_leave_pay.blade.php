<div class="inline-flex items-center justify-center z-20 top-0 absolute w-full h-full" style="display: none;" x-show="new_leave_pay" x-transition.duration.400ms>
    <div class="w-2/5 bg-white rounded-lg shadow-md opacity-100 p-3">

        <div class="flex justify-between">
            <p class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">New Leave Pay</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 font-semibold hover:text-red-300 cursor-pointer"
                x-on:click="new_leave_pay = false, employee_id = '', $refs.s_employee_name_leavepay.value = '', $refs.s_employee_no_leavepay.value = '', $refs.s_department_leavepay.value = '', $refs.s_numberofdays_leavepay.value = '', s_note_leavepay = '', $refs.s_start_date.value = '', $refs.s_end_date.value = ''">
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
                    <label for="s_employee_name_leavepay" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Employee Name <span class="text-red-400 text-md">*</span></label>
                    <input id="s_employee_name_leavepay"  type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" autocomplete="off"
                        x-ref="s_employee_name_leavepay"
                        x-on:click="click_emp = true"
                        x-on:keyup="click_emp = false, search_emp = true, search_emp ? show_suggestion($refs.s_employee_name_leavepay.value) : search_emp = false">

                    {{-- Show employess --}}
                    <div class="absolute mt-1 w-full z-50 max-h-72 overflow-y-auto bg-white rounded-md shadow-sm border border-gray-300" x-show="click_emp" @click.outside="click_emp = false">
                        <template x-for="employee in employees">
                            <li x-text="employee.last_name +' '+ employee.first_name +' '+ (employee.middle_name ? employee.middle_name[0].toUpperCase() +'.' : '')"
                                x-on:click="employee_id = employee.employee_id, $refs.s_department_leavepay.value = employee.employee_details.department, $refs.s_employee_no_leavepay.value = employee.employee_code, $refs.s_employee_name_leavepay.value = employee.last_name +' '+ employee.first_name +' '+ (employee.middle_name ? employee.middle_name[0].toUpperCase() +'.' : ''), click_emp = false" class="cursor-default transition duration-500 ease-in-out text-xs block px-4 py-2 hover:bg-gray-300 hover:bg-opacity-50 hover:text-gray-900 items-center"></li>
                        </template>
                    </div>
                    {{-- Show searched employees --}}
                    <div class="absolute mt-1  w-full z-20 max-h-72 overflow-y-auto bg-white rounded-md shadow-sm border border-gray-300" x-show="search_emp" @click.outside="search_emp = false">
                        <template x-for="employee in filtered_employees">
                            <li x-text="employee.last_name +' '+ employee.first_name +' '+ (employee.middle_name ? employee.middle_name[0].toUpperCase() +'.' : '')"
                                x-on:click="search_emp = false, employee_id = employee.employee_id, $refs.s_department_leavepay.value = employee.employee_details.department, $refs.s_employee_no_leavepay.value = employee.employee_code, $refs.s_employee_name_leavepay.value = employee.last_name +' '+ employee.first_name +' '+ (employee.middle_name ? employee.middle_name[0].toUpperCase() +'.' : '')" class="cursor-default transition duration-500 ease-in-out text-xs block px-4 py-2 hover:bg-gray-300 hover:bg-opacity-50 hover:text-gray-900 items-center"></li>
                        </template>
                    </div>
                </div>
                <div class="mb-1 lg:mb-0 w-full">
                    <label for="s_employee_no_leavepay" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Employee Number <span class="text-red-400 text-md">*</span></label>
                    <input id="s_employee_no_leavepay" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-ref="s_employee_no_leavepay" disabled>
                </div>
            </div>

            <div class="flex flex-row space-x-3">
                <div class="mb-1 lg:mb-0 w-full">
                    <label for="s_department_leavepay" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Department <span class="text-red-400 text-md">*</span></label>
                    <input id="s_department_leavepay" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-ref="s_department_leavepay" disabled >
                </div>
                <div class="mb-1 lg:mb-0 w-full">
                    <label for="s_numberofdays_leavepay" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Number of Days <span class="text-red-400 text-md">*</span></label>
                    <input id="s_numberofdays_leavepay" type="number" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-ref="s_numberofdays_leavepay" autocomplete="off">
                </div>
            </div>
            <div class="flex flex-row space-x-3">
                <div class="mb-1 lg:mb-0 w-full relative">
                    <label for="s_start_date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Start Date <span class="text-red-400 text-md">*</span></label>
                    <input id="s_start_date" datepicker datepicker-autohide type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-ref="s_start_date" autocomplete="off">
                </div>
                <div class="mb-1 lg:mb-0 w-full relative">
                    <label for="s_end_date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">End Date <span class="text-red-400 text-md">*</span></label>
                    <input id="s_end_date" datepicker datepicker-autohide type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-ref="s_end_date" autocomplete="off">
                </div>
            </div>
            <div class="mb-1 lg:mb-0 w-full">
                <label for="s_note_leavepay" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Note <span class="text-red-400 text-md">*</span></label>
                <textarea id="s_note_leavepay" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-model="s_note_leavepay" autocomplete="off"></textarea>
            </div>

            <button type="button" class="px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                x-on:click="save_employees_leavepay" x-ref="submit_employees_leavepay">
                Save
            </button>
        </div>
    </div>
</div>

