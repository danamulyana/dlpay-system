<div>
    <h2 class="intro-y text-lg font-medium mt-10">Data Attendance Device</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @can('attandanceDevice_create')
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add Attendance Device</button>
            @endcan
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
                            MODE
                            <span wire:click="sortBy('mode')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'mode' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'mode' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        @if(auth()->user()->can('attandanceDevice_edit') || auth()->user()->can('attandanceDevice_delete'))
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($device as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $data->id}}</td>
                        <td class="text-center">{{ $data->name }}</td>
                        <td class="text-center">{{ $data->Location->name }}</td>
                        <td class="text-center">{{ $data->mode }}</td>
                        @if(auth()->user()->can('attandanceDevice_edit') || auth()->user()->can('attandanceDevice_delete'))
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                @can('attandanceDevice_edit')
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    Edit
                                </button>
                                @endcan
                                @can('attandanceDevice_delete')
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
        {{ $device->links() }}
        <!-- END: Pagination -->
    </div>
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Add Device Attendance' }}
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
            <div class="my-4">
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('nama Device attendance') }}"
                                x-ref="name"
                                wire:model.defer="name"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="location" value="{{ __('Nama Location') }}" />
                <select class="form-control form-select form-select-sm mt-2 w-3/4" wire:model="location">
                    <option value="">--- Select data location ---</option>
                    @foreach ($locations as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="location" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="departement" value="{{ __('Nama Departement') }}" />
                <select class="form-control form-select form-select-sm mt-2 w-3/4" wire:model="departement">
                    <option value="">--- Select data departement ---</option>
                    @foreach ($departements as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="departement" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="mode" value="{{ __('Mode') }}" />
                <select class="form-control form-select form-select-sm mt-2 w-3/4" wire:model="mode">
                    <option value="">--- Select mode ---</option>
                    <option value="SCAN">SCAN</option>
                    <option value="ADD">ADD</option>
                </select>
                <x-jet-input-error for="mode" class="mt-2" />
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
            <div class="my-4">
                <x-jet-label for="data.name" value="{{ __('Nama') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('nama') }}"
                                x-ref="data.name"
                                wire:model.defer="data.name"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="data.name" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="data.location_id" value="{{ __('Nama Location') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model="data.location_id">
                    <option value="">--- Select data location ---</option>
                    @foreach ($locations as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="data.location_id" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="departement" value="{{ __('Nama Departement') }}" />
                <select class="form-control form-select form-select-sm mt-2 w-3/4" wire:model="data.departement_id">
                    <option value="">--- Select data departement ---</option>
                    @foreach ($departements as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="departement" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="mode" value="{{ __('Mode') }}" />
                <select class="form-control form-select form-select-sm mt-2 w-3/4" wire:model="data.mode">
                    <option value="SCAN">SCAN</option>
                    <option value="ADD">ADD</option>
                </select>
                <x-jet-input-error for="mode" class="mt-2" />
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