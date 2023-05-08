<?php

namespace App\Service;


interface ImageImportServiceInterface
{

   /**
 * @param string $source
 * @param int $batchSize
 * @return void
 */
    public function import(string $source, int $batchSize): void;

}
