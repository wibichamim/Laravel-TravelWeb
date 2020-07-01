<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit($id) {

        $item = User::findOrFail($id);

        return view('pages.edit',[
            'item'=> $item
        ]);
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $data = $request -> all();

        $item=User::findOrFail($id);

        $item->update($data);

        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->getClientOriginalName();
            $this->deleteOldAvatar();
            request()->file('avatar')->storeAs('avatars',$item->id. '/' .$avatar,'public');
            $item->update(['avatar'=>$avatar]);
        }

        return redirect()->route('user-dashboard');
    }

    protected function deleteOldAvatar()
    {
        if (auth()->user()->avatar) {
            Storage::delete('avatars',auth()->user()->id. '/' .auth()->user()->avatar);
        }
    }
}
