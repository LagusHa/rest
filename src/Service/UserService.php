<?php
declare(strict_types = 1);

namespace App\Service;


use App\Dto\UserDto;
use App\Entity\User;
use App\Repository\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param string $email
     * @param string $password
     * @return User
     */
    public function signUp(string $email, string $password): User
    {
        $this->emailIsAvailable($email);
        $user = User::singUp($email, $password);
        $this->userRepository->save($user);
        return $user;
    }

    /**
     * @param string $email
     * @param string $password
     * @param array $privileges
     * @return User
     */
    public function create(string $email, string $password, array $privileges): User
    {
        $this->emailIsAvailable($email);
        $user = User::createFromAdmin($email, $password, $privileges);
        $this->userRepository->save($user);
        return $user;
    }


    /**
     * @param int $id
     * @param UserDto $userDto
     * @return User
     */
    public function edit(int $id, UserDto $userDto): User
    {
        $user = $this->userRepository->one($id);

        $user->getPrivileges()->fromArray($userDto->privileges);
        $user->setLastName($userDto->lastName);
        $user->setMiddleName($userDto->middleName);
        $user->setFirstName($userDto->firstName);
        $user->setAge($userDto->age);
        $user->setPhone($userDto->phone);
        $user->setEmploy($userDto->employ);

        $this->userRepository->update($user);
        return $user;
    }

    /**
     * @param array $order
     * @param int $limit
     * @param int $offset
     * @return User[]
     */
    public function list(array $order, int $limit, int $offset): array
    {
        return $this->userRepository->all([], $order, $limit, $offset);

    }

    /**
     * @param int $id
     * @return User
     */
    public function one(int $id): User
    {
        return $this->userRepository->one($id);
    }

    private function emailIsAvailable(string $email): void
    {
        $user = $this->userRepository->all(['email' => $email], null, 1);
        if (!empty($user)){
            throw new \LogicException("Данный email уже занят!");
        }
    }
}