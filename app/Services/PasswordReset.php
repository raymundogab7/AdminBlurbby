<?php namespace Admin\Services;

/**
 * A service class to generate new password.
 *
 * @author gab
 * @package Admin\Services
 */
class PasswordReset
{

    /**
     * Generate temporary password.
     *
     * @return string
     */
    public function generate_temporary_password()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZzxcvbnmasdfghjklqwertyuiop';
        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(100, 9999) . mt_rand(100, 9999) . $characters[rand(0, strlen($characters) - 1)];
        // shuffle the result
        return str_shuffle($pin);
    }
}
