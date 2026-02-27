<x-app-layout>
    <div class="min-h-screen bg-[#0d0d12] text-zinc-400 font-sans antialiased p-6 lg:p-12" 
         x-data="{ activeTab: 'active' }">
        
        <div class="max-w-[1300px] mx-auto space-y-6">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                <div class="space-y-1">
                    <h2 class="text-2xl font-bold text-white tracking-tight">Resident Registry</h2>
                    <p class="text-[11px] text-zinc-500 uppercase tracking-[0.2em]">Security Protocol // Reputation Monitoring</p>
                </div>
                
                <div class="flex items-center gap-3 bg-[#18181f] border border-white/5 px-5 py-3 rounded-xl shadow-xl">
                    <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
                    <span class="text-[10px] font-black text-zinc-300 uppercase tracking-widest">
                        {{ $users->count() }} Identities Authenticated
                    </span>
                </div>
            </div>

            <div id="alert-container" class="space-y-4">
                @if (session('success'))
                    <div class="js-alert p-4 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 text-[10px] font-black uppercase tracking-widest flex items-center justify-between backdrop-blur-md transition-all duration-500">
                        <div class="flex items-center gap-3">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                            {{ session('success') }}
                        </div>
                        <button onclick="this.parentElement.remove()" class="hover:text-white transition-colors">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif
            </div>

            <div class="bg-[#18181f] border border-white/[0.05] rounded-xl shadow-2xl overflow-hidden">
                <div class="flex border-b border-white/[0.05] bg-white/[0.02] px-4">
                    <button 
                        @click="activeTab = 'active'"
                        :class="activeTab === 'active' ? 'text-purple-500 border-purple-500' : 'text-zinc-600 border-transparent hover:text-zinc-400'"
                        class="py-3 px-6 text-[10px] font-bold border-b-2 uppercase tracking-[0.2em] transition-all outline-none">
                        Active Users
                    </button>
                    <button 
                        @click="activeTab = 'banned'"
                        :class="activeTab === 'banned' ? 'text-purple-500 border-purple-500' : 'text-zinc-600 border-transparent hover:text-zinc-400'"
                        class="py-3 px-6 text-[10px] font-bold border-b-2 uppercase tracking-[0.2em] transition-all outline-none">
                        Banned Users
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-black/20">
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.3em] text-zinc-600">Identity Details</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.3em] text-zinc-600">Reputation Analysis</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.3em] text-zinc-600 text-center">Protocol Role</th>
                                <th class="px-8 py-5 text-[9px] font-black uppercase tracking-[0.3em] text-zinc-600 text-right">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/[0.02]">
                            @foreach($users as $user)
                            <tr 
                                x-show="activeTab === 'active' ? !{{ $user->is_banned ? 'true' : 'false' }} : {{ $user->is_banned ? 'true' : 'false' }}"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                class="group hover:bg-white/[0.01] transition-all duration-200">
                                
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-lg bg-[#212129] border border-white/5 flex items-center justify-center font-bold text-white shadow-inner relative">
                                            @if($user->role === 'admin')
                                                <i data-lucide="shield" class="w-4 h-4 text-purple-500"></i>
                                            @else
                                                <span class="text-xs text-zinc-500">{{ strtoupper(substr($user->full_name, 0, 1)) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-white tracking-tight group-hover:text-purple-400 transition-colors">{{ $user->full_name }}</p>
                                            <p class="text-[10px] text-zinc-600 font-bold uppercase tracking-widest mt-0.5">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex flex-col gap-2 w-40">
                                        <div class="flex justify-between items-center text-[9px] font-black uppercase tracking-widest">
                                            <span class="text-zinc-500 italic">Trust Factor</span>
                                            <span class="{{ $user->reputation_score > 70 ? 'text-purple-400' : 'text-zinc-400' }}">{{ $user->reputation_score }}%</span>
                                        </div>
                                        <div class="h-1 w-full bg-black/40 rounded-full overflow-hidden">
                                            <div class="h-full {{ $user->reputation_score > 70 ? 'bg-purple-500 shadow-[0_0_8px_rgba(168,85,247,0.4)]' : 'bg-zinc-700' }} transition-all duration-1000" style="width: {{ $user->reputation_score }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center">
                                        <div class="px-3 py-1 rounded bg-[#212129] border border-white/5 inline-flex items-center gap-2">
                                            <span class="text-[9px] font-black uppercase tracking-widest {{ $user->colocation_role === 'owner' ? 'text-purple-400' : 'text-zinc-500' }}">
                                                {{ $user->colocation_role ?? 'Unassigned' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6 text-right">
                                    @if(Auth::id() !== $user->id)
                                        <form action="{{ route('admin.users.toggle-ban', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <button type="submit" 
                                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all active:scale-95 
                                                {{ $user->is_banned ? 'bg-purple-600 text-white shadow-lg shadow-purple-900/20' : 'bg-[#212129] text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white' }}">
                                                @if($user->is_banned)
                                                    <i data-lucide="refresh-cw" class="w-3 h-3"></i> Restore Identity
                                                @else
                                                    <i data-lucide="slash" class="w-3 h-3"></i> Terminate
                                                @endif
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[9px] text-zinc-800 font-black uppercase tracking-widest italic select-none">Auth Entity</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            
                            <tr x-cloak x-show="activeTab === 'active' ? !{{ $users->where('is_banned', false)->count() }} : !{{ $users->where('is_banned', true)->count() }}">
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <p class="text-[10px] font-black text-zinc-700 uppercase tracking-[0.5em]">No Records Found in Current Protocol</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-6 border-t border-white/[0.05] bg-white/[0.01] flex justify-between items-center">
                    <p class="text-[9px] text-zinc-600 font-bold uppercase tracking-widest italic">Registry Integrity: Optimal</p>
                    <div class="flex gap-2">
                         <div class="w-1.5 h-1.5 rounded-full" :class="activeTab === 'active' ? 'bg-purple-500' : 'bg-purple-500/20'"></div>
                         <div class="w-1.5 h-1.5 rounded-full" :class="activeTab === 'banned' ? 'bg-purple-500' : 'bg-purple-500/20'"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }

            const alerts = document.querySelectorAll('.js-alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
</x-app-layout>