<x-app-layout>
    <div class="min-h-screen bg-[#0d0d12] text-zinc-400 font-sans antialiased p-6 lg:p-12">
        
        <div class="max-w-[1200px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="bg-[#18181f] border border-white/[0.05] rounded-xl shadow-2xl flex flex-col min-h-[600px]">
                <div class="flex border-b border-white/[0.05] bg-white/[0.02] px-4">
                    <button onclick="switchTab('information')" id="btn-information" 
                            class="tab-btn py-3 px-4 text-[10px] font-bold border-b-2 uppercase tracking-[0.2em] transition-all text-purple-500 border-purple-500">
                        Information
                    </button>
                    <button onclick="switchTab('experiences')" id="btn-experiences" 
                            class="tab-btn py-3 px-4 text-[10px] font-bold border-b-2 uppercase tracking-[0.2em] transition-all text-zinc-600 border-transparent hover:text-zinc-400">
                        Experiences
                    </button>
                    <button onclick="switchTab('ledger')" id="btn-ledger" 
                            class="tab-btn py-3 px-4 text-[10px] font-bold border-b-2 uppercase tracking-[0.2em] transition-all text-zinc-600 border-transparent hover:text-zinc-400">
                        Ledger
                    </button>
                </div>

                <div class="p-8 space-y-8 flex-1">
                    
                    <div id="tab-information" class="tab-content">
                        <div class="space-y-1.5 mb-8">
                            <h2 class="text-xl font-bold text-white tracking-tight">Identity Report</h2>
                            <p class="text-[11px] text-zinc-500 leading-relaxed uppercase tracking-wider">Live database pulse // Resident metrics</p>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Total Verified Residents</label>
                                <div class="w-full bg-[#212129] border border-white/[0.05] rounded-lg p-4 text-white text-lg font-bold flex justify-between items-center">
                                    {{ number_format($userCount) }}
                                    <i data-lucide="users" class="w-4 h-4 text-purple-500 opacity-50"></i>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Reputation Distribution</label>
                                <div class="bg-[#212129] border border-white/[0.05] rounded-lg p-5 space-y-6">
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-tight">
                                            <span class="text-zinc-400">Trusted Protocol</span>
                                            <span class="text-purple-400 font-black">{{ $trustedUsersCount }} Users</span>
                                        </div>
                                        <div class="h-1.5 w-full bg-black/40 rounded-full overflow-hidden">
                                            <div class="h-full bg-purple-500 shadow-[0_0_10px_rgba(168,85,247,0.4)]" style="width: {{ ($trustedUsersCount / max($userCount, 1)) * 100 }}%"></div>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-tight">
                                            <span class="text-zinc-400">Neutral Standing</span>
                                            <span class="text-zinc-500 font-black">{{ $neutralUsersCount }} Users</span>
                                        </div>
                                        <div class="h-1.5 w-full bg-black/40 rounded-full overflow-hidden">
                                            <div class="h-full bg-zinc-600" style="width: {{ ($neutralUsersCount / max($userCount, 1)) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab-experiences" class="tab-content hidden">
                        <div class="space-y-1.5 mb-8">
                            <h2 class="text-xl font-bold text-white tracking-tight">Experience Metrics</h2>
                            <p class="text-[11px] text-zinc-500 leading-relaxed uppercase">Interaction density across sectors</p>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-[#212129] border border-white/[0.05] rounded-lg p-6 flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] text-zinc-500 uppercase font-black tracking-widest">Active Categories</p>
                                    <p class="text-3xl font-bold text-white">{{ $categoriesCount }}</p>
                                </div>
                                <i data-lucide="layers" class="w-8 h-8 text-purple-500 opacity-20"></i>
                            </div>
                        </div>
                    </div>

                    <div id="tab-ledger" class="tab-content hidden">
                        <div class="space-y-1.5 mb-8">
                            <h2 class="text-xl font-bold text-white tracking-tight">Financial Ledger</h2>
                            <p class="text-[11px] text-zinc-500 leading-relaxed uppercase">Global expense tracking</p>
                        </div>
                        <div class="bg-[#212129] border border-white/[0.05] rounded-lg p-6">
                            <p class="text-[10px] font-bold uppercase text-zinc-500 mb-2">Total System Expenses</p>
                            <span class="text-3xl text-white font-mono font-bold">{{ $expensesCount }}</span>
                        </div>
                    </div>

                </div>

                <div class="p-6 border-t border-white/[0.05] flex justify-between items-center bg-white/[0.01]">
                    <button onclick="window.print()" class="text-[10px] font-black text-zinc-600 hover:text-white uppercase tracking-widest transition-colors flex items-center gap-2">
                        <i data-lucide="printer" class="w-3 h-3"></i> Export PDF
                    </button>
                    <button onclick="window.location.reload()" class="bg-[#2a2a35] hover:bg-[#353545] text-white text-[10px] font-black px-8 py-3 rounded-lg uppercase tracking-widest transition-all flex items-center gap-2">
                        <i data-lucide="refresh-cw" class="w-3 h-3"></i> Refresh Data
                    </button>
                </div>
            </div>

            <div class="bg-[#18181f] border border-white/[0.05] rounded-xl shadow-2xl flex flex-col h-fit">
                <div class="flex border-b border-white/[0.05] bg-white/[0.02] px-4">
                    <button class="py-3 px-4 text-[10px] font-bold text-purple-500 border-b-2 border-purple-500 uppercase tracking-[0.2em]">Live Status</button>
                </div>

                <div class="p-8 space-y-8">
                    <div class="space-y-1.5">
                        <h2 class="text-xl font-bold text-white tracking-tight">System Infrastructure</h2>
                        <p class="text-[11px] text-zinc-500">Node monitoring for active colocations.</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-[#212129] border border-purple-500/20 rounded-lg p-5">
                            <p class="text-[9px] font-black text-zinc-500 uppercase tracking-widest mb-2">Colocations</p>
                            <p class="text-3xl font-bold text-white tracking-tighter">{{ $colocationCount }}</p>
                        </div>
                        <div class="bg-[#212129] border border-white/[0.05] rounded-lg p-5">
                            <p class="text-[9px] font-black text-zinc-500 uppercase tracking-widest mb-2">Alert Flags</p>
                            <p class="text-3xl font-bold text-red-500 tracking-tighter">{{ $untrustedUsersCount - $neutralUsersCount }}</p>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-zinc-500 uppercase tracking-widest ml-1">Registry Health</label>
                        <div class="bg-purple-600/5 border border-purple-500/20 rounded-lg p-4 flex items-center gap-4">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                            <p class="text-[10px] text-zinc-400 leading-tight uppercase font-bold tracking-widest">All systems operational</p>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('admin.users') }}" class="flex-1 bg-[#2a2a35] text-zinc-400 text-[10px] font-black py-4 rounded-lg uppercase tracking-widest hover:text-white transition-colors text-center border border-white/5">
                            Return to Registry
                        </a>
                        <button onclick="cycleTabs()" 
                                class="flex-1 bg-purple-600 text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest shadow-lg shadow-purple-900/40 hover:bg-purple-500 transition-colors">
                            Next View
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentTab = 'information';
        const tabs = ['information', 'experiences', 'ledger'];

        function switchTab(tabId) {
            currentTab = tabId;
            
            // Hide all content and reset buttons
            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('text-purple-500', 'border-purple-500');
                btn.classList.add('text-zinc-600', 'border-transparent');
            });

            // Show active
            document.getElementById('tab-' + tabId).classList.remove('hidden');
            const activeBtn = document.getElementById('btn-' + tabId);
            activeBtn.classList.add('text-purple-500', 'border-purple-500');
            activeBtn.classList.remove('text-zinc-600', 'border-transparent');
        }

        function cycleTabs() {
            let currentIndex = tabs.indexOf(currentTab);
            let nextIndex = (currentIndex + 1) % tabs.length;
            switchTab(tabs[nextIndex]);
        }

        // Initialize Lucide icons
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();
        });
    </script>
</x-app-layout>