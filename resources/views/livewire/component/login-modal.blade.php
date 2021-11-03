<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
</div>
<div id="login-modal" class="modal" data-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-gray-100">
            <div class="modal-body px-5 py-3">
                <div class="flex dark:bg-gray-900 flex-col items-end">
                    <div type="button" data-dismiss="modal" class="cursor-pointer">
                        <i data-feather="x"></i>
                    </div>
                    <div class="container mx-auto">
                        <div class="max-w-md mx-auto my-10">
                            <div class="flex justify-center">
                                <img src="{{ asset('dist/images/logo.svg') }}" alt="">
                            </div>
                            <div class="text-center">
                                <h1 class="my-3 text-3xl font-semibold text-gray-700 dark:text-gray-200">Sign in</h1>
                                <p class="text-gray-500 dark:text-gray-400">Sign in to PT Cahaya Sukses Plastindo</p>
                            </div>
                            <x-jet-validation-errors class="mb-4" />
                            <div class="m-7">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-6">
                                        <label for="username" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Username <span class="text-theme-6">*</span></label>
                                        <input type="text" name="username" min="6" max="20" id="username" placeholder="admin" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" required autofocus autocomplete="off"/>
                                    </div>
                                    <div class="mb-6">
                                        <div class="flex justify-between mb-2">
                                            <label for="password" class="text-sm text-gray-600 dark:text-gray-400">Password <span class="text-theme-6">*</span></label>
                                        </div>
                                        <input type="password" max="50" name="password" id="password" placeholder="Your Password" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300" required/>
                                    </div>
                                    <div class="mb-6 flex justify-end">
                                        <button type="submit" class="btn bg-theme-1 text-white w-24">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>