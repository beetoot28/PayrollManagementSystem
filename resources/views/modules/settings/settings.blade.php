<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Settings' }}
    </x-slot>


    <div class="py-12 relative h-full" x-data="settings" x-init="custom_pagination">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px">
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 1 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(1)">
                            Authorization Code
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 2 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(2)">
                        Employees DR
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 3 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(3)">
                            DR to other Company
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" :class="[active_tab == 4 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                        x-on:click="set_active_tab(4)">
                            Due From
                        </button>
                    </li>
                    <li class="mr-2">
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
                    </li>
                </ul>
            </div>
            @include('modules.settings.configure_authorization')
            @include('modules.settings.holiday_computations.holiday_computations')
            @include('modules.settings.holidays.holidays')
            {{-- @include('modules.settings.leave_pays.leave_pay') --}}

            @if ($view_dr)
                @include('modules.settings.employees_dr.view_employee_dr')
            @else
                @include('modules.settings.employees_dr.employees_dr')
            @endif

            @if ($view_ocdr)
                @include('modules.settings.dr_other_company.view_employee_ocdr')
            @else
                @include('modules.settings.dr_other_company.dr_other_company')
            @endif

            @if ($view_duefrom)
                @include('modules.settings.due_from.view_employee_duefrom')
            @else
                @include('modules.settings.due_from.due_from')
            @endif

            @if ($view_leavepay)
                @include('modules.settings.leave_pays.view_leave_pay')
            @else
                @include('modules.settings.leave_pays.leave_pay')
            @endif

            {{-- <div x-show="!flag_viewdr">

            </div>
            <div x-show="flag_viewdr">

            </div> --}}
        </div>

        {{-- NEW MODAL --}}
        @include('modules.settings.employees_dr.new_employee_dr')
        @include('modules.settings.dr_other_company.new_dr_other_company')
        @include('modules.settings.due_from.new_due_from')
        @include('modules.settings.holidays.new_holiday')
        @include('modules.settings.leave_pays.new_leave_pay')

        {{-- EDIT MODAL --}}
        @include('modules.settings.update_record')
        @include('modules.settings.leave_pays.update_leave_pay')
        @include('modules.settings.holidays.edit_holiday')
        {{-- DELETE MODAL --}}
        @include('modules.settings.delete_record')

    </div>
</x-app-layout>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('settings', () => ({
            'auth_error': false,
            'empdr_error': false,
            'ch_error': false,

            'auth_success': false,
            'empdr_success': false,
            'ch_success': false,

            'settings_msg': '',

            'active_tab': '{{ $active_tab }}',

            'employee_id': '',

            'view_delete_flag': '',

            'modal_title': '',

            // variables for edit
            's_id': '',
            's_date': '',
            's_amount': '',
            's_note': '',

            // View Record
            'update_record': false,

            // Delete Record
            'delete_record': false,

            // Employee DR Notes
            's_note_dr': '',
            's_note_ocdr': '',
            's_note_duefrom': '',
            's_note_duefrom': '',
            's_note_leavepay': '',

            // VIEW DR
            'flag_viewdr': '{{ $view_dr ? true : false }}',

            //Holiday Computations
            'holiday_computations': @json($holiday_computations),

            'holidays': @json($holidays),
            'holiday_id': '',

            // For Leave Pay
            'update_record_leavepay': false,

            async set_active_tab(_input){
                let form = new FormData;
                form.append('tab_value', _input);
                await axios.post('/set-active-tab', form)
                .then((response) => {
                    this.active_tab = parseInt(response.data);
                },
                (error) => {
                    console.log(error);
                });
            },
            async save_authorization_code(){
                // console.log();
                this.$refs.submit_authcode.disabled = true;
                if(this.$refs.s_auth_code.value || this.$refs.s_confirm_auth_code.value) {
                    if(this.$refs.s_auth_code.value == this.$refs.s_confirm_auth_code.value) {
                        let form =  new FormData;
                        form.append('pass_code', this.$refs.s_auth_code.value);
                        await axios.post('/settings_set_authcode', form)
                        .then((response) => {
                            console.log(response.data);
                            this.$refs.s_auth_code.value = '';
                            this.$refs.s_confirm_auth_code.value = '';

                            this.auth_success = true;
                            this.settings_msg = 'Passcode changed';

                            setTimeout(() => {
                                this.auth_success = '';
                                this.settings_msg = '';
                            }, 2000);

                        },
                        (error) => {
                            console.log(error);
                        });

                        setTimeout(() => {
                            this.$refs.submit_authcode.disabled = false;
                        }, 1500);
                    }
                    else if(this.$refs.s_auth_code.value != this.$refs.s_confirm_auth_code.value) {
                        this.auth_error = true;
                        this.settings_msg = 'Passcode don\'t match!';

                        setTimeout(() => {
                            this.auth_error = false;
                            this.settings_msg = '';
                        }, 2000);

                        setTimeout(() => {
                            this.$refs.submit_authcode.disabled = false;
                        }, 1500);
                    }
                }
                else {
                    this.auth_error = true;
                    this.settings_msg = 'Please fill up required fields!';

                    setTimeout(() => {
                        this.auth_error = false;
                        this.settings_msg = '';
                    }, 2000);

                    setTimeout(() => {
                        this.$refs.submit_authcode.disabled = false;
                    }, 1500);
                }
            },
            async save_employees_dr(){
                this.$refs.submit_employees_dr.disabled = true;
                if(this.$refs.s_employee_name_dr.value && this.$refs.s_amount_dr.value && this.s_note_dr){
                    let form = new FormData;
                    form.append('employee_id', this.employee_id);
                    form.append('amount', this.$refs.s_amount_dr.value);
                    form.append('note', this.s_note_dr);

                    await axios.post('/employee-dr-store', form)
                    .then((response) => {
                        this.empdr_success = true;
                        this.settings_msg = 'Transaction successfully saved';

                        setTimeout(() => {
                            this.empdr_success = false;
                            this.settings_msg = '';

                        }, 2000);

                        window.location.href="/settings";
                    });
                }
                else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';
                    this.$refs.submit_employees_dr.disabled = false;
                }


                setTimeout(() => {
                    this.empdr_error = false;
                    this.settings_msg = '';
                }, 2000);
            },
            async save_employees_ocdr(){
                this.$refs.submit_employees_ocdr.disabled = true;
                if(this.$refs.s_employee_name_ocdr.value && this.$refs.s_amount_ocdr.value && this.s_note_ocdr){
                    let form = new FormData;
                    form.append('employee_id', this.employee_id);
                    form.append('amount', this.$refs.s_amount_ocdr.value);
                    form.append('note', this.s_note_ocdr);

                    await axios.post('/employee-ocdr-store', form)
                    .then((response) => {
                        this.empdr_success = true;
                        this.settings_msg = 'Transaction successfully saved';

                        setTimeout(() => {
                            this.empdr_success = false;
                            this.settings_msg = '';

                        }, 2000);

                        window.location.href="/settings";
                    });
                }
                else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';
                    this.$refs.submit_employees_ocdr.disabled = false;
                }


                setTimeout(() => {
                    this.empdr_error = false;
                    this.settings_msg = '';
                }, 2000);
            },
            async save_employees_duefrom(){
                this.$refs.submit_employees_duefrom.disabled = true;
                if(this.$refs.s_employee_name_duefrom.value && this.$refs.s_amount_duefrom.value && this.s_note_duefrom){
                    let form = new FormData;
                    form.append('employee_id', this.employee_id);
                    form.append('amount', this.$refs.s_amount_duefrom.value);
                    form.append('note', this.s_note_duefrom);

                    await axios.post('/employee-duefrom-store', form)
                    .then((response) => {
                        this.empdr_success = true;
                        this.settings_msg = 'Transaction successfully saved';

                        setTimeout(() => {
                            this.empdr_success = false;
                            this.settings_msg = '';

                        }, 2000);

                        window.location.href="/settings";
                    });
                }
                else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';
                    this.$refs.submit_employees_duefrom.disabled = false;
                }


                setTimeout(() => {
                    this.empdr_error = false;
                    this.settings_msg = '';
                }, 2000);
            },
            async save_employees_leavepay(){
                this.$refs.submit_employees_leavepay.disabled = true;
                if(this.$refs.s_employee_name_leavepay.value && this.$refs.s_numberofdays_leavepay.value && this.$refs.s_start_date.value && this.$refs.s_end_date.value && this.s_note_leavepay){
                    let form = new FormData;
                    form.append('employee_id', this.employee_id);
                    form.append('number_of_days', this.$refs.s_numberofdays_leavepay.value);
                    form.append('start_date', this.$refs.s_start_date.value);
                    form.append('end_date', this.$refs.s_end_date.value);
                    form.append('note', this.s_note_leavepay);

                    await axios.post('/employee-leavepay-store', form)
                    .then((response) => {
                        console.log(response.data);
                        if (response.data == true) {
                            this.empdr_success = true;
                            this.settings_msg = 'Transaction successfully saved';

                            setTimeout(() => {
                                this.empdr_success = false;
                                this.settings_msg = '';

                            }, 2000);

                            window.location.href="/settings";
                        }
                        else {
                            this.empdr_success = true;
                            this.settings_msg = response.data;

                            setTimeout(() => {
                                this.empdr_success = false;
                                this.settings_msg = '';

                            }, 2000);

                            this.$refs.submit_employees_leavepay.disabled = false;
                        }


                    });
                }
                else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';
                    this.$refs.submit_employees_leavepay.disabled = false;
                }


                setTimeout(() => {
                    this.empdr_error = false;
                    this.settings_msg = '';
                }, 2000);
            },
            async save_update_employees_dr(){
                this.$refs.submit_update_employees_dr.disabled = true;
                let form = new FormData;
                form.append('emp_id', '{{ $view_dr_record ? $view_dr_record->employee_id : '' }}');
                form.append('id', this.s_id);
                form.append('amount', this.s_amount);
                form.append('note', this.s_note);

                if (this.s_id && this.s_amount && this.s_note) {
                    await axios.post('/update-employee-dr', form)
                    .then((response) => {
                        this.s_id = '';
                        this.s_amount = '';
                        this.s_note = '';

                        this.empdr_success = true;
                        this.settings_msg = 'Record successfully updated';

                        setTimeout(() => {
                            this.empdr_success = false;
                            this.settings_msg = '';
                        }, 2000);

                        window.location.href="/view-employee-dr/{{ $view_dr_record ? $view_dr_record->employee_id : '' }}";
                    },
                    (error) => {
                        console.log(error);
                    });
                }
                else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';

                    setTimeout(() => {
                        this.empdr_error = false;
                        this.settings_msg = '';
                        this.$refs.submit_update_employees_dr.disabled = false;
                    }, 2000);
                }

            },
            async save_update_employees_ocdr(){
                this.$refs.submit_update_employees_dr.disabled = true;
                let form = new FormData;
                form.append('emp_id', '{{ $view_ocdr_record ? $view_ocdr_record->employee_id : '' }}');
                form.append('id', this.s_id);
                form.append('amount', this.s_amount);
                form.append('note', this.s_note);

                if (this.s_id && this.s_amount && this.s_note) {
                    await axios.post('/update-employee-ocdr', form)
                    .then((response) => {
                        this.s_id = '';
                        this.s_amount = '';
                        this.s_note = '';

                        this.empdr_success = true;
                        this.settings_msg = 'Record successfully updated';

                        setTimeout(() => {
                            this.empdr_success = false;
                            this.settings_msg = '';
                        }, 2000);

                        window.location.href="/view-employee-ocdr/{{ $view_ocdr_record ? $view_ocdr_record->employee_id : '' }}";
                    },
                    (error) => {
                        console.log(error);
                    });
                }
                else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';

                    setTimeout(() => {
                        this.empdr_error = false;
                        this.settings_msg = '';
                        this.$refs.submit_update_employees_dr.disabled = false;
                    }, 2000);
                }
            },
            async save_update_employees_duefrom(){
                this.$refs.submit_update_employees_dr.disabled = true;
                let form = new FormData;
                form.append('emp_id', '{{ $view_duefrom_record ? $view_duefrom_record->employee_id : '' }}');
                form.append('id', this.s_id);
                form.append('amount', this.s_amount);
                form.append('note', this.s_note);
                if (this.s_id && this.s_amount && this.s_note) {
                    await axios.post('/update-employee-duefrom', form)
                    .then((response) => {
                        this.s_id = '';
                        this.s_amount = '';
                        this.s_note = '';

                        this.empdr_success = true;
                        this.settings_msg = 'Record successfully updated';

                        setTimeout(() => {
                            this.empdr_success = false;
                            this.settings_msg = '';
                        }, 2000);

                        window.location.href="/view-employee-duefrom/{{ $view_duefrom_record ? $view_duefrom_record->employee_id : '' }}";
                    },
                    (error) => {
                        console.log(error);
                    });
                }
                else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';

                    setTimeout(() => {
                        this.empdr_error = false;
                        this.settings_msg = '';
                        this.$refs.submit_update_employees_dr.disabled = false;
                    }, 2000);
                }
            },
            async save_update_employees_leavepay(){
                this.$refs.submit_update_employees_leavepay.disabled = true;
                let form = new FormData;
                form.append('emp_id', '{{ $view_leavepay_record ? $view_leavepay_record->employee_id : '' }}');
                form.append('id', this.s_id);
                // form.append('number_of_days', this.$refs.e_numberofdays_leavepay.value);
                form.append('leave_date', this.$refs.e_leave_date.value);
                // form.append('end_date', this.$refs.e_end_date.value);
                form.append('note', this.s_note);
                if (this.$refs.e_leave_date.value && this.s_note) {
                    await axios.post('/update-employee-leavepay', form)
                    .then((response) => {
                        console.log(response.data);
                        if(response.data == true){
                            this.s_id = '';
                            this.s_amount = '';
                            this.s_note = '';

                            this.empdr_success = true;
                            this.settings_msg = 'Record successfully updated';

                            setTimeout(() => {
                                this.empdr_success = false;
                                this.settings_msg = '';
                            }, 2000);

                            window.location.href="/view-employee-leavepay/{{ $view_leavepay_record ? $view_leavepay_record->employee_id : '' }}";
                        }
                        else {
                            this.empdr_success = true;
                            this.settings_msg = response.data;

                            setTimeout(() => {
                                this.empdr_success = false;
                                this.settings_msg = '';

                            }, 2000);

                            this.$refs.submit_update_employees_leavepay.disabled = false;
                        }
                    },
                    (error) => {
                        console.log(error);
                    });
                }
                else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';

                    setTimeout(() => {
                        this.empdr_error = false;
                        this.settings_msg = '';
                        this.$refs.submit_update_employees_leavepay.disabled = false;
                    }, 2000);
                }
            },
            async save_delete_employee_dr(){
                this.$refs.submit_delete_employees_dr.disabled = true;
                let form = new FormData;
                form.append('emp_id', '{{ $view_dr_record ? $view_dr_record->employee_id : '' }}');
                form.append('id', this.s_id);

                await axios.post('/delete-employee-dr', form)
                .then((response) => {
                    this.s_id = '';
                    this.s_amount = '';
                    this.s_note = '';

                    this.empdr_success = true;
                    this.settings_msg = 'Record successfully deleted';

                    setTimeout(() => {
                        this.empdr_success = false;
                        this.settings_msg = '';
                    }, 2000);
                    console.log({{ $view_dr_record ? $view_dr_record->employee_id : '' }});
                    window.location.href="/view-employee-dr/{{ $view_dr_record ? $view_dr_record->employee_id : '' }}";
                },
                (error) => {
                    console.log(error);
                })
            },
            async save_delete_employee_ocdr(){
                this.$refs.submit_delete_employees_dr.disabled = true;
                let form = new FormData;
                form.append('emp_id', '{{ $view_ocdr_record ? $view_ocdr_record->employee_id : '' }}');
                form.append('id', this.s_id);

                await axios.post('/delete-employee-ocdr', form)
                .then((response) => {
                    this.s_id = '';
                    this.s_amount = '';
                    this.s_note = '';

                    this.empdr_success = true;
                    this.settings_msg = 'Record successfully deleted';

                    setTimeout(() => {
                        this.empdr_success = false;
                        this.settings_msg = '';
                    }, 2000);
                    window.location.href="/view-employee-ocdr/{{ $view_ocdr_record ? $view_ocdr_record->employee_id : '' }}";
                },
                (error) => {
                    console.log(error);
                })
            },
            async save_delete_employee_duefrom(){
                this.$refs.submit_delete_employees_dr.disabled = true;
                let form = new FormData;
                form.append('emp_id', '{{ $view_duefrom_record ? $view_duefrom_record->employee_id : '' }}');
                form.append('id', this.s_id);

                await axios.post('/delete-employee-duefrom', form)
                .then((response) => {
                    this.s_id = '';
                    this.s_amount = '';
                    this.s_note = '';

                    this.empdr_success = true;
                    this.settings_msg = 'Record successfully deleted';

                    setTimeout(() => {
                        this.empdr_success = false;
                        this.settings_msg = '';
                    }, 2000);
                    window.location.href="/view-employee-duefrom/{{ $view_duefrom_record ? $view_duefrom_record->employee_id : '' }}";
                },
                (error) => {
                    console.log(error);
                })
            },
            async save_delete_leavepay(){
                this.$refs.submit_delete_employees_dr.disabled = true;
                let form = new FormData;
                form.append('emp_id', '{{ $view_leavepay_record ? $view_leavepay_record->employee_id : '' }}');
                form.append('id', this.s_id);

                await axios.post('/delete-employee-leavepay', form)
                .then((response) => {
                    this.s_id = '';
                    this.s_amount = '';
                    this.s_note = '';

                    this.empdr_success = true;
                    this.settings_msg = 'Record successfully deleted';

                    setTimeout(() => {
                        this.empdr_success = false;
                        this.settings_msg = '';
                    }, 2000);
                    window.location.href="/view-employee-leavepay/{{ $view_leavepay_record ? $view_leavepay_record->employee_id : '' }}";
                },
                (error) => {
                    console.log(error);
                })
            },

            'new_employee_dr': false,
            'new_dr_other_company': false,
            'new_due_from': false,
            'new_holiday': false,
            'edit_holiday': false,
            'delete_holiday': false,
            'new_leave_pay': false,

            'employees': @json($employees),
            'filtered_employees': [],
            'click_emp': false,
            'search_emp': false,
            'message': '',
            show_suggestion(value_){
                this.filtered_employees = [];
                var emp = @json($employees);
                var index = 0;
                for (const key in emp) {
                    if (Object.hasOwnProperty.call(emp, key)) {
                        const emp_record = ((emp[key].last_name) +' '+ (emp[key].first_name) +' '+ ((emp[key].middle_name)));
                        const result = emp_record.toLowerCase().includes((value_).toLowerCase());

                        if(result){
                            this.filtered_employees[index] = emp[key];
                            index++;
                        }
                    }
                }
            },

            // Holiday Computations
            'computation_id': 0,
            'ch_input_edit': false,
            'ch_input_disabled': true,
            'ebutton_id': 0,
            'ubutton_id': 0,
            'cbutton_id': 0,
            'current_id': 0,

            generate_input_id(val, index){
                const id = ('cf'+val+'_'+(index+1)).toString();
                return id;
            },
            generate_ebutton_id(index){
                const id = ('ch_e'+index).toString();
                return id;
            },
            generate_ubutton_id(index){
                const id = ('ch_u'+index).toString();
                return id;
            },
            generate_cbutton_id(index){
                const id = ('ch_c'+index).toString();
                return id;
            },
            edit_holiday_computations(eid, uid, cid, index){
                if(this.ubutton_id != 0){
                    document.getElementById(this.ebutton_id).disabled = false;
                    document.getElementById(this.ebutton_id).hidden = false;

                    document.getElementById(this.ubutton_id).disabled = true;
                    document.getElementById(this.ubutton_id).hidden = true;
                    document.getElementById(this.cbutton_id).disabled = true;
                    document.getElementById(this.cbutton_id).hidden = true;

                    for (let _index = 2; _index < 8; _index++) {
                        const input_id = this.generate_input_id(_index, this.current_id);
                        document.getElementById(input_id).disabled = true;
                    }
                }

                setTimeout(() => {
                    this.ebutton_id = eid;
                    this.ubutton_id = uid;
                    this.cbutton_id = cid;
                    this.current_id = index;

                    // Hide previously clicked
                    document.getElementById(eid).disabled = true;
                    document.getElementById(eid).hidden = true;

                    document.getElementById(uid).disabled = true;
                    document.getElementById(uid).hidden = true;
                    document.getElementById(cid).disabled = true;
                    document.getElementById(cid).hidden = true;

                    document.getElementById(uid).disabled = false;
                    document.getElementById(uid).hidden = false;
                    document.getElementById(cid).disabled = false;
                    document.getElementById(cid).hidden = false;

                    for (let _index = 2; _index < 8; _index++) {
                        const input_id = this.generate_input_id(_index, index);
                        document.getElementById(input_id).disabled = false;
                    }
                }, 100);
            },
            cancel_holiday_computations(eid, uid, cid, index){
                // Hide previously clicked
                document.getElementById(eid).disabled = false;
                document.getElementById(eid).hidden = false;

                document.getElementById(uid).disabled = true;
                document.getElementById(uid).hidden = true;
                document.getElementById(cid).disabled = true;
                document.getElementById(cid).hidden = true;

                for (let _index = 2; _index < 8; _index++) {
                    const input_id = this.generate_input_id(_index, index);
                    document.getElementById(input_id).disabled = true;
                }
                this.holiday_computations = @json($holiday_computations);
                this.ch_error = false;
                this.settings_msg = '';
            },
            update_holiday_computations(index, computation_id, eid, uid, cid){
                let proceed = true;
                if(index == 0){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value){
                        proceed = false;
                    }
                }
                else if(index == 1){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value){
                        proceed = false;
                    }
                }
                else if(index == 2){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value){
                        proceed = false;
                    }
                }
                else if(index == 3){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    const id4 = this.generate_input_id(5, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value || !document.getElementById(id4).value){
                        proceed = false;
                    }
                }
                else if(index == 4){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value){
                        proceed = false;
                    }
                }
                else if(index == 5){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    const id4 = this.generate_input_id(5, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value || !document.getElementById(id4).value){
                        proceed = false;
                    }
                }
                else if(index == 6){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value){
                        proceed = false;
                    }
                }
                else if(index == 7){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value){
                        proceed = false;
                    }
                }
                else if(index == 8){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    const id4 = this.generate_input_id(5, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value || !document.getElementById(id4).value){
                        proceed = false;
                    }
                }
                else if(index == 9){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    const id4 = this.generate_input_id(5, index);
                    const id5 = this.generate_input_id(6, index);
                    const id6 = this.generate_input_id(7, index);
                    const id7 = this.generate_input_id(8, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value || !document.getElementById(id4).value || !document.getElementById(id5).value || !document.getElementById(id6).value || !document.getElementById(id7).value){
                        proceed = false;
                    }
                }
                else if(index == 10){
                    const id = this.generate_input_id(2, index);
                    const id2 = this.generate_input_id(3, index);
                    const id3 = this.generate_input_id(4, index);
                    const id4 = this.generate_input_id(5, index);
                    const id5 = this.generate_input_id(6, index);
                    const id6 = this.generate_input_id(7, index);
                    if(!document.getElementById(id).value || !document.getElementById(id2).value || !document.getElementById(id3).value || !document.getElementById(id4).value || !document.getElementById(id5).value || !document.getElementById(id6).value){
                        proceed = false;
                    }
                }

                if(proceed){
                    const computation_field2 = this.generate_input_id(2, index);
                    const computation_field3 = this.generate_input_id(3, index);
                    const computation_field4 = this.generate_input_id(4, index);
                    const computation_field5 = this.generate_input_id(5, index);
                    const computation_field6 = this.generate_input_id(6, index);
                    const computation_field7 = this.generate_input_id(7, index);

                    let form = new FormData;
                    form.append('computation_id', computation_id);
                    form.append('computation_field2', document.getElementById(computation_field2).value);
                    form.append('computation_field3', document.getElementById(computation_field3).value);
                    form.append('computation_field4', document.getElementById(computation_field4).value);
                    form.append('computation_field5', document.getElementById(computation_field5).value);
                    form.append('computation_field6', document.getElementById(computation_field6).value);
                    form.append('computation_field7', document.getElementById(computation_field7).value);

                    for (let _index = 2; _index < 8; _index++) {
                        const input_id = this.generate_input_id(_index, index);
                        document.getElementById(input_id).disabled = true;
                    }

                    axios.post('/update-holiday-computations', form)
                    .then((response) => {
                        this.holiday_computations = response.data;
                    },
                    (response) => {
                        console.log(error);
                    })

                    document.getElementById(eid).disabled = false;
                    document.getElementById(eid).hidden = false;

                    document.getElementById(uid).disabled = true;
                    document.getElementById(uid).hidden = true;
                    document.getElementById(cid).disabled = true;
                    document.getElementById(cid).hidden = true;

                    this.ch_error = false;
                    this.ch_success = true;
                    this.settings_msg = 'Record successfully updated';

                    setTimeout(() => {
                        this.ch_success = false;
                        this.settings_msg = '';
                    }, 2000);
                }
                else{
                    this.ch_error = true;
                    this.settings_msg = 'Input field must be empty!';
                }
            },
            holiday_date_formatter(date_input){
                const MONTH_SHORT_NAMES = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                const WEEKDAYS = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

                var date_object = new Date(date_input);

                var month = date_object.getMonth();
                var day = date_object.getDate();
                var year = date_object.getFullYear();
                var week_day = date_object.getDay();

                if (day.toString().length < 2)
                    day = '0' + day;

                const converted_date = (MONTH_SHORT_NAMES[month]+' '+day+', '+ year) +' '+ ((WEEKDAYS[week_day]).toUpperCase());
                return converted_date;
            },
            holiday_date_formatter_dateinput(date_input){
                const MONTH_SHORT_NAMES = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                var date_object = new Date(date_input);

                var month = date_object.getMonth();
                var day = date_object.getDate();
                var year = date_object.getFullYear();

                if (day.toString().length < 2)
                    day = '0' + day;

                month = month + 1;
                if (month.toString().length < 2)
                    month = '0' + month;

                const converted_date = ((month)+'/'+day+'/'+ year);
                return converted_date;
            },
            holiday_type(_type){
                let return_val = null;
                if (_type == 0) {
                    return_val = 'Special Holiday'
                }
                else if(_type == 1) {
                    return_val = 'Legal Holiday'
                }
                else if(_type == 2) {
                    return_val = 'Double Legal Holiday'
                }
                return return_val;
            },
            async save_holiday(_id){
                this.$refs.submit_holiday.disabled = true;

                if(this.$refs.h_date.value && this.$refs.h_type.value && this.$refs.h_name.value){
                    let form = new FormData;
                    form.append('holiday_date', this.$refs.h_date.value);
                    form.append('holiday_type', this.$refs.h_type.value);
                    form.append('holiday_name', this.$refs.h_name.value);

                    await axios.post('/holiday-store', form)
                    .then((response) => {
                        this.holidays = response.data;

                        this.$refs.h_date.value = '';
                        this.$refs.h_type.value = '';
                        this.$refs.h_name.value = '';

                        this.new_holiday = false;
                        this.$refs.submit_holiday.disabled = false;
                    },
                    (error) => {
                        console.log(error);
                    });
                }
                else{
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';
                    this.$refs.submit_holiday.disabled = false;

                    setTimeout(() => {
                        this.empdr_error = false;
                        this.settings_msg = '';
                        this.$refs.submit_holiday.disabled = false;
                    }, 2000);
                }
            },
            async save_update_holiday(_id){
                this.$refs.submit_update_holiday.disabled = true;
                if (this.$refs.hu_date.value && this.$refs.hu_type.value && this.$refs.hu_name.value) {
                    let form = new FormData;
                    form.append('holiday_id', this.holiday_id);
                    form.append('holiday_date', this.$refs.hu_date.value);
                    form.append('holiday_type', this.$refs.hu_type.value);
                    form.append('holiday_name', this.$refs.hu_name.value);

                    await axios.post('/holiday-update', form)
                    .then((response) => {
                        this.holidays = response.data;

                        this.$refs.submit_update_holiday.disabled = false;
                        this.edit_holiday = false;

                        this.holiday_id = '';
                        this.$refs.hu_date.value = '';
                        this.$refs.hu_type.value = '';
                        this.$refs.hu_name.value = '';
                    },
                    (error) => {
                        console.log(error);
                    });
                } else {
                    this.empdr_error = true;
                    this.settings_msg = 'Please fill up required fields!';

                    setTimeout(() => {
                        this.empdr_error = false;
                        this.settings_msg = '';
                        this.$refs.submit_update_holiday.disabled = false;
                    }, 2000);
                }
            },
            async save_delete_holiday(){
                this.$refs.submit_delete_employees_dr.disabled = true;

                let form =  new FormData;
                form.append('holiday_id', this.holiday_id);

                await axios.post('/delete-holiday', form)
                .then((response) => {
                    this.holidays = response.data;

                    this.$refs.submit_delete_employees_dr.disabled = false;
                    this.delete_record = false;
                },
                (error) => {
                    console.log(error);
                });
            },




            // Pagination Javascript
            'search': "",
            'pageNumber': 0,
            'size': 5,
            'total': "",
            // 'myForData': this.holidays,
            // function loadEmployees() {
            //     return {
            //     search: "",
            //     pageNumber: 0,
            //     size: 10,
            //     total: "",
            //     myForData: sourceData,

            custom_pagination() {
                const start = this.pageNumber * this.size,
                end = start + this.size;

                // if (this.search === "") {
                this.total = this.holidays.length;
                return this.holidays.slice(start, end);
                // }

                // //Return the total results of the filters
                // this.total = this.myForData.filter((item) => {
                // return item.employee_name
                //     .toLowerCase()
                //     .includes(this.search.toLowerCase());
                // }).length;

                // //Return the filtered data
                // return this.myForData
                // .filter((item) => {
                //     return item.employee_name
                //     .toLowerCase()
                //     .includes(this.search.toLowerCase());
                // })
                // .slice(start, end);
            },

            //Create array of all pages (for loop to display page numbers)
            pages() {
                return Array.from({
                    length: Math.ceil(this.total / this.size),
                });
            },

            //Next Page
            nextPage() {
                this.pageNumber++;
            },

            //Previous Page
            prevPage() {
                this.pageNumber--;
            },

            //Total number of pages
            pageCount() {
                return Math.ceil(this.total / this.size);
            },

            //Return the start range of the paginated results
            startResults() {
                return this.pageNumber * this.size + 1;
            },

            //Return the end range of the paginated results
            endResults() {
                let resultsOnPage = (this.pageNumber + 1) * this.size;

                if (resultsOnPage <= this.total) {
                    return resultsOnPage;
                }

                return this.total;
            },

            //Link to navigate to page
            viewPage(index) {
                this.pageNumber = index;
            },
        }));
    });
</script>

