<div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Monthly Payroll
        </h2>
    </div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
        <div></div>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-primary shadow-md mr-2 ml-4" wire:click="showmodal">Add Payroll</button>
        </div>
    </div>
    <div class="intro-y box p-5 mt-5">
        <div class="overflow-x-auto"> 
             <table class="table"> 
                 <thead> 
                    <tr> 
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                            #
                        </th> 
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">
                            Month
                        </th> 
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap text-center">Actions</th> 
                    </tr> 
                </thead> 
                <tbody>
                    @foreach ($monthlys as $month)
                    <tr wire:key="{{ $loop->index }}"> 
                        <td class="border-b dark:border-dark-5">{{ $loop->index + 1 }}</td> 
                        <td class="border-b dark:border-dark-5 text-center">{{ $month->created_at->format('m-d-Y') }}</td> 
                        <td class="border-b dark:border-dark-5">
                            <div class="flex justify-center items-center">
                                <a href="{{ route('payroll.monthly.list',['month' => $month->created_at->format('Y-m-d')]) }}" class="flex items-center mr-3" >
                                    <i class="las la-check-square"></i> View
                                </a>
                                <button class="flex items-center text-theme-6" wire:click="showmodalDelete('{{ $month->created_at }}')">
                                    <i class="las la-trash-alt"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr> 
                    @endforeach
                </tbody> 
            </table> 
            {{ $monthlys->links() }}
        </div> 
    </div>
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Create Payroll' }}
        </x-slot>
    
        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="start_date" value="{{ __('Tanggal Awal') }}" />
                <x-jet-input type="date" class="mt-1 block w-3/4"
                                placeholder="{{ __('Tanggal Akhir') }}"
                                x-ref="start_date"
                                wire:model.defer="start_date"
                                wire:keydown.enter="add" />
    
                <x-jet-input-error for="start_date" class="mt-2" />
            </div>
            <div class="my-4">
                <x-jet-label for="finish_date" value="{{ __('Tanggal Akhir') }}" />
                <x-jet-input type="date" class="mt-1 block w-3/4"
                                placeholder="{{ __('Tanggal Akhir') }}"
                                x-ref="finish_date"
                                wire:model.defer="finish_date"
                                wire:keydown.enter="add" />
    
                <x-jet-input-error for="finish_date" class="mt-2" />
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
    {{-- Delete Modal --}}
    <x-jet-dialog-modal wire:model="confirmingDeleteModal">
        <x-slot name="title">
            {{ 'Delete Payroll' }}
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