<?php
declare(strict_types = 1);

namespace App\Repository;

use App\Entity\File;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method File|null find($id, $lockMode = null, $lockVersion = null)
 * @method File|null findOneBy(array $criteria, array $orderBy = null)
 * @method File[]    findAll()
 * @method File[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileRepository extends ServiceEntityRepository implements FileRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, File::class);
    }

    /**
     * @param File $file
     * @return File
     */
    public function save(File $file): File
    {
        $this->entityManager->persist($file);
        $this->entityManager->flush();

        return $file;
    }

    /**
     * @param string $hash
     * @return File
     */
    public function oneByHash(string $hash): File
    {
        /**
         * @var File $file
         */
        $file = parent::findOneBy(['hash' => $hash]);

        if ($file === null){
            throw new NotFoundHttpException("Файл не найден!");
        }

        return $file;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function remove(int $id): bool
    {
        /**
         * @var File|null $file
         */
        $file = parent::find($id);

        if ($file === null){
            throw new NotFoundHttpException("Файл не найден!");
        }

        $this->entityManager->remove($file);

        return true;
    }
}
