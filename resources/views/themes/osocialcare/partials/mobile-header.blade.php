<!-- Mobile Header -->
<div class="lg:hidden bg-gray-800 shadow-lg border-b border-gray-700 flex-shrink-0">
    <div class="flex items-center justify-between h-12 sm:h-14 px-3 sm:px-4">
        <button id="openSidebar"
            class="p-1.5 rounded-lg text-gray-400 hover:text-white hover:bg-gray-700 transition-all flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <h1
            class="text-sm font-bold bg-gradient-to-r from-orange-400 to-orange-600 bg-clip-text text-transparent truncate flex-1 text-center">
            {{ basicControl()->site_title }}
        </h1>
        <!-- Mobile Wallet Info -->
        <div class="flex items-center bg-orange-900/20 px-2 py-1 rounded-lg border border-orange-800/50 flex-shrink-0">
            <svg class="w-2.5 h-2.5 mr-1 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <span class="font-medium text-orange-300 text-xs whitespace-nowrap">
                @if (optional(auth()->user())->currency && $currency)
                    {{ currencyPositionBySelectedCurrency($walletBalance * $currency->conversion_rate, auth()->user()->currency) }}
                @else
                    {{ currencyPosition($walletBalance) }}
                @endif
            </span>
        </div>
    </div>
</div>
