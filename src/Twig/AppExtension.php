<?php

namespace App\Twig;

use App\Entity\Image;
use App\Service\CacheServiceInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\Environment;
use Doctrine\ORM\PersistentCollection;

class AppExtension extends AbstractExtension
{
    /** @var CacheServiceInterface */
    private $cacheService;

    /** @var Environment */
    private $twig;

    public function __construct(CacheServiceInterface $cacheService, Environment $twig)
    {
        $this->cacheService = $cacheService;
        $this->twig = $twig;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('imageRender', [$this, 'imageRender']),
        ];
    }

    /**
     * @param $images
     * @param $type
     * @return mixed
     */
    public function imageRender(PersistentCollection $images, string $type)
    {

        $cachedImages = [];

        /** @var Image $image */
        foreach ($images as $image) {

            if ($image->getType() != $type) {
                continue;
            }
            $imageContent = $this->cacheService->getCachedImage($image);

            $cachedImages[] = [
                'content' => $imageContent,
                'height' => $image->getHeight(),
                'width' => $image->getWidth(),
            ];

        }

        return $this->twig->render(
            'showcase/image.html.twig',
            [
                'images' => $cachedImages
            ]
        );
    }
}