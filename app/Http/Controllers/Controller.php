<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Data user cadangan saat belum login (mode demo). Tiap controller role mengisi sendiri.
     */
    protected array $defaultUser = ['name' => 'User', 'email' => 'User@capaian.id'];

    /**
     * User yang sedang login (dari session), atau $defaultUser jika belum ada.
     */
    protected function currentUser(): array
    {
        return session('user', $this->defaultUser);
    }
}
