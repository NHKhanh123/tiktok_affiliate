{{-- LOGIN MODAL --}}
<div id="loginModal" class="fixed inset-0 z-[100] {{ session('open_login_modal') ? '' : 'hidden' }}">

    {{-- Overlay --}}
    <div id="loginOverlay" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
    </div>

    {{-- Modal --}}
    <div class="relative flex min-h-full items-center justify-center p-4">

        <div id="loginModalContent" class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl">

            {{-- Close --}}
            <button type="button" onclick="closeLoginModal()"
                class="absolute right-4 top-4 z-10 flex h-9 w-9 items-center justify-center rounded-full text-gray-400 transition hover:bg-gray-100 hover:text-gray-900"
                aria-label="Đóng">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Header --}}
            <div class="px-6 pb-2 pt-8 text-center sm:px-8">

                <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-gray-900 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Đăng nhập
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Đăng nhập để quản lý tài khoản và đơn hàng của bạn.
                </p>

            </div>

            {{-- Error --}}
            <div id="loginErrors" class="mx-6 mt-5 hidden rounded-xl border border-red-200 bg-red-50 px-4 py-3 sm:mx-8">
                <p class="text-sm text-red-600"></p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="px-6 pb-6 pt-5 sm:px-8 sm:pb-8">

                @csrf

                {{-- Email --}}
                <div class="mb-5">

                    <label for="login_email" class="mb-2 block text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}" autocomplete="email" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                        placeholder="Nhập email">

                </div>

                {{-- Password --}}
                <div class="mb-5">

                    <label for="login_password" class="mb-2 block text-sm font-medium text-gray-700">
                        Mật khẩu
                    </label>

                    <input type="password" name="password" autocomplete="current-password" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 outline-none transition focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10"
                        placeholder="Nhập mật khẩu">

                </div>
                @if ($errors->has('email'))
                    <div class="mt-3 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3.5m0 3.5h.01M10.3 3.8l-7.2 12.5A2 2 0 004.8 19h14.4a2 2 0 001.7-2.7L13.7 3.8a2 2 0 00-3.4 0z" />
                        </svg>

                        <p class="text-sm font-medium leading-5 text-red-700">
                            {{ $errors->first('email') }}
                        </p>
                    </div>
                @endif

                {{-- Remember --}}
                <div class="mb-6">

                    <label class="inline-flex cursor-pointer items-center gap-2">

                        <input type="checkbox" name="remember" value="1"
                            class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900">

                        <span class="text-sm text-gray-600">
                            Ghi nhớ đăng nhập
                        </span>

                    </label>

                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full rounded-xl bg-gray-900 px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-gray-800">
                    Đăng nhập
                </button>

                {{-- Register --}}
                <div class="mt-6 text-center text-sm text-gray-500">

                    Chưa có tài khoản?

                    <a href="{{ route('register.form') }}" class="font-semibold text-gray-900 hover:underline">
                        Đăng ký
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
    function openLoginModal() {

        const modal = document.getElementById('loginModal');

        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

        setTimeout(() => {

            const email = document.getElementById('login_email');

            if (email) {
                email.focus();
            }

        }, 100);
    }


    function closeLoginModal() {

        const modal = document.getElementById('loginModal');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');
    }


    // Click overlay để đóng
    document.getElementById('loginOverlay')?.addEventListener('click', function() {

        closeLoginModal();

    });


    // Nhấn ESC để đóng
    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeLoginModal();

        }

    });
</script>
