<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quizz;
use App\Entity\ResponseQuizz;
use App\Entity\User;
use App\Form\QuizzCodeFormType;
use App\Form\QuizzFormType;
use App\Form\RegistrationFormType;
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

    #[Route('/quizz/{quizzId}/{questionId}', name: 'app_quizz_question_doing')]
    public function QuestionQuizzDoing(Quizz $quizzId, Question $questionId) : Response {
        return $this->render('question/questionQuizzDoing.html.twig', [
            'quizz' => $quizzId,
            'currentQuestion' => $questionId
        ]);
    }

    #[Route('/answer/{quizzId}/{questionId}/{answerId}', name: 'app_quizz_question_answer')]
    public function QuestionQuizzAnswer(Quizz $quizzId, Question $questionId, ResponseQuizz $answerId,EntityManagerInterface $entityManager) : Response {
        $user = $this->getUser();
        if ($user instanceof User) {
            $answerId->addUser($user);
            $entityManager->persist($answerId);
            $entityManager->flush();
        }

        $newquestion = 0;
        $allQuestions = $quizzId->getQuestions();
        foreach ($allQuestions as $question) {
            if ($question->getOrderQuestion() == $questionId->getOrderQuestion()+1) {
                $newquestion = $question->getId();
            }
        }
        if ($newquestion == 0 ) {
            return $this->redirectToRoute('app_quizz_participate');
        }
        return $this->redirectToRoute('app_quizz_question_doing',['quizzId'=>$quizzId->getId(), 'questionId'=>$newquestion]);

    }

    #[Route('/code', name: 'app_quizz_code_doing')]
    public function QuizzCodeDoing(Request $request, EntityManagerInterface $entityManager) : Response {
        $form = $this->createForm(QuizzCodeFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $quizzCode = $request->request->all()[$form->getName()]['code'];
            $quizz = $entityManager->getRepository(Quizz::class)->find($quizzCode);
            if ($quizz == null) {
                return $this->redirectToRoute('app_quizz_participate');
            }
            $newquestion = 0;
            $allQuestions = $quizz->getQuestions();
            foreach ($allQuestions as $question) {
                if ($question->getOrderQuestion() == 1) {
                    $newquestion = $question->getId();
                }
            }
            if ($newquestion == 0) {
                return $this->redirectToRoute('app_quizz_participate');
            }
            return $this->redirectToRoute('app_quizz_question_doing', ['quizzId' => $quizz->getId(), 'questionId' => $newquestion]);
        }
        return $this->render('quizz/quizzCode.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}