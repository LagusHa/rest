<?php
/**
 * Created by PhpStorm.
 * User: gotohell
 * Date: 1/31/21
 * Time: 11:38 PM
 */

namespace App\Controller\API;


use App\Service\FileServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FileController
 * @package App\Controller\API
 * @Route("/api/files")
 */
class FileController extends AbstractController
{
    private $fileService;
    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * @Route("/", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $uploadedFile = $request->files->get("file");
        if ($uploadedFile === null){
            throw new NotFoundHttpException("Файл не передан!");
        }
        $file = $this->fileService->upload($uploadedFile);
        return $this->json($file);
    }

    /**
     * @Route("/{hash}", methods={"GET"})
     * @param string $hash
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function preview(string $hash): BinaryFileResponse
    {
        $file = $this->fileService->getFile($hash);

        return $this->file($file->fullPath(), null, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /**
     * @Route("/{hash}/download", methods={"GET"})
     * @param string $hash
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(string $hash): BinaryFileResponse
    {
        $file = $this->fileService->getFile($hash);

        return $this->file($file->fullPath());
    }
}