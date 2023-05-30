<?php
namespace App\Http\Services\Candidate;

use App\Models\Candidate;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\CandidateTrait;

class CandidateService {

    public static function create($request)
    {
        try {
            return DB::transaction( function() use($request) {
                $model = new Candidate();
                $model->name = $request->name;
                $model->source = $request->source;
                $model->owner = $request->owner;
                $model->created_by = $request->created_by;
                $model->save();

                return (object)[
                    'success' => true,
                    'data' => [
                        'id' => $model->id,
                        'name' => $model->name,
                        'source' => $model->source,
                        'owner' => $model->owner,
                        'created_at' => $model->created_at,
                        'created_by' => $model->created_by,
                    ]
                ];
            },2);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function isUserManager($role) :bool
    {
        try {
            return $role === "manager" ? true : false;
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function getCandidate($id)
    {
        try {
            $data = CandidateTrait::getCandidatesCache();
            $response = $data->where('id', $id)->first();

            return ResponseTrait::responseSuccess($response, 200);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function getCandidates()
    {
        try {
            $user = auth()->user();
            CandidateTrait::putCandidatesCache();

            if ($user->role === 'manager') {
                $response = self::allCandidates();
            } else {
                $response = self::candidatesOwner($user->id);
            }

            return ResponseTrait::responseSuccess($response->data ?? [], 200);
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function allCandidates()
    {
        try {
            $response = CandidateTrait::getCandidatesCache();
            return (object)[
                'success' => true,
                'data' => $response,
            ];
        } catch(\Exception $e) {
            throw $e;
        }
    }

    public static function candidatesOwner($idOwner)
    {
        try {
            $data = CandidateTrait::getCandidatesCache();
            $response = $data->where('owner', $idOwner)->values();

            return (object)[
                'success' => true,
                'data' => $response,
            ];
        } catch(\Exception $e) {
            throw $e;
        }
    }
}
