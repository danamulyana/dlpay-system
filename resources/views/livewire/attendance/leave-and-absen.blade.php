<div>
    <h2 class="intro-y text-lg font-medium mt-10">Data Leave & Absence</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add Leave&Absence</button>
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
                            CATEGORY
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            KETERANGAN
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            LAST UPDATE  
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absences as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $absences->count() * ($absences->currentPage() - 1) + $loop->iteration}}</td>
                        <td class="text-center">{{ $data->category }}</td>
                        <td class="text-center">{{ $data->remark }}</td>
                        <td class="text-center">{{ $data->updated_at->diffForHumans() }}</td>
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
        {{ $absences->links() }}
    </div>
    {{-- EDIT Modal --}}
    <x-jet-dialog-modal wire:model="confirmingEditModal">
        <x-slot name="title">
            {{ 'Ubah Data Leave & Absence' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="data.remark" value="{{ __('Keterangan') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Keterangan') }}"
                                x-ref="data.remark"
                                wire:model.defer="data.remark"
                                wire:keydown.enter="edit" />

                <x-jet-input-error for="data.remark" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="data.category" value="{{ __('Nama Category') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model.defer="data.category">
                    <option value=""> --- Select Category --- </option>
                    <option value="payroll deductions">Payroll Deductions</option>
                    <option value="salary increase">Salary Increase</option>
                </select>
                <x-jet-input-error for="data.category" class="mt-2" />
            </div>
            <div class="mb-5 mt-10">
                <div class="w-full flex justify-center border-t border-gray-200 dark:border-dark-5 mt-2"> 
                    <div class="bg-white dark:bg-dark-3 px-5 -mt-3 text-gray-600">Value Tiap Golongan</div> 
                </div> 
            </div>
            {{-- Golongan 1 --}}
            <div class="Golongan1">
                <div class="mt-5">
                    <x-jet-label for="data.value_1A" value="{{ __('Golongan 1A') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_1A"
                                    wire:model.defer="data.value_1A"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_1A" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_1B" value="{{ __('Golongan 1B') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_1B"
                                    wire:model.defer="data.value_1B"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_1B" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_1C" value="{{ __('Golongan 1C') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_1C"
                                    wire:model.defer="data.value_1C"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_1C" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_1D" value="{{ __('Golongan 1D') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_1D"
                                    wire:model.defer="data.value_1D"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_1D" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_1E" value="{{ __('Golongan 1E') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_1E"
                                    wire:model.defer="data.value_1E"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_1E" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_1F" value="{{ __('Golongan 1F') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_1F"
                                    wire:model.defer="data.value_1F"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_1F" class="mt-2" />
                </div>
            </div>
            {{-- END: Golongan 1 --}}
            {{-- Golongan 2 --}}
            <div class="Golongan2">
                <div class="mt-5">
                    <x-jet-label for="data.value_2A" value="{{ __('Golongan 2A') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_2A"
                                    wire:model.defer="data.value_2A"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_2A" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_2B" value="{{ __('Golongan 2B') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_2B"
                                    wire:model.defer="data.value_2B"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_2B" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_2C" value="{{ __('Golongan 2C') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_2C"
                                    wire:model.defer="data.value_2C"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_2C" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_2D" value="{{ __('Golongan 2D') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_2D"
                                    wire:model.defer="data.value_2D"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_2D" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_2E" value="{{ __('Golongan 2E') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_2E"
                                    wire:model.defer="data.value_2E"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_2E" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_2F" value="{{ __('Golongan 2F') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_2F"
                                    wire:model.defer="data.value_2F"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_2F" class="mt-2" />
                </div>
            </div>
            {{-- END: Golongan 2 --}}
            {{-- Golongan 3 --}}
            <div class="Golongan3">
                <div class="mt-5">
                    <x-jet-label for="data.value_3A" value="{{ __('Golongan 3A') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_3A"
                                    wire:model.defer="data.value_3A"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_3A" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_3B" value="{{ __('Golongan 3B') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_3B"
                                    wire:model.defer="data.value_3B"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_3B" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_3C" value="{{ __('Golongan 3C') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_3C"
                                    wire:model.defer="data.value_3C"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_3C" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_3D" value="{{ __('Golongan 3D') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_3D"
                                    wire:model.defer="data.value_3D"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_3D" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_3E" value="{{ __('Golongan 3E') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_3E"
                                    wire:model.defer="data.value_3E"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_3E" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_3F" value="{{ __('Golongan 3F') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_3F"
                                    wire:model.defer="data.value_3F"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_3F" class="mt-2" />
                </div>
            </div>
            {{-- END: Golongan 3 --}}
            {{-- Golongan 4 --}}
            <div class="Golongan4">
                <div class="mt-5">
                    <x-jet-label for="data.value_4A" value="{{ __('Golongan 4A') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_4A"
                                    wire:model.defer="data.value_4A"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_4A" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_4B" value="{{ __('Golongan 4B') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_4B"
                                    wire:model.defer="data.value_4B"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_4B" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_4C" value="{{ __('Golongan 4C') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_4C"
                                    wire:model.defer="data.value_4C"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_4C" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_4D" value="{{ __('Golongan 4D') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_4D"
                                    wire:model.defer="data.value_4D"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_4D" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_4E" value="{{ __('Golongan 4E') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_4E"
                                    wire:model.defer="data.value_4E"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_4E" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.value_4F" value="{{ __('Golongan 4F') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.value_4F"
                                    wire:model.defer="data.value_4F"
                                    wire:keydown.enter="edit" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.value_4F" class="mt-2" />
                </div>
            </div>
            {{-- END: Golongan 4 --}}
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
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Add Data Leave & Absence' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="state.remark" value="{{ __('Keterangan') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Keterangan') }}"
                                x-ref="state.remark"
                                wire:model.defer="state.remark"
                                wire:keydown.enter="add" />

                <x-jet-input-error for="state.remark" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="state.category" value="{{ __('Nama Category') }}" />
                <select class="form-control form-select mt-2 w-3/4" wire:model.defer="state.category">
                    <option value=""> --- Select Category --- </option>
                    <option value="payroll deductions">Payroll Deductions</option>
                    <option value="salary increase">Salary Increase</option>
                </select>
                <x-jet-input-error for="state.category" class="mt-2" />
            </div>
            

            <div class="mb-5 mt-10">
                <div class="w-full flex justify-center border-t border-gray-200 dark:border-dark-5 mt-2"> 
                    <div class="bg-white dark:bg-dark-3 px-5 -mt-3 text-gray-600">Value Tiap Golongan</div> 
                </div> 
            </div>
            {{-- Golongan 1 --}}
            <div class="Golongan1">
                <div class="mt-5">
                    <x-jet-label for="state.1A" value="{{ __('Golongan 1A') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.1A"
                                    wire:model.defer="state.1A"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.1A" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.1B" value="{{ __('Golongan 1B') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.1B"
                                    wire:model.defer="state.1B"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.1B" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.1C" value="{{ __('Golongan 1C') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.1C"
                                    wire:model.defer="state.1C"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.1C" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.1D" value="{{ __('Golongan 1D') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.1D"
                                    wire:model.defer="state.1D"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.1D" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.1E" value="{{ __('Golongan 1E') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.1E"
                                    wire:model.defer="state.1E"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.1E" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.1F" value="{{ __('Golongan 1F') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.1F"
                                    wire:model.defer="state.1F"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.1F" class="mt-2" />
                </div>
            </div>
            {{-- END: Golongan 1 --}}
            {{-- Golongan 2 --}}
            <div class="Golongan2">
                <div class="mt-5">
                    <x-jet-label for="state.2A" value="{{ __('Golongan 2A') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.2A"
                                    wire:model.defer="state.2A"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.2A" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.2B" value="{{ __('Golongan 2B') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.2B"
                                    wire:model.defer="state.2B"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.2B" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.2C" value="{{ __('Golongan 2C') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.2C"
                                    wire:model.defer="state.2C"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.2C" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.2D" value="{{ __('Golongan 2D') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.2D"
                                    wire:model.defer="state.2D"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.2D" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.2E" value="{{ __('Golongan 2E') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.2E"
                                    wire:model.defer="state.2E"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.2E" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.2F" value="{{ __('Golongan 2F') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.2F"
                                    wire:model.defer="state.2F"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.2F" class="mt-2" />
                </div>
            </div>
            {{-- END: Golongan 2 --}}
            {{-- Golongan 3 --}}
            <div class="Golongan3">
                <div class="mt-5">
                    <x-jet-label for="state.3A" value="{{ __('Golongan 3A') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.3A"
                                    wire:model.defer="state.3A"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.3A" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.3B" value="{{ __('Golongan 3B') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.3B"
                                    wire:model.defer="state.3B"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.3B" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.3C" value="{{ __('Golongan 3C') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.3C"
                                    wire:model.defer="state.3C"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.3C" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.3D" value="{{ __('Golongan 3D') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.3D"
                                    wire:model.defer="state.3D"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.3D" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.3E" value="{{ __('Golongan 3E') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.3E"
                                    wire:model.defer="state.3E"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.3E" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.3F" value="{{ __('Golongan 3F') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.3F"
                                    wire:model.defer="state.3F"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.3F" class="mt-2" />
                </div>
            </div>
            {{-- END: Golongan 3 --}}
            {{-- Golongan 4 --}}
            <div class="Golongan4">
                <div class="mt-5">
                    <x-jet-label for="state.4A" value="{{ __('Golongan 4A') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.4A"
                                    wire:model.defer="state.4A"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.4A" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.4B" value="{{ __('Golongan 4B') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.4B"
                                    wire:model.defer="state.4B"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.4B" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.4C" value="{{ __('Golongan 4C') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.4C"
                                    wire:model.defer="state.4C"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.4C" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.4D" value="{{ __('Golongan 4D') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.4D"
                                    wire:model.defer="state.4D"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.4D" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.4E" value="{{ __('Golongan 4E') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.4E"
                                    wire:model.defer="state.4E"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.4E" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="state.4F" value="{{ __('Golongan 4F') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="state.4F"
                                    wire:model.defer="state.4F"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="state.4F" class="mt-2" />
                </div>
            </div>
            {{-- END: Golongan 4 --}}
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
