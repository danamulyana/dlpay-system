<div>
    <h2 class="intro-y text-lg font-medium mt-10">Permisions</h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2 justify-between">
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
                            NAME PERMISIONS
                            {{-- <span wire:click="sortBy('username')" class="float-right text-sm cursor-pointer">
                                <i class="las la-arrow-up {{ $sortColumnName === 'username' && $sortDirection === 'asc' ? '' : 'text-gray-400' }}"></i>
                                <i class="las la-arrow-down {{ $sortColumnName === 'username' && $sortDirection === 'desc' ? '' : 'text-gray-400' }}"></i>
                            </span> --}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $data)
                    <tr class="intro-x" wire:key="{{ $loop->index }}">
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $data->name  }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="text-center">Data not found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{-- {{ $permissions->links() }} --}}
        <!-- END: Pagination -->
    </div>
</div>