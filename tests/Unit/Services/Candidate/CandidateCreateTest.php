<?php

namespace Tests\Unit\Services\Candidate;

use Tests\TestCase;
use App\Http\Services\Candidate\CandidateService;

class CandidateCreateTest extends TestCase
{
    /**
     *  A basic unit test example.
     *
     * @return void
     */
    public function testValidateUserManager() :void
    {
        $response = CandidateService::isUserManager("manager");
        $this->assertEquals(true, $response);
    }
    /**
     *  A basic unit test example.
     *
     * @return void
     */
    public function testCreateCandidate() :void
    {
        $payload = (object)[
            'name' => 'Daniel Oyola',
            'source' => 'Developer',
            'owner' => 1, // El usuario ya debe existir en base de datos.
            'created_by' => 1 // El usuario ya debe existir en base de datos.
        ];

        $response = CandidateService::create($payload);

        $this->assertEquals(true, $response->success);
    }
}
