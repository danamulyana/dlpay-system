<div>
    <h2 class="intro-y text-lg font-medium mt-10">Device History</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <div></div>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                </div>
                <div class="dropdown ml-auto sm:ml-0 pl-3">
                    <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> New Category </a>
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="users" class="w-4 h-4 mr-2"></i> New Group </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">
                            NAMA
                            <span wire:click="sortBy('user_id')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'user_id' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'user_id' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap">
                            DEVICE
                            <span wire:click="sortBy('uid')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'uid' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'uid' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap">
                            KETERANGAN
                            <span wire:click="sortBy('keterangan')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'keterangan' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'keterangan' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap">
                            REMARK
                            <span wire:click="sortBy('remark_log')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'remark_log' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'remark_log' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap">
                            COUNTER
                            <span wire:click="sortBy('count_access')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'count_access' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'count_access' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap">
                            CREATED
                            <span wire:click="sortBy('created_at')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $history->count() * ($history->currentPage() - 1) + $loop->iteration}}</td>
                        <td class="text-center">{{ $data->karyawan->nama }}</td>
                        <td class="text-center">{{ $data->device($data->uid) }}</td>
                        <td class="text-center">{{ $data->keterangan }}</td>
                        <td class="text-center">{{ $data->remark_log }}</td>
                        <td class="text-center">{{ $data->count_access }}</td>
                        <td class="text-center">{{ $data->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $history->links() }}
        <!-- END: Pagination -->
    </div>
</div>