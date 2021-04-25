<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\User;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /**
     * A User unit test.
     *
     * @return void
     */
    public function testUserValidation()
    {

        $userController = $this->createMock(UserController::class);
        $request = new Request();
        $view = $userController->isValid($request);

        $this->assertNull($view);
    }
}
