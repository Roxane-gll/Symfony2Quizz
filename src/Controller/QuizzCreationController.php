<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Form\QuizzFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzCreationController extends AbstractController
    {
        #[Route('/quizz/create', name: 'app_quizz_create')]
        public function QuizzForm(Request $request) : Response
        {
            $quizz = new Quizz();
            $form = $this->createForm(QuizzFormType::class, $quizz);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {


            }

            return $this->render('quizz/quizzCreation.html.twig', [
                'quizzForm' => $form
            ]);
        }


    }