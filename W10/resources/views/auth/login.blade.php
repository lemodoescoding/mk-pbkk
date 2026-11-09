<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    @if (app()->environment('local', 'testing'))
        <div class="mt-6 border-t border-gray-200 pt-4">
            <p class="mb-3 text-sm font-semibold text-gray-700">Auto-Login Akun Demo</p>

            <div class="grid gap-2">
                @foreach ([
                    'admin' => 'Login sebagai Admin (akses penuh)',
                    'staf' => 'Login sebagai Staf (tanpa hapus data)',
                    'mahasiswa' => 'Login sebagai Mahasiswa (tanpa akses admin)',
                ] as $role => $label)
                    <form method="POST" action="{{ route('demo.login', $role) }}">
                        @csrf
                        <x-secondary-button type="submit" class="w-full justify-center">
                            {{ $label }}
                        </x-secondary-button>
                    </form>
                @endforeach
            </div>

            <p class="mt-3 text-xs text-gray-500">
                Password semua akun demo: <span class="font-mono font-semibold">password</span>
            </p>
        </div>
    @endif
</x-guest-layout>
