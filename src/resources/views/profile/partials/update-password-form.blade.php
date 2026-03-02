<section class="space-y-8">
    <header class="flex items-start gap-5">
        <div class="p-4 bg-blue-500/15 rounded-[50%] border border-blue-500/30 shadow-[0_0_20px_rgba(59,130,246,0.15)] flex-shrink-0">
            <i data-lucide="shield-check" class="w-6 h-6 text-blue-400"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-white uppercase tracking-[0.15em]">
                {{ __('Security Protocol') }}
            </h2>
            <p class="mt-2 text-[15px] text-gray-300 leading-relaxed max-w-2xl">
                {{ __('Ensure your account is using a long, random password to stay secure and maintain your resident trust score.') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="space-y-2">
            <label class="block text-[11px] uppercase tracking-[0.2em] font-black text-gray-400 ml-1">Current Access Key</label>
            <div class="relative group">
                <i data-lucide="key-round" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-blue-400 transition-colors w-5 h-5"></i>
                <input id="update_password_current_password" name="current_password" type="password" 
                       class="w-full pl-12 pr-4 py-4 rounded-2xl text-sm bg-zinc-800/50 border border-white/10 text-white placeholder:text-gray-600 focus:bg-zinc-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none" 
                       autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-400 text-xs font-bold" />
        </div>

        <div class="space-y-2">
            <label class="block text-[11px] uppercase tracking-[0.2em] font-black text-gray-400 ml-1">New Access Key</label>
            <div class="relative group">
                <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-blue-400 transition-colors w-5 h-5"></i>
                <input id="update_password_password" name="password" type="password" 
                       class="w-full pl-12 pr-4 py-4 rounded-2xl text-sm bg-zinc-800/50 border border-white/10 text-white placeholder:text-gray-600 focus:bg-zinc-800 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none" 
                       autocomplete="new-password" placeholder="Min. 8 characters" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-400 text-xs font-bold" />
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-8 py-3 bg-white text-black rounded-md font-bold text-sm hover:bg-green-500 hover:text-white transition-all shadow-[0_10px_20px_rgba(255,255,255,0.1)] active:scale-95 flex items-center gap-2">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" 
                     class="flex items-center gap-2 text-emerald-400 font-bold text-sm tracking-wide">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    {{ __('Saved Successfully') }}
                </div>
            @endif
        </div>
    </form>
</section>