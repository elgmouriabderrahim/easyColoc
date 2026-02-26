<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-4xl font-serif italic font-black text-white tracking-tighter">
                    Resident <span class="text-blue-500">Registry</span>
                </h2>
                <p class="text-zinc-500 text-[10px] font-black uppercase tracking-[0.4em] mt-2">Access Control & Reputation Monitoring</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 bg-zinc-900/80 border border-white/5 px-5 py-3 rounded-2xl shadow-xl">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500"></i>
                    <span class="text-xs font-black text-zinc-300 uppercase tracking-widest">{{ $users->count() }} Verified Identities</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="bg-zinc-900/40 backdrop-blur-2xl border border-white/5 rounded-[2.5rem] overflow-hidden shadow-2xl relative">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-white/5 bg-white/[0.03]">
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500">Identity</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500">Reputation</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500 text-center">House Role</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-500 text-right">Operations</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($users as $user)
                <tr class="group hover:bg-white/[0.02] transition-all duration-300 {{ $user->is_banned ? 'opacity-60' : '' }}">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-zinc-800 to-black border border-white/10 flex items-center justify-center font-black text-white shadow-xl relative">
                                {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                @if($user->role === 'admin')
                                    <div class="absolute -top-1 -right-1 bg-amber-500 p-1 rounded-md shadow-lg border border-black">
                                        <i data-lucide="crown" class="w-2.5 h-2.5 text-black"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-black text-white tracking-tight group-hover:text-blue-400 transition-colors">{{ $user->full_name }}</p>
                                <p class="text-[10px] text-zinc-500 font-bold tracking-wider">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="px-8 py-6">
                        <div class="flex flex-col gap-2 w-32">
                            <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-tighter">
                                <span class="text-zinc-500">Trust Score</span>
                                <span class="{{ $user->reputation_score > 70 ? 'text-emerald-500' : 'text-amber-500' }}">{{ $user->reputation_score }}%</span>
                            </div>
                            <div class="h-1.5 w-full bg-zinc-800 rounded-full overflow-hidden border border-white/5">
                                <div class="h-full {{ $user->reputation_score > 70 ? 'bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.4)]' : 'bg-amber-500' }} rounded-full" style="width: {{ $user->reputation_score }}%"></div>
                            </div>
                        </div>
                    </td>

                    <td class="px-8 py-6">
                        <div class="flex justify-center">
                            @if($user->colocation_role === 'owner')
                                <span class="px-3 py-1.5 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 text-[9px] font-black uppercase tracking-widest">
                                    House Owner
                                </span>
                            @elseif($user->colocation_role === 'member')
                                <span class="px-3 py-1.5 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[9px] font-black uppercase tracking-widest">
                                    Member
                                </span>
                            @else
                                <span class="text-[9px] text-zinc-600 font-bold uppercase tracking-widest italic">Unassigned</span>
                            @endif
                        </div>
                    </td>

                    <td class="px-8 py-6 text-right">
                        @if(Auth::id() !== $user->id)
                            <form action="{{ route('admin.users.toggle-ban', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                @if($user->is_banned)
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-500 transition-all shadow-lg shadow-emerald-900/20 text-[10px] font-black uppercase tracking-widest active:scale-95">
                                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i> Restore
                                    </button>
                                @else
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-zinc-950 text-red-500 border border-red-500/30 hover:bg-red-600 hover:text-white transition-all text-[10px] font-black uppercase tracking-widest active:scale-95">
                                        <i data-lucide="user-minus" class="w-3.5 h-3.5"></i> Terminate
                                    </button>
                                @endif
                            </form>
                        @else
                            <span class="text-[9px] text-zinc-700 font-black uppercase tracking-widest italic pr-4">Self (Restricted)</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>