<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EasyColoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://unpkg.com/@lucide/lucide@latest"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,900;1,900&display=swap');
        
        body { font-family: 'Inter', sans-serif; background-color: #000; color: white; height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .serif-title { font-family: 'Playfair Display', serif; }
        
        .glass-ui { 
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .bg-mesh-pro {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: -1;
            background: 
                radial-gradient(circle at 10% 10%, rgba(59, 130, 246, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(16, 185, 129, 0.08) 0%, transparent 40%);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.08);
            outline: none;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
    </style>
</head>
<body>

    <div class="bg-mesh-pro"></div>

    <div class="w-full max-w-4xl grid lg:grid-cols-2 gap-0 glass-ui rounded-[2.5rem] overflow-hidden shadow-2xl animate__animated animate__zoomIn">
        
        <div class="hidden lg:flex flex-col justify-between p-12 bg-[url('/images/logbg.webp')]  bg-cover bg-center border-r border-white/5">
            <div>
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-auto">
                    <span class="text-xs font-bold tracking-[0.2em] uppercase opacity-60">EasyColoc</span>
                </a>
            </div>

            <div>
                <h2 class="serif-title text-5xl leading-tight mb-6 italic">Welcome<br>Back.</h2>
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                    Access your household dashboard to settle expenses and maintain your high-status reputation.
                </p>
            </div>

            <div class="flex items-center gap-4 text-[10px] uppercase tracking-widest text-gray-500 font-bold">
                <span>Security Verified</span>
                <div class="h-1 w-1 bg-white/20 rounded-full"></div>
                <span>256-bit SSL</span>
            </div>
        </div>

        <div class="p-8 lg:p-12 flex flex-col justify-center">
            <div class="mb-10 lg:hidden text-center">
                 <img src="{{ asset('images/logo.png') }}" class="h-12 w-auto mx-auto mb-4">
            </div>

            <div class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight">Log in</h1>
                <p class="text-gray-500 text-sm mt-1">Enter your credentials to continue.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                           class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="resident@easycoloc.com">
                    @if($errors->has('email'))
                        <p class="text-red-400 text-xs mt-2">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <label class="block text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] uppercase font-bold text-blue-500 hover:text-white transition-colors">Forgot?</a>
                        @endif
                    </div>
                    <input type="password" name="password" required 
                           class="input-field w-full px-4 py-3 rounded-xl text-sm" placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-white/10 bg-white/5 text-blue-600 focus:ring-blue-500">
                    <span class="ms-2 text-xs text-gray-400">Keep me Loged in</span>
                </div>

                <button type="submit" class="w-full py-4 bg-white text-black rounded-xl font-bold text-sm hover:bg-blue-600 hover:text-white transition-all shadow-xl">
                    Log in
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-gray-500">
                New to the platform? 
                <a href="{{ route('register') }}" class="text-white font-bold hover:underline">Create account</a>
            </p>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>