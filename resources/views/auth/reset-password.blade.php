<x-guest-layout>
    <h1 class="text-3xl font-light tracking-wide text-white">{{ __('Reset your password') }}</h1>

    <form class="mt-6 space-y-5" method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="space-y-1">
            <x-input-label for="email" class="sr-only" :value="__('Email')" />
            <x-text-input id="email" class="auth-input block w-full !border-x-0 !border-t-0 !border-b !border-white/50 !rounded-none !bg-transparent !px-0 !py-2 !text-white !shadow-none placeholder:text-white/70 focus:!border-white focus:!ring-0" type="email" name="email" :value="old('email', $request->email)" :placeholder="__('Email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 !text-red-200" />
        </div>

        <div class="space-y-1">
            <x-input-label for="password" class="sr-only" :value="__('Password')" />
            <x-text-input id="password" class="auth-input block w-full !border-x-0 !border-t-0 !border-b !border-white/50 !rounded-none !bg-transparent !px-0 !py-2 !text-white !shadow-none placeholder:text-white/70 focus:!border-white focus:!ring-0" type="password" name="password" :placeholder="__('Password')" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 !text-red-200" />
        </div>

        <div class="space-y-1">
            <x-input-label for="password_confirmation" class="sr-only" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="auth-input block w-full !border-x-0 !border-t-0 !border-b !border-white/50 !rounded-none !bg-transparent !px-0 !py-2 !text-white !shadow-none placeholder:text-white/70 focus:!border-white focus:!ring-0" type="password" name="password_confirmation" :placeholder="__('Confirm Password')" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 !text-red-200" />
        </div>

        <div class="flex items-center gap-5 pt-1">
            <x-primary-button class="!rounded-full !border-0 !bg-white !px-6 !py-2 !text-xs !font-semibold !normal-case !tracking-wide !text-gray-900 !shadow-none hover:!bg-white/90 focus:!ring-white/70 focus:!ring-offset-0">
                {{ __('Reset Password') }}
            </x-primary-button>
            <a class="text-sm text-white/80 hover:text-white" href="{{ route('login') }}">
                {{ __('Back to log in') }}
            </a>
        </div>
    </form>
</x-guest-layout>
