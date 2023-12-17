<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/logout');
    }

    public function AdminLogoutPage() {
        return view('admin.admin_logout');
    }

    public function AdminProfile() {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        
        return view('admin.admin_profile_view', compact('adminData'));
    }
}