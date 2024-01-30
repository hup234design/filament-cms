<?php

namespace Hup234design\FilamentCms\Components;

use Awcodes\Curator\Models\Media;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MediaImageRenderer extends Component
{
    protected $media    = null;
    protected $curation = null;
    protected $preset   = null;
    protected $imgClass = "w-full";
    /**
     * Create a new component instance.
     */
    public function __construct(
        Media|int|null $media = null,
        string|null $curation = null,
        string|null $preset = null,
        string|null $imgClass = ""
    )
    {
        if( is_numeric($media) ) {
            $this->media = Media::find($media);
        } else {
            $this->media = $media;
        }

        $this->curation = $curation;

        $this->preset = $this->findPresetByKey($preset);

        $this->imgClass = $imgClass;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('cms::components.media.media-image-renderer', [
            'media' => $this->media,
            'curation' => $this->curation,
            'preset' => $this->preset,
            'imgClass' => $this->imgClass,
        ]);
    }

    private function findPresetByKey($key)
    {
        // Retrieve the array of class names from the configuration
        $classArray = config("curator.curation_presets");

        // Iterate through each class name
        foreach ($classArray as $className) {
            // Instantiate the class
            $classInstance = new $className();

            // Check if the getKey method returns the key we are looking for
            if (method_exists($classInstance, 'getKey') && $classInstance->getKey() === $key) {
                // Return the matching class name
                return $classInstance;
            }
        }

        // Return null or handle the case where no matching class is found
        return null;
    }
}
