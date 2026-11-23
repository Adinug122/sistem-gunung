<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CustomerProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('customer.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(CustomerProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        $request->user()->save();

        return Redirect::route('customer.profile.edit')->with('status', 'profile-updated');
    }
}
