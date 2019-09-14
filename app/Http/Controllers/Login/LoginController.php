<?php

namespace App\Http\Controllers\Login;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("login.login");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "email"    => "required|email",
            "password" => "required",
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only(["email", "password"]);

        if (auth()->attempt($credentials))
        {
            if (auth()->user()->email_verified_at == null)
            {
                $this->setErrorMessage("Your account is not activated.");
                return redirect()->route("login");
            }
            elseif (auth()->check() && auth()->user()->role == 1)
            {
                return redirect()->route("admin.dashboard");
            }
            else
            {
                if (Cart::count() > 0)
                {
                    return redirect()->route("checkout");
                }
                else
                {
                    return redirect()->route("/");
                }
            }
        } else
        {
            $this->setErrorMessage("Email or password is wrong. Please try again");
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route("/");
    }
}
