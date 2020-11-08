<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homework;

class HomeworkController extends Controller
{
    public function index()
    {
        return Homework::all();
    }
    
    public function create()
    {
        return Homework::create(request()->validateWithBag('post', [
            'class' => 'required|max:255',
            'teacher' => 'required|max:255',
            'description' => 'required',
            'due_date_time' => 'required|max:255'
        ]));
    }
}
