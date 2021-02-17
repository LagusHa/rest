<?php

declare(strict_types = 1);

namespace App\Auth;

interface AccessTokenInterface
{

    /**
     * @return bool
     */
    public function isVerify(): bool;

    /**
     * @return TokenHeaderInterface
     */
    public function getHeaders(): TokenHeaderInterface;

    /**
     * @return TokenDataInterface
     */
    public function getData(): TokenDataInterface;

}