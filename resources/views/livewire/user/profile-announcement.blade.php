<div class="col-span-12 lg:col-span-8 2xl:col-span-9">
    <div class="grid grid-cols-12 gap-6">
        <!-- BEGIN: Daily Sales -->
        {{-- <div class="intro-y box col-span-12 2xl:col-span-6">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Daily Sales</h2>
                <div class="dropdown ml-auto sm:hidden">
                    <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false">
                        <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i>
                    </a>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Excel
                            </a>
                        </div>
                    </div>
                </div>
                <button class="btn btn-outline-secondary hidden sm:flex">
                    <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Excel
                </button>
            </div>
            <div class="p-5">
                <div class="relative flex items-center">
                    <div class="w-12 h-12 flex-none image-fit">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('dist/images/' . $fakers[0]['photos'][0]) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <a href="" class="font-medium">{{ $fakers[0]['users'][0]['name'] }}</a>
                        <div class="text-gray-600 mr-5 sm:mr-5">Bootstrap 4 HTML Admin Template</div>
                    </div>
                    <div class="font-medium text-gray-700 dark:text-gray-500">+$19</div>
                </div>
                <div class="relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('dist/images/' . $fakers[1]['photos'][0]) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <a href="" class="font-medium">{{ $fakers[1]['users'][0]['name'] }}</a>
                        <div class="text-gray-600 mr-5 sm:mr-5">Tailwind HTML Admin Template</div>
                    </div>
                    <div class="font-medium text-gray-700 dark:text-gray-500">+$25</div>
                </div>
                <div class="relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="{{ asset('dist/images/' . $fakers[2]['photos'][0]) }}">
                    </div>
                    <div class="ml-4 mr-auto">
                        <a href="" class="font-medium">{{ $fakers[2]['users'][0]['name'] }}</a>
                        <div class="text-gray-600 mr-5 sm:mr-5">Vuejs HTML Admin Template</div>
                    </div>
                    <div class="font-medium text-gray-700 dark:text-gray-500">+$21</div>
                </div>
            </div>
        </div> --}}
        <!-- END: Daily Sales -->
        <!-- BEGIN: Announcement -->
        <div class="intro-y box col-span-12 2xl:col-span-6">
            <div class="flex items-center px-5 py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Announcement</h2>
                <button data-carousel="announcement" data-target="prev" class="tiny-slider-navigator btn btn-outline-secondary px-2 mr-2">
                    <i data-feather="chevron-left" class="w-4 h-4"></i>
                </button>
                <button data-carousel="announcement" data-target="next" class="tiny-slider-navigator btn btn-outline-secondary px-2">
                    <i data-feather="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="tiny-slider py-5" id="announcement">
                <div class="px-5">
                    <div class="font-medium text-lg">Rubick Admin Template</div>
                    <div class="text-gray-700 dark:text-gray-600 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever. <br><br> Lorem Ipsum is simply dummy text of the printing and typesetting industry since the 1500s.</div>
                    <div class="flex items-center mt-5">
                        <div class="px-3 py-2 bg-theme-14 dark:bg-dark-5 dark:text-gray-300 text-theme-10 rounded font-medium">02 June 2021</div>
                        <button class="btn btn-secondary ml-auto">View Details</button>
                    </div>
                </div>
                <div class="px-5">
                    <div class="font-medium text-lg">Rubick Admin Template</div>
                    <div class="text-gray-700 dark:text-gray-600 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever. <br><br> Lorem Ipsum is simply dummy text of the printing and typesetting industry since the 1500s.</div>
                    <div class="flex items-center mt-5">
                        <div class="px-3 py-2 bg-theme-14 dark:bg-dark-5 dark:text-gray-300 text-theme-10 rounded font-medium">02 June 2021</div>
                        <button class="btn btn-secondary ml-auto">View Details</button>
                    </div>
                </div>
                <div class="px-5">
                    <div class="font-medium text-lg">Rubick Admin Template</div>
                    <div class="text-gray-700 dark:text-gray-600 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever. <br><br> Lorem Ipsum is simply dummy text of the printing and typesetting industry since the 1500s.</div>
                    <div class="flex items-center mt-5">
                        <div class="px-3 py-2 bg-theme-14 dark:bg-dark-5 dark:text-gray-300 text-theme-10 rounded font-medium">02 June 2021</div>
                        <button class="btn btn-secondary ml-auto">View Details</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Announcement -->
        <!-- BEGIN: Today Schedules -->
        <div class="intro-y box col-span-12 2xl:col-span-6">
            <div class="flex items-center px-5 py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">Today Schedules</h2>
                <button data-carousel="today-schedule" data-target="prev" class="tiny-slider-navigator btn btn-outline-secondary px-2 mr-2">
                    <i data-feather="chevron-left" class="w-4 h-4"></i>
                </button>
                <button data-carousel="today-schedule" data-target="next" class="tiny-slider-navigator btn btn-outline-secondary px-2">
                    <i data-feather="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="tiny-slider py-5" id="today-schedule">
                <div class="px-5 text-center sm:text-left">
                    <div class="font-medium text-lg">Developing rest API with Laravel 7</div>
                    <div class="text-gray-700 dark:text-gray-600 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry</div>
                    <div class="mt-2">11:15AM - 12:30PM</div>
                    <div class="flex flex-col sm:flex-row items-center mt-5">
                        <div class="flex items-center text-gray-600">
                            <i data-feather="map-pin" class="hidden sm:block w-4 h-4 mr-2"></i> 1396 Pooh Bear Lane, New Market
                        </div>
                        <button class="btn btn-secondary py-1 px-2 sm:ml-auto mt-3 sm:mt-0sm:ml-auto mt-3 sm:mt-0">View On Map</button>
                    </div>
                </div>
                <div class="px-5 text-center sm:text-left">
                    <div class="font-medium text-lg">Developing rest API with Laravel 7</div>
                    <div class="text-gray-700 dark:text-gray-600 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry</div>
                    <div class="mt-2">11:15AM - 12:30PM</div>
                    <div class="flex flex-col sm:flex-row items-center mt-5">
                        <div class="flex items-center text-gray-600">
                            <i data-feather="map-pin" class="hidden sm:block w-4 h-4 mr-2"></i> 1396 Pooh Bear Lane, New Market
                        </div>
                        <button class="btn btn-secondary py-1 px-2 sm:ml-auto mt-3 sm:mt-0sm:ml-auto mt-3 sm:mt-0">View On Map</button>
                    </div>
                </div>
                <div class="px-5 text-center sm:text-left">
                    <div class="font-medium text-lg">Developing rest API with Laravel 7</div>
                    <div class="text-gray-700 dark:text-gray-600 mt-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry</div>
                    <div class="mt-2">11:15AM - 12:30PM</div>
                    <div class="flex flex-col sm:flex-row items-center mt-5">
                        <div class="flex items-center text-gray-600">
                            <i data-feather="map-pin" class="hidden sm:block w-4 h-4 mr-2"></i> 1396 Pooh Bear Lane, New Market
                        </div>
                        <button class="btn btn-secondary py-1 px-2 sm:ml-auto mt-3 sm:mt-0sm:ml-auto mt-3 sm:mt-0">View On Map</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Today Schedules -->
    </div>
</div>