<?php
declare(strict_types = 1);

namespace App\Auth;


interface TokenHeaderInterface extends \Serializable
{
    public function getAlg(): string;
    public function getType(): string;
}