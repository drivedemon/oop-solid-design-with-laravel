<?php

namespace Tests\Unit\User;

use App\Domain\User\UserDTO;
use App\Domain\User\UserRepository;
use App\Domain\User\UserService;
use App\Models\User;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    protected function getService($repository): UserService
    {
        return new UserService($repository);
    }

    protected function getRepository()
    {
        return $this->createMock(UserRepository::class);
    }

    public function test_update_by_id(): void
    {
        $updateData = ['first_name' => 'test', 'last_name' => 'test2'];
        $user = User::factory()->create();
        $updateUser = User::factory()->make($updateData);

        $repository = $this->getRepository();
        $repository->expects($this->once())
            ->method('updateById')
            ->willReturn($updateUser);

        $dto = new UserDTO($updateData);
        $service = $this->getService($repository);

        $result = $service->updateById($user->uuid, $dto);

        $this->assertInstanceOf(User::class, $result);
        $this->assertSame($updateUser, $result);
    }
}
