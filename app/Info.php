<?php


namespace App;

/**
 * Queue secret key service c
 */
class Info 
{

    protected $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }
}