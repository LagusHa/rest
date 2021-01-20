<?php
declare(strict_types=1);

namespace App\Repository;


use App\Model\Bid;

interface BidRepositoryInterface
{

    /**
     * @return Bid[];
     */
    public function all(): array;

    /**
     * @param int $id
     * @return Bid
     */
    public function one(int $id): Bid;

    /**
     * @param Bid $bid
     * @return Bid
     */
    public function save(Bid $bid): Bid;

    /**
     * @param Bid $bid
     * @return Bid
     */
    public function update(Bid $bid): Bid;
}