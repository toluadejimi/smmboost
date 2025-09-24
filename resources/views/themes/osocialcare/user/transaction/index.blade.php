@extends(template() . 'layouts.user')
@section('title', trans('Transaction History'))

@push('style')
    <style>
        .bg-gray-750 {
            background-color: #374151;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-white mb-1">Transaction History</h1>
                <p class="text-sm text-gray-400">Track your wallet activity and monitor your spending</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Current Balance -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg p-4 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-orange-100 text-xs font-medium">Current Balance</p>
                            <p class="text-lg font-bold mt-1">
                                @if (optional(auth()->user())->currency && $currency)
                                    {{ currencyPositionBySelectedCurrency($walletBalance * $currency->conversion_rate, auth()->user()->currency) }}
                                @else
                                    {{ currencyPosition($walletBalance) }}
                                @endif
                            </p>
                        </div>
                        <div class="bg-white/20 rounded-full p-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Credit -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-medium">Total Credit</p>
                            <p class="text-lg font-bold text-green-400 mt-1">
                                +
                                @if (auth()->user()->currency && $currency)
                                    {{ currencyPositionBySelectedCurrency($totalCredit * $currency->conversion_rate, auth()->user()->currency) }}
                                @else
                                    {{ currencyPosition($totalCredit) }}
                                @endif
                            </p>
                        </div>
                        <div class="bg-green-500/20 rounded-full p-2">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Debit -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-medium">Total Debit</p>
                            <p class="text-lg font-bold text-red-400 mt-1">
                                -
                                @if (auth()->user()->currency && $currency)
                                    {{ currencyPositionBySelectedCurrency($totalDebit * $currency->conversion_rate, auth()->user()->currency) }}
                                @else
                                    {{ currencyPosition($totalDebit) }}
                                @endif
                            </p>
                        </div>
                        <div class="bg-red-500/20 rounded-full p-2">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Transactions -->
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-medium">Total Transactions</p>
                            <p class="text-lg font-bold text-blue-400 mt-1">
                                {{ $totalTransactions }}
                            </p>
                        </div>
                        <div class="bg-blue-500/20 rounded-full p-2">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 mb-8">
                <form method="GET" action="{{ route('user.transaction.history') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Search</label>
                            <input type="text" name="search" value=""
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="Search transactions...">
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                            <select name="status"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <option value="">All Statuses</option>
                                <option value="pending">
                                    Pending
                                </option>
                            </select>
                        </div>

                        <!-- Type Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Type</label>
                            <select name="type"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <option value="">All Types</option>
                                <option value="credit">
                                    Credit
                                </option>
                            </select>
                        </div>

                        <!-- Quick Date Ranges -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Quick Filters</label>
                            <select name="date_range" onchange="setDateRange(this.value)"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                <option value="">Select Range</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="this_week">This Week</option>
                                <option value="last_week">Last Week</option>
                                <option value="this_month">This Month</option>
                                <option value="last_month">Last Month</option>
                                <option value="last_30_days">Last 30 Days</option>
                                <option value="last_90_days">Last 90 Days</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- Date From -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">From Date</label>
                            <input type="date" name="date_from" value=""
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>

                        <!-- Date To -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">To Date</label>
                            <input type="date" name="date_to" value=""
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>

                        <!-- Actions -->
                        <div class="flex items-end gap-2">
                            <button type="submit"
                                class="flex-1 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('user.transaction.history') }}"
                                class="flex-1 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                                Clear
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Transactions List -->
            {{-- <div class="space-y-3">
                <div
                    class="bg-gray-800 border border-gray-700 rounded-lg p-4 hover:bg-gray-750 transition-all duration-200 hover:border-gray-600">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                        <!-- Transaction Info -->
                        <div class="flex items-start gap-3">
                            <!-- Icon -->
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center bg-green-500/20">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-semibold text-white mb-1">
                                    Credit Transaction
                                </h3>
                                <p class="text-sm text-gray-300 mb-1">
                                    Manual funding submitted (Pending Review)
                                </p>
                                <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Sep 18, 2025 at 09:29 AM
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        ID: #628
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Amount and Status -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 lg:flex-col lg:items-end lg:gap-1">
                            <!-- Amount -->
                            <div class="text-right">
                                <span class="text-lg font-bold text-green-400">
                                    +₦2,000.00
                                </span>
                            </div>

                            <!-- Status -->
                            <div class="flex justify-end">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-yellow-400"></span>
                                    Pending
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gray-800 border border-gray-700 rounded-lg p-4 hover:bg-gray-750 transition-all duration-200 hover:border-gray-600">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                        <!-- Transaction Info -->
                        <div class="flex items-start gap-3">
                            <!-- Icon -->
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center bg-green-500/20">
                                    <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-semibold text-white mb-1">
                                    Credit Transaction
                                </h3>
                                <p class="text-sm text-gray-300 mb-1">
                                    Manual funding submitted (Pending Review)
                                </p>
                                <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Sep 16, 2025 at 01:25 PM
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        ID: #616
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Amount and Status -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 lg:flex-col lg:items-end lg:gap-1">
                            <!-- Amount -->
                            <div class="text-right">
                                <span class="text-lg font-bold text-green-400">
                                    +₦10,000.00
                                </span>
                            </div>

                            <!-- Status -->
                            <div class="flex justify-end">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        bg-yellow-500/20 text-yellow-400 border border-yellow-500/30">
                                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-yellow-400"></span>
                                    Pending
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Transactions List -->
            <div class="space-y-3">
                @forelse($transactions as $transaction)
                    <div
                        class="bg-gray-800 border border-gray-700 rounded-lg p-4 hover:bg-gray-750 transition-all duration-200 hover:border-gray-600">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                            <!-- Transaction Info -->
                            <div class="flex items-start gap-3">
                                <!-- Icon -->
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center
                            {{ $transaction->trx_type == '+' ? 'bg-green-500/20' : 'bg-red-500/20' }}">
                                        <svg class="w-4 h-4 {{ $transaction->trx_type == '+' ? 'text-green-400' : 'text-red-400' }}"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if ($transaction->trx_type == '+')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18 12H6" />
                                            @endif
                                        </svg>
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm font-semibold text-white mb-1">
                                        {{ $transaction->trx_type == '+' ? 'Credit Transaction' : 'Debit Transaction' }}
                                    </h3>
                                    <p class="text-sm text-gray-300 mb-1">
                                        {{ $transaction->remarks }}
                                    </p>
                                    <div class="flex flex-wrap items-center gap-3 text-xs text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ dateTime($transaction->created_at) }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            ID: #{{ $transaction->id }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Amount and Status -->
                            <div class="flex flex-col sm:flex-row sm:items-center gap-3 lg:flex-col lg:items-end lg:gap-1">
                                <!-- Amount -->
                                <div class="text-right">
                                    <span
                                        class="text-lg font-bold {{ $transaction->trx_type == '+' ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $transaction->trx_type == '+' ? '+' : '-' }}
                                        @if (auth()->user()->currency && $currency)
                                            {{ currencyPositionBySelectedCurrency($transaction->amount * $currency->conversion_rate, auth()->user()->currency) }}
                                        @else
                                            {{ currencyPosition($transaction->amount) }}
                                        @endif
                                    </span>
                                </div>

                                <!-- Status -->
                                @php
                                    $status = $transaction->status ?? 'unknown';

                                    $statusText = match ($status) {
                                        0 => 'Pending',
                                        1 => 'Success',
                                        2 => 'Requested',
                                        3 => 'Rejected',
                                        'awaiting' => 'Awaiting',
                                        'pending' => 'Pending',
                                        'processing' => 'Processing',
                                        'progress' => 'In Progress',
                                        'completed' => 'Completed',
                                        'partial' => 'Partial',
                                        'canceled' => 'Canceled',
                                        'refunded' => 'Refunded',
                                        default => 'Unknown',
                                    };

                                    $statusColor = match ($status) {
                                        0 => 'text-yellow-400',
                                        1 => 'text-green-400',
                                        2 => 'text-blue-400',
                                        3 => 'text-red-400',
                                        'awaiting' => 'text-gray-700',
                                        'pending' => 'text-yellow-500',
                                        'processing' => 'text-sky-500',
                                        'progress' => 'text-blue-600',
                                        'completed' => 'text-green-600',
                                        'partial' => 'text-purple-500',
                                        'canceled' => 'text-red-600',
                                        'refunded' => 'text-rose-500',
                                        default => 'text-gray-400',
                                    };
                                @endphp

                                <div class="flex justify-end">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-white/10 border border-white/10 {{ $statusColor }}">
                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-current"></span>
                                        {{ $statusText }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center text-gray-400">
                        No transactions found.
                    </div>
                @endforelse
            </div>


            <!-- Pagination -->
            <div class="mt-6">

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function setDateRange(range) {
            const dateRanges = {
                'today': ['2025-09-18', '2025-09-18'],
                'yesterday': ['2025-09-17', '2025-09-17'],
                'this_week': ['2025-09-15', '2025-09-21'],
                'last_week': ['2025-09-08', '2025-09-14'],
                'this_month': ['2025-09-01', '2025-09-30'],
                'last_month': ['2025-08-01', '2025-08-31'],
                'last_30_days': ['2025-08-19', '2025-09-18'],
                'last_90_days': ['2025-06-20', '2025-09-18']
            };

            if (dateRanges[range]) {
                document.querySelector('input[name="date_from"]').value = dateRanges[range][0];
                document.querySelector('input[name="date_to"]').value = dateRanges[range][1];
            }
        }
    </script>
@endpush
