{{-- Tab 1 --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2" style="display: none;" x-show="tab_1" x-transition:enter.duration.500ms>
    <div class="p-6 bg-white border-b border-gray-200">
        <p class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">Personal Details</p>
        <div class="mb-4">
            <span class="text-red-400 text-md font-bold" x-show="invalid_filetype">Invalid file type</span>
            <div class="">
                <label class="w-32 h-32 bg-gray-200 rounded-xl flex flex-row border border-gray-600">
                    <div class="flex justify-center items-center mx-auto">
                        <img :src="imageUrl" alt="">
                    </div>
                    <input type="file" id="emp_photo" name="emp_photo" x-ref="emp_photo_update" hidden x-on:change="fileChosen_update">
                </label>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_first_name" name="first_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->first_name }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full mt-0 lg:mt-2">
                <label for="n_middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Middle Name</label>
                <input type="text" id="n_middle_name" name="middle_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->middle_name }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_last_name" name="last_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->last_name }}" autocomplete="off">
            </div>
        </div>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Age <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_age" name="age" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->age }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_date_of_birth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date of Birth <span class="text-red-400 text-lg">*</span></label>
                <input datepicker  type="text" id="n_date_of_birth" name="date_of_birth1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-ref="bday"  value="{{ date('m/d/Y', strtotime($employees->date_of_birth)) }}" autocomplete="off" x-on:click.outside="compute_age">
            </div>

            <div class="mb-6 w-full">
                <label for="n_sex" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sex <span class="text-red-400 text-lg">*</span></label>
                <select id="n_sex" name="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model="gender"  value="{{ $employees->gender }}" autocomplete="off">
                    <option selected hidden value="{{ strtolower($employees->sex) == 'male' ? 1 : 2 }}">{{ $employees->sex }}</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            {{-- <div class="mb-6 w-full">
                <label for="n_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Address <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_address" name="address" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-model="address" autocomplete="off">
            </div> --}}

            <div class="mb-6 w-full">
                <label for="n_employee_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employee Status <span class="text-red-400 text-lg">*</span></label>
                <select id="n_employee_status" name="employee_status" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->employee_status }}" autocomplete="off">
                    <option selected hidden value="{{ strtolower($employees->employee_status) == 'regular' ? 1 : 2 }}">{{ $employees->employee_status }}</option>
                    <option value="1">Regular</option>
                    <option value="2">Casual</option>
                </select>
            </div>

            <div class="mb-6 w-full">
                <label for="n_mobile_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mobile Number <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_mobile_no" name="mobile_no" placeholder="09456517431" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->mobile_no }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nationality <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_nationality" name="nationality" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->nationality }}" autocomplete="off">
            </div>
        </div>
    </div>
</div>
{{-- End Tab 1 --}}

{{-- Tab 2 --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2" style="display: none;" x-show="tab_2" x-transition:enter.duration.500ms>
    <div class="p-6 bg-white border-b border-gray-200">
        <p class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">Employee's contact details</p>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full mt-0 lg:mt-2">
                <label for="n_block_house_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Block/house No. </label>
                <input type="text" id="n_block_house_no" name="block_house_no" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->block_house_no }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full mt-0 lg:mt-2">
                <label for="n_street" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Street</label>
                <input type="text" id="n_street" name="street" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->street }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Barangay <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_barangay" name="barangay" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->barangay }}" autocomplete="off">
            </div>
        </div>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">City/Municipality <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_city" name="city" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->city }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Province <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_province" name="province" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->province }}" autocomplete="off">
            </div>
        </div>
    </div>
</div>
{{-- Tab 2 --}}

{{-- Tab 3 --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2" style="display: none;" x-show="tab_3" x-transition:enter.duration.500ms>
    <div class="p-6 bg-white border-b border-gray-200">
        <p class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">Employee's work details</p>
        <div class="flex items-center mb-3">
            <input type="text" x-model="ot_pay" name="ot_pay_value" hidden>
            <input id="with_ot_pay" {{ $employees->EmployeeDetails->with_ot_pay ? 'checked' : '' }} type="checkbox" id="with_ot_pay" name="with_ot_pay" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @click="ot_pay = !ot_pay">
            <label for="with_ot_pay" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">With OT pay? </label>
        </div>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_employee_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employee ID <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_employee_number" name="employee_number" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->employee_code }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Department <span class="text-red-400 text-lg">*</span></label>
                <select id="n_department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->department }}" autocomplete="off">
                    <option selected hidden value="{{ strtolower($employees->EmployeeDetails->department) == 'Sales Department' ? 1 : 2 }}">{{ $employees->EmployeeDetails->department }}</option>
                    <option value="1">Sales Department</option>
                    <option value="2">Accounting Department</option>
                    <option value="3">Finance Department</option>
                    <option value="4">Logistics Department</option>
                </select>
            </div>

            <div class="mb-6 w-full">
                <label for="n_basic_rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Basic Rate <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_basic_rate" name="basic_rate" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->basic_rate }}" autocomplete="off">
            </div>
            <div class="mb-6 w-full">
                <label for="n_allowance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Allowance <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_allowance" name="allowance" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->allowance }}" autocomplete="off">
            </div>
        </div>

        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_leave_pay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Leave with pay <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_leave_pay" name="leave_pay" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->leave_with_pay }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Position <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_position" name="position" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->position }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_date_hired" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date Hired <span class="text-red-400 text-lg">*</span></label>
                <input datepicker type="text" id="n_date_hired" name="date_hired1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-ref="d_hired"  value="{{ date('m/d/Y', strtotime($employees->EmployeeDetails->date_hired)) }}" x-on:click.outside="set_datehired" autocomplete="off">
            </div>
            <div class="mb-6 w-full">
                <label for="n_date_resigned" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date Resigned <span class="text-lg" :class="[required_flag ? 'text-red-400' : 'text-white' ]">*</span></label>
                <input datepicker type="text" id="n_date_resigned" name="date_resigned1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-ref="d_resigned" value="{{ $employees->EmployeeDetails->date_resigned ? date('m/d/Y', strtotime($employees->EmployeeDetails->date_resigned)) : '' }}" x-on:click.outside="set_dateresigned" autocomplete="off">
            </div>
        </div>

        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_employment_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employment Status <span class="text-red-400 text-lg">*</span></label>
                <select id="n_employee_status" name="employment_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->employment_status }}" autocomplete="off"
                    x-ref="n_employee_status"
                    x-on:change="$refs.n_employee_status.value == 1 ? [$refs.d_resigned.disabled = true, $refs.d_resigned.value = '', required_flag = false] : [$refs.d_resigned.disabled = false, $refs.d_resigned.value = '{{ $employees->EmployeeDetails->date_resigned ? date('m/d/Y', strtotime($employees->EmployeeDetails->date_resigned)) : '' }}', required_flag = true]">
                    <option selected hidden value="{{ strtolower($employees->EmployeeDetails->employment_status) == 'active' ? 1 : 2 }}">{{ $employees->EmployeeDetails->employment_status }}</option>
                    <option value="1">Active</option>
                    <option value="2">Resigned</option>
                </select>
            </div>

            <div class="mb-6 w-full">
                <label for="n_sss_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">SSS Number <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_sss_number" name="sss_number" placeholder="10-2536478-0" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->sss_no }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full mt-0 lg:mt-2">
                <label for="n_pwposition" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Previous Work Position </label>
                <input type="text" id="n_pwposition" name="pwposition" placeholder="no position" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->employee_history_position }}" autocomplete="off">
            </div>
        </div>

        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_philhealth_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Philhealth Number <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_philhealth_no" name="philhealth_no" placeholder="14-253647890-1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->philhealth_no }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_tin_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tin Number <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_tin_no" name="tin_no" placeholder="444-000-123-000" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->tin_no }}" autocomplete="off">
            </div>
            <div class="mb-6 w-full">
                <label for="n_pagibig_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pag-ibig Number <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_pagibig_no" name="pagibig_no" placeholder="1211-0000-1122" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->hdmf_no }}" autocomplete="off">
            </div>
        </div>
    </div>
</div>
{{-- Tab 3 --}}

{{-- Tab 4 --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2" style="display: none;" x-show="tab_4" x-transition:enter.duration.500ms>
    <div class="p-6 bg-white border-b border-gray-200">
        <p class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">Contribution and Loans Amount</p>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_sss_contribution" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">SSS Contribution <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_sss_contribution" name="sss_contribution" step="any" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->sss_contribution }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_philhealth_contribution" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Philhealth Contribution <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_philhealth_contribution" name="philhealth_contribution" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->philhealth_contribution }}" autocomplete="off">

            </div>

            <div class="mb-6 w-full">
                <label for="n_ef_contribution" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">EF Contribution <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_ef_contribution" name="ef_contribution" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->ef_contribution }}" autocomplete="off">
            </div>
            <div class="mb-6 w-full">
                <label for="n_pagibig_contribution" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pag-ibig Contribution <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_pagibig_contribution" name="pagibig_contribution" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->hdmf_contribution }}" autocomplete="off">
            </div>
        </div>

        <div>
            @if ($loans != '[]')
                <h4 class="text-3xl text-gray-500 font-bold mt-2">Active Loans</h4>
                <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                    <div class="mt-2 mb-2 w-full text-center">
                        <label for="type_of_loan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Type of Loan <span class="text-red-400 text-lg">*</span></label>
                    </div>

                    <div class="mt-2 mb-2 w-full text-center">
                        <label for="loan_app_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Application No <span class="text-red-400 text-lg">*</span></label>
                    </div>

                    <div class="mt-2 mb-2 w-full text-center">
                        <label for="loan_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date of Loan <span class="text-red-400 text-lg">*</span></label>
                    </div>
                    <div class="mt-2 mb-2 w-full text-center">
                        <label for="monthly_due" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Monthly Due <span class="text-red-400 text-lg">*</span></label>
                    </div>
                </div>
                @foreach ($loans as $loan)
                    <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                        <div class="mb-6 w-full">
                            {{-- <label for="type_of_loan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employee ID <span class="text-red-400 text-lg">*</span></label> --}}
                            <input type="text" id="type_of_loan" name="type_of_loan" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $loan->type_of_loan }}" autocomplete="off" disabled>
                        </div>

                        <div class="mb-6 w-full">
                            {{-- <label for="loan_app_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Department <span class="text-red-400 text-lg">*</span></label> --}}
                            <input type="text" id="loan_app_no" name="loan_app_no" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $loan->loan_application_no }}" autocomplete="off" disabled>
                        </div>

                        <div class="mb-6 w-full">
                            {{-- <label for="loan_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Basic Rate <span class="text-red-400 text-lg">*</span></label> --}}
                            <input type="text" id="loan_date" name="loan_date" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ date('F j, Y', strtotime($loan->loan_date)) }}" autocomplete="off" disabled>
                        </div>
                        <div class="mb-6 w-full">
                            {{-- <label for="monthly_due" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Allowance <span class="text-red-400 text-lg">*</span></label> --}}
                            <input type="text" id="monthly_due" name="monthly_due   " class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $loan->monthly_due }}" autocomplete="off" disabled>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
{{-- Tab 4 --}}

{{-- Tab 5 --}}
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-2" style="display: none;" x-show="tab_5" x-transition:enter.duration.500ms>
    <div class="p-6 bg-white border-b border-gray-200">
        <p class="font-medium text-gray-900 dark:text-gray-300 text-lg mb-3">Other details</p>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_marital_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Marital Status <span class="text-red-400 text-lg">*</span></label>
                <select id="n_marital_status" name="marital_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off">
                    <option selected hidden value="{{ strtolower($employees->EmployeeDetails->marital_status) == 'Single' ? 1 : 2 }}">{{ $employees->EmployeeDetails->marital_status }}</option>
                    <option value="1">Single</option>
                    <option value="2">Married</option>
                    <option value="3">Widowed</option>
                    <option value="4">Separated</option>
                </select>
            </div>

            <div class="mb-6 w-full">
                <label for="n_number_of_children" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Number of Children <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_number_of_children" name="number_of_children" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->no_of_children }}" autocomplete="off">

            </div>

            <div class="mb-6 w-full">
                <label for="n_spouse_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Spouse Name <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_spouse_name" name="spouse_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->spouse_name }}" autocomplete="off">
            </div>
            <div class="mb-6 w-full">
                <label for="n_spouse_occupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Spouse Occupation <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_spouse_occupation" name="spouse_occupation" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->spouse_occupation }}" autocomplete="off">
            </div>
        </div>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full">
                <label for="n_contact_person" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Emergency Contact Person <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_contact_person" name="contact_person" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->emergency_contact_name }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_emergency_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Emergency Contact Number <span class="text-red-400 text-lg">*</span></label>
                <input type="number" id="n_emergency_number" name="emergency_number" placeholder="09456517431" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->emergency_contact_no }}" autocomplete="off">
            </div>

            <div class="mb-6 w-full">
                <label for="n_contact_person_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Contact Person Address <span class="text-red-400 text-lg">*</span></label>
                <input type="text" id="n_contact_person_address" name="contact_person_address" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employees->EmployeeDetails->emergency_contact_address }}" autocomplete="off">
            </div>
        </div>
        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
            <div class="mb-6 w-full lg:w-1/2">
                <label for="n_dependant" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dependant <span class="text-red-400 text-lg">*</span> <span class="text-xs">(names must be separated by comma)</span></label>
                <textarea type="text" id="n_dependant" name="dependant" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  x-model="dependant"  autocomplete="off">
                </textarea>
            </div>
        </div>
    </div>
</div>
{{-- Tab 5 --}}

