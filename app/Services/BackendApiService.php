<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BackendApiService
{
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
        $http = Http::acceptJson()->timeout(10);

        if ($token) {
            $http = $http->withToken($token);
        }

        return $http;
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

