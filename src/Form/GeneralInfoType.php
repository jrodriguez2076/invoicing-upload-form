<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class GeneralInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $reasons = $options['reasons'];

        $builder
            ->add('contactFullName')
            ->add(
                'sellerCenterId',
                TextType::class,
                [
                    'help' => 'SELLER_CENTER_ID_HELP_CAPTION',
                ]
            )
            ->add(
                'email',
                RepeatedType::class,
                [
                    'required' => true,
                    'type' => EmailType::class,
                    'first_options' => ['label' => 'EMAIL_LABEL'],
                    'second_options' => ['label' => 'REPEAT_EMAIL_LABEL'],
                    'constraints' => new NotBlank(),
                    'invalid_message' => 'INVALID_EMAIL_MESSAGE',
                ]
            )
            ->add(
                'contactPhoneNumber',
                TextType::class,
                [
                    'required' => true,
                    'constraints' => [
                        new NotBlank(),
                    ],
                ]
            )
            ->add(
                'reasons',
                ChoiceType::class,
                [
                    'choices' => $reasons,
                    'placeholder' => 'Choose an option',
                    'empty_data' => null,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('reasons');
    }
}
