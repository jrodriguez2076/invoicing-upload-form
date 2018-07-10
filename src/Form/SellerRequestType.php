<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\SellerRequest;
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

class SellerRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accountManagerName')
            ->add('phoneNumber', TextType::class, [
                'help' => 'phone_number_caption',
            ])
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
            #Section 2
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
                    'choices' => SellerRequest::getContributorTypesChoices($options['country']),
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
            ->add('city', TextType::class, [
                'help' => 'city_caption',
            ])
            ->add('postalCode', TextType::class, [
                'help' => 'postal_code_caption',
            ])
            ->add('economicActivity')
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
            #Section 3
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
            #Section 4
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
            ->add('warehousePhone', TextType::class, [
                'help' => 'warehouse_phone_caption'
            ])
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
                    'choices' => SellerRequest::getWarehouseModeChoices($options['country']),
                    'help' => 'warehouse_mode_caption',
                ]
            )
            ->add('warrantyContact', EmailType::class)
            #Section 5
            ->add('operativeCheckLegallyConstituted', CheckboxType::class)
            ->add('operativeCheckCatalog', CheckboxType::class)
            ->add('operativeCheckInventory', CheckboxType::class)
            ->add('operativeCheckDelivery', CheckboxType::class)
            ->add('operativeCheckReturns', CheckboxType::class)
            ->add('operativeCheckShippingAgreement', CheckboxType::class)
            ->add('operativeCheckInvoices', CheckboxType::class)
            ->add('earningsEstimate')
            #Section 6
            ->add(
                'mainCategory',
                ChoiceType::class,
                [
                    'choices' => SellerRequest::getMainCategoriesChoices($options['country']),
                ]
            )
            ->add(
                'secondaryCategory',
                ChoiceType::class,
                [
                    'choices' => SellerRequest::getSecondaryCategoriesChoices($options['country']),
                ]
            )
            ->add(
                'potentialCatalog',
                ChoiceType::class,
                [
                    'choices' => SellerRequest::getPotentialCatalogChoices($options['country']),
                ]
            )
            #Section 7
            ->add('website')
            ->add(
                'otherStoresList',
                ChoiceType::class,
                [
                    'choices' => SellerRequest::getOtherStoresListChoices($options['country']),
                ]
            )
            ->add('otherStoreName')
            ->add('otherStoresAddress')
            ->add(
                'otherStoresRating',
                ChoiceType::class,
                [
                    'choices' => SellerRequest::getOtherStoresRatingChoices($options['country']),
                ]
            )
            #Section 8
            ->add('officialDistributorBrand')
            ->add('brand1')
            ->add('brand2')
            ->add('brand3')
            ->add(
                'marketingInvest',
                ChoiceType::class,
                [
                    'choices' => SellerRequest::getMarketingInvestChoices($options['country']),
                ]
            )
            ->add(
                'integrationFlag',
                ChoiceType::class,
                [
                    'choices' => SellerRequest::getIntegrationFlagChoices($options['country']),
                ]
            )
            ->add('Submit', SubmitType::class);

        switch ($options['country']) {
            case 'ar':
                $builder
                    ->remove('logisticDocument')
                    ->remove('financeContactName')
                    ->remove('financeContactMail')
                    ->remove('financeContactPhone')
                    ->remove('warrantyContact');
                break;
            case 'cl':
                $builder
                    ->remove('logisticDocument')
                    ->remove('financeContactName')
                    ->remove('financeContactMail')
                    ->remove('financeContactPhone')
                    ->remove('warrantyContact')
                    ->remove('warehouseMode')
                    ->remove('idAdditionalDoc')
                    ->remove('bankCertificate')
                    ;
                break;
            case 'co':
                break;
            case 'ec':
                break;
            case 'mx':
                $builder
                    ->remove('bankRegistrationNumber')
                    ->remove('warehouseMode')
                ;
                $this->updateRequiredOption($builder, 'bankIban', false);
                break;
            case 'pa':
            case 'pe':
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => SellerRequest::class,
                'country' => 'mx',
            ]
        );
    }

    protected function updateRequiredOption(FormBuilderInterface $builder, string $fieldName, bool $required)
    {
        $field = $builder->get($fieldName);
        $options = $field->getOptions();
        $type = get_class($field->getType()->getInnerType());
        $options['required'] = $required;
        $builder->add($fieldName, $type, $options);
    }
}
