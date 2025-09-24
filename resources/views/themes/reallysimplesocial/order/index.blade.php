@extends(template() . 'layouts.app')
@section('title', trans('All Order'))

@section('content')
    <div id="block_180">
        <div class="block-bg"></div>
        <div class="container-fluid">
            <div class="totals ">
                <div class="row align-items-start justify-content-start">
                    <div class="col-lg-6 col-sm-12 mb-2 mt-2">
                        <div class="card h-100"
                            style="
                              background: none;                                                                  color: inherit;                                                                  padding-top: 24px;                                  padding-bottom: 24px;                                                                                                  border-top-left-radius: 2px;                                  border-bottom-left-radius: 2px;                                  border-top-right-radius: 2px;                                  border-bottom-right-radius: 2px;                                  border-left-width: 0px;                                  border-right-width: 0px;                                  border-bottom-width: 0px;                                  border-top-width: 0px;                                  box-shadow: 0px 8px 32px 0px var(--color-id-198);                                  border-style: solid; ">
                            <div class="totals-block__card">
                                <div class="totals-block__card-left">
                                    <div class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                        style="
                                                                                                                                                                                                                                                                        ">
                                        <span class="totals-block__icon style-text-primary far fa-list-ul"
                                            style="
                                font-size: 38px;
                                transform: rotate(0deg);
                                color: ;
                                text-shadow: Array;
                                border-radius: 0px;
                                "></span>
                                    </div>
                                </div>
                                <div class="totals-block__card-right">
                                    <div class="totals-block__count">
                                        <h2 class="totals-block__count-value style-text-primary" style="">
                                            {{ auth()->user()->username }}
                                        </h2>
                                    </div>
                                    <div class="totals-block__card-name">
                                        <p>Welcome to your Dashboard!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2 mt-2">
                        <div class="card h-100"
                            style="
                              background: none;                                                                  color: inherit;                                                                  padding-top: 24px;                                  padding-bottom: 24px;                                                                                                  border-top-left-radius: 2px;                                  border-bottom-left-radius: 2px;                                  border-top-right-radius: 2px;                                  border-bottom-right-radius: 2px;                                  border-left-width: 0px;                                  border-right-width: 0px;                                  border-bottom-width: 0px;                                  border-top-width: 0px;                                  box-shadow: 0px 8px 32px 0px var(--color-id-198);                                  border-style: solid; ">
                            <div class="totals-block__card">
                                <div class="totals-block__card-left">
                                    <div class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                        style="
                                                                                                                                                                                                                                                                        ">
                                        <span class="totals-block__icon style-text-primary far fa-clipboard-list"
                                            style="
                                font-size: 38px;
                                transform: rotate(0deg);
                                color: ;
                                text-shadow: Array;
                                border-radius: 0px;
                                "></span>
                                    </div>
                                </div>
                                <div class="totals-block__card-right">
                                    <div class="totals-block__count">
                                        <h2 class="totals-block__count-value style-text-primary" style="">
                                            @if(optional(auth()->user())->currency && $currency)
                                                <span>{{ currencyPositionBySelectedCurrency($totalDeposits * $currency->conversion_rate, auth()->user()->currency) }}</span>
                                            @else
                                                <span>  {{ currencyPosition($totalDeposits) }}</span>
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="totals-block__card-name">
                                        <p>Spent balance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2 mt-2">
                        <div class="card h-100"
                            style="
                              background: none;                                                                  color: inherit;                                                                  padding-top: 24px;                                  padding-bottom: 24px;                                                                                                  border-top-left-radius: 2px;                                  border-bottom-left-radius: 2px;                                  border-top-right-radius: 2px;                                  border-bottom-right-radius: 2px;                                  border-left-width: 0px;                                  border-right-width: 0px;                                  border-bottom-width: 0px;                                  border-top-width: 0px;                                  box-shadow: 0px 8px 32px 0px var(--color-id-198);                                  border-style: solid; ">
                            <div class="totals-block__card">
                                <div class="totals-block__card-left">
                                    <div class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                        style="
                                                                                                                                                                                                                                                                        ">
                                        <span class="totals-block__icon style-text-primary far fa-clipboard-list-check"
                                            style="
                                font-size: 38px;
                                transform: rotate(0deg);
                                color: ;
                                text-shadow: Array;
                                border-radius: 0px;
                                "></span>
                                    </div>
                                </div>
                                <div class="totals-block__card-right">
                                    <div class="totals-block__count">
                                        <h2 class="totals-block__count-value style-text-primary" style="">
                                            @if (auth()->user()->currency)
                                                {{ currencyPositionBySelectedCurrency(optional(auth()->user())->balance * ($curr ? $curr->conversion_rate : 1), auth()->user()->currency) }}
                                            @else
                                                {{ currencyPosition(optional(auth()->user())->balance) }}
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="totals-block__card-name">
                                        <p>Account balance</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-2 mt-2">
                        <div class="card h-100"
                            style="
                              background: none;                                                                  color: inherit;                                                                  padding-top: 24px;                                  padding-bottom: 24px;                                                                                                  border-top-left-radius: 2px;                                  border-bottom-left-radius: 2px;                                  border-top-right-radius: 2px;                                  border-bottom-right-radius: 2px;                                  border-left-width: 0px;                                  border-right-width: 0px;                                  border-bottom-width: 0px;                                  border-top-width: 0px;                                  box-shadow: 0px 8px 32px 0px var(--color-id-198);                                  border-style: solid; ">
                            <div class="totals-block__card">
                                <div class="totals-block__card-left">
                                    <div class="totals-block__icon-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                        style="
                                                                                                                                                                                                                                                                        ">
                                        <span class="totals-block__icon style-text-primary far fa-users"
                                            style="
                                font-size: 38px;
                                transform: rotate(0deg);
                                color: ;
                                text-shadow: Array;
                                border-radius: 0px;
                                "></span>
                                    </div>
                                </div>
                                <div class="totals-block__card-right">
                                    <div class="totals-block__count">
                                        <h2 class="totals-block__count-value style-text-primary" style="">
                                            {{ $orders_count }}
                                        </h2>
                                    </div>
                                    <div class="totals-block__card-name">
                                        <p>Account orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="block_116">
        <div class="block-bg"></div>
        <div class="container-fluid">
            <div class="orders-history">
                {{-- STATUS TABS --}}
                @php
                    $lastSegment = collect(request()->segments())->last();
                @endphp

                <div class="row">
                    <div class="col">
                        <div class="orders-history__margin-tab">
                            <div class="component_status_tabs">
                                <ul class="nav nav-pills tab">
                                    @foreach (['orders' => 'All', 'awaiting' => 'Awaiting', 'pending' => 'Pending', 'processing' => 'Processing', 'progress' => 'In Progress', 'completed' => 'Completed', 'partial' => 'Partial', 'canceled' => 'Canceled', 'refunded' => 'Refunded'] as $slug => $label)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $lastSegment == $slug ? 'active' : '' }}"
                                                href="{{ route('user.order.index', $slug != 'orders' ? [$slug] : []) }}">
                                                @lang($label)
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEARCH FORM --}}
                <div class="row">
                    <div class="col-12">
                        <div class="orders-history__margin-search component_card">
                            <div class="card">
                                <div class="component_form_group component_button_search">
                                    <form action="{{ route('user.order.index') }}" method="get" id="history-search">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                value="{{ request('search') }}" placeholder="@lang('Search')">
                                            <div class="input-group-append">
                                                <button class="btn btn-big-secondary" type="submit">
                                                    <span class="fas fa-search"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TABLE --}}
                <div class="row">
                    <div class="col">
                        <div class="orders-history__margin-table">
                            <div class="table-bg component_table">
                                <div class="table-wr table-responsive">
                                    @if (count($orders) > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('ID')</th>
                                                    <th>@lang('Date')</th>
                                                    <th>@lang('Link')</th>
                                                    <th>@lang('Charge')</th>
                                                    <th class="nowrap">@lang('Start Count')</th>
                                                    <th>@lang('Quantity')</th>
                                                    <th>@lang('Service')</th>
                                                    <th>@lang('Status')</th>
                                                    <th>@lang('Remains')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>#{{ $order->id }}</td>
                                                        <td>{{ dateTime($order->created_at) }}</td>
                                                        <td>{{ Str::limit($order->link, 30) }}</td>
                                                        <td>
                                                            @if (auth()->user()->currency)
                                                                {{ currencyPositionBySelectedCurrency($order->price * $currency->conversion_rate, auth()->user()->currency) }}
                                                            @else
                                                                {{ currencyPosition($order->price) }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $order->start_counter ?? 'N/A' }}</td>
                                                        <td>{{ $order->quantity }}</td>
                                                        <td>{{ Str::limit(optional($order->service)->service_title, 30) }}
                                                        </td>
                                                        <td>
                                                            @php
                                                                $statusClass = match ($order->status) {
                                                                    'awaiting' => 'dark',
                                                                    'pending' => 'warning',
                                                                    'processing' => 'info',
                                                                    'progress' => 'primary',
                                                                    'completed' => 'success',
                                                                    'partial' => 'secondary',
                                                                    'canceled', 'refunded' => 'danger',
                                                                    default => 'light',
                                                                };
                                                            @endphp
                                                            <span class="badge bg-{{ $statusClass }}">
                                                                @lang(ucfirst($order->status))
                                                            </span>
                                                            @if (isset($order->refill_status) && !in_array($order->refill_status, ['completed', 'partial', 'canceled', 'refunded']))
                                                                <span class="badge bg-warning">@lang('Refilling')</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $order->remains ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-4">
                                            <img class="error-image mb-3" style="width: 300px;"
                                                src="{{ asset('assets/global/img/oc-error.svg') }}" alt="No Orders">
                                            <p>@lang('No orders available.')</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PAGINATION --}}
                <div class="row">
                    <div class="col-5">
                        <nav class="component_pagination">
                            {{ $orders->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
