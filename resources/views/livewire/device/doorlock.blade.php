<div>
    <h2 class="intro-y text-lg font-medium mt-10">Data Doorlock Device</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add Doorlock Device</button>
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
                            <span wire:click="sortBy('id')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'id' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'id' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            NAMA
                            <span wire:click="sortBy('name')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            LOCATION
                            <span wire:click="sortBy('location_id')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'location_id' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'location_id' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            TIPE RUANGAN
                            <span wire:click="sortBy('type')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'type' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'type' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            REMARKS
                            <span wire:click="sortBy('priset_id')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'priset_id' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'priset_id' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doorlock as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        {{-- <td class="text-center">{{ $loop->index + 1}}</td> --}}
                        <td class="text-center">{{ $data->uid}}</td>
                        <td class="text-center">{{ $data->name }}</td>
                        <td class="text-center">{{ $data->Location->name }}</td>
                        <td class="text-center">{{ $data->type }}</td>
                        <td class="text-center">{{ $data->access_mode === 0 ? 'Tidak' : 'Ya' }}</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    Edit
                                </button>
                                <button class="flex items-center text-theme-6" wire:click="showmodalDelete({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    Delete
                                </button>
                            </div>
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
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Add Device Doorlock' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="uid" value="{{ __('Id') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('ID Device attendance') }}"
                                x-ref="uid"
                                wire:model.defer="uid"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="uid" class="mt-2" />
            </div>
            {{-- <div x-data="{ open: false }">
                <div class="mt-3"> 
                    <label>With Privilage</label>
                    <div class="mt-2">
                        <div class="form-check"> 
                            <input @click=" open = true " id="checkbox-switch-7" class="form-check-switch" type="checkbox" wire:model="withPrivilage"> 
                        </div>
                    </div>
                </div>
                <div class="mt-5" x-show="open" @click.away="open = false">
                    <x-jet-label for="name" value="{{ __('Privelage ') }}"/>
                </div>
            </div> --}}
            <div class="my-4">
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('nama Device') }}"
                                x-ref="name"
                                wire:model.defer="name"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="location" value="{{ __('Nama Location') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model.defer="location">
                    <option value=""> --- Select data location --- </option>
                    @foreach ($locations as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="location" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="accesstype" value="{{ __('Type Access') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model.defer="accesstype">
                    <option value=""> --- Select data type --- </option>
                    <option value="in">IN</option>
                    <option value="out">OUT</option>
                </select>
                <x-jet-input-error for="accesstype" class="mt-2" />
            </div>
            
            <div class="mt-5">
                <x-jet-label for="departement" value="{{ __('Nama Departement') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model="departement">
                    <option value=""> --- Select data departement --- </option>
                    @foreach ($departements as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="departement" class="mt-2" />
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

            <div x-data="{ open: false }">
                <div class="mt-3"> 
                    <label>Remark</label>
                    <div class="mt-2">
                        <div class="form-check"> 
                            <input @click="open = true" class="form-check-switch" type="checkbox" wire:model="access_mode"> 
                        </div>
                    </div>
                </div>
    
                <div x-show="open" @click.away="open = false">
                    <div class="mt-5" wire:ignore>
                        <x-jet-label for="remarkData" value="{{ __('Remarks') }}" />
        
                        <x-select2-multiple id="remarkData" wire:model="remarkData">
                            @foreach ($remarks as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach
                        </x-select2-multiple>
                            
                        <x-jet-input-error for="remarkData" class="mt-2" />
                    </div>
                </div>
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
    <x-jet-dialog-modal wire:model="confirmingEditModal">
        <x-slot name="title">
            {{ 'Edit Device Attendance' }}
        </x-slot>

        <x-slot name="content">
            {{-- <div class="mt-5">
                <x-jet-label for="dataPrivelage" value="{{ __('Privelage ') }}" />
                <x-multiselect wire:model="dataPrivelage" :options="{{ $employesFilter }}"></x-multiselect>

            </div> --}}
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
    </x-jet-dialog-modal>
    {{-- Delete Modal --}}
    <x-jet-dialog-modal wire:model="confirmingDeleteModal">
        <x-slot name="title">
            {{ 'Delete Location' }}
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