<?php
declare(strict_types = 1);

namespace App\Controller\API;


use App\Auth\TokenData;
use App\Auth\TokenEncoderInterface;
use App\Auth\TokenHeader;
use App\Auth\TokenHeaderInterface;
use App\Dto\UserDto;
use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller\API
 * @Route("/api/users", name="api_users_")
 */
class UserController extends AbstractController
{
    private $userService;
    private $tokenEncoder;

    public function __construct(UserServiceInterface $userService, TokenEncoderInterface $tokenEncoder)
    {
        $this->userService = $userService;
        $this->tokenEncoder = $tokenEncoder;
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

        $users = $this->userService->list(['id' => $order], (int)$limit, (int)$offset);
        return $this->json($users);
    }

    /**
     * @Route("/one/{id}", methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function one(int $id):JsonResponse
    {
        $user = $this->userService->one($id);
        return $this->json($user);
    }

    /**
     * @Route("/signup", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \ReflectionException
     */
    public function signUp(Request $request): JsonResponse
    {
        $data = $request->toArray();
        $user = $this->userService->signUp($data["email"],$data["password"]);

        $token = $this->tokenEncoder->encode(
            new TokenHeader([
                'alg' => $_ENV['APP_ALG'],
                'type' => $_ENV['APP_TYPE']
            ]),
            new TokenData([
                    'id' => $user->getId(),
                    'privileges' => $user->getPrivileges()->toArray()
            ]),
            $_ENV['APP_SECRET']
        );

        return $this->json(['access_token' => $token]);
    }

    /**
     * @Route("/create", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function createFromAdmin(Request $request):JsonResponse
    {
        $data = $request->toArray();
        $user = $this->userService->create($data["email"], $data["password"], $data["privileges"]);
        return $this->json($user);
    }

    /**
     * @Route("/edit/{id}", methods={"PUT"}, requirements={"id"="\d+"})
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function edit(int $id, Request $request): JsonResponse
    {
        $data = $request->toArray();
//        dd($data);
        $dto = new UserDto($data);
        $user = $this->userService->edit($id, $dto);
        return $this->json($user);
    }
}