<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    //! all the classes we import about (Data)Type are from Component
        $builder
            ->add('siret', IntegerType::class, ['attr'=>['class'=>'form-control']])
            ->add('raisonSocial', TextType::class, ['attr'=>['class'=>'form-control']])
            // ['widget' => 'single_text'] -> change the calender visually
            ->add('dateCreation', DateType::class, ['widget'=>'single_text',
                                                    'attr'=>['class'=>'form-control']])
            ->add('address', TextType::class, ['attr'=>['class'=>'form-control']])
            ->add('cp', TextType::class, ['attr'=>['class'=>'form-control']])
            ->add('ville', TextType::class, ['attr'=>['class'=>'form-control']])
            ->add('submit', SubmitType::class, ['attr'=>['class'=>'btn btn-secondary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
