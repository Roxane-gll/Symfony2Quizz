<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quizz;
use App\Form\QuestionFormType;
use App\Form\QuizzFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionCreationController extends AbstractController
{
    #[Route('/quizz/{id}/question', name: 'app_question_create')]
    public function QuestionForm(Request $request, Quizz $quizz, EntityManagerInterface $entityManager) : Response
    {
        $question = new Question();
        $question -> setQuizz($quizz);
        $question->setOrderQuestion($quizz->getQuestions()->count()+1);
        $form = $this->createForm(QuestionFormType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($question);
            $entityManager->flush();
            return $this->redirectToRoute("app_quizz_doing", ['id'=>$quizz->getId()]);
        }

        return $this->render('question/questionCreation.html.twig', [
            'questionForm' => $form->createView(),
        ]);
    }


}