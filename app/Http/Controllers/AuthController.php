<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:12|confirmed',
        ]);
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('login')->with('success', 'You have been registered successfully');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $userCread = $request->only('email', 'password');

            if (Auth::attempt($userCread)) {
                if (Auth::user()->role == 0) {
                    return redirect()->route('user.home');
                } else if (Auth::user()->role == 1) {
                    return redirect()->route('admin.home');
                } else {
                    return redirect('/')->with('error', 'Invalid email or password');
                }
            } else {
                return redirect('/login')->with('error', 'Invalid email or password');
            }
        } catch (Throwable $th) {
            return redirect('/login')->with('error', $th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }

    public function forgotPassword()
    {
        return view('auth.forgotPassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (count($user) > 0) {
            $token = Str::random(40);
            $domain = URL::to('/');
            $url = $domain . '/reset/password?token=' . $token;

            $data['url'] = $url;
            $data['email'] = $request->email;
            $data['title'] = 'Password Reset';
            $data['body'] = 'Please click on the link below to reset your password';
            //Mail::to($request->email)->send(new SendMail($data));
            $passwordReset = new PasswordReset();
            $passwordReset->email = $request->email;
            $passwordReset->token = $token;
            $passwordReset->user_id = $user->id;
            $passwordReset->save();
            return redirect()->route('login')->with('success', 'Password reset link sent to your email');
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function resetPassword($token)
    {
        $resetPassword = PasswordReset::where('token', $token)->get();
        if (isset($token) && count($resetPassword) > 0) {
            $user = User::where('id', $resetPassword->user_id)->get();
            foreach ($user as $user_data) {
            }
            return view('auth.resetPassword', compact('user_data'));
        } else {
            return view('404');
        }
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:12|confirmed',
        ]);
        try {
            $user = User::find($request->user_id);
            $user->password = Hash::make($request->password);
            $user->save();

            PasswordReset::where('email', $user->email)->delete();

            return redirect()->route('login')->with('success', 'Password reset successfully');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
