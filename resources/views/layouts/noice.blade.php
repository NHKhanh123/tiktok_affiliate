        @if (session('error'))
            <div class="border-b border-gray-200 bg-gray-50">
                <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                    <div class="flex items-start gap-3 rounded-2xl border border-gray-200 bg-white px-4 py-3 shadow-sm">

                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-100">
                            <span class="text-sm">ℹ️</span>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-900">
                                Thông báo
                            </p>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ session('error') }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        @endif