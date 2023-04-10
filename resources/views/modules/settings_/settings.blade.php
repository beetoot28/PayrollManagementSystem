<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Settings' }}
    </x-slot>


    <div class="py-12" x-data="settings">
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
                            Holidays Computations
                        </button>
                    </li>
                </ul>
            </div>
            @include('modules.settings.configure_authorization')
            @include('modules.settings.employees_dr')
        </div>
        {{-- NEW MODALS --}}
        @include('modules.settings.new_employee_dr')
    </div>
</x-app-layout>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('settings', () => ({
            'auth_error': false,
            'empdr_error': false,

            'auth_success': false,
            'empdr_success': false,

            'settings_msg': '',

            'active_tab': '{{ $active_tab }}',

            'employee_id': '',

            // Employee DR
            's_note_dr': '',

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
                        await axios.post('/settings-set-authcode', form)
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
                if(this.$refs.s_employee_name_dr.value && this.$refs.s_amount_dr.value){
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

            'employees': @json($employees),
            'filtered_employees': [],
            'click_emp': false,
            'search_emp': false,
            'message': '',
            show_suggestion(){
                this.filtered_employees = [];
                var emp = @json($employees);
                var index = 0;
                for (const key in emp) {
                    if (Object.hasOwnProperty.call(emp, key)) {
                        const emp_record = ((emp[key].last_name) +' '+ (emp[key].first_name) +' '+ ((emp[key].middle_name)));
                        const result = emp_record.toLowerCase().includes((this.$refs.s_employee_name_dr.value).toLowerCase());
                        if(result){
                            this.filtered_employees[index] = emp[key];
                            index++;
                        }
                    }
                }
            },

            'new_employee_dr': false,
        }));
    });
</script>

