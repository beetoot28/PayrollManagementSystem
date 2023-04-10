<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: none;" x-show="active_tab == 3" x-transition:enter.duration.500ms>
    <div class="overflow-hidden shadow-sm sm:rounded-lg h-5/6">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <form class="flex flex-row" action="{{ route('settings') }}" method="GET">
                    <input id="ocdr_search" name="ocdr_search" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('ocdr_search') }}" autocomplete="off">
                    <button type="submit" class="ml-2 px-3 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Search
                    </button>
                </form>
                <button type="button" class="ml-2 px-3 py-1.5 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" x-on:click="new_dr_other_company = true"> New </button>
            </div>

            <div class="text-center mt-5 overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left dark:text-gray-400">
                    <thead class="text-center text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="">
                            <th scope="col" class="py-2 px-6 whitespace-nowrap">
                                Employee Name
                            </th>
                            <th scope="col" class="py-2 px-6 whitespace-nowrap">
                                Department
                            </th>
                            <th scope="col" class="py-2 px-6 whitespace-nowrap">
                                Total Amount
                            </th>
                            <th scope="col" class="py-2 px-6 whitespace-nowrap">
                                Date
                            </th>
                            <th scope="col" class="py-2 px-6 whitespace-nowrap">
                                Options
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($other_company_dr as $emp_record_ocdr)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $emp_record_ocdr->Employee->first_name.' '.$emp_record_ocdr->Employee->middle_name.', '.$emp_record_ocdr->Employee->last_name }}
                                </th>
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $emp_record_ocdr->EmployeeDetails->department }}
                                </th>
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    @foreach (App\Models\OtherCompanyDr::where('employee_id', $emp_record_ocdr->employee_id)->get() as $key => $dr_record)
                                        <span class="hidden">{{$total_amount = $total_amount + $dr_record->amount}}</span>
                                        @if (sizeOf(App\Models\OtherCompanyDr::where('employee_id', $emp_record_ocdr->employee_id)->get()) -1 == ($key))
                                            {{ '₱ '.$total_amount}}
                                        @endif
                                    @endforeach
                                    <span class="hidden">{{$total_amount = 0}}</span>
                                </th>
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ date('F j, Y', strtotime((App\Models\OtherCompanyDr::where('employee_id', $emp_record_ocdr->employee_id)->orderBy('created_at', 'desc')->first()->created_at))) }}
                                </th>
                                <td class="flex items-center">
                                    <a href="{{ route('view-employee-ocdr', $emp_record_ocdr->employee_id) }}" title="View" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-4 py-1 mx-1 my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    {{-- <form action="{{ route('view-employee-dr', ) }}" method="GET">
                                        <input type="text" name="view_dr" value="{{ $emp_record_ocdr->employee_id }}" class="hidden">
                                        <button type="submit" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-4 py-1 mx-1 my-2">View</button>
                                    </form> --}}
                                    {{-- <button class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-1 my-2">Print</button> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="pt-2 px-2">
                {{ $employees_dr->links() }}
            </div>
        </div>
    </div>
</div>
