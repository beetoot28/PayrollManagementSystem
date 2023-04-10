<style>
    @media print {
        #payslip {
            display: none;
        }
    }
</style>
<div id="payslip" x-ref="payslip" hidden>
    <div style="width: 576px; height: 384px;">
        <div class="flex-col pt-1 space-y-1">
            <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 px-2 rounded-md py-1">
                <span>Payroll Period</span>
                <span x-text="payroll_period" class="text-gray-900"></span>
            </div>
            <div class="flex flex-row justify-between bg-gray-100 hover:bg-gray-300 px-2 rounded-md py-1">
                <span>Employee Name</span>
                <div class="relative" x-on:mouseover="on_hover = true" x-on:mouseleave="on_hover = false" >
                    <span class="font-bold text-green-500 hover:text-green-700" x-text="employee_name.toUpperCase()"></span>
                    <div class="absolute w-32 h-32 bg-gray-200 rounded-xl flex flex-row border border-gray-600 -ml-28" x-show="on_hover">
                        <img :src="employee_photo" alt="">
                    </div>
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
</div>
