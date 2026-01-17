<?php

namespace Tests\Unit\Services;

use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ValidationServiceTest extends TestCase
{
    /**
     * Test email validation rule
     * Black box testing: validates email format checking
     */
    public function test_email_validation_accepts_valid_emails()
    {
        $validator = Validator::make(
            ['email' => 'user@example.com'],
            ['email' => 'email']
        );

        $this->assertFalse($validator->fails());
    }

    /**
     * Test email validation rejects invalid emails
     * Black box testing: validates email format rejection
     */
    public function test_email_validation_rejects_invalid_emails()
    {
        $validator = Validator::make(
            ['email' => 'not-an-email'],
            ['email' => 'email']
        );

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->messages());
    }

    /**
     * Test required field validation
     * Black box testing: validates required field enforcement
     */
    public function test_required_field_validation()
    {
        $validator = Validator::make(
            ['name' => ''],
            ['name' => 'required|string']
        );

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('name', $validator->errors()->messages());
    }

    /**
     * Test password confirmation validation
     * Black box testing: validates password matching logic
     */
    public function test_password_confirmation_validation()
    {
        $validator = Validator::make(
            ['password' => 'secret123', 'password_confirmation' => 'secret123'],
            ['password' => 'required|confirmed']
        );

        $this->assertFalse($validator->fails());
    }

    /**
     * Test password confirmation fails on mismatch
     * Black box testing: validates password mismatch detection
     */
    public function test_password_confirmation_validation_fails_on_mismatch()
    {
        $validator = Validator::make(
            ['password' => 'secret123', 'password_confirmation' => 'different123'],
            ['password' => 'required|confirmed']
        );

        $this->assertTrue($validator->fails());
    }

    /**
     * Test min length validation
     * Black box testing: validates minimum length checking
     */
    public function test_string_min_length_validation()
    {
        $validator = Validator::make(
            ['password' => 'pass'],
            ['password' => 'required|min:6']
        );

        $this->assertTrue($validator->fails());
    }

    /**
     * Test max length validation
     * Black box testing: validates maximum length checking
     */
    public function test_string_max_length_validation()
    {
        $validator = Validator::make(
            ['name' => 'This is a very long name that exceeds fifty characters limit'],
            ['name' => 'required|max:50']
        );

        $this->assertTrue($validator->fails());
    }
}
