<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-black text-white min-h-screen flex items-center justify-center p-6 selection:bg-blue-500/30 overflow-hidden [font-family:'Inter',sans-serif]">

    <div class="fixed inset-0 z-[-1] overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_10%_10%,rgba(59,130,246,0.12)_0%,transparent_40%),radial-gradient(circle_at_90%_90%,rgba(16,185,129,0.08)_0%,transparent_40%)]"></div>
    </div>

    <div class="w-full max-w-4xl grid lg:grid-cols-2 bg-white/[0.03] backdrop-blur-[20px] border border-white/10 rounded-[2.5rem] overflow-hidden shadow-2xl ">
        
        <div class="hidden lg:flex flex-col justify-between p-12 bg-[url('/images/logbg.webp')] bg-cover bg-center border-r border-white/5 relative">
            <div class="absolute inset-0 bg-black/20"></div>
            
            <div class="relative z-10">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto">
                    <span class="text-xs font-bold tracking-[0.2em] uppercase opacity-60">EasyColoc</span>
                </a>
            </div>

            <div class="relative z-10">
                <h2 class="text-5xl leading-tight mb-6 italic font-black [font-family:'Playfair_Display',serif]">Security<br>First.</h2>
                <p class="text-gray-200 text-sm leading-relaxed max-w-xs drop-shadow-md">
                    Update your credentials to keep your household data and trust score protected.
                </p>
            </div>

            <div class="relative z-10 flex items-center gap-4 text-[10px] uppercase tracking-widest text-gray-300 font-bold">
                <span>Encrypted Access</span>
                <div class="h-1 w-1 bg-white/40 rounded-full"></div>
                <span>Safe Recovery</span>
            </div>
        </div>

        <div class="p-8 lg:p-12 flex flex-col justify-center bg-black/40">
            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-white">Reset Password</h1>
                <p class="text-gray-500 text-sm mt-1">Set your new access credentials below.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Email Address</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 w-4 h-4"></i>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly 
                               class="w-full pl-10 pr-4 py-3 rounded-xl text-sm bg-white/[0.02] border border-white/5 text-gray-500 cursor-not-allowed outline-none" />
                    </div>
                    @if($errors->has('email'))
                        <p class="text-red-500 text-[11px] mt-1 font-medium">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">New Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 w-4 h-4"></i>
                        <input id="password" type="password" name="password" required autofocus
                               class="w-full pl-10 pr-4 py-3 rounded-xl text-sm bg-white/[0.05] border {{ $errors->has('password') ? 'border-red-500' : 'border-white/10' }} text-white placeholder:text-gray-600 focus:outline-none focus:border-blue-500 transition-all" placeholder="••••••••" />
                    </div>
                    @if($errors->has('password'))
                        <p class="text-red-500 text-[11px] mt-1 font-medium">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Confirm Password</label>
                    <div class="relative">
                        <i data-lucide="check-circle" class="absolute left-3 top-1/2 -translate-y-1/2 text-white/40 w-4 h-4"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="w-full pl-10 pr-4 py-3 rounded-xl text-sm bg-white/[0.05] border {{ $errors->has('password') ? 'border-red-500' : 'border-white/10' }} text-white placeholder:text-gray-600 focus:outline-none focus:border-blue-500 transition-all" placeholder="••••••••" />
                    </div>
                </div>

                <button type="submit" class="w-full py-4 mt-4 bg-white text-black rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-all shadow-xl active:scale-[0.98]">
                    Reset Password
                </button>
            </form>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>