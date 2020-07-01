<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Transaction;
use App\User;


class UserDashboardController extends Controller
{
    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $avatar = Auth::user()->avatar;
        $items = Transaction::with([
            'details','travel_package','user'
        ])->where('users_id',$id)->get();

        $details = User::where('id',$id)->first();

        return view('pages.dashboard', [
            'items' => $items,
            'id' => $id,
            'avatars' => $avatar,
            'details' => $details,
        ]);
    }

    public function show($id)
    {
        $item = Transaction::with([
            'details','travel_package','user'
        ])->findOrFail($id);

        return view('pages.detailorder',[
            'item'=> $item
        ]);
    }
}
