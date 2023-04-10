<div class="inline-flex items-center justify-center w-9/12 h-full z-20 top-0 absolute px-10 lg:px-20" style="display: none;" x-show="show_r_payroll_details" x-transition.duration.400ms>
    <div class="w-full bg-white rounded-lg shadow-md opacity-100 p-3">
        <div class="flex justify-between pb-2 border-b-2 border-gray-200">
            <span class="text-lg text-green-500  uppercase flex flex-row justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-green-700 font-bold">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                </svg>
                Employee Payroll Details
            </span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-7 h-7 cursor-pointer rounded-md p-1 hover:bg-gray-300 hover:text-gray-800 text-gray-600 font-semibold "
                x-on:click="show_r_payroll_details = false, clear_details">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <div class="flex flex-row w-full h-96 overflow-y-auto">
            <div class="flex-row w-full h-96 overflow-y-auto">
                <div class="flex-col pt-1 space-y-1">
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 px-2 rounded-md py-1">
                        <span>Payroll Period</span>
                        <span x-text="payroll_period" class="hover:text-white"></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Employee Name</span>
                        <div class="relative">
                            <span class="font-bold text-green-500 hover:text-green-700" x-text="employee_name.toUpperCase()"></span>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Rate</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="rate"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Days Worked</span>
                        <span x-text="working_days" class="hover:text-white"></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Gross Pay</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="gross_pay"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Leave Pay</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="leave_pay"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Holiday Pay</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="holiday_pay"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Overtime</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="overtime_pay"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Absences</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="absences_amount"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Undertime/Late</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="late_undertime_pay"></span></span>
                    </div>

                    {{-- <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Others</span>
                        <span>Others</span>
                    </div> --}}
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Allowance</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="allowance"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Total Gross Pay</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="gross_pay"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>SSS  Contribution</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="sss_contribution"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>PHIC Contribution</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="philhealth_contribution"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>HDMF Contribution</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="hdmf_contribution"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>SSS Loan</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="sss_loan"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>HDMF Loan</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="hdmf_loan"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>EF Contribution</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="ef_contribution"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>EF Loan</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="ef_loan"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Drs</span>
                        <div class="flex flex-row">
                            <span class="hover:text-white">&#x20B1; <span x-text="employee_drs"></span></span>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Other Company Drs</span>
                        <div class="flex flex-row">
                            <span class="hover:text-white">&#x20B1; <span x-text="other_company_dr"></span></span>
                        </div>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Due From</span>
                        <div class="flex flex-row">
                            <span class="hover:text-white">&#x20B1; <span x-text="duefrom"></span></span>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1 ">
                        <div class="flex flex-row justify-between">
                            <span>Remarks</span>
                            {{-- <button class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-1 mb-2" x-on:click="update_remarks = true, temp_remarks = remarks">Edit Remarks</button> --}}
                        </div>
                        <span class="text-right hover:text-white" x-text="remarks"></span>

                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Total Deductions</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="total_deductions"></span></span>
                    </div>
                    <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                        <span>Total Net Pay</span>
                        <span class="hover:text-white">&#x20B1; <span x-text="net_salary"></span></span>
                    </div>
                </div>
            </div>
            {{-- <div class="flex-row w-full lg:w-1/2 h-96 overflow-auto">
                <div class="flex-col space-y-1">
                    <div class="flex items-center shadow-md sm:rounded-lg overflow-x-auto">
                        <table class="w-full text-sm text-left dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="">
                                    <th scope="col" class="ml-5 text-sm whitespace-nowrap text-center font-bold">
                                        Date In
                                    </th>
                                    <th scope="col" class="py-3 text-sm whitespace-nowrap text-center font-bold">
                                        Time In (AM)
                                    </th>
                                    <th scope="col" class="py-3 text-sm whitespace-nowrap text-center font-bold">
                                        Time Out (AM)
                                    </th>
                                    <th scope="col" class="py-3 text-sm whitespace-nowrap text-center font-bold">
                                        Time In (PM)
                                    </th>
                                    <th scope="col" class="py-3 text-sm whitespace-nowrap text-center font-bold">
                                        Time Out (PM)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-if="attendances">
                                    <template x-for="row in attendances">
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                                <span x-text="date_formatter(row.date_in)"></span>
                                            </td>
                                            <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                                <span x-text="row.time_in_am"></span>
                                            </td>
                                            <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                                <span x-text="row.time_out_am"></span>
                                            </td>
                                            <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                                <span x-text="row.time_in_pm"></span>
                                            </td>
                                            <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                                <span x-text="row.time_out_pm"></span>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
