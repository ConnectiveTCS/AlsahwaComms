<x-guest-layout class="bg-matisse mt-6 w-full overflow-hidden px-6 py-4 shadow-md sm:max-w-xl sm:rounded-lg">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="-mb-px flex flex-wrap text-center text-sm font-medium" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="hover:text-oldbrick dark:hover:text-oldbrick inline-block rounded-t-lg p-4 text-white"
                    id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                    aria-selected="false">Login</button>
            </li>
            <li class="me-2" role="presentation">
                <button
                    class="hover:text-oldbrick dark:hover:text-oldbrick hidden rounded-t-lg p-4 text-white md:inline-block"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Register as Parent</button>
                <button
                    class="hover:text-oldbrick dark:hover:text-oldbrick inline-block rounded-t-lg p-4 text-white md:hidden"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                    aria-controls="dashboard" aria-selected="false">Register</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden rounded-lg p-4 dark:bg-gray-800" id="profile" role="tabpanel"
            aria-labelledby="profile-tab">
            <form method="POST" action="{{ route('login.store') }}" class="w-full flex-1">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-white" />
                    <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white" />

                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required
                        autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="mt-4 block">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="text-oldbrick shadow-xs focus:ring-oldbrick rounded-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-100 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="mt-4 flex items-center justify-end">
                    @if (Route::has('password.request'))
                        <a class="focus:outline-hidden rounded-md text-sm text-gray-100 underline hover:text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="bg-oldbrick hover:bg-oldbrick/80 ms-3 hover:drop-shadow-lg">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="dashboard" role="tabpanel"
            aria-labelledby="dashboard-tab">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="mt-1 block w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1 block w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required
                        autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="mt-1 block w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Role Selection -->
                <div class="mt-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Register As</label>
                    <x-text-input id="role" class="mt-1 hidden w-full" type="text" name="role"
                        :value="3" required autofocus autocomplete="role" />
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">You are registering as a Parent.</p>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <a class="focus:outline-hidden rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="settings" role="tabpanel"
            aria-labelledby="settings-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>.
                Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                classes to control the content visibility and styling.</p>
        </div>
        <div class="hidden rounded-lg bg-gray-50 p-4 dark:bg-gray-800" id="contacts" role="tabpanel"
            aria-labelledby="contacts-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>.
                Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                classes to control the content visibility and styling.</p>
        </div>
    </div>

</x-guest-layout>
