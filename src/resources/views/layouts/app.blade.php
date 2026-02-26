<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EasyColoc') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Playfair+Display:ital,wght@1,900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://unpkg.com/lucide@latest"></script>
    </head>
    <body class="font-sans antialiased bg-[#0c0c0e] text-gray-200 overflow-x-hidden">
        
        <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_15%_15%,rgba(59,130,246,0.15)_0%,transparent_50%)]"></div>
        </div>

        <div class="relative z-10 flex min-h-screen">
            
            <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-[#121214] border-r border-white/5 flex flex-col shadow-2xl">
                <div class="p-8">
                    <a href="/" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo.png') }}" alt="EasyColoc Logo" class="w-8 h-8 rounded-full group-hover:rotate-12 transition-transform">
                        <span class="text-sm font-black uppercase tracking-[0.3em] text-white italic [font-family:'Playfair_Display',serif]">EasyColoc</span>
                    </a>
                </div>

                <nav class="flex-grow px-4 space-y-2">
                    <a href="{{ route('dashboard') }}" 
                        class="relative group flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 ease-out
                        {{ request()->routeIs('dashboard') 
                                ? 'bg-blue-600/10 border border-blue-500/20 text-white shadow-[0_0_20px_rgba(59,130,246,0.1)]' 
                                : 'text-zinc-500 hover:bg-white/[0.03] hover:text-zinc-200 border border-transparent' 
                        }}">
                            @if(request()->routeIs('dashboard'))
                                <div class="absolute left-0 w-1 h-5 bg-blue-500 rounded-r-full"></div>
                            @endif
                            <div class="flex items-center justify-center transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('dashboard') ? 'text-blue-400' : 'text-zinc-500 group-hover:text-zinc-300' }}">
                                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            </div>
                            <span class="text-sm font-bold tracking-tight">
                                {{ __('Dashboard') }}
                            </span>
                            <i data-lucide="chevron-right" 
                            class="ml-auto w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 
                            {{ request()->routeIs('dashboard') ? 'opacity-40 translate-x-0' : 'group-hover:opacity-40 group-hover:translate-x-0' }}">
                            </i>
                    </a>
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.users') }}"
                        class="relative group flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 ease-out
                        {{ request()->routeIs('admin.users')
                                ? 'bg-blue-600/10 border border-blue-500/20 text-white shadow-[0_0_20px_rgba(59,130,246,0.1)]' 
                                : 'text-zinc-500 hover:bg-white/[0.03] hover:text-zinc-200 border border-transparent' 
                        }}">
                            @if(request()->routeIs('admin.users'))
                                <div class="absolute left-0 w-1 h-5 bg-blue-500 rounded-r-full"></div>
                            @endif
                            <div class="flex items-center justify-center transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.users') ? 'text-blue-400' : 'text-zinc-500 group-hover:text-zinc-300' }}">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <span class="text-sm font-bold tracking-tight">
                                {{ __('Users') }}
                            </span>
                            <i data-lucide="chevron-right" 
                            class="ml-auto w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 
                            {{ request()->routeIs('admin.users') ? 'opacity-40 translate-x-0' : 'group-hover:opacity-40 group-hover:translate-x-0' }}">
                            </i>
                    </a>
                    <a href="{{ route('admin.statistics') }}" 
                        class="relative group flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-300 ease-out
                        {{ request()->routeIs('admin.statistics')
                                ? 'bg-blue-600/10 border border-blue-500/20 text-white shadow-[0_0_20px_rgba(59,130,246,0.1)]' 
                                : 'text-zinc-500 hover:bg-white/[0.03] hover:text-zinc-200 border border-transparent' 
                        }}">
                            @if(request()->routeIs('admin.statistics'))
                                <div class="absolute left-0 w-1 h-5 bg-blue-500 rounded-r-full"></div>
                            @endif
                            <div class="flex items-center justify-center transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs('admin.statistics') ? 'text-blue-400' : 'text-zinc-500 group-hover:text-zinc-300' }}">
                                <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                            </div>
                            <span class="text-sm font-bold tracking-tight">
                                {{ __('Statistics') }}
                            </span>
                            <i data-lucide="chevron-right" 
                            class="ml-auto w-3 h-3 opacity-0 -translate-x-2 transition-all duration-300 
                            {{ request()->routeIs('admin.statistics') ? 'opacity-40 translate-x-0' : 'group-hover:opacity-40 group-hover:translate-x-0' }}">
                            </i>
                    </a>
                    @endif
                </nav>

                <div class="p-6 border-t border-white/5">
                    <p class="text-[9px] text-gray-600 uppercase tracking-[0.3em] font-black mb-4 ml-2">Secure Session</p>
                    <div class="flex items-center gap-4 px-4 py-3 bg-white/[0.03] rounded-2xl border border-white/5">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-600 flex items-center justify-center font-bold text-white shadow-lg border border-white/10 text-xs">
                            {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-black text-white truncate">{{ Auth::user()->full_name }}</p>
                            <span class="text-[9px] bg-blue-500/10 text-blue-400 px-2 py-0.5 rounded border border-blue-500/20 font-bold uppercase tracking-widest">Resident</span>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="flex-grow ml-72 flex flex-col min-h-screen">
                
                <nav class="sticky top-0 z-40 bg-[#0c0c0e]/80 backdrop-blur-md border-b border-white/5 px-8 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-xs font-bold text-gray-500 uppercase tracking-[0.4em]">Resident Portal</h1>
                        </div>

                        <div class="flex items-center gap-6">
                            <div class="flex flex-col items-end">
                                <span class="text-sm font-bold text-white">{{ Auth::user()->full_name }}</span>
                                <span class="text-[9px] font-black uppercase tracking-widest text-emerald-500">
                                    {{ Auth::user()->role ?? 'User' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-2 border-l border-white/10 pl-6">
                                <a href="{{ route('profile.edit') }}" class="p-2.5 rounded-xl bg-white/5 text-gray-400 hover:text-white hover:bg-blue-600 transition-all border border-white/10 shadow-sm" title="Account Settings">
                                    <i data-lucide="user" class="w-5 h-5"></i>
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="p-2.5 rounded-xl bg-red-500/5 text-red-400 border border-red-500/10 hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Log Out">
                                        <i data-lucide="log-out" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>

                @isset($header)
                    <header class="py-10 px-8 sm:px-12">
                        <div class="max-w-5xl">
                            <div class="text-white">
                                {{ $header }}
                            </div>
                        </div>
                    </header>
                @endisset

                <main class="px-8 sm:px-12 pb-20">
                    <div class="max-w-5xl">
                        {{ $slot }}
                    </div>
                </main>

                <footer class="mt-auto py-10 px-12 border-t border-white/5">
                    <p class="text-[10px] uppercase tracking-[0.4em] text-gray-600 font-bold">
                        &copy; {{ date('Y') }} EasyColoc &mdash; Premium Household Management
                    </p>
                </footer>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                lucide.createIcons();
            });
            window.addEventListener('content-updated', () => lucide.createIcons());
        </script>
    </body>
</html>