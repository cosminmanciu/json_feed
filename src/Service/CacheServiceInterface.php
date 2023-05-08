<?php


namespace App\Service;

use App\Entity\Image;

interface CacheServiceInterface
{

    /**
     * @param string $url
     * @param string $path
     * @return void
     */
    public function getCachedImage(Image $image);

}
