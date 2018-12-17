<?php

namespace App\Helpers;


class Helper {
    
    public static function getProfileImage($user)
    {

        if($user->profileImage)
        {
            return '/public/avatar/'.$user->profileImage->path;
        } else {
            return '/public/avatar/default.png';
        }
    }
    
    public static function coverImage($course)
    {

        if($course->image)
        {
            return '/uploads/images/course/'.$course->image;
        } else {
            return '/uploads/images/defaults/cover.jpg';
        }
    }
    
    public static function getPrice($course)
    {
        if(!is_null($course->price) && $course->price > 0){
            
            if(config('settings.currency_symbol_position') == 'front'){
                return config('settings.currency_symbol').$course->price;
            } else {
                return $course->price . config('settings.currency_symbol');
            }
        } else {
            return 'FREE';
        }
    }
    
    public static function getSellingPrice($course)
    {
        if(!is_null($course->price) && $course->price > 0){
            return $course->price;
        } else {
            return null;
        }
    }
    
    
    public static function currency($value)
    {
        if(config('settings.currency_symbol_position') == 'front'){
            return config('settings.currency_symbol').$value;
        } else {
            return $value . config('settings.currency_symbol');
        }
    }
    
    
}