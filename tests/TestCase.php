<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Auth;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * @throws ReflectionException
     */
    protected static function getMethod(string $className, string $functionName): ReflectionMethod
    {
        $class = new ReflectionClass($className);

        return $class->getMethod($functionName);
    }

    protected function signIn($user): User
    {
        $this->actingAs($user);

        return $user;
    }

    protected function signOut(): void
    {
        Auth::logout();
    }
}
