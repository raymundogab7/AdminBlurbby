<?php

namespace Admin\Http\Controllers\Auth;

use Admin\Http\Controllers\Controller;
use Admin\Repositories\Interfaces\AdminInterface;
use Admin\Services\Mailer;
use Admin\Services\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
     */

    use ResetsPasswords;

    /**
     * @var AdminInterface
     */
    protected $admin;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(AdminInterface $admin)
    {
        $this->admin = $admin;
        $this->middleware('guest');
    }

    /**
     * Display reset password page
     *
     * @return View
     */
    public function index()
    {
        return view('auth.passwords.email');
    }

    /**
     * Reset user password.
     *
     * @return View
     */
    public function reset(Request $request, PasswordReset $passwordReset, Mailer $mailer)
    {
        $temp_password = $passwordReset->generate_temporary_password();

        if ($this->admin->updateByAttributes(['email' => $request->email], ['password' => bcrypt($temp_password)])) {

            $request->merge(['temp_password' => $temp_password]);

            $mailer->send('auth.emails.password', 'Reset Password', $request->all());

            return redirect('password')
                ->with('message', 'Your request to reset password is successful. Please check your email.');
        }

        return redirect('password')
            ->with('error', "Sorry, we don't have your email in our record.");
    }
}
