<?php

namespace App\Common;

use Carbon\Carbon;
use Exception;
use Log;
use Mail;
use Storage;

class Util
{
    public static function sendEmail($view, $fields, $email, $subject)
    {
        try {
            return Mail::send($view, $fields, function ($message) use ($email, $subject) {
                $message->from(config('mail.from.address'));
                $message->to($email)->subject($subject);
            });
        } catch (Exception $exception) {
            Log::error('Send Mail Error: ' . $exception->getMessage());
        }
    }

    public static function uploadFile($file, $path = '', $disk = 'public', $fileName = null)
    {
        if (!$fileName) {
            $fileType = explode('.', $file->getClientOriginalName());
            $fileType = strtolower(array_pop($fileType));
            $fileName = Carbon::now()->format('YmdHs') . uniqid() . '.' . $fileType;
        }

        Storage::disk($disk)->put($path . $fileName, file_get_contents($file));

        return $fileName;
    }

    public static function formatDatetime($datetime, $format = 'Y-m-d H:i:s')
    {
        return Carbon::parse($datetime)->format($format);
    }

    public static function checkDeviceAndroid()
    {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (stripos($userAgent, 'android') !== false) {
            return true;
        }

        return false;
    }

    public static function checkDeviceIos()
    {
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        if (stripos($userAgent, 'ipod') !== false || stripos($userAgent, 'iphone') !== false || stripos($userAgent, 'ipad') !== false) {
            return true;
        }

        return false;
    }

    public static function getFileAbsolutePath($path, $defaultPath = null)
    {
        if (file_exists(public_path() . '/' . $path)) {
            return asset($path);
        }

        return $defaultPath ? asset($defaultPath) : '';
    }
}
