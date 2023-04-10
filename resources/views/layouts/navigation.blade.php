<nav x-data="{ open: false }" class="border-green-100 border-b">
    <!-- Primary Navigation Menu -->
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8" style="background-image: url('/images/form_color.png')">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-logo class="block h-10 w-auto fill-current text-gray-600" /> --}}
                        <img src="/images/best.png" alt="Dashboard Logo" class="h-20 w-auto">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex font-sans">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if(Auth::user()->user_type == 2 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                        <x-nav-link :href="route('employee')" :active="request()->routeIs(['employee', 'create-employee', 'view-employee', 'edit-employee'])">
                            {{ __('Employee') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                        <x-nav-link :href="route('attendance')" :active="request()->routeIs(['attendance', 'create-attendances', 'view-attendances', 'edit-attendances'])">
                            {{ __('Attendance') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->user_type == 2 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                        <x-nav-link :href="route('loan')" :active="request()->routeIs(['loan', 'create-loans', 'view-loans', 'edit-loans'])">
                            {{ __('Loans') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                        <x-nav-link :href="route('payroll')" :active="request()->routeIs(['payroll', 'view-payrolls'])">
                            {{ __('Payroll') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                        <x-nav-link :href="route('settings')" :active="request()->routeIs(['settings', 'view-employee-dr', 'view-employee-ocdr', 'view-employee-duefrom'])">
                            {{ __('Settings') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->user_type == -1 || Auth::user()->user_type == 0)
                        <x-nav-link :href="route('users')" :active="request()->routeIs(['users', 'view-user', 'edit-user', 'update-user'])">
                            {{ __('Users') }}
                        </x-nav-link>
                    @endif
                        <x-nav-link :href="route('reports')" :active="request()->routeIs('reports')">
                            {{ __('Reports') }}
                        </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-bold text-green-700 hover:text-white hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div class="h-10 w-10 rounded-full border-white border mr-2">
                                @if (Auth::user()->user_type == -1 || Auth::user()->user_type == 0)
                                    <img src="{{ asset('storage/admin/admin.png') }}" alt="admin_image">
                                @elseif( Auth::user()->user_type == 1)
                                    <img src="{{ asset('storage/admin/payroll.png') }}" alt="admin_image">
                                @elseif( Auth::user()->user_type == 2)
                                    <img src="{{ asset('storage/admin/hr.png') }}" alt="admin_image">
                                @endif

                            </div>
                            <div>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-image: url('/images/form_color.png')">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if(Auth::user()->user_type == 2 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                <x-responsive-nav-link :href="route('employee')" :active="request()->routeIs('employee')">
                    {{ __('Employee') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                <x-responsive-nav-link :href="route('attendance')" :active="request()->routeIs('attendance')">
                    {{ __('Attendance') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->user_type == 2 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                <x-responsive-nav-link :href="route('loan')" :active="request()->routeIs('loan')">
                    {{ __('Loans') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                <x-responsive-nav-link :href="route('payroll')" :active="request()->routeIs('payroll')">
                    {{ __('Payroll') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 0 || Auth::user()->user_type == -1)
                <x-responsive-nav-link :href="route('settings')" :active="request()->routeIs('settings')">
                    {{ __('Settings') }}
                </x-responsive-nav-link>
            @endif

            @if(Auth::user()->user_type == -1 || Auth::user()->user_type == 0)
                <x-responsive-nav-link :href="route('users')" :active="request()->routeIs('users')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
            @endif

                <x-responsive-nav-link :href="route('reports')" :active="request()->routeIs('reports')">
                    {{ __('Reports') }}
                </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->first_name }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
