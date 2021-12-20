<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $categories = Category::all();
        
        return view('blog.dashboard', [
            'categories' => $categories
        ]);
    }
}
