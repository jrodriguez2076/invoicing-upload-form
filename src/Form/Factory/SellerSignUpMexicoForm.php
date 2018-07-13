<?php

declare(strict_types=1);

namespace App\Form\Factory;

use App\Entity\SellerSignUp;
use App\Service\SellerSignUpService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellerSignUpMexicoForm extends AbstractType
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
        $builder
            ->add('accountManagerName')
            ->add(
                'phoneNumber',
                TextType::class,
                [
                    'help' => 'phone_number_caption',
                ]
            )
            ->add('accountName', TextType::class, ['help' => 'account_name_caption'])
            ->add(
                'email',
                RepeatedType::class,
                [
                    'type' => EmailType::class,
                    'first_options' => ['label' => 'Email', 'help' => 'email_caption'],
                    'second_options' => ['label' => 'Repeat Email'],
                ]
            )
            ->add('acceptManifest', CheckboxType::class)
            ->add('acceptTermsAndConditions', CheckboxType::class)
            ->add('acceptCommissionsAndPaymentPolicy', CheckboxType::class)
            //Section 2
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
                    'choices' => $this->sellerSignUpService->getContributorTypesChoices($options['store']),
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
                'city',
                TextType::class,
                [
                    'help' => 'city_caption',
                ]
            )
            ->add(
                'postalCode',
                TextType::class,
                [
                    'help' => 'postal_code_caption',
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
                'logisticDocument',
                FileType::class,
                [
                    'label_format' => 'logistic_document_caption',
                ]
            )
            ->add(
                'idAdditionalDoc',
                FileType::class,
                [
                    'label_format' => 'id_additional_doc_caption',
                ]
            )
            ->add('financeContactName')
            ->add('financeContactMail')
            ->add('financeContactPhone')
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
                    'label_format' => 'bank_certificate_caption',
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
            ->add('warrantyContact', EmailType::class)

            //Section 5
            ->add('operativeCheckLegallyConstituted', CheckboxType::class)
            ->add('operativeCheckCatalog', CheckboxType::class)
            ->add('operativeCheckInventory', CheckboxType::class)
            ->add('operativeCheckDelivery', CheckboxType::class)
            ->add('operativeCheckReturns', CheckboxType::class)
            ->add('operativeCheckShippingAgreement', CheckboxType::class)
            ->add('operativeCheckInvoices', CheckboxType::class)
            ->add('earningsEstimate')
            //Section 6
            ->add(
                'mainCategory',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getMainCategoriesChoices($options['store']),
                ]
            )
            ->add(
                'secondaryCategory',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getSecondaryCategoriesChoices($options['store']),
                ]
            )
            ->add(
                'potentialCatalog',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getPotentialCatalogChoices($options['store']),
                ]
            )
            //Section 7
            ->add('website')
            ->add(
                'otherStoresList',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getOtherStoresListChoices($options['store']),
                ]
            )
            ->add('otherStoreName')
            ->add('otherStoresAddress')
            ->add(
                'otherStoresRating',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getOtherStoresRatingChoices($options['store']),
                ]
            )
            //Section 8
            ->add('officialDistributorBrand')
            ->add('brand1')
            ->add('brand2')
            ->add('brand3')
            ->add(
                'marketingInvest',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getMarketingInvestChoices($options['store']),
                ]
            )
            ->add(
                'integrationFlag',
                ChoiceType::class,
                [
                    'choices' => $this->sellerSignUpService->getIntegrationFlagChoices($options['store']),
                ]
            )
            ->add('Submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => SellerSignUp::class,
                'store' => 'mx',
            ]
        );
    }
}
