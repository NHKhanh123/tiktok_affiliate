<footer class="mt-20 border-t border-gray-200 bg-white">

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

        <div class="grid gap-10 md:grid-cols-4">

            {{-- Brand --}}
            <div class="md:col-span-2">

                <div class="flex items-center gap-2">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-black text-white font-bold">
                        TA
                    </div>

                    <span class="text-lg font-bold">
                        TikTok Affiliate
                    </span>

                </div>

                <p class="mt-4 max-w-md text-sm leading-6 text-gray-500">
                    Khám phá những sản phẩm nổi bật, sản phẩm đang được
                    quan tâm và các ưu đãi hấp dẫn trên TikTok Shop.
                </p>

            </div>


            {{-- Navigation --}}
            <div>

                <h3 class="text-sm font-semibold text-gray-900">
                    Khám phá
                </h3>

                <ul class="mt-4 space-y-3 text-sm text-gray-500">

                    <li>
                        <a href="{{ route('products.index') }}" class="hover:text-gray-900">
                            Tất cả sản phẩm
                        </a>
                    </li>

                    <li>
                        <a href="#featured" class="hover:text-gray-900">
                            Sản phẩm nổi bật
                        </a>
                    </li>

                    <li>
                        <a href="#categories" class="hover:text-gray-900">
                            Danh mục
                        </a>
                    </li>

                </ul>

            </div>


            {{-- Information --}}
            <div>

                <h3 class="text-sm font-semibold text-gray-900">
                    Thông tin
                </h3>

                <ul class="mt-4 space-y-3 text-sm text-gray-500">

                    <li>
                        <a href="#" class="hover:text-gray-900">
                            Giới thiệu
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-gray-900">
                            Chính sách bảo mật
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-gray-900">
                            Điều khoản sử dụng
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-gray-900">
                            Liên hệ
                        </a>
                    </li>

                </ul>

            </div>

        </div>


        {{-- Bottom --}}
        <div class="mt-10 border-t border-gray-100 pt-6">

            <p class="text-center text-xs text-gray-400">
                © {{ date('Y') }} TikTok Affiliate.
                All rights reserved.
            </p>

        </div>

    </div>

</footer>
