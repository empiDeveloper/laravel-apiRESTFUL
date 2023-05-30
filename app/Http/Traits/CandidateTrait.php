<?php

namespace App\Http\Traits;

use App\Models\Candidate;
use Illuminate\Support\Facades\Cache;

class CandidateTrait {

    public static function getCandidatesCache()
    {
        try {
            if (!Cache::has('candidates')) {
                self::putCandidatesCache();
            }

            $response = self::getCandidates();

            if ($response->count() < 1) {
                self::putCandidatesCache();
                $response = self::getCandidates();
            }

            return $response;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public static function getCandidates()
    {
        try {
            $response = Cache::get('candidates', json_encode([]));
            return collect(json_decode($response));
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function putCandidatesCache()
    {
        try {
            $data = Candidate::orderBy('name', 'ASC')->get();
            $response = Cache::put('candidates', json_encode($data), now()->addDay());

            if (!$response) throw new \Exception('Ocurrio un error al intentar guardar data en cache');

            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
