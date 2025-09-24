@extends(template() . 'layouts.user')
@section('title', trans('New Order'))

@section('content')
    <div class="bg-gray-900 min-h-screen   ">
        <div class="mx-auto bg-gray-800  shadow-2xl p-4 sm:p-6">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 space-y-3 sm:space-y-0">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-gray-100 mb-1">Place New Order</h2>
                    <p class="text-xs text-gray-400">Choose a service and place your SMM order</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        New Order
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-4">
                <!-- Left Side: Form -->
                <div class="lg:col-span-2">
                    <!-- Wallet Balance Display -->

                    <!-- Display Success/Error Messages -->
                    <form action="{{ route('user.order.place') }}" method="POST" class="space-y-4" id="orderForm">
                        @csrf
                        <!-- Search Bar -->
                        <div>
                            <label class="block text-xs font-medium text-gray-300 mb-2">Search Services</label>
                            <div class="relative">
                                <input type="text" id="searchInput"
                                    class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 pl-10 text-xs transition-all duration-200"
                                    placeholder="Search for services...">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Category and Service Row -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <!-- Category -->
                            <div>
                                <label class="block text-xs font-medium text-gray-300 mb-2">Category</label>
                                <select name="category" id="category"
                                    class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 text-xs transition-all duration-200">

                                </select>
                            </div>

                            <!-- Service -->
                            <div>
                                <label class="block text-xs font-medium text-gray-300 mb-2">
                                    Service <span class="text-red-400">*</span>
                                </label>
                                <select name="service" id="service"
                                    class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 text-xs transition-all duration-200"
                                    required>
                                    <option value="">Loading services...</option>
                                </select>
                            </div>
                        </div>

                        <!-- Link -->
                        <div>
                            <label class="block text-xs font-medium text-gray-300 mb-2">
                                Link <span class="text-red-400">*</span>
                            </label>
                            <input type="url" name="link" value=""
                                class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 text-xs transition-all duration-200"
                                required placeholder="https://example.com/your-social-media-link">
                        </div>

                        <!-- Quantity and Time Row -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <!-- Quantity -->
                            <div>
                                <label class="block text-xs font-medium text-gray-300 mb-2">
                                    Quantity <span class="text-red-400">*</span>
                                </label>
                                <input type="number" name="quantity" id="quantity" value=""
                                    class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 text-xs transition-all duration-200"
                                    required min="1">
                                <p id="quantity-hint" class="text-xs text-gray-400 mt-1"></p>
                            </div>

                            <!-- Average time -->
                            <div>
                                <label class="block text-xs font-medium text-gray-300 mb-2">Average Time</label>
                                <input type="text" id="avg_time"
                                    class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none p-3 text-xs transition-all duration-200"
                                    value="—" readonly>
                            </div>
                        </div>

                        <!-- Charge -->
                        <div>
                            <label class="block text-xs font-medium text-gray-300 mb-2">Total Charge</label>
                            <div class="relative">
                                <input type="text" id="charge"
                                    class="w-full rounded-lg bg-gray-700 text-gray-100 border border-gray-600 outline-none p-3 text-sm font-bold text-orange-300"
                                    readonly placeholder="₦0.00">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden fields for optional parameters -->
                        <input type="hidden" name="runs" value="">
                        <input type="hidden" name="interval" value="">
                        <input type="hidden" name="comments" value="">
                        <input type="hidden" name="usernames" value="">
                        <input type="hidden" name="hashtags" value="">
                        <input type="hidden" name="username" value="">
                        <input type="hidden" name="answer_number" value="">
                        <input type="hidden" name="groups" value="">

                        <!-- Submit -->
                        <div>
                            <button type="submit" id="submitBtn"
                                class="w-full bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white font-bold py-3 px-4 rounded-lg disabled:bg-gray-600 disabled:cursor-not-allowed transition-all duration-200 text-sm shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Submit Order
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Side: Description -->
                <div class="bg-gray-700 p-4 rounded-xl shadow-lg border border-gray-600 lg:sticky lg:top-6 lg:self-start">
                    <h3 class="font-bold mb-3 text-gray-100 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-orange-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Service Information
                    </h3>
                    <div id="service-description" class="text-xs text-gray-300">
                        <div class="text-center py-6">
                            <div class="text-gray-500 mb-3">
                                <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="italic text-gray-500 text-sm">Select a service to view detailed information</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-lib')
    <script src="{{ asset('assets/global/js/vue.global.prod.min.js') }}"></script>
@endpush

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            let services = [];
            let allServices = [];

            try {
                const servicesResp = await fetch("{{ route('user.get.service') }}");
                if (!servicesResp.ok) throw new Error('Failed to fetch services');
                services = await servicesResp.json();
                allServices = [...services]; // Keep original copy for search
            } catch (error) {
                console.error('Error fetching services:', error);
                alert('❌ Failed to load services. Please refresh the page.');
                return;
            }

            // Group services by category
            const grouped = services.reduce((acc, item) => {
                (acc[item.category] = acc[item.category] || []).push(item);
                return acc;
            }, {});

            const categorySelect = document.getElementById('category');
            const serviceSelect = document.getElementById('service');
            const quantityInput = document.getElementById('quantity');
            const chargeInput = document.getElementById('charge');
            const avgTimeInput = document.getElementById('avg_time');
            const descBox = document.getElementById('service-description');
            const quantityHint = document.getElementById('quantity-hint');
            const submitBtn = document.getElementById('submitBtn');
            const searchInput = document.getElementById('searchInput');

            const userWallet = {{ $walletBalance }};

            // Populate category select
            function populateCategories() {
                categorySelect.innerHTML = '';
                Object.keys(grouped).sort().forEach(cat => {
                    const opt = document.createElement('option');
                    opt.value = cat;
                    opt.textContent = cat;
                    categorySelect.appendChild(opt);
                });
            }

            // Populate services based on search or category
            function populateServices(filteredServices, includeSelectOption = true) {
                if (includeSelectOption) {
                    serviceSelect.innerHTML = '<option value="">Select Service</option>';
                } else {
                    serviceSelect.innerHTML = '';
                }

                filteredServices.forEach(service => {
                    const opt = document.createElement('option');
                    opt.value = service.service;
                    const pricePerK = parseFloat(service.actual_price_per_k).toFixed(2);
                    opt.textContent = `${service.name} - ₦${pricePerK}/1k`;
                    opt.setAttribute('data-rate', service.rate);
                    opt.setAttribute('data-actual-price', service.actual_price_per_k);
                    opt.setAttribute('data-name', service.name);
                    opt.setAttribute('data-min', service.min);
                    opt.setAttribute('data-max', service.max);
                    opt.setAttribute('data-refill', service.refill);
                    opt.setAttribute('data-cancel', service.cancel);
                    opt.setAttribute('data-description', service.description ||
                        'No description available');
                    opt.setAttribute('data-type', service.type || 'Default');
                    opt.setAttribute('data-category', service.category);
                    serviceSelect.appendChild(opt);
                });
            }

            // Search functionality
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase().trim();

                if (searchTerm === '') {
                    // If search is empty, show services based on selected category
                    const selectedCat = categorySelect.value;
                    if (selectedCat && selectedCat !== 'search') {
                        populateServices(grouped[selectedCat] || []);
                    } else {
                        // Reset category to default state and select first category
                        populateCategories();
                        if (categorySelect.options.length > 0) {
                            categorySelect.selectedIndex = 0;
                            const firstCategory = categorySelect.value;
                            const matchedServices = grouped[firstCategory] || [];
                            populateServices(matchedServices);
                        }
                    }
                } else {
                    // Filter services based on search term
                    const filteredServices = allServices.filter(service =>
                        service.name.toLowerCase().includes(searchTerm) ||
                        service.category.toLowerCase().includes(searchTerm) ||
                        (service.description && service.description.toLowerCase().includes(
                            searchTerm))
                    );

                    // Don't include "Select Service" option when searching
                    populateServices(filteredServices, false);

                    // Update category select to show "Search Results"
                    if (filteredServices.length > 0) {
                        categorySelect.innerHTML =
                            '<option value="search" selected>Search Results</option>';
                    }
                }

                clearServiceInfo();
            });

            // Initialize
            populateCategories();
            // Select the first category by default
            if (categorySelect.options.length > 0) {
                categorySelect.selectedIndex = 0;
                const firstCategory = categorySelect.value;
                const matchedServices = grouped[firstCategory] || [];
                populateServices(matchedServices);
            } else {
                serviceSelect.innerHTML = '<option value="">No categories available</option>';
            }

            // Handle category selection
            categorySelect.addEventListener('change', () => {
                const selectedCat = categorySelect.value;

                if (selectedCat === 'search') {
                    // Don't change services if this is search results
                    return;
                }

                // Clear search when category is selected
                searchInput.value = '';

                const matchedServices = grouped[selectedCat] || [];
                populateServices(matchedServices);
                clearServiceInfo();
            });

            // Handle service selection
            serviceSelect.addEventListener('change', () => {
                const selected = serviceSelect.selectedOptions[0];
                if (!selected || !selected.value) return clearServiceInfo();

                const rate = parseFloat(selected.dataset.rate);
                const actualPricePerK = parseFloat(selected.dataset.actualPrice);
                const min = parseInt(selected.dataset.min);
                const max = parseInt(selected.dataset.max);
                const name = selected.dataset.name;
                const refill = selected.dataset.refill === 'true' ? 'Yes' : 'No';
                const cancel = selected.dataset.cancel === 'true' ? 'Yes' : 'No';
                const description = selected.dataset.description;
                const type = selected.dataset.type;
                const category = selected.dataset.category;

                // If we're in search results, update category to show the actual category
                if (categorySelect.value === 'search') {
                    populateCategories();
                    categorySelect.value = category;
                }

                const pricePerK = actualPricePerK.toFixed(2);

                descBox.innerHTML = `
            <div class="space-y-3">
                <div>
                    <h4 class="font-bold text-gray-100 mb-1 text-sm">📌 ${name}</h4>
                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium">${category} • ${type}</p>
                </div>
                <div class="bg-gray-800 rounded-lg p-3 border border-gray-600">
                    <h5 class="font-semibold text-gray-200 mb-1 text-xs">📝 Description</h5>
                    <p class="text-xs text-gray-300 leading-relaxed">${description}</p>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="bg-orange-900/30 rounded-lg p-2 border border-orange-700">
                        <span class="text-orange-400 font-semibold text-xs block mb-1">💰 Rate</span>
                        <span class="text-orange-300 text-xs font-medium">₦${pricePerK}/1k</span>
                    </div>
                    <div class="bg-blue-900/30 rounded-lg p-2 border border-blue-700">
                        <span class="text-blue-400 font-semibold text-xs block mb-1">📊 Range</span>
                        <span class="text-blue-300 text-xs font-medium">${min.toLocaleString()} - ${max.toLocaleString()}</span>
                    </div>
                    <div class="bg-purple-900/30 rounded-lg p-2 border border-purple-700">
                        <span class="text-purple-400 font-semibold text-xs block mb-1">🔁 Refill</span>
                        <span class="text-purple-300 text-xs font-medium">${refill}</span>
                    </div>
                    <div class="bg-amber-900/30 rounded-lg p-2 border border-amber-700">
                        <span class="text-amber-400 font-semibold text-xs block mb-1">❌ Cancel</span>
                        <span class="text-amber-300 text-xs font-medium">${cancel}</span>
                    </div>
                </div>
            </div>`;

                avgTimeInput.value = "Approx. 1 hour";
                quantityHint.textContent = `Min: ${min.toLocaleString()}, Max: ${max.toLocaleString()}`;
                quantityInput.min = min;
                quantityInput.max = max;
                updateCharge(actualPricePerK);
            });

            quantityInput.addEventListener('input', () => {
                const selected = serviceSelect.selectedOptions[0];
                if (selected) {
                    const actualPricePerK = parseFloat(selected.dataset.actualPrice);
                    updateCharge(actualPricePerK);
                }
            });

            function updateCharge(pricePerK) {
                const qty = parseFloat(quantityInput.value);
                if (!isNaN(pricePerK) && !isNaN(qty)) {
                    // Calculate total charge: (price per 1k) * (quantity / 1000)
                    const charge = (pricePerK * qty / 1000);
                    chargeInput.value = `₦${charge.toFixed(2)}`;

                    if (charge > userWallet) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                    Insufficient Balance
                `;
                        submitBtn.classList.add('bg-red-600', 'hover:bg-red-700', 'from-red-600', 'to-red-500');
                        submitBtn.classList.remove('bg-orange-600', 'hover:bg-orange-700', 'from-orange-600',
                            'to-orange-500');
                    } else {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = `
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Submit Order
                `;
                        submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700', 'from-red-600',
                            'to-red-500');
                        submitBtn.classList.add('bg-orange-600', 'hover:bg-orange-700', 'from-orange-600',
                            'to-orange-500');
                    }
                } else {
                    chargeInput.value = '';
                    submitBtn.disabled = true;
                }
            }

            function clearServiceInfo() {
                descBox.innerHTML = `
            <div class="text-center py-6">
                <div class="text-gray-500 mb-3">
                    <svg class="w-12 h-12 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <p class="italic text-gray-500 text-sm">Select a service to view detailed information</p>
            </div>`;
                avgTimeInput.value = '—';
                chargeInput.value = '';
                quantityHint.textContent = '';
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Submit Order
        `;
                submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700', 'from-red-600', 'to-red-500');
                submitBtn.classList.add('bg-orange-600', 'hover:bg-orange-700', 'from-orange-600',
                    'to-orange-500');
            }

            // Handle form submission to prevent multiple clicks
            const orderForm = document.getElementById('orderForm');
            orderForm.addEventListener('submit', function(e) {
                // Check if form is valid before proceeding
                if (!orderForm.checkValidity()) {
                    return; // Let the browser handle validation
                }

                // Disable submit button and change text
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing Order...
        `;
                submitBtn.classList.remove('bg-orange-600', 'hover:bg-orange-700', 'bg-red-600',
                    'hover:bg-red-700', 'from-orange-600', 'to-orange-500');
                submitBtn.classList.add('bg-gray-600', 'cursor-not-allowed');

                // Re-enable after 10 seconds as fallback (in case of network issues)
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = `
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Submit Order
                `;
                        submitBtn.classList.remove('bg-gray-600', 'cursor-not-allowed');
                        submitBtn.classList.add('bg-orange-600', 'hover:bg-orange-700',
                            'from-orange-600', 'to-orange-500');
                    }
                }, 10000);
            });

            // Prevent zoom on input focus (iOS Safari)
            const inputs = document.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.style.fontSize = '16px';
                });
                input.addEventListener('blur', () => {
                    input.style.fontSize = '';
                });
            });
        });
    </script>
@endpush
