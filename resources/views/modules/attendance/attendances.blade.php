<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Attendances' }}
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex flex-row justify-between w-full">
                        <div class="flex flex-row items-center justify-between w-full ">
                            <a href="{{ route('create-attendances') }}" class="text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-1.5 text-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">Upload DTR</a>
                            <div class="flex">
                                <form action="{{ route('attendance') }}" method="GET" class="flex">
                                    <label for="search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none w-60">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <input type="text" id="search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-10 p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ request()->query('search') }}" placeholder="Search attendance..." required autocomplete="off">
                                    </div>
                                    <button type="submit" class="flex flex-grow items-center px-3 ml-2 text-sm text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg aria-hidden="true" class="mr-1 -ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5 overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left dark:text-gray-400">
                            <thead class="text-center text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr class="">
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Employee No.
                                    </th>
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Employee Name
                                    </th>
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Department
                                    </th>
                                    <th scope="col" class="py-3 px-6 whitespace-nowrap">
                                        Options
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $attendance)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            {{ $attendance->employee_code }}
                                        </th>
                                        <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            {{ $attendance->first_name.' '.$attendance->middle_name.', '.$attendance->last_name }}
                                        </th>
                                        <th scope="row" class="pr-8 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            {{ $attendance->EmployeeDetails->department }}
                                        </th>
                                        <td class="flex flex-row justify-center pr-2">
                                            <a href="{{ route('view-attendances', $attendance->employee_code) }}" title="View" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-4 py-1 mx-1 my-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </a>
                                            {{-- <a href="" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-1 my-2">Print</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pt-2 px-2">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
