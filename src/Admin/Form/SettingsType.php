<?php

namespace Citadel\Levels\Admin\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'levels__thread_post_xp',
                IntegerType::class,
                [
                'label' => 'Thread Post XP',
                'help' => 'How much XP per thread post?'
                ]
            )
            ->add(
                'levels__comment_post_xp',
                IntegerType::class,
                [
                'label' => 'Comment XP',
                'help' => 'How much XP per comment?'
                ]
            )
            ->add(
                'levels__display_banner',
                ChoiceType::class,
                [
                'choices' => [
                  'Banner' => 'banner',
                  'Xp' => 'xp'
                ],
                'expanded' => true,
                'multiple' => false,
                'label'  => 'Display Style',
                'help'   => 'Would you prefer to display the banner or the xp bar on forums?'
                ]
            );
    }
}
