<?php

use Illuminate\Support\Facades\Mail;
use Webkul\Shop\Mail\ContactUs;

use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

it('fails validation when required fields are missing', function () {
    // Act & Assert
    postJson(route('shop.home.contact_us.send_mail'), [])
        ->assertJsonValidationErrorFor('name')
        ->assertJsonValidationErrorFor('email')
        ->assertJsonValidationErrorFor('message')
        ->assertUnprocessable();
});

it('fails validation when email is invalid', function () {
    // Act & Assert
    postJson(route('shop.home.contact_us.send_mail'), [
        'name'    => 'John Doe',
        'email'   => 'invalid-email',
        'message' => 'Hello, this is a test message.',
    ])
        ->assertJsonValidationErrorFor('email')
        ->assertUnprocessable();
});

it('successfully validates and queues the contact email', function () {
    // Arrange
    Mail::fake();

    // Act & Assert
    post(route('shop.home.contact_us.send_mail'), [
        'name'    => 'John Doe',
        'email'   => 'john@example.com',
        'message' => 'Hello, this is a test message.',
    ])
        ->assertRedirect()
        ->assertSessionHas('success', trans('shop::app.home.thanks-for-contact'));

    Mail::assertQueued(ContactUs::class, function ($mail) {
        return $mail->contactUs['name'] === 'John Doe'
            && $mail->contactUs['email'] === 'john@example.com'
            && $mail->contactUs['message'] === 'Hello, this is a test message.';
    });
});
