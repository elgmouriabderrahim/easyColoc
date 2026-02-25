<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyColoc | Amplified Living</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://unpkg.com/@lucide/lucide@latest"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,900;1,900&display=swap');
        
        body { font-family: 'Inter', sans-serif; background-color: #000; color: white; scroll-behavior: smooth; }
        .serif-title { font-family: 'Playfair Display', serif; }
        
        /* Professional Tight Glassmorphism */
        .glass-ui { 
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Refined Mesh Background */
        .bg-mesh-pro {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 20% 10%, rgba(59, 130, 246, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.05) 0%, transparent 40%);
        }

        /* Scaled down, professional buttons */
        .btn-pro {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .hero-text-pro {
            background: linear-gradient(180deg, #FFFFFF 0%, rgba(255, 255, 255, 0.7) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="overflow-x-hidden">

    <div class="bg-mesh-pro"></div>

    <header class="relative max-w-6xl mx-auto px-6 pt-12">
        <div class="grid lg:grid-cols-2 gap-12 items-center min-h-[70vh]">
            <div class="animate__animated animate__fadeIn">
                <div class="mb-8 flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto">
                    <span class="text-xs font-bold tracking-[0.2em] uppercase opacity-50">EasyColoc</span>
                </div>
                
                <h1 class="serif-title text-5xl md:text-7xl leading-tight tracking-tighter mb-6">
                    <span class="hero-text-pro">Amplified</span><br>
                    <span class="italic text-blue-500">Living.</span>
                </h1>
                
                <p class="text-gray-400 text-base md:text-lg mb-8 max-w-md leading-relaxed">
                    Automate household finances and build a verified trust score. Professional co-living management for elite residents.
                </p>

                <div class="flex items-center gap-4">
                    <a href="{{ route('register') }}" class="btn-pro bg-white text-black hover:bg-blue-600 hover:text-white">Get Started</a>
                    <a href="{{ route('login') }}" class="btn-pro border border-white/10 hover:bg-white/5">Login</a>
                </div>
            </div>

            <div class="relative animate__animated animate__zoomIn flex justify-center lg:justify-end">
                <div class="glass-ui p-2 rounded-2xl shadow-2xl w-full max-w-[320px]">
                    <img src="{{ asset('images/hook.png') }}" class="rounded-xl w-full h-auto object-cover aspect-[4/5]">
                    <div class="absolute -bottom-4 -left-6 glass-ui p-4 rounded-xl shadow-xl border-blue-500/30">
                        <p class="text-[10px] text-blue-400 uppercase font-bold tracking-widest mb-1">Reputation</p>
                        <p class="text-lg font-bold">98.4% Trust</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="max-w-5xl mx-auto px-6 py-20">
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold mb-3">Your Command Center.</h2>
            <p class="text-gray-500 text-sm">Real-time ledgers meet shared household tasks.</p>
        </div>
        
        <div class="relative group max-w-4xl mx-auto">
            <div class="absolute -inset-1 bg-gradient-to-r from-blue-600/20 to-emerald-600/20 rounded-3xl blur-xl opacity-50"></div>
            <div class="glass-ui rounded-3xl p-2 border-white/5 overflow-hidden">
                <img src="{{ asset('images/roommates1.png') }}" alt="UI Preview" class="rounded-2xl w-full">
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl border border-white/5 hover:bg-white/5 transition-colors">
                <i data-lucide="zap" class="text-blue-500 w-6 h-6 mb-4"></i>
                <h3 class="font-bold mb-2">Smart Ledger</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Automatic bill splitting and real-time expense tracking.</p>
            </div>
            <div class="p-6 rounded-2xl border border-white/5 hover:bg-white/5 transition-colors">
                <i data-lucide="shield" class="text-emerald-500 w-6 h-6 mb-4"></i>
                <h3 class="font-bold mb-2">Trust Score</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Build your portable reputation for your next home.</p>
            </div>
            <div class="p-6 rounded-2xl border border-white/5 hover:bg-white/5 transition-colors">
                <i data-lucide="layout" class="text-purple-500 w-6 h-6 mb-4"></i>
                <h3 class="font-bold mb-2">House Rules</h3>
                <p class="text-gray-500 text-xs leading-relaxed">Centralized docs, cleaning rotations, and legal vault.</p>
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 py-20">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1 flex justify-center lg:justify-start">
                <img src="{{ asset('images/roommates2.png') }}" class="rounded-2xl w-full max-w-[400px] shadow-2xl border border-white/10">
            </div>
            <div class="order-1 lg:order-2">
                <span class="text-emerald-500 font-bold tracking-widest text-[10px] uppercase mb-4 block">Reputation Engine</span>
                <h2 class="serif-title text-4xl mb-6">Trust is your asset.</h2>
                <p class="text-gray-400 text-sm leading-relaxed mb-8">
                    EasyColoc tracks your financial reliability. Build a score that follows you, making it easier to secure rentals and top-tier roommates.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="h-6 w-6 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-500"><i data-lucide="check" class="w-4 h-4"></i></div>
                        <span class="text-xs font-medium">Verify bill payments instantly</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="h-6 w-6 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400"><i data-lucide="check" class="w-4 h-4"></i></div>
                        <span class="text-xs font-medium">Earn status for household contributions</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 border-t border-white/5 mt-20">
        <div class="max-w-5xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-xl font-bold tracking-tighter">Easy<span class="text-blue-500">Coloc</span></div>
            <div class="flex gap-8 text-[10px] tracking-widest uppercase text-gray-500 font-bold">
                <a href="#" class="hover:text-white">Features</a>
                <a href="#" class="hover:text-white">Privacy</a>
                <a href="#" class="hover:text-white">Contact</a>
            </div>
            <p class="text-[10px] text-gray-700 uppercase tracking-widest">© 2026 EasyColoc Platform</p>
        </div>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>