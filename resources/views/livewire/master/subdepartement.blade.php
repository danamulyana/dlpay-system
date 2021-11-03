<div>
    <h2 class="intro-y text-lg font-medium mt-10">Data Sub Departement</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add SubDepartement</button>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">NAMA DEPARTEMENT</th>
                        <th class="text-center whitespace-nowrap">NAMA SUB DEPARTEMENT</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $data->departement->nama }}</td>
                        <td class="text-center">{{ $data->nama }}</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $data->id }})">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </button>
                                <button class="flex items-center text-theme-6" wire:click="showmodalDelete({{ $data->id }})">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
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
        
        <!-- END: Pagination -->
    </div>
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{'Add SubDepartement'}}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <div class="mt-5">
                    <x-jet-label for="departement" value="{{ __('Nama Departement') }}" />
                    <select class="form-control form-select form-select-sm mt-2 w-3/4" wire:model="departement">
                        <option value="">--- Select data departement ---</option>
                        @foreach ($dept_data as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="departement" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="nama" value="{{ __('Nama Subdepartement') }}" />
                    <x-jet-input type="nama" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Nama subdepartement') }}"
                                    x-ref="nama"
                                    wire:model.defer="nama"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="nama" class="mt-2" />
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
    {{-- Edit modal --}}
    <x-jet-dialog-modal wire:model="confirmingEditModal">
        <x-slot name="title">
            {{'Edit SubDepartement'}}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <div class="mt-5">
                    <x-jet-label for="departement" value="{{ __('Nama Departement') }}" />
                    <select class="form-control form-select form-select-sm mt-2 w-3/4" wire:model="departement">
                        <option value="">--- Select data departement ---</option>
                        @foreach ($dept_data as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="departement" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="nama" value="{{ __('Nama Subdepartement') }}" />
                    <x-jet-input type="nama" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Nama subdepartement') }}"
                                    x-ref="nama"
                                    wire:model.defer="nama"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="nama" class="mt-2" />
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
            {{ 'Delete Departement' }}
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