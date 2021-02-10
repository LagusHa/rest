<?php
declare(strict_types = 1);

namespace App\Auth;


class TokenEncoder implements TokenEncoderInterface
{
    private $header;
    private $secret;

    public function __construct(TokenHeaderInterface $header, string $secret)
    {
        $this->header = $header;
        $this->secret = $secret;
    }

    public function encode(TokenDataInterface $data): string
    {
        $h = base64_encode(serialize($this->header));
        $d = base64_encode(serialize($data));
        $s = base64_encode(
            hash($this->header->getAlg(),
                serialize($this->header) . serialize($data) . $this->secret));
        return $this->concat($h,$d,$s);
    }

    private function concat(string ...$args):string
    {
        $result = "";
        foreach ($args as $arg){
            $result .= $arg . ".";
        }
        return trim($result, ".");
    }
}