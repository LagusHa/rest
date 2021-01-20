<?php
declare(strict_types=1);

namespace App\Service;


use App\Model\Bid;

interface BidServiceInterface
{
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
                           string $phone, string $employ, string $middleName = null, string $information = null): Bid;

    /**
     * @param int $id
     * @return Bid
     */
    public function call(int $id): Bid;

    /**
     * @param int $id
     * @return Bid
     */
    public function accept(int $id): Bid;

    /**
     * @param int $id
     * @return Bid
     */
    public function reject(int $id): Bid;

    /**
     * @param int $id
     * @return Bid
     */
    public function postponed(int $id): Bid;

    /**
     * @param int $id
     * @return Bid
     */
    public function confirm(int $id): Bid;
}