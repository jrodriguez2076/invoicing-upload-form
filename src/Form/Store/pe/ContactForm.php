<?php

declare(strict_types=1);

namespace App\Form\Store\pe;

use App\Form\GeneralInfoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('generalInfo', GeneralInfoType::class, ['reasons' => $options['reasons']])
            ->add('additionalInfo', AdditionalInfoType::class)
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                [$this, 'onPreSubmit']
            );
    }

    public function onPreSubmit(FormEvent $event): void
    {
        $form = $event->getForm();
        $contact = $event->getData();
        $reasonEnabledFields = $form->getConfig()->getOption('reasonsEnabledFields');
        $selectedReason = $contact['generalInfo']['reasons'];

        if (empty($reasonEnabledFields[$selectedReason])) {
            $fieldConfig = $form->get('additionalInfo')->get('reason')->getConfig();
            $fieldOptions = $fieldConfig->getOptions();
            $additionalInfoForm = $form->get('additionalInfo');
            $additionalInfoForm->add(
                'reason',
                get_class($fieldConfig->getType()->getInnerType()),
                array_replace(
                    $fieldOptions,
                    [
                        'required' => true,
                        'constraints' => new NotBlank(),
                    ]
                )
            );

            return;
        }

        foreach ($reasonEnabledFields[$selectedReason] as $enabledField) {
            $fieldConfig = $form->get('additionalInfo')->get($enabledField)->getConfig();
            $fieldOptions = $fieldConfig->getOptions();
            $additionalInfoForm = $form->get('additionalInfo');
            $additionalInfoForm->add(
                $enabledField,
                get_class($fieldConfig->getType()->getInnerType()),
                array_replace(
                    $fieldOptions,
                    [
                        'constraints' => [
                            new NotBlank(),
                        ],
                        'attr' => [
                            'class' => 'additionalField ' . $enabledField,
                        ],
                        'label_attr' => [
                            'class' => 'additionalField ' . $enabledField,
                        ],
                    ]
                )
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'store' => 'pe',
                'reasons' => null,
                'reasonsEnabledFields' => null,
            ]
        );
    }
}
