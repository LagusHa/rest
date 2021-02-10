<?php
declare(strict_types = 1);

namespace App\Auth;


interface TokenEncoderInterface
{
    public function encode(TokenHeaderInterface $header, TokenDataInterface $data, string $secret): string;
}