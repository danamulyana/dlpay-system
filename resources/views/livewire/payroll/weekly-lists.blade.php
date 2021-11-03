{{-- <div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Weekly Payroll
        </h2>
    </div>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
        <div>
            <a class="btn btn-primary shadow-md mr-2" href="{{ route('payroll.weekly') }}">Back</a>
        </div>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
            <div class="dropdown ml-auto sm:ml-0 pl-3">
                <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file-plus" class="w-4 h-4 mr-2"></i> New Category </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="users" class="w-4 h-4 mr-2"></i> New Group </a>
                    </div>
                </div>
            </div>
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
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                            Nama
                        </th> 
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                            Departement
                        </th> 
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">
                            Total Salary
                        </th> 
                        <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">Actions</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @foreach ($data as $item)
                    <tr wire:key="{{ $loop->index }}"> 
                        <td class="border-b dark:border-dark-5">{{ $loop->index +1 }}</td> 
                        <td class="border-b dark:border-dark-5">{{ $item->karyawan->nama }}</td> 
                        <td class="border-b dark:border-dark-5">{{ $item->karyawan->departement->nama }}</td> 
                        <td class="border-b dark:border-dark-5">{{ currencyNumericToIDR($item->total_payment) }}</td>
                        <td class="border-b dark:border-dark-5">
                            <div class="flex justify-center items-center">
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $item->id }})">
                                    <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                                </button>
                                <button class="flex items-center text-theme-20">
                                    <i class="las la-check-circle"></i> Approve
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody> 
            </table>  
        </div> 
    </div>
</div> --}}

<div>
    <h2 class="intro-y text-lg font-medium mt-10">Weekly Payroll</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <div>
                <a class="btn btn-primary shadow-md mr-2" href="{{ route('payroll.weekly') }}">Back</a>
            </div>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                </div>
                <div class="dropdown ml-auto sm:ml-0 pl-3">
                    <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="las la-print"></i> </span>
                    </button>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <form action="{{ route('weeklyExcelDownload') }}" method="post">
                                @csrf
                                <input type="hidden" name="weeks" value="{{ $weekly }}">
                                <button type="submit" class="flex w-full items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="las la-file-excel"></i> Export Excel </button>
                            </form>
                            <form action="{{ route('weeklyCSVDownload') }}" method="post">
                                @csrf
                                <input type="hidden" name="weeks" value="{{ $weekly }}">
                                <button type="submit" class="flex w-full items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="las la-file-csv"></i> Export Csv </button>
                            </form>
                            {{-- <form action="{{ route('weeklyPDFDownload') }}" method="post">
                                @csrf
                                <input type="hidden" name="weeks" value="{{ $weekly }}">
                                <button type="submit" class="flex w-full items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="las la-file-csv"></i> Export Pdf </button>
                            </form> --}}
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
                            <div class="flex justify-center items-center">
                                <button class="flex items-center mr-3" wire:click="showmodalEdit({{ $data->id }})">
                                    <i class="las la-check-square"></i> Edit
                                </button>
                                <button class="flex items-center text-theme-20">
                                    <i class="las la-check-circle"></i> Approve
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
                <x-jet-label for="user_name" value="{{ __('Nama') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Nama') }}"
                                x-ref="user_name"
                                wire:model.defer="user_name"
                                disabled
                                />
            </div>
            <div class="my-4">
                <x-jet-label for="payrols.user_id" value="{{ __('Nama') }}" />
                <x-jet-input type="text" class="mt-1 block w-3/4"
                                placeholder="{{ __('Nama') }}"
                                x-ref="payrols.user_id"
                                wire:model.defer="payrols.user_id"
                                wire:keydown.enter="edit" 
                                />

                <x-jet-input-error for="payrols.user_id" class="mt-2" />
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