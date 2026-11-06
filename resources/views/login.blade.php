<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Masuk | Capaian.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <div class="main">
        <div class="main-image">
            <a href="{{ url('/') }}" aria-label="Kembali ke halaman utama">
                <img src="{{ asset('img/topi.png') }}" alt="Ilustrasi topi koki" class="main-image" />
            </a>
        </div>
        <div class="main-text">
            <strong>CAPAIAN.ID</strong>
            <small>Pantau kinerja harianmu</small>
        </div>
    </div>
    <main class="login-panel" aria-labelledby="login-heading">
        <div class="login-heading">
            <span class="eyebrow">Selamat datang kembali</span>
            <h1 id="login-heading">Masuk ke Akun</h1>
            <p>Masuk untuk melanjutkan pemantauan kinerja harian.</p>
        </div>

        @if (session('status'))
            <div class="status-message" role="status">
                {{ session('status') }}
            </div>
        @endif

        <form class="login-form" action="{{ route('login.post') }}" method="POST" novalidate>
            @csrf
            <div class="form-field">
                <label for="email">Email Akun</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="nama@contoh.com"
                    autocomplete="username"
                    value="{{ old('email') }}"
                    required
                />
                <span class="field-error @error('email') is-visible @enderror" id="email-error" aria-live="polite">
                    @error('email') {{ $message }} @enderror
                </span>
            </div>
            <div class="form-field">
                <label for="password">Kata Sandi</label>
                <div class="password-field">
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Masukkan kata sandi"
                        autocomplete="current-password"
                        required
                    />
                    <button
                        class="password-toggle"
                        type="button"
                        aria-label="Tampilkan kata sandi"
                        aria-pressed="false"
                    >
                        <svg class="eye-open" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M2.5 12 C4.5 8.4 8 6 12 6 C16 6 21.5 9.6 21.5 12 C19.5 15.6 16 18 12 18 C8 18 4.5 15.6 2.5 12 Z" />
                            <circle cx="12" cy="12" r="2.5" />
                        </svg>
                        <svg class="eye-closed" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 3l18 18M10.6 6.2A10.7 10.7 0 0 1 12 6c6.1 0 9.5 6 9.5 6a16 16 0 0 1-3 3.6M6.2 6.8C3.8 8.3 2.5 12 2.5 12s3.4 6 9.5 6c1.2 0 2.3-.2 3.3-.6" />
                            <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" />
                        </svg>
                    </button>
                </div>
                <span class="field-error @error('password') is-visible @enderror" id="password-error" aria-live="polite">
                    @error('password') {{ $message }} @enderror
                </span>
            </div>
            <p class="login-feedback" role="status" aria-live="polite"></p>
            <button class="submit-btn" id="submit-btn" type="submit">
                <span>Masuk</span>
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14M13 6l6 6-6 6" />
                </svg>
            </button>
        </form>
        <p class="login-footer">Gunakan akun yang telah didaftarkan oleh admin.</p>

        <!-- Shortcut Cepat Akun Demo -->
        <div style="margin-top: 20px; padding: 14px; background: #fffdfa; border: 1.5px dashed #ebdcd0; border-radius: 14px; text-align: left;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                <span style="font-size: 0.76rem; font-weight: 800; color: #1c1917; letter-spacing: 0.02em;">PILIH AKUN DEMO:</span>
                <span style="font-size: 0.7rem; color: #78716c;">Password: <strong style="color: #1c1917;">12345678</strong></span>
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                <button type="button" class="demo-fill-btn" data-email="sm@gmail.com" style="padding: 5px 10px; border-radius: 8px; border: 1px solid #fed7aa; background: #fff7ed; color: #c2410c; font-size: 0.72rem; font-weight: 700; cursor: pointer;">
                    Store Manager
                </button>
                <button type="button" class="demo-fill-btn" data-email="frontliner@gmail.com" style="padding: 5px 10px; border-radius: 8px; border: 1px solid #e2e8f0; background: #f8fafc; color: #334155; font-size: 0.72rem; font-weight: 700; cursor: pointer;">
                    Frontliner
                </button>
                <button type="button" class="demo-fill-btn" data-email="produksi@gmail.com" style="padding: 5px 10px; border-radius: 8px; border: 1px solid #e2e8f0; background: #f8fafc; color: #334155; font-size: 0.72rem; font-weight: 700; cursor: pointer;">
                    Produksi
                </button>
                <button type="button" class="demo-fill-btn" data-email="driver@gmail.com" style="padding: 5px 10px; border-radius: 8px; border: 1px solid #e2e8f0; background: #f8fafc; color: #334155; font-size: 0.72rem; font-weight: 700; cursor: pointer;">
                    Driver
                </button>
                <button type="button" class="demo-fill-btn" data-email="admin@gmail.com" style="padding: 5px 10px; border-radius: 8px; border: 1px solid #cbd5e1; background: #f1f5f9; color: #0f172a; font-size: 0.72rem; font-weight: 700; cursor: pointer;">
                    Admin
                </button>
            </div>
        </div>
    </main>
    <script>
        const loginForm = document.querySelector('.login-form');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.querySelector('.password-toggle');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const loginFeedback = document.querySelector('.login-feedback');
        const submitBtn = document.getElementById('submit-btn');
        const submitBtnText = submitBtn.querySelector('span');

        passwordToggle.addEventListener('click', () => {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            passwordToggle.setAttribute('aria-pressed', String(isHidden));
            passwordToggle.setAttribute(
                'aria-label',
                isHidden ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi'
            );
        });

        loginForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Reset status tampilan error
            emailInput.classList.remove('is-invalid');
            passwordInput.classList.remove('is-invalid');
            emailError.textContent = '';
            emailError.classList.remove('is-visible');
            passwordError.textContent = '';
            passwordError.classList.remove('is-visible');
            loginFeedback.textContent = '';
            loginFeedback.classList.remove('is-success');

            const emailVal = emailInput.value.trim();
            const passwordVal = passwordInput.value;

            // Validasi lokal dasar
            let hasError = false;
            if (!emailVal) {
                emailInput.classList.add('is-invalid');
                emailError.textContent = 'Email akun wajib diisi.';
                emailError.classList.add('is-visible');
                hasError = true;
            }

            if (!passwordVal) {
                passwordInput.classList.add('is-invalid');
                passwordError.textContent = 'Kata sandi wajib diisi.';
                passwordError.classList.add('is-visible');
                hasError = true;
            }

            if (hasError) return;

            submitBtn.disabled = true;
            submitBtnText.textContent = 'Memproses...';

            try {
                const formData = new FormData(loginForm);
                const response = await fetch("{{ route('login.post') }}", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    loginFeedback.textContent = data.message || 'Login berhasil! Mengalihkan...';
                    loginFeedback.classList.add('is-success');

                    // Alihkan ke URL sesuai akun masing-masing
                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 400);
                } else {
                    submitBtn.disabled = false;
                    submitBtnText.textContent = 'Masuk';

                    if (data.field === 'email' || (data.errors && data.errors.email)) {
                        emailInput.classList.add('is-invalid');
                        emailError.textContent = data.message || (data.errors && data.errors.email[0]);
                        emailError.classList.add('is-visible');
                    } else if (data.field === 'password' || (data.errors && data.errors.password)) {
                        passwordInput.classList.add('is-invalid');
                        passwordError.textContent = data.message || (data.errors && data.errors.password[0]);
                        passwordError.classList.add('is-visible');
                    } else {
                        emailInput.classList.add('is-invalid');
                        emailError.textContent = data.message || 'Email atau kata sandi tidak valid.';
                        emailError.classList.add('is-visible');
                    }
                }
            } catch (err) {
                // Jika request AJAX gagal, submit secara native sebagai fallback
                loginForm.submit();
            }
        });

        // Event listener tombol cepat isi akun demo
        document.querySelectorAll('.demo-fill-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const email = this.getAttribute('data-email');
                emailInput.value = email;
                passwordInput.value = '12345678';
                
                // Animasi visual feedback
                document.querySelectorAll('.demo-fill-btn').forEach(b => b.style.outline = 'none');
                this.style.outline = '2px solid #ea580c';

                // Hapus error jika ada
                emailInput.classList.remove('is-invalid');
                passwordInput.classList.remove('is-invalid');
                emailError.textContent = '';
                passwordError.textContent = '';
            });
        });
    </script>
</body>

</html>