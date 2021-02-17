<?php
declare(strict_types = 1);

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
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
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $hash;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $fileName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $path;

    /**
     * @ORM\Column(type="integer", length=100)
     */
    private int $size;

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


    /**
     * @return string
     */
    #[Pure] public function getLink(): string
    {
        return $_ENV['APP_HTTP_HOST'] . "/api/files/" . $this->getHash();
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    #[Pure] public function getDownloadLink(): string
    {
        return $_ENV['APP_HTTP_HOST'] . "/api/files/" . $this->getHash() . "/download";
    }

    /**
     * @return string
     */
    #[Pure] public function fullPath(): string
    {
        return $this->path() . "/" . $this->getFileName();
    }

}
