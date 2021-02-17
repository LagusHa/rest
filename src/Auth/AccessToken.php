<?php

declare(strict_types = 1);

namespace App\Auth;

class AccessToken implements AccessTokenInterface
{
    /**
     * AccessToken constructor.
     * @param TokenHeaderInterface $headers
     * @param TokenDataInterface $data
     * @param string $signature
     */
    public function __construct(private TokenHeaderInterface $headers, private TokenDataInterface $data, private string $signature)
    {
    }

    /**
     * @return bool
     */
    public function isVerify(): bool
    {
        $s = base64_encode(
            hash($this->headers->getAlg(),
            serialize($this->headers) . serialize($this->data) . $_ENV['APP_SECRET']));

        return $s === $this->signature;
    }

    /**
     * @return TokenHeaderInterface
     */
    public function getHeaders(): TokenHeaderInterface
    {
        return $this->headers;
    }

    /**
     * @return TokenDataInterface
     */
    public function getData(): TokenDataInterface
    {
        return $this->data;
    }

}