<?php

namespace App\Service;


class ImageImportService implements ImageImportServiceInterface
{

    /** @var ActorBuilderInterface */
    private $movieBuilder;

    public function __construct(

        ActorBuilderInterface $movieBuilder
    )
    {
        $this->movieBuilder = $movieBuilder;
    }

    public function import(string $source, int $batch = 100): void
    {

        $json = file_get_contents($source);
        $data = json_decode($json, true);

        $data = $data['items'];


        //$batches = array_chunk($data, $batch);
        foreach ($data as  $item) {
            $this->movieBuilder->build($item);
        }

//        foreach ($batches as $batch) {
//
//            foreach ($batch as $data) {
//                $this->movieBuilder->build($data);
//            }
//
//
//        }


    }

}
