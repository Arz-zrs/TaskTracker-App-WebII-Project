<?php

namespace App\Controllers;

use App\Models\UserModel;

class AccountController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $user = $userModel->find(session()->get('user_id'));

        return view('account/settings', [
            'user' => $user,
        ]);
    }

    public function updateProfile()
    {
        $userId = session()->get('user_id');

        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $data = [
            'name' => $this->request->getPost('name'),
        ];

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            $avatarRules = [
                'avatar' => 'max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]',
            ];

            if (! $this->validate($avatarRules)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }

            if ($avatar->isValid() && ! $avatar->hasMoved()) {
                $newName = $avatar->getRandomName();

                $avatar->move(FCPATH . 'uploads/avatars', $newName);

                $data['avatar'] = 'uploads/avatars/' . $newName;
            }
        }

        $userModel->update($userId, $data);

        session()->set('user_name', $data['name']);

        if (isset($data['avatar'])) {
            session()->set('avatar', $data['avatar']);
        }

        return redirect()
            ->to('/settings')
            ->with('success', 'Profile berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $userId = session()->get('user_id');

        $rules = [
            'current_password' => 'required',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $user = $userModel->find($userId);

        if (! password_verify($this->request->getPost('current_password'), $user['password'])) {
            return redirect()
                ->back()
                ->with('error', 'Password lama salah.');
        }

        $userModel->update($userId, [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return redirect()
            ->to('/settings')
            ->with('success', 'Password berhasil diperbarui.');
    }
}