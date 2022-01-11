
<div>
    <div>
        <h2 class="intro-y text-lg font-medium mt-10">Absence Report</h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
                <div></div>
                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                        <div class="w-56 relative text-gray-700 dark:text-gray-300">
                            <input wire:model="searchTerms" type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search nama pegawai...">
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
                                JAM MASUK
                                <span wire:click="sortBy('jam_masuk')" class="float-right text-sm cursor-pointer">
                                    <i class="las la-arrow-up {{ $sortColumnName === 'jam_masuk' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                    <i class="las la-arrow-down {{ $sortColumnName === 'jam_masuk' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                                </span>
                            </th>
                            <th class="text-center whitespace-nowrap">
                                JAM KELUAR
                                <span wire:click="sortBy('jam_keluar')" class="float-right text-sm cursor-pointer">
                                    <i class="las la-arrow-up {{ $sortColumnName === 'jam_keluar' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                    <i class="las la-arrow-down {{ $sortColumnName === 'jam_keluar' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                                </span>
                            </th>
                            <th class="text-center whitespace-nowrap">
                                STATUS
                                <span wire:click="sortBy('jam_keluar')" class="float-right text-sm cursor-pointer">
                                    <i class="las la-arrow-up {{ $sortColumnName === 'jam_keluar' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                    <i class="las la-arrow-down {{ $sortColumnName === 'jam_keluar' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
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
                        @foreach ($datas as $data)
                        <tr class="intro-x" wire:key="{{ $loop->index }}">
                            <td class="text-center">{{ $datas->count() * ($datas->currentPage() - 1) + $loop->iteration}}</td>
                            <td class="text-center">{{ $data->karyawan->nama }}</td>
                            <td class="text-center">{{ $data->jam_masuk }}</td>
                            <td class="text-center">{{ $data->jam_Keluar ?: 'Belum Keluar' }}</td>
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
            {{ $datas->links() }}
            <!-- END: Pagination -->
        </div>
    </div>
    <x-jet-dialog-modal wire:model="confirmingViewModal">
        <x-slot name="title">
            {{ 'Absence : ' . $viewName }}
        </x-slot>
    
        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="name" value="{{ __('NAMA PEGAWAI') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="name"
                                wire:model.defer="viewKaryawan.nama"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="status" value="{{ __('STATUS') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="status"
                                wire:model.defer="views.keterangan"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="keterangan Detail" value="{{ __('DETAIL KETERANGAN') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="keterangan Detail"
                                wire:model.defer="views.keterangan_detail"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="jamMasuk" value="{{ __('JAM MASUK') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="jamMasuk"
                                wire:model.defer="views.jam_masuk"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="jamKeluar" value="{{ __('JAM KELUAR') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="jamKeluar"
                                wire:model.defer="views.jam_Keluar"
                                disabled
                                />
            </div>
            
            <div class="my-4">
                <x-jet-label for="jamMasuk_foto" value="{{ __('JAM MASUK FOTO') }}" />
                <img src="{{ asset($viewPhotoMasuk) }}" alt="{{ $viewName }}" width="300">
            </div>
            <div class="my-4">
                <x-jet-label for="jamKeluar_foto" value="{{ __('JAM KELUAR FOTO') }}" />
                <img src="{{asset($viewPhotoKeluar)}}" alt="{{ $viewName }}" width="300">
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-button wire:click="$toggle('confirmingViewModal')" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
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
