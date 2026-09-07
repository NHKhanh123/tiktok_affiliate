{{-- REGISTER MODAL --}}
<div id="registerModal" class="fixed inset-0 z-[100] hidden" aria-hidden="true">

    {{-- Overlay --}}
    <div id="registerOverlay" class="absolute inset-0 bg-black/50 backdrop-blur-sm">
    </div>

    {{-- Modal --}}
    <div class="relative flex min-h-full items-center justify-center p-4">

        <div class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl">

            {{-- Close --}}
            <button type="button" onclick="closeRegisterModal()"
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
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3.75 20.25a6.75 6.75 0 0 1 13.5 0" />
                    </svg>

                </div>

                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    Tạo tài khoản
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Đăng ký tài khoản để theo dõi đơn hàng và hoa hồng.
                </p>

            </div>


            {{-- Errors --}}
            @if ($errors->any())

                <div class="mx-6 mt-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 sm:mx-8">

                    <div class="text-sm font-semibold text-red-700">
                        Không thể đăng ký
                    </div>

                    <ul class="mt-2 space-y-1 text-sm text-red-600">

                        @foreach ($errors->all() as $error)
                            <li>
                                • {{ $error }}
                            </li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Form --}}
            <form method="POST" action="{{ route('register') }}" class="px-6 pb-6 pt-5 sm:px-8 sm:pb-8">

                @csrf


                {{-- Name --}}
                <div class="mb-5">

                    <label for="register_name" class="mb-2 block text-sm font-medium text-gray-700">
                        Họ và tên
                    </label>

                    <input type="text" id="register_name" name="name" value="{{ old('name') }}" required
                        autocomplete="name" placeholder="Nhập họ và tên"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-1 focus:ring-gray-900">

                </div>


                {{-- Email --}}
                <div class="mb-5">

                    <label for="register_email" class="mb-2 block text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input type="email" id="register_email" name="email" value="{{ old('email') }}" required
                        autocomplete="email" placeholder="Nhập email của bạn"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-1 focus:ring-gray-900">

                </div>


                {{-- Password --}}
                <div class="mb-5">

                    <label for="register_password" class="mb-2 block text-sm font-medium text-gray-700">
                        Mật khẩu
                    </label>

                    <input type="password" id="register_password" name="password" required autocomplete="new-password"
                        placeholder="Nhập mật khẩu"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-1 focus:ring-gray-900">

                </div>


                {{-- Confirm Password --}}
                <div class="mb-6">

                    <label for="register_password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">
                        Xác nhận mật khẩu
                    </label>

                    <input type="password" id="register_password_confirmation" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Nhập lại mật khẩu"
                        class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-gray-900 focus:ring-1 focus:ring-gray-900">

                </div>


                {{-- Submit --}}
                <button type="submit"
                    class="w-full rounded-xl bg-gray-900 px-5 py-3.5 text-sm font-semibold text-white transition hover:bg-gray-800">
                    Đăng ký
                </button>


                {{-- Login --}}
                <div class="mt-6 text-center text-sm text-gray-500">

                    Đã có tài khoản?

                    <button type="button" onclick="switchToLogin()"
                        class="font-semibold text-gray-900 hover:underline">
                        Đăng nhập
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
    function openRegisterModal() {

        const modal = document.getElementById('registerModal');

        if (!modal) {
            return;
        }

        modal.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

        setTimeout(() => {

            const name = document.getElementById('register_name');

            if (name) {
                name.focus();
            }

        }, 100);
    }


    function closeRegisterModal() {

        const modal = document.getElementById('registerModal');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');
    }


    document.getElementById('registerOverlay')?.addEventListener(
        'click',
        function() {
            closeRegisterModal();
        }
    );


    function switchToLogin() {

        closeRegisterModal();

        openLoginModal();

    }


    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeRegisterModal();

        }

    });
</script>
