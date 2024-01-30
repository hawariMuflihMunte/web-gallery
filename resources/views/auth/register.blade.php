<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="Username" :value="__('Username')" />
            <x-text-input id="Username" class="block mt-1 w-full" type="text" name="Username" :value="old('Username')" required autofocus autocomplete="Username" />
            <x-input-error :messages="$errors->get('Username')" class="mt-2" />
        </div>

        <!-- Nama Lengkap -->
        <div class="mt-4">
            <x-input-label for="NamaLengkap" :value="__('Nama Lengkap')" />
            <x-text-input id="NamaLengkap" class="block mt-1 w-full" type="text" name="NamaLengkap" :value="old('NamaLengkap')" required autofocus autocomplete="NamaLengkap" />
            <x-input-error :messages="$errors->get('NamaLengkap')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="Email" :value="__('Email')" />
            <x-text-input id="Email" class="block mt-1 w-full" type="email" name="Email" :value="old('Email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('Email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="Password" :value="__('Password')" />

            <x-text-input id="Password" class="block mt-1 w-full"
                            type="password"
                            name="Password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('Password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
