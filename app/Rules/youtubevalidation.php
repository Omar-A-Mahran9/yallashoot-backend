<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class youtubevalidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (strpos($value, 'youtube.com') !== false) {
            // Extract the video ID from the YouTube URL
            preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $value, $matches);

            // Check if a valid video ID is found
            return isset($matches[1]);
        }

        return false;
    
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
       
        return __(":attribute ") . __('must be a valid YouTube URL.');
    }
}
