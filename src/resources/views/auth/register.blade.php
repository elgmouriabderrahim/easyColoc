<x-guest-layout>
    <div class="auth-shell">
        <aside class="auth-panel">
            <div>
                <a href="/" class="inline-flex items-center gap-3 text-sm font-semibold uppercase tracking-[0.2em] text-indigo-100">
                    <x-application-logo class="h-8 w-8 fill-current text-white" />
                    EasyColoc
                </a>
                <h2 class="mt-8 text-3xl font-bold leading-tight">Create your roommate space in minutes.</h2>
                <p class="mt-4 text-indigo-100">Track shared expenses, keep roles clear, and settle faster with one account for every member.</p>
            </div>

            <ul class="space-y-3 text-sm text-indigo-100">
                <li>• One dashboard for all coloc expenses</li>
                <li>• Transparent member balances</li>
                <li>• Smart settlement follow-up</li>
            </ul>
        </aside>

        <section class="auth-card">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Create account</h1>
            <p class="mt-2 text-sm text-slate-500">Start organizing your colocation now.</p>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <x-input-label for="full_name" :value="__('Full Name')" />
                    <x-text-input id="full_name" class="mt-1" type="text" name="full_name" :value="old('full_name')" required autofocus autocomplete="name" placeholder="Alex Johnson" />
                    <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="mt-1" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <x-primary-button class="w-full justify-center text-sm">
                    {{ __('Create Account') }}
                </x-primary-button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500">
                {{ __('Already have an account?') }}
                <a href="{{ route('login') }}" class="auth-link">{{ __('Sign in') }}</a>
            </p>
        </section>
    </div>
    
</x-guest-layout>
