<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: none;" x-show="active_tab == 2">
    <div class="overflow-hidden shadow-sm sm:rounded-lg h-5/6">
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-row justify-between items-center">
                <div class="flex flex-row">
                    <input id="s_amount_dr" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="" x-ref="s_amount_dr" autocomplete="off">
                    <button type="button" class="ml-2 px-3 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" x-on:click="save_employees_dr" x-ref="submit_employees_dr">
                        Search
                    </button>
                </div>
                <button type="button" class="px-4 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 py-2" x-on:click="new_employee_dr = true">
                    New
                </button>
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
                        @foreach($employees_dr as $emp_record)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $emp_record->Employee->first_name.' '.$emp_record->Employee->middle_name.', '.$emp_record->Employee->last_name }}
                                </th>
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $emp_record->EmployeeDetails->department }}
                                </th>
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    @foreach (App\Models\EmployeeDr::where('employee_id', $emp_record->employee_id)->get() as $key => $dr_record)
                                        <span class="hidden">{{$total_amount = $total_amount + $dr_record->amount}}</span>
                                        @if (sizeOf(App\Models\EmployeeDr::where('employee_id', $emp_record->employee_id)->get()) -1 == ($key))
                                            {{ '₱ '.$total_amount}}
                                        @endif
                                    @endforeach
                                    <span class="hidden">{{$total_amount = 0}}</span>
                                </th>
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ date('F j, Y', strtotime((App\Models\EmployeeDr::where('employee_id', $emp_record->employee_id)->orderBy('created_at', 'desc')->first()->created_at))) }}
                                </th>
                                <td class="flex flex-row justify-center pr-2">
                                    <a href="{{ route('view-attendances', 1) }}" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-4 py-1 mx-1 my-2">View</a>
                                    <a href="" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-1 my-2">Print</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            {{-- <div class="pt-2 px-2">
                {{ $attendances->links() }}
            </div> --}}
        </div>
    </div>
</div>
