<?php

declare(strict_types=1);

namespace App\Form\Store\mx;

use App\Entity\Contact;
use App\Form\GeneralInfoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $reasons = $options['reasons'];

        $builder
            ->add('generalInfo', GeneralInfoType::class, ['reasons' => $reasons]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Contact::class,
                'store' => 'mx',
                'reasons' => null,
            ]
        );
    }
}
