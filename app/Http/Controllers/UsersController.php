<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => Users::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

     /**
     * Display the registration view.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
         $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Users::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $user = Users::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'suffixname' => 'Mr',
            'username' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('info', 'New User created');

       
    }
    public function edit($id)
    {   $record = Users::find($id); 
        return view('users.edit', ['users' => $record, 'id' => $id]);

       
    }

    public function update(Request $request): RedirectResponse
    {
         $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);
        $users = Users::find($request->input('user_id'));
        $users->firstname = $request->input('firstname');
        $users->lastname = $request->input('lastname');
        $users->username = $request->input('email');
        $users->email = $request->input('email');
        $users->save();

        return redirect()->route('users.index')->with('info', 'New User updated successfully');

       
    }

    public function destroy($id)
    {
        // Find the record you want to delete
        $record = Users::find($id); 

        if ($record) {
            $record->delete();
            return redirect()->route('users.index')->with('info', 'User deleted successfully');
        }
    }

    public function trashed()
    {
        /*return view('users.trashed', [
            'users' => Users::withTrashed()->get()
        ]);
        */
    }
}
