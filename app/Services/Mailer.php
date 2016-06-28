<?php namespace Admin\Services;

use Mail;

/**
 * A service class to send email
 *
 * @author gab
 * @package Admin\Services
 */
class Mailer
{
    /**
     * Send mail to guest for password reset
     *
     * @param string $view
     * @param string $subject
     * @param array $data
     * @param array $opt
     * @return void
     */
    public function send($view, $subject, $data, $opt = array())
    {
        $sendMail = Mail::send($view, ['data' => $data], function ($message) use ($data, $subject) {
            $message->from('gabriel@bilinear.ph', 'Blurbby')->subject($subject);
            $message->to($data['email'], 'Blurburry Admin')->subject($subject);
        });

        return $sendMail;
    }
}
