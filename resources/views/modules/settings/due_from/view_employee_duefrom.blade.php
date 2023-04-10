<div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="display: none;" x-show="active_tab == 4" x-transition:enter.duration.500ms>
    <div class="overflow-hidden shadow-sm sm:rounded-lg h-5/6">

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative flex flex-col lg:flex-row lg:space-x-3 mt-3">
            @if ($view_duefrom_record)
                <a href="{{ route('view-employee', $view_duefrom_record->employee->employee_id) }}" class="" title="View Profile">
                    <div class="mb-4">
                        <div class="w-32 h-32 bg-gray-200 rounded-xl flex flex-row border border-gray-600">
                            <div class="flex justify-center items-center mx-auto">
                                <img src="{{ asset('storage/employee/'.$view_duefrom_record->employee->employee_photo) }}" alt="emp_photo">
                                {{-- <svg class="w-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512"><path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z"/></svg> --}}
                            </div>
                        </div>
                    </div>
                </a>
            @endif
            <div class="relative w-full">
                <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5 mb-3">
                    <div class="mb-1 w-full">
                        <label for="" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Full Name</label>
                        <input id="" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $view_duefrom_record ? $view_duefrom_record->employee->first_name.' '.$view_duefrom_record->employee->last_name.', '.$view_duefrom_record->employee->middle_name : '' }}" autocomplete="off" disabled>
                    </div>
                    <div class="mb-1 w-full">
                        <label for="time_out_am" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Department</label>
                        <input id="time_out_am" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $view_duefrom_record ? $view_duefrom_record->employee->EmployeeDetails->department : '' }}" autocomplete="off" disabled>
                    </div>
                    <div class="mb-1 w-full">
                        <label for="time_in_pm" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Employee Status</label>
                        <input id="time_in_pm" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $view_duefrom_record ? $view_duefrom_record->employee->employee_status : '' }}" autocomplete="off" disabled>
                    </div>

                </div>
                <div class="flex flex-col lg:flex-row ">
                    <form action="{{ route('view-employee-duefrom', $view_duefrom_record ? $view_duefrom_record->employee->employee_id : '') }}" method="GET" class="flex items-center w-full">
                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5 mb-1 w-full">
                            <div class="mb-1 w-full">
                                <label for="duefrom_start_date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Start Date</label>
                                <div class="flex flex-row">
                                    <input datepicker datepicker-autohide id="duefrom_start_date" name="duefrom_start_date" type="text"class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('duefrom_start_date') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="mb-1 w-full">
                                <label for="duefrom_start_date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">End Date</label>
                                <div class="flex flex-row">
                                    <input datepicker datepicker-autohide id="duefrom_end_date" name="duefrom_end_date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('duefrom_end_date') }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="px-3 ml-2 text-sm py-1 mt-3 text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                            <svg aria-hidden="true" class="w-5 h-5  dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </button>
                    </form>
                    <form action="{{ route('view-employee-duefrom', $view_duefrom_record ? $view_duefrom_record->employee->employee_id : '') }}" method="GET" class="flex items-center w-full ml-0 lg:ml-3">
                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5 mb-1 w-full">
                            <div class="mb-1 w-full">
                                <label for="duefrom_note" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Note</label>
                                <div class="flex flex-row">
                                    <input id="duefrom_note" name="duefrom_note" type="text"class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('duefrom_note') }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="px-3 ml-2 text-sm py-1 mt-3 text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                            <svg aria-hidden="true" class="w-5 h-5  dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
        <div class="flex items-center space-x-2 max-w-7xl mx-auto px-6">
            <a href="{{ route('settings') }}" class="inline-flex px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </a>
            <a href="{{ URL::previous() }}" class="inline-flex px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </a>
            <a href="{{ route('view-employee-duefrom', $view_duefrom_record ? $view_duefrom_record->employee->employee_id : '') }}" class="inline-flex px-3 py-1.5 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </a>
        </div>
        <div class="max-w-7xl mx-6 mt-2 justify-center flex items-center shadow-md sm:rounded-lg overflow-x-auto">
            <table class="w-full text-sm text-left dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="">
                        <th scope="col" class="py-3  whitespace-nowrap text-center">
                            Date
                        </th>
                        <th scope="col" class="py-3  whitespace-nowrap text-center">
                            Amount
                        </th>
                        <th scope="col" class="py-3  whitespace-nowrap text-center">
                            Note
                        </th>
                        <th scope="col" class="py-3  whitespace-nowrap text-center">
                            Options
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($view_duefrom_records)
                        @foreach ($view_duefrom_records as $dr_record)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                    <span>{{ date('F j, Y', strtotime($dr_record->created_at)) }}</span>
                                </td>
                                <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                    <span>{{ $dr_record->amount }}</span>
                                </td>
                                <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                    <span>{{ $dr_record->note }}</span>
                                </td>
                                <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                    <button type="button" {{ $dr_record->is_paid ? 'disabled' : '' }} title="Edit" class="text-white bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-1 text-center mr-2 mb-2"
                                        x-on:click="update_record = true, s_id = '{{ $dr_record->id }}', s_date = '{{ date('F j, Y', strtotime($dr_record->created_at)) }}', s_amount='{{ $dr_record->amount }}', s_note = '{{ $dr_record->note }}', modal_title = 'Edit Employee Due From'"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                    <button type="button" {{ $dr_record->is_paid ? 'disabled' : '' }} title="Delete" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-1 text-center mr-2 mb-2"
                                        x-on:click="delete_record = true, s_id = '{{ $dr_record->id }}'"
                                        >
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="max-w-7xl mx-6 mt-2">
            {{ $view_duefrom_records ? $view_duefrom_records->links() : '' }}
        </div>
        {{-- class="max-w-7xl mx-auto px-6 lg:px-8 relative flex flex-col lg:flex-row lg:space-x-3 mt-3" --}}
    </div>
</div>
