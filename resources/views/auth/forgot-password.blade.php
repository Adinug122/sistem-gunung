<x-guest-layout>
    <h1 class="text-3xl font-light tracking-wide text-white">{{ __('Forgot password?') }}</h1>
    <p class="mt-3 text-sm leading-relaxed text-white/80">
        {{ __('Enter your email address and we will send you a password reset link.') }}
    </p>
    <x-auth-session-status class="mt-3 !text-green-200" :status="session('status')" />

    <form class="mt-6 space-y-5" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="space-y-1">
            <x-input-label for="email" class="sr-only" :value="__('Email')" />
            <x-text-input id="email" class="auth-input block w-full !border-x-0 !border-t-0 !border-b !border-white/50 !rounded-none !bg-transparent !px-0 !py-2 !text-white !shadow-none placeholder:text-white/70 focus:!border-white focus:!ring-0" type="email" name="email" :value="old('email')" :placeholder="__('Email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 !text-red-200" />
        </div>

        <div class="flex items-center gap-5 pt-1">
            <x-primary-button class="!rounded-full !border-0 !bg-white !px-6 !py-2 !text-xs !font-semibold !normal-case !tracking-wide !text-gray-900 !shadow-none hover:!bg-white/90 focus:!ring-white/70 focus:!ring-offset-0">
                {{ __('Send reset link') }}
            </x-primary-button>
            <a class="text-sm text-white/80 hover:text-white" href="{{ route('login') }}">
                {{ __('Back to log in') }}
            </a>
        </div>
    </form>
</x-guest-layout>
