<?php

namespace App\Controllers;

class TaskPages extends BaseController
{
    public function about(): string
    {
        return view('tasks/about', ['title' => 'About']);
    }
}
