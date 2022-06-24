<?php

namespace App\Nova\Files;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class OptimizeImages
{
    /**
     * Store the incoming file upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $attribute
     * @param  string  $requestAttribute
     * @param  string  $disk
     * @param  string  $storagePath
     * @return array
     */
    public function __invoke(Request $request, $model, $attribute, $requestAttribute, $disk, $storagePath)
    {
		if ($request->hasFile($attribute)) {
			$classifiedImg = $request->file($attribute);
			$filename = sha1(uniqid());

			File::ensureDirectoryExists(Storage::disk($disk)->path($storagePath));

			if($request->file($attribute)->extension() == 'svg')
			{
				return $request->file($attribute)->store($storagePath, $disk);
			}

			$filepath = $storagePath . '/' . $filename . '.webp';

			Image::make($classifiedImg)->encode('webp')->save(Storage::disk($disk)->path($filepath));

			if ($model->{$attribute})
			{
				if (Storage::disk($disk)->exists($model->{$attribute}))
				{
					Storage::disk($disk)->delete($model->{$attribute});
				}
			}

			return $filepath;
		}
    }
}