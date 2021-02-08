<?php
declare(strict_types = 1);

namespace App\Service;


use App\Entity\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileServiceInterface
{
    /**
     * @param UploadedFile $uploadedFile
     * @return File
     */
    public function upload(UploadedFile $uploadedFile): File;

    /**
     * @param string $hash
     * @return File
     */
    public function getFile(string $hash): File;

}