<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BackendApiService
{
    /** Ditandai true jika Backend gagal dihubungi pada request ini. */
    private static bool $unreachable = false;

    /**
     * Dapatkan base URL backend API
     */
    public static function url(string $endpoint = ''): string
    {
        $base = rtrim(env('BACKEND_API_URL', 'http://127.0.0.1:8000/api'), '/');
        return $endpoint ? $base . '/' . ltrim($endpoint, '/') : $base;
    }

    /**
     * HTTP Client yang otomatis melampirkan Bearer token dari session
     */
    public static function client()
    {
        $token = session('api_token');
        $http = Http::acceptJson()->connectTimeout(3)->timeout(10);

        if ($token) {
            $http = $http->withToken($token);
        }

        return $http;
    }

    /**
     * Apakah sesi ini login lewat Backend (punya token)?
     * Jika tidak (akun demo lokal / Backend mati saat login), halaman memakai data dummy.
     */
    public static function connected(): bool
    {
        return (bool) session('api_token');
    }

    /**
     * GET yang aman: mengembalikan array JSON, atau null jika belum login ke Backend,
     * Backend tidak bisa dihubungi, atau respons gagal. Pemanggil memakai data dummy saat null.
     */
    public static function fetch(string $endpoint, array $query = []): ?array
    {
        if (! self::connected() || self::$unreachable) {
            return null;
        }

        try {
            $response = self::get($endpoint, $query);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            // Backend mati: jangan coba lagi di sisa request ini agar halaman tidak lambat
            self::$unreachable = true;
            Log::warning("Backend tidak dapat dihubungi ({$endpoint}): " . $e->getMessage());
            return null;
        } catch (\Throwable $e) {
            Log::warning("Backend GET {$endpoint} gagal: " . $e->getMessage());
            return null;
        }

        if (! $response->successful()) {
            Log::warning("Backend GET {$endpoint} status {$response->status()}");
            return null;
        }

        return $response->json();
    }

    /**
     * Kirim perubahan (POST/PUT/PATCH/DELETE) dan kembalikan hasil yang mudah dipakai controller:
     * ['ok' => bool, 'status' => int, 'message' => string, 'data' => array|null, 'errors' => array]
     */
    public static function send(string $method, string $endpoint, array $data = []): array
    {
        if (! self::connected()) {
            return ['ok' => false, 'status' => 0, 'message' => 'Belum terhubung ke Backend (login memakai akun demo lokal).', 'data' => null, 'errors' => []];
        }

        try {
            $response = self::client()->{strtolower($method)}(self::url($endpoint), $data);
        } catch (\Throwable $e) {
            return ['ok' => false, 'status' => 0, 'message' => 'Backend tidak dapat dihubungi. Coba lagi nanti.', 'data' => null, 'errors' => []];
        }

        $json = $response->json() ?? [];
        $errors = $json['errors'] ?? [];

        return [
            'ok' => $response->successful(),
            'status' => $response->status(),
            'message' => $json['message'] ?? ($response->successful() ? 'Berhasil.' : 'Permintaan gagal diproses Backend.'),
            'data' => $json['data'] ?? $json,
            'errors' => $errors,
            'first_error' => $errors ? collect($errors)->flatten()->first() : ($json['message'] ?? null),
        ];
    }

    public static function get(string $endpoint, array $query = [])
    {
        return self::client()->get(self::url($endpoint), $query);
    }

    public static function post(string $endpoint, array $data = [])
    {
        return self::client()->post(self::url($endpoint), $data);
    }

    public static function put(string $endpoint, array $data = [])
    {
        return self::client()->put(self::url($endpoint), $data);
    }

    public static function patch(string $endpoint, array $data = [])
    {
        return self::client()->patch(self::url($endpoint), $data);
    }

    public static function delete(string $endpoint, array $data = [])
    {
        return self::client()->delete(self::url($endpoint), $data);
    }
}
