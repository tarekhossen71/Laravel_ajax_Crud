<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'email_verify'])->except('index');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile(){
        return view('profile');
    }

    public function upload(Request $request){
        if ($request->hasFile('avater')) {
            // Previous File Delete 
            Storage::disk('public')->delete('profile/'.auth()->user()->avater);

            // File Upload 
            $profile_name = $request->avater->getClientOriginalName();
            $request->avater->storeAs('profile', $profile_name,'public');

            // Update Database
            auth()->user()->update([
                'avater' => $profile_name,
            ]);
        }
        return back();
    }
}
