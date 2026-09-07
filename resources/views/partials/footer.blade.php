    <footer class="border-t border-gray-200 bg-gray-950 text-gray-300">

        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">

            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">


                {{-- ABOUT --}}
                <div>

                    <a href="{{ route('home') }}" class="text-xl font-black text-white">
                        TikTok Affiliate
                    </a>

                    <p class="mt-4 max-w-sm text-sm leading-7 text-gray-400">
                        Khám phá những sản phẩm được chọn lọc và tìm
                        kiếm sản phẩm phù hợp trên TikTok Shop.
                    </p>

                </div>


                {{-- NAVIGATION --}}
                <div>

                    <h3 class="text-sm font-semibold text-white">
                        Điều hướng
                    </h3>

                    <ul class="mt-4 space-y-3 text-sm">

                        <li>
                            <a href="{{ route('home') }}" class="hover:text-white">
                                Trang chủ
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('products.index') }}" class="hover:text-white">
                                Tất cả sản phẩm
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('categories.index') }}" class="hover:text-white">
                                Danh mục
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('search') }}" class="hover:text-white">
                                Tìm kiếm
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- CATEGORIES --}}
                <div>

                    <h3 class="text-sm font-semibold text-white">
                        Khám phá
                    </h3>

                    <ul class="mt-4 space-y-3 text-sm">

                        @foreach ($footerCategories ?? [] as $category)
                            <li>

                                <a href="{{ route('categories.show', $category->slug) }}" class="hover:text-white">
                                    {{ $category->name }}
                                </a>

                            </li>
                        @endforeach

                    </ul>

                </div>


                {{-- INFORMATION --}}
                <div>

                    <h3 class="text-sm font-semibold text-white">
                        Thông tin
                    </h3>

                    <ul class="mt-4 space-y-3 text-sm">

                        <li>
                            <span class="text-gray-400">
                                Sản phẩm được chọn lọc từ TikTok Shop.
                            </span>
                        </li>

                        <li>
                            <span class="text-gray-400">
                                Giá và tình trạng sản phẩm có thể thay đổi.
                            </span>
                        </li>

                    </ul>

                </div>

            </div>


            {{-- COPYRIGHT --}}
            <div class="mt-12 border-t border-gray-800 pt-6">

                <div class="flex flex-col gap-3 text-sm text-gray-500 sm:flex-row sm:items-center sm:justify-between">

                    <p>
                        © {{ date('Y') }} TikTok Affiliate. All rights reserved.
                    </p>

                    <p>
                        Nội dung và thông tin sản phẩm có thể thay đổi theo TikTok Shop.
                    </p>

                </div>

            </div>

        </div>

    </footer>
