<x-app-layout>
    <x-slot name="title">
        {{ $title = 'View Employee Details' }}
    </x-slot>

    <div class="flex flex-row items-center">
        <x-auth-validation-errors class="my-4 mx-auto" :errors="$errors" />
    </div>


    <div class="py-12" x-data="employees">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('store-employee') }}">
                @csrf

                {{-- Tabs --}}
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="mr-2">
                            <button type="button" :class="[tab_1 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                            x-on:click="tab_1 = true, tab_2 = false, tab_3 = false, tab_4 = false, tab_5 = false">
                                Basic Details
                            </button>
                        </li>
                        <li class="mr-2">
                            <button type="button" :class="[tab_2 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                            x-on:click="tab_1 = false, tab_2 = true, tab_3 = false, tab_4 = false, tab_5 = false">
                                Contact Details
                            </button>
                        </li>
                        <li class="mr-2">
                            <button type="button" :class="[tab_3 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                            x-on:click="tab_1 = false, tab_2 = false, tab_3 = true, tab_4 = false, tab_5 = false">
                                Work Details
                            </button>
                        </li>
                        <li class="mr-2">
                            <button type="button" :class="[tab_4 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                            x-on:click="tab_1 = false, tab_2 = false, tab_3 = false, tab_4 = true, tab_5 = false">
                                Contribution and Loans
                            </button>
                        </li>
                        <li class="mr-2">
                            <button type="button" :class="[tab_5 ? 'inline-block p-4 text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : 'inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300']"
                            x-on:click="tab_1 = false, tab_2 = false, tab_3 = false, tab_4 = false, tab_5 = true">
                                Other Details
                            </button>
                        </li>
                    </ul>
                </div>
                {{-- End Tabs --}}

                {{-- Error Message --}}
                <template x-if="error_message">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-md mt-2 px-3 py-3">
                        <span x-text="error_message" class="text-red-400 text-md"></span>
                    </div>
                </template>

                @include('modules.employees.view-employee-tab')
                {{-- <input type="text" name="date_of_birth" x-model="birthdate" hidden>
                <input type="text" name="date_hired" x-model="date_hired" hidden> --}}

                {{-- Buttons --}}
                <div class="flex flex-row justify-between">
                    <div>
                        <a href="{{ route('employee') }}" class="mt-2 bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
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
                    <div>
                        <button type="button" class="mt-2 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2"
                        x-on:click="previous_tab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                            </svg>
                            Previous
                        </button>
                        <button type="button" class="mt-2 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-7 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2"
                        x-on:click="next_tab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Next
                        </button>
                    </div>
                </div>
                {{-- End Buttons --}}
            </form>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('employees', () => ({
            'tab_1': true,
            'tab_2': false,
            'tab_3': false,
            'tab_4': false,
            'tab_5': false,
            'error_message': '',
            'b_type': '',
            previous_tab(){
                if(this.tab_2){
                    this.tab_1 = true;
                    this.tab_2 = false;
                    this.tab_3 = false;
                    this.tab_4 = false;
                    this.tab_5 = false;
                }
                else if(this.tab_3){
                    this.tab_1 = false;
                    this.tab_2 = true;
                    this.tab_3 = false;
                    this.tab_4 = false;
                    this.tab_5 = false;
                }
                else if(this.tab_4){
                    this.tab_1 = false;
                    this.tab_2 = false;
                    this.tab_3 = true;
                    this.tab_4 = false;
                    this.tab_5 = false;
                }
                else if(this.tab_5){
                    this.tab_1 = false;
                    this.tab_2 = false;
                    this.tab_3 = false;
                    this.tab_4 = true;
                    this.tab_5 = false;
                }
            },
            next_tab(){
                if(this.tab_1){
                    this.tab_1 = false;
                    this.tab_2 = true;
                    this.tab_3 = false;
                    this.tab_4 = false;
                    this.tab_5 = false;
                }
                else if(this.tab_2){
                    this.tab_1 = false;
                    this.tab_2 = false;
                    this.tab_3 = true;
                    this.tab_4 = false;
                    this.tab_5 = false;
                }
                else if(this.tab_3){
                    this.tab_1 = false;
                    this.tab_2 = false;
                    this.tab_3 = false;
                    this.tab_4 = true;
                    this.tab_5 = false;
                }
                else if(this.tab_4){
                    this.tab_1 = false;
                    this.tab_2 = false;
                    this.tab_3 = false;
                    this.tab_4 = false;
                    this.tab_5 = true;
                }
            },
            compute_age(){
                if(this.age == 0)
                {
                    this.age = '';
                }
                var split_bday = this.$refs.bday.value.split('/');
                /*
                 * split_bday[0] = month
                 * split_bday[1] = day
                 * split_bday[2] = year
                 */

                // Birthdate Object
                var birthdate = new Date(split_bday[2], split_bday[0], split_bday[1]);
                //  Current Date Object
                var current_date = new Date();


                // Compute age based on birthdate
                // current year - birth year
                var computed_age = (current_date.getFullYear() - birthdate.getFullYear());
                this.age =  computed_age;
                this.birthdate = this.$refs.bday.value;
            },
            set_datehired(){
                this.date_hired = this.$refs.d_hired.value;
            },
            check_details(){
                // Check if all required fields are not empty
                if(
                    // // Tab 1
                    this.employee_status && this.first_name && this.last_name && this.age && this.birthdate && this.gender && this.mobile_no && this.nationality &&

                    // Tab 2
                    this.barangay && this.city && this.province &&

                    // //Tab 3
                    this.employee_number && this.department && this.basic_rate && this.allowance && this.leave_pay && this.position && this.date_hired && this.employment_status &&
                    this.sss_no && this.philhealth_no && this.tin_no && this.hdmf_no &&

                    // // Tab 4
                    this.sss_contribution && this.philhealth_contribution && this.ef_contribution && this.pagibig_contribution &&

                    // // Tab 5
                    this.marital_status && this.number_of_children && this.spouse_name && this.spouse_occupation && this.emergency_number && this.contact_person && this.contact_person_address && this.dependant
                ){
                    this.b_type = 'submit'
                }
                else{
                    this.b_type = 'button';
                    this.error_message = 'Please fill up all required fields';
                }
            },

            // Tab 1
            'employee_status': '',
            'first_name': '',
            'middle_name': '',
            'last_name': '',
            'age': 0,
            'birthdate': '',
            'gender': '',
            'mobile_no': '',
            'nationality': '',

            // Tab 2
            'block_house_no': '',
            'street': '',
            'barangay': '',
            'city': '',
            'province': '',

            // Tab 3
            'employee_number': '',
            'department': '',
            'basic_rate': '',
            'allowance': '',
            'leave_pay': '',
            'position': '',
            'pwposition': '',
            'date_hired': '',
            'date_resigned': '',
            'employment_status': '',
            'sss_no': '',
            'philhealth_no': '',
            'tin_no': '',
            'hdmf_no': '',

            // Tab 4
            'sss_contribution': 0,
            'philhealth_contribution': 0,
            'ef_contribution': 0,
            'pagibig_contribution': 0,

            // Tab 5
            'marital_status': '',
            'number_of_children': '',
            'spouse_name': '',
            'spouse_occupation': '',
            'emergency_number': '',
            'contact_person': '',
            'contact_person_address': '',
            'dependant': '{{ $employees->EmployeeDetails->dependant }}',
        }));
    });
</script>
