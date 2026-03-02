<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Amplified Living</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&family=Playfair+Display:ital,wght@0,900;1,900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-[#09090b] text-zinc-200 font-sans selection:bg-blue-500/30 overflow-x-hidden">

    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_20%_10%,rgba(59,130,246,0.12)_0%,transparent_40%),radial-gradient(circle_at_80%_80%,rgba(16,185,129,0.08)_0%,transparent_40%)]"></div>
    </div>

    <header class="relative max-w-6xl mx-auto px-6 pt-12">
        <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[75vh]">
            <div class="animate__animated animate__fadeIn">
                <div class="mb-8 flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto">
                    <span class="text-[10px] font-black tracking-[0.4em] uppercase text-zinc-500">EasyColoc</span>
                </div>
                
                <h1 class="font-serif text-6xl md:text-8xl leading-[0.9] tracking-tighter mb-8">
                    <span class="bg-gradient-to-b from-white to-zinc-400 bg-clip-text text-transparent">Amplified</span><br>
                    <span class="italic text-blue-500">Living.</span>
                </h1>
                
                <p class="text-zinc-400 text-base md:text-lg mb-10 max-w-md leading-relaxed">
                    Automate household finances and build a verified trust score. Professional co-living management for elite residents.
                </p>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-500 transition-all shadow-lg shadow-blue-900/20 flex items-center gap-2">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-black rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-all shadow-xl active:scale-95">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 border border-white/10 rounded-xl font-bold text-sm hover:bg-white/5 transition-all text-white">
                            Login
                        </a>
                    @endauth
                </div>
            </div>

            <div class="relative animate__animated animate__zoomIn flex justify-center lg:justify-end">
                <div class="bg-white/[0.03] backdrop-blur-xl p-2 rounded-[2rem] border border-white/10 shadow-2xl w-full max-w-[340px] rotate-2">
                    <img src="{{ asset('images/hook.png') }}" class="rounded-[1.8rem] w-full h-auto object-cover aspect-[4/5] grayscale hover:grayscale-0 transition-all duration-700">
                    <div class="absolute -bottom-6 -left-8 bg-zinc-900/90 backdrop-blur-xl p-6 rounded-2xl shadow-2xl border border-blue-500/30 -rotate-3">
                        <p class="text-[10px] text-blue-400 uppercase font-black tracking-[0.2em] mb-1">Reputation</p>
                        <p class="text-2xl font-black text-white italic font-serif tracking-tight">98.4% Trust</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="max-w-5xl mx-auto px-6 py-32">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-black tracking-tight mb-4 text-white">Your Command Center.</h2>
            <p class="text-zinc-500 text-sm font-medium uppercase tracking-widest">Real-time ledgers meet shared household tasks.</p>
        </div>
        
        <div class="relative group max-w-4xl mx-auto">
            <div class="absolute -inset-4 bg-gradient-to-r from-blue-600/20 to-emerald-600/20 rounded-[3rem] blur-3xl opacity-30 group-hover:opacity-50 transition duration-1000"></div>
            <div class="relative bg-zinc-900/50 backdrop-blur-3xl rounded-[2.5rem] p-3 border border-white/5 overflow-hidden shadow-2xl">
                <img src="{{ asset('images/roommates1.png') }}" alt="UI Preview" class="rounded-[2rem] w-full opacity-80 group-hover:opacity-100 transition duration-700">
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 py-20 border-t border-white/5">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-8 rounded-[2rem] bg-zinc-900/30 border border-white/5 hover:border-blue-500/30 transition-all group">
                <div class="bg-blue-500/10 w-12 h-12 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="zap" class="text-blue-500 w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold mb-3 text-white">Smart Ledger</h3>
                <p class="text-zinc-500 text-sm leading-relaxed font-medium">Automatic bill splitting and real-time expense tracking.</p>
            </div>
            
            <div class="p-8 rounded-[2rem] bg-zinc-900/30 border border-white/5 hover:border-emerald-500/30 transition-all group">
                <div class="bg-emerald-500/10 w-12 h-12 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="shield" class="text-emerald-500 w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold mb-3 text-white">Trust Score</h3>
                <p class="text-zinc-500 text-sm leading-relaxed font-medium">Build your portable reputation for your next home.</p>
            </div>

            <div class="p-8 rounded-[2rem] bg-zinc-900/30 border border-white/5 hover:border-purple-500/30 transition-all group">
                <div class="bg-purple-500/10 w-12 h-12 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="layout" class="text-purple-500 w-6 h-6"></i>
                </div>
                <h3 class="text-lg font-bold mb-3 text-white">House Rules</h3>
                <p class="text-zinc-500 text-sm leading-relaxed font-medium">Centralized docs, cleaning rotations, and legal vault.</p>
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 py-32">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="order-2 lg:order-1 flex justify-center lg:justify-start group">
                <div class="relative">
                    <div class="absolute -inset-1 bg-blue-500/20 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition"></div>
                    <img src="{{ asset('images/roommates2.png') }}" class="relative rounded-[2rem] w-full max-w-[420px] shadow-2xl border border-white/10 grayscale hover:grayscale-0 transition duration-1000">
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <span class="text-emerald-500 font-black tracking-[0.4em] text-[10px] uppercase mb-6 block">Reputation Engine</span>
                <h2 class="font-serif text-5xl mb-8 leading-tight italic bg-gradient-to-r from-white to-zinc-500 bg-clip-text text-transparent">Trust is your asset.</h2>
                <p class="text-zinc-400 text-base leading-relaxed mb-10">
                    EasyColoc tracks your financial reliability. Build a score that follows you, making it easier to secure rentals and top-tier roommates.
                </p>
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="h-8 w-8 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-500 border border-emerald-500/20"><i data-lucide="check" class="w-4 h-4"></i></div>
                        <span class="text-sm font-bold text-zinc-300">Verify bill payments instantly</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="h-8 w-8 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 border border-blue-500/20"><i data-lucide="check" class="w-4 h-4"></i></div>
                        <span class="text-sm font-bold text-zinc-300">Earn status for household contributions</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-16 border-t border-white/5 bg-black/50 backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="text-2xl font-black tracking-tighter italic font-serif">Easy<span class="text-blue-500">Coloc</span></div>
            <div class="flex gap-10 text-[10px] tracking-[0.3em] uppercase text-zinc-500 font-black">
                <a href="#" class="hover:text-blue-500 transition-colors">Features</a>
                <a href="#" class="hover:text-blue-500 transition-colors">Privacy</a>
                <a href="#" class="hover:text-blue-500 transition-colors">Contact</a>
            </div>
            <p class="text-[9px] text-zinc-700 uppercase tracking-[0.4em] font-black">© 2026 EasyColoc Platform</p>
        </div>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>