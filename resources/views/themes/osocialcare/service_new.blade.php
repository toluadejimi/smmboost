@extends(template() . 'layouts.user')
@section('title', trans('Services'))

@section('content')
    <div id="services_app" class="min-h-screen bg-gray-900">
        <div class="px-2 py-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">SMM Services</h1>
                <p class="text-gray-400">Comprehensive social media marketing solutions</p>
            </div>

            <div class="mb-6">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                    <input type="text" name="search" v-model="searchQuery"
                        class="flex-1 px-4 py-2 rounded-lg bg-gray-800 text-white placeholder-gray-400 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        placeholder="Search service name...">
                    <button @click="searchByText"
                        class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-lg transition duration-200 whitespace-nowrap">
                        Search
                    </button>
                </div>
            </div>

            <div v-if="categories && categories.length > 0">
                <div v-for="(category, key) in categories" :key="category.id"
                    class="bg-gray-800 rounded-xl shadow-2xl mb-8 border border-gray-700 overflow-hidden">
                    <!-- Category Header -->
                    <div class="bg-gradient-to-r from-orange-600 to-orange-500 px-4 sm:px-6 py-4">
                        <h2 class="text-lg sm:text-xl font-bold text-white">
                            @{{ category.category_title }}
                        </h2>
                    </div>

                    <template v-for="service in category.service" :key="service.id">
                        <!-- Mobile Card Layout -->
                        <div class="block lg:hidden">
                            <div
                                class="border-b border-gray-700 last:border-b-0 p-4 hover:bg-gray-750 transition-colors duration-200">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex-1 pr-4">
                                        <h3 class="text-white font-medium text-sm leading-tight mb-1">
                                            @{{ service.service_title }}
                                        </h3>
                                        <span class="text-xs font-mono text-orange-300">
                                            #@{{ service.id }}
                                        </span>
                                    </div>
                                    <div class="text-right flex-shrink-0">
                                        <div class="text-green-400 font-semibold text-sm">
                                            <span v-if="service.priceSelectedCurrency">
                                                @{{ service.priceSelectedCurrency }}</span>
                                            <span v-else>@{{ service.price }}</span>
                                        </div>
                                        <div class="text-xs text-gray-400">per 1000</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3 mb-3 text-xs">
                                    <div>
                                        <span class="text-gray-400">Min:</span>
                                        <span class="text-white ml-1">@{{ service.min_amount }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-400">Max:</span>
                                        <span class="text-white ml-1">@{{ service.max_amount }}</span>
                                    </div>
                                    <div class="col-span-2">
                                        <span class="text-gray-400">Avg Time:</span>
                                        <span class="text-blue-400 ml-1">Varies</span>
                                    </div>
                                </div>


                                <div class="flex justify-end">
                                    <a href="#"
                                        class="inline-flex items-center px-3 py-1.5 bg-orange-600 hover:bg-orange-700 text-white text-xs font-medium rounded-lg transition-colors duration-200">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Desktop Table Layout -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-750 border-b border-gray-700">
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-orange-400 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-orange-400 uppercase tracking-wider">
                                        Service</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-orange-400 uppercase tracking-wider">
                                        Rate / 1000</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-orange-400 uppercase tracking-wider">
                                        Min</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-orange-400 uppercase tracking-wider">
                                        Max</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-orange-400 uppercase tracking-wider">
                                        Avg Time</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-semibold text-orange-400 uppercase tracking-wider">
                                        Description</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-semibold text-orange-400 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                <tr v-for="service in category.service" :key="service.id"
                                    class="hover:bg-gray-750 transition-colors duration-200">
                                    <td class="px-6 py-4 text-sm font-mono text-orange-300 font-medium">
                                        #@{{ service.id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-white font-medium">
                                        @{{ service.service_title }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-green-400 font-semibold">
                                        <span v-if="service.priceSelectedCurrency">
                                            @{{ service.priceSelectedCurrency }}</span>
                                        <span v-else>@{{ service.price }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-300">
                                        @{{ service.min_amount }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-300">
                                        @{{ service.max_amount }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-blue-400">
                                        Varies
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-400 max-w-xs">
                                        <div class="truncate" title="">

                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="#"
                                            class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            View
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div v-else class="bg-gray-800 rounded-xl shadow-2xl border border-gray-700 px-4 sm:px-8 py-16 text-center">
                <div class="text-gray-500 mb-4">
                    <svg class="w-12 sm:w-16 h-12 sm:h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold text-white mb-2">No Services Available</h3>
                <p class="text-gray-400">Services will appear here once they are configured.</p>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script src="{{ asset('assets/global/js/vue.global.prod.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/axios.min.js') }}"></script>
@endpush

@push('script')
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    categories: [],
                    pagination: [],
                    links: [],
                    socialMedia: @json($socialMedia),
                    isActive: 0,
                    categoriesSearch: [],
                    selectedCategory: '',
                    searchQuery: '',
                    showDropdown: false,
                    currencyDropdownOpen: false,
                    currencies: @json($currencies),
                    selectedCurrency: {
                        code: '{{ $currencyCookie->code ?? 'USD' }}',
                        symbol: '{{ $currencyCookie->symbol ?? "$" }}'
                    },
                };
            },
            mounted() {
                $('#category').on('change', (event) => {
                    this.selectedCategory = event.target.value;
                    this.searchCategory();
                });

                this.getServices();
                this.getCategory();

            },
            methods: {
                getCategory(social_media_id) {
                    let app = this;
                    let url = "{{ route('get.category') }}";
                    axios.get(url, {
                            params: {
                                social_media_id: social_media_id,
                            }
                        })
                        .then(function(res) {
                            app.categoriesSearch = res.data;
                        })
                },
                changeCurrency(currency) {
                    this.selectedCurrency = currency;
                    this.currencyDropdownOpen = false;

                    axios.post("{{ route('set.currency') }}", {
                            _token: '{{ csrf_token() }}',
                            currency: currency.code
                        })
                        .then(response => {
                            if (response.data.success) {
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error("Currency change failed:", error);
                        });
                },
                // toggleActive(id) {
                //     let socialMedia = this.socialMedia.find(media => media.id == id);
                //     this.isActive = socialMedia.id;
                //     this.getCategory(id);
                // },
                fetchData(params) {
                    let app = this;
                    let url = "{{ route('get.services') }}";
                    axios.get(url, {
                            params
                        })
                        .then(function(res) {
                            app.categories = res.data.data;
                            app.pagination = res.data;
                            app.links = res.data.links.slice(1, -1);
                        });
                },
                searchCategory() {
                    this.fetchData({
                        social_media_id: this.isActive,
                        category: this.selectedCategory,
                    });
                },
                selectCategory(id) {
                    this.selectedCategory = id;
                    this.showDropdown = false;
                    this.searchCategory(); // Triggers the filtered search
                },

                getCategoryName(id) {
                    console.log(id);
                    if (id === '') return 'All';
                    const cat = this.categoriesSearch.find(c => c.id == id);
                    return cat ? cat.category_title : '';
                },
                handleInput(event) {
                    this.fetchData({
                        social_media_id: this.isActive,
                        category: this.selectedCategory,
                        search: event.target.value,
                    });
                },
                searchByText() {
                    this.fetchData({
                        social_media_id: this.isActive,
                        category: this.selectedCategory,
                        search: this.searchQuery,
                    });
                },
                getServices(id) {
                    this.fetchData({
                        social_media_id: id,
                        currency: '{{ $currencyCookie->code ?? null }}',
                    });
                },
                updateItems(page) {
                    let app = this;
                    let url = '';
                    if (page == 'back') {
                        url = this.pagination.prev_page_url;

                    } else if (page == 'next') {
                        url = this.pagination.next_page_url;

                    } else {
                        url = page.url;
                    }
                    axios.get(url)
                        .then(function(res) {
                            app.categories = res.data.data;
                            app.pagination = res.data;
                            app.links = res.data.links;
                        })
                },
            },
        });
        app.mount('#services_app');
    </script>
@endpush
