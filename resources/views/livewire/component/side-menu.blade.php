@section('head')
    @yield('subhead')
@endsection
    {{-- @include('../layout/components/mobile-menu') --}}
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="{{ route('dashboard') }}" class="intro-x flex items-center justify-center pt-2">
                <img alt="logo-csp-birumerah" class="w-12" src="{{ asset('dist/images/logo-csp-birumerah.gif') }}">
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="{{ route("dashboard") }}" class="{{ request()->routeIs('dashboard') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon">
                            <i data-feather="home"></i>
                        </div>
                        <div class="side-menu__title">
                            Dashboard 
                        </div>
                    </a>
                </li>
                @auth
                @if(auth()->user()->can('super_admin') || auth()->user()->can('users_management_access'))
                <li>
                    <a href="javascript:;" class="{{ request()->routeIs('admin.*') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon">
                            <i data-feather="database"></i>
                        </div>
                        <div class="side-menu__title">
                            Admin Management
                            <div class="side-menu__sub-icon">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="{{ request()->routeIs('admin.*') ? 'side-menu__sub-open' : '' }}">
                        @can('super_admin')                 
                        <li>
                            <a href="{{ route('admin.permisions') }}" class="{{ request()->routeIs('admin.permisions') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="lock"></i>
                                </div>
                                <div class="side-menu__title">
                                    Permisions
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.role') }}" class="{{ request()->routeIs('admin.role') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="key"></i>
                                </div>
                                <div class="side-menu__title">
                                    Role
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('users_management_access')
                        <li>
                            <a href="{{ route('admin.managementusers') }}" class="{{ request()->routeIs('admin.managementusers') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="share-2"></i>
                                </div>
                                <div class="side-menu__title">
                                    Management Users
                                </div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @can('masterData_access')
                <li>
                    <a href="javascript:;" class="{{ request()->routeIs('master.*') || request()->routeIs('management users') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon">
                            <i data-feather="database"></i>
                        </div>
                        <div class="side-menu__title">
                            Master Data
                            <div class="side-menu__sub-icon">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="{{ request()->routeIs('master.*') || request()->routeIs('management users') ? 'side-menu__sub-open' : '' }}">
                        @can('departement_show')
                        <li>
                            <a href="{{ route('master.departement') }}" class="{{ request()->routeIs('master.departement') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="folder"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data Departement
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('subdepartement_show')
                        <li>
                            <a href="{{ route('master.subdepartement') }}" class="{{ request()->routeIs('master.subdepartement') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="folder-plus"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data SubDepartement
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('pegawai_show')
                        <li>
                            <a href="{{ route('master.employees') }}" class="{{ request()->routeIs('master.employees') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="users"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data employees
                                </div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('ManagementDevice_access')
                <li>
                    <a href="javascript:;" class="{{ request()->routeIs('device.*') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon">
                            <i data-feather="monitor"></i>
                        </div>
                        <div class="side-menu__title">
                            Management Device
                            <div class="side-menu__sub-icon">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="{{ request()->routeIs('device.*') ? 'side-menu__sub-open' : '' }}">
                        @can('location_show')
                        <li>
                            <a href="{{ route('device.location') }}" class="{{ request()->routeIs('device.location') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="navigation"></i>
                                </div>
                                <div class="side-menu__title">
                                    Data Location
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('attandanceDevice_show')
                        <li>
                            <a href="{{ route('device.attendance') }}" class="{{ request()->routeIs('device.attendance') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="smartphone"></i>
                                </div>
                                <div class="side-menu__title">
                                    Attendance Device
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('doorlockDevice_show')
                        <li>
                            <a href="{{ route('device.doorlock') }}" class="{{ request()->routeIs('device.doorlock') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="tv"></i>
                                </div>
                                <div class="side-menu__title">
                                    Door Lock Device
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('remark_show')
                        <li>
                            <a href="{{ route('device.remark') }}" class="{{ request()->routeIs('device.remark') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="list"></i>
                                </div>
                                <div class="side-menu__title">
                                    Remark
                                </div>
                            </a>
                        </li>
                        @endcan
                        <li>
                            <a href="{{ route('device.management') }}" class="{{ request()->routeIs('device.management') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="list"></i>
                                </div>
                                <div class="side-menu__title">
                                    Schadule Management
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('ManagementAttendance_access')
                <li>
                    <a href="javascript:;" class="{{ request()->routeIs('atd.*') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon">
                            <i data-feather="user-check"></i>
                        </div>
                        <div class="side-menu__title">
                            Management Attendance
                            <div class="side-menu__sub-icon">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="{{ request()->routeIs('atd.*') ? 'side-menu__sub-open' : '' }}">
                        @can('workingTime_show')
                        <li>
                            <a href="{{ route('atd.working') }}" class="{{ request()->routeIs('atd.working') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="clock"></i>
                                </div>
                                <div class="side-menu__title">
                                    Working Time
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('LeaveAndAbsence_show')
                        <li>
                            <a href="{{ route('atd.absence') }}" class="{{ request()->routeIs('atd.absence') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="activity"></i>
                                </div>
                                <div class="side-menu__title">
                                    Leave & Absence
                                </div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('Payroll_access')
                <li>
                    <a href="javascript:;" class="{{ request()->routeIs('payroll.*') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon">
                            <i data-feather="credit-card"></i>
                        </div>
                        <div class="side-menu__title">
                            Payroll System
                            <div class="side-menu__sub-icon">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="{{ request()->routeIs('payroll.*') ? 'side-menu__sub-open' : '' }}">
                        @can('weeklyPayroll_access')
                        <li>
                            <a href="{{ route('payroll.weekly') }}" class="{{ request()->routeIs('payroll.weekly') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="calendar"></i>
                                </div>
                                <div class="side-menu__title">
                                    Weekly Payment
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('MonthlyPayroll_access')
                        <li>
                            <a href="{{ route('payroll.monthly') }}" class="{{ request()->routeIs('payroll.monthly') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="calendar"></i>
                                </div>
                                <div class="side-menu__title">
                                    Monthly payment
                                </div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @can('report_access')
                <li>
                    <a href="javascript:;" class="{{ request()->routeIs('report.*') ? 'side-menu side-menu--active' : 'side-menu' }}">
                        <div class="side-menu__icon">
                            <i data-feather="printer"></i>
                        </div>
                        <div class="side-menu__title">
                            Report
                            <div class="side-menu__sub-icon">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul class="{{ request()->routeIs('report.*') ? 'side-menu__sub-open' : '' }}">
                        @can('DeviceHistoryReport_access')
                        <li>
                            <a href="{{ route('report.device') }}" class="{{ request()->routeIs('report.device') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="tablet"></i>
                                </div>
                                <div class="side-menu__title">
                                    Device History
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('AbsenceReport_access')
                        <li>
                            <a href="{{ route('report.absence') }}" class="{{ request()->routeIs('report.absence') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="users"></i>
                                </div>
                                <div class="side-menu__title">
                                    Absence Report
                                </div>
                            </a>
                        </li>
                        @endcan
                        @can('DoorlockReport_access')
                        <li>
                            <a href="{{ route('report.doorlock') }}" class="{{ request()->routeIs('report.doorlock') ? 'side-menu side-menu--active' : 'side-menu' }}">
                                <div class="side-menu__icon">
                                    <i data-feather="credit-card"></i>
                                </div>
                                <div class="side-menu__title">
                                    Doorlock Report
                                </div>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="side-menu">
                            <div class="side-menu__icon">
                                <i data-feather="log-out"></i>
                            </div>
                            <div class="side-menu__title">
                                Log Out 
                            </div>
                        </a>
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- END: Side Menu -->
