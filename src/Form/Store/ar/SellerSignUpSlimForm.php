<?php

declare(strict_types=1);

namespace App\Form\Store\ar;

use App\Entity\SellerSignUp;
use App\Form\ContactType;
use App\Form\OpportunitySlimType;
use App\Service\SellerSignUpService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellerSignUpSlimForm extends AbstractType
{
    /**
     * @var SellerSignUpService
     */
    protected $sellerSignUpService;

    public function __construct(SellerSignUpService $sellerSignUpService)
    {
        $this->sellerSignUpService = $sellerSignUpService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $store = $options['store'];

        $builder
            ->add('contact', ContactType::class)
            ->add('account', AccountType::class, ['store' => $store])
            ->add('opportunity', OpportunitySlimType::class, ['store' => $store]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => SellerSignUp::class,
                'store' => 'ar',
            ]
        );
    }
}
