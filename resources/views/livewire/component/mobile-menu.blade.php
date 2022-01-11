<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="{{ route('dashboard') }}" class="flex mr-auto">
            <img alt="logo-csp-birumerah" class="w-12" src="{{ asset('dist/images/logo-csp-birumerah.gif') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-29 py-5 hidden">
        <li>
            <a href="{{ route("dashboard") }}" class="{{ request()->routeIs('dashboard') ? 'menu menu--active' : 'menu' }}">
                <div class="menu__icon">
                    <i data-feather="home"></i>
                </div>
                <div class="menu__title">
                    Dashboard 
                </div>
            </a>
        </li>
        @auth
        @if(auth()->user()->can('super_admin') || auth()->user()->can('users_management_access'))
        <li>
            <a href="javascript:;" class="{{ request()->routeIs('admin.*') ? 'menu menu--active' : 'menu' }}">
                <div class="menu__icon">
                    <i data-feather="database"></i>
                </div>
                <div class="menu__title">
                    Admin Management
                    <div class="menu__sub-icon">
                        <i data-feather="chevron-down"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ request()->routeIs('admin.*') ? 'menu__sub-open' : '' }}">
                @can('super_admin')                 
                <li>
                    <a href="{{ route('admin.permisions') }}" class="{{ request()->routeIs('admin.permisions') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="lock"></i>
                        </div>
                        <div class="menu__title">
                            Permisions
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.role') }}" class="{{ request()->routeIs('admin.role') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="key"></i>
                        </div>
                        <div class="menu__title">
                            Role
                        </div>
                    </a>
                </li>
                @endcan
                @can('users_management_access')
                <li>
                    <a href="{{ route('admin.managementusers') }}" class="{{ request()->routeIs('admin.managementusers') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="share-2"></i>
                        </div>
                        <div class="menu__title">
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
            <a href="javascript:;" class="{{ request()->routeIs('master.*') || request()->routeIs('management users') ? 'menu menu--active' : 'menu' }}">
                <div class="menu__icon">
                    <i data-feather="database"></i>
                </div>
                <div class="menu__title">
                    Master Data
                    <div class="menu__sub-icon">
                        <i data-feather="chevron-down"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ request()->routeIs('master.*') || request()->routeIs('management users') ? 'menu__sub-open' : '' }}">
                @can('departement_show')
                <li>
                    <a href="{{ route('master.departement') }}" class="{{ request()->routeIs('master.departement') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="folder"></i>
                        </div>
                        <div class="menu__title">
                            Data Departement
                        </div>
                    </a>
                </li>
                @endcan
                @can('subdepartement_show')
                <li>
                    <a href="{{ route('master.subdepartement') }}" class="{{ request()->routeIs('master.subdepartement') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="folder-plus"></i>
                        </div>
                        <div class="menu__title">
                            Data SubDepartement
                        </div>
                    </a>
                </li>
                @endcan
                @can('pegawai_show')
                <li>
                    <a href="{{ route('master.employees') }}" class="{{ request()->routeIs('master.employees') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="users"></i>
                        </div>
                        <div class="menu__title">
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
            <a href="javascript:;" class="{{ request()->routeIs('device.*') ? 'menu menu--active' : 'menu' }}">
                <div class="menu__icon">
                    <i data-feather="monitor"></i>
                </div>
                <div class="menu__title">
                    Management Device
                    <div class="menu__sub-icon">
                        <i data-feather="chevron-down"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ request()->routeIs('device.*') ? 'menu__sub-open' : '' }}">
                @can('location_show')
                <li>
                    <a href="{{ route('device.location') }}" class="{{ request()->routeIs('device.location') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="navigation"></i>
                        </div>
                        <div class="menu__title">
                            Data Location
                        </div>
                    </a>
                </li>
                @endcan
                @can('attandanceDevice_show')
                <li>
                    <a href="{{ route('device.attendance') }}" class="{{ request()->routeIs('device.attendance') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="smartphone"></i>
                        </div>
                        <div class="menu__title">
                            Attendance Device
                        </div>
                    </a>
                </li>
                @endcan
                @can('doorlockDevice_show')
                <li>
                    <a href="{{ route('device.doorlock') }}" class="{{ request()->routeIs('device.doorlock') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="tv"></i>
                        </div>
                        <div class="menu__title">
                            Door Lock Device
                        </div>
                    </a>
                </li>
                @endcan
                @can('remark_show')
                <li>
                    <a href="{{ route('device.remark') }}" class="{{ request()->routeIs('device.remark') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="list"></i>
                        </div>
                        <div class="menu__title">
                            Remark
                        </div>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('ManagementAttendance_access')
        <li>
            <a href="javascript:;" class="{{ request()->routeIs('atd.*') ? 'menu menu--active' : 'menu' }}">
                <div class="menu__icon">
                    <i data-feather="user-check"></i>
                </div>
                <div class="menu__title">
                    Management Attendance
                    <div class="menu__sub-icon">
                        <i data-feather="chevron-down"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ request()->routeIs('atd.*') ? 'menu__sub-open' : '' }}">
                @can('workingTime_show')
                <li>
                    <a href="{{ route('atd.working') }}" class="{{ request()->routeIs('atd.working') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="clock"></i>
                        </div>
                        <div class="menu__title">
                            Working Time
                        </div>
                    </a>
                </li>
                @endcan
                @can('LeaveAndAbsence_show')
                <li>
                    <a href="{{ route('atd.absence') }}" class="{{ request()->routeIs('atd.absence') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="activity"></i>
                        </div>
                        <div class="menu__title">
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
            <a href="javascript:;" class="{{ request()->routeIs('payroll.*') ? 'menu menu--active' : 'menu' }}">
                <div class="menu__icon">
                    <i data-feather="credit-card"></i>
                </div>
                <div class="menu__title">
                    Payroll System
                    <div class="menu__sub-icon">
                        <i data-feather="chevron-down"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ request()->routeIs('payroll.*') ? 'menu__sub-open' : '' }}">
                @can('weeklyPayroll_access')
                <li>
                    <a href="{{ route('payroll.weekly') }}" class="{{ request()->routeIs('payroll.weekly') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="calendar"></i>
                        </div>
                        <div class="menu__title">
                            Weekly Payment
                        </div>
                    </a>
                </li>
                @endcan
                @can('MonthlyPayroll_access')
                <li>
                    <a href="{{ route('payroll.monthly') }}" class="{{ request()->routeIs('payroll.monthly') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="calendar"></i>
                        </div>
                        <div class="menu__title">
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
            <a href="javascript:;" class="{{ request()->routeIs('report.*') ? 'menu menu--active' : 'menu' }}">
                <div class="menu__icon">
                    <i data-feather="printer"></i>
                </div>
                <div class="menu__title">
                    Report
                    <div class="menu__sub-icon">
                        <i data-feather="chevron-down"></i>
                    </div>
                </div>
            </a>
            <ul class="{{ request()->routeIs('report.*') ? 'menu__sub-open' : '' }}">
                @can('DeviceHistoryReport_access')
                <li>
                    <a href="{{ route('report.device') }}" class="{{ request()->routeIs('report.device') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="tablet"></i>
                        </div>
                        <div class="menu__title">
                            Device History
                        </div>
                    </a>
                </li>
                @endcan
                @can('AbsenceReport_access')
                <li>
                    <a href="{{ route('report.absence') }}" class="{{ request()->routeIs('report.absence') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="users"></i>
                        </div>
                        <div class="menu__title">
                            Absence Report
                        </div>
                    </a>
                </li>
                @endcan
                @can('DoorlockReport_access')
                <li>
                    <a href="{{ route('report.doorlock') }}" class="{{ request()->routeIs('report.doorlock') ? 'menu menu--active' : 'menu' }}">
                        <div class="menu__icon">
                            <i data-feather="credit-card"></i>
                        </div>
                        <div class="menu__title">
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
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="menu">
                    <div class="menu__icon">
                        <i data-feather="log-out"></i>
                    </div>
                    <div class="menu__title">
                        Log Out 
                    </div>
                </a>
            </form>
        </li>
        @endauth
    </ul>
</div>
