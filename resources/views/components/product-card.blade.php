@props(['product'])

@php
    $price = $product->sale_price ?? $product->price;

    $hasSale = $product->sale_price !== null && $product->price !== null && $product->sale_price < $product->price;

    $discount = $hasSale ? round((($product->price - $product->sale_price) / $product->price) * 100) : null;
@endphp


<article
    class="group relative overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:-translate-y-1 hover:shadow-xl">

    {{-- Product Image --}}
    <a href="{{ route('products.show', $product->slug) }}" class="block">

        <div class="relative aspect-square overflow-hidden bg-gray-100">

            @php
                $image = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
            @endphp

            @if ($image)
                <img src="{{ asset('storage/' . $image->image_url) }}" alt="{{ $product->name }}"
                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
            @else
                <div class="flex h-full w-full items-center justify-center bg-gray-100">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 16.5 8.5 11l4 4 3-3 5.5 5.5M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10Z" />
                    </svg>

                </div>
            @endif

            {{-- Discount --}}
            @if ($discount)
                <span class="absolute left-3 top-3 rounded-lg bg-black px-2.5 py-1 text-xs font-semibold text-white">
                    -{{ $discount }}%
                </span>
            @endif

            {{-- Featured --}}
            @if ($product->featured)
                <span
                    class="absolute right-3 top-3 rounded-lg bg-white/95 px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-sm">
                    Nổi bật
                </span>
            @endif

        </div>

    </a>


    {{-- Product Information --}}
    <div class="p-4">

        {{-- Category --}}
        @if ($product->category)
            <div class="mb-2 text-xs font-medium text-gray-400">
                {{ $product->category->name }}
            </div>
        @endif


        {{-- Name --}}
        <h3 class="line-clamp-2 min-h-[40px] text-sm font-semibold leading-5 text-gray-900">

            <a href="{{ route('products.show', $product->slug) }}" class="transition hover:text-gray-500">
                {{ $product->name }}
            </a>

        </h3>


        {{-- Price --}}
        <div class="mt-3 flex items-end gap-2">

            <span class="text-lg font-bold text-gray-900">
                {{ number_format($price, 0, ',', '.') }}₫
            </span>


            @if ($hasSale)
                <span class="text-xs text-gray-400 line-through">
                    {{ number_format($product->price, 0, ',', '.') }}₫
                </span>
            @endif

        </div>


        {{-- CTA --}}
        <a href="{{ route('products.show', $product->slug) }}"
            class="mt-4 flex w-full items-center justify-center rounded-xl bg-gray-100 px-4 py-2.5 text-sm font-semibold text-gray-900 transition group-hover:bg-black group-hover:text-white">
            Xem sản phẩm
        </a>

    </div>

</article>
