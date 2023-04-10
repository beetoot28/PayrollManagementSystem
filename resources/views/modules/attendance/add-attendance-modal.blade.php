<!-- Button trigger modal -->
<div style="display: none;" x-show="show_addrecord">
    <div class="inline-flex items-center justify-center w-full h-full z-20 top-0 absolute px-20">
        <div class="w-full bg-white rounded-lg shadow-md opacity-100 p-3">
            <div class="flex justify-between pb-2 border-b-2 border-gray-200">
                <span class="text-lg text-gray-700 uppercase">Add Attendance Record</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 font-semibold hover:text-red-300 cursor-pointer" x-on:click="close_add_record">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="">
                <div class="bg-red-100 overflow-hidden shadow-sm sm:rounded-md mt-2 px-1 py-1 text-center mb-2" style="display: none;" x-show="add_error">
                    <span class="text-red-400 text-md font-bold">Required fields must not be empty</span>
                </div>
                <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                    <div class="mb-1 w-full relative">
                        <label for="employee_name" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Employee Name <span class="text-red-400 text-lg">*</span></label>
                        <input type="text" id="employee_name" name="employee_name" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off" x-ref="employee_name" x-on:click="click_emp = true"
                        {{-- x-on:click="click_emp = true" x-on:keydown.Backspace="$refs.department.value = '', $refs.employee_no.value = '', $refs.department1.value = '', $refs.employee_no1.value = ''" --}}
                        value=""
                        x-on:keydown="click_emp = false, search_emp = true, search_emp ? show_suggestion() : search_emp = false">
                        {{-- Show employess --}}
                        <div class="absolute mt-1 w-full z-20 max-h-72 overflow-y-auto bg-white rounded-md shadow-sm border border-gray-300" x-show="click_emp" @click.outside="click_emp = false">
                            <template x-for="employee in employees">
                                <li x-text="employee.last_name +' '+ employee.first_name +' '+ (employee.middle_name==null ? '' : (employee.middle_name[0].toUpperCase() +'.'))"
                                    x-on:click="$refs.department.value = employee.employee_details.department, $refs.employee_no.value = employee.employee_code, $refs.employee_name.value = employee.last_name +' '+ employee.first_name +' '+ (employee.middle_name==null ? '' : (employee.middle_name[0].toUpperCase() +'.')), click_emp = false" class="cursor-default transition duration-500 ease-in-out text-xs block px-4 py-2 hover:bg-gray-300 hover:bg-opacity-50 hover:text-gray-900 items-center"></li>
                            </template>
                        </div>
                        {{-- Show searched employees --}}
                        <div class="absolute mt-1  w-full z-20 max-h-72 overflow-y-scroll bg-white rounded-md shadow-sm border border-gray-300" x-show="search_emp" @click.outside="search_emp = false">
                            <template x-for="employee in filtered_employees">
                                <li x-text="employee.last_name +' '+ employee.first_name +' '+ (employee.middle_name==null ? '' : (employee.middle_name[0].toUpperCase() +'.'))"
                                    x-on:click="$refs.department.value = employee.employee_details.department, $refs.employee_no.value = employee.employee_code, $refs.employee_name.value = employee.last_name +' '+ employee.first_name +' '+ (employee.middle_name==null ? '' : (employee.middle_name[0].toUpperCase() +'.')), search_emp = false" class="cursor-default transition duration-500 ease-in-out text-xs block px-4 py-2 hover:bg-gray-300 hover:bg-opacity-50 hover:text-gray-900 items-center"></li>
                            </template>
                        </div>
                    </div>
                    <div class="mb-1 w-full">
                        <label for="employee_no" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Employee ID <span class="text-red-400 text-lg">*</span></label>
                        <input type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled x-ref="employee_no" value="" autocomplete="off">
                    </div>
                    <div class="mb-1 w-full">
                        <label for="department" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Department <span class="text-red-400 text-lg">*</span></label>
                        <input type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled x-ref="department" value="" autocomplete="off">
                    </div>
                    <div class="mb-1 w-full">
                        <label for="department" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Account No. <span class="text-red-400 text-lg">*</span></label>
                        <input type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-ref="account_no" value="" autocomplete="off">
                    </div>
                    <div class="mb-1 w-full">
                        <label for="department" class="block text-sm font-medium text-gray-900 dark:text-gray-300">No <span class="text-white text-lg">*</span></label>
                        <input type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-ref="no" value="" autocomplete="off">
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                    <div class="mb-1 w-full">
                        <label for="date_in" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Date In <span class="text-red-400 text-lg">*</span></label>
                        <input datepicker datepicker-autohide id="date_in" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  x-ref="date_in" value="" autocomplete="off">
                    </div>
                    <div class="mb-1 w-full">
                        <label for="time_in_am" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Time In(AM) <span class="text-red-400 text-lg">*</span></label>
                        <input id="time_in_am" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  x-ref="time_in_am" value="" autocomplete="off">
                    </div>
                    <div class="mb-1 w-full">
                        <label for="time_out_am" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Time Out(AM) <span class="text-red-400 text-lg">*</span></label>
                        <input id="time_out_am" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  x-ref="time_out_am" value="" autocomplete="off">
                    </div>
                    <div class="mb-1 w-full">
                        <label for="time_in_pm" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Time In(PM) <span class="text-red-400 text-lg">*</span></label>
                        <input id="time_in_pm" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  x-ref="time_in_pm" value="" autocomplete="off">
                    </div>
                    <div class="mb-1 w-full">
                        <label for="time_out_pm" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Tme Out(PM) <span class="text-red-400 text-lg">*</span></label>
                        <input id="time_out_pm" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-ref="time_out_pm" value="" autocomplete="off">
                    </div>
                </div>
                <button type="button" class="mx-auto rounded-md px-4 py-1 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-0 active:bg-blue-800 transition duration-150 ease-in-out"
                    x-on:click="add_new_records($refs.employee_no.value, $refs.account_no.value, $refs.no.value, $refs.employee_name.value, $refs.date_in.value, $refs.time_in_am.value, $refs.time_out_am.value, $refs.time_in_pm.value, $refs.time_out_pm.value), get_current_cutoff($refs.cutoff_date.value)">
                    Add
                    </button>
            </div>

            <div class="h-80 overflow-auto mt-2 justify-center flex items-start shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left dark:text-gray-400 overflow-auto">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="">
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Employee No.
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Employee Name
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Account No.
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                No.
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Cut-off Date
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Date
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Time In (AM)
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Time Out (AM)
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Time In (PM)
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Time Out (PM)
                            </th>
                            <th scope="col" class="py-3  whitespace-nowrap text-center">
                                Remove
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <template x-if="temp_records"> --}}
                            {{-- <template x-for="(attendance) in temp_records"> --}}
                                <template x-for="(value, index) in temp_records" :key="index">
                                    <tr class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row"  class="py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                            x-text="Object.values(value)[0]">
                                        </td>
                                        <td scope="row" class="py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                            x-text="Object.values(value)[3]">
                                        </td>
                                        <td scope="row" class="py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center"
                                            x-text="Object.values(value)[1]">
                                        </td>
                                        <td class="py-3 text-center"
                                            x-text="Object.values(value)[2]">
                                        </td>
                                        <td class="py-3 text-center">
                                            <span x-text="add_cutoff_date"></span>
                                        </td>
                                        <td class="py-3 text-center"
                                            x-text="Object.values(value)[4]">
                                            {{-- <span>{{ $current_date }}</span> --}}
                                        </td>
                                        <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2"
                                            x-text="Object.values(value)[5]">
                                        </td>
                                        <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2"
                                            x-text="Object.values(value)[6]">
                                        </td>
                                        <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2"
                                            x-text="Object.values(value)[7]">
                                        </td>
                                        <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2"
                                            x-text="Object.values(value)[8]">
                                        </td>


                                        <td class="flex flex-row justify-center py-2">
                                            <button title="remove" class="" x-on:click="remove_record(index)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-900 hover:text-red-700">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            {{-- </template> --}}
                        {{-- </template> --}}
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col items-center justify-center mt-7">
                <button type="button" class="mx-auto rounded-full px-6 py-3 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-0 active:bg-blue-800 transition duration-150 ease-in-out"
                    x-on:click="merge_records" :disabled="temp_records == ''">
                        Add Records
                    </button>
            </div>
        </div>
    </div>
</div>
