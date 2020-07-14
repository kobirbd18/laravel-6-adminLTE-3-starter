<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest:admin');
    }

    protected function broker() {
        return Password::broker('admins');
    }

    public function showLinkRequestForm() {
        return view('admin.passwords.forgot');
    }

    protected function validateEmail(Request $request) {
        $messages = [
            'email.required' => 'The Email field is required.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
        ];
        $request->validate([
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha',
        ], $messages);
    }
}
