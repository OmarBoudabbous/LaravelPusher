<?php

namespace App\Http\Controllers;

use App\Models\Panne;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(5, ['*'], 'users_page');
        $pannes = Panne::orderBy('id', 'desc')->paginate(5, ['*'], 'pannes_page');
        return view('role.admin.dashboard', compact('users', 'pannes'));
    } //end method

    public function logoutAdmin(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function getChefData($id)
    {
        $users = User::orderBy('id', 'desc')->paginate(9, ['*'], 'users_page');

        $user = User::find($id);
        // Check if the user exists
        if (!$user) {
            // If the car is not found, redirect or show an error page
            return redirect()->route('admin.index')->with('error', 'User not found!');
        }


        // Pass the user data to the view
        return view('role.admin.user-by-id', compact('user'));
    }

    public function viewForAjouterChef()
    {
        $users = User::where('id', '!=', Auth::id())->orderBy('id', 'desc')->paginate(4, ['*'], 'users_page');
        return view('role.admin.ajouter-chef', ['users' => $users]);
    }

    public function ajouterChef(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'matricule' => 'required|digits:6|unique:users,matricule',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'matricule' => $request->matricule,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Session::flash('message', $user->role . ' ajouté avec succès!');
        Session::flash('alert-type', 'success');        

        return redirect()->back();
    }
}
