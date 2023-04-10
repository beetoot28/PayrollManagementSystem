<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Payroll' }}
    </x-slot>

    <div class="py-12" x-data="payroll">
        @include('modules.payroll.post')
        <!-- SHOW AUTHORIZATION CODE -->
        <div style="display: none;" x-show="no_click_allowed">
            <div class="inline-flex items-center justify-center w-full h-full z-20 top-0 absolute bg-gray-50 bg-opacity-50">
                <div class="flex flex-col items-center justify-center" x-show="show_loading_process">
                    <div>
                        <img :src="src" alt="" class="h-9 w-9">
                    </div>
                    <span class="" x-text="payroll_msg"></span>
                </div>

                <div class="w-1/3 bg-white rounded-lg shadow-md opacity-100 p-3 relative" style="display: none;" x-show="show_authorization_code">
                    <div class="flex flex-row justify-center" :class="[code_error ? '' : 'invisible']">
                        <span class="absolute text-md  text-red-400" x-text="payroll_msg"></span>
                    </div>
                    <div class="flex justify-end">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 font-semibold hover:text-red-300 cursor-pointer" @click="show_authorization_code = false, no_click_allowed = false, $refs.passcode_input.value = ''">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="px-5 flex flex-col items-center mx-auto justify-center w-full mt-3">
                        <label for="pass_code" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Enter passcode</label>
                        <input type="password" id="pass_code" name="pass_code" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 text-center" value="" required autocomplete="off" x-ref="passcode_input" autofocus @keyup.enter="verify_authorization_code">
                    </div>
                    <div class="flex flex-col items-center justify-center mt-4 px-5">
                        <button type="button" class="mx-auto w-full rounded-lg px-5 py-2 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-0 active:bg-blue-800 transition duration-150 ease-in-out" x-on:click="verify_authorization_code" x-ref="passcode_button">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex flex-row justify-between w-full">
                        <div class="flex flex-row items-center w-full justify-between">
                            {{-- <select name="p_cutoff_date" id="p_cutoff_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-1/2 lg:w-1/4 px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                x-ref="p_cutoff_date">
                                <template x-if="qualified_cutoff_dates">
                                    <template x-for="cutoff_date in qualified_cutoff_dates">
                                        <option :value="cutoff_date.cutoff_id" x-text="date_formatter(cutoff_date.cutoff_date)"></option>
                                    </template>
                                </template>
                            </select> --}}
                            <span x-ref="p_cutoff_date" :value="qualified_cutoff_dates" hidden></span>
                            <button type="button" class="text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-1.5 text-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40"
                                {{$qualified_cutoff_dates ? '' : 'disabled' }}
                                x-on:click="check_existing_attendances, $nextTick(() => $refs.passcode_input.focus())">
                                Generate Payroll
                            </button>
                            {{-- <button x-on:click="test_date">
                                click ME
                            </button> --}}
                            {{-- <form action="/payrolls-store" method="POST">
                                @csrf
                                <input type="text" name="cutoff_id" id="cutoff_id" value="192" hidden>
                                <button type="submit">Test Store</button>
                            </form> --}}
                            <template x-if="payroll_error">
                                <div class="bg-red-50 overflow-hidden shadow-sm sm:rounded-md px-4 py-1 ml-2 text-center">
                                    <span class="text-red-400 text-md font-bold" x-text="payroll_msg"></span>
                                </div>
                            </template>
                            <div class="flex">
                                <div class="mb-1 w-full">
                                    <form action="{{ route('payroll') }}" method="GET" class="flex flex-row lg:space-x-2">
                                        <input datepicker datepicker-autohide id="p_start_date" name="p_start_date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('p_start_date') }}" autocomplete="off" placeholder="start cutoff date">
                                        <input datepicker datepicker-autohide id="p_end_date" name="p_end_date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('p_end_date') }}" autocomplete="off" placeholder="end cutoff cate">
                                        <button type="submit" class="px-2 flex flex-row items-center text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg aria-hidden="true" class="w-5 h-5  dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                            <span class="ml-1">Search</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5 overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left dark:text-gray-400">
                            <thead class="text-center text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="">
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Date Generated
                                    </th>
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Cutoff Date
                                    </th>
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Payroll Cycle
                                    </th>
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Total Net Pay
                                    </th>
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Status
                                    </th>
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($payroll_records)
                                    @foreach($payroll_records as $payroll)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ date('F j, Y', strtotime($payroll->created_at)) }}
                                            </th>
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ date('F j, Y', strtotime($payroll->Cutoff->cutoff_date)) }}
                                            </th>
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ $payroll->payroll_cycle }}
                                                {{-- {{ (date('d', strtotime($payroll->Cutoff->cutoff_date))) >= 1 && (date('d', strtotime($payroll->Cutoff->cutoff_date))) <= 15 ? '15th' : '30th' }} --}}
                                            </th>
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                <span hidden>{{$net_salary = 0}}</span>
                                                @foreach(App\Models\Payroll::where('cutoff_id', $payroll->cutoff_id)->get() as $key => $value)
                                                    <span hidden>{{ $net_salary = ($net_salary + $value->net_salary) }}</span>
                                                @endforeach
                                                &#x20B1; {{number_format($net_salary, 2, '.', ', ')}}
                                            </th>
                                            <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                                {{ $payroll->status == 0 ? '--' : 'POSTED' }}
                                            </th>
                                            <td class="flex flex-row justify-center pr-2">
                                                <a href="{{ route('view-payrolls', $payroll->cutoff_id) }}" title="View" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-4 py-1 mx-1 my-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                </a>
                                                <button type="button" title="Post" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-1 my-2" {{$payroll->status == 1 ? 'hidden' : ''}} x-on:click="show_post = true, cutoff_id = '{{$payroll->cutoff_id}}'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="pt-2 px-2">
                        {{-- {{ $attendances->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('payroll', () => ({
            'cutoff_id': 0,
            'code_error': false,
            'payroll_error': false,
            'payroll_msg': '',
            'show_loading_process': false,
            'show_authorization_code': false,
            'qualified_cutoff_dates': @json($qualified_cutoff_dates),
            'no_click_allowed': false,
            'show_post': false,
            'src':  '/images/generating.gif',

            // 'qualified_cutoff_dates': @json($qualified_cutoff_dates),
            check_existing_attendances(){
                if(this.qualified_cutoff_dates){
                    this.no_click_allowed = true;
                    this.show_authorization_code = true;
                }
                else{
                    this.payroll_error = true;
                    this.payroll_msg = 'Nothing to generate';

                    setTimeout(() => {
                        this.payroll_error = false;
                        this.payroll_msg = '';
                    }, 1000);
                }
            },
            async verify_authorization_code(){
                this.show_authorization_code = true;
                if(this.$refs.passcode_input.value){
                    this.$refs.passcode_button.disabled = true;
                    // qualified_cutoff_dates
                    let form = new FormData;
                    form.append('authorization_code', this.$refs.passcode_input.value);

                    await axios.post('/verify-authorization-code', form)
                    .then((response) => {
                        if(response.data == true) {
                            this.$refs.passcode_input.value = '';
                            setTimeout(() => {
                                this.show_authorization_code = false;
                                this.$refs.passcode_button.disabled = false;
                            }, 200);

                            let form_cutoff = new FormData;
                            form_cutoff.append('cutoff_id', this.$refs.p_cutoff_date.value);
                            axios.post('/check-currentdate', form_cutoff)
                            .then((response_) => {
                                if(response_.data == false){
                                    setTimeout(() => {
                                        this.show_loading_process = true;
                                    }, 300);
                                    this.generate_payroll();
                                }
                                else{
                                    this.no_click_allowed = false;
                                    this.payroll_error = true;
                                    this.payroll_msg = 'Please check the date of your computer';

                                    setTimeout(() => {
                                        this.payroll_error = false;
                                        this.payroll_msg = '';
                                    }, 2000);
                                }
                            },
                            (error) => {
                                console.log(error);
                            });
                        }
                        else if(response.data == false){
                            this.code_error = true;
                            this.payroll_msg = 'Invalid Passcode';
                        }
                    },
                    (error) => {
                        console.log(error);
                    });
                }
                else {
                    this.code_error = true;
                    this.payroll_msg = 'Passcode must not be empty';
                }

                setTimeout(() => {
                    this.code_error = false;
                    this.payroll_msg = '';
                }, 2000);
            },
            // GENERATION OF PAYROLL
            async generate_payroll(){
                this.payroll_msg = 'Generating Payroll...';

                let payroll_form = new FormData;
                payroll_form.append('cutoff_id', this.$refs.p_cutoff_date.value);
                await axios.post('/payrolls-store', payroll_form)
                .then((response) => {
                    // console.log(response.data);
                    setTimeout(() => {
                        // this.no_click_allowed = false;
                        // this.show_loading_process = false;
                        this.src = '/images/done.png';
                        this.payroll_msg = 'Payroll Generated Successfully!';
                    }, 2000);

                    setTimeout(() => {
                        window.location = "/payroll";
                    }, 2000);
                },
                (error) => {
                    console.log(error);
                });
            },
            async check_date(){
                let form = new FormData;
                form.append('cutoff_id', this.$refs.p_cutoff_date.value);
                await axios.post('check-currentdate', form)
                .then((response) => {
                    return response.data;
                },
                (error) => {
                    console.log(error);
                });
            },
            date_formatter(date_input){
                const MONTH_SHORT_NAMES = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                var date_object = new Date(date_input);

                var month = date_object.getMonth();
                var day = date_object.getDate();
                var year = date_object.getFullYear();
                if (day.toString().length < 2)
                    day = '0' + day;

                const converted_date = (MONTH_SHORT_NAMES[month]+' '+day+', '+ year);
                return converted_date;
            },
            test_date(){
                axios.get('/test_date_')
                .then((response) => {
                    console.log(response.data);
                });
            },
            async post_transaction(){
                this.$refs.post_button.disabled = true;

                let post_form = new FormData;
                post_form.append('cutoff_id', this.cutoff_id);
                await axios.post('/post-payroll', post_form)
                .then((response) => {
                    if(response.data == true){
                        this.payroll_msg = 'Transaction posted successfully!';
                        setTimeout(() => {
                            this.payroll_msg = '';
                            window.location = '/payroll';
                        }, 2000);
                    }
                    else {
                        this.$refs.post_button.disabled = false;
                        this.payroll_msg = 'Error, please contact your system provider!';
                        setTimeout(() => {
                            this.payroll_msg = '';
                        }, 2000);
                    }
                });
            }
        }));
    });
</script>
