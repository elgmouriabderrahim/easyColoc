<x-app-layout>
    <div class="min-h-screen bg-[#0f1012] text-white p-6 sm:p-12 selection:bg-blue-500/30">
        
        <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_15%_15%,rgba(59,130,246,0.2)_0%,transparent_50%)]"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto space-y-12">
            
            <div class="p-10 bg-[#16171a] border border-white/5 rounded-xl shadow-2xl">
                 @include('profile.partials.update-profile-information-form')
            </div>

            <div class="p-10 bg-[#16171a] border border-white/5 rounded-xl shadow-2xl">
                 @include('profile.partials.update-password-form')
            </div>

            <div class="p-10 bg-[#16171a] border border-red-500/10 rounded-xl shadow-2xl">
                 @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        function initIcons() {
            lucide.createIcons();
        }
        window.addEventListener('load', initIcons);
    </script>
</x-app-layout>