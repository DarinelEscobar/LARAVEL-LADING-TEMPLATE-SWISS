<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $section = 1;
        return view('pages.admin', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $section = 2;
        return view('pages.admin', compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $section = 3;
        return view('pages.admin', compact('section', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        $section = 4;
        return view('pages.admin', compact('section', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function dashboard()
    {
        if (!Auth::check()) return redirect()->route('login');
        // Return a minimal admin dashboard view. Previous complex/dashboard Livewire
        // view has been backed up to resources/views/_backup_dashboard/.
        return view('pages.admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
