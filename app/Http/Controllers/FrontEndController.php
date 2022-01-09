<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estate;
use App\Accrequest;
use App\Letter;
use App\Comment;
use App\Payment;
use Auth;
use Session;

class FrontEndController extends Controller
{
    //
    public function index()
    {
        if (!Auth::id()) {
            return view('welcome');
        }
        return redirect()->route('dashboard');
    }

    public function guest()
    {
        return redirect()->route('estate.search');
    }

    public function singlehouse($id)
    {

        $house = Estate::findOrFail($id);
        $requests = $house->accrequests()->latest()->get();
        $letters = $house->letters()->latest()->get();
        $comments = $house->comments()->latest()->get();
        return view('frontend.singlehouse')
        ->with('house', $house)
        ->with('requests', $requests)
        ->with('letters', $letters)
        ->with('comments', $comments)
        ->with('payments', $house->payments)
        ->with('credits', $house->credits);
    }

    public function create()
    {
        if (!Auth::id()) {
            Session::flash('warning', 'Sorry! You need to be logged in to comment');
            return redirect()->route('login');
        }
    }
}
