<?php

namespace Citadel\Levels\Admin\Form;

use Citadel\Levels\Core\Entity\Level;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('levels__thread_post_xp', IntegerType::class, [
                'label' => 'Thread Post XP',
                'help' => 'How much XP per thread post?'
            ])
            ->add('levels__comment_post_xp', IntegerType::class, [
                'label' => 'Comment XP',
                'help' => 'How much XP per comment?'
            ]);
    }
}