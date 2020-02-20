<?php

if (!function_exists('create_token')) {
    /**
     * Create token.
     *
     * @param integer $lenght
     * @return string
     */
    function create_token($length = 40)
    {
        return str_random($length);
    }
}

if (!function_exists('locale')) {
    /**
     * Get the active locale.
     *
     * @return string
     */
    function locale()
    {
        return config('app.locale') ?? config('app.fallback_locale');
    }
}

if (!function_exists('is_guest')) {
    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    function is_guest()
    {
        return auth()->guest();
    }
}

if (!function_exists('is_logged_in')) {
    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    function is_logged_in()
    {
        return auth()->check();
    }
}

if (!function_exists('user')) {
    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user($guard = null)
    {
        $guard = $guard ?: config('auth.defaults.guard');

        return auth($guard)->user();
    }
}

if (!function_exists('is_current_user')) {
    /**
     * Check the currently authenticated user.
     *
     * @return bool
     */
    function is_current_user($id, $guard = null)
    {
        $guard = $guard ?: config('auth.defaults.guard');

        return auth($guard)->user()->id == $id;
    }
}

if (!function_exists('csv_to_array')) {
    /**
     * Convert csv to array.
     *
     * @param string $fileName
     * @param string $delimiter
     * @return array
     */
    function csv_to_array($fileName = '', $delimiter = ',')
    {
        if (!file_exists($fileName) || !is_readable($fileName)) {
            return false;
        }

        $header = null;
        $data = [];

        if (($handle = fopen($fileName, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }

            fclose($handle);
        }

        return $data;
    }
}

if (!function_exists('distance_geo_points')) {
    /**
     * Get distance from two location.
     *
     * @param double $lat1
     * @param double $lng1
     * @param double $lat2
     * @param double $lng2
     * @return double
     */
    function distance_geo_points($lat1, $lng1, $lat2, $lng2)
    {
        return 6378.10 * ACOS(COS(deg2rad($lat1))
             * COS(deg2rad($lat2))
             * COS(deg2rad($lng1) - deg2rad($lng2))
             + SIN(deg2rad($lat1))
             * SIN(deg2rad($lat2)));
    }
}

if (!function_exists('update_fields_unnormalized')) {
    /**
     * Update fields unnormalized.
     *
     * @param string $string
     * @param string $value
     * @return string
     */
    function update_fields_unnormalized($string, $value)
    {
        if (!$string) {
            return $value;
        }

        $arr = explode(',', $string);

        if (in_array($value, $arr)) {
            $arr = array_diff($arr, [$value]);
        }

        $arr[count($arr) + 1] = $value;

        return implode(',', $arr);
    }
}

if (!function_exists('remove_fields_unnormalized')) {
    /**
     * Remove item fields unnormalized.
     *
     * @param string $string
     * @param string $value
     * @return string
     */
    function remove_fields_unnormalized($string, $value)
    {
        $arr = explode(',', $string);

        if (in_array($value, $arr)) {
            $arr = array_diff($arr, [$value]);
        }

        return implode(',', $arr);
    }
}

if (!function_exists('http_status_text')) {
    /**
     * Get text of http status code.
     *
     * @param integer $code
     * @return string
     */
    function http_status_text($code = null)
    {
        return trans('httpstatus.' . $code);
    }
}

if (!function_exists('string_to_int')) {
    /**
     * Smart convert string to int.
     *
     * @param string $value
     * @return int
     */
    function string_to_int($value)
    {
        $cleaned = preg_replace('#[^0-9-+.,]#', '', $value);
        preg_match('#[-+]?[\d]+#', $cleaned, $matches);
        $result = $matches[0] ?? 0;

        return (int) $result;
    }
}

if (!function_exists('generate_filename')) {
    /**
     * Generate a unique filename
     *
     * @param string $value
     * @return string the unique name of the file
     */
    function generate_filename($extension)
    {
        return time() . '-' . str_random(10) . '.' . $extension;
    }
}

if (!function_exists('guess_mime_type')) {
    /**
     * Smart convert string to int.
     *
     * @param string $value
     * @return int
     */
    function guess_mime_type($extension)
    {
        $mimes = config('constants.mimes');
        return isset($mimes[$extension]) ? $mimes[$extension] : null;
    }
}

if (!function_exists('get_upload_folder')) {
    /**
     * get the upload folder for file
     *
     * @param string $value
     * @return int
     */
    function get_upload_folder($extension)
    {
        if (is_image($extension)) {
            return config('constants.image_upload_folder');
        }
        if (is_video($extension)) {
            return config('constants.video_upload_folder');
        }
        if (is_audio($extension)) {
            return config('constants.audio_upload_folder');
        }
        return config('constants.other_upload_folder');
    }
}

if (!function_exists('is_image')) {
    /**
     * check a file is image.
     *
     * @param string $extension
     * @return boolean
     */
    function is_image($extension)
    {
        if (in_array($extension, config('constants.image_file_extensions'))) {
            return true;
        }
        return false;
    }
}

if (!function_exists('is_audio')) {
    /**
     * check a file is audio.
     *
     * @param string $extension
     * @return boolean
     */
    function is_audio($extension)
    {
        if (in_array($extension, config('constants.audio_file_extensions'))) {
            return true;
        }
        return false;
    }
}

if (!function_exists('is_video')) {
    /**
     * check a file is video.
     *
     * @param string $extension
     * @return boolean
     */
    function is_video($extension)
    {
        if (in_array($extension, config('constants.video_file_extensions'))) {
            return true;
        }
        return false;
    }
}

if (!function_exists('get_file_type')) {
    /**
     * get the upload folder for file
     *
     * @param string $value
     * @return int
     */
    function get_file_type($extension)
    {
        $fileTypeExtension = empty(config('constants.file_type_extensions')[$extension]) ? null : config('constants.file_type_extensions')[$extension];
        if (empty($fileTypeExtension)) {
            return -1;
        }
        return config("constants.file_type.$fileTypeExtension");
    }
}

if (!function_exists('random_password')) {
    /**
     * get the upload folder for file
     *
     * @return string
     */
    function random_password()
    {
        return substr(uniqid(),0,8);
    }
}

if (!function_exists('format_date')) {
    /**
     * get the upload folder for file
     * 
     * @param \DateTime $date
     * @param String $format
     * 
     * @return string
     */
    function format_date($date, $format = 'Y-m-d')
    {
        return $date->format($format);
    }
}
