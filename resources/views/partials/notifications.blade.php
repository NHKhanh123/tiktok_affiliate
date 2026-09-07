{{-- GLOBAL NOTIFICATIONS --}}

@if (session('success') || session('error') || session('warning') || session('info'))

    <div id="globalNotification" class="fixed right-4 top-20 z-[200] w-[calc(100%-2rem)] max-w-sm">

        <div
            class="
                relative overflow-hidden rounded-2xl border bg-white
                p-4 shadow-xl
                @if (session('success')) border-green-200
                @elseif(session('error'))
                    border-red-200
                @elseif(session('warning'))
                    border-yellow-200
                @else
                    border-blue-200 @endif
            ">

            <div class="flex items-start gap-3">

                {{-- Icon --}}
                <div
                    class="
                        flex h-10 w-10 shrink-0 items-center justify-center
                        rounded-full
                        @if (session('success')) bg-green-100 text-green-600
                        @elseif(session('error'))
                            bg-red-100 text-red-600
                        @elseif(session('warning'))
                            bg-yellow-100 text-yellow-600
                        @else
                            bg-blue-100 text-blue-600 @endif
                    ">

                    @if (session('success'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                        </svg>
                    @elseif(session('error'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m0 3.75h.007M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                        </svg>
                    @elseif(session('warning'))
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v3.75m0 3.75h.007M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-1.74-3L13.71 3.86Z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.05.68v3.34m0-7.5h.008M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    @endif

                </div>


                {{-- Content --}}
                <div class="min-w-0 flex-1">

                    <div class="text-sm font-semibold text-gray-900">

                        @if (session('success'))
                            Thành công
                        @elseif(session('error'))
                            Có lỗi xảy ra
                        @elseif(session('warning'))
                            Lưu ý
                        @else
                            Thông báo
                        @endif

                    </div>

                    <div class="mt-1 text-sm text-gray-600">

                        {{ session('success') ?? (session('error') ?? (session('warning') ?? session('info'))) }}

                    </div>

                </div>


                {{-- Close --}}
                <button type="button" onclick="closeGlobalNotification()"
                    class="shrink-0 rounded-lg p-1 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
                    aria-label="Đóng">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>


            {{-- Progress --}}
            <div id="notificationProgress"
                class="
                    absolute bottom-0 left-0 h-1
                    @if (session('success')) bg-green-500
                    @elseif(session('error'))
                        bg-red-500
                    @elseif(session('warning'))
                        bg-yellow-500
                    @else
                        bg-blue-500 @endif
                "
                style="width: 100%;"></div>

        </div>

    </div>


    <script>
        function closeGlobalNotification() {

            const notification =
                document.getElementById('globalNotification');

            if (!notification) {
                return;
            }

            notification.style.transition =
                'opacity 0.25s ease, transform 0.25s ease';

            notification.style.opacity = '0';

            notification.style.transform =
                'translateX(20px)';

            setTimeout(() => {

                notification.remove();

            }, 250);
        }


        // Tự động đóng sau 4 giây
        setTimeout(() => {

            closeGlobalNotification();

        }, 4000);


        // Thanh thời gian
        const progress =
            document.getElementById('notificationProgress');

        if (progress) {

            progress.style.transition =
                'width 4s linear';

            setTimeout(() => {

                progress.style.width = '0%';

            }, 50);
        }
    </script>

@endif
