<x-app-layout>
    <x-slot name="title">
        {{ $title = 'Dashboard' }}
    </x-slot>

    <div class="py-12" x-data="dashboard" x-init="$nextTick(() => { get_status() })">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="-mt-11 right-0 absolute max-w-xs mx-auto sm:px-6 lg:px-8" style="display: none;" x-show="welcome_show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-md">
                    <div class="p-2 bg-white border border-green-400 text-center rounded-md">
                        <span class="text-md font-bold">Welcome back <span class="text-green-500 " x-text="welcome_msg"></span>!</span>
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row w-full mx-auto space-x-0 lg:space-x-3 space-y-3 lg:space-y-0">
                <div class="flex flex-col rounded-md border-2 border-green-400 w-full">
                    <div class="flex flex-row w-full items-center justify-between p-3">
                        <div class="">
                            <span class="text-5xl font-bold text-green-600">{{ $total_employees  }}</span>
                        </div>
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-blue-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </span>
                    </div>
                    <div class="bg-gray-200 p-3 rounded-b-md border-t-2 border-green-400">
                        <span class="text-lg font-bold text-gray-700">Total Employees</span>
                    </div>
                </div>

                <div class="flex flex-col rounded-md border-2 border-green-400 w-full">
                    <div class="flex flex-row w-full items-center justify-between p-3">
                        <div class="">
                            <span class="text-5xl font-bold text-green-600">{{ $total_departments }}</span>
                        </div>
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-yellow-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                            </svg>
                        </span>
                    </div>
                    <div class="bg-gray-200 p-3 rounded-b-md border-t-2 border-green-400">
                        <span class="text-lg font-bold text-gray-700">Total Departments</span>
                    </div>
                </div>
                <div class="flex flex-col rounded-md border-2 border-green-400 w-full">
                    <div class="flex flex-row w-full items-center justify-between p-3">
                        <div class="">
                            <span class="text-5xl font-bold text-green-600">{{ $total_active_employees }}</span>
                        </div>
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-orange-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>

                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-blue-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg> --}}
                        </span>
                    </div>
                    <div class="bg-gray-200 p-3 rounded-b-md border-t-2 border-green-400">
                        <span class="text-lg font-bold text-gray-700">Active Employees</span>
                    </div>
                </div>

                <div class="flex flex-col rounded-md border-2 border-green-400 w-full">
                    <div class="flex flex-row w-full items-center justify-between p-3">
                        <div class="">
                            <span class="text-5xl font-bold text-green-600">{{ $total_active_loans }}</span>
                        </div>
                        <span class="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-green-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                            </svg>

                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-blue-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg> --}}
                        </span>
                    </div>
                    <div class="bg-gray-200 p-3 rounded-b-md border-t-2 border-green-400">
                        <span class="text-lg font-bold text-gray-700">Active Loans</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dashboard', () => ({
            '_id': '{{Auth::user()->id}}',
            'welcome_show': false,
            'welcome_msg': '{{ Auth::user()->first_name }}',

            async get_status(){
                let form = new FormData;
                form.append('user_id', this._id);
                await axios.post('/get-status', form)
                .then((response) => {
                    // console.log(response.data);
                    this.welcome_show = response.data == '1' ? true : false;
                    setTimeout(() => {
                        this.welcome_show = false;
                    }, 3000);
                },
                (error) => {
                    console.log(error);
                });
            },
        }));
    });
</script>
