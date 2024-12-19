<?php

test('new users can register', function () {
    $response = $this->post('/api/register', [
        'station_id' => null,
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'phone' => '1234567890',
        'card_id' => '00001',
        'tank_count' => 8,
    ]);

    $responseData = $response->json();

    expect($responseData)->toHaveKeys(['message', 'data']);
});
