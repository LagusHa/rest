<?php
declare(strict_types = 1);

namespace App\Service;


use App\Dto\UserDto;
use App\Entity\User;

/**
 * Interface UserServiceInterface
 * @package App\Service
 */
interface UserServiceInterface
{
    /**
     * @param string $email
     * @param string $password
     * @return User
     */
    public function signUp(string $email, string $password): User;

    /**
     * @param string $email
     * @param string $password
     * @param array $privileges
     * @return User
     */
    public function create(string $email, string $password, array $privileges): User;

    /**
     * @param int $id
     * @param UserDto $userDto
     * @return User
     */
    public function edit(int $id, UserDto $userDto): User;

    /**
     * @param array $order
     * @param int $limit
     * @param int $offset
     * @return User[]
     */
    public function list(array $order, int $limit, int $offset): array;

    /**
     * @param int $id
     * @return User
     */
    public function one(int $id): User;
}