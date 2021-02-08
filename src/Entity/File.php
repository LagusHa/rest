<?php
declare(strict_types = 1);

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File as LoadedFile;

/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fileName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\Column(type="integer", length=100)
     */
    private $size;

    public function __construct(LoadedFile $file)
    {
        $this->fileName = $file->getFilename();
        $this->hash = $file->getFilename();
        $this->size = $file->getSize();
        $this->path = $file->getPath();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function path(): ?string
    {
        return $this->path;
    }


    public function getLink(): string
    {
        return $_ENV['APP_HTTP_HOST'] . "/api/files/" . $this->getHash();
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function getDownloadLink(): string
    {
        return $_ENV['APP_HTTP_HOST'] . "/api/files/" . $this->getHash() . "/download";
    }

    public function fullPath(): string
    {
        return $this->path() . "/" . $this->getFileName();
    }

}
