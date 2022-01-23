<div>
    <h2 class="intro-y text-lg font-medium mt-10">Doorlock Schadule</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @can('doorlockDevice_create')
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
                            DOORLOCK
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            KARYAWAN
                        </th>
                        @if(auth()->user()->can('doorlockDevice_edit') || auth()->user()->can('doorlockDevice_delete'))
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $d)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        {{-- <td class="text-center">{{ $loop->index + 1}}</td> --}}
                        <td class="text-center">{{ $d->uid}}</td>
                        <td class="text-center">{{ $d->name }}</td>
                        <td class="text-center">{{ $d->Location->name }}</td>
                        <td class="text-center">{{ $d->type }}</td>
                        <td class="text-center">{{ $d->access_mode === 0 ? 'Tidak' : 'Ya' }}</td>
                        @if(auth()->user()->can('doorlockDevice_edit') || auth()->user()->can('doorlockDevice_delete'))
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                @can('doorlockDevice_edit')
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $d->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    Edit
                                </button>
                                @endcan
                                @can('doorlockDevice_delete')
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
        {{-- {{ $data->links() }} --}}
        <!-- END: Pagination -->
    </div>
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Add Schadule' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('nama') }}"
                                x-ref="name"
                                wire:model.defer="name"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="tanggalawal" value="{{ __('Type Access') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Tanggal Awal') }}"
                                x-ref="tanggalawal"
                                wire:model.defer="tanggalawal"
                                wire:keydown.enter="add" />
                <x-jet-input-error for="tanggalawal" class="mt-2" />
            </div>

            <div class="mt-5">
                <x-jet-label for="type" value="{{ __('Tipe Ruangan') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model.defer="type">
                    <option value=""> --- Select Tipe Ruangan --- </option>
                    <option value="public">public</option>
                    <option value="restricted">restricted</option>
                </select>
                <x-jet-input-error for="type" class="mt-2" />
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
    {{-- Edit Modal --}}
    {{-- <x-jet-dialog-modal wire:model="confirmingEditModal">
        <x-slot name="title">
            {{ 'Edit Device Attendance' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="data.name" value="{{ __('Nama') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('nama Device') }}"
                                x-ref="data.name"
                                wire:model.defer="data.name"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="data.name" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="data.location_id" value="{{ __('Nama Location') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model.defer="data.location_id">
                    <option value=""> --- Select data location --- </option>
                    @foreach ($locations as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="data.location_id" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="data.access_type" value="{{ __('Type Access') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model="data.access_type">
                    <option value=""> --- Select data type --- </option>
                    <option value="in">IN</option>
                    <option value="out">OUT</option>
                </select>
                <x-jet-input-error for="data.access_type" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="type" value="{{ __('Tipe Ruangan') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model.defer="data.type">
                    <option value=""> --- Select Tipe Ruangan --- </option>
                    <option value="public">public</option>
                    <option value="restricted">restricted</option>
                </select>
                <x-jet-input-error for="type" class="mt-2" />
            </div>
            <div>
                <div class="mt-3"> 
                    <label>Remark</label>
                    <div class="mt-2">
                        <div class="form-check"> 
                            <input class="form-check-switch" type="checkbox" wire:model="data.access_mode"> 
                        </div>
                    </div>
                </div>
    
                <div>
                    <div class="mt-5" wire:ignore>
                        <x-jet-label for="remarkDataEdit" value="{{ __('Remarks') }}" />

                        <div wire:ignore>
                            <select id="remarkEdit" class=" select2" multiple="multiple" style="width: 75%;" wire:model="remarkDataEdit">
                                @foreach ($remarks as $remark)
                                <option value="{{ $remark->id }}">{{ $remark->name }}</option>
                                @endforeach
                            </select>
                        </div>
                            
                        <x-jet-input-error for="remarkDataEdit" class="mt-2" />
                    </div>
                </div>
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
    </x-jet-dialog-modal> --}}
    {{-- Delete Modal --}}
    {{-- <x-jet-dialog-modal wire:model="confirmingDeleteModal">
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
    </x-jet-dialog-modal> --}}
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', () => {
            $('#remarkEdit').select2().on('change', function (e) {
                let data = $(this).val();
                @this.set('remarkDataEdit', data);
            });
        })
        Livewire.on('select2modal', () => {
            $('#remarkEdit').trigger('change');   //the trigerr data selected into modal
        }); 
    </script>
@endpush