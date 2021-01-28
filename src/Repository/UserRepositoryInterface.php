<?php
declare(strict_types = 1);

namespace App\Repository;


use App\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function all(array $criteria = [], array $orderBy = null, $limit = null, $offset = null): array;

    /**
     * @param int $id
     * @return User
     */
    public function one(int $id): User;

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User;

    /**
     * @param User $user
     * @return User
     */
    public function update(User $user): User;
}