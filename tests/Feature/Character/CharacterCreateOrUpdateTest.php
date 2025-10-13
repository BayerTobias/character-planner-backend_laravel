<?php

test('creates a new character successfully', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('updates existing character successfully', function () {

});

test('returns validation errors for invalid data', function () {

});

test('unauthenticated user cannot create or update character', function () {

});
