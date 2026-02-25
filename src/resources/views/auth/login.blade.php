<x-guest-layout>
    <div class="auth-shell">
        <aside class="auth-panel">
            <div>
                <a href="/" class="inline-flex items-center gap-3 text-sm font-semibold uppercase tracking-[0.2em] text-indigo-100">
                    <x-application-logo class="h-8 w-8 fill-current text-white" />
                    EasyColoc
                </a>
                <h2 class="mt-8 text-3xl font-bold leading-tight">Welcome back.</h2>
                <p class="mt-4 text-indigo-100">Log in to review expenses, balances, and pending settlements with your coloc team.</p>
            </div>

            <ul class="space-y-3 text-sm text-indigo-100">
                <li>• Secure access to your colocation data</li>
                <li>• Fast updates on unsettled expenses</li>
                <li>• Keep your monthly budget in control</li>
            </ul>
        </aside>

        <section class="auth-card">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Sign in</h1>
            <p class="mt-2 text-sm text-slate-500">Enter your account details to continue.</p>

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="mt-1" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between gap-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-slate-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="auth-link" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <x-primary-button class="w-full justify-center text-sm">
                    {{ __('Log in') }}
                </x-primary-button>
            </form>

            <p class="mt-6 text-center text-sm text-slate-500">
                {{ __('New here?') }}
                <a href="{{ route('register') }}" class="auth-link">{{ __('Create account') }}</a>
            </p>
        </section>
    </div>
</x-guest-layout>
