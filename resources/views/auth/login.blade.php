<x-layout>
    <section class="w-full">
        <div class="flex flex-col items-center justify-center px-6 mx-auto">
            {{-- <x-logo-brand class="mb-6" /> --}}
            <x-card>
                <x-card-header>Sign in to your account</x-card-header>
                @error('credential')
                    <x-alert color="red" id="credential_error">
                        <x-slot:icon>
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                        </x-slot:icon>
                        <span>{{ $message }}</span>
                    </x-alert>
                @enderror
                <x-forms.form action="/login" method="POST">
                    <x-forms.input-field name="email" type="email" label="Email" placeholder="name@company.com"
                        required />
                    <x-forms.input-field name="password" type="password" label="Password" placeholder="••••••••"
                        required />
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                            </div>
                        </div>
                        <a href="#"
                            class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                            password?</a>
                    </div>
                    <x-forms.button type="submit" color="primary">Sign in</x-forms.button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Don’t have an account yet? <a href="/register"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                    </p>
                </x-forms.form>
            </x-card>
        </div>
    </section>
</x-layout>
