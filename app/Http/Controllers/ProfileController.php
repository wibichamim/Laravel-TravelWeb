<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit (Request $request) {

        return view('Auth.edit', [
            'user' => $request->user()
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
    $request->user()->update(
        $request->all()
    );

    return redirect()->route('Auth.edit');
    }
}
