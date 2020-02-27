<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Helper
{
    /*
    * this function is used for showing active route
    * @return menu-open
    */
    public static function menuIsOpen($routeNames)
    {
        $currentRoute = Route::currentRouteName();

        if (in_array($currentRoute, $routeNames)) {
            return 'menu-open';
        }
    }
    /*
    * this function is used for showing active route
    * @return ACTIVE
    */
    public static function menuIsActive($routeNames)
    {
        $currentRoute = Route::currentRouteName();

        if (in_array($currentRoute, $routeNames)) {
            return 'active';
        }
    }


    /*
    * this function is used for showing the status label
    * @return ACTIVE_STATUSES
    */

    public static function activeStatusLabel($activeStatus)
    {
        if ($activeStatus == 1) {
            return '<span class="badge badge-success">' . Config::get('constants.ACTIVE_STATUSES')[$activeStatus] . '</span>';
        } else if ($activeStatus == 0) {
            return '<span class="badge badge-warning">' . Config::get('constants.ACTIVE_STATUSES')[$activeStatus] . '</span>';
        } else {
            return '<span class="badge badge-default">No</span>';
        }
    }


    /*
    * this function will Upload any file to S3 or local disk
    * pass file or base64sting
    * pass destination folderPath with slash added in last
    * if fileName not provided , ans automatic file name will be generated with segmented folder with year & month
    * @return string Image Name With Segmented Folder
    */

    public static function uploadFile($file = null, $base64string = null, $destinationPath, $fileName = null, $disk = null)
    {
        if (!$disk) {
            $disk = env('DISK_TYPE');
        }
        if (!$fileName) {
            if ($file) {
                $fileName = Carbon::now()->format('Y') . '/' . Carbon::now()->format('m') . '/' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            } else {
                $fileName = Carbon::now()->format('Y') . '/' . Carbon::now()->format('m') . '/' . uniqid() . '_' . time() . '.jpg';
            }
        }

        if ($file) {
            $imagePath = Storage::disk($disk)->putFileAs($destinationPath, $file, $fileName, 'public');

            return $imagePath;
        } elseif ($base64string) {
            $imagePath = Storage::disk($disk)->put($destinationPath . '/' . $fileName, $base64string, 'public');

            return $fileName;
        } else {
            return null;
        }
    }
    //This return the real path of an asset
    public static function storagePath($filePath)
    {
        return env('CDN_URL') . '/' . $filePath;
    }


    //end class
}
