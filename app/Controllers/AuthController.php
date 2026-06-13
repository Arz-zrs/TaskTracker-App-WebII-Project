<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $email = strtolower(trim((string) $this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');

        $throttler = service('throttler');

        $key = 'login_' . md5($email . '_' . $this->request->getIPAddress());

        if (! $throttler->check($key, 5, 300)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terlalu banyak percobaan login. Coba lagi dalam 5 menit.');
        }

        $userModel = new UserModel();

        $user = $userModel
            ->where('email', $email)
            ->first();

        if (! $user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email atau password salah.');
        }

        if (! password_verify($password, $user['password'])) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email atau password salah.');
        }

        session()->regenerate(true);

        session()->set([
            'user_id' => $user['id'],
            'user_name' => $user['name'],
            'role' => $user['role'],
            'logged_in' => true,
        ]);

        return redirect()->to('/dashboard');
    }
    
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/');
    }
}