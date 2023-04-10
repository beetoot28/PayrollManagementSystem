<x-app-layout>
    <x-slot name="title">
        {{ $title = 'View Attendance' }}
    </x-slot>

    <div class="flex flex-row items-center">
        <x-auth-validation-errors class="my-4 mx-auto" :errors="$errors" />
    </div>

    <div class="py-12" x-data="view_attendance">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative flex flex-col lg:flex-row lg:space-x-3">
            <a href="{{ route('view-employee', $employee_record->employee_id) }}" class="" title="View Profile">
                <div class="mb-4">
                    <div class="w-32 h-32 bg-gray-200 rounded-xl flex flex-row border border-gray-600">
                        <div class="flex justify-center items-center mx-auto">
                            <img src="{{ asset('storage/employee/'.$employee_record->employee_photo) }}" alt="emp_photo">
                            {{-- <svg class="w-20 text-gray-300" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512"><path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z"/></svg> --}}
                        </div>
                    </div>
                </div>
            </a>
            <div class="relative w-full">
                {{-- <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5 mb-3">
                    <input id="" type="text" class="w-20 bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $employee_code }}" autocomplete="off" disabled>
                </div> --}}

                <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5 mb-3">
                    <div class="mb-1 w-full">
                        <label for="" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Full Name</label>
                        <input id="" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $employee_record->first_name.' '.$employee_record->last_name.', '.$employee_record->middle_name }}" autocomplete="off" disabled>
                    </div>
                    <div class="mb-1 w-full">
                        <label for="time_out_am" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Department</label>
                        <input id="time_out_am" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $employee_record->EmployeeDetails->department }}" autocomplete="off" disabled>
                    </div>
                    <div class="mb-1 w-full">
                        <label for="time_in_pm" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Employee Status</label>
                        <input id="time_in_pm" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  value="{{ $employee_record->employee_status }}" autocomplete="off" disabled>
                    </div>

                </div>
                <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5 mb-5">
                    <div class="mb-1 w-full relative">
                        <label for="v_search" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Cutoff Date</label>
                        <form action="{{ route('view-attendances', $employee_code) }}" method="GET" class="flex flex-row">
                            <input id="v_search" name="v_search" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('v_search') }}" autocomplete="off" x-ref="v_cutoff_date" x-on:click="show_cutoff_lists = true">
                            <button type="submit" class="px-3 ml-2 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg aria-hidden="true" class="w-5 h-5  dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </button>
                        </form>

                        <div class="absolute mt-1 w-full z-20 max-h-72 overflow-y-auto bg-white rounded-md shadow-sm border border-gray-300" style="display: none;" x-show="show_cutoff_lists" @click.outside="show_cutoff_lists = false">
                            <template x-for="cutoff in cutoff_date_lists">
                                <li x-text="date_formatter(cutoff.cutoff_date)" x-on:click="show_cutoff_lists = false, $refs.v_cutoff_date.value = date_formatter(cutoff.cutoff_date)"
                                    class="cursor-default transition duration-500 ease-in-out text-xs block px-4 py-2 hover:bg-gray-300 hover:bg-opacity-50 hover:text-gray-900 items-center"></li>
                            </template>
                        </div>
                    </div>
                    <div class="mb-1 w-full">
                        <label for="v_start_date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Start Date</label>
                        <div class="flex flex-row">
                            <input datepicker datepicker-autohide id="v_start_date" name="v_start_date" type="text"class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('v_start_date') }}" x-ref="v_start_date" autocomplete="off">
                            <button class="px-3 ml-2 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 invisible" disabled>
                                <svg aria-hidden="true" class="w-5 h-5  dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
                    </div>
                    <div class="mb-1 w-full">
                        <label for="v_end_date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">End Date</label>
                        <form action="{{ route('view-attendances', $employee_code) }}" method="GET" class="flex flex-row">
                            <input type="text" name="v_start_date" value="{{ request()->query('v_start_date') }}" x-ref="v_start_date_hidden" hidden> {{-- <====== for form submission purpose only  --}}
                            <input datepicker datepicker-autohide id="v_end_date" name="v_end_date" type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full px-2 py-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('v_end_date') }}" autocomplete="off">
                            <button type="submit" class="px-3 ml-2 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                x-on:click="$refs.v_start_date_hidden.value = $refs.v_start_date.value">
                                <svg aria-hidden="true" class="w-5 h-5  dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative">
            <div class="flex flex-row space-x-2 lg:ml-4">
                <a href="{{ route('attendance') }}" class="inline-flex px-3 py-1 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
                <a href="{{ route('view-attendances', $employee_code) }}" class="inline-flex px-3 py-1.5 text-sm text-white bg-blue-700 rounded-md border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </a>
            </div>
            <div class="">
                <div class="mt-2 justify-center flex items-center shadow-md sm:rounded-lg overflow-x-auto">
                    <table class="w-full text-sm text-left dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="">
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Cutoff Date
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Date In
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Time In (AM)
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Time Out (AM)
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Time In (PM)
                                </th>
                                <th scope="col" class="py-3  whitespace-nowrap text-center">
                                    Time Out (PM)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee_attendances as $attendance_record)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span>{{ date('F j, Y', strtotime($attendance_record->Cutoff->cutoff_date)) }}</span>
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span>{{ date('F j, Y', strtotime($attendance_record->date_in)) }}</span>
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span>{{ $attendance_record->time_in_am }}</span>
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span>{{ $attendance_record->time_out_am }}</span>
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span>{{ $attendance_record->time_in_pm }}</span>
                                    </td>
                                    <td class="py-3 text-center border-gray-300 text-gray-900 text-sm p-2">
                                        <span>{{ $attendance_record->time_out_pm }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pt-2 px-2">
                    {{-- {{ $employee_attendances->links() }} --}}
                    @if (request()->query('v_search'))
                        {{ $employee_attendances->appends(['v_search' => request()->query('v_search')])->links() }}
                    @elseif (request()->query('v_start_date'))
                        {{ $employee_attendances->appends(['v_start_date' => request()->query('v_start_date'), 'v_end_date' => request()->query('v_end_date')])->links() }}
                    @else
                        {{ $employee_attendances->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('view_attendance', () => ({
            'show_cutoff_lists': false,
            'cutoff_date_lists': @json($cutoff_dates),
            date_formatter(date_input){
                const MONTH_SHORT_NAMES = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                var time_series = [];
                var date_object = new Date(date_input);
                var month = date_object.getMonth();
                var day = date_object.getDate();
                var year = date_object.getFullYear();

                if (day.toString().length < 2)
                    day = '0' + day;

                //time_series[i] = (MONTH_SHORT_NAMES[month]+'-'+day+'-'+ year);
                date_ = (MONTH_SHORT_NAMES[month]+' '+day+', '+ year);
                return date_;
            }
        }));
    });
</script>
