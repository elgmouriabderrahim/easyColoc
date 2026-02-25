<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | EasyColoc</title>
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
            <div class="absolute inset-0 bg-black/30"></div>
            
            <div class="relative z-10">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto">
                    <span class="text-xs font-bold tracking-[0.2em] uppercase opacity-60">EasyColoc</span>
                </a>
            </div>

            <div class="relative z-10">
                <h2 class="text-5xl leading-tight mb-6 italic font-black [font-family:'Playfair_Display',serif]">Restore<br>Access.</h2>
                <p class="text-gray-200 text-sm leading-relaxed max-w-xs drop-shadow-md">
                    Forgot your password? No problem. Provide your email and we'll send a recovery link to get you back into the house.
                </p>
            </div>

            <div class="relative z-10 flex items-center gap-4 text-[10px] uppercase tracking-widest text-gray-300 font-bold">
                <span>Account Recovery</span>
                <div class="h-1 w-1 bg-white/40 rounded-full"></div>
                <span>Direct Support</span>
            </div>
        </div>

        <div class="p-8 lg:p-12 flex flex-col justify-center bg-black/40">
            <div class="mb-10 lg:hidden text-center">
                 <img src="{{ asset('images/logo.png') }}" class="h-12 w-auto mx-auto mb-4">
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-white">Forgot Password</h1>
                <p class="text-gray-500 text-sm mt-4 leading-relaxed">
                    {{ __('Enter your email address and we will email you a password reset link.') }}
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 bg-blue-500/10 border border-blue-500/20 rounded-xl">
                    <p class="text-blue-400 text-xs font-medium">
                        {{ session('status') }}
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                           class="w-full px-4 py-3 rounded-xl text-sm bg-white/[0.05] border border-white/10 text-white placeholder:text-gray-600 focus:outline-none focus:border-blue-500 transition-all" 
                           placeholder="you@example.com">
                    @if($errors->has('email'))
                        <p class="text-red-400 text-[10px] mt-2">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <button type="submit" class="w-full py-4 bg-white text-black rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-all shadow-xl active:scale-[0.98]">
                    {{ __('Email Password Reset Link') }}
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-gray-500">
                Remembered it? 
                <a href="{{ route('login') }}" class="text-white font-bold hover:underline">Go back to log in</a>
            </p>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>