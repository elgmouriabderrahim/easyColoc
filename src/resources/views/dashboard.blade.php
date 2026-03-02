<x-app-layout>
    <div class="min-h-screen bg-[#0d0d12] text-zinc-400 font-sans antialiased p-6 lg:p-12 relative overflow-x-hidden">
        
        <div id="modal-container" class="fixed inset-0 z-50 flex items-center justify-center {{ ($errors->any() || $errors->invite->any()) ? '' : 'hidden' }}">
            <div id="modal-backdrop" class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity"></div>
            
            <div id="modal-category" class="modal-content relative bg-[#18181f] border border-white/10 p-8 rounded-2xl w-full max-w-md {{ old('_form') === 'category' ? '' : 'hidden' }} scale-100 opacity-100 transition-all duration-300">
                <button type="button" class="modal-close absolute top-4 right-4 text-zinc-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <h3 class="text-white font-bold text-xl mb-6 uppercase tracking-widest">Add Category</h3>
                <form action="{{ route('dashboard.categories.create') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_form" value="category">
                    <label class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold">Category Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"  placeholder="GROCERIES" class="w-full bg-[#0d0d12] border {{ $errors->has('name') ? 'border-red-500' : 'border-white/10' }} rounded-lg px-4 py-3 text-sm text-white focus:border-purple-500 focus:ring-0 uppercase font-mono">
                    @error('name') <p class="text-red-500 text-[9px] uppercase font-bold mt-1 tracking-widest">{{ $message }}</p> @enderror
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">Save Category</button>
                </form>
            </div>

            <div id="modal-invite" class="modal-content relative bg-[#18181f] border border-white/10 p-8 rounded-2xl w-full max-w-md {{ old('_form') === 'invite' ? '' : 'hidden' }} scale-100 opacity-100 transition-all duration-300">
                <button type="button" class="modal-close absolute top-4 right-4 text-zinc-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <h3 class="text-white font-bold text-xl mb-2 uppercase tracking-widest">Invite Resident</h3>
                <p class="text-[10px] text-zinc-500 mb-6 uppercase tracking-widest">Send an encrypted access link via email.</p>
                
                <form action="{{ route('dashboard.members.invite') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_form" value="invite">
                    <label class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold">Resident Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"  placeholder="resident@network.com" class="w-full bg-[#0d0d12] border {{ $errors->invite->has('email') ? 'border-red-500' : 'border-white/10' }} rounded-lg px-4 py-3 text-sm text-white focus:border-purple-500 focus:ring-0">
                    @if($errors->invite->has('email'))
                        <p class="text-red-500 text-[9px] uppercase font-bold mt-1 tracking-widest">{{ $errors->invite->first('email') }}</p>
                    @endif
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">Send Invitation</button>
                </form>
            </div>

            <div id="modal-create" class="modal-content relative bg-[#18181f] border border-white/10 p-8 rounded-2xl w-full max-w-md {{ old('_form') === 'create' ? '' : 'hidden' }} scale-100 opacity-100 transition-all duration-300">
                <button type="button" class="modal-close absolute top-4 right-4 text-zinc-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <h3 class="text-white font-bold text-xl mb-6 uppercase tracking-widest">Create Colocation</h3>
                <form action="{{ route('dashboard.colocation.create') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_form" value="create">
                    <label class="text-[10px] text-zinc-500 uppercase tracking-widest font-bold">Colocation Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="debuggers" class="w-full bg-[#0d0d12] border {{ $errors->has('name') ? 'border-red-500' : 'border-white/10' }} rounded-lg px-4 py-3 text-sm text-white focus:border-purple-500 focus:ring-0 uppercase font-mono">
                    @error('name') <p class="text-red-500 text-[9px] uppercase font-bold mt-1 tracking-widest">{{ $message }}</p> @enderror
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">Create Colocation</button>
                </form>
            </div>

            <div id="modal-join" class="modal-content relative bg-[#18181f] border border-white/10 p-8 rounded-2xl w-full max-w-md {{ old('_form') === 'join' ? '' : 'hidden' }} scale-100 opacity-100 transition-all duration-300">
                <button type="button" class="modal-close absolute top-4 right-4 text-zinc-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <h3 class="text-white font-bold text-xl mb-6 uppercase tracking-widest">Join Token</h3>
                <form action="{{ route('dashboard.colocation.join') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_form" value="join">
                    <input type="text" name="invite_token" value="{{ old('invite_token') }}" placeholder="colocation token" class="w-full bg-[#0d0d12] border {{ $errors->has('invite_token') ? 'border-red-500' : 'border-white/10' }} rounded-lg px-4 py-3 text-sm text-white focus:border-purple-500 focus:ring-0 uppercase font-mono">
                    @error('invite_token') <p class="text-red-500 text-[9px] uppercase font-bold mt-1 tracking-widest">{{ $message }}</p> @enderror
                    <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">Join Colocation</button>
                </form>
            </div>

            <div id="modal-expense" class="modal-content relative bg-[#18181f] border border-white/10 p-8 rounded-2xl w-full max-w-md max-lg {{ old('_form') === 'expense' ? '' : 'hidden' }} scale-100 opacity-100 transition-all duration-300">
                <button type="button" class="modal-close absolute top-4 right-4 text-zinc-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <h3 class="text-white font-bold text-xl mb-6 uppercase tracking-widest">Log Expenditure</h3>
                @if($categories->isEmpty())
                    <div class="text-center py-6">
                        <p class="text-[10px] text-red-500 font-black uppercase tracking-widest mb-4 italic">Locked: No Categories</p>
                        @if(Auth::user()->colocation_role === 'owner')
                        <button onclick="openModal('category')" class="bg-white/5 border border-white/10 text-white text-[10px] px-6 py-3 rounded-lg uppercase tracking-widest font-black hover:bg-white/10 transition-all">Create Category First</button>
                        @else
                        <p class="text-[10px] text-zinc-500 uppercase tracking-widest">Ask your administrator to create expense categories before logging transactions.</p>
                        @endif
                    </div>
                @else
                <form action="{{ route('dashboard.expenses.create') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="_form" value="expense">
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Expense Title" class="w-full bg-[#0d0d12] border {{ $errors->has('title') ? 'border-red-500' : 'border-white/10' }} rounded-lg px-4 py-3 text-sm text-white focus:border-purple-500 outline-none">
                    @error('title') <p class="text-red-500 text-[9px] uppercase font-bold mt-1 tracking-widest">{{ $message }}</p> @enderror
                    
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" placeholder="0.00" class="w-full bg-[#0d0d12] border {{ $errors->has('amount') ? 'border-red-500' : 'border-white/10' }} rounded-lg px-4 py-3 text-sm text-white focus:border-purple-500 outline-none">
                            @error('amount') <p class="text-red-500 text-[9px] uppercase font-bold mt-1 tracking-widest">{{ $message }}</p> @enderror
                        </div>
                        <div class="w-1/2">
                            <select name="category_id" class="w-full bg-[#0d0d12] border {{ $errors->has('category_id') ? 'border-red-500' : 'border-white/10' }} rounded-lg px-4 py-3 text-[10px] text-zinc-400 font-black uppercase tracking-widest focus:border-purple-500 outline-none">
                                <option value="" disabled {{ !old('category_id') ? 'selected' : '' }}>Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-[9px] uppercase font-bold mt-1 tracking-widest">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full bg-[#0d0d12] border {{ $errors->has('date') ? 'border-red-500' : 'border-white/10' }} rounded-lg px-4 py-3 text-sm text-white focus:border-purple-500 outline-none">
                    @error('date') <p class="text-red-500 text-[9px] uppercase font-bold mt-1 tracking-widest">{{ $message }}</p> @enderror
                    
                    <button class="w-full bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">Execute Transaction</button>
                </form>
                @endif
            </div>

            <div id="modal-confirm" class="modal-content relative bg-[#18181f] border border-white/10 p-8 rounded-2xl w-full max-w-md hidden scale-95 opacity-0 transition-all duration-300">
                <h3 class="text-white font-bold text-xl mb-2 uppercase tracking-widest">Confirm Action</h3>
                <p class="text-sm text-zinc-500 mb-8 uppercase tracking-widest text-[10px]">This protocol cannot be easily reversed.</p>
                <div class="flex flex-col gap-3">
                    @if($hasColocation)
                        @if(Auth::user()->colocation_role === 'owner')
                            <form action="{{ route('dashboard.colocation.cancel') }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full bg-red-600/20 hover:bg-red-600 text-red-500 hover:text-white border border-red-500/20 text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">Calncel Sector</button>
                            </form>
                        @else
                            <form action="{{ route('dashboard.colocation.leave') }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full bg-red-600/20 hover:bg-red-600 text-red-500 hover:text-white border border-red-500/20 text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">Leave Colocation</button>
                            </form>
                        @endif
                    @endif
                    <button onclick="closeModal()" class="w-full bg-[#2a2a35] text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">Cancel</button>
                </div>
            </div>

            <div id="modal-remove" class="modal-content relative bg-[#18181f] border border-white/10 p-8 rounded-2xl w-full max-w-md hidden scale-95 opacity-0 transition-all duration-300">
                <button type="button" class="modal-close absolute top-4 right-4 text-zinc-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
                <h3 class="text-white font-bold text-xl mb-2 uppercase tracking-widest">Eject Resident</h3>
                <p class="text-[10px] text-zinc-500 mb-8 uppercase tracking-widest leading-relaxed">Confirm absolute removal of <span id="remove-member-name" class="text-purple-500 font-black"></span> from this network sector.</p>
                
                <form id="remove-member-form" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex flex-col gap-3">
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-500 text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all shadow-lg shadow-red-900/20">
                            Execute Ejection
                        </button>
                        <button type="button" onclick="closeModal()" class="w-full bg-[#2a2a35] text-white text-[10px] font-black py-4 rounded-lg uppercase tracking-widest transition-all">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-[1300px] mx-auto space-y-8">
            
            @if (session('success'))
                <div class="js-alert p-4 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 text-[10px] font-black uppercase tracking-widest flex items-center justify-between backdrop-blur-md mb-6 transition-all duration-500">
                    <div class="flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-4 h-4"></i>
                        {{ session('success') }}
                    </div>
                    <button onclick="this.parentElement.remove()" class="hover:text-white transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            @if (session('status'))
                <div class="js-alert p-4 rounded-xl bg-white/5 border border-white/10 text-white text-[10px] font-black uppercase tracking-widest flex items-center justify-between backdrop-blur-md mb-6 transition-all duration-500">
                    <div class="flex items-center gap-3">
                        <i data-lucide="info" class="w-4 h-4 text-purple-500"></i>
                        {{ session('status') }}
                    </div>
                    <button onclick="this.parentElement.remove()" class="hover:text-white transition-colors">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-white/5 pb-8">
                <div class="space-y-1">
                    <h2 class="text-2xl font-bold text-white tracking-tight">
                        {{ $hasColocation ? $colocation->name : 'Identity Dashboard' }}
                    </h2>
                    @if($hasColocation && Auth::user()->colocation_role === 'owner')
                    <p class="text-[11px] text-zinc-500 uppercase tracking-[0.2em]">
                        {{ 'System Colocation // ' . $colocation->invite_token }}
                    </p>
                    @else
                    <p class="text-[11px] text-zinc-500 uppercase tracking-[0.2em]">
                        {{ $hasColocation ? 'Resident // ' . Auth::user()->colocation_role : 'Status // Unlinked Resident' }}
                    </p>
                    @endif
                </div>

                <div class="flex items-center gap-3">
                    @if(!$hasColocation)
                        <button onclick="openModal('create')" class="bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black px-6 py-3 rounded-lg uppercase tracking-widest transition-all shadow-lg shadow-purple-900/20">
                            Create Colocation
                        </button>
                        <button onclick="openModal('join')" class="bg-[#18181f] border border-white/10 hover:border-white/20 text-white text-[10px] font-black px-6 py-3 rounded-lg uppercase tracking-widest transition-all">
                            Join Colocation
                        </button>
                    @else
                        @if(Auth::user()->colocation_role === 'owner')
                            <button onclick="openModal('category')" class="bg-[#18181f] border border-white/10 hover:border-white/20 text-white text-[10px] font-black px-6 py-3 rounded-lg uppercase tracking-widest transition-all flex items-center gap-2">
                                <i data-lucide="tag" class="w-4 h-4"></i> new Category
                            </button>
                        @endif
                        <button onclick="openModal('expense')" class="bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black px-6 py-3 rounded-lg uppercase tracking-widest transition-all flex items-center gap-2">
                            <i data-lucide="plus" class="w-4 h-4"></i> New Expense
                        </button>
                    @endif
                </div>
            </div>

            @if(!$hasColocation)
                <div class="flex flex-col items-center justify-center min-h-[400px] text-center space-y-6">
                    <div class="w-20 h-20 bg-white/[0.02] border border-white/[0.05] rounded-3xl flex items-center justify-center">
                        <i data-lucide="shield-off" class="w-10 h-10 text-zinc-800"></i>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-bold text-white uppercase tracking-widest">No Colocation Linked</h3>
                        <p class="text-sm text-zinc-600 max-w-sm mx-auto uppercase text-[10px] tracking-wider leading-relaxed">Initialize a new administrative colocation or join an existing one using an invitation token.</p>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="space-y-6">
                        <div class="bg-[#18181f] border border-white/[0.05] rounded-2xl p-8 shadow-2xl relative overflow-hidden group">
                            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                                <i data-lucide="landmark" class="w-12 h-12 text-white"></i>
                            </div>
                            <p class="text-[10px] text-zinc-500 uppercase font-bold tracking-widest mb-1">Your Balance</p>
                            <h4 class="text-4xl font-black {{ $stats['balance'] >= 0 ? 'text-emerald-400' : 'text-red-500' }} tracking-tighter">
                                {{ number_format($stats['balance'], 2) }} DH
                            </h4>
                            <p class="text-[9px] text-zinc-600 uppercase font-black mt-4">Colocation Total: {{ number_format($stats['total_spent'], 2) }} DH</p>
                        </div>

                        <div class="bg-[#18181f] border border-white/[0.05] rounded-2xl p-6 shadow-2xl space-y-4">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-white font-bold text-[10px] uppercase tracking-widest flex items-center gap-2">
                                    <i data-lucide="users" class="w-4 h-4 text-purple-500"></i> Network Residents
                                </h3>
                                @if(Auth::user()->colocation_role === 'owner')
                                <button onclick="openModal('invite')" class="text-purple-500 hover:text-purple-400 transition-colors">
                                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                                </button>
                                @endif
                            </div>
                            <div class="space-y-3">
                                @foreach($members as $member)
                                <div class="flex items-center justify-between group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-purple-500/10 border border-purple-500/20 rounded-lg flex items-center justify-center text-[10px] font-bold text-purple-400">
                                            {{ substr($member->full_name, 0, 1) }}
                                        </div>
                                        <span class="text-xs text-zinc-300 font-bold">{{ $member->full_name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if(Auth::user()->colocation_role === 'owner' && $member->id !== Auth::id())
                                            <button 
                                                onclick="openRemoveModal('{{ $member->id }}', '{{ $member->full_name }}')"
                                                class="text-zinc-700 hover:text-red-500 transition-all opacity-0 group-hover:opacity-100"
                                            >
                                                <i data-lucide="user-minus" class="w-3.5 h-3.5"></i>
                                            </button>
                                        @endif
                                        <span class="text-[8px] bg-white/5 px-2 py-1 rounded-md text-zinc-500 font-black uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity">
                                            {{ $member->colocation_role }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-[#18181f] border border-white/[0.05] rounded-2xl p-6 shadow-2xl border-l-2 border-red-500/50">
                            <h3 class="text-white font-bold text-[10px] uppercase tracking-widest mb-2">Protocol Termination</h3>
                            <button onclick="openModal('confirm')" class="w-full bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white border border-red-500/10 text-[9px] font-black py-3 rounded-lg uppercase tracking-widest transition-all">
                                {{ Auth::user()->colocation_role === 'owner' ? 'Cancel Colocation' : 'Leave Colocation' }}
                            </button>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-[#18181f] border border-white/[0.05] rounded-2xl shadow-2xl overflow-hidden">
                            <div class="p-6 bg-white/[0.02] border-b border-white/[0.05] flex justify-between items-center">
                                <h3 class="text-white font-bold text-xs uppercase tracking-widest">Ledger History</h3>
                                <span class="text-[10px] text-zinc-500 font-mono">{{ $expenses->total() }} Entries</span>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <tbody class="divide-y divide-white/[0.02]">
                                        @foreach($expenses as $expense)
                                        <tr class="group hover:bg-white/[0.01] transition-colors">
                                            <td class="px-8 py-5 text-[10px] text-zinc-500 font-mono">{{ $expense->date->format('Y.m.d') }}</td>
                                            <td class="px-8 py-5">
                                                <p class="text-xs font-bold text-white tracking-tight">{{ $expense->title }}</p>
                                                <p class="text-[9px] text-zinc-600 uppercase font-black tracking-widest mt-1">{{ $expense->category->name }}</p>
                                            </td>
                                            <td class="px-8 py-5 text-sm font-black text-white text-right">{{ number_format($expense->amount, 2) }} DH</td>
                                            <td class="px-8 py-5 text-right">
                                                @if($expense->user_id === Auth::id())
                                                    <form action="{{ route('dashboard.expenses.delete', $expense->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                        <button class="text-zinc-700 hover:text-red-500 transition-all"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="p-4 border-t border-white/5 bg-black/10">
                                {{ $expenses->links() }}
                            </div>
                        </div>

                        <div class="bg-[#18181f] border border-white/[0.05] rounded-2xl shadow-2xl overflow-hidden">
                            <div class="p-6 bg-white/[0.02] border-b border-white/[0.05] flex justify-between items-center">
                                <h3 class="text-white font-bold text-xs uppercase tracking-widest">Settlements</h3>
                                <span class="text-[10px] text-zinc-500 font-mono">{{ $settlements->count() }} Entries</span>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <tbody class="divide-y divide-white/[0.02]">
                                        @forelse($settlements as $settlement)
                                        <tr class="group hover:bg-white/[0.01] transition-colors">
                                            <td class="px-8 py-5 text-[10px] text-zinc-500 font-mono">{{ $settlement->created_at->format('Y.m.d') }}</td>
                                            <td class="px-8 py-5 text-xs text-zinc-300 font-bold">
                                                {{ $settlement->owes->full_name }}
                                                <span class="text-zinc-600">→</span>
                                                {{ $settlement->receives->full_name }}
                                            </td>
                                            <td class="px-8 py-5 text-sm font-black text-white text-right">{{ number_format($settlement->amount, 2) }} DH</td>
                                            <td class="px-8 py-5 text-right">
                                                @if($settlement->is_paid)
                                                    <span class="text-[9px] bg-emerald-500/10 text-emerald-400 px-3 py-2 rounded-lg uppercase tracking-widest font-black">Paid</span>
                                                @elseif($settlement->owes_user_id === Auth::id())
                                                    <form action="{{ route('dashboard.settlements.paid', $settlement->id) }}" method="POST">
                                                        @csrf @method('PATCH')
                                                        <button class="text-[9px] bg-purple-600 hover:bg-purple-500 text-white px-3 py-2 rounded-lg uppercase tracking-widest font-black transition-colors">Mark Paid</button>
                                                    </form>
                                                @else
                                                    <span class="text-[9px] bg-white/5 text-zinc-500 px-3 py-2 rounded-lg uppercase tracking-widest font-black">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="px-8 py-8 text-center text-[10px] uppercase tracking-widest text-zinc-600">No settlements yet.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const modalContainer = document.getElementById('modal-container');
        const modalBackdrop = document.getElementById('modal-backdrop');
        const allModals = ['create', 'join', 'expense', 'confirm', 'invite', 'category', 'remove'];

        window.openModal = function(type) {
            modalContainer.classList.remove('hidden');
            allModals.forEach(m => {
                const el = document.getElementById(`modal-${m}`);
                if(el) el.classList.add('hidden');
            });
            const target = document.getElementById(`modal-${type}`);
            if(target) {
                target.classList.remove('hidden', 'scale-95', 'opacity-0');
                target.classList.add('scale-100', 'opacity-100');
            }
        };

        window.openRemoveModal = function(memberId, name) {
            document.getElementById('remove-member-name').innerText = name;
            const form = document.getElementById('remove-member-form');
            form.action = `/dashboard/members/${memberId}`;
            openModal('remove');
        };

        window.closeModal = function() {
            allModals.forEach(m => {
                const target = document.getElementById(`modal-${m}`);
                if(target) {
                    target.classList.add('scale-95', 'opacity-0');
                    target.classList.remove('scale-100', 'opacity-100');
                }
            });
            setTimeout(() => {
                modalContainer.classList.add('hidden');
            }, 300);
        };

        modalContainer.addEventListener('click', (e) => {
            if (e.target === modalBackdrop || e.target.closest('.modal-close')) {
                closeModal();
            }
        });

        document.onkeydown = (e) => {
            if (e.key === "Escape") closeModal();
        };

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();

            const alerts = document.querySelectorAll('.js-alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
</x-app-layout>