<section class="space-y-8">
    <header class="flex items-start gap-5">
        <div class="p-4 bg-red-500/15 rounded-[50%] border border-red-500/40 shadow-[0_0_20px_rgba(239,68,68,0.15)] flex-shrink-0">
            <i data-lucide="alert-octagon" class="w-6 h-6 text-red-400"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold text-white uppercase tracking-[0.15em]">
                {{ __('Account Termination') }}
            </h2>
            <p class="mt-2 text-[15px] text-gray-300 leading-[1.6] max-w-2xl">
                {{ __('Once your account is deleted, all resources and data will be permanently wiped. This action is irreversible and will remove your status from the household.') }}
            </p>
        </div>
    </header>

    <div class="pt-2">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-8 py-4 bg-red-500/10 border border-red-500/40 text-red-400 rounded-md font-bold text-sm hover:bg-red-600 hover:text-white transition-all duration-300 flex items-center gap-3 group shadow-lg shadow-red-950/20"
        >
            <i data-lucide="user-x" class="w-5 h-5 group-hover:rotate-12 transition-transform"></i>
            {{ __('Deactivate Account') }}
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 bg-[#161618] border border-white/10 rounded-md shadow-2xl">
            @csrf
            @method('delete')

            <div class="flex items-center gap-4 mb-6">
                <i data-lucide="shield-alert" class="w-8 h-8 text-red-500"></i>
                <h2 class="text-3xl font-black italic [font-family:'Playfair_Display',serif] text-white">
                    {{ __('Are you sure?') }}
                </h2>
            </div>

            <p class="text-gray-300 leading-relaxed text-sm">
                {{ __('This is a permanent security action. To confirm you wish to delete your EasyColoc identity, please provide your current access credentials below.') }}
            </p>

            <div class="mt-8">
                <label for="password" class="block text-[11px] uppercase tracking-[0.25em] font-black text-gray-400 mb-3">Master Password</label>
                
                <div class="relative group">
                    <i data-lucide="key-round" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-red-400 transition-colors w-5 h-5"></i>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full pl-12 pr-4 py-4 rounded-2xl text-sm bg-black/60 border border-white/20 text-white placeholder:text-gray-600 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all outline-none"
                        placeholder="{{ __('Enter password to verify identity') }}"
                    />
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-3 text-red-400 text-xs font-bold tracking-wide" />
            </div>

            <div class="mt-10 flex flex-col sm:flex-row justify-end gap-6 items-center">
                <button type="button" 
                        x-on:click="$dispatch('close')"
                        class="text-xs font-bold text-gray-400 hover:text-white transition-colors uppercase tracking-[0.3em]">
                    {{ __('Stay Resident') }}
                </button>

                <button type="submit" 
                        class=" px-8 py-3 w-full sm:w-auto px-10 py-4 bg-red-600 text-white rounded-2xl font-black text-sm hover:bg-red-500 shadow-[0_15px_30px_rgba(220,38,38,0.25)] transition-all active:scale-95 flex items-center justify-center gap-3">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    {{ __('Confirm Deletion') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>