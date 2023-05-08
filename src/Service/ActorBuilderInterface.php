<?php


namespace App\Service;

interface ActorBuilderInterface
{

    /**
     * @param array $data
     * @return void
     */
    public function build(array $data): void;

}