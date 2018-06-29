<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\SellerRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellerRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accountManagerName')
            ->add('accountManagerLastName')
            ->add('phoneNumber')
            ->add('storeCommercialName')
            ->add('email', RepeatedType::class, [
                'first_options'  => ['label' => 'Email'],
                'second_options' => ['label' => 'Repeat Email'],
            ])
            ->add('manifest', CheckboxType::class)
            ->add('acceptTermsAndConditions', CheckboxType::class)
            ->add('acceptCommissionsAndPaymentPolicy', CheckboxType::class)
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => SellerRequest::class,
        ));
    }
}
