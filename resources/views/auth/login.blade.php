<x-guest-layout>
    <h1 class="text-3xl font-light tracking-wide text-white">{{ __('Log in') }}</h1>
    <x-auth-session-status class="mt-3 !text-green-200" :status="session('status')" />

    <form class="mt-6 space-y-5" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-1">
            <x-input-label for="email" class="sr-only" :value="__('Email')" />
            <x-text-input id="email" class="auth-input block w-full !border-x-0 !border-t-0 !border-b !border-white/50 !rounded-none !bg-transparent !px-0 !py-2 !text-white !shadow-none placeholder:text-white/70 focus:!border-white focus:!ring-0" type="email" name="email" :value="old('email')" :placeholder="__('Email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 !text-red-200" />
        </div>

        <div class="space-y-1">
            <x-input-label for="password" class="sr-only" :value="__('Password')" />
            <x-text-input id="password" class="auth-input block w-full !border-x-0 !border-t-0 !border-b !border-white/50 !rounded-none !bg-transparent !px-0 !py-2 !text-white !shadow-none placeholder:text-white/70 focus:!border-white focus:!ring-0" type="password" name="password" :placeholder="__('Password')" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 !text-red-200" />
        </div>

        <div class="flex items-center justify-between gap-4 pt-1">
            <label for="remember_me" class="inline-flex items-center text-sm text-white/80">
                <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-white/60 bg-transparent text-gray-900 focus:ring-white/50" name="remember">
                <span class="ms-2">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-white/80 underline-offset-4 hover:text-white hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="flex items-center gap-5 pt-1">
            <x-primary-button class="!rounded-full !border-0 !bg-white !px-6 !py-2 !text-xs !font-semibold !normal-case !tracking-wide !text-gray-900 !shadow-none hover:!bg-white/90 focus:!ring-white/70 focus:!ring-offset-0">
                {{ __('Log in') }}
            </x-primary-button>
            @if (Route::has('register'))
                <a class="text-sm text-white/80 hover:text-white" href="{{ route('register') }}">
                    {{ __("Don't have an account? Sign up") }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
