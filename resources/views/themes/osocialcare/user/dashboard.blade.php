@extends(template() . 'layouts.user')
@section('title', trans('Dashboard'))

@section('content')
    <div class="mx-auto px-2 py-2 space-y-4">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-white">
                Welcome back, {{ optional(auth()->user())->username }} 👋
            </h1>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
            <div class="bg-orange-900/40 border border-orange-700/50 rounded-lg p-5 text-white shadow-md">
                <div class="text-sm text-orange-300 mb-1">
                    Wallet Balance
                </div>
                <div class="text-2xl font-bold">
                    @if (optional(auth()->user())->currency && $currency)
                        {{ currencyPositionBySelectedCurrency($walletBalance * $currency->conversion_rate, auth()->user()->currency) }}
                    @else
                        {{ currencyPosition($walletBalance) }}
                    @endif
                </div>
            </div>

            <div class="bg-green-900/30 border border-green-600/40 rounded-lg p-5 text-white shadow-md">
                <div class="text-sm text-green-300 mb-1">
                    Total Funded
                </div>
                <div class="text-2xl font-bold">
                    @if (auth()->user()->currency && $currency)
                        {{ currencyPositionBySelectedCurrency($totalFunded * $currency->conversion_rate, auth()->user()->currency) }}
                    @else
                        {{ currencyPosition($totalFunded) }}
                    @endif
                </div>
            </div>

            <div class="bg-yellow-900/30 border border-yellow-600/40 rounded-lg p-5 text-white shadow-md">
                <div class="text-sm text-yellow-300 mb-1">
                    Pending Fundings
                </div>
                <div class="text-2xl font-bold">
                    @if (auth()->user()->currency && $currency)
                        {{ currencyPositionBySelectedCurrency($pendingFundings * $currency->conversion_rate, auth()->user()->currency) }}
                    @else
                        {{ currencyPosition($pendingFundings) }}
                    @endif
                </div>
            </div>

            <div class="bg-purple-900/30 border border-purple-600/40 rounded-lg p-5 text-white shadow-md">
                <div class="text-sm text-purple-300 mb-1">
                    Total Spent
                </div>
                <div class="text-2xl font-bold">
                    @if (auth()->user()->currency && $currency)
                        {{ currencyPositionBySelectedCurrency($totalSpent * $currency->conversion_rate, auth()->user()->currency) }}
                    @else
                        {{ currencyPosition($totalSpent) }}
                    @endif
                </div>
            </div>

            <div class="bg-blue-900/30 border border-blue-600/40 rounded-lg p-5 text-white shadow-md">
                <div class="text-sm text-blue-300 mb-1">
                    My Total Orders
                </div>
                <div class="text-2xl font-bold">{{ $orders['total'] }}</div>
            </div>

            <div class="bg-indigo-900/30 border border-indigo-600/40 rounded-lg p-5 text-white shadow-md">
                <div class="text-sm text-indigo-300 mb-1">
                    Total SMM Orders
                </div>
                <div class="text-2xl font-bold">
                    {{ $totalSmmOrders }}
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-emerald-900/30 border border-emerald-600/40 rounded-lg p-4 text-white shadow-md">
                <div class="text-xs text-emerald-300 mb-1">
                    My Completed Orders
                </div>
                <div class="text-xl font-bold">{{ number_format($orders['completed'] ?? 0) }}</div>
            </div>

            <div class="bg-amber-900/30 border border-amber-600/40 rounded-lg p-4 text-white shadow-md">
                <div class="text-xs text-amber-300 mb-1">
                    My Pending Orders
                </div>
                <div class="text-xl font-bold">{{ number_format($orders['processing'] ?? 0) }}</div>
            </div>

            <div class="bg-cyan-900/30 border border-cyan-600/40 rounded-lg p-4 text-white shadow-md">
                <div class="text-xs text-cyan-300 mb-1">
                    This Month Orders
                </div>
                <div class="text-xl font-bold">{{ number_format($thisMonthOrders ?? 0) }}</div>
            </div>

            <div class="bg-rose-900/30 border border-rose-600/40 rounded-lg p-4 text-white shadow-md">
                <div class="text-xs text-rose-300 mb-1">
                    Success Rate
                </div>
                <div class="text-xl font-bold">{{ number_format($successRate ?? 0) }}%</div>
            </div>
        </div>

        <!-- Wallet Transactions -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-white">
                    Recent Wallet Transactions
                </h3>
                <a href="{{ route('user.transaction.history') }}"
                    class="text-orange-400 hover:text-orange-300 text-sm">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-white">
                    <thead>
                        <tr class="bg-gray-700 text-left text-gray-300">
                            <th class="p-2">Date</th>
                            <th class="p-2">Amount</th>
                            <th class="p-2">Type</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr class="border-b border-gray-700 hover:bg-gray-750">
                                <td class="p-2">{{ dateTime($transaction->created_at) }}</td>
                                <td class="p-2 font-medium">
                                    <span class="text-{{ $transaction->trx_type == '+' ? 'green' : 'red' }}-400">
                                        {{ $transaction->trx_type == '+' ? '+' : '-' }}
                                        @if (auth()->user()->currency && $currency)
                                            {{ currencyPositionBySelectedCurrency($transaction->amount * $currency->conversion_rate, auth()->user()->currency) }}
                                        @else
                                            {{ currencyPosition($transaction->amount) }}
                                        @endif
                                    </span>
                                </td>
                                <td class="p-2 capitalize"><span
                                        class="px-2 py-1 rounded-full text-xs bg-gray-600">{{ $transaction->trx_type == '+' ? 'credit' : 'debit' }}</span>
                                </td>
                                <td class="p-2">
                                    @php
                                        $status = (int)$transaction->status;
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
                                    <span class="{{ $statusColor }} font-medium">{{ $statusText }}</span>
                                </td>
                                <td class="p-2">
                                    {{ $transaction->remarks }}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- My SMM Orders -->
        <div class="bg-gray-800 rounded-lg shadow-lg p-6 border border-gray-700">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-white">
                    Your Recent SMM Orders
                </h3>
                <a href="{{ route('user.order.index') }}" class="text-blue-400 hover:text-blue-300 text-sm">View
                    All
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-white">
                    <thead>
                        <tr class="bg-gray-700 text-left text-gray-300">
                            <th class="p-2">Date</th>
                            <th class="p-2">Service</th>
                            <th class="p-2">Amount</th>
                            <th class="p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_orders as $order)
                            <tr class="border-b border-gray-700 hover:bg-gray-750">
                                <td class="p-2">{{ dateTime($order->created_at) }}</td>
                                <td class="p-2 font-medium">
                                    <p>@lang(Str::limit(optional($order->service)->service_title, 30))</p>
                                    @lang('Link'): @lang(Str::limit($order->link, 30))<br>
                                    @lang('Quantity'): @lang($order->quantity) <br>
                                </td>
                                <td class="p-2 ">
                                    @if (auth()->user()->currency)
                                        <span>
                                            {{ currencyPositionBySelectedCurrency($order->price * $currency->conversion_rate, auth()->user()->currency) }}
                                        </span>
                                    @else
                                        <span>
                                            {{ currencyPosition($order->price) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2">
                                    @php
                                        $status = $order->status;

                                        $statusText = match ($status) {
                                            'awaiting' => __('Awaiting'),
                                            'pending' => __('Pending'),
                                            'processing' => __('Processing'),
                                            'progress' => __('In Progress'),
                                            'completed' => __('Completed'),
                                            'partial' => __('Partial'),
                                            'canceled' => __('Canceled'),
                                            'refunded' => __('Refunded'),
                                            default => __('Unknown'),
                                        };

                                        $statusColor = match ($status) {
                                            'awaiting' => 'bg-gray-700 text-white',
                                            'pending' => 'bg-yellow-500 text-black',
                                            'processing' => 'bg-sky-500 text-white',
                                            'progress' => 'bg-blue-600 text-white',
                                            'completed' => 'bg-green-600 text-white',
                                            'partial' => 'bg-purple-500 text-white',
                                            'canceled' => 'bg-red-600 text-white',
                                            'refunded' => 'bg-rose-500 text-white',
                                            default => 'bg-gray-400 text-white',
                                        };
                                    @endphp

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                        {{ $statusText }}
                                    </span>

                                    @if (isset($order->refill_status) && !in_array($order->refill_status, ['completed', 'partial', 'canceled', 'refunded']))
                                        <span
                                            class="ml-2 px-3 py-1 rounded-full text-xs font-semibold bg-orange-500 text-white">
                                            @lang('Refilling')
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-400">
                                    No recent orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
