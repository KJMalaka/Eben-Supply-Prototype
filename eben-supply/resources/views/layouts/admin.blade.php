<!DOCTYPE html>
{{-- PRT362S — Eben Supply | Group KN3 --}}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Dashboard') | Eben Supply</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F5F5] text-[#333333] min-h-screen flex antialiased">

    {{-- ── Sidebar ── --}}
    <aside class="w-64 bg-white border-r border-stone-100 flex flex-col min-h-screen fixed top-0 left-0 shadow-soft z-40">

        {{-- Logo --}}
        <div class="p-6 border-b border-stone-100">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-full overflow-hidden ring-2 ring-[#D4C7B0]">
                    <img src="{{ asset('images/products/logo.jpg') }}" alt="" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="font-heading font-black text-sm text-[#333333] tracking-wide uppercase">Eben Supply</p>
                    <p class="text-[10px] text-[#A3A380] font-heading uppercase tracking-widest">Admin Panel</p>
                </div>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-4 space-y-0.5 overflow-y-auto">
            <p class="text-[10px] font-heading font-bold text-stone-400 uppercase tracking-widest px-3 mb-2 mt-2">Overview</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.dashboard') ? 'bg-[#333333] text-white' : 'text-stone-500 hover:bg-[#F5F5F5] hover:text-[#333333]' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                Dashboard
            </a>

            <p class="text-[10px] font-heading font-bold text-stone-400 uppercase tracking-widest px-3 mb-2 mt-4">Catalogue</p>

            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.products.*') ? 'bg-[#333333] text-white' : 'text-stone-500 hover:bg-[#F5F5F5] hover:text-[#333333]' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                Products
            </a>
            <a href="{{ route('admin.inventory') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.inventory') ? 'bg-[#333333] text-white' : 'text-stone-500 hover:bg-[#F5F5F5] hover:text-[#333333]' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Inventory
            </a>

            <p class="text-[10px] font-heading font-bold text-stone-400 uppercase tracking-widest px-3 mb-2 mt-4">Orders</p>

            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs('admin.orders.*') ? 'bg-[#333333] text-white' : 'text-stone-500 hover:bg-[#F5F5F5] hover:text-[#333333]' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                All Orders
            </a>
        </nav>

        {{-- Footer links --}}
        <div class="p-4 border-t border-stone-100 space-y-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-stone-400 hover:text-[#333333] hover:bg-[#F5F5F5] transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                View Store
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-3 py-2 rounded-lg text-sm text-stone-400 hover:text-red-500 hover:bg-red-50 transition-colors font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.75"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ── Main ── --}}
    <div class="flex-1 ml-64 flex flex-col min-h-screen">
        {{-- Top bar --}}
        <header class="bg-white border-b border-stone-100 px-8 py-4 flex items-center justify-between sticky top-0 z-30 shadow-soft">
            <h1 class="font-heading font-bold text-base text-[#333333]">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center gap-3">
                <span class="text-sm text-stone-500 font-medium">{{ auth()->user()->name }}</span>
                <span class="badge bg-[#D4C7B0] text-[#333333]">Admin</span>
            </div>
        </header>

        {{-- Flash --}}
        @if(session('success'))
            <div class="bg-emerald-50 border-b border-emerald-200 text-emerald-700 px-8 py-3 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border-b border-red-200 text-red-600 px-8 py-3 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/></svg>
                {{ session('error') }}
            </div>
        @endif

        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>
