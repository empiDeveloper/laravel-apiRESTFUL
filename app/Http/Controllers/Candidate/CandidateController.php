<?php

namespace App\Http\Controllers\Candidate;

use Illuminate\Http\Request;
use App\Http\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Services\Candidate\CandidateService;
use App\Http\Requests\Candidate\CandidateCreateRequest;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    public function postCandidate(CandidateCreateRequest $request)
    {
        try {
            $user = auth()->user();
            if (!CandidateService::isUserManager($user->role)) {
                return ResponseTrait::responseError('You are not authorized to perform this action', 401);
            }

            $request['created_by'] = $user->id;
            $response = CandidateService::create($request);

            return ResponseTrait::responseSuccess($response->data, 201);
        } catch(\Exception $e) {
            return ResponseTrait::responseError($e, 500);
        }
    }

    public function getCandidate(Request $request, $id)
    {
        try {
            $request['id'] = $id;
            $validator = Validator::make($request->all(),
                [ 'id' => 'required|exists:candidates,id' ],
                [ 'id.exists' => 'No lead found'],
            );
            if ($validator->fails()) return ResponseTrait::responseError($validator->errors()->first(), 400);

            return CandidateService::getCandidate($id);
        } catch(\Exception $e) {
            return ResponseTrait::responseError($e, 500);
        }
    }

    public function getCandidates()
    {
        try {
            return CandidateService::getCandidates();
        } catch(\Exception $e) {
            return ResponseTrait::responseError($e, 500);
        }
    }
}
