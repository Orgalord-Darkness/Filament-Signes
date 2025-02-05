<?php

namespace App\Repositories;

use GuzzleHttp\Client as HttpClient;

class RefCDVORepository {

    /**
     * Appel de l'API RefCDVO
     */
    public function __construct() {
        $this->apiClient = new HttpClient(['base_uri' => config('app.refcdvo')]);
    }
}