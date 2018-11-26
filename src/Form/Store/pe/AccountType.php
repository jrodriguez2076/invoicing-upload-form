<?php

declare(strict_types=1);

namespace App\Form\Store\pe;

use App\Entity\Store\pe\Account;
use App\Service\SellerSignUpService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
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
            ->add('accountName', TextType::class, ['help' => 'account_name_caption'])

            ->add(
                'legalName',
                TextType::class,
                [
                    'help' => 'legal_name_caption',
                ]
            )
            ->add(
                'contributorType',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getContributorTypesChoices($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'legalAddress',
                TextType::class,
                [
                    'help' => 'legal_address_caption',
                ]
            )
            ->add('legalAddress2')
            ->add(
                'legalCountry',
                ChoiceType::class,
                [
                    'help' => 'legal_country_caption',
                    'choices' => $this->sellerSignUpService->getLegalCountries($store),
                    'placeholder' => 'Choose an option',
                    'data' => 'Peru',
                    'attr' => [
                        'readonly' => true,
                    ],
                ]
            )
            ->add(
                'legalCity',
                TextType::class,
                [
                    'help' => 'legal_city_caption',
                ]
            )
            ->add(
                'legalPostalCode',
                TextType::class,
                [
                    'help' => 'legal_postal_code_caption',
                ]
            )
            ->add(
                'legalRepresentative',
                TextType::class,
                [
                    'help' => 'legal_representative_caption',
                ]
            )
            ->add(
                'fiscalIdNumber',
                TextType::class,
                [
                    'help' => 'fiscal_id_number_caption',
                ]
            )
            ->add(
                'fiscalIdAdditionalDoc',
                FileType::class,
                [
                    'help' => 'fiscal_id_additional_doc_caption',
                ]
            )
            ->add(
                'logisticDocument',
                FileType::class,
                [
                    'help' => 'logistic_document_caption',
                ]
            )
            ->add(
                'idAdditionalDoc',
                FileType::class,
                [
                    'help' => 'id_additional_doc_caption',
                ]
            )
            //Section 3
            ->add(
                'bankAcctHolder',
                TextType::class,
                [
                    'help' => 'bank_account_holder_caption',
                ]
            )
            ->add(
                'bankAcctNumber',
                TextType::class,
                [
                    'help' => 'bank_account_number_caption',
                ]
            )
            ->add('bankName')
            ->add(
                'bankCode',
                TextType::class,
                [
                    'help' => 'bank_code_caption',
                ]
            )
            ->add(
                'bankRegistrationNumber',
                TextType::class,
                [
                    'help' => 'bank_registration_number_caption',
                ]
            )
            ->add(
                'bankIban',
                TextType::class,
                [
                    'required' => false,
                    'help' => 'bank_iban_caption',
                ]
            )
            ->add(
                'bankCertificate',
                FileType::class,
                [
                    'help' => 'bank_certificate_caption',
                ]
            )
            //Section 4
            ->add(
                'warehouseContact',
                TextType::class,
                [
                    'help' => 'warehouse_contact_caption',
                ]
            )
            ->add(
                'warehouseAddress',
                TextType::class,
                [
                    'help' => 'warehouse_address_caption',
                ]
            )
            ->add(
                'warehouseAddressExtraData',
                TextType::class,
                [
                    'help' => 'warehouse_address_extra_data_caption',
                ]
            )
            ->add(
                'warehouseAddressExtraData2',
                TextType::class,
                [
                    'help' => 'warehouse_address_extra_data2_caption',
                ]
            )
            ->add('warehouseAddress2')
            ->add(
                'warehouseCity',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getWarehouseCities($store),
                    'placeholder' => 'Choose an option',
                ]
            )
            ->add(
                'warehouseReferencePoint',
                TextType::class,
                [
                    'help' => 'warehouse_reference_point',
                ]
            )
            ->add(
                'warehousePhone',
                TextType::class,
                [
                    'help' => 'warehouse_phone_caption',
                ]
            )
            ->add(
                'warehousePostalCode',
                TextType::class,
                [
                    'help' => 'warehouse_postal_code_caption',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Account::class,
                'store' => 'pe',
            ]
        );
    }
}
