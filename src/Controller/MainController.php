<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(QuestionRepository $questionRepository ): Response
    {
        $question= $questionRepository->findBy([], ['date' => 'DESC']);
        return $this->render('main/main_page.html.twig', [
            'questions' => $question,
        ]);
    }
}
