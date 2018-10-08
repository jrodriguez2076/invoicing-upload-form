<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Opportunity;
use App\Service\SellerSignUpService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpportunitySlimType extends AbstractType
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
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Opportunity::class,
                'store' => 'international',
            ]
        );
    }
}
