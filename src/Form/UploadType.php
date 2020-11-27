<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                ChoiceType::class,
                [
                    'label' => 'CONTACT_EMAIL_LABEL',
                    'placeholder' => 'SELECT_OPTION_PLACEHOLDER',
                    'choices' => $options['contacts'],
                    'required' => true,
                    'constraints' => new NotBlank(),
                    'empty_data' => null,
                    'invalid_message' => 'INVALID_EMAIL_MESSAGE',
                    'attr' => [
                        'id' => 'contacts',
                    ],
                ]
            )
            ->add(
                'category',
                ChoiceType::class,
                [
                    'required' => true,
                    'placeholder' => 'SELECT_OPTION_PLACEHOLDER',
                    'choices' => $options['categories'],
                    'label' => 'CATEGORY_LABEL',
                    'constraints' => new NotBlank(),
                    'empty_data' => null,
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
        $resolver->setDefaults([
            'categories' => null,
            'contacts' => null,
        ]);

        $resolver->setRequired(['categories', 'contacts']);
    }
}
