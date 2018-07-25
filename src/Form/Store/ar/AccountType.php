<?php

declare(strict_types=1);

namespace App\Form\Store\ar;

use App\Entity\Account;
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
                'legalCity',
                TextType::class,
                [
                    'help' => 'legal_city_caption',
                ]
            )
            ->add(
                'legalCountry',
                ChoiceType::class,
                [
                    'help' => 'legal_country_caption',
                    'choices' => $this->sellerSignUpService->getLegalCountries(),
                    'placeholder' => 'Choose an option',
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
                    'label_format' => 'fiscal_id_additional_doc_caption',
                ]
            )
            ->add(
                'idAdditionalDoc',
                FileType::class,
                [
                    'label_format' => 'id_additional_doc_caption',
                ]
            )
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
                    'required' => true,
                    'help' => 'bank_iban_caption',
                ]
            )
            ->add(
                'bankCertificate',
                FileType::class,
                [
                    'label_format' => 'bank_certificate_caption',
                ]
            )
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
            ->add('warehouseAddress2')
            ->add('warehouseCity')
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
            )
            ->add(
                'warehouseMode',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getWarehouseModeChoices($store),
                    'placeholder' => 'Choose an option',
                    'help' => 'warehouse_mode_caption',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Account::class,
                'store' => 'ar',
            ]
        );
    }
}
