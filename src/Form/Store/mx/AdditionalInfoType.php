<?php

declare(strict_types=1);

namespace App\Form\Store\mx;

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
                    'label' => 'additional_info.cutoff_dates.label',
                    'attr' => [
                        'class' => 'additionalField hide cutoffDates',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide cutoffDates',
                    ],
                    'help' => 'dates_caption',
                ]
            )
            ->add(
                'orderNumbers',
                TextType::class,
                [
                    'label' => 'additional_info.order_numbers.label',
                    'attr' => [
                        'class' => 'additionalField hide orderNumbers',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide orderNumbers',
                    ],
                    'help' => 'order_numbers_caption',
                ]
            )
            ->add(
                'amounts',
                TextType::class,
                [
                    'label' => 'additional_info.amounts.label',
                    'attr' => [
                        'class' => 'additionalField hide amounts',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide amounts',
                    ],
                    'help' => 'amounts_caption',
                ]
            )
            ->add(
                'invoicingType',
                ChoiceType::class,
                [
                    'label' => 'additional_info.invoicing_types.label',
                    'attr' => [
                        'class' => 'additionalField hide invoicingType',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide invoicingType',
                    ],
                    'choices' => $this->parameterService->getInvoicingTypeChoices($store),
                    'empty_data' => null,
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'poNumber',
                TextType::class,
                [
                    'label' => 'additional_info.po_number.label',
                    'attr' => [
                        'class' => 'additionalField hide poNumber',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide poNumber',
                    ],
                ]
            )
            ->add(
                'idNumber',
                TextType::class,
                [
                    'label' => 'additional_info.id_number.label',
                    'attr' => [
                        'class' => 'additionalField hide idNumber',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide idNumber',
                    ],
                ]
            )
            ->add(
                'legalName',
                TextType::class,
                [
                    'label' => 'additional_info.legal_name.label',
                    'attr' => [
                        'class' => 'additionalField hide legalName',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide legalName',
                    ],
                ]
            )
            ->add(
                'responsibleName',
                TextType::class,
                [
                    'label' => 'additional_info.responsible_name.label',
                    'attr' => [
                        'class' => 'additionalField hide responsibleName',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide responsibleName',
                    ],
                ]
            )
            ->add(
                'errorDescription',
                TextType::class,
                [
                    'label' => 'additional_info.error_description.label',
                    'attr' => [
                        'class' => 'additionalField hide errorDescription',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide errorDescription',
                    ],
                ]
            )
            ->add(
                'billingNumbers',
                TextType::class,
                [
                    'label' => 'additional_info.billing_numbers.label',
                    'attr' => [
                        'class' => 'additionalField hide billingNumbers',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide billingNumbers',
                    ],
                    'help' => 'billing_numbers_caption',
                ]
            )
            ->add(
                'billingDates',
                TextType::class,
                [
                    'label' => 'additional_info.billing_dates.label',
                    'attr' => [
                        'class' => 'additionalField hide billingDates',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide billingDates',
                    ],
                    'help' => 'dates_caption',
                ]
            )
            ->add(
                'trackingNumber',
                TextType::class,
                [
                    'label' => 'additional_info.tracking_number.label',
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
                    'label' => 'additional_info.phone.label',
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
                    'label' => 'additional_info.reason.label',
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
                    'label' => 'additional_info.bank_account_number.label',
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
                    'label' => 'additional_info.warehouse_address.label',
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
                    'label' => 'additional_info.supplies.label',
                    'attr' => [
                        'class' => 'additionalField hide supplies',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide supplies',
                    ],
                    'help' => 'supplies_caption',
                ]
            )
            ->add(
                'packagingType',
                ChoiceType::class,
                [
                    'label' => 'additional_info.packaging_type.label',
                    'attr' => [
                        'class' => 'additionalField hide packagingType',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide packagingType',
                    ],
                    'choices' => $this->parameterService->getPackagingTypeChoices($store),
                    'empty_data' => null,
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'packageQty',
                TextType::class,
                [
                    'label' => 'additional_info.package_qty.label',
                    'attr' => [
                        'class' => 'additionalField hide packageQty',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide packageQty',
                    ],
                ]
            )
            ->add(
                'packageSize',
                TextType::class,
                [
                    'label' => 'additional_info.package_size.label',
                    'attr' => [
                        'class' => 'additionalField hide packageSize',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide packageSize',
                    ],
                ]
            )
            ->add(
                'packageWeight',
                TextType::class,
                [
                    'label' => 'additional_info.package_weight.label',
                    'attr' => [
                        'class' => 'additionalField hide packageWeight',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide packageWeight',
                    ],
                ]
            )
            ->add(
                'origin',
                ChoiceType::class,
                [
                    'label' => 'additional_info.origin.label',
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
                    'label' => 'additional_info.sku.label',
                    'attr' => [
                        'class' => 'additionalField hide sku',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide sku',
                    ],
                    'help' => 'sku_caption',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'store' => 'mx'
            ]
        );
    }
}
