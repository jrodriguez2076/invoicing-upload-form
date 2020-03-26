<?php

declare(strict_types=1);

namespace App\Form\Store\co;

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
                array_merge(
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
            $fieldConfig = $form->get('additionalInfo')->has($enabledField) ? $form->get('additionalInfo')->get($enabledField)->getConfig() : null;

            if (!$fieldConfig) {
                continue;
            }

            $fieldOptions = $fieldConfig->getOptions();

            if (array_key_exists('required', $fieldOptions) && !$fieldOptions['required']) {
                continue;
            }

            $additionalInfoForm = $form->get('additionalInfo');
            $additionalInfoForm->add(
                $enabledField,
                get_class($fieldConfig->getType()->getInnerType()),
                array_merge(
                    $fieldOptions,
                    [
                        'constraints' => [
                            new NotBlank(),
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
                'store' => 'co',
                'reasons' => null,
                'reasonsEnabledFields' => null,
            ]
        );
    }
}
