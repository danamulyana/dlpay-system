<div>
    <h2 class="intro-y text-lg font-medium mt-10">Data Leave & Absence</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
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
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $data->category }}</td>
                        <td class="text-center">{{ $data->remark }}</td>
                        <td class="text-center">{{ $data->updated_at->diffForHumans() }}</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
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
            <div class="my-4">
                <x-jet-label for="data.persentation" value="{{ __('Persentasi Pemotongan / Penambahan (%)') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('10%') }}"
                                x-ref="data.persentation"
                                wire:model.defer="data.persentation"
                                wire:keydown.enter="edit" />
    
                <x-jet-input-error for="data.persentation" class="mt-2" />
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
</div>