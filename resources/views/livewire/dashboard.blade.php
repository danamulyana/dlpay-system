<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <div>
                        <h2 class="text-lg font-medium truncate mr-5">PT Cahaya Sukses Plastindo</h2>
                        <p>Door Lock Access & Payroll Systems</p>
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
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ count($pekerja) }}</div>
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
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ $log }}</div>
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
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ $absence }}</div>
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
                                        <div class="text-3xl font-medium leading-8 mt-6">{{ $totalDevice }}</div>
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
                    {{-- <div class="flex flex-col xl:flex-row xl:items-center">
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
                    </div> --}}
                    <div class="Attendance-chart">
                        <canvas id="recapotulation-chart" height="169" class="mt-6"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Attendance recapitulation -->
            <!-- BEGIN: today's attendance -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h3 class="text-lg font-medium truncate mr-5">today's attendance</h3>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="today-attd-chart" height="300"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center  ">
                            <div class="w-2 h-2 bg-theme-6 rounded-full mr-3"></div>
                            <span class="truncate">Tidak Hadir</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{ $tidakHadirPer }}%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                            <span class="truncate">Terlambat</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{ $terlamabatPer }}%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-theme-9 rounded-full mr-3"></div>
                            <span class="truncate">Hadir</span>
                            <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                            <span class="font-medium xl:ml-auto">{{ $hadiranPer }}%</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: today's attendance -->
        </div>
    </div>
</div>

@push('scripts')
{{-- <script src="/js/Chart.min.js"></script> --}}
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script defer>
    let recapotulationctx = document.getElementById("recapotulation-chart").getContext('2d');
    let recapotulationChart = new Chart(recapotulationctx, {
        type: "line",
        data: {
            labels: @json($month),
            datasets: [
                {
                    label: "Hadir",
                    data: @json($lineH),
                    borderWidth: 2,
                    borderColor: "#3160D8",
                    backgroundColor: "transparent",
                },
                {
                    label: "terlambat",
                    data: @json($lineT),
                    borderWidth: 2,
                    borderColor: "#FF8B26",
                    backgroundColor: "transparent",
                },
                {
                    label: "Tidak Masuk",
                    data: @json($lineTH),
                    borderWidth: 2,
                    borderColor: "#D32929",
                    backgroundColor: "transparent",
                },
            ],
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                x:{
                    ticks: {
                        fontSize: "12",
                        fontColor: "#777777",
                    },
                    gridLines: {
                        display: false,
                    },
                },
                y:{
                    ticks: {
                        fontSize: "12",
                        fontColor: "#777777",
                    },
                    gridLines: {
                        color: "#D8D8D8",
                        zeroLineColor: "#D8D8D8",
                        borderDash: [2, 2],
                        zeroLineBorderDash: [2, 2],
                        drawBorder: false,
                    },
                },
            },
        },
    });

    console.log(@json($lineH));

    let todayAttdctx = document.getElementById('today-attd-chart').getContext("2d");
    let todayAttdChart = new Chart(todayAttdctx, {
        type: "doughnut",
        data: {
            labels: [" Tidak hadir", " Terlambat" ," Hadir"],
            datasets: [
                {
                    data: @json($dataTodayChart),
                    backgroundColor: ["#D32929", "#FF8B26", "#91C714","#285FD3"],
                    hoverBackgroundColor: ["#D32929", "#FF8B26", "#91C714","#285FD3"],
                    borderWidth: 5,
                    borderColor: "#fff",
                },
            ],
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: false,
                }
            }
            // cutoutPercentage: 80,
        },
    });
    </script>
@endpush