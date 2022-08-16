<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function personalIndex()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($user->passport_series) {
            $user->passport_series = Crypt::decryptString($user->passport_series);
        }
        if ($user->passport_number) {
            $user->passport_number = Crypt::decryptString($user->passport_number);
        }
        if ($user->passport_first_name) {
            $user->passport_first_name = Crypt::decryptString($user->passport_first_name);
        }
        if ($user->passport_second_name) {
            $user->passport_second_name = Crypt::decryptString($user->passport_second_name);
        }
        if ($user->passport_third_name) {
            $user->passport_third_name = Crypt::decryptString($user->passport_third_name);
        }
        if ($user->passport_place_issue) {
            $user->passport_place_issue = Crypt::decryptString($user->passport_place_issue);
        }
        if ($user->passport_code_issue) {
            $user->passport_code_issue = Crypt::decryptString($user->passport_code_issue);
        }
        if ($user->passport_birth_place) {
            $user->passport_birth_place = Crypt::decryptString($user->passport_birth_place);
        }
        if ($user->passport_registration) {
            $user->passport_registration = Crypt::decryptString($user->passport_registration);
        }
        if ($user->passport_sex) {
            $user->passport_sex = Crypt::decryptString($user->passport_sex);
        }

        return view(
            'personal',
            [
                'user' => $user,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User                $user
     *
     * @return \Illuminate\Http\Response
     */
    public function personalUpdate(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->updateEncrypted($user, $request->all());

        return redirect()->route('personal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
