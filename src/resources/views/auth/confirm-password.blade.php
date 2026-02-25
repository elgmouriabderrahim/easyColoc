<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Access | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://unpkg.com/@lucide/lucide@latest"></script>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center p-6 selection:bg-blue-500/30 overflow-hidden">

    <div class="fixed inset-0 z-[-1] overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_10%_10%,rgba(59,130,246,0.12)_0%,transparent_40%),radial-gradient(circle_at_90%_90%,rgba(16,185,129,0.08)_0%,transparent_40%)]"></div>
    </div>

    <div class="w-full max-w-4xl grid lg:grid-cols-2 bg-white/[0.03] backdrop-blur-[20px] border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl animate__animated animate__zoomIn">
        
        <div class="hidden lg:flex flex-col justify-between p-12 bg-[url('/images/logbg.webp')] bg-cover bg-center border-r border-white/5 relative">
            <div class="absolute inset-0 bg-black/40"></div>
            
            <div class="relative z-10">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto">
                    <span class="text-xs font-bold tracking-[0.2em] uppercase opacity-60">EasyColoc</span>
                </a>
            </div>

            <div class="relative z-10">
                <h2 class="text-5xl leading-tight mb-6 italic font-black [font-family:'Playfair_Display',serif]">Secure<br>Vault.</h2>
                <p class="text-gray-200 text-sm leading-relaxed max-w-xs drop-shadow-md">
                    This is a protected area. Please verify your identity to proceed with sensitive household changes.
                </p>
            </div>

            <div class="relative z-10 flex items-center gap-4 text-[10px] uppercase tracking-widest text-gray-300 font-bold">
                <span>Identity Verified</span>
                <div class="h-1 w-1 bg-white/40 rounded-full"></div>
                <span>Active Shield</span>
            </div>
        </div>

        <div class="p-8 lg:p-12 flex flex-col justify-center bg-black/40">
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-3 bg-blue-500/10 rounded-full border border-blue-500/20">
                        <i data-lucide="lock" class="w-5 h-5 text-blue-500"></i>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight text-white">Security Check</h1>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                           class="w-full px-4 py-3 rounded-xl text-sm bg-white/[0.05] border border-white/10 text-white placeholder:text-gray-600 focus:outline-none focus:border-blue-500 transition-all" 
                           placeholder="••••••••">
                    @if($errors->has('password'))
                        <p class="text-red-400 text-[10px] mt-2 font-medium">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <button type="submit" class="w-full py-4 bg-white text-black rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-all shadow-xl active:scale-[0.98]">
                    {{ __('Confirm Access') }}
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ url()->previous() }}" class="text-[10px] uppercase tracking-widest font-bold text-gray-500 hover:text-white transition-colors">
                    Go Back
                </a>
            </div>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>