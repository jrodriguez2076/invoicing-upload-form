<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add(
                'phoneNumber',
                TextType::class,
                [
                    'help' => 'phone_number_caption',
                ]
            )
            ->add(
                'email',
                RepeatedType::class,
                [
                    'type' => EmailType::class,
                    'first_options' => ['label' => 'Email', 'help' => 'email_caption'],
                    'second_options' => ['label' => 'Repeat Email'],
                ]
            )
            ->add('acceptManifest', CheckboxType::class, ['mapped' => false])
            ->add('acceptTermsAndConditions', CheckboxType::class, ['mapped' => false])
            ->add('acceptCommissionsAndPaymentPolicy', CheckboxType::class, ['mapped' => false]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Contact::class,
            ]
        );
    }
}