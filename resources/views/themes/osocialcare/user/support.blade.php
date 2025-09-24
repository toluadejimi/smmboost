@extends(template() . 'layouts.user')
@section('title', trans('Dashboard'))

@section('content')
    <div class="min-h-screen bg-gray-900 py-12 px-2 sm:px-2 lg:px-2">
        <div class=" mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-orange-900/30 rounded-full mb-3">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 11-9.75 9.75A9.75 9.75 0 0112 2.25z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-4">Need Help?</h1>
                <p class="text-base text-gray-300 max-w-2xl mx-auto">We're here to support you. Choose the best way to get
                    in touch with our team.</p>
            </div>

            <!-- Support Link Card -->
            <div
                class="mb-4 bg-gray-800 rounded-xl shadow-lg border border-gray-700 hover:shadow-xl hover:border-gray-600 transition-all duration-200 overflow-hidden group">
                <div class="p-4">
                    <div class="flex items-start space-x-4">
                        <!-- Support Type Icon -->
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-orange-900/40 rounded-lg flex items-center justify-center group-hover:bg-orange-900/60 transition-colors duration-200">
                                <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-base font-semibold text-white">contact us on whatsapp</h3>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-900/40 text-orange-300">
                                    Chat
                                </span>
                            </div>
                            <p class="text-sm text-gray-400 mb-4">
                                Get help through Whatsapp
                                - Start a live conversation with our support team
                            </p>
                            <a href="#" target="_blank"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-orange-300 bg-orange-900/30 border border-orange-700/50 rounded-lg hover:bg-orange-900/50 hover:text-orange-200 hover:border-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 transition-all duration-200">
                                <span>Get Support</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Support Link Card -->
            <div
                class="mb-4 bg-gray-800 rounded-xl shadow-lg border border-gray-700 hover:shadow-xl hover:border-gray-600 transition-all duration-200 overflow-hidden group">
                <div class="p-4">
                    <div class="flex items-start space-x-4">
                        <!-- Support Type Icon -->
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-orange-900/40 rounded-lg flex items-center justify-center group-hover:bg-orange-900/60 transition-colors duration-200">
                                <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-base font-semibold text-white">Follow and chat us on instagram</h3>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-900/40 text-orange-300">
                                    Email
                                </span>
                            </div>
                            <p class="text-sm text-gray-400 mb-4">
                                Get help through Instagram
                                - Send us a detailed message and we'll respond soon
                            </p>
                            <a href="#" target="_blank"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-orange-300 bg-orange-900/30 border border-orange-700/50 rounded-lg hover:bg-orange-900/50 hover:text-orange-200 hover:border-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400 transition-all duration-200">
                                <span>Get Support</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Help Section -->
            <div class="mt-8 bg-gradient-to-r from-gray-800 to-gray-700 border border-gray-600 rounded-xl p-6 text-center">
                <h3 class="text-base font-semibold text-white mb-3">Still Need Help?</h3>
                <p class="text-sm text-gray-300 mb-4 max-w-2xl mx-auto">
                    Can't find what you're looking for? Our support team is always ready to help you with any questions or
                    issues you might have.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
                    <span class="text-sm text-gray-400">Response time:</span>
                    <div class="flex items-center space-x-4 text-sm">
                        <span class="inline-flex items-center text-gray-300">
                            <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                            Chat: Usually within minutes
                        </span>
                        <span class="inline-flex items-center text-gray-300">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></div>
                            Email: Within 24 hours
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
