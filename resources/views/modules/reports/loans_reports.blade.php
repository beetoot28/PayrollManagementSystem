<div class="max-w-7xl mx-auto sm:px-6 lg:px-8"  x-show="active_tab == 3" x-transition:enter.duration.500ms style="display: none;">
    <div class="overflow-hidden shadow-sm sm:rounded-lg h-5/6">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center p-2 rounded-md border border-green-500 w-full">
                <form action="" class="w-full flex-col space-y-2">
                    <input type="text" hidden id="export_loan_flag" name="export_loan_flag" value="{{ request()->query('export_loan_flag') }}">
                    <div class="flex flex-col lg:flex-row w-full space-y-2 lg:space-y-0 lg:space-x-2">
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <input id="r_loan_details" name="r_loan_details" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_details') }}" autocomplete="off" placeholder="employee name">
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            <select id="r_loan_department" name="r_loan_department" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_department') }}" autocomplete="off">
                                @if (request()->query('r_loan_department'))
                                    <option value="{{request()->query('r_loan_department')}}" hidden selected>{{ request()->query('r_loan_department') == 1  ? 'Sales Department' : (request()->query('r_loan_department') == 2 ? 'Accounting Department' : (request()->query('r_loan_department') == 3 ? 'Finance Department' : (request()->query('r_loan_department') == 4 ? 'Logistics Department' : ''))) }}</option>
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
                            <select id="r_loan_employment_status" name="r_loan_employment_status" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_employment_status') }}" autocomplete="off">
                                @if (request()->query('r_loan_employment_status'))
                                    <option value="{{request()->query('r_loan_employment_status')}}" hidden selected>{{ request()->query('r_loan_employment_status') == 1 ? 'Active' : (request()->query('r_loan_employment_status') == 2 ? 'Resigned' : '') }}</option>
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
                            <select id="r_loan_employee_status" name="r_loan_employee_status" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_employee_status') }}" autocomplete="off">
                                @if (request()->query('r_loan_employee_status'))
                                    <option value="{{request()->query('r_loan_employee_status')}}" hidden selected>{{ request()->query('r_loan_employee_status') == 1 ? 'Regular' : (request()->query('r_loan_employee_status') == 2 ? 'Casual' : '') }}</option>
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
                            <input id="r_loan_startdate" name="r_loan_startdate" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_startdate') }}" autocomplete="off" placeholder="start date">
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <input id="r_loan_enddate" name="r_loan_enddate" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_enddate') }}" autocomplete="off" placeholder="end date">
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            <select id="r_loan_type" name="r_loan_type" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_type') }}" autocomplete="off">
                                @if (request()->query('r_loan_type'))
                                    <option value="{{request()->query('r_loan_type')}}" hidden selected>
                                        {{ request()->query('r_loan_type') == 1 ? 'SSS Loan' : (request()->query('r_loan_type') == 2 ? 'EF Loan' : (request()->query('r_loan_type') == 3 ? 'Pag-ibig Loan' : ''))}}
                                    </option>
                                @else
                                    <option value="" hidden selected>Loan Type</option>
                                @endif
                                <option value="1">SSS Loan</option>
                                <option value="2">EF Loan</option>
                                <option value="3">Pag-ibig Loan</option>
                            </select>
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z" />
                            </svg>

                            <select id="r_loan_term" name="r_loan_term" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_term') }}" autocomplete="off">
                                @if (request()->query('r_loan_term'))
                                    <option value="{{request()->query('r_loan_term')}}" hidden selected>{{ request()->query('r_loan_term').' months' }}</option>
                                @else
                                    <option value="" hidden selected>Loan Terms</option>
                                @endif
                                @if ($loan_terms)
                                    @foreach ($loan_terms as $loan_term)
                                        <option value="{{$loan_term}}">{{ $loan_term.' months' }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col lg:flex-row w-full lg:w-1/4 space-y-2 lg:space-y-0 lg:space-x-2 lg:pr-2">
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                            </svg>
                            <select id="r_loan_paid" name="r_loan_paid" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_loan_paid') }}" autocomplete="off">
                                @if (request()->query('r_loan_paid'))
                                    <option value="{{request()->query('r_loan_paid')}}" hidden>{{request()->query('r_loan_paid') == 1 ? 'Paid' : (request()->query('r_loan_paid') == 2 ? 'Unpaid' : '')}}</option>
                                @else
                                    <option value="" selected hidden>Loan Status</option>
                                @endif
                                <option value="1">Paid</option>
                                <option value="2">Unpaid</option>

                            </select>
                        </div>
                    </div>

                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row space-x-2">
                            <button type="submit" x-on:click="document.getElementById('export_loan_flag').value = null" class="flex flex-row jsutify-center items-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white px-2 border border-green-500 hover:border-transparent rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                                Search
                            </button>
                            @if ($flag_reset_refresh_loan)
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
                        <button type="submit" class="flex flex-row justify-center items-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white px-2 border border-green-500 hover:border-transparent rounded-md" x-ref="export_loan_btn" x-on:click="export_excel('export_loan_flag')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Export to Excel
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-5 overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left dark:text-gray-400">
                    <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="">
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Loan Application No.
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Employee Name
                            </th>
                            <th scope="col" class="px-9 whitespace-nowrap">
                                Department
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Employment Status
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Employee Status
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Type of Loan
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap text-center">
                                Loan Terms
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Amount
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $loan->loan_application_no }}
                                </th>
                                <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $loan->first_name.' '.$loan->last_name.' '.($loan->middle_name ? strtoupper($loan->middle_name[0]).'.' : '') }}
                                </th>
                                <td class="pr-7 text-center">
                                    {{ $loan->department }}
                                </td>
                                <td class="pr-7 text-center">
                                    {{ $loan->employment_status }}
                                </td>
                                <td class="pr-7 text-center">
                                    {{ $loan->employee_status }}
                                </td>
                                <td class="pr-7 text-center">
                                    {{ $loan->type_of_loan }}
                                </td>
                                <td class="pr-2 text-center">
                                    {{ $loan->loan_terms.' months' }}
                                </td>
                                <td class="pr-5 text-center">
                                    {{ $loan->loan_amount }}
                                </td>
                                <td class="flex flex-row justify-center py-7">
                                    <a href="{{ route('view-loans', $loan->loan_id) }}" title="View" target="_blank" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-1 mr-2 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('edit-loans', $loan->loan_id) }}" title="Edit" target="_blank" class="text-white bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-1 mr-2 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                    {{-- <a href="" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-1 mr-2 mb-2">Print</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="pt-2 px-2">
                {{ $loans->links() }}
            </div>

        </div>
    </div>
</div>
