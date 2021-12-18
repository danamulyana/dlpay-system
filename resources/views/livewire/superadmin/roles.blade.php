<div>
    <h2 class="intro-y text-lg font-medium mt-10">Roles</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add Role</button>
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
                            NAME ROLE
                            {{-- <span wire:click="sortBy('username')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'username' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'username' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span> --}}
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">PERMISIONS</th>
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $roles->count() * ($roles->currentPage() - 1) + $loop->iteration}}</td>
                        <td class="text-center">{{ $role->name  }}</td>
                        <td class="text-center">
                            @foreach($role->getPermissionNames() as $permission)
                                <button class="btn btn-primary mb-1 mt-1 mr-1">{{ $permission }}</button>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if (!$role->id == 1)
                            <div class="flex justify-center items-center">
                                <button class="flex items-center mr-3" wire:click="showmodalView({{ $role->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    View
                                </button>
                                <button class="flex items-center text-theme-6" wire:click="showmodalDelete({{ $role->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    Delete
                                </button>
                            </div>
                            @else
                            Tidak bisa di ubah
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Data not found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $roles->links() }}
        <!-- END: Pagination -->
    </div>
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Add Role' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-8">
                <div class="mt-5">
                    <x-jet-label for="name" value="{{ __('Nama Role') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Nama Role') }}"
                                    x-ref="name"
                                    wire:model.defer="name"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="name" class="mt-2" />
                </div>
            </div>
            <div class="mt-5" wire:ignore>
                <x-jet-label for="permisionsAdd" value="{{ __('Permisions') }}" />

                <x-select2-multiple id="permisionsAdd" wire:model="permisionsAdd">
                    @foreach ($Permisions as $p)
                    <option value="{{ $p->name }}">{{ $p->name }}</option>
                    @endforeach
                </x-select2-multiple>
            </div>
            <x-jet-input-error for="permisionsAdd" class="mt-2" />
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
    {{-- View Modal --}}
    <x-jet-dialog-modal wire:model="confirmingViewModal">
        <x-slot name="title">
            {{ 'Edit Role' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-8">
                <div class="mt-5">
                    <x-jet-label for="nameEdit" value="{{ __('Nama Role') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Nama Role') }}"
                                    x-ref="nameEdit"
                                    wire:model.defer="nameEdit"
                                    wire:keydown.enter="edit" />
    
                    <x-jet-input-error for="nameEdit" class="mt-2" />
                </div>
            </div>
            <div class="mt-5">
                <x-jet-label for="permisionsEdit" value="{{ __('Permisions') }}" />

                <div wire:ignore>
                    <select id="permisionsEdit" class="form-control select2" multiple="multiple" style="width: 75%;" wire:model="permisionEdit">
                        @foreach ($Permisions as $p)
                        <option value="{{ $p->name }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-jet-input-error for="permisionEdit" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingViewModal')" wire:loading.attr="disabled">
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
            {{ 'Delete Role' }}
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
            $('#permisionsEdit').select2().on('change', function (e) {
                let data = $(this).val();
                @this.set('permisionEdit', data);
            });
        })
        Livewire.on('select2permision', () => {
            $('#permisionsEdit').trigger('change');   //the trigerr data selected into modal
        }); 
    </script>
@endpush