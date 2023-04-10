<x-app-layout>
    <x-slot name="title">
        {{ $title = 'New User' }}
    </x-slot>

    <div class="flex flex-row items-center">
        <x-auth-validation-errors class="my-4 mx-auto" :errors="$errors" />
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('store-users') }}">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-6 w-full">
                                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('first_name') }}" required autocomplete="off">
                            </div>

                            <div class="mb-6 w-full">
                                <label for="middle_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Middle Name</label>
                                <input type="text" id="middle_name" name="middle_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('middle_name') }}" autocomplete="off">
                            </div>

                            <div class="mb-6 w-full">
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('last_name') }}" required autocomplete="off">
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-6 w-full">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input type="email" id="email" name="email" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('email') }}" required autocomplete="off">
                            </div>

                            <div class="mb-6 w-full">
                                <label for="user_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User type</label>
                                <!-- <input type="text" id="user_type" name="user_type" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> -->
                                <select id="user_type" name="user_type" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="off">
                                    @if (old('user_type'))
                                        <option value="{{ old('user_type') }}" selected hidden>{{ old('user_type') == 0 ? 'Admin' : ( old('user_type') == 1 ? 'Payroll' : 'HR'  ) }}</option>
                                    @else
                                        <option selected hidden value="">Choose User Type</option>
                                    @endif
                                    <option value="0">Admin</option>
                                    <option value="1">Payroll</option>
                                    <option value="2">HR</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row space-x-0 lg:space-x-5">
                            <div class="mb-6 w-full">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                                <input type="password" id="password" name="password" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="off">
                            </div>

                            <div class="mb-6 w-full">
                                <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm Password</label>
                                <input type="password" id="confirm_password" name="password_confirmation" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    @if (session('error_message'))
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-md mt-2 px-3 py-3">
                            <span class="text-red-400 text-md font-bold">{{session()->get('error_message')}}</span>
                        </div>
                    @endif

                    <button type="submit" class="mt-2 text-gray-900 bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:outline-none focus:ring-[#F7BE38]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2" onclick="this.disabled=true;this.form.submit();">
                        <!-- <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="paypal" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4 .7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9 .7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z"></path></svg> -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Save
                    </button>
                    <a href="{{ route('users') }}" class="bg-[#2557D6] hover:bg-[#2557D6]/90 focus:ring-4 focus:ring-[#2557D6]/50 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                        </svg>
                        Back
                    </a>
                    <button type="reset" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 mr-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 -ml-1 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
