<?php

use PHPUnit\Framework\TestCase;
use App\Utils\Validator;

class ValidationTest extends TestCase
{
    public function testNameIsRequired(): void
    {
        $mockRequest = [
            'name' => ''
        ];

        $validator = new Validator($mockRequest);

        $violations = $validator->validate(
            [
                'name' => [ 'required' ]
            ]
        );

        $this->assertEquals([ 'name' => [ "Name is required" ] ], $violations);
    }

    public function testEmailIsRequired(): void
    {
        $mockRequest = [
            'email' => ''
        ];

        $validator = new Validator($mockRequest);

        $violations = $validator->validate(
            [
                'email' => [ 'required' ]
            ]
        );

        $this->assertEquals([ 'email' => [ "Email is required" ] ], $violations);
    }

    public function testEmailMustBeValid(): void
    {
        $mockRequest = [
            'email' => 'mail.com'
        ];

        $validator = new Validator($mockRequest);

        $violations = $validator->validate(
            [
                'email' => [ 'email' ]
            ]
        );

        $this->assertEquals([ 'email' => [ "Invalid e-mail address" ] ], $violations);
    }

    public function testPasswordIsRequired(): void
    {
        $mockRequest = [
            'password' => ''
        ];

        $validator = new Validator($mockRequest);

        $violations = $validator->validate(
            [
                'password' => [ 'required' ]
            ]
        );

        $this->assertEquals([ 'password' => [ "Password is required" ] ], $violations);
    }

    public function testMinimumSizeRuleIsEnforced(): void
    {
        $mockRequest = [
            'name' => 'Tony'
        ];

        $validator = new Validator($mockRequest);

        $violations = $validator->validate(
            [
                'name' => [ 'min:5' ]
            ]
        );

        $this->assertEquals([ 'name' => [ "Name needs to be at least 5 characters long" ] ], $violations);
    }

    public function testMaximumSizeRuleIsEnforced(): void
    {
        $mockRequest = [
            'name' => 'Tony Soprano'
        ];

        $validator = new Validator($mockRequest);

        $violations = $validator->validate(
            [
                'name' => [ 'max:10' ]
            ]
        );

        $this->assertEquals([ 'name' => [ "Name needs to be no longer than 10 characters" ] ], $violations);
    }
}
