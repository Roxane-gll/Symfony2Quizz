<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Entity\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzCreationController extends AbstractController
    {
        public function setQuizzForm() : Response
        {
            $quizForm = new Quizz();
            $quizForm->getId();
            $quizForm->getTitle();
            $quizForm->getQuestions();

            return $this->render('quizz/quizzCreation.html.twig', [
                'quizForm' => $quizForm
            ]);
        }


    }