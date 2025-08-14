<?php

/**
* !!! TOLONG CONTROLLER INI DIHAPUS JIKA SUDAH DI PRODUCTION !!!
*/

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SSOBypass extends Controller
{
    public function __invoke(Request $request)
    {
        if (!$request->has('username')) {
            return response("
            <script>
                var username = prompt('Masukkan Username:');
                if(username) {
                    window.location = '?username=' + encodeURIComponent(username);
                }
            </script>
        ");
        }

        // Get Username from request
        $username = $request->get('username');
        // Get User
        $user = User::where('username', $username)->first();
        // Check User
        if (!$user) {
            return response("
                <script>
                    alert('User tidak ditemukan!');
                    window.location = '/ssobypass';
                </script>
            ");
        }

        // Jika user ditemukan, lanjutkan proses autentikasi
        Auth::login($user);
        return redirect()->intended('dashboard');
    }
}
