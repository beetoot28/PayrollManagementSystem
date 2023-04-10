<x-app-layout>
    <x-slot name="title">
        {{ $title = 'View Loan' }}
    </x-slot>

    <div class="py-12" x-data="loan">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <input type="text" id="employee_id" name="employee_id" ="employee_id" value="{{ $get_loan_details->employee_id }}" hidden>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                        <div class="mb-5 w-full relative">
                            <label for="employee_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employee Name <span class="text-red-400 text-lg">*</span></label>
                            <input type="text" id="employee_name" name="employee_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="off"
                            value="{{ $employee_details->last_name.' '.$employee_details->first_name.' '.strtoupper($employee_details->middle_name ? $employee_details->middle_name[0] : '').'.' }}" disabled>
                        </div>
                        <div class="mb-5 w-full">
                            <label for="employee_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Employee ID <span class="text-red-400 text-lg">*</span></label>
                            <input type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="{{ $employee_details->employee_code }}" autocomplete="off">
                        </div>
                        <div class="mb-5 w-full">
                            <label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Department <span class="text-red-400 text-lg">*</span></label>
                            <input type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="{{ $employee_details->EmployeeDetails->department }}" autocomplete="off">
                        </div>

                        <input type="text" id="employee_no" name="employee_no" hidden>
                        <input type="text" id="department" name="department" hidden>
                    </div>
                    <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                        <div class="mb-5 w-1/2">
                            <label for="loan_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Type <span class="text-red-400 text-lg">*</span></label>
                            <select id="loan_type" name="loan_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled autocomplete="off">
                                <option selected hidden value="{{ $get_loan_details->type_of_loan == 'SSS Loan' ? 1 : ($get_loan_details->type_of_loan == 'EF Loan' ? 2 : 3) }}">{{ $get_loan_details->type_of_loan }}</option>
                            </select>
                        </div>

                        <div class="mb-5 w-1/2">
                            <label for="loan_app_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Application No. <span class="text-red-400 text-lg">*</span></label>
                            <input type="text" id="loan_app_no" name="loan_app_no" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $get_loan_details->loan_application_no }}" disabled autocomplete="off">
                        </div>

                        <div class="mb-5 w-1/2">
                            <label for="loan_terms" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Terms (in months) <span class="text-red-400 text-lg">*</span></label>
                            <input type="number" id="loan_terms" name="loan_terms" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $get_loan_details->loan_terms }}" disabled autocomplete="off">
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                        <div class="mb-5 w-1/2">
                            <label for="loan_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Date <span class="text-red-400 text-lg">*</span></label>
                            <input datepicker  type="text" id="loan_date" name="loan_date" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ date('m/d/Y', strtotime($get_loan_details->loan_date)) }}" disabled autocomplete="off">
                        </div>

                        <div class="mb-5 w-1/2">
                            <label for="deduction_from" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deduction from <span class="text-red-400 text-lg">*</span></label>
                            <input datepicker  type="text" id="deduction_from" name="deduction_from" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ date('m/d/Y', strtotime($get_loan_details->deduction_from)) }}" disabled autocomplete="off">
                        </div>

                        <div class="mb-5 w-1/2">
                            <label for="deduction_to" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deduction to <span class="text-red-400 text-lg">*</span></label>
                            <input datepicker  type="text" id="deduction_to" name="deduction_to" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ date('m/d/Y', strtotime($get_loan_details->deduction_to)) }}" disabled  autocomplete="off">
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                        <div class="mb-3 w-72 ">
                            <label for="loan_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Loan Amount <span class="text-red-400 text-lg">*</span></label>
                            <input type="number" id="loan_amount" name="loan_amount" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $get_loan_details->loan_amount }}" disabled>
                        </div>

                        <div class="mb-3 w-72">
                            <label for="monthly_due" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Monthly Due <span class="text-red-400 text-lg">*</span></label>
                            <input type="text" id="monthly_due" name="monthly_due" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $get_loan_details->monthly_due }}" disabled autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="flex flex-row justify-between">
                <div class="mt-2">
                    <a href="{{ route('loan') }}" class="bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
