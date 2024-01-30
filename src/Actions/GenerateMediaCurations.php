<?php

namespace Hup234design\FilamentCms\Actions;

use Hup234design\FilamentCms\Models\CmsMedia;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GenerateMediaCurations
{
    public static function execute($mediaId)
    {
        $media = CmsMedia::find($mediaId);

        if (!$media) {
            return; // or handle the error as you prefer
        }

        if( $media->width == 0 || $media->height == 0) {
            return;
        }

        $currentAspectRatio = $media->width / $media->height;

        $originalPath = $media->path;  // Relative to the "storage/app" directory

        $curations = [];

        foreach (config("curator.curation_presets") as $curation_preset)
        {
            $preset = app($curation_preset);
            if( ! $media->hasCuration($preset->getKey()) ) {
                try {
                    $desiredAspectRatio = $preset->getWidth() / $preset->getHeight();

                    if ($currentAspectRatio > $desiredAspectRatio) {
                        $newWidth = (int) floor($media->height * $desiredAspectRatio);
                        $newHeight = $media->height;
                    } else {
                        // Image is too tall, adjust height
                        $newWidth = $media->width;
                        $newHeight = (int) floor($media->width / $desiredAspectRatio);
                    }

                    $cropWidth = $newWidth;
                    $cropHeight = $newHeight;

                    $x = max(0, floor(($media->width - $cropWidth) / 2));
                    $y = max(0, floor(($media->height - $cropHeight) / 2));

                    $curationPath = $media->directory . '/' . $media->name . '/' . $preset->getKey() . '.' . $media->ext;

                    Storage::disk($media->disk)->copy($originalPath, $curationPath);

                    $imagePath = Storage::disk('public')->path($curationPath);

                    $image = Image::make($imagePath);

                    $image->crop($cropWidth, $cropHeight, $x, $y)
                        ->resize($preset->getWidth(), $preset->getHeight())
                        ->encode($preset->getFormat() ?? 'jpg', $preset->getQuality() ?? 60);

                    // save image to directory base on media
                    Storage::disk($media->disk)->put($curationPath, $image->stream());

                    $curations[] = [
                        'curation' => [
                            'key' => $preset->getKey(),
                            'disk' => $media->disk,
                            'directory' => $media->name,
                            'visibility' => $media->visibility,
                            'name' => $preset->getKey() . '.' . $media->ext,
                            'path' => $curationPath,
                            'width' => $preset->getWidth(),
                            'height' => $preset->getHeight(),
                            'size' => $image->filesize(),
                            'type' => $image->mime(),
                            'ext' => $preset->getFormat() ?? 'jpg',
                            'url' => Storage::disk($media->disk)->url($curationPath),
                        ]
                    ];

                } catch (\Exception $error) {
                    //
                }
            }

        }

        $media->updateQuietly(['curations' => array_merge($media->curations ?? [], $curations)]);
    }
}
