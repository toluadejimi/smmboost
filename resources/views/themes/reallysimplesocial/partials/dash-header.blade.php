<div id="block_118" class="component_private_navbar">
    <span class="component_private_navbar ">
        <div
            class="component-navbar-private__wrapper component_private_sidebar component-navbar-private__wrapper-sticky">
            <div
                class="sidebar-block__top component-navbar component-navbar__navbar-private editor__component-wrapper sidebar-block__sticky">
                <div>
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="navbar-private__header">
                            <div class="sidebar-block__top-brand">
                                <div class="component-navbar-brand component-navbar-public-brand">
                                    <p class="text-left">
                                        <span style="text-align: LEFT">
                                            <span style="text-transform: uppercase">
                                                <span style="letter-spacing: 1.0px">
                                                    <span style="font-size: 24px">
                                                        <strong style="font-weight: bold">&nbsp;</strong>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                        <a target="_self" href="{{ route('home') }}">
                                            <span style="text-align: LEFT">
                                                <span style="text-transform: uppercase">
                                                    <span style="letter-spacing: 1.0px">
                                                        <span style="font-size: 24px">
                                                            <strong style="font-weight: bold">R</strong>
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                        <span style="text-align: LEFT">
                                            <span style="text-transform: uppercase">
                                                <span style="letter-spacing: 1.0px">
                                                    <span style="font-size: 24px">
                                                        <strong style="font-weight: bold">SS</strong>
                                                    </span>
                                                </span>
                                            </span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbar-collapse-118" aria-controls="navbar-collapse-118"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-burger">
                                    <span class="navbar-burger-line"></span>
                                </span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="navbar-collapse-118">
                            <div class="component-navbar-collapse-divider"></div>
                            <div class="d-flex component-navbar-collapse">
                                <ul class="navbar-nav navbar-nav-sidebar-menu">
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private component-navbar-nav-link-active__navbar-private"
                                            href="{{ route('home') }}">New order
                                        </a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "
                                            href="{{ route('services') }}">Services
                                        </a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "
                                            href="/orders">Orders
                                        </a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "
                                            href="/addfunds">Add funds
                                        </a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "
                                            href="/api">API
                                        </a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "
                                            href="/affiliates">Affiliates
                                        </a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "
                                            href="/child-panel">Child panel
                                        </a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "
                                            href="/tickets">Tickets
                                        </a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private "
                                            href="/massorder">Mass order
                                        </a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav navbar-nav-currencies">
                                    <div class="balance-dropdown-container component_balance_dropdown">
                                        <div id="currencyApp">
                                            <div class="balance-dropdown" @mouseenter="showDropdown = true"
                                                @mouseleave="showDropdown = false" :class="{ 'show': showDropdown }">
                                                @if (optional(auth()->user())->currency && $currency)
                                                    <div class="balance-dropdown__name balance-dropdown__toggle"
                                                        data-toggle="dropdown" data-hover="dropdown"
                                                        aria-expanded="false">
                                                        {{ currencyPositionBySelectedCurrency($walletBalance * $currency->conversion_rate, auth()->user()->currency) }}
                                                    </div>
                                                @else
                                                    <div class="balance-dropdown__name balance-dropdown__toggle"
                                                        data-toggle="dropdown" data-hover="dropdown"
                                                        aria-expanded="false">
                                                        {{ currencyPosition($walletBalance) }}
                                                    </div>
                                                @endif
                                                <ul class="balance-dropdown__container dropdown-menu"
                                                    id="currencies-list" :class="{ 'show': showDropdown }">
                                                    <li class="balance-dropdown__item" v-for="currency in currencies"
                                                        :key="currency.code">
                                                        <a href="#" class="balance-dropdown__link"
                                                            @click.prevent="selectCurrency(currency.code)">
                                                            @{{ currency.symbol }} @{{ currency.code }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private"
                                            href="{{ route("user.profile") }}">Account</a>
                                    </li>
                                    <li class="nav-item component-navbar-nav-item component-navbar-private-nav-item">
                                        <a class="component-navbar-nav-link  component-navbar-nav-link__navbar-private"
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </span>
    <span class="component_private_sidebar ">
        <div class="component-sidebar_wrapper">
            <div
                class="sidebar-block__left component-sidebar component-sidebar-with-navbar component_private_navbar editor__component-wrapper">
                <div class="component-sidebar__menu">
                    <div class="component-sidebar__menu-logo">
                        <div class="component-navbar-brand component-sidebar__menu-brand">
                            <p class="text-left">
                                <a target="_self" href="/">
                                    <span style="text-align: LEFT">
                                        <span style="text-transform: uppercase">
                                            <span style="letter-spacing: 1.0px">
                                                <span style="font-size: 24px">
                                                    <strong style="font-weight: bold">RSS</strong>
                                                </span>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <ul class="sidebar-block__left-menu editor__component-wrapper">
                        <li class="component-sidebar__menu-item component-sidebar__menu-item-active">
                            <a class="component-sidebar__menu-item-link" href="{{ route('home') }}">New order
                            </a>
                        </li>
                        <li class="component-sidebar__menu-item ">
                            <a class="component-sidebar__menu-item-link" href="{{ route('services') }}">Services
                            </a>
                        </li>
                        <li class="component-sidebar__menu-item ">
                            <a class="component-sidebar__menu-item-link" href="{{ route('user.order.index') }}">Orders
                            </a>
                        </li>
                        <li class="component-sidebar__menu-item ">
                            <a class="component-sidebar__menu-item-link" href="{{ route('user.add.fund') }}">Add funds
                            </a>
                        </li>
                        <li class="component-sidebar__menu-item ">
                            <a class="component-sidebar__menu-item-link" href="{{ route('user.api.docs') }}">API
                            </a>
                        </li>
                        {{-- <li class="component-sidebar__menu-item ">
                            <a class="component-sidebar__menu-item-link" href="/affiliates">Affiliates
                            </a>
                        </li> --}}
                        {{-- <li class="component-sidebar__menu-item ">
                            <a class="component-sidebar__menu-item-link" href="/child-panel">Child panel
                            </a>
                        </li> --}}
                        {{-- <li class="component-sidebar__menu-item ">
                            <a class="component-sidebar__menu-item-link" href="/tickets">Tickets
                            </a>
                        </li> --}}
                        <li class="component-sidebar__menu-item ">
                            <a class="component-sidebar__menu-item-link" href="{{ route('user.mass.order') }}">Mass order
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </span>
</div>

@push('script')
    <script src="{{ asset('assets/global/js/vue.global.prod.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/axios.min.js') }}"></script>
@endpush

@push('script')
    <script>
        'use strict';
        const currencyApp = Vue.createApp({
            data() {
                return {
                    currencies: @json($currencies), // Available currencies from Laravel
                    selectedCurrency: '{{ auth()->user()->currency ?? 'USD' }}', // Default currency
                    showDropdown: false, // State to manage the dropdown visibility
                };
            },
            methods: {
                // Trigger currency change in backend
                selectCurrency(currencyCode) {
                    let route = "{{ route('user.selected.currency') }}";

                    // Send request to backend to change currency
                    axios.get(route, {
                            params: {
                                currency: currencyCode
                            }
                        })
                        .then(function(res) {
                            // After updating, reload the page
                            window.location.reload();
                        })
                        .catch(function(error) {
                            console.error("Currency change failed:", error);
                        });

                    // Close the dropdown after selecting a currency
                    this.showDropdown = false;
                }
            },
        });

        currencyApp.mount('#currencyApp');
    </script>
@endpush
