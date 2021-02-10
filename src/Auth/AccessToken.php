<?php
declare(strict_types = 1);

namespace App\Auth;


class AccessToken implements AccessTokenInterface
{
    private $headers;
    private $data;
    private $signature;

    public function __construct(TokenHeaderInterface $headers, TokenDataInterface $data, string $signature)
    {
        $this->headers = $headers;
        $this->data = $data;
        $this->signature = $signature;
    }

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