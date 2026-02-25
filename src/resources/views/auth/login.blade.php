<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://unpkg.com/@lucide/lucide@latest"></script>
</head>
<body class="bg-[#000] text-white h-screen flex items-center justify-center overflow-hidden [font-family:'Inter',sans-serif]">

    <div class="fixed inset-0 -z-10 bg-[radial-gradient(circle_at_10%_10%,rgba(59,130,246,0.12)_0%,transparent_40%),radial-gradient(circle_at_90%_90%,rgba(16,185,129,0.08)_0%,transparent_40%)]"></div>

    <div class="w-full max-w-4xl grid lg:grid-cols-2 gap-0 bg-white/[0.03] backdrop-blur-[20px] border border-white/[0.08] rounded-[2.5rem] overflow-hidden shadow-2xl">
        
        <div class="hidden lg:flex flex-col justify-between p-12 bg-[url('/images/logbg.webp')] bg-cover bg-center border-r border-white/5 relative">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto">
                    <span class="text-xs font-bold tracking-[0.2em] uppercase opacity-60">EasyColoc</span>
                </a>
            </div>

            <div class="relative z-10">
                <h2 class="text-5xl leading-tight mb-6 italic [font-family:'Playfair_Display',serif] font-black text-white">Welcome<br>Back.</h2>
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                    Access your household dashboard to settle expenses and maintain your high-status reputation.
                </p>
            </div>

            <div class="relative z-10 flex items-center gap-4 text-[10px] uppercase tracking-widest text-gray-500 font-bold">
                <span>Security Verified</span>
                <div class="h-1 w-1 bg-white/20 rounded-full"></div>
                <span>256-bit SSL</span>
            </div>
        </div>

        <div class="p-8 lg:p-12 flex flex-col justify-center bg-black/40">
            <div class="mb-10 lg:hidden text-center">
                 <img src="{{ asset('images/logo.png') }}" class="h-12 w-auto mx-auto mb-4">
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-white">Log in</h1>
                <p class="text-gray-500 text-sm mt-1">Enter your credentials to continue.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" autofocus 
                           class="w-full px-4 py-3 rounded-xl text-sm bg-white/[0.05] border {{ $errors->has('email') ? 'border-red-500' : 'border-white/10' }} text-white transition-all duration-300 outline-none focus:border-[#3b82f6] focus:bg-white/[0.08] focus:ring-[4px] focus:ring-[#3b82f6]/10" placeholder="resident@easycoloc.com">
                    @if($errors->has('email'))
                        <p class="text-red-500 text-[11px] mt-1 font-medium">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] uppercase font-bold text-blue-500 hover:text-white transition-colors duration-300">Forgot?</a>
                        @endif
                    </div>
                    <input type="password" name="password"  
                           class="w-full px-4 py-3 rounded-xl text-sm bg-white/[0.05] border {{ $errors->has('password') ? 'border-red-500' : 'border-white/10' }} text-white transition-all duration-300 outline-none focus:border-[#3b82f6] focus:bg-white/[0.08] focus:ring-[4px] focus:ring-[#3b82f6]/10" placeholder="••••••••">
                    @if($errors->has('password'))
                        <p class="text-red-500 text-[11px] mt-1 font-medium">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-white/10 bg-white/5 text-blue-600 focus:ring-blue-500">
                    <span class="ms-2 text-xs text-gray-400">Keep me logged in</span>
                </div>

                <button type="submit" class="w-full py-4 bg-white text-black rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-all shadow-xl active:scale-[0.98]">
                    Log in
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-gray-500">
                New to the platform? 
                <a href="{{ route('register') }}" class="text-white font-bold hover:underline decoration-blue-500 decoration-2 underline-offset-4">Create account</a>
            </p>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>