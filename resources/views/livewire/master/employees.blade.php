<div>
    <h2 class="intro-y text-lg font-medium mt-10">Data Pegawai</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
            <button class="btn btn-primary shadow-md mr-2" wire:click="showmodal">Add Pegawai</button>
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
                            NIP
                            <span wire:click="sortBy('nip')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'nip' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'nip' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            <div class="flex">
                                NAMA
                                <span wire:click="sortBy('nama')" class="float-right text-sm cursor-pointer">
                                    <i class="las la-arrow-up {{ $sortColumnName === 'nama' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                    <i class="las la-arrow-down {{ $sortColumnName === 'nama' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                                </span>
                            </div>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            <div class="flex">
                                JOB TITLE
                                <span wire:click="sortBy('job_title')" class="float-right text-sm cursor-pointer">
                                    <i class="las la-arrow-up {{ $sortColumnName === 'job_title' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                    <i class="las la-arrow-down {{ $sortColumnName === 'job_title' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                                </span>
                            </div>
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer" wire:click="sortBy('departement_id')">
                            DEPARTEMENT
                            {{-- <span wire:click="sortBy('departement_id')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'departement_id' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'departement_id' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span> --}}
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">
                            SUB DEPARTEMENT
                            {{-- <span wire:click="sortBy('subdepartement_id')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'subdepartement_id' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'subdepartement_id' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span> --}}
                        </th>
                        <th class="text-center whitespace-nowrap cursor-pointer">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $employees->count() * ($employees->currentPage() - 1) + $loop->iteration}}</td>
                        <td class="text-center">{{ $data->nip }}</td>
                        <td class="">{{ $data->nama }}</td>
                        <td class="text-center">{{ $data->job_title }}</td>
                        <td class="text-center">{{ $data->departement->nama }}</td>
                        <td class="text-center">{{ $data->subdepartement->nama }}</td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <button class="flex items-center mr-3" wire:click="showmodalView({{ $data->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg> 
                                    View
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
        {{ $employees->links() }}
        <!-- END: Pagination -->
    </div>
    {{-- add modal --}}
    <x-jet-dialog-modal wire:model="confirmingAddModal">
        <x-slot name="title">
            {{ 'Add Pegawai' }}
        </x-slot>

        <x-slot name="content">
            <div class="my-8">
                <div class="mt-5">
                    <x-jet-label for="data.nip" value="{{ __('Nomor Induk Pegawai') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Nomor Induk Pegawai') }}"
                                    x-ref="data.nip"
                                    wire:model.defer="data.nip"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.nip" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.rfid" value="{{ __('RFID Number') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('RFID Number') }}"
                                    x-ref="data.rfid"
                                    wire:model.defer="data.rfid"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.rfid" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.fingerprint" value="{{ __('fingerprint') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('fingerprint') }}"
                                    x-ref="data.fingerprint"
                                    wire:model.defer="data.fingerprint"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.fingerprint" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.nama" value="{{ __('Nama Pegawai') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Nama Pegawai') }}"
                                    x-ref="data.nama"
                                    wire:model.defer="data.nama"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.nama" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.job" value="{{ __('Job Title') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Job Title') }}"
                                    x-ref="data.job"
                                    wire:model.defer="data.job"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.job" class="mt-2" />
                </div>

                <div class="mt-5">
                    <x-jet-label for="data.attendance_type" value="{{ __('Kehadiran') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="data.attendance_type">
                        <option value="">--- Select Attendance ---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                    <x-jet-input-error for="data.attendance_type" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="departement" value="{{ __('Nama Departement') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="subdepdropdown">
                        <option value="">--- Select data departement ---</option>
                        @foreach ($departement as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="departement" class="mt-2" />
                </div>

                @if (!is_null($sub_selection))
                <div class="mt-5">
                    <x-jet-label for="subdepartement" value="{{ __('Nama Sub Departement') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="data.subdep">
                        <option value="">--- Select data subdepartement ---</option>
                        @foreach ($sub_selection as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="departement" class="mt-2" />
                </div>
                @endif

                {{-- golongan --}}

                <div class="my-10">
                    <div class="w-full flex justify-center border-t border-gray-200 dark:border-dark-5 mt-2"> 
                        <div class="bg-white dark:bg-dark-3 px-5 -mt-3 text-gray-600">Golongan</div> 
                    </div> 
                </div>

                <div class="mt-5">
                    <x-jet-label for="golongan" value="{{ __(' Golongan') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="data.golongan">
                        <option value="">---  Golongan ---</option>
                        @foreach ($Golongan as $data)
                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="data.golongan" class="mt-2" />
                </div>
                {{-- END : golongan --}}
                {{-- hak akses --}}
                <div class="my-10">
                    <div class="w-full flex justify-center border-t border-gray-200 dark:border-dark-5 mt-2"> 
                        <div class="bg-white dark:bg-dark-3 px-5 -mt-3 text-gray-600">Hak Akses</div> 
                    </div> 
                </div>

                <div class="mt-5" wire:ignore>
                    <x-jet-label for="deviceData" value="{{ __('DoorLock Privelage') }}" />

                    <x-select2-multiple id="deviceData" wire:model="deviceData">
                        @foreach ($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->uid }} | {{ $device->name }}</option>
                        @endforeach
                    </x-select2-multiple>
                        
                    <x-jet-input-error for="deviceData" class="mt-2" />
                </div>

                {{-- END : Hak akses --}}
                <div class="my-10">
                    <div class="w-full flex justify-center border-t border-gray-200 dark:border-dark-5 mt-2"> 
                        <div class="bg-white dark:bg-dark-3 px-5 -mt-3 text-gray-600">Info Pribadi</div> 
                    </div> 
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.alamat" value="{{ __('Alamat') }}" />
                    <textarea class="form-control w-3/4"
                            name="data.alamat" 
                            x-ref="data.alamat" 
                            cols="10" rows="10" 
                            wire:model.defer="data.alamat"
                            wire:keydown.enter="add" 
                            placeholder="{{ __('Alamat') }}"
                            ></textarea>
                    <x-jet-input-error for="data.alamat" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.nohp" value="{{ __('No Handphone') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('No Handphone') }}"
                                    x-ref="data.nohp"
                                    wire:model.defer="data.nohp"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.nohp" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.email" value="{{ __('Email') }}" />
                    <x-jet-input type="email" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Email') }}"
                                    x-ref="data.email"
                                    wire:model.defer="data.email"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="data.email" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.payment_mode" value="{{ __('Pembayaran Gaji') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="data.payment_mode">
                        <option value="">--- Select Payment mode ---</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                    <x-jet-input-error for="data.payment_mode" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="data.basic_salary" value="{{ __('Basic Salary') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Rp') }}"
                                    x-ref="data.basic_salary"
                                    wire:model.defer="data.basic_salary"
                                    wire:keydown.enter="add" 
                                    type-currency="IDR"/>
    
                    <x-jet-input-error for="data.basic_salary" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="paymentselect" value="{{ __('Tipe Pembayaran') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="paymentselect">
                        <option value="">--- Select Payment mode ---</option>
                        <option value="1">Bank</option>
                        <option value="2">Cash</option>
                    </select>
                    <x-jet-input-error for="paymentselect" class="mt-2" />
                </div>
                @if (!is_null($paymentselecttrue))
                <div class="mt-5">
                    <x-jet-label for="bank_name" value="{{ __('Nama Rekening') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Nama Rekening') }}"
                                    x-ref="bank_name"
                                    wire:model.defer="bank_name"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="bank_name" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="bank_account" value="{{ __('Bank') }}" />
                    <select class="form-control form-select mt-2 w-3/4" wire:model="bank_account">
                        <option value="">--- Select Bank ---</option>
                        @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->nama_bank . ' | ' . $bank->kode_bank }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="bank_account" class="mt-2" />
                </div>
                <div class="mt-5">
                    <x-jet-label for="credited_accont" value="{{ __('Nomor Rekening') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                    placeholder="{{ __('Nomor Rekening') }}"
                                    x-ref="credited_accont"
                                    wire:model.defer="credited_accont"
                                    wire:keydown.enter="add" />
    
                    <x-jet-input-error for="credited_accont" class="mt-2" />
                </div>
                @endif
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
    {{-- View Modal --}}
    <x-jet-dialog-modal wire:model="confirmingViewModal">
        <x-slot name="title">
            {{ 'Edit Pegawai' }}
        </x-slot>

        <x-slot name="content">
            <div class="container">
                <div class="flex flex-col xl:flex-row">
                    <div class="w-52 mx-auto mt-5">
                        <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                @if ($photo)
                                <img class="rounded-md" alt="" src="{{$photo->temporaryUrl()}}">
                                @else
                                <img class="rounded-md" alt="" src="{{ $profile_photo_path === null ? asset('dist/images/200x200.jpg') : asset($profile_photo_path)}}"> 
                                @endif
                                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> </div>
                            </div>
                            <div class="mx-auto cursor-pointer relative mt-5">
                                <button type="button" class="btn btn-primary w-full">Change Photo</button>
                                <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0" wire:model="photo" accept="image/png, image/jpg, image/jpeg">
                                <x-jet-input-error for="photo" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 ml-12">
                        <div class="grid gap-6">
                            <div>
                                <div class="mt-5">
                                    <x-jet-label for="view.nip" value="{{ __('Nomor Induk Pegawai') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('Nomor Induk Pegawai') }}"
                                                    x-ref="view.nip"
                                                    wire:model.defer="view.nip"
                                                    wire:keydown.enter="add"  disabled/>
                    
                                    <x-jet-input-error for="view.nip" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.rfid_number" value="{{ __('RFID Number') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('RFID Number') }}"
                                                    x-ref="view.rfid_number"
                                                    wire:model.defer="view.rfid_number"
                                                    wire:keydown.enter="add" />
                    
                                    <x-jet-input-error for="view.rfid_number" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.fingerprint" value="{{ __('fingerprint') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('fingerprint') }}"
                                                    x-ref="view.fingerprint"
                                                    wire:model.defer="view.fingerprint"
                                                    wire:keydown.enter="add" />
                    
                                    <x-jet-input-error for="view.fingerprint" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.nama" value="{{ __('Nama Pegawai') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('Nama Pegawai') }}"
                                                    x-ref="view.nama"
                                                    wire:model.defer="view.nama"
                                                    wire:keydown.enter="add" />
                    
                                    <x-jet-input-error for="view.nama" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.job_title" value="{{ __('Job Title') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('Job Title') }}"
                                                    x-ref="view.job_title"
                                                    wire:model.defer="view.job_title"
                                                    wire:keydown.enter="add" />
                    
                                    <x-jet-input-error for="view.job_title" class="mt-2" />
                                </div>
                
                                <div class="mt-5">
                                    <x-jet-label for="view.attendance_type" value="{{ __('Kehadiran') }}" />
                                    <select class="form-control form-select mt-2 w-3/4" wire:model="view.attendance_type">
                                        <option value="">--- Select Attendance ---</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                    <x-jet-input-error for="view.attendance_type" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="depview" value="{{ __('Nama Departement') }}" />
                                    <select class="form-control form-select mt-2 w-3/4" wire:model="depview">
                                        <option value="">--- Select data departement ---</option>
                                        @foreach ($departement as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="depview" class="mt-2" />
                                </div>
                
                                @if (!is_null($subview))
                                <div class="mt-5">
                                    <x-jet-label for="view.subdepartement_id" value="{{ __('Nama Sub Departement') }}" />
                                    <select class="form-control form-select mt-2 w-3/4" wire:model="view.subdepartement_id">
                                        <option value="">--- Select data subdepartement ---</option>
                                        @foreach ($subview as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="view.subdepartement_id" class="mt-2" />
                                </div>
                                @endif
                                {{-- golongan --}}
                                <div class="my-10">
                                    <div class="w-full flex justify-center border-t border-gray-200 dark:border-dark-5 mt-2"> 
                                        <div class="bg-white dark:bg-dark-3 px-5 -mt-3 text-gray-600">Golongan</div> 
                                    </div> 
                                </div>

                                <div class="mt-5">
                                    <x-jet-label for="view.golongan_id" value="{{ __(' Golongan') }}" />
                                    <select class="form-control form-select mt-2 w-3/4" wire:model="view.golongan_id">
                                        <option value="">---  Golongan ---</option>
                                        @foreach ($Golongan as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="view.golongan_id" class="mt-2" />
                                </div>
                                {{-- END : golongan --}}
                                {{-- hak akses --}}
                                <div class="my-10">
                                    <div class="w-full flex justify-center border-t border-gray-200 dark:border-dark-5 mt-2"> 
                                        <div class="bg-white dark:bg-dark-3 px-5 -mt-3 text-gray-600">Hak Akses</div> 
                                    </div> 
                                </div>

                                <div class="mt-5">
                                    <x-jet-label for="viewDoorlock" value="{{ __('DoorLock Privelage') }}" />
                                    <div wire:ignore>
                                        <select id="viewDoorlock" class=" select2" multiple="multiple" style="width: 75%;" wire:model="doorView">
                                            @foreach ($devices as $device)
                                            <option value="{{ $device->id }}">{{ $device->uid }} | {{ $device->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-jet-input-error for="doorView" class="mt-2" />
                                </div>

                                {{-- END : Hak akses --}}
                                
                                <div class="my-10">
                                    <div class="w-full flex justify-center border-t border-gray-200 dark:border-dark-5 mt-2"> 
                                        <div class="bg-white dark:bg-dark-3 px-5 -mt-3 text-gray-600">Info Pribadi</div> 
                                    </div> 
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.alamat" value="{{ __('Alamat') }}" />
                                    <textarea class="form-control w-3/4"
                                            name="view.alamat" 
                                            x-ref="view.alamat" 
                                            cols="10" rows="10" 
                                            wire:model.defer="view.alamat"
                                            wire:keydown.enter="add" 
                                            placeholder="{{ __('Alamat') }}"
                                            ></textarea>
                                    <x-jet-input-error for="view.alamat" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.noHandphone" value="{{ __('No Handphone') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('No Handphone') }}"
                                                    x-ref="view.noHandphone"
                                                    wire:model.defer="view.noHandphone"
                                                    wire:keydown.enter="add" />
                    
                                    <x-jet-input-error for="view.noHandphone" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.email" value="{{ __('Email') }}" />
                                    <x-jet-input type="email" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('Email') }}"
                                                    x-ref="view.email"
                                                    wire:model.defer="view.email"
                                                    wire:keydown.enter="add" />
                    
                                    <x-jet-input-error for="view.email" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.payment_mode" value="{{ __('Pembayaran Gaji') }}" />
                                    <select class="form-control form-select mt-2 w-3/4" wire:model="view.payment_mode">
                                        <option value="">--- Select Payment mode ---</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                    </select>
                                    <x-jet-input-error for="view.payment_mode" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="view.basic_salary" value="{{ __('Basic Salary') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('Rp') }}"
                                                    x-ref="view.basic_salary"
                                                    wire:model="view.basic_salary"
                                                    wire:keydown.enter="add" 
                                                    type-currency="IDR"/>
                    
                                    <x-jet-input-error for="view.basic_salary" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="paymentselect" value="{{ __('Tipe Pembayaran') }}" />
                                    <select class="form-control form-select mt-2 w-3/4" wire:model="viewtransfer">
                                        <option value="">--- Select Payment mode ---</option>
                                        <option value="1">Bank</option>
                                        <option value="2">Cash</option>
                                    </select>
                                    <x-jet-input-error for="paymentselect" class="mt-2" />
                                </div>
                                @if ($viewtransfer === '1' ? true : false)
                                <div class="mt-5">
                                    <x-jet-label for="bank_name" value="{{ __('Nama Rekening') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('Nama Rekening') }}"
                                                    x-ref="view.bank_name"
                                                    wire:model.defer="view.bank_name"
                                                    wire:keydown.enter="add" />
                    
                                    <x-jet-input-error for="view.bank_name" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="bank_account" value="{{ __('Bank') }}" />
                                    <select class="form-control form-select mt-2 w-3/4" wire:model="view.bank_account">
                                        <option value="">--- Select Bank ---</option>
                                        @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">{{ $bank->nama_bank . ' | ' . $bank->kode_bank }}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="view.bank_account" class="mt-2" />
                                </div>
                                <div class="mt-5">
                                    <x-jet-label for="credited_accont" value="{{ __('Nomor Rekening') }}" />
                                    <x-jet-input type="text" class="mt-1 block w-3/4"
                                                    placeholder="{{ __('Nomor Rekening') }}"
                                                    x-ref="view.credited_accont"
                                                    wire:model.defer="view.credited_accont"
                                                    wire:keydown.enter="add" />
                    
                                    <x-jet-input-error for="view.credited_accont" class="mt-2" />
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
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

@push('scripts')
    <script>
        document.addEventListener('livewire:load', () => {
            $('#viewDoorlock').select2().on('change', function (e) {
                let data = $(this).val();
                @this.set('doorView', data);
            });
        })
        Livewire.on('select2modal', () => {
            $('#viewDoorlock').trigger('change');   //the trigerr data selected into modal
        }); 
    </script>
@endpush