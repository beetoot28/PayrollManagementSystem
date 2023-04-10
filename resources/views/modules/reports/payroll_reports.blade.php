<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-show="active_tab == 4" x-transition:enter.duration.500ms style="display: none;"">
    <div class="overflow-hidden shadow-sm sm:rounded-lg h-5/6">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center p-2 rounded-md border border-green-500 w-full">
                <form action="" class="w-full flex-col space-y-2">
                    <input type="text" hidden id="export_payroll_flag" name="export_payroll_flag" value="{{ request()->query('export_payroll_flag') }}">
                    <div class="flex flex-col lg:flex-row w-full space-y-2 lg:space-y-0 lg:space-x-2">
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <input id="r_payroll_details" name="r_payroll_details" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_payroll_details') }}" autocomplete="off" placeholder="employee name">
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            <select id="r_payroll_department" name="r_payroll_department" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_payroll_department') }}" autocomplete="off">
                                @if (request()->query('r_payroll_department'))
                                    <option value="{{request()->query('r_payroll_department')}}" hidden selected>{{ request()->query('r_payroll_department') == 1  ? 'Sales Department' : (request()->query('r_payroll_department') == 2 ? 'Accounting Department' : (request()->query('r_payroll_department') == 3 ? 'Finance Department' : (request()->query('r_payroll_department') == 4 ? 'Logistics Department' : ''))) }}</option>
                                @else
                                    <option value="">Department</option>
                                @endif
                                <option value="1">Sales Department</option>
                                <option value="2">Accounting Department</option>
                                <option value="3">Finance Department</option>
                                <option value="4">Logistics Department</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                            </svg>
                            <select id="r_payroll_employment_status" name="r_payroll_employment_status" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_payroll_employment_status') }}" autocomplete="off">
                                @if (request()->query('r_payroll_employment_status'))
                                    <option value="{{request()->query('r_payroll_employment_status')}}" hidden selected>{{ request()->query('r_payroll_employment_status') == 1 ? 'Active' : (request()->query('r_payroll_employment_status') == 2 ? 'Resigned' : '') }}</option>
                                @else
                                    <option value="" hidden selected>Employment Status</option>
                                @endif
                                <option value="1">Active</option>
                                <option value="2">Resigned</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>
                            <select id="r_payroll_employee_status" name="r_payroll_employee_status" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_payroll_employee_status') }}" autocomplete="off">
                                @if (request()->query('r_payroll_employee_status'))
                                    <option value="{{request()->query('r_payroll_employee_status')}}" hidden selected>{{ request()->query('r_payroll_employee_status') == 1 ? 'Regular' : (request()->query('r_payroll_employee_status') == 2 ? 'Casual' : '') }}</option>
                                @else
                                    <option value="" hidden selected>Employee Status</option>
                                @endif
                                <option value="1">Regular</option>
                                <option value="2">Casual</option>
                            </select>
                        </div>
                    </div>
                    <div date-rangepicker class="flex flex-col lg:flex-row w-full space-y-2 lg:space-y-0 lg:space-x-2">
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <input id="r_payroll_startdate" name="r_payroll_startdate" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_payroll_startdate') }}" autocomplete="off" placeholder="start date">
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <input id="r_payroll_enddate" name="r_payroll_enddate" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_payroll_enddate') }}" autocomplete="off" placeholder="end date">
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            {{-- <span>{{App\Models\Cutoff::find(192)->cutoff_date}}</span> --}}
                            <select id="r_payroll_cutoff" name="r_payroll_cutoff" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_payroll_cutoff') }}" autocomplete="off">
                                @if (request()->query('r_payroll_cutoff'))
                                    <option value="{{request()->query('r_payroll_cutoff')}}" hidden>{{ date('F j, Y', strtotime(App\Models\Cutoff::find(request()->query('r_payroll_cutoff'))->cutoff_date)) }}</option>
                                @else
                                    <option value="" hidden selected>Cutoff</option>
                                @endif
                                @if ($cutoffs)
                                    @foreach ($cutoffs as $cutoff)
                                        <option value="{{ $cutoff->cutoff_id }}">{{ date('F j, Y', strtotime($cutoff->cutoff_date)) }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                            </svg>
                            <select id="r_payroll_cycle" name="r_payroll_cycle" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_payroll_cycle') }}" autocomplete="off">
                                @if (request()->query('r_payroll_cycle'))
                                    <option value="{{request()->query('r_payroll_cycle')}}" hidden>{{request()->query('r_payroll_cycle')}}</option>
                                @else
                                    <option value="" hidden selected>Cycle</option>
                                @endif
                                <option value="15th">15th</option>
                                <option value="30th">30th</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row space-x-2">
                            <button type="submit" x-on:click="document.getElementById('export_payroll_flag').value = null" class="flex flex-row jsutify-center items-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white px-2 border border-green-500 hover:border-transparent rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                                Search
                            </button>
                            @if ($flag_reset_refresh_payroll)
                                <a href="{{ route('reports') }}" class="flex flex-row jsutify-center items-center bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white px-2 border border-orange-500 hover:border-transparent rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    Reset
                                </a>
                            @else
                                <button type="reset" class="flex flex-row jsutify-center items-center bg-transparent hover:bg-orange-500 text-orange-700 font-semibold hover:text-white px-2 border border-orange-500 hover:border-transparent rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    Reset
                                </button>
                            @endif
                        </div>
                        <button type="submit" class="flex flex-row justify-center items-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white px-2 border border-green-500 hover:border-transparent rounded-md" x-ref="export_payroll_btn" x-on:click="export_excel('export_payroll_flag')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Export to Excel
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-5 overflow-x-auto relative shadow-md rounded-lg">
                <table class="w-full text-sm text-left dark:text-gray-400">
                    <thead class="text-center text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="">
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Employee Name
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Department
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Employment Status
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Employee Status
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
                                Cutoff Date
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
                                        {{ $payroll->first_name.', '.$payroll->last_name.' '.($payroll->middle_name ? strtoupper($payroll->middle_name[0]).'.' : '') }}
                                    </th>
                                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ $payroll->department }}
                                    </th>
                                    <td class="pr-7 text-center">
                                        {{ $payroll->employment_status }}
                                    </td>
                                    <td class="pr-7 text-center">
                                        {{ $payroll->employee_status }}
                                    </td>
                                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        &#x20B1; {{ number_format($payroll->gross_pay, 2, '.', ', ') }}
                                    </th>
                                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        &#x20B1; {{ number_format($payroll->total_deductions, 2, '.', ', ') }}
                                    </th>
                                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        &#x20B1; {{ number_format($payroll->net_salary, 2, '.', ', ') }}
                                    </th>
                                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ date('F j, Y', strtotime($payroll->cutoff_date)) }}
                                    </th>
                                    <td class="flex flex-row justify-center pr-2">
                                        <button type="button" title="View Details" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-3 py-1 mx-1 my-2"
                                            x-on:click="get_employee_details('{{$payroll}}') ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                        <a href="{{ route('view-attendances', $payroll->employee_code) }}" title="View Attendances" target="_blank" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-1 my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                        </a>
                                        {{-- <button type="button" title="Print" class="text-white bg-gradient-to-r from-stone-400 via-stone-500 to-stone-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-stone-300 dark:focus:ring-stone-800 shadow-lg shadow-stone-500/50 dark:shadow-lg dark:shadow-stone-800/80 font-medium rounded-lg text-sm px-3 py-1 mx-1 my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                            </svg>
                                        </button> --}}
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
