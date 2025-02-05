<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CommuneRepository extends RefCDVORepository
{
    /**
     * Récupération de la liste des Communes de RefCDVO
     *
     * @return array
     */
    public function getCommunes()
    {
        try {
            return Cache::remember('communes', 30, function () {
                $response = $this->apiClient->request('GET','api/communes?all');
                $data = json_decode($response->getBody()->getContents(), true);

                return collect($data['data'])->sortBy('libelle');
            });
        } catch (\Exception $e) {
            Log::channel('apiClient')->error($e->getMessage());
            return collect([]);
        }
    }
}
