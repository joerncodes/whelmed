<?php

namespace App\Form\Type;

use App\Domain\Constants\Icons;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IconType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $choices = [];

        foreach(Icons::ICONS as $label => $icon) {
            $choices[$label] = $icon;
        }

        $resolver->setDefaults([
            'choices' => $choices
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getName()
    {
        return 'icon';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'icon';
    }
}
