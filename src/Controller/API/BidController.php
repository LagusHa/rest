<?php
declare(strict_types=1);

namespace App\Controller\API;


use App\Service\BidServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BidController
 * @package App\Controller\API
 * @Route("/api/bids", name="api_bids_")
 */
class BidController extends AbstractController
{
    private $bidService;

    public function __construct(BidServiceInterface $bidService)
    {
        $this->bidService = $bidService;
    }

    /**
     * @Route("/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $bid = $this->bidService->create(
            $data["last_name"],
            $data["first_name"],
            $data["email"],
            $data["age"],
            $data["phone"],
            $data["employ"],
            $data["middle_name"],
            $data["information"],
        );
        return $this->json($bid);
    }

}