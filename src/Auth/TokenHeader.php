<?php
declare(strict_types = 1);

namespace App\Auth;

class TokenHeader implements TokenHeaderInterface
{
    private $alg;
    private $type;

    /**
     * TokenHeader constructor.
     * @param array $headers
     */
    public function __construct(array $headers)
    {
        $this->initialize($headers);
    }

    /**
     * @param array $headers
     */
    private function initialize(array $headers):void
    {
        $refl = new \ReflectionClass($this);
        $props = $refl->getProperties();

        foreach ($props as $prop){
            if (!isset($headers[$prop->getName()])){
                throw new \RuntimeException("Не передан " . $prop->getName() . " в TokenData");
            }
            $this->{$prop->getName()} = $headers[$prop->getName()];
        }
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        $refl = new \ReflectionClass($this);
        $props = $refl->getProperties();

        $data = [];

        foreach ($props as $prop){
            $data[$prop->getName()] = $this->{$prop->getName()};
        }
        return serialize($data);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);

        $refl = new \ReflectionClass($this);
        $props = $refl->getProperties();

        foreach ($props as $prop){
            if (property_exists($this, $prop->getName())){
                $this->{$prop->getName()} = $data[$prop->getName()];
            }
        }
    }

    public function getAlg(): string
    {
        return $this->alg;
    }

    public function getType(): string
    {
        return $this->type;
    }
}