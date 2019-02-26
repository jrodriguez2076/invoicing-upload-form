<?php

declare(strict_types=1);

namespace App\Form\Store\pe;

use App\Service\ParameterService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdditionalInfoType extends AbstractType
{
    /**
     * @var ParameterService
     */
    protected $parameterService;

    public function __construct(ParameterService $parameterService)
    {
        $this->parameterService = $parameterService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $store = $options['store'];

        $builder
            ->add(
                'cutoffDates',
                TextType::class,
                [
                    'label' => 'additional_info.CUTOFF_DATES_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide cutoffDates',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide cutoffDates',
                    ],
                    'help' => 'DATES_CAPTION',
                ]
            )
            ->add(
                'orderNumbers',
                TextType::class,
                [
                    'label' => 'additional_info.ORDER_NUMBERS_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide orderNumbers',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide orderNumbers',
                    ],
                    'help' => 'ORDER_NUMBERS_CAPTION',
                ]
            )
            ->add(
                'idNumber',
                TextType::class,
                [
                    'label' => 'additional_info.ID_NUMBER_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide idNumber',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide idNumber',
                    ],
                ]
            )
            ->add(
                'billingNumbers',
                TextType::class,
                [
                    'label' => 'additional_info.BILLING_NUMBERS_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide billingNumbers',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide billingNumbers',
                    ],
                    'help' => 'BILLING_NUMBERS_CAPTION',
                ]
            )
            ->add(
                'billingDates',
                TextType::class,
                [
                    'label' => 'additional_info.BILLING_DATES_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide billingDates',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide billingDates',
                    ],
                    'help' => 'DATES_CAPTION',
                ]
            )
            ->add(
                'trackingNumber',
                TextType::class,
                [
                    'label' => 'additional_info.TRACKING_NUMBER_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide trackingNumber',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide trackingNumber',
                    ],
                ]
            )
            ->add(
                'phone',
                TextType::class,
                [
                    'label' => 'additional_info.PHONE_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide phone',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide phone',
                    ],
                ]
            )
            ->add(
                'reason',
                TextType::class,
                [
                    'label' => 'additional_info.REASON_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide reason',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide reason',
                    ],
                ]
            )
            ->add(
                'bankAccountNumber',
                TextType::class,
                [
                    'label' => 'additional_info.BANK_ACCOUNT_NUMBER_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide bankAccountNumber',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide bankAccountNumber',
                    ],
                ]
            )
            ->add(
                'warehouseAddress',
                TextType::class,
                [
                    'label' => 'additional_info.WAREHOUSE_ADDRESS_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide warehouseAddress',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide warehouseAddress',
                    ],
                ]
            )
            ->add(
                'supplies',
                TextType::class,
                [
                    'label' => 'additional_info.SUPPLIES_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide supplies',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide supplies',
                    ],
                    'help' => 'SUPPLIES_CAPTION',
                ]
            )
            ->add(
                'origin',
                ChoiceType::class,
                [
                    'label' => 'additional_info.ORIGIN_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide origin',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide origin',
                    ],
                    'choices' => $this->parameterService->getOriginChoices($store),
                    'empty_data' => null,
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'sku',
                TextType::class,
                [
                    'label' => 'additional_info.SKU_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide sku',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide sku',
                    ],
                    'help' => 'SKU_CAPTION',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'store' => 'pe',
            ]
        );
    }
}
