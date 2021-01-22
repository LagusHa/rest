<?php
declare(strict_types=1);

namespace App\Repository;


use App\Model\Bid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class BidRepository extends ServiceEntityRepository implements BidRepositoryInterface
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, Bid::class);
    }
    /**
     * @return Bid[];
     */
    public function all(): array
    {
        return parent::findAll();
    }

    /**
     * @param int $id
     * @return Bid
     */
    public function one(int $id): Bid
    {
        /**
         * @var Bid $bid
         */
        $bid = parent::find($id);

        if ($bid == null){
            throw new NotFoundHttpException("Заявка {$id} не найдена!");
        }
        return $bid;
    }

    /**
     * @param Bid $bid
     * @return Bid
     */
    public function save(Bid $bid): Bid
    {
        $this->manager->persist($bid);
        $this->manager->flush();

        return $bid;
    }

    /**
     * @param Bid $bid
     * @return Bid
     */
    public function update(Bid $bid): Bid
    {
        $this->manager->flush();

        return $bid;
    }
}