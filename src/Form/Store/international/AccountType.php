<?php

declare(strict_types=1);

namespace App\Form\Store\international;

use App\Entity\Store\international\Account;
use App\Service\SellerSignUpService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('bankName', ChoiceType::class, [
                'choices' => $this->sellerSignUpService->getInternationalPaymentMethods(),
                'placeholder' => 'Choose an option',
                'expanded' => true,
            ])
            ->add(
                'warehouseAddress',
                TextType::class,
                [
                    'help' => 'warehouse_address_caption',
                ]
            )
            ->add('warehouseAddress2')
            ->add('warehouseCountry', ChoiceType::class, [
                'choices' => $this->sellerSignUpService->getLegalCountries(),
                'placeholder' => 'Choose an option',
            ])
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
                'fiscalIdNumber',
                TextType::class,
                [
                    'help' => 'fiscal_id_number_caption',
                ]
            )
            ->add('secondaryPhone')
            ->add('socialNetworks');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Account::class,
                'store' => 'international',
            ]
        );
    }
}
