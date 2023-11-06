<?php
namespace App\Form;

use App\Entity\Question;
use App\Entity\ResponseQuizz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionResponseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('textQuestion')
            ->add('responses', CollectionType::class, [
                'entry_type' => QuizzResponseFormType::class,
                'allow_add' => true,
                'by_reference' => false,
                'mapped' => false
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Question'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }

}