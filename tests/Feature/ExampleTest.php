<?php

it('loads homepage')
    ->get('/')
    ->assertOk();

it('creates a new note', function () {
    $desc = faker()->sentence;
    $note = \App\Note::create([
        'description' => $desc
    ]);

    assertEquals($note->id, \App\Note::first()->id);
});

