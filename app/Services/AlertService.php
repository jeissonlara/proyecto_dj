<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class AlertService
{
    /**
     * Flash a success message.
     *
     * @param string $title
     * @param string $message
     * @return void
     */
    public static function success(string $title, string $message): void
    {
        self::flash('success', $title, $message);
    }

    /**
     * Flash a warning message.
     *
     * @param string $title
     * @param string $message
     * @return void
     */
    public static function warning(string $title, string $message): void
    {
        self::flash('warning', $title, $message);
    }

    /**
     * Flash an error message.
     *
     * @param string $title
     * @param string $message
     * @return void
     */
    public static function error(string $title, string $message): void
    {
        self::flash('error', $title, $message);
    }

    /**
     * Flash an info message.
     *
     * @param string $title
     * @param string $message
     * @return void
     */
    public static function info(string $title, string $message): void
    {
        self::flash('info', $title, $message);
    }

    /**
     * Internal method to store the flash data in session.
     *
     * @param string $type
     * @param string $title
     * @param string $message
     * @return void
     */
    private static function flash(string $type, string $title, string $message): void
    {
        Session::flash('alert', [
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ]);
    }
}
