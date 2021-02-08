<?php
declare(strict_types = 1);

namespace App\Repository;


use App\Entity\File;

interface FileRepositoryInterface
{
    /**
     * @param File $file
     * @return File
     */
    public function save(File $file): File;

    /**
     * @param string $hash
     * @return File
     */
    public function oneByHash(string $hash): File;

    /**
     * @param int $id
     * @return bool
     */
    public function remove(int $id):bool;
}