<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\MediaStore;
use CodeIgniter\HTTP\Files\UploadedFile;
use Throwable;

class Users extends BaseController
{
    public function index(): string
    {
        $users = (new UserModel())->orderBy('user_id', 'ASC')->findAll();
        return view('users/index', ['title' => 'User Accounts', 'users' => $users]);
    }

    public function new(): string
    {
        return view('users/form', ['title' => 'New User', 'user' => [], 'errors' => [], 'action' => site_url('users'), 'editing' => false]);
    }

    public function create()
    {
        $input = $this->userInput();
        $rules = ['username' => 'required|alpha_numeric|min_length[4]|max_length[50]|is_unique[user_accounts.username]', 'full_name' => 'required|string|max_length[101]', 'email' => 'required|valid_email|max_length[100]|is_unique[user_accounts.email]', 'password' => 'required|min_length[12]|max_length[255]', 'role' => 'required|in_list[Admin,Manager,Cashier]', 'account_status' => 'required|in_list[Active,Inactive]'];
        if (! $this->validate($rules)) return view('users/form', ['title' => 'New User', 'user' => $input, 'errors' => $this->validator->getErrors(), 'action' => site_url('users'), 'editing' => false]);
        $newAvatar = null;
        $uploadError = $this->prepareAvatar($this->request->getFile('avatar'), $newAvatar);
        if ($uploadError !== null) return view('users/form', ['title' => 'New User', 'user' => $input, 'errors' => ['avatar' => $uploadError], 'action' => site_url('users'), 'editing' => false]);
        [$first, $last] = $this->splitName($input['full_name']);
        $data = ['username' => $input['username'], 'first_name' => $first, 'last_name' => $last, 'email' => $input['email'], 'password_hash' => password_hash($input['password'], PASSWORD_DEFAULT), 'role' => $input['role'], 'account_status' => $input['account_status']];
        if ($newAvatar !== null) $data['avatar'] = $newAvatar;
        try {
            (new UserModel())->insert($data);
        } catch (Throwable $e) {
            if ($newAvatar !== null) $this->deleteAvatar($newAvatar);
            throw $e;
        }
        return redirect()->to(site_url('users'))->with('message', 'User account created.');
    }

    public function edit(int $id)
    {
        $user = (new UserModel())->find($id);
        if (! $user) return $this->response->setStatusCode(404)->setBody('User not found.');
        $user['full_name'] = trim($user['first_name'] . ' ' . $user['last_name']);
        return view('users/form', ['title' => 'Edit User', 'user' => $user, 'errors' => [], 'action' => site_url('users/update/' . $id), 'editing' => true]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $existing = $model->find($id);
        if (! $existing) return $this->response->setStatusCode(404)->setBody('User not found.');
        $input = $this->userInput();
        $rules = ['username' => "required|alpha_numeric|min_length[4]|max_length[50]|is_unique[user_accounts.username,user_id,{$id}]", 'full_name' => 'required|string|max_length[101]', 'email' => "required|valid_email|max_length[100]|is_unique[user_accounts.email,user_id,{$id}]", 'password' => 'permit_empty|min_length[12]|max_length[255]', 'role' => 'required|in_list[Admin,Manager,Cashier]', 'account_status' => 'required|in_list[Active,Inactive]'];
        if (! $this->validate($rules)) return view('users/form', ['title' => 'Edit User', 'user' => array_merge($existing, $input), 'errors' => $this->validator->getErrors(), 'action' => site_url('users/update/' . $id), 'editing' => true]);

        $avatar = $this->request->getFile('avatar');
        $newAvatar = null;
        $uploadError = $this->prepareAvatar($avatar, $newAvatar);
        if ($uploadError !== null) {
            return view('users/form', ['title' => 'Edit User', 'user' => array_merge($existing, $input), 'errors' => ['avatar' => $uploadError], 'action' => site_url('users/update/' . $id), 'editing' => true]);
        }

        [$first, $last] = $this->splitName($input['full_name']);
        $data = ['username' => $input['username'], 'first_name' => $first, 'last_name' => $last, 'email' => $input['email'], 'role' => $input['role'], 'account_status' => $input['account_status']];
        if ($input['password'] !== '') $data['password_hash'] = password_hash($input['password'], PASSWORD_DEFAULT);
        if ($newAvatar !== null) $data['avatar'] = $newAvatar;
        try {
            if (! $model->update($id, $data)) {
                if ($newAvatar !== null) $this->deleteAvatar($newAvatar);
                return view('users/form', ['title' => 'Edit User', 'user' => array_merge($existing, $input), 'errors' => ['form' => 'The account could not be updated. Check that the username and email are not already in use.'], 'action' => site_url('users/update/' . $id), 'editing' => true]);
            }
        } catch (Throwable $e) {
            if ($newAvatar !== null) $this->deleteAvatar($newAvatar);
            throw $e;
        }
        if ($newAvatar !== null && ! empty($existing['avatar'])) $this->deleteAvatar(basename($existing['avatar']));
        return redirect()->to(site_url('users'))->with('message', 'User account updated.');
    }

    public function delete(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);
        if (! $user) return $this->response->setStatusCode(404)->setBody('User not found.');
        if ((int) session('auth_user_id') === $id) return redirect()->to(site_url('users'))->with('error', 'You cannot delete your own account.');
        if (db_connect()->table('sales')->where('sold_by', $id)->countAllResults() > 0) return redirect()->to(site_url('users'))->with('error', 'This staff member has sales history and cannot be deleted.');
        $model->delete($id);
        if (! empty($user['avatar'])) $this->deleteAvatar(basename($user['avatar']));
        return redirect()->to(site_url('users'))->with('message', 'Staff account deleted.');
    }

    private function userInput(): array
    {
        return ['username' => trim((string) $this->request->getPost('username')), 'full_name' => trim((string) $this->request->getPost('full_name')), 'email' => strtolower(trim((string) $this->request->getPost('email'))), 'password' => (string) $this->request->getPost('password'), 'role' => trim((string) $this->request->getPost('role')), 'account_status' => trim((string) $this->request->getPost('account_status')) ?: 'Active'];
    }

    private function splitName(string $name): array
    {
        $parts = preg_split('/\s+/', trim($name), 2) ?: [''];
        return [$parts[0] ?? '', $parts[1] ?? ''];
    }

    private function prepareAvatar(?UploadedFile $file, ?string &$filename): ?string
    {
        $filename = null;
        if ($file === null || $file->getError() === UPLOAD_ERR_NO_FILE) return null;
        if (! $file->isValid()) {
            if (in_array($file->getError(), [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true)) return 'The avatar must be no larger than 2 MB.';
            return 'The avatar upload did not complete successfully.';
        }
        if ($file->getSize() > 2 * 1024 * 1024) return 'The avatar must be no larger than 2 MB.';
        if (! in_array($file->getMimeType(), ['image/jpeg', 'image/png'], true)) return 'Upload a valid JPG or PNG image.';

        $filename = bin2hex(random_bytes(16)) . '.jpg';
        $databaseStorage = MediaStore::usesDatabase();
        $directory = $databaseStorage ? sys_get_temp_dir() : FCPATH . 'uploads/avatars';
        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) return 'The avatar folder is not writable.';
        $path = $directory . DIRECTORY_SEPARATOR . $filename;
        try {
            service('image', 'gd')->withFile($file->getTempName())->fit(320, 320, 'center')->convert(IMAGETYPE_JPEG)->save($path, 82);
            if ($databaseStorage) {
                MediaStore::save($filename, $path);
                @unlink($path);
            }
        } catch (Throwable $e) {
            @unlink($path);
            log_message('error', 'Avatar preparation failed: {message}', ['message' => $e->getMessage()]);
            return 'The image could not be prepared. Check that PHP GD is enabled and upload a valid image.';
        }
        return null;
    }

    private function deleteAvatar(string $filename): void
    {
        if (MediaStore::usesDatabase()) {
            MediaStore::delete($filename);
            return;
        }
        @unlink(FCPATH . 'uploads/avatars/' . $filename);
    }
}
