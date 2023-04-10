<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Payroll Details' }}
    </x-slot>

    <div class="py-12" x-data="payroll2">
        @include('modules.payroll.view_employee_payroll')
        @include('modules.payroll.update_remarks')
        @include('modules.payroll.update_dr')
        @include('modules.payroll.print_payslip')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 border-b border-gray-200">
                <div class="flex flex-row items-center justify-between">
                    <a href="{{ route('view-payrolls', $id) }}" class="inline-flex items-center py-1.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-2 -ml-1 w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Refresh
                    </a>
                    <form action="{{ route('view-payrolls', $id) }}" method="GET" class="flex">
                        @csrf
                        <div class="flex flex-grow items-center w-full justify-end">
                            <div class="w-80">
                                <label for="search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none w-60">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <input type="text" id="search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('search') }}" placeholder="Search employees..." autocomplete="off" required>
                                </div>
                            </div>
                            <button type="submit" class="inline-flex items-center py-1.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>Search
                            </button>
                        </div>
                    </form>
                </div>

                <div class="text-center mt-5 overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left dark:text-gray-400">
                        <thead class="text-center text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="">
                                <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                    Employee Name
                                </th>
                                <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                    Gross Salary
                                </th>
                                <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                    Total Deductions
                                </th>
                                <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                    Net Salary
                                </th>
                                <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($payrolls)
                                @foreach ($payrolls as $payroll)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            {{ $payroll->Employee->first_name.', '.$payroll->Employee->last_name.' '.($payroll->Employee->middle_name ? strtoupper($payroll->Employee->middle_name[0]).'.' : '') }}
                                        </th>
                                        <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            &#x20B1; {{ number_format($payroll->gross_pay, 2, '.', ', ') }}
                                        </th>
                                        <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            &#x20B1; {{ number_format($payroll->total_deductions, 2, '.', ', ') }}
                                        </th>
                                        <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            &#x20B1; {{ number_format($payroll->net_salary, 2, '.', ', ') }}
                                        </th>
                                        <td class="flex flex-row justify-center pr-2">
                                            <button type="button" title="View Details" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-3 py-1 mx-1 my-2"
                                                x-on:click="
                                                    show_epayroll_details = true,
                                                    get_employee_details('{{$payroll}}')"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </button>
                                            <a href="{{ route('view-attendances', $payroll->Employee->employee_code) }}" title="View Attendances" target="_blank" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-1 my-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                </svg>
                                            </a>
                                            <button type="button" title="Print" class="text-white bg-gradient-to-r from-stone-400 via-stone-500 to-stone-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-stone-300 dark:focus:ring-stone-800 shadow-lg shadow-stone-500/50 dark:shadow-lg dark:shadow-stone-800/80 font-medium rounded-lg text-sm px-3 py-1 mx-1 my-2"

                                                x-on:click="print_payslip('{{$payroll}}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('payroll2', () => ({
            'show_epayroll_details': false,

            'update_remarks': false,
            'update_dr': false,

            'id': 0,
            'employee_id': 0,
            'cutoff_id': 0,
            'on_hover': false,
            'payroll_period': '',
            'employee_details': [],
            'employee_name': '',
            'employee_photo': '',
            'rate': '',
            'working_days': '',
            'gross_pay': '',
            'leave_pay': '',
            'holiday_pay': '',
            'overtime_pay': '',
            'absences_amount': '',
            'late_undertime_pay': '',
            'late_undertime_pay': '',
            'allowance': '',
            'gross_pay': '',
            'sss_contribution': '',
            'philhealth_contribution': '',
            'hdmf_contribution': '',
            'ef_contribution': '',
            'sss_loan': '',
            'hdmf_loan': '',
            'ef_loan': '',

            'total_deductions': '',
            'net_salary': '',
            'temp_remarks': '',
            'remarks': '',

            'employee_drs': '',
            'other_company_dr': '',
            'duefrom': '',

            'attendances': [],

            'dr_type': '',
            'dr_total_amount': 0,
            'dr_records': [],
            'otherdr_records': [],
            'duefrom_records': [],
            'dr_ids': [],
            'all_dr_ids': [],

            'update_msg': '',
            'loading_drs': false,
            'src':  '/images/generating.gif',
            'payroll_status': '',

            'changes_detected': false,
            print_payslip(employee){
                this.get_employee_details(employee, is_print=true);
                setTimeout(() => {
                    var printContents = this.$refs.payslip.innerHTML;
                    var originalContents = document.body.innerHTML;
                    document.body.innerHTML = printContents;
                    window.print();
                    document.body.innerHTML = originalContents;
                }, 500);
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
            extract_drs(drs){
                let total_drs = 0;
                for (const key in drs) {
                    if (Object.hasOwnProperty.call(drs, key)) {
                        const element = drs[key];
                        if(element.is_paid == 1){
                            total_drs = (total_drs + parseFloat(element.amount));
                        }
                    }
                }
                return total_drs.toFixed(2);
            },
            get_employee_details(employee, is_print=false){
                var emp = JSON.parse(employee);
                // console.log(emp);
                this.id = emp.payroll_id;
                this.employee_id = emp.employee_id;
                this.cutoff_id = emp.cutoff_id;
                this.get_payroll_period(emp.cutoff_id);
                this.employee_photo = '/storage/employee/'+emp.employee.employee_photo;
                this.employee_name = emp.employee.last_name + ', ' + emp.employee.first_name + ' ' + ((emp.employee.middle_name) ? (emp.employee.middle_name[0].toUpperCase() + '.')  : '' );
                this.rate = emp.employee_details.basic_rate;
                this.working_days = emp.no_of_workingdays;
                this.gross_pay = emp.gross_pay;
                this.gross_pay = emp.gross_pay;
                this.leave_pay = emp.leave_pay;
                this.holiday_pay = emp.holiday_pay;
                this.overtime_pay = emp.overtime_pay;
                this.absences_amount = emp.absences_amount;
                this.late_undertime_pay = emp.late_undertime_pay;
                this.allowance = emp.total_allowance;
                this.gross_pay = emp.gross_pay;
                this.sss_contribution = emp.employee_details.sss_contribution;
                this.philhealth_contribution = emp.employee_details.philhealth_contribution;
                this.hdmf_contribution = emp.employee_details.hdmf_contribution;
                this.sss_loan = this.extract_loans(emp.loans, 'SSS Loan');
                this.hdmf_loan = this.extract_loans(emp.loans, 'Pag-ibig Loan');
                this.ef_loan = this.extract_loans(emp.loans, 'EF Loan');
                this.ef_contribution = emp.employee_details.ef_contribution;
                this.total_deductions = emp.total_deductions;
                this.net_salary = emp.net_salary;
                this.remarks = emp.remarks;
                if(!is_print){
                    this.attendances = emp.attendances;
                }
                this.employee_drs = this.extract_drs(emp.employee_dr);
                this.other_company_dr = this.extract_drs(emp.other_company_dr);
                this.duefrom = this.extract_drs(emp.due_from);
                this.payroll_status = emp.status;
            },
            clear_details(){
                this.id = 0;
                this.employee_id = 0;
                this.employee_name = '';
                this.rate = '';
                this.working_days = '';
                this.gross_pay = '';
                this.gross_pay = '';
                this.leave_pay = '';
                this.holiday_pay = '';
                this.overtime_pay = '';
                this.absences_amount = '';
                this.late_undertime_pay = '';
                this.allowance = '';
                this.gross_pay = '';
                this.sss_contribution = '';
                this.philhealth_contribution = '';
                this.hdmf_contribution = '';
                this.sss_loan = '';
                this.hdmf_loan = '';
                this.ef_loan = '';
                this.ef_contribution = '';
                this.total_deductions = '';
                this.net_salary = '';
                this.temp_remarks = '';
                this.remarks = '';
                this.employee_drs = '';
                this.other_company_dr = '';
                this.duefrom = '';
                this.dr_type = '';
                this.payroll_status = '';
            },
            clear_drvalues(){
                this.update_dr = false;
                this.dr_total_amount = 0;
                this.dr_records = [];
                this.otherdr_records = [];
                this.duefrom_records = [];
                this.dr_type = '';
                this.all_dr_ids = [],
                this.dr_ids = [];
                this.loading_drs = false;
            },
            async f_update_remarks(){
                this.$refs.update_button.disabled = true;
                let form = new FormData;
                form.append('payroll_id', this.id);
                form.append('remarks', this.temp_remarks);

                await axios.post('/update-remarks', form)
                .then((response) => {
                    this.remarks = response.data;
                    this.update_remarks = false;
                    this.temp_remarks = '';
                    setTimeout(() => {
                        this.$refs.update_button.disabled = false;
                    }, 2000);
                },
                (error) => {
                    console.log(error);
                });
            },
            async f_update_drs(){
                this.$refs.dr_update_button.disabled = true;

                let form = new FormData;
                form.append('employee_id', this.employee_id);
                form.append('cutoff_id', this.cutoff_id);
                form.append('payroll_id', this.id);
                form.append('dr_ids', Object.values(this.dr_ids));

                let _url = (this.dr_type == 'Employee Dr' ? '/update-dr-values' : (this.dr_type == 'Other Dr' ? '/update-otherdr-values' : (this.dr_type == 'Due From' ? '/update-duefrom-values' : '')));

                await axios.post(_url, form)
                .then((response) => {
                    // console.log(response.data);

                    if(this.dr_type == 'Employee Dr'){
                        this.employee_drs = parseFloat(response.data.employees_dr).toFixed(2);
                    }
                    else if(this.dr_type == 'Other Dr'){
                        this.other_company_dr = parseFloat(response.data.employees_dr).toFixed(2);
                    }
                    else if(this.dr_type == 'Due From'){
                        this.duefrom = parseFloat(response.data.employees_dr).toFixed(2);
                    }

                    this.total_deductions = parseFloat(response.data.total_deductions).toFixed(2);
                    this.net_salary = parseFloat(response.data.net_salary).toFixed(2);

                    this.update_msg = 'Record Updated!';
                    setTimeout(() => {
                        this.update_dr = false;
                        this.update_msg = '';
                        this.$refs.dr_update_button.disabled = false;
                    }, 2000);
                });

            },
            async get_drs(dr_type){
                this.dr_type = dr_type;

                let form = new FormData;
                form.append('dr_type', dr_type);
                form.append('employee_id', this.employee_id);
                form.append('cutoff_id', this.cutoff_id);

                await axios.post('/show-drs', form)
                .then((response) => {
                    // console.log(response.data);
                    setTimeout(() => {
                        this.loading_drs = true;
                        this.dr_total_amount = 0;
                        this.dr_records = response.data;
                        for (const key in response.data) {
                            if (Object.hasOwnProperty.call(response.data, key)) {
                                const element = response.data[key];
                                this.all_dr_ids[key] = element.id;
                                if(element.is_paid == 1){
                                    this.dr_ids[key] = element.id;
                                    this.dr_total_amount = ((this.dr_total_amount) + parseFloat(element.amount));
                                }
                            }
                        }
                    }, 700);

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
            check_uncheck(row, flag){
                if(flag){
                    this.dr_total_amount = (this.dr_total_amount + parseFloat(row.amount));

                    let temp_ids = [];
                    let counter = 0;
                    // if(this.dr_type == 'Employee Dr'){
                    this.dr_ids[(this.dr_ids.length)] = row.id
                    // }
                    // console.log(this.dr_ids, this.dr_type);
                }
                else {
                    this.dr_total_amount = (this.dr_total_amount - parseFloat(row.amount));

                    // if(this.dr_type == 'Employee Dr'){
                    let temp_ids = this.dr_ids;
                    for (const key in this.dr_ids) {
                        if (Object.hasOwnProperty.call(this.dr_ids, key)) {
                            const element = this.dr_ids[key];
                            if(parseInt(row.id) == element){
                                temp_ids.splice(key, 1);
                                break;
                            }
                        }
                    }
                    this.dr_ids = temp_ids;
                    // }
                    // console.log(this.dr_ids, this.dr_type);
                }
            },
            check_uncheck_all(state_){
                let total_ = 0;
                if(this.dr_type == 'Employee Dr'){
                    for (const key in this.dr_records) {
                        if (Object.hasOwnProperty.call(this.dr_records, key)) {
                            const element = this.dr_records[key];
                            document.getElementById(element.id).checked = state_;
                            if(state_){
                                total_ = ((total_) + parseFloat(element.amount));
                            }
                        }
                    }
                    this.dr_total_amount = total_;
                    if(state_){
                        this.dr_ids = this.all_dr_ids;
                    }
                    else{
                        this.dr_ids = [];
                    }
                    // console.log(this.dr_ids);
                }
                else if(this.dr_type == 'Other Dr'){
                    for (const key in this.dr_records) {
                        if (Object.hasOwnProperty.call(this.dr_records, key)) {
                            const element = this.dr_records[key];
                            document.getElementById(element.id).checked = state_;
                        }
                    }
                }
                else if(this.dr_type == 'Due From'){
                    for (const key in this.dr_records) {
                        if (Object.hasOwnProperty.call(this.dr_records, key)) {
                            const element = this.dr_records[key];
                            document.getElementById(element.id).checked = state_;
                        }
                    }
                }
            },
            date_formatter(date_input){
                const MONTH_SHORT_NAMES = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                var time_series = [];
                var date_object = new Date(date_input);
                var month = date_object.getMonth();
                var day = date_object.getDate();
                var year = date_object.getFullYear();

                if (day.toString().length < 2)
                    day = '0' + day;

                //time_series[i] = (MONTH_SHORT_NAMES[month]+'-'+day+'-'+ year);
                date_ = (MONTH_SHORT_NAMES[month]+' '+day+', '+ year);
                return date_;
            }
        }));
    });
</script>
