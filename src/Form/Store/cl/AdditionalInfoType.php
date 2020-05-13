<?php

declare(strict_types=1);

namespace App\Form\Store\cl;

use App\Service\ParameterService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                'paymentDetails',
                FileType::class,
                [
                    'label' => 'PAYMENT_DETAILS_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide paymentDetails files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide paymentDetails',
                    ],
                ]
            )
            ->add(
                'taxDocument',
                FileType::class,
                [
                    'label' => 'TAX_DOCUMENT_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide taxDocument files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide taxDocument',
                    ],
                ]
            )
            ->add(
                'idDocument',
                FileType::class,
                [
                    'label' => 'ID_DOCUMENT_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide idDocument files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide idDocument',
                    ],
                ]
            )
            ->add(
                'companyDocument',
                FileType::class,
                [
                    'label' => 'COMPANY_DOCUMENT_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide companyDocument files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide companyDocument',
                    ],
                ]
            )
            ->add(
                'accountBalance',
                FileType::class,
                [
                    'multiple' => true,
                    'label' => 'ACCOUNT_BALANCE_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide accountBalance files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide accountBalance',
                    ],
                ]
            )
            ->add(
                'invoices',
                FileType::class,
                [
                    'multiple' => true,
                    'label' => 'INVOICES_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide invoices files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide invoices',
                    ],
                ]
            )
            ->add(
                'accountReceivable',
                FileType::class,
                [
                    'multiple' => true,
                    'label' => 'ACCOUNT_RECEIVABLE_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide accountReceivable files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide accountReceivable',
                    ],
                ]
            )
            ->add(
                'interfacturaEvidence',
                FileType::class,
                [
                    'label' => 'INTERFACTURA_EVIDENCE_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide interfacturaEvidence files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide interfacturaEvidence',
                    ],
                ]
            )
            ->add(
                'evidence',
                FileType::class,
                [
                    'multiple' => true,
                    'label' => 'EVIDENCE_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide evidence files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide evidence',
                    ],
                ]
            )
            ->add(
                'fblSkuList',
                FileType::class,
                [
                    'label' => 'FBL_SKU_LIST_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide fblSkuList files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide fblSkuList',
                    ],
                ]
            )
            ->add(
                'skuList',
                FileType::class,
                [
                    'label' => 'SKU_LIST_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide skuList files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide skuList',
                    ],
                ]
            )
            ->add(
                'shoppingError',
                FileType::class,
                [
                    'label' => 'SHOPPING_ERROR_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide shoppingError files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide shoppingError',
                    ],
                ]
            )
            ->add(
                'eventsForm',
                FileType::class,
                [
                    'label' => 'EVENTS_FORM_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide eventsForm files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide eventsForm',
                    ],
                ]
            )
            ->add(
                'orderShipmentDocument',
                FileType::class,
                [
                    'multiple' => true,
                    'label' => 'ORDER_SHIPMENT_DOCUMENT_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide orderShipmentDocument files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide orderShipmentDocument',
                    ],
                ]
            )
            ->add(
                'cbuDocument',
                FileType::class,
                [
                    'label' => 'CBU_DOCUMENT_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide cbuDocument files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide cbuDocument',
                    ],
                ]
            )
            ->add(
                'requestedSupplies',
                FileType::class,
                [
                    'label' => 'REQUESTED_SUPPLIES_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide requestedSupplies files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide requestedSupplies',
                    ],
                ]
            )
            ->add(
                'invoiceProof',
                FileType::class,
                [
                    'label' => 'INVOICE_PROOF_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide invoiceProof files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide invoiceProof',
                    ],
                ]
            )
            ->add(
                'alternateImage',
                FileType::class,
                [
                    'label' => 'ALTERNATE_IMAGE_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide alternateImage files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide alternateImage',
                    ],
                ]
            )
            ->add(
                'technicalReport',
                FileType::class,
                [
                    'label' => 'TECHNICAL_REPORT_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide technicalReport files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide technicalReport',
                    ],
                ]
            )
            ->add(
                'ccciDocument',
                FileType::class,
                [
                    'label' => 'CCCI_DOCUMENT_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide ccciDocument files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide ccciDocument',
                    ],
                ]
            )
            ->add(
                'shippingLabel',
                FileType::class,
                [
                    'multiple' => true,
                    'label' => 'SHIPPING_LABEL_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide shippingLabel files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide shippingLabel',
                    ],
                ]
            )
            ->add(
                'retentionCertificate',
                FileType::class,
                [
                    'multiple' => true,
                    'label' => 'RETENTION_CERTIFICATE_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide retentionCertificate files',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide retentionCertificate',
                    ],
                ]
            )
            ->add(
                'cutoffDates',
                TextType::class,
                [
                    'label' => 'CUTOFF_DATES_LABEL',
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
                    'label' => 'ORDER_NUMBERS_LABEL',
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
                    'label' => 'ID_NUMBER_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide idNumber',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide idNumber',
                    ],
                ]
            )
            ->add(
                'shippingCompany',
                ChoiceType::class,
                [
                    'label' => 'SHIPPING_COMPANY_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide shippingCompany',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide shippingCompany',
                    ],
                    'choices' => $this->parameterService->getShippingCompanyChoices($store),
                    'empty_data' => null,
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'registeredEmail',
                EmailType::class,
                [
                    'label' => 'REGISTERED_EMAIL_LABEL',
                    'attr' => [
                        'class' => 'additionalField hide registeredEmail',
                    ],
                    'label_attr' => [
                        'class' => 'additionalField hide registeredEmail',
                    ],
                ]
            )
            ->add(
                'billingNumbers',
                TextType::class,
                [
                    'label' => 'BILLING_NUMBERS_LABEL',
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
                    'label' => 'BILLING_DATES_LABEL',
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
                    'label' => 'TRACKING_NUMBER_LABEL',
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
                    'label' => 'PHONE_LABEL',
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
            )
            ->add(
                'bankAccountNumber',
                TextType::class,
                [
                    'label' => 'BANK_ACCOUNT_NUMBER_LABEL',
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
                    'label' => 'WAREHOUSE_ADDRESS_LABEL',
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
                    'label' => 'SUPPLIES_LABEL',
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
                    'label' => 'ORIGIN_LABEL',
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
                    'label' => 'SKU_LABEL',
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
                'store' => 'cl',
            ]
        );
    }
}
