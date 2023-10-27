<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Form\QuizzFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzParticipationController extends AbstractController
{
    #[Route('/quizz/participate', name: 'app_quizz_participate')]
    public function QuizzParticipation(EntityManagerInterface $entityManager) : Response
    {
        $quizzs = $entityManager->getRepository(Quizz::class)->findAll();
        return $this->render('quizz/quizzParticipation.html.twig', [
            'quizzs' => $quizzs
        ]);
    }

    #[Route('/quizz/{id}', name: 'app_quizz_doing')]
    public function QuizzDoing(Quizz $quizz) : Response {
        return $this->render('quizz/quizzDoing.html.twig', [
            'quizz' => $quizz
        ]);
    }
}