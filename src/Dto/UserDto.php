<?php
declare(strict_types = 1);

namespace App\Dto;


use App\Entity\Privileges;

class UserDto
{
    public ?string $lastName;
    public ?string $firstName;
    public ?string $middleName;
    public ?int $age;
    public ?string $phone;
    public ?string $employ;
    public ?array $privileges;

    public function __construct(array $array)
    {
        $this->initialize($array);
    }

    private function initialize(array $array): void
    {
        foreach ($array as $k => $v){
            if (property_exists($this, $k)){
                $this->{$k} = $v;
            }
        }
    }
}