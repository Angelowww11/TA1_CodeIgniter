<?php

namespace App\Controllers;

use App\Models\TaskUserModel;

class TaskProfile extends BaseController
{
    public function index(): string
    {
        return view('profile/index', ['title' => 'Profile', 'user' => (new TaskUserModel())->first()]);
    }
}
