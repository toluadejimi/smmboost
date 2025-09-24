<!-- Sidebar -->
<div id="sidebar"
    class="sidebar-container absolute lg:static top-0 left-0 bg-gray-800 shadow-2xl z-50 transform transition-transform duration-300 ease-in-out
            -translate-x-full lg:translate-x-0 overflow-y-auto">

    <div class="flex flex-col h-full">
        <!-- Logo/Brand -->
        <div class="flex items-center justify-between h-12 sm:h-14 px-3 sm:px-4 border-b border-gray-700 bg-gray-850">
            <a href="{{ route('user.dashboard') }}"
                class="text-sm sm:text-base font-bold bg-gradient-to-r from-orange-400 to-orange-600 bg-clip-text text-transparent truncate">
                {{ basicControl()->site_title }}
            </a>
            <!-- Mobile close button -->
            <button id="closeSidebar"
                class="lg:hidden p-1.5 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 transition-all flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-2 sm:px-3 py-3 space-y-1 overflow-y-auto">
            <a href="{{ route('user.dashboard') }}"
                class="{{ request()->routeIs('user.dashboard') ? 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-lg' : 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 sm:mr-4 text-white flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                </svg>
                <span class="truncate">Dashboard</span>
            </a>

            <a href="{{ route('user.order.create') }}"
                class="{{ request()->routeIs('user.order.create') ? 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-lg' : 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 sm:mr-4 text-gray-400 group-hover:text-gray-300 flex-shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="truncate">New Order</span>
            </a>

            <a href="{{ route('user.order.index') }}"
                class="{{ request()->routeIs('user.order.index') ? 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-lg' : 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 sm:mr-4 text-gray-400 group-hover:text-gray-300 flex-shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
                <span class="truncate">My Orders</span>
            </a>
            <a href="{{ route('user.add.fund') }}"
                class="{{ request()->routeIs('user.add.fund') ? 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-lg' : 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 sm:mr-4 text-gray-400 group-hover:text-gray-300 flex-shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8"></path>
                </svg>
                <span class="truncate">Fund Wallet</span>
            </a>

            <a href="{{ url('services') }}"
                class="group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-300 hover:bg-gray-700 hover:text-white">
                <svg class="w-5 h-5 mr-3 sm:mr-4 text-gray-400 group-hover:text-gray-300 flex-shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
                <span class="truncate">Services</span>
            </a>

            <a href="{{ route('user.transaction.history') }}"
                class="{{ request()->routeIs('user.transaction.history') ? 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-lg' : 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 sm:mr-4 text-gray-400 group-hover:text-gray-300 flex-shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M5 6h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"></path>
                </svg>
                <span class="truncate">Transactions</span>
            </a>

            <a href="{{ route('user.support') }}"
                class="{{ request()->routeIs('user.support') ? 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-lg' : 'group flex items-center px-3 sm:px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 sm:mr-4 text-gray-400 group-hover:text-gray-300 flex-shrink-0" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 5.636a9 9 0 11-12.728 0M12 9v2m0 4h.01"></path>
                </svg>
                <span class="truncate">Support</span>
            </a>

        </nav>


        <!-- User Info & Settings -->
        <div class="px-2 sm:px-3 py-2 sm:py-3 border-t border-gray-700 bg-gray-850">
            <!-- Theme Toggle -->
            <div class="mb-2 sm:mb-3">
                <button id="themeToggle"
                    class="flex items-center justify-between w-full px-2 sm:px-3 py-1.5 sm:py-2 text-xs font-medium text-gray-300 hover:bg-gray-700 rounded-lg transition-all duration-200 group">
                    <div class="flex items-center min-w-0 flex-1">
                        <div
                            class="w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center rounded-md bg-gray-700 group-hover:bg-gray-600 mr-2 flex-shrink-0">
                            <svg id="lightIcon" class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-yellow-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" style="display: block;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                                </path>
                            </svg>
                            <svg id="darkIcon" class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-purple-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                                </path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-xs font-medium text-gray-200 group-hover:text-white truncate">
                                <span id="themeTextLight" style="display: none;">Dark Mode</span>
                                <span id="themeTextDark" style="display: block;">Light Mode</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative flex-shrink-0">
                        <div class="w-7 h-3.5 sm:w-8 sm:h-4 bg-gray-600 rounded-full transition-colors duration-200">
                        </div>
                        <div id="toggleDot"
                            class="absolute top-0.5 left-0.5 w-2.5 h-2.5 sm:w-3 sm:h-3 bg-orange-400 rounded-full shadow-lg transform transition-all duration-200"
                            style="transform: translateX(14px);"></div>
                    </div>
                </button>
            </div>

            <!-- Currency Display -->
            <div
                class="flex items-center px-2 sm:px-3 py-1.5 sm:py-2 mb-2 sm:mb-3 text-xs bg-gray-700/50 rounded-lg border border-gray-600">
                <div
                    class="w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center rounded-md bg-green-600/20 mr-2 flex-shrink-0">
                    <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                        </path>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-xs font-medium text-gray-200 truncate">Nigerian Naira</div>
                    <div class="text-xs text-gray-400">₦ NGN</div>
                </div>
            </div>

            <!-- User Info -->
            <div class="px-2 sm:px-3 py-1.5 sm:py-2 mb-2 sm:mb-3 bg-gray-700/30 rounded-lg border border-gray-600">
                <div class="flex items-center mb-2">
                    <div
                        class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gradient-to-r from-orange-400 to-orange-600 flex items-center justify-center text-white font-bold text-xs mr-2 flex-shrink-0">
                        {{ strtoupper(substr(optional(auth()->user())->firstname, 0, 1) . substr(optional(auth()->user())->lastname, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs font-medium text-gray-100 truncate">
                            {{ optional(auth()->user())->firstname }}
                        </div>
                        @php
                            $email = optional(auth()->user())->email;
                            $obfuscatedEmail = '';

                            if ($email) {
                                $parts = explode('@', $email);
                                $username = $parts[0];
                                $domain = $parts[1] ?? '';
                                $obfuscatedEmail = $username . '@' . substr($domain, 0, 5) . '...';
                            }
                        @endphp
                        <div class="text-xs text-gray-400 truncate">
                            {{ $obfuscatedEmail }}
                        </div>
                    </div>
                </div>

                <!-- Wallet Balance in Sidebar -->
                <div
                    class="flex items-center justify-between p-1.5 sm:p-2 bg-orange-900/20 rounded-md border border-orange-800/50">
                    <div class="flex items-center flex-1 min-w-0">
                        <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3 mr-1 text-orange-400 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                            </path>
                        </svg>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs text-orange-400 font-medium">Balance</div>
                            <div class="text-xs font-bold text-orange-300 truncate">
                                @if (optional(auth()->user())->currency && $currency)
                                    {{ currencyPositionBySelectedCurrency($walletBalance * $currency->conversion_rate, auth()->user()->currency) }}
                                @else
                                    {{ currencyPosition($walletBalance) }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('user.add.fund') }}"
                        class="px-2 py-1 text-xs font-medium text-orange-400 border border-orange-600 rounded hover:bg-orange-900/30 transition-colors duration-200 flex-shrink-0">
                        Add
                    </a>
                </div>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center px-2 sm:px-3 py-1.5 sm:py-2 text-xs font-medium text-red-400 hover:bg-red-900/20 hover:text-red-300 rounded-lg transition-all duration-200 group">
                    <div
                        class="w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center rounded-md bg-red-900/20 group-hover:bg-red-900/30 mr-2 flex-shrink-0">
                        <svg class="w-2.5 h-2.5 sm:w-3 sm:h-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </div>
                    <span class="truncate">Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</div>
