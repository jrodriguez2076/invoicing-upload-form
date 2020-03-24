<?php

declare(strict_types=1);

namespace App\Form\Store\integrations;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdditionalInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'attachments',
                FileType::class,
                [
                    'required' => false,
                    'multiple' => true,
                    'label' => 'ATTACHMENTS_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide attachments files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide attachments',
                    ],
                ]
            )
            ->add(
                'reason',
                TextareaType::class,
                [
                    'label' => 'REASON_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide reason',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide reason',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'store' => 'integrations',
            ]
        );
    }
}
