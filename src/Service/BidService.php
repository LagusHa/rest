<?php
declare(strict_types=1);

namespace App\Service;


use App\Model\Bid;
use App\Repository\BidRepositoryInterface;

class BidService implements BidServiceInterface
{
    private $repository;

    public function __construct(BidRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $lastName
     * @param string $firstName
     * @param string $email
     * @param int $age
     * @param string $phone
     * @param string $employ
     * @param string|null $middleName
     * @param string|null $information
     * @return Bid
     */
    public function create(string $lastName, string $firstName, string $email, int $age,
                           string $phone, string $employ, string $middleName = null, string $information = null): Bid
    {
        $bid = new Bid($lastName, $firstName, $email, $age, $phone, $employ);
        $bid->setMiddleName($middleName);
        $bid->setInformation($information);
        $this->repository->save($bid);

        return $bid;
    }

    /**
     * @param int $id
     * @return Bid
     */
    public function call(int $id): Bid
    {
        $bid = $this->repository->one($id);
        $bid->call();

        $this->repository->update($bid);
    }

    /**
     * @param int $id
     * @return Bid
     */
    public function accept(int $id): Bid
    {
        $bid = $this->repository->one($id);
        $bid->accept();

        $this->repository->update($bid);
    }

    /**
     * @param int $id
     * @return Bid
     */
    public function reject(int $id): Bid
    {
        $bid = $this->repository->one($id);
        $bid->reject();

        $this->repository->update($bid);
    }

    /**
     * @param int $id
     * @return Bid
     */
    public function postponed(int $id): Bid
    {
        $bid = $this->repository->one($id);
        $bid->postponed();

        $this->repository->update($bid);
    }

    /**
     * @param int $id
     * @return Bid
     */
    public function confirm(int $id): Bid
    {
        $bid = $this->repository->one($id);
        $bid->confirm();

        $this->repository->update($bid);
    }
}