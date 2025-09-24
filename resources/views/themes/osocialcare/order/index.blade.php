@extends(template() . 'layouts.user')
@section('title', trans('All Order'))

@push('style')
    <style>
        .bg-gray-750 {
            background-color: #374151;
        }

        .bg-gray-850 {
            background-color: #1f2937;
        }

        /* Custom scrollbar for dark theme */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #374151;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #6b7280;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }

        /* Pagination styling */
        .pagination {
            @apply flex items-center justify-between flex-wrap gap-2;
        }

        .pagination .page-link {
            @apply px-2 sm:px-3 py-1 sm:py-2 text-xs sm:text-sm text-gray-300 bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white transition-colors rounded;
        }

        .pagination .page-item.active .page-link {
            @apply bg-orange-600 text-white border-orange-600;
        }

        .pagination .page-item.disabled .page-link {
            @apply text-gray-500 bg-gray-800 cursor-not-allowed;
        }

        /* Mobile-specific adjustments */
        @media (max-width: 640px) {
            .pagination {
                @apply justify-center;
            }

            .pagination .page-link {
                @apply min-w-[32px] text-center;
            }
        }
    </style>
@endpush

@section('content')
    <div class="bg-gray-900 min-h-screen">
        <div class="w-full bg-gray-800 shadow-2xl">
            <!-- Header Section -->
            <div class="px-4 sm:px-6 py-2 sm:py-8 border-b border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white flex items-center gap-2 sm:gap-3">
                            <span class="text-orange-500 text-lg sm:text-xl lg:text-2xl">📦</span>
                            My SMM Orders
                        </h1>
                        <p class="text-gray-400 mt-1 sm:mt-2 text-sm sm:text-base">Manage and track your social media
                            marketing orders</p>
                    </div>
                    <div class="text-left sm:text-right">
                        <div class="text-xs sm:text-sm text-gray-400">Total Orders</div>
                        <div class="text-lg sm:text-xl lg:text-2xl font-bold text-orange-500">{{ $orders_count }}</div>
                    </div>
                </div>
            </div>
            <!-- Filter Section -->
            <div class="px-4 sm:px-6 py-4 sm:py-6 bg-gray-850 border-b border-gray-700">
                <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                    <div class="space-y-2">
                        <label class="text-xs sm:text-sm font-medium text-gray-300">From Date</label>
                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                            class="w-full p-2 sm:p-3 text-sm rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs sm:text-sm font-medium text-gray-300">To Date</label>
                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                            class="w-full p-2 sm:p-3 text-sm rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs sm:text-sm font-medium text-gray-300">Status</label>
                        <select name="status"
                            class="w-full p-2 sm:p-3 text-sm rounded-lg bg-gray-700 text-white border border-gray-600 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-all">
                            <option value="">All Statuses</option>
                            <option value="awaiting">Awaiting</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="partial">Partial</option>
                            <option value="canceled">Canceled</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="space-y-2 sm:col-span-2 lg:col-span-1">
                        <label class="text-xs sm:text-sm font-medium text-gray-300 hidden sm:block">&nbsp;</label>
                        <button type="submit"
                            class="w-full px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-medium text-sm rounded-lg transition-all duration-200 transform hover:scale-[1.02] focus:ring-2 focus:ring-orange-500/50">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z">
                                    </path>
                                </svg>
                                Filter Orders
                            </span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Orders Content -->
            @if (count($orders) > 0)
                <div class="px-4 sm:px-6 py-4 sm:py-6 bg-gray-850 border-b border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-white">
                            <thead>
                                <tr class="bg-gray-700 text-left text-gray-300">
                                    <th class="p-2">Order ID</th>
                                    <th class="p-2">Order Details</th>
                                    <th class="p-2">Price</th>
                                    <th class="p-2">Start Counter</th>
                                    <th class="p-2">Remains</th>
                                    <th class="p-2">Order At</th>
                                    <th class="p-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr class="border-b border-gray-700 hover:bg-gray-750">
                                        <td class="p-2">#{{ $order->id }}</td>
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
                                        <td class="p-2">@lang($order->start_counter ?? 'N/A')</td>
                                        <td class="p-2">@lang($order->remains ?? 'N/A')</td>
                                        <td class="p-2">{{ dateTime($order->created_at) }}</td>
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
            @else
                <div class="px-4 sm:px-6 py-4 sm:py-6">
                    <div class="text-center py-12 sm:py-16">
                        <div
                            class="w-16 h-16 sm:w-24 sm:h-24 mx-auto mb-4 sm:mb-6 rounded-full bg-gray-700 flex items-center justify-center">
                            <svg class="w-8 h-8 sm:w-12 sm:h-12 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-300 mb-2">No Orders Found</h3>
                        <p class="text-sm sm:text-base text-gray-500 mb-4 sm:mb-6 px-4">You haven't placed any orders yet or
                            no
                            orders match your filter criteria.</p>
                        <a href="{{ route('user.order.create') }}"
                            class="inline-flex items-center gap-2 px-4 sm:px-6 py-2 sm:py-3 bg-orange-600 hover:bg-orange-700 text-white font-medium text-sm rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Place Your First Order
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <div class="my-5 flex justify-end">
            <nav>
                <ul class="pagination">
                    {{ $orders->appends($_GET)->links(template().'partials.pagination') }}
                </ul>
            </nav>
        </div>
    </div>
@endsection
