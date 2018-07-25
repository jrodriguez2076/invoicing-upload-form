<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Opportunity;
use App\Service\SellerSignUpService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpportunityType extends AbstractType
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
            ->add('operativeCheckLegallyConstituted', CheckboxType::class)
            ->add('operativeCheckCatalog', CheckboxType::class)
            ->add('operativeCheckInventory', CheckboxType::class)
            ->add('operativeCheckDelivery', CheckboxType::class)
            ->add('operativeCheckReturns', CheckboxType::class)
            ->add('operativeCheckShippingAgreement', CheckboxType::class)
            ->add('operativeCheckInvoices', CheckboxType::class)
            ->add('earningsEstimate')
            ->add(
                'mainCategory',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getMainCategoriesChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'secondaryCategory',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getSecondaryCategoriesChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'potentialCatalog',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getPotentialCatalogChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add('website')
            ->add(
                'otherStoresList',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getOtherStoresListChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add('otherStoreName')
            ->add('otherStoresAddress')
            ->add(
                'otherStoresRating',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getOtherStoresRatingChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add('officialDistributorBrand')
            ->add('brand1')
            ->add('brand2')
            ->add('brand3')
            ->add(
                'marketingInvest',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getMarketingInvestChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'integrationFlag',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getIntegrationFlagChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            );
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
