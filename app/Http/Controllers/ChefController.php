<?php

namespace App\Http\Controllers;

use App\Models\Panne;
use Illuminate\Support\Facades\Auth;

class ChefController extends Controller
{
     public function index()
    {
        $userPannes = Panne::where('user_id', Auth::id())->paginate(7);
        return view('role.admin.panne', compact('userPannes'));
        
    } //end method

}
