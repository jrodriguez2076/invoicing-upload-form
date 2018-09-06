<?php

declare(strict_types=1);

namespace App\Form\Store\international;

use App\Entity\Store\international\Opportunity;
use App\Service\SellerSignUpService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('otherStoresAddress')
            ->add('otherStoreName', TextType::class, [
                'required' => false,
            ])
            ->add(
                'otherStoresRating',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getOtherStoresRatingChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'brand1',
                TextType::class,
                [
                    'attr' => [
                        'containerClass' => 'col-md-7',
                    ],
                ]
            )
            ->add(
                'brand2',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'containerClass' => 'col-md-7',
                    ],
                ]
            )
            ->add(
                'brand3',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'containerClass' => 'col-md-7',
                    ],
                ]
            )
            ->add(
                'brand4',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'containerClass' => 'col-md-7',
                    ],
                ]
            )
            ->add(
                'brand5',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'containerClass' => 'col-md-7',
                    ],
                ]
            )
            ->add('opportunityCountries', ChoiceType::class, [
                'choices' => $this->sellerSignUpService->getOpportunityCountries(),
                'placeholder' => 'Choose an option',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('processingTime', TextType::class, [
                'help' => 'processing_time_caption',
            ])
            ->add('surveyComment')
            ->add('marketingInvest', ChoiceType::class, [
                'choices' => $this->sellerSignUpService->getMarketingInvestChoices($store),
                'placeholder' => 'Choose an option',
            ])
            ->add('integrationFlag', ChoiceType::class, [
                'choices' => $this->sellerSignUpService->getIntegrationFlagChoices($store),
                'placeholder' => 'Choose an option',
            ])
            ->add('earningsEstimate');
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
