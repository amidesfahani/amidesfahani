<?php

namespace App\Nova\Files;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FitOptimizedImages
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
			$filepath = $storagePath . '/' . $filename . '.webp';

			File::ensureDirectoryExists(Storage::disk($disk)->path($storagePath));

			$image = Image::make($classifiedImg)->encode('webp');
			$height = $image->height();
			$width = $image->width();
			if ($height > $width) {
				$width = $height;
			}
			else
			if ($height < $width) {
				$height = $width;
			}

			if ($width > 1280) {
				$width = $height = 1280;
			}

			$image->fit($height, $height, function ($constraint) {
				$constraint->upsize();
			});
			$image->save(Storage::disk($disk)->path($filepath));

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