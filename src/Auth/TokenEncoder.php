<?php
declare(strict_types = 1);

namespace App\Auth;


class TokenEncoder implements TokenEncoderInterface
{

    public function encode(TokenHeaderInterface $header, TokenDataInterface $data, string $secret): string
    {
        $h = base64_encode(serialize($header));
        $d = base64_encode(serialize($data));
        $s = base64_encode(hash($header->getAlg(), serialize($header) . serialize($data) . $secret));
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