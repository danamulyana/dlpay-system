<div>
    <h2 class="intro-y text-lg font-medium mt-10">Device History</h2>
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
                <div class="ml-auto sm:ml-0 pl-3">
                    <button class="btn px-2 box text-gray-700 dark:text-gray-300">
                        <span class="w-5 h-5 flex items-center justify-center" wire:click="showmodalExport"> 
                            <i class="las la-print"></i>
                        </span>
                    </button>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $history->count() * ($history->currentPage() - 1) + $loop->iteration}}</td>
                        <td class="text-center">{{ $data->karyawan->nama }}</td>
                        <td class="text-center">{{ $data->is_attendance == 1 ? $data->deviceAbsence->name : $data->deviceDoorlock->name }}</td>
                        <td class="text-center">{{ $data->keterangan }}</td>
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
    {{-- Export modal --}}
    <x-jet-dialog-modal wire:model="confirmingExportModal">
        <x-slot name="title">
            {{'Export'}}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="startDate" value="{{ __('Start') }}" />
                <x-jet-input type="date" class="mt-1 block w-3/4"
                                x-ref="startDate"
                                wire:model.defer="startDate"
                                wire:keydown.enter="export"
                                max="{{ \Carbon\Carbon::today()->toDateString() }}"
                                />
                <x-jet-input-error for="startDate" class="mt-2" />
            </div>
            <div class="my-4">
                <x-jet-label for="finishDate" value="{{ __('Finish') }}" />
                <x-jet-input type="date" class="mt-1 block w-3/4"
                                x-ref="finishDate"
                                wire:model.defer="finishDate"
                                wire:keydown.enter="export"
                                max="{{ \Carbon\Carbon::today()->toDateString() }}"
                                />
                <x-jet-input-error for="finishDate" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingExportModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="export" wire:loading.attr="disabled">
                {{ __('Export') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>