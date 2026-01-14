<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('We\'ve sent a 6-digit code to your email. Please enter it below to continue.') }}
    </div>

    <form method="POST" action="{{ route('mfa.verify') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('Verification Code')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" maxlength="6" required autofocus autocomplete="one-time-code" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verify') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>