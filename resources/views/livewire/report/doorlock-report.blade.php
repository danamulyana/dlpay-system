<div>
    <h2 class="intro-y text-lg font-medium mt-10">Doorlock Report</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <div></div>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search..." wire:model="searchTerms">
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
                            CREATED
                            <span wire:click="sortBy('created_at')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap">
                            ACTION
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doorlock as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $doorlock->count() * ($doorlock->currentPage() - 1) + $loop->iteration}}</td>
                        <td class="text-center">{{ $data->karyawan->nama }}</td>
                        <td class="text-center">{{ $data->device->name }}</td>
                        <td class="text-center">{{ $data->keterangan }}</td>
                        <td class="text-center">{{ $data->created_at }}</td>
                        <td class="text-center">
                            <button class="flex items-center" wire:click="showmodalView('{{ $data->id }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                View
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $doorlock->links() }}
        <!-- END: Pagination -->
    </div>
    <x-jet-dialog-modal wire:model="confirmingViewModal">
        <x-slot name="title">
            {{ 'Doorlock Device'}}
        </x-slot>
    
        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="name" value="{{ __('NAMA DOORLOCK') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="name"
                                wire:model.defer="viewName"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="karyawanaccess" value="{{ __('KARYAWAN ACCESS') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="karyawanaccess"
                                wire:model.defer="karyawanAccess"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="keterangan" value="{{ __('KETERANGAN') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="keterangan"
                                wire:model.defer="views.keterangan"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="remark_log" value="{{ __('REMARK LOG') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="remark_log"
                                wire:model.defer="views.remark_log"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="count_access" value="{{ __('COUNT ACCESS') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="count_access"
                                wire:model.defer="views.count_access"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="capture_doorlock" value="{{ __('FOTO DOORLOCK ACCESS') }}" />
                <img src="{{ asset($viewPhotoDoorlock) }}" alt="{{ $viewName }}" width="300">
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingViewModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
    
            <x-jet-button class="ml-2" wire:click="add" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>