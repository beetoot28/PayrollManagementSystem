<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Update Employee' }}
    </x-slot>

    <div class="flex flex-row items-center">
        <x-auth-validation-errors class="my-4 mx-auto" :errors="$errors" />
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="employees">
            <form method="POST" action="{{ route('update-employee', $employees->employee_id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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

                @if (session('error_message'))
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-md mt-2 px-3 py-3">
                        <span class="text-red-400 text-md font-bold">{{session()->get('error_message')}}</span>
                    </div>
                @endif


                @include('modules.employees.update-employee-tab')
                <input type="text" name="date_of_birth" x-model="birthdate" hidden>
                <input type="text" name="date_hired" x-model="date_hired" hidden>
                <input type="text" name="date_resigned" x-model="date_resigned" hidden>

                <div class="flex flex-row justify-between">
                    <div>
                        <button type="submit" class="mt-2 text-gray-900 bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:outline-none focus:ring-[#F7BE38]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2" onclick="this.disabled=true;this.form.submit();">
                            <!-- <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="paypal" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4 .7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9 .7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z"></path></svg> -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Update
                        </button>
                        <a href="{{ route('employee') }}" class="bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                            </svg>
                            Back
                        </a>
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
            </form>
        </div>
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
            'ot_pay': '{{ $employees->EmployeeDetails->with_ot_pay }}' == '0' ? false : true,

            'required_flag': '{{ strtolower($employees->EmployeeDetails->employment_status)}}' == 'active' ? false : true,
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
            set_dateresigned(){
                this.date_resigned = this.$refs.d_resigned.value;
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
            'birthdate': '{{ date('m/d/Y', strtotime($employees->date_of_birth)) }}',
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
            'date_hired': '{{ date('m/d/Y', strtotime($employees->EmployeeDetails->date_hired)) }}',
            'date_resigned': '{{ $employees->EmployeeDetails->date_resigned ? date('m/d/Y', strtotime($employees->EmployeeDetails->date_resigned)) : date('m/d/Y') }}',
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

            'invalid_filetype': false,
            'imageUrl': "{{ asset('storage/employee/'.$employees->employee_photo) }}",

            fileChosen_update(event) {
                // emp_photo_update
                var allowed_ext = ['jpeg', 'jpg', 'png', 'gif'];
                var uploaded_img_ext = '';
                var allowed = false;
                if(this.$refs.emp_photo_update){
                    uploaded_img_ext = this.$refs.emp_photo_update.value.split('.').pop();
                }
                for(let i = 0; i < allowed_ext.length; i++){
                    if(uploaded_img_ext.toLowerCase() == allowed_ext[i]){
                        allowed = true;
                        break;
                    }
                }

                if(allowed){
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                }
                else {
                    this.invalid_filetype = true;
                    setTimeout(() => {
                        this.invalid_filetype = false;
                    }, 2000);
                }
            },
            fileToDataUrl(event, callback) {
                if (! event.target.files.length) return

                let file = event.target.files[0];
                reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = e => callback(e.target.result);
            }
        }));
    });
</script>


