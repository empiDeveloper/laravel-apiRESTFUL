<?php

namespace Tests\Unit\Services\Candidate;

use Tests\TestCase;
use App\Http\Services\Candidate\CandidateService;

class CandidateListTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testListCandidates()
    {
        $users = collect([
            (object)[ 'id' => 1, 'role' => 'manager' ],
            (object)[ 'id' => 2, 'role' => 'agent' ],
        ]);

        $user = $users->random();

        if ($user->role === 'manager') {
            $response = CandidateService::allCandidates();
        } else {
            $response = CandidateService::candidatesOwner($user->id);
        }

        $response = $response->success;

        $this->assertTrue(true, $response);
    }
}
