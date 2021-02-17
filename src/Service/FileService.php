<?php
declare(strict_types = 1);

namespace App\Service;


use App\Entity\File;
use App\Repository\FileRepositoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService implements FileServiceInterface
{
    public function __construct(private string $imageDirectory, private FileRepositoryInterface $repository)
    {
    }
    /**
     * @param UploadedFile $uploadedFile
     * @return File
     */
    public function upload(UploadedFile $uploadedFile): File
    {
        $fileName = $this->generateFileName($uploadedFile);
        $loadedFile = $uploadedFile->move($this->imageDirectory, $fileName);
        $file = new File($loadedFile);
        $this->repository->save($file);
        return $file;
    }

    /**
     * @param string $hash
     * @return File
     */
    public function getFile(string $hash): File
    {
        return $this->repository->oneByHash($hash);
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    private function generateFileName(UploadedFile $uploadedFile): string
    {
        $hash = base64_encode(hash("sha256", uniqid()));
        $filename = $hash . "." . $uploadedFile->guessExtension();
        return $filename;
    }
}