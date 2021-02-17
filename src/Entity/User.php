<?php
declare(strict_types = 1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $middleName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private ?string $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $employ;

    /**
     * @ORM\ManyToOne(targetEntity=Privileges::class, cascade={"persist"})
     * @ORM\JoinColumn(name="privileges_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private Privileges $privileges;

    private function __construct(){}


    /**
     * @param string $email
     * @param string $password
     * @return User
     */
    public static function singUp(string $email, string $password): self
    {
        $user = new self();
        $user->email = $email;
        $user->setPassword($password);

        $privileges = Privileges::createDefault();
        $user->changePrivileges($privileges);

        return $user;
    }

    public static function createFromAdmin(string $email, string $password, array $privileges): self
    {
        $user = new self();
        $user->email = $email;
        $user->setPassword($password);

        $privilege = new Privileges();
        $privilege->fromArray($privileges);
        $user->changePrivileges($privilege);

        return $user;
    }

    public function changePrivileges(Privileges $privileges): void
    {
        $this->privileges = $privileges;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string|null $middleName
     */
    public function setMiddleName(?string $middleName): void
    {
        $this->middleName = $middleName;
    }

    /**
     * @param int|null $age
     */
    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone):void
    {
        $this->phone = $phone;
    }

    /**
     * @param string|null $employ
     */
    public function setEmploy(?string $employ): void
    {
        $this->employ = $employ;
    }


    /**
     * @param Privileges $privileges
     */
    public function setPrivileges(Privileges $privileges): void
    {
        $this->privileges = $privileges;
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Privileges
     */
    public function getPrivileges(): Privileges
    {
        return $this->privileges;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getEmploy(): ?string
    {
        return $this->employ;
    }
}
