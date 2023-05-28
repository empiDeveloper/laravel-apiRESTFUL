<?php

use Illuminate\Support\Facades\Route;

Route::middleware('jwt.verify')->namespace('Candidate')->group( function() {
    $controller = "CandidateController";

    Route::post('/lead', "$controller@postCandidate")->name('lead.create');
    Route::get('/lead/{id}', "$controller@getCandidate")->name('lead.listOnly');
    Route::get('/leads', "$controller@getCandidates")->name('lead.listAll');
});
