<div>
    <h2 class="intro-y text-lg font-medium mt-10">Data Jam Kerja</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @can('workingTime_create')
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add Jam Kerja</button>
            @endcan
            <div></div>
            <div class="w-full flex sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <select class="w-20 form-select box mt-3 sm:mt-0 mr-5" wire:model="perPage">
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="35">35</option>
                    <option value="50">50</option>
                </select>
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input wire:model="searchTerms" type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr >
                        <th class="text-center whitespace-nowrap cursor-pointer">NO</th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            NAMA
                            <span wire:click="sortBy('shift_name')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'nama' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'nama' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            JAM MASUK
                            <span wire:click="sortBy('jam_masuk')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'job_title' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'job_title' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            JAM KELUAR
                            <span wire:click="sortBy('jam_keluar')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'job_title' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'job_title' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        @if(auth()->user()->can('workingTime_edit') || auth()->user()->can('workingTime_delete'))
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workingTimes as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $data->shift_name }}</td>
                        <td class="text-center">{{ $data->jam_masuk }}</td>
                        <td class="text-center">{{ $data->jam_keluar }}</td>
                        @if(auth()->user()->can('workingTime_edit') || auth()->user()->can('workingTime_delete'))
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                @can('workingTime_edit')
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    Edit
                                </button>
                                @endcan
                                @can('workingTime_delete')
                                <button class="flex items-center text-theme-6" wire:click="showmodalDelete({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    Delete
                                </button>
                                @endcan
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $workingTimes->links() }}
        <!-- END: Pagination -->
    </div>
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Tambah Jam Kerja' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="nama" value="{{ __('Nama Shift') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Nama Shift') }}"
                                x-ref="nama"
                                wire:model.defer="nama"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="nama" class="mt-2" />
            </div>
            <div class="my-4">
                <x-jet-label for="jam_masuk" value="{{ __('Jam Masuk') }}" />
                <x-jet-input type="time" class="mt-1 block w-3/4"
                                placeholder="{{ __('Jam Masuk') }}"
                                x-ref="jam_masuk"
                                wire:model.defer="jam_masuk"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="jam_masuk" class="mt-2" />
            </div>
            <div class="my-4">
                <x-jet-label for="jam_keluar" value="{{ __('Jam Keluar') }}" />
                <x-jet-input type="time" class="mt-1 block w-3/4"
                                placeholder="{{ __('Jam Keluar') }}"
                                x-ref="jam_keluar"
                                wire:model.defer="jam_keluar"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="jam_keluar" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingAddModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="add" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- EDIT Modal --}}
    <x-jet-dialog-modal wire:model="confirmingEditModal">
        <x-slot name="title">
            {{ 'Ubah Jam kerja' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="data.shift_name" value="{{ __('Nama Shift') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Nama Shift') }}"
                                x-ref="data.shift_name"
                                wire:model.defer="data.shift_name"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="data.shift_name" class="mt-2" />
            </div>
            <div class="my-4">
                <x-jet-label for="data.jam_masuk" value="{{ __('Jam Masuk') }}" />
                <x-jet-input type="time" class="mt-1 block w-3/4"
                                placeholder="{{ __('Jam Masuk') }}"
                                x-ref="data.jam_masuk"
                                wire:model.defer="data.jam_masuk"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="jam_masuk" class="mt-2" />
            </div>
            <div class="my-4">
                <x-jet-label for="data.jam_keluar" value="{{ __('Jam Keluar') }}" />
                <x-jet-input type="time" class="mt-1 block w-3/4"
                                placeholder="{{ __('Jam Keluar') }}"
                                x-ref="data.jam_keluar"
                                wire:model.defer="data.jam_keluar"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="data.jam_keluar" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingEditModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="edit" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- Delete Modal --}}
    <x-jet-dialog-modal wire:model="confirmingDeleteModal">
        <x-slot name="title">
            {{ 'Hapus Jam kerja' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="delete" />

                <x-jet-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingDeleteModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>