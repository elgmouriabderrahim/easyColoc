<section>
    <header class="flex items-start gap-4 mb-8">
        <div class="p-3 bg-blue-500/20 rounded-[50%] border border-blue-500/30 shadow-[0_0_15px_rgba(59,130,246,0.1)]">
            <i data-lucide="fingerprint" class="w-6 h-6 text-blue-400"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-white uppercase tracking-wider">
                {{ __('Identity Details') }}
            </h2>
            <p class="mt-1 text-sm text-gray-300 leading-relaxed">
                {{ __("Update your resident profile information and contact email.") }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Full Name</label>
            <div class="relative group">
                <i data-lucide="user" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-blue-400 transition-colors w-4 h-4"></i>
                <input id="full_name" name="full_name" type="text" 
                       class="w-full pl-10 pr-4 py-3 rounded-xl text-sm bg-black/40 border border-white/20 text-white placeholder:text-gray-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all" 
                       value="{{ old('full_name', $user->full_name) }}" required autofocus />
            </div>
            <x-input-error class="mt-2 text-red-400 text-xs" :messages="$errors->get('full_name')" />
        </div>

        <div>
            <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Email Address</label>
            <div class="relative group">
                <i data-lucide="mail" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-blue-400 transition-colors w-4 h-4"></i>
                <input id="email" name="email" type="email" 
                       class="w-full pl-10 pr-4 py-3 rounded-xl text-sm bg-black/40 border border-white/20 text-white placeholder:text-gray-600 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500/50 transition-all" 
                       value="{{ old('email', $user->email) }}" required />
            </div>
            <x-input-error class="mt-2 text-red-400 text-xs" :messages="$errors->get('email')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-8 py-3 bg-white text-black rounded-md font-bold text-sm hover:bg-green-500 hover:text-white transition-all shadow-[0_10px_20px_rgba(255,255,255,0.1)] active:scale-95 flex items-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                {{ __('Update Profile') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-400 flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>