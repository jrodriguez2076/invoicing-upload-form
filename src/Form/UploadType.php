<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'contactEmail',
                EmailType::class,
                [
                    'label' => 'CONTACT_EMAIL_LABEL',
                    'required' => true,
                    'constraints' => new NotBlank(),
                    'invalid_message' => 'INVALID_EMAIL_MESSAGE',
                ]
            )
            ->add(
                'files',
                FileType::class,
                [
                    'multiple' => true,
                    'label' => 'FILES_LABEL',
                    'constraints' => new NotBlank(),
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
    }
}
