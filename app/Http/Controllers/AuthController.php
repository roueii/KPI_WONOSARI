<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\BackendApiService;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Daftar akun bawaan / demo untuk role-based login
     */
    protected $defaultAccounts = [
        '12345678@gmail.com' => [
            'password' => '12345678',
            'name' => 'Admin',
            'role' => 'admin',
            'route' => 'admin.dashboard',
        ],
        'admin@gmail.com' => [
            'password' => '12345678',
            'name' => 'Admin',
            'role' => 'admin',
            'route' => 'admin.dashboard',
        ],
        'admin@kpi.com' => [
            'password' => '12345678',
            'name' => 'Admin',
            'role' => 'admin',
            'route' => 'admin.dashboard',
        ],
        'sm@gmail.com' => [
            'password' => '12345678',
            'name' => 'Store Manager',
            'role' => 'store_manager',
            'route' => 'storemanager.dashboard',
        ],
        'sm@capaian.id' => [
            'password' => '12345678',
            'name' => 'Store Manager',
            'role' => 'store_manager',
            'route' => 'storemanager.dashboard',
        ],
        'storemanager@capaian.id' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'store_manager',
            'route' => 'storemanager.dashboard',
        ],
        'store.manager@capaian.id' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'store_manager',
            'route' => 'storemanager.dashboard',
        ],
        'frontliner@gmail.com' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'frontliner',
            'route' => 'staff.dashboard',
        ],
        'frontliner@capaian.id' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'frontliner',
            'route' => 'staff.dashboard',
        ],
        'budi.frontliner@capaian.id' => [
            'password' => '12345678',
            'name' => 'Budi Santoso',
            'role' => 'frontliner',
            'route' => 'staff.dashboard',
        ],
        'staff@gmail.com' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'frontliner',
            'route' => 'staff.dashboard',
        ],
        'karyawan@gmail.com' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'frontliner',
            'route' => 'staff.dashboard',
        ],
        'driver@gmail.com' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'driver',
            'route' => 'driver.dashboard',
        ],
        'driver@capaian.id' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'driver',
            'route' => 'driver.dashboard',
        ],
        'karyawan.driver@capaian.id' => [
            'password' => '12345678',
            'name' => 'Budi Santoso',
            'role' => 'driver',
            'route' => 'driver.dashboard',
        ],
        'produksi@gmail.com' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'produksi',
            'route' => 'produksi.dashboard',
        ],
        'produksi@capaian.id' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'produksi',
            'route' => 'produksi.dashboard',
        ],
        'karyawan.produksi@capaian.id' => [
            'password' => '12345678',
            'name' => 'Agus Santoso',
            'role' => 'produksi',
            'route' => 'produksi.dashboard',
        ],
        'sales@capaian.id' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'sales_marketing',
            'route' => 'sales.dashboard',
        ],
        'supervisor@capaian.id' => [
            'password' => '12345678',
            'name' => 'User',
            'role' => 'supervisor',
            'route' => 'supervisor.dashboard',
        ],
    ];

    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        // Jika sudah login di session, langsung arahkan ke dashboard masing-masing
        if (session()->has('user')) {
            $user = session('user');
            $role = $user['role'] ?? 'admin';
            return redirect()->route($this->getRouteByRole($role));
        }

        return view('login');
    }

    /**
     * Proses autentikasi login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email akun wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $email = trim(strtolower($request->email));
        $password = $request->password;

        // 1. Integrasi: Autentikasi langsung ke Backend API (C:\laragon\www\KPI)
        try {
            $response = BackendApiService::post('login', [
                'email'    => $email,
                'password' => $password,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $token = $data['token'] ?? null;
                $apiUser = $data['user'] ?? [];

                $roleName = strtolower($apiUser['role']['name'] ?? '');
                $positionName = strtolower($apiUser['position']['name'] ?? '');

                // Petakan role dan posisi dari Backend ke route UI Frontend
                $uiRole = 'staff';
                if ($roleName === 'admin') {
                    $uiRole = 'admin';
                } elseif (str_contains($positionName, 'supervisor') || str_contains($positionName, 'spv')) {
                    $uiRole = 'supervisor';
                } elseif (str_contains($positionName, 'sales') || str_contains($positionName, 'marketing')) {
                    $uiRole = 'sales_marketing';
                } elseif ($roleName === 'manager' || str_contains($positionName, 'manager')) {
                    $uiRole = 'store_manager';
                } elseif (str_contains($positionName, 'driver')) {
                    $uiRole = 'driver';
                } elseif (str_contains($positionName, 'produksi')) {
                    $uiRole = 'produksi';
                } elseif (str_contains($positionName, 'frontliner') || str_contains($positionName, 'kasir')) {
                    $uiRole = 'frontliner';
                }

                session([
                    'api_token' => $token,
                    'user'      => [
                        'id'       => $apiUser['id'] ?? null,
                        'name'     => $apiUser['name'] ?? 'User',
                        'email'    => $apiUser['email'] ?? $email,
                        'role'     => $uiRole,
                        'role_obj' => $apiUser['role'] ?? null,
                        'position' => $apiUser['position'] ?? null,
                    ],
                ]);

                $redirectUrl = route($this->getRouteByRole($uiRole));

                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success'  => true,
                        'message'  => 'Login berhasil! Mengalihkan...',
                        'redirect' => $redirectUrl,
                        'role'     => $uiRole,
                    ]);
                }

                return redirect()->intended($redirectUrl);
            }

            // Jika Backend merespons kesalahan login (salah email/password)
            if ($response->status() === 422) {
                $err = $response->json();
                $message = $err['message'] ?? ($err['errors']['email'][0] ?? 'Email atau kata sandi tidak valid.');

                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'field'   => 'password',
                        'message' => $message,
                    ], 422);
                }

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['password' => $message]);
            }
        } catch (\Exception $e) {
            // Jika koneksi ke Backend API gagal/offline, lanjut ke fallback akun demo
        }

        // 2. Fallback: Cek akun default / demo jika Backend sedang offline
        if (isset($this->defaultAccounts[$email])) {
            $account = $this->defaultAccounts[$email];

            if ($password === $account['password']) {
                $sessionUser = [
                    'name' => $account['name'],
                    'email' => $email,
                    'role' => $account['role'],
                ];
                session(['user' => $sessionUser]);

                $redirectUrl = route($account['route']);

                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Login berhasil! Mengalihkan...',
                        'redirect' => $redirectUrl,
                        'role' => $account['role'],
                    ]);
                }

                return redirect()->intended($redirectUrl);
            } else {
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'field' => 'password',
                        'message' => 'Kata sandi salah. Periksa kembali kata sandi yang Anda masukkan.',
                    ], 422);
                }

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['password' => 'Kata sandi salah. Periksa kembali kata sandi yang Anda masukkan.']);
            }
        }

        // 3. Fallback: Cek database lokal jika tersedia
        try {
            $user = User::where('email', $email)->first();
            if ($user && Hash::check($password, $user->password)) {
                Auth::login($user);
                $role = $user->role ?? 'admin';

                session([
                    'user' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $role,
                    ]
                ]);

                $redirectUrl = route($this->getRouteByRole($role));

                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Login berhasil! Mengalihkan...',
                        'redirect' => $redirectUrl,
                        'role' => $role,
                    ]);
                }

                return redirect()->intended($redirectUrl);
            }
        } catch (\Exception $e) {
            // Abaikan error database jika DB belum dimigrasi
        }

        // Jika email tidak terdaftar
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'field' => 'email',
                'message' => 'Email tidak sesuai. Periksa kembali email yang Anda masukkan.',
            ], 422);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email tidak sesuai. Periksa kembali email yang Anda masukkan.']);
    }

    /**
     * Dapatkan route sesuai role
     */
    protected function getRouteByRole($role)
    {
        switch ($role) {
            case 'admin':
                return 'admin.dashboard';
            case 'store_manager':
                return 'storemanager.dashboard';
            case 'driver':
            case 'karyawan_driver':
                return 'driver.dashboard';
            case 'produksi':
            case 'karyawan_produksi':
                return 'produksi.dashboard';
            case 'sales_marketing':
            case 'sales':
            case 'marketing':
                return 'sales.dashboard';
            case 'supervisor':
            case 'spv':
                return 'supervisor.dashboard';
            case 'frontliner':
            case 'staff':
            case 'karyawan':
            default:
                return 'staff.dashboard';
        }
    }

    /**
     * Halaman Dashboard Store Manager (meneruskan ke StoreManagerController)
     */
    public function storeManagerDashboard()
    {
        return app(StoreManagerController::class)->dashboard(request());
    }

    /**
     * Halaman Dashboard untuk Karyawan / Frontliner
     */
    public function karyawanDashboard()
    {
        return app(FrontlinerController::class)->dashboard();
    }

    /**
     * Logout pengguna
     */
    public function logout(Request $request)
    {
        if (session()->has('api_token')) {
            try {
                BackendApiService::post('logout');
            } catch (\Exception $e) {
                // Abaikan error saat logout API
            }
        }

        session()->forget(['user', 'api_token']);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda telah berhasil keluar.');
    }
}
