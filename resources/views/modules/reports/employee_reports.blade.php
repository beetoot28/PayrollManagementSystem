<div class="max-w-7xl mx-auto sm:px-6 lg:px-8"  x-show="active_tab == 1" x-transition:enter.duration.500ms style="display: none;">
    <div class="overflow-hidden shadow-sm sm:rounded-lg h-5/6">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center p-2 rounded-md border border-green-500 w-full">
                <form action="" class="w-full flex-col space-y-2">
                    <input type="text" hidden id="export_emp_flag" name="export_emp_flag" value="{{ request()->query('export_emp_flag') }}">
                    <div class="flex flex-col lg:flex-row w-full space-y-2 lg:space-y-0 lg:space-x-2">
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <input id="r_emp_details" name="r_emp_details" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_emp_details') }}" autocomplete="off" placeholder="employee details">
                        </div>
                        <div class="w-full flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute w-5 h-5 ml-1 text-green-800">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            <select id="r_emp_department" name="r_emp_department" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_emp_department') }}" autocomplete="off">
                                @if (request()->query('r_emp_department'))
                                    <option value="{{request()->query('r_emp_department')}}" hidden selected>{{ request()->query('r_emp_department') == 1  ? 'Sales Department' : (request()->query('r_emp_department') == 2 ? 'Accounting Department' : (request()->query('r_emp_department') == 3 ? 'Finance Department' : (request()->query('r_emp_department') == 4 ? 'Logistics Department' : ''))) }}</option>
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
                            <select id="r_emp_employment_status" name="r_emp_employment_status" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_emp_employment_status') }}" autocomplete="off">
                                @if (request()->query('r_emp_employment_status'))
                                    <option value="{{request()->query('r_emp_employment_status')}}" hidden selected>{{ request()->query('r_emp_employment_status') == 1 ? 'Active' : (request()->query('r_emp_employment_status') == 2 ? 'Resigned' : '') }}</option>
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
                            <select id="r_emp_employee_status" name="r_emp_employee_status" type="text" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block pl-7 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('r_emp_employee_status') }}" autocomplete="off" placeholder="employee name">
                                @if (request()->query('r_emp_employee_status'))
                                    <option value="{{request()->query('r_emp_employee_status')}}" hidden selected>{{ request()->query('r_emp_employee_status') == 1 ? 'Regular' : (request()->query('r_emp_employee_status') == 2 ? 'Casual' : '') }}</option>
                                @else
                                    <option value="" hidden selected>Employee Status</option>
                                @endif
                                <option value="1">Regular</option>
                                <option value="2">Casual</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row space-x-2">
                            <button type="submit" x-on:click="document.getElementById('export_emp_flag').value = null" class="flex flex-row jsutify-center items-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white px-2 border border-green-500 hover:border-transparent rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                                Search
                            </button>
                            @if ($flag_reset_refresh_emp)
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
                        <button type="submit" class="flex flex-row justify-center items-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white px-2 border border-green-500 hover:border-transparent rounded-md" x-ref="export_employee_btn" x-on:click="export_excel('export_emp_flag')">
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
                                Employee No.
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap text-center">
                                Employee Name
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap text-center">
                                Department
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Mobile Number
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap text-center">
                                Address
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                Employee Status
                            </th>
                            <th scope="col" class="py-3 px-6 whitespace-nowrap text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $employee->employee_code }}
                                </th>
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{ $employee->first_name.' '.$employee->last_name }}
                                </th>
                                <td class="py-4 px-6 text-center">
                                    {{ $employee->department }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{ $employee->mobile_no }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{ ($employee->block_house_no ? $employee->block_house_no : ' ').' '.($employee->street ? $employee->street : ' ').' '.$employee->barangay.' '.$employee->city.' '.$employee->province }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{ $employee->employee_status }}
                                </td>
                                <td class="flex flex-row justify-center py-7">
                                    <a href="{{ route('view-employee', $employee->employee_id) }}" title="View" target="_blank" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-1 mr-2 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('edit-employee', $employee->employee_id) }}" title="Edit" target="_blank" class="text-white bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-1 mr-7 mb-2 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pt-2 px-2">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
