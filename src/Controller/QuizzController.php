<?php

namespace App\Controller;

use App\Entity\Quizz;
use App\Entity\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuizzController extends AbstractController
    {
        public function setQuizzForm() : Response
        {
            $quizForm = new Quizz();
            $quizForm->getId();
            $quizForm->getTitle();
            $quizForm->getQuestions();

            return $this->render('quizz/quizz.html.twig', [
                'quizForm' => $quizForm
            ]);
        }


    }