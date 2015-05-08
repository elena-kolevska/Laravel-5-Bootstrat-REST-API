<?php

namespace App\DataTransformers;


abstract class DataTransformer {

    /**
     * Transform a collection
     *
     * @param $items
     * @param $method
     * @return array
     */
    public function transformCollection($items, $method = 'transform')
    {
        return array_map([$this, $method], $items);
    }


    public abstract function transform($item);



}