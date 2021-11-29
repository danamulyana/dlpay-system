<div>
    <h2 class="intro-y text-lg font-medium mt-10">Monthly Payroll</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <div>
                <a class="btn btn-primary shadow-md mr-2" href="{{ route('payroll.monthly') }}">Back</a>
            </div>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <div class="dropdown ml-auto sm:ml-0 pl-3">
                    <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
                        <span class="h-5 flex items-center justify-center"> <i class="las la-print"></i> Export</span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <form action="{{ route('monthlyExcelDownload') }}" method="post">
                                @csrf
                                <input type="hidden" name="month" value="{{ $month }}">
                                <button type="submit" class="flex w-full items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="las la-file-excel"></i> Export Excel </button>
                            </form>
                            <form action="{{ route('monthlyCSVDownload') }}" method="post">
                                @csrf
                                <input type="hidden" name="month" value="{{ $month }}">
                                <button type="submit" class="flex w-full items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="las la-file-csv"></i> Export Csv </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">NO</th>
                        <th class="text-center whitespace-nowrap">NAMA</th>
                        <th class="text-center whitespace-nowrap">DEPARTEMENT</th>
                        <th class="text-center whitespace-nowrap">TOTAL SALARY</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $data->karyawan->nama }}</td>
                        <td class="text-center">{{ $data->karyawan->departement->nama }}</td>
                        <td class="text-center">{{ currencyNumericToIDR($data->total_payment) }}</td>
                        <td class="table-report__action w-56">
                            @if (!$data->Approve)
                                <div class="flex justify-center items-center">
                                    <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $data->id }})">
                                        <i class="las la-check-square"></i> Edit
                                    </button>
                                    <button class="flex items-center text-theme-20" wire:click="approvall({{ $data->id }})">
                                        <i class="las la-check-circle"></i> Approve
                                    </button>
                                </div>
                            @else
                                <div class="flex justify-center items-center">
                                    <span class="flex items-center text-theme-20">Approved</span>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $datas->links() }}
        <!-- END: Pagination -->
    </div>
    {{-- edit Modal --}}
    <x-jet-dialog-modal wire:model="confirmingEditModal">
        <x-slot name="title">
            {{ 'Edit Payroll : ' . $user_name}}
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label for="ti" value="{{ __('Transaction Id') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                x-ref="ti"
                                wire:model.defer="payrols.Transaction_id"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="user_name" value="{{ __('Nama') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Nama') }}"
                                x-ref="user_name"
                                wire:model.defer="user_name"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="payrols.overtime" value="{{ __('Overtime') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Nama') }}"
                                x-ref="payrols.user_id"
                                wire:model.defer="payrols.overtime"
                                wire:keydown.enter="edit" 
                                />
                <div class="form-help">isi dalam satuan jam contoh : 10 .</div>

                <x-jet-input-error for="payrols.overtime" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="deductions" value="{{ __('Payroll Deduction') }}" />
                <div wire:ignore>
                    <select id="deductions" class="select2" multiple="multiple" style="width: 75%;" wire:model="deductionsEdit">
                        @foreach ($deductions as $value)
                        <option value="{{ $value->id }}">{{ $value->remark }}</option>
                        @endforeach
                    </select>
                </div>
                <x-jet-input-error for="deductions" class="mt-2" />
            </div>
            <div class="mt-5">
                <x-jet-label for="salaryincris" value="{{ __('Salary Increase') }}" />
                <div wire:ignore>
                    <select id="salaryincris" class="select2" multiple="multiple" style="width: 75%;" wire:model="salaryincrisEdit">
                        @foreach ($salaryincris as $value)
                        <option value="{{ $value->id }}">{{ $value->remark }}</option>
                        @endforeach
                    </select>
                </div>
                <x-jet-input-error for="salaryincris" class="mt-2" />
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
@push('scripts')
    <script>
        document.addEventListener('livewire:load', () => {
            $('#deductions').select2().on('change', function (e) {
                let data = $(this).val();
                @this.set('deductionsEdit', data);
            });
            $('#salaryincris').select2().on('change', function (e) {
                let data = $(this).val();
                @this.set('salaryincrisEdit', data);
            });
        })
        Livewire.on('select2modal', () => {
            $('#deductions').trigger('change');   //the trigerr data selected into modal
            $('#salaryincris').trigger('change');   //the trigerr data selected into modal
        }); 
    </script>
@endpush