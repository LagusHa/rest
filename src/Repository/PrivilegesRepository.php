<?php
declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Privileges;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Privileges|null find($id, $lockMode = null, $lockVersion = null)
 * @method Privileges|null findOneBy(array $criteria, array $orderBy = null)
 * @method Privileges[]    findAll()
 * @method Privileges[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrivilegesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Privileges::class);
    }

}
