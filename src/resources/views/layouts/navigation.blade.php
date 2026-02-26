<nav class="sticky top-0 z-40 w-full bg-[#0a0a0b]/60 backdrop-blur-xl border-b border-white/5 px-6 py-4">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        
        <div class="flex items-center gap-4">
            <div class="hidden md:flex items-center gap-2 text-gray-500 text-xs font-bold uppercase tracking-[0.2em]">
                <i data-lucide="shield" class="w-4 h-4 text-blue-500"></i>
                <span>EasyColoc Secure Portal</span>
            </div>
        </div>

        <div class="flex items-center gap-6">
            
            <div class="flex flex-col items-end border-r border-white/10 pr-6">
                <span class="text-sm font-black text-white tracking-tight leading-none">
                    {{ Auth::user()->full_name }}
                </span>
                
                <div class="mt-1 flex items-center gap-1.5">
                    @if(Auth::user()->role === 'admin') {{-- Adjust 'role' to your actual DB column --}}
                        <span class="bg-amber-500/10 text-amber-500 text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded-md border border-amber-500/20">
                            System Admin
                        </span>
                    @else
                        <span class="bg-blue-500/10 text-blue-400 text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded-md border border-blue-500/20">
                            Resident User
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('profile.edit') }}" 
                   class="p-2.5 rounded-xl bg-white/[0.03] border border-white/10 text-gray-400 hover:text-white hover:bg-blue-600 hover:border-blue-500 transition-all duration-300 group"
                   title="Profile Settings">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="p-2.5 rounded-xl bg-red-500/5 border border-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all duration-300"
                            title="Secure Logout">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>