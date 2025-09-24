<!-- Bottom Navigation for Mobile -->
<nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-gray-800 border-t border-gray-700 shadow-2xl z-30">
    <div class="flex items-center justify-around h-16 px-2">
        <!-- Dashboard -->
        <a href="https://www.osocialcare.com/dashboard"
            class="bottom-nav-item flex flex-col items-center justify-center p-2 rounded-lg transition-all duration-200 active">
            <svg class="nav-icon w-5 h-5 mb-1 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
            </svg>
            <span class="nav-text text-xs font-medium text-orange-400">Home</span>
        </a>

        <!-- New Order -->
        <a href="https://www.osocialcare.com/smm/ui/order"
            class="bottom-nav-item flex flex-col items-center justify-center p-2 rounded-lg transition-all duration-200">
            <svg class="nav-icon w-5 h-5 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span class="nav-text text-xs font-medium text-gray-400">Order</span>
        </a>

        <!-- My Orders -->
        <a href="https://www.osocialcare.com/smm/ui/orders"
            class="bottom-nav-item flex flex-col items-center justify-center p-2 rounded-lg transition-all duration-200">
            <svg class="nav-icon w-5 h-5 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                </path>
            </svg>
            <span class="nav-text text-xs font-medium text-gray-400">My Orders</span>
        </a>

        <!-- Fund Wallet -->
        <a href="https://www.osocialcare.com/wallet/manual-fund"
            class="bottom-nav-item flex flex-col items-center justify-center p-2 rounded-lg transition-all duration-200">
            <svg class="nav-icon w-5 h-5 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8"></path>
            </svg>
            <span class="nav-text text-xs font-medium text-gray-400">Wallet</span>
        </a>

        <!-- More/Menu -->
        <button id="mobileMenuToggle"
            class="bottom-nav-item flex flex-col items-center justify-center p-2 rounded-lg transition-all duration-200">
            <svg class="nav-icon w-5 h-5 mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
            <span class="nav-text text-xs font-medium text-gray-400">More</span>
        </button>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div id="mobileMenuOverlay" class="lg:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden">
    <div class="fixed bottom-16 left-4 right-4 bg-gray-800 rounded-xl border border-gray-700 shadow-2xl p-4 space-y-2">
        <a href="https://www.osocialcare.com/smm/ui/services"
            class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
            <span class="text-gray-300 font-medium">Services</span>
        </a>
        <a href="https://www.osocialcare.com/wallet/transactions"
            class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M5 6h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"></path>
            </svg>
            <span class="text-gray-300 font-medium">Transactions</span>
        </a>
        <a href="https://www.osocialcare.com/support"
            class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition-colors">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18.364 5.636a9 9 0 11-12.728 0M12 9v2m0 4h.01"></path>
            </svg>
            <span class="text-gray-300 font-medium">Support</span>
        </a>
        <div class="border-t border-gray-700 pt-2">
            <form method="POST" action="https://www.osocialcare.com/logout">
                <input type="hidden" name="_token" value="6kR4dUu1cMqFTfySeknRLyq6i7eJFfHB7WTPqbIm"
                    autocomplete="off" />
                <button type="submit"
                    class="flex items-center w-full p-3 rounded-lg hover:bg-red-900/20 transition-colors text-left">
                    <svg class="w-5 h-5 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span class="text-red-400 font-medium">Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</div>
