<div>
    <h2 class="intro-y text-lg font-medium mt-10">Doorlock Schadule</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @can('schadule_create')
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add Schadule</button>
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
                        {{-- <th class="text-center whitespace-nowrap cursor-pointer">NO</th> --}}
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            ID
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            NAMA
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            Tanggal Awal
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            Tanggal Akhir
                        </th>
                        @if(auth()->user()->can('schadule_edit') || auth()->user()->can('schadule_delete'))
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $d->nama }}</td>
                        <td class="text-center">{{ $d->tanggal_awal }}</td>
                        <td class="text-center">{{ $d->tanggal_akhir}}</td>
                        @if(auth()->user()->can('schadule_edit') || auth()->user()->can('schadule_delete'))
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                @can('schadule_edit')
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $d->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    Edit
                                </button>
                                @endcan
                                @can('schadule_delete')
                                <button class="flex items-center text-theme-6" wire:click="showmodalDelete({{ $d->id }})">
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
        {{ $data->links() }}
        <!-- END: Pagination -->
    </div>
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Add Schadule' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="name" value="{{ __('Schadule') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Schadule') }}"
                                x-ref="name"
                                wire:model.defer="name"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="tanggalawal" value="{{ __('Tanggal Awal') }}" />
                <x-jet-input type="date" class="mt-1 block w-3/4"
                                placeholder="{{ __('Tanggal Awal') }}"
                                x-ref="tanggalawal"
                                wire:model.defer="tanggalawal"
                                wire:keydown.enter="add" />
                <x-jet-input-error for="tanggalawal" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="tanggalakhir" value="{{ __('Tanggal Akhir') }}" />
                <x-jet-input type="date" class="mt-1 block w-3/4"
                                placeholder="{{ __('Tanggal Akhir') }}"
                                x-ref="tanggalakhir"
                                wire:model.defer="tanggalakhir"
                                wire:keydown.enter="add" />
                <x-jet-input-error for="tanggalakhir" class="mt-2" />
            </div>

            {{-- Doorlock --}}

            <div class="mt-5" wire:ignore>
                <x-jet-label for="deviceData" value="{{ __('DoorLock') }}" />

                <x-select2-multiple id="deviceData" wire:model="deviceData">
                    @foreach ($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->uid }} | {{ $device->name }}</option>
                    @endforeach
                </x-select2-multiple>
                    
                <x-jet-input-error for="deviceData" class="mt-2" />
            </div>

            {{-- END : Doorlock --}}
            {{-- Karyawan --}}

            <div class="mt-5" wire:ignore>
                <x-jet-label for="karyawanData" value="{{ __('Karyawan') }}" />

                <x-select2-multiple id="karyawanData" wire:model="karyawanData">
                    @foreach ($karyawan as $d)
                    <option value="{{ $d->id }}">{{ $d->nip }} | {{ $d->nama }}</option>
                    @endforeach
                </x-select2-multiple>
                    
                <x-jet-input-error for="karyawanData" class="mt-2" />
            </div>

            {{-- END : Karyawan --}}
            
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
    {{-- Edit Modal --}}
    <x-jet-dialog-modal wire:model="confirmingEditModal">
        <x-slot name="title">
            {{ 'Edit Schadule' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="dataEdit.nama" value="{{ __('Schadule') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Schadule') }}"
                                x-ref="dataEdit.nama"
                                wire:model.defer="dataEdit.nama"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="dataEdit.nama" class="mt-2" />
            </div>
            <div class="my-4">
                <x-jet-label for="dataEdit.tanggalawal" value="{{ __('Tanggal Awal') }}" />
                <x-jet-input type="date" class="mt-1 block w-3/4"
                                placeholder="{{ __('Tanggal Awal') }}"
                                x-ref="dataEdit.tanggalawal"
                                wire:model.defer="dataEdit.tanggal_awal"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="dataEdit.tanggalawal" class="mt-2" />
            </div>
            <div class="my-4">
                <x-jet-label for="dataEdit.tanggal_akhir" value="{{ __('Tanggal Akhir') }}" />
                <x-jet-input type="date" class="mt-1 block w-3/4"
                                placeholder="{{ __('Tanggal Akhir') }}"
                                x-ref="dataEdit.tanggal_akhir"
                                wire:model.defer="dataEdit.tanggal_akhir"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="dataEdit.tanggal_akhir" class="mt-2" />
            </div>
            <div class="mt-5" wire:ignore>
                <x-jet-label for="doorlockDataEdit" value="{{ __('Doorlock') }}" />

                <div wire:ignore>
                    <select id="doorlockDataEdit" class=" select2" multiple="multiple" style="width: 75%;" wire:model="doorlockDataEdit">
                        @foreach ($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->uid }} | {{ $device->name }}</option>
                        @endforeach
                    </select>
                </div>
                    
                <x-jet-input-error for="doorlockDataEdit" class="mt-2" />
            </div>
            <div class="mt-5" wire:ignore>
                <x-jet-label for="karyawanDataEdit" value="{{ __('Doorlock') }}" />

                <div wire:ignore>
                    <select id="karyawanDataEdit" class=" select2" multiple="multiple" style="width: 75%;" wire:model="karyawanDataEdit">
                        @foreach ($karyawan as $d)
                        <option value="{{ $d->id }}">{{ $d->nip }} | {{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>
                    
                <x-jet-input-error for="karyawanDataEdit" class="mt-2" />
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
            {{ 'Delete Doorlock Device' }}
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

@push('scripts')
    <script>
        document.addEventListener('livewire:load', () => {
            $('#doorlockDataEdit').select2().on('change', function (e) {
                let data = $(this).val();
                @this.set('doorlockDataEdit', data);
            });
        })
        Livewire.on('select2modal', () => {
            $('#doorlockDataEdit').trigger('change');   //the trigerr data selected into modal
        }); 
        document.addEventListener('livewire:load', () => {
            $('#karyawanDataEdit').select2().on('change', function (e) {
                let data = $(this).val();
                @this.set('karyawanDataEdit', data);
            });
        })
        Livewire.on('select2modal', () => {
            $('#karyawanDataEdit').trigger('change');   //the trigerr data selected into modal
        }); 
    </script>
@endpush