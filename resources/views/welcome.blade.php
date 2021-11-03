<x-guest-layout>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <div>
                            <h2 class="text-lg font-medium truncate mr-5">PT Cahaya Sukses Plastindo</h2>
                            <p>Door Lock Access & Payroll Systems</p>
                            <button wire:click="openModal">Tes</button>
                        </div>
                        <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                        </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex items-center justify-between" style="height: 17vh;">
                                        <div class="flex-grow">
                                            <div class="text-3xl font-medium leading-8 mt-6">1</div>
                                            <div class="text-base text-gray-600 mt-1">Total Employees</div>
                                        </div>
                                        <i data-feather="users" class="text-theme-10 flex-grow" style="height: 50%; width: 50%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex items-center justify-between" style="height: 17vh;">
                                        <div class="">
                                            <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                            <div class="text-base text-gray-600 mt-1">employees <br> present today</div>
                                        </div>
                                        <i data-feather="user-check" class="text-theme-9 flex-grow" style="height: 50%; width: 50%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex items-center justify-between" style="height: 17vh;">
                                        <div class="">
                                            <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                            <div class="text-base text-gray-600 mt-1">Absence today</div>
                                        </div>
                                        <i data-feather="user-x" class="text-theme-6 flex-grow" style="height: 50%; width: 50%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex items-center justify-between" style="height: 17vh;">
                                        <div class="">
                                            <div class="text-3xl font-medium leading-8 mt-6">0</div>
                                            <div class="text-base text-gray-600 mt-1">Door Lock Access Devices</div>
                                        </div>
                                        <i data-feather="cpu" class="text-theme-12 flex-grow" style="height: 50%; width: 50%;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
                <!-- BEGIN: Attendance recapitulation -->
                <div class="col-span-12 lg:col-span-9 mt-8">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Attendance recapitulation</h2>
                    </div>
                    <div class="intro-y box p-5 mt-12 sm:mt-5">
                        <div class="flex flex-col xl:flex-row xl:items-center">
                            <div class="dropdown xl:ml-auto mt-5 xl:mt-0">
                                <button class="dropdown-toggle btn btn-outline-secondary font-normal" aria-expanded="false">
                                    Filter <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i>
                                </button>
                                <div class="dropdown-menu w-40">
                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2 overflow-y-auto h-32">
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">PC & Laptop</a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Smartphone</a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Electronic</a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Photography</a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">Sport</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="report-chart">
                            <canvas id="report-line-chart" height="169" class="mt-6"></canvas>
                        </div>
                    </div>
                </div>
                <!-- END: Attendance recapitulation -->
                <!-- BEGIN: Sales Report -->
                <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Sales Report</h2>
                        <a href="" class="ml-auto text-theme-1 dark:text-theme-10 truncate">Show More</a>
                    </div>
                    <div class="intro-y box p-5 mt-5">
                        <canvas class="mt-3" id="report-donut-chart" height="300"></canvas>
                        <div class="mt-8">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                                <span class="truncate">17 - 30 Years old</span>
                                <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                <span class="font-medium xl:ml-auto">62%</span>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                                <span class="truncate">31 - 50 Years old</span>
                                <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                <span class="font-medium xl:ml-auto">33%</span>
                            </div>
                            <div class="flex items-center mt-4">
                                <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                                <span class="truncate">>= 50 Years old</span>
                                <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                                <span class="font-medium xl:ml-auto">10%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Sales Report -->
            </div>
        </div>
    </div>
</x-guest-layout>