<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Update Loan' }}
    </x-slot>

    <div class="flex flex-row items-center">
        <x-auth-validation-errors class="my-4 mx-auto" :errors="$errors" />
    </div>

    <div class="py-12" x-data="loan">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('update-loans', $get_loan_details->loan_id) }}">
                @csrf
                @method('PUT')
                <input type="text" id="employee_id" name="employee_id" x-ref="employee_id" value="{{ old('employee_id') ? : $get_loan_details->employee_id }}" hidden>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-5 w-full relative">
                                <label for="employee_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employee Name <span class="text-red-400 text-lg">*</span></label>
                                <input type="text" id="employee_name" name="employee_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off" x-ref="employee_name" x-on:click="click_emp = true" x-on:keydown.Backspace="$refs.department.value = '', $refs.employee_no.value = '', $refs.department1.value = '', $refs.employee_no1.value = ''"
                                value="{{ old('employee_name') ? old('employee_name') : $employee_details->last_name.' '.$employee_details->first_name.' '.strtoupper($employee_details->middle_name[0]).'.' }}"
                                x-on:keydown="$refs.employee_id.value = '', $refs.department.value = '', $refs.employee_no.value = '', click_emp = false, search_emp = true, search_emp ? show_suggestion() : search_emp = false">
                                {{-- Show employess --}}
                                <div class="absolute mt-11 top-9 w-full z-20 max-h-72 overflow-y-scroll bg-white rounded-md shadow-sm border border-gray-300" x-show="click_emp" @click.outside="click_emp = false">
                                    <template x-for="employee in employees">
                                        <li x-text="employee.last_name +' '+ employee.first_name +' '+ employee.middle_name[0].toUpperCase() +'.'" x-on:click="$refs.employee_id.value = employee.employee_id, $refs.department.value = employee.employee_details.department, $refs.department1.value = employee.employee_details.department, $refs.employee_no1.value = employee.employee_code, $refs.employee_no.value = employee.employee_code, $refs.employee_name.value = employee.last_name +' '+ employee.first_name +' '+ employee.middle_name[0].toUpperCase() +'.', check_loans()" class="cursor-default transition duration-500 ease-in-out flex block px-4 py-2 hover:bg-gray-300 hover:bg-opacity-50 hover:text-gray-900 items-center"></li>
                                    </template>
                                </div>
                                {{-- Show searched employees --}}
                                <div class="absolute mt-11 top-9 w-full z-20 max-h-72 overflow-y-scroll bg-white rounded-md shadow-sm border border-gray-300" x-show="search_emp" @click.outside="search_emp = false">
                                    <template x-for="employee in filtered_employees">
                                        <li x-text="employee.last_name +' '+ employee.first_name +' '+ employee.middle_name[0].toUpperCase() +'.'" x-on:click="$refs.department.value = employee.employee_details.department, $refs.employee_no.value = employee.employee_code, $refs.department1.value = employee.employee_details.department, $refs.employee_no1.value = employee.employee_code, $refs.employee_name.value = employee.last_name +' '+ employee.first_name +' '+ employee.middle_name[0].toUpperCase() +'.', check_loans()" class="cursor-default transition duration-500 ease-in-out flex block px-4 py-2 hover:bg-gray-300 hover:bg-opacity-50 hover:text-gray-900 items-center"></li>
                                    </template>
                                </div>
                            </div>
                            <div class="mb-5 w-full">
                                <label for="employee_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employee ID <span class="text-red-400 text-lg">*</span></label>
                                <input type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled x-ref="employee_no1" value="{{ old('employee_no') ? old('employee_no') : $employee_details->employee_code }}" autocomplete="off">
                            </div>
                            <div class="mb-5 w-full">
                                <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Department <span class="text-red-400 text-lg">*</span></label>
                                <input type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled x-ref="department1" value="{{ old('department') ? old('department') : $employee_details->EmployeeDetails->department }}" autocomplete="off">
                            </div>

                            <input type="text" id="employee_no" name="employee_no" x-ref="employee_no" hidden>
                            <input type="text" id="department" name="department" x-ref="department" hidden>
                        </div>
                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-5 w-1/2">
                                <label for="loan_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Type <span class="text-red-400 text-lg">*</span></label>
                                <select id="loan_type" name="loan_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" x-ref="loan_type" x-on:change="check_loan_type()" autocomplete="off">
                                    @if (old('loan_type'))
                                        <option selected hidden value="{{ old('loan_type') == 'SSS Loan' ? 1 : (old('loan_type') == 'EF Loan' ? 2 : 3) }}">{{ old('loan_type') == 1 ? 'SSS Loan' : (old('loan_type') == 2 ? 'EF Loan' : 'Pag-ibig Loan') }}</option>
                                    @elseif ($get_loan_details)
                                        <option selected hidden value="{{ $get_loan_details->type_of_loan == 'SSS Loan' ? 1 : ($get_loan_details->type_of_loan == 'EF Loan' ? 2 : 3) }}">{{ $get_loan_details->type_of_loan }}</option>
                                    @else
                                        <option selected hidden value="">Choose type of Loan</option>
                                    @endif
                                    <option value="1">SSS Loan</option>
                                    <option value="2">EF Loan</option>
                                    <option value="3">Pag-ibig Loan</option>
                                </select>
                            </div>

                            <div class="mb-5 w-1/2">
                                <label for="loan_app_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Application No. <span class="text-red-400 text-lg">*</span></label>
                                <input type="text" id="loan_app_no" name="loan_app_no" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('loan_app_no') ? old('loan_app_no') : $get_loan_details->loan_application_no }}" autocomplete="off">
                            </div>

                            <div class="mb-5 w-1/2">
                                <label for="loan_terms" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Terms (in months) <span class="text-red-400 text-lg">*</span></label>
                                <input type="number" id="loan_terms" name="loan_terms" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('loan_terms') ? old('loan_terms') : $get_loan_details->loan_terms }}" x-ref="loan_terms" autocomplete="off">
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-5 w-1/2">
                                <label for="loan_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Date <span class="text-red-400 text-lg">*</span></label>
                                <input datepicker  type="text" id="loan_date" name="loan_date" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('loan_date') ? date('m/d/Y', strtotime(old('loan_date'))) : date('m/d/Y', strtotime($get_loan_details->loan_date)) }}" autocomplete="off">
                            </div>

                            <div class="mb-5 w-1/2">
                                <label for="deduction_from" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deduction from <span class="text-red-400 text-lg">*</span></label>
                                <input datepicker  type="text" id="deduction_from" name="deduction_from" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('deduction_from') ? date('m/d/Y', strtotime(old('deduction_from'))) : date('m/d/Y', strtotime($get_loan_details->deduction_from)) }}" autocomplete="off">
                            </div>

                            <div class="mb-5 w-1/2">
                                <label for="deduction_to" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deduction to <span class="text-red-400 text-lg">*</span></label>
                                <input datepicker  type="text" id="deduction_to" name="deduction_to" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('deduction_to') ? date('m/d/Y', strtotime(old('deduction_to'))) : date('m/d/Y', strtotime($get_loan_details->deduction_to)) }}"  autocomplete="off">
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-3 w-72 ">
                                <label for="loan_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Amount <span class="text-red-400 text-lg">*</span></label>
                                <input type="number" id="loan_amount" name="loan_amount" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('loan_amount') ? old('loan_amount') : $get_loan_details->loan_amount }}"
                                x-on:keyup="compute_monthly_due" x-ref="loan_amount" autocomplete="off">
                            </div>

                            <div class="mb-3 w-72">
                                <label for="monthly_due" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Monthly Due <span class="text-red-400 text-lg">*</span></label>
                                <input type="text" id="monthly_due" name="monthly_due" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('monthly_due') ? old('monthly_due') : $get_loan_details->monthly_due }}" x-ref="monthly_due" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('error_message'))
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-md mt-2 px-3 py-3">
                        <span class="text-red-400 text-md font-bold">{{session()->get('error_message')}}</span>
                    </div>
                @endif
                <template x-if="message">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-md mt-2 px-3 py-3">
                        <span class="text-red-400 text-md font-bold" x-text="message"></span>
                    </div>
                </template>

                {{-- Buttons --}}
                <div class="flex flex-row justify-between">
                    <div>
                        <button type="submit" class="mt-2 text-gray-900 bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:outline-none focus:ring-[#F7BE38]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2" onclick="this.disabled=true;this.form.submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Update
                        </button>
                        <a href="{{ route('loan') }}" class="bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                            </svg>
                            Back
                        </a>
                        {{-- <button type="reset" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Reset
                        </button> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('loan', () => ({
            'employees': @json($employees),
            'filtered_employees': [],
            'click_emp': false,
            'search_emp' : false,
            'message': '',
            show_employees(){
                alert(this.click_emp);
            },
            show_suggestion(){
                this.filtered_employees = [];
                var emp = @json($employees);
                var index = 0;
                for (const key in emp) {
                    if (Object.hasOwnProperty.call(emp, key)) {
                        const emp_record = ((emp[key].last_name) +' '+ (emp[key].first_name) +' '+ (emp[key].middle_name)).toLowerCase();
                        const result = emp_record.toLowerCase().includes((this.$refs.employee_name.value).toLowerCase());
                        if(result){
                            this.filtered_employees[index] = emp[key];
                            index++;
                        }
                    }
                }
            },
            compute_monthly_due(){
                if(this.$refs.loan_type.value == 2){
                    this.$refs.monthly_due.value = ((this.$refs.loan_amount.value / this.$refs.loan_terms.value) + ((this.$refs.loan_amount.value / this.$refs.loan_terms.value) * 0.03)).toFixed(2);
                }
            },
            check_loans(){
                var loans = @json($loans);
                var total_loans = 0;
                for (const key in loans) {
                    if (Object.hasOwnProperty.call(loans, key)) {
                        const element = loans[key];
                        if(element.employee_id == this.$refs.employee_id.value){
                            total_loans++;
                        }

                    }
                }
                if(total_loans >= 4){
                    this.message = 'Employee reached the maximum loans allowed!';
                    this.$refs.employee_id.value = '';
                    this.$refs.employee_name.value = '';
                    this.$refs.employee_no.value = '';
                    this.$refs.employee_no1.value = '';
                    this.$refs.department.value = '';
                    this.$refs.department1.value = '';
                }
                else{
                    this.message = '';
                }
            },
            check_loan_type(){
                var loans = @json($loans);
                var c_loan_sss = 0;
                var c_loan_ef = 0;
                var c_loan_pagibig = 0;

                for (const key in loans) {
                    if (Object.hasOwnProperty.call(loans, key)) {
                        const element = loans[key];
                        if(element.employee_id == this.$refs.employee_id.value){
                            if((element.type_of_loan).toLowerCase() == 'sss loan'){
                                c_loan_sss++;
                            }
                            if((element.type_of_loan).toLowerCase() == 'ef loan'){
                                c_loan_ef++;
                            }
                            if((element.type_of_loan).toLowerCase() == 'pag-ibig loan'){
                                c_loan_pagibig++;
                            }
                        }
                    }
                }
                if(this.$refs.loan_type.value == 1){
                    if(c_loan_sss >= 1 ){
                        this.message = 'Tama na wag na, sobra na (sss)';
                        this.$refs.employee_id.value = this.$refs.employee_name.value =  this.$refs.employee_no.value = this.$refs.employee_no1.value =  this.$refs.department.value = this.$refs.department1.value = '';
                    }
                    else {
                        this.message = '';
                    }
                }
                else if(this.$refs.loan_type.value == 2){
                    if(c_loan_ef >= 2 ){
                        this.message = 'Tama na wag na, sobra na (ef)';
                        this.$refs.employee_id.value = this.$refs.employee_name.value =  this.$refs.employee_no.value = this.$refs.employee_no1.value =  this.$refs.department.value = this.$refs.department1.value = '';
                    }
                    else {
                        this.message = '';
                    }
                }
                else if(this.$refs.loan_type.value == 3){
                    if(c_loan_pagibig >= 1 ){
                        this.message = 'Tama na wag na, sobra na (pag-ibig)';
                        this.$refs.employee_id.value = this.$refs.employee_name.value =  this.$refs.employee_no.value = this.$refs.employee_no1.value =  this.$refs.department.value = this.$refs.department1.value = '';
                    }
                    else {
                        this.message = '';
                    }
                }

            }
        }));
    });
</script>
