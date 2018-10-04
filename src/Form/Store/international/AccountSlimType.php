<?php

declare(strict_types=1);

namespace App\Form\Store\international;

use App\Entity\Store\international\Account;
use App\Service\SellerSignUpService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountSlimType extends AbstractType
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
            ->add('secondaryPhone');
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
