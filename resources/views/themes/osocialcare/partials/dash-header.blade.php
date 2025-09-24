<!-- Default Header (when no is defined) -->
<header class="hidden lg:block bg-gray-800 shadow-lg border-b border-gray-700 flex-shrink-0">
    <div class="max-w-7xl mx-auto py-3 px-3 sm:px-4 lg:px-8">
        <div class="flex items-center justify-end">
            <!-- Desktop Wallet Info -->
            <div
                class="flex items-center bg-gradient-to-r from-orange-900/30 to-orange-800/30 px-4 sm:px-6 py-2 sm:py-3 rounded-xl border border-orange-700/50 backdrop-blur-sm">
                <div
                    class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-lg bg-orange-600/20 mr-3 sm:mr-4 flex-shrink-0">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                        </path>
                    </svg>
                </div>
                <div class="min-w-0 flex-1">
                    <div class="text-xs text-orange-400 font-medium">
                        Wallet Balance
                    </div>
                    <div class="text-lg sm:text-xl font-bold text-orange-300 whitespace-nowrap">
                        @if (optional(auth()->user())->currency && $currency)
                            {{ currencyPositionBySelectedCurrency($walletBalance * $currency->conversion_rate, auth()->user()->currency) }}
                        @else
                            {{ currencyPosition($walletBalance) }}
                        @endif
                    </div>
                </div>
                <a href="{{ route('user.add.fund') }}"
                    class="ml-3 sm:ml-4 px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-medium text-orange-400 border border-orange-600 rounded-lg hover:bg-orange-900/30 transition-all duration-200 hover:scale-105 flex-shrink-0 whitespace-nowrap">
                    Add Funds
                </a>
            </div>
        </div>
    </div>
</header>
