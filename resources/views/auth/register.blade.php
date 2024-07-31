<x-layout>
    <section class="w-full pb-5">
        <div class="flex flex-col items-center justify-center px-6 mx-auto">
            {{-- <x-logo-brand class="mb-6" /> --}}
            <x-card>
                <x-card-header>Create an account</x-card-header>
                <x-forms.form method="POST" action="/register">
                    <x-forms.input-field
                        name="name"
                        type="text"
                        label="Your name"
                        placeholder="Juan Dela Cruz"
                        required
                    />
                    <x-forms.input-field
                        name="email"
                        type="email"
                        label="Your email"
                        placeholder="name@company.com"
                        required
                    />
                    <x-forms.input-field
                        name="password"
                        type="password"
                        label="Password"
                        placeholder="••••••••"
                        required
                    />
                    <x-forms.input-field
                        name="password_confirmation"
                        type="password"
                        label="Confirm password"
                        placeholder="••••••••"
                        required
                    />
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                required="">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a
                                    class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                                    href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <x-forms.button type="submit" color="primary">Create an account</x-forms.button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="/login"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                    </p>
                </x-forms.form>
            </x-card>
        </div>
    </section>
</x-layout>
