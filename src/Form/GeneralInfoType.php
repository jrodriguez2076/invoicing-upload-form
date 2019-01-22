<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeneralInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $reasons = $options['reasons'];

        $builder
            ->add('accountName')
            ->add('sellerCenterId')
            ->add(
                'email',
                EmailType::class
            )
            ->add('reason',
                ChoiceType::class,
                [
                    'choices' => $reasons,
                    'placeholder' => 'Choose an option',
                    'empty_data' => null,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Contact::class,
            ]
        );

        $resolver->setRequired('reasons');
    }
}
