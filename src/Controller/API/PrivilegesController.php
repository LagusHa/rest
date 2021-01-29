<?php
declare(strict_types = 1);

namespace App\Controller\API;


use App\Entity\Privileges;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PrivilegesController extends AbstractController
{
    /**
     * @Route("/api/users/privileges", methods={"GET"})
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return $this->json(Privileges::privilegesList());
    }


}