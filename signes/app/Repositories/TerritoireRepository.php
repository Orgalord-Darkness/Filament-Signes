<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class TerritoireRepository extends RefCDVORepository
{
    /**
     * Récupération de la liste des Territoires de RefCDVO
     *
     * @return array
     */
    public function getTerritoires()
    {
        try {
            return Cache::remember('territoires', 30, function () {
                $response = $this->apiClient->request('GET','api/territoires?all');
                $data = json_decode($response->getBody()->getContents(), true);

                return collect($data['data']);
            });
        } catch (\Exception $e) {
            Log::channel('apiClient')->error($e->getMessage());
            return collect([]);
        }
    }
}
