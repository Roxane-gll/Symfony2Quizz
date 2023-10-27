<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Form\QuizzFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzCreationController extends AbstractController
    {
        #[Route('/quizz/create', name: 'app_quizz_create')]
        public function QuizzForm(Request $request, EntityManagerInterface $entityManager) : Response
        {
            $quizz = new Quizz();
            $form = $this->createForm(QuizzFormType::class, $quizz);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($quizz);
                $entityManager->flush();
                return $this->redirectToRoute("app_question_create", ['id' => $quizz->getId()] );
            }

            return $this->render('quizz/quizzCreation.html.twig', [
                'quizzForm' => $form->createView(),
            ]);
        }


    }