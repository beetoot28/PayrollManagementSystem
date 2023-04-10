<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Reports' }}
    </x-slot>


    <div class="py-12 relative h-full" x-data="reports">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px">
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 1 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(1)">
                            Employee Reports
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 2 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(2)">
                        Attendances Reports
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 3 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(3)">
                            Loans Reports
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 4 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(4)">
                            Payroll Reports
                        </button>
                    </li>
                    {{-- <li class="mr-2">
                        <button type="button" :class="[active_tab == 5 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(5)">
                            Employees Leave Pay
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 6 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(6)">
                            Holidays Computations
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 7 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(7)">
                            Holidays
                        </button>
                    </li> --}}
                </ul>
            </div>
            @include('modules.reports.employee_reports')
            @include('modules.reports.attendance_reports')
            @include('modules.reports.loans_reports')
            @include('modules.reports.payroll_reports')
            @include('modules.reports.view_reports_payroll_details')

        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('reports', () => ({
            active_tab: '{{ $active_tab }}',
            show_r_payroll_details: false,

            id: 0,
            employee_id: '',
            cutoff_id: '',
            payroll_period: '',
            employee_photo: '',
            employee_name: '',
            rate: '',
            working_days: '',
            gross_pay: '',
            gross_pay: '',
            leave_pay: '',
            holiday_pay: '',
            overtime_pay: '',
            absences_amount: '',
            late_undertime_pay: '',
            allowance: '',
            gross_pay: '',
            sss_contribution: '',
            philhealth_contribution: '',
            hdmf_contribution: '',
            sss_loan: '',
            hdmf_loan: '',
            ef_loan: '',
            ef_contribution: '',
            total_deductions: '',
            net_salary: '',
            remarks: '',
            attendances: [],
            employee_drs: 0,
            other_company_dr: 0,
            duefrom: 0,
            payroll_status: 0,

            async set_active_tab(_input){
                let form = new FormData;
                form.append('tab_value', _input);
                await axios.post('/set-active-tab-reports', form)
                .then((response) => {
                    this.active_tab = parseInt(response.data);
                },
                (error) => {
                    console.log(error);
                });
            },
            async get_payroll_period(cutoff_id){
                let form = new FormData;
                form.append('cutoff_id', cutoff_id);
                await axios.post('/get-payroll-period', form)
                .then((response) => {
                    this.payroll_period = response.data;
                    // console.log(response.data);
                });
            },
            export_excel(_id){
                document.getElementById(_id).value = true;
                setTimeout(() => {
                    this.$refs.export_employee_btn.disabled = true;
                    this.$refs.export_attendance_btn.disabled = true;
                    this.$refs.export_loan_btn.disabled = true;
                    this.$refs.export_payroll_btn.disabled = true;
                }, 100);
                setTimeout(() => {
                    this.$refs.export_employee_btn.disabled = false;
                    this.$refs.export_attendance_btn.disabled = false;
                    this.$refs.export_loan_btn.disabled = false;
                    this.$refs.export_payroll_btn.disabled = false;
                }, 200);
            },

            extract_loans(loans, type){
                let total_loans = 0;
                for (const key in loans) {
                    if (Object.hasOwnProperty.call(loans, key)) {
                        const element = loans[key];
                        if(element.type_of_loan == type){
                            total_loans = (total_loans + parseFloat(element.monthly_due));
                        }
                        else if(element.type_of_loan == type){
                            total_loans = (total_loans + parseFloat(element.monthly_due));
                        }
                        else if(element.type_of_loan == type){
                            total_loans = (total_loans + parseFloat(element.monthly_due));
                        }
                    }
                }


                return total_loans.toFixed(2);
            },

            get_idd(id){
                let return_val = '<?php $_id = '.document.write(id).' ?>';
                return return_val;
            },


            async get_employee_details(employee, is_print=false){
                this.show_r_payroll_details = true;
                var emp = JSON.parse(employee);

                let form = new FormData;
                form.append('emp_id', emp.employee_id);
                await axios.post('/get-loan-reports', form)
                .then((response) => {
                    // console.log(this.get_idd(emp.payroll_id));
                    this.id = emp.payroll_id;
                    this.employee_id = emp.employee_id;
                    this.cutoff_id = emp.cutoff_id;
                    this.get_payroll_period(emp.cutoff_id);
                    this.employee_name = emp.last_name + ', ' + emp.first_name + ' ' + ((emp.middle_name) ? (emp.middle_name[0].toUpperCase() + '.')  : '' );
                    this.rate = emp.basic_rate;
                    this.working_days = emp.no_of_workingdays;
                    this.gross_pay = emp.gross_pay;
                    this.gross_pay = emp.gross_pay;
                    this.leave_pay = emp.leave_pay;
                    this.holiday_pay = emp.holiday_pay;
                    this.overtime_pay = emp.overtime_pay;
                    this.absences_amount = emp.absences_amount;
                    this.late_undertime_pay = emp.late_undertime_pay;
                    this.allowance = emp.allowance;
                    this.gross_pay = emp.gross_pay;
                    this.sss_contribution = emp.sss_contribution;
                    this.philhealth_contribution = emp.philhealth_contribution;
                    this.hdmf_contribution = emp.hdmf_contribution;
                    this.sss_loan = this.extract_loans(response.data, 'SSS Loan');
                    this.hdmf_loan = this.extract_loans(response.data, 'Pag-ibig Loan');
                    this.ef_loan = this.extract_loans(response.data, 'EF Loan');
                    this.ef_contribution = emp.ef_contribution;
                    this.total_deductions = emp.total_deductions;
                    this.net_salary = emp.net_salary;
                    this.remarks = emp.remarks;
                    this.employee_drs = emp.employees_dr;
                    this.other_company_dr = emp.dr_to_other_company;
                    this.duefrom = emp.due_from;
                    this.payroll_status = emp.status;
                });
            },

            clear_details (){

            },
        }));
    });
</script>

