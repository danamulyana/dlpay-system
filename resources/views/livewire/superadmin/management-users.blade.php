<div>
    <h2 class="intro-y text-lg font-medium mt-10">Data Users</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            @can('users_management_add')
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add User</button>
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
                            USERNAME
                            <span wire:click="sortBy('username')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'username' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'username' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
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
                            EMAIL
                            <span wire:click="sortBy('email')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'email' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'email' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            ROLE
                            {{-- <span wire:click="sortBy('email')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'email' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'email' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span> --}}
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $data->username }}</td>
                        <td class="text-center">{{ $data->name }}</td>
                        <td class="text-center">{{ $data->email }}</td>
                        <td class="text-center">
                            @if(!empty($data->getRoleNames()))
                                @foreach($data->getRoleNames() as $role)
                                    <label class="badge badge-success">{{ $role }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                @can('users_management_edit')
                                <button class="flex items-center mr-3" wire:click="showmodalView({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    View
                                </button>
                                @endcan
                                @can('users_management_delete')
                                <button class="flex items-center text-theme-6" wire:click="showmodalDelete({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    Delete
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $users->links() }}
        <!-- END: Pagination -->
    </div>
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Add User' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-8">
                <div class="my-4">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Name') }}"
                                    x-ref="data.name"
                                    wire:model.defer="data.name"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.name" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="username" value="{{ __('Username') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Username') }}"
                                    x-ref="data.username"
                                    wire:model.defer="data.username"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.username" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input type="email" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Email') }}"
                                    x-ref="data.email"
                                    wire:model.defer="data.email"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.email" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Password') }}"
                                    x-ref="data.password"
                                    wire:model.defer="data.password"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.password" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="password" value="{{ __('Password Confirmation') }}" />
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Password') }}"
                                    x-ref="data.password_confirmation"
                                    wire:model.defer="data.password_confirmation"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.password_confirmation" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="data.role" value="{{ __('Role') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="data.role">
                        <option value="">--- Select Role ---</option>
                        @foreach ($roles as $r)
                        <option value="{{$r->name}}">{{$r->name}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="data.role" class="mt-2" />
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
    {{-- viewConfirm Modal --}}
    <x-jet-dialog-modal wire:model="confirmingviewConfirmModal">
        <x-slot name="title">
            {{ 'Edit User' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="checkView" />

                <x-jet-input-error for="password" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingviewConfirmModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="checkView" wire:loading.attr="disabled">
                {{ __('Next') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- View Modal --}}
    <x-jet-dialog-modal wire:model="confirmingViewModal">
        <x-slot name="title">
            {{ 'Edit User' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-8">
                <div class="my-4">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Name') }}"
                                    x-ref="view.name"
                                    wire:model.defer="view.name"
                                    wire:keydown.enter="edit" />
    
                    <x-jet-input-error for="view.name" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="username" value="{{ __('Username') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Username') }}"
                                    x-ref="view.username"
                                    wire:model.defer="view.username"
                                    wire:keydown.enter="edit" />
    
                    <x-jet-input-error for="view.username" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input type="email" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Email') }}"
                                    x-ref="view.email"
                                    wire:model.defer="view.email"
                                    wire:keydown.enter="edit" />
    
                    <x-jet-input-error for="view.email" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Password') }}"
                                    x-ref="view.password"
                                    wire:model.defer="view.password"
                                    wire:keydown.enter="edit" />
    
                    <x-jet-input-error for="view.password" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="password" value="{{ __('Password Confirmation') }}" />
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Password') }}"
                                    x-ref="view.password_confirmation"
                                    wire:model.defer="view.password_confirmation"
                                    wire:keydown.enter="edit" />
    
                    <x-jet-input-error for="view.password_confirmation" class="mt-2" />
                </div>
                <div class="my-4">
                    <x-jet-label for="viewRole" value="{{ __('Role') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="viewRole">
                        @foreach ($roles as $r)
                        <option value="{{$r->name}}">{{$r->name}}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="viewRole" class="mt-2" />
                </div>
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
            {{ 'Delete User' }}
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