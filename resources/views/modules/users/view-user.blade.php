<x-app-layout>
    <x-slot name="title">
        {{ $title = 'View User' }}
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-6 w-full">
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="{{ $user_details->first_name }}">
                            </div>

                            <div class="mb-6 w-full">
                                <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="{{ $user_details->middle_name }}">
                            </div>

                            <div class="mb-6 w-full">
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="{{ $user_details->last_name }}">
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-6 w-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input type="email" id="email" name="email" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="{{ $user_details->email }}">
                            </div>

                            <div class="mb-6 w-full">
                                <label for="user_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User type</label>
                                <!-- <input type="text" id="user_type" name="user_type" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> -->
                                <select id="user_type" name="user_type" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled>
                                    <option selected hidden value="">
                                            @if($user_details->user_type == 0)
                                                Admin
                                            @elseif($user_details->user_type == 1)
                                                Payroll
                                            @elseif($user_details->user_type == 2)
                                                HR
                                            @endif
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ route('users') }}" class="bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                        </svg>
                        Back
                    </a>
                </div>
        </div>
    </div>
</x-app-layout>
