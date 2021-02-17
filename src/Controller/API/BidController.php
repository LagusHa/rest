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
    public function __construct(private BidServiceInterface $bidService)
    {
    }


    /**
     * @Route("/list", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $bids = $this->bidService->list(['id' => $order], (int)$limit, (int)$offset);
        return $this->json($bids);
    }

    /**
     * @Route("/list/waiting", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getWaiting(Request $request): JsonResponse
    {
        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $bids = $this->bidService->getWaiting(['id' => $order], (int)$limit, (int)$offset);
        return $this->json($bids);
    }

    /**
     * @Route("/list/accepted", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAccepted(Request $request): JsonResponse
    {
        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $bids = $this->bidService->getAccepted(['id' => $order], (int)$limit, (int)$offset);
        return $this->json($bids);
    }

    /**
     * @Route("/list/rejected", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getRejected(Request $request): JsonResponse
    {
        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $bids = $this->bidService->getRejected(['id' => $order], (int)$limit, (int)$offset);
        return $this->json($bids);
    }

    /**
     * @Route("/list/called", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getCalled(Request $request): JsonResponse
    {
        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $bids = $this->bidService->getCalled(['id' => $order], (int)$limit, (int)$offset);
        return $this->json($bids);
    }

    /**
     * @Route("/list/postponed", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getPostponed(Request $request): JsonResponse
    {
        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $bids = $this->bidService->getPostponed(['id' => $order], (int)$limit, (int)$offset);
        return $this->json($bids);
    }

    /**
     * @Route("/list/confirmed", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getConfirmed(Request $request): JsonResponse
    {
        $order = $request->query->get('order') ?? 'DESC';
        $limit = $request->query->get('limit') ?? 10;
        $offset = $request->query->get('offset') ?? 0;

        $bids = $this->bidService->getConfirmed(['id' => $order], (int)$limit, (int)$offset);
        return $this->json($bids);
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

    /**
     * @Route("/call/{id}", methods={"PATCH"})
     * @param int $id
     * @return JsonResponse
     */
    public function call(int $id): JsonResponse
    {
        $bid = $this->bidService->call($id);
        return $this->json($bid);
    }

    /**
     * @Route("/accept/{id}", methods={"PATCH"})
     * @param int $id
     * @return JsonResponse
     */
    public function accept(int $id): JsonResponse
    {
        $bid = $this->bidService->accept($id);
        return $this->json($bid);
    }

    /**
     * @Route("/reject/{id}", methods={"PATCH"})
     * @param int $id
     * @return JsonResponse
     */
    public function reject(int $id): JsonResponse
    {
        $bid = $this->bidService->reject($id);
        return $this->json($bid);
    }

    /**
     * @Route("/postponed/{id}", methods={"PATCH"})
     * @param int $id
     * @return JsonResponse
     */
    public function postponed(int $id): JsonResponse
    {
        $bid = $this->bidService->postponed($id);
        return $this->json($bid);
    }

    /**
     * @Route("/confirm/{id}", methods={"PATCH"})
     * @param int $id
     * @return JsonResponse
     */
    public function confirm(int $id): JsonResponse
    {
        $bid = $this->bidService->confirm($id);
        return $this->json($bid);
    }

}