<?php

declare(strict_types=1);

namespace App\Form\Store\co;

use App\Entity\Contact;
use App\Form\GeneralInfoType;
use App\Service\ContactService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactForm extends AbstractType
{
    /**
     * @var ContactService
     */
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $store = $options['store'];

        $builder
            ->add('generalInfo', GeneralInfoType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Contact::class,
                'store' => 'co',
            ]
        );
    }
}
