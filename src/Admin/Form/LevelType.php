<?php

namespace Citadel\Levels\Admin\Form;

use Citadel\Levels\Core\Entity\Level;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class LevelType extends AbstractType
{
    public function __construct(
        private readonly Packages $packages
    ) {
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
            'data_class' => Level::class,
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $imagePreview = empty($options['data']) ? null : $options['data']->getImage();

        $builder
            ->add(
                'name', TextType::class, [
                ]
            )
            ->add(
                'xpThreshold', IntegerType::class, [
                ]
            )
            ->add(
                'image', FileType::class, [
                'mapped' => false,
                'label' => 'Banner',
                'help' => 'Recommended size is 134x30.',
                'attr' => [
                    'preview' => $imagePreview
                        ? $this->packages->getUrl($imagePreview, 'levels.banner')
                        : null,
                ],
                'constraints' => [
                    new Assert\Image(
                        maxSize: '10M',
                    ),
                ],
                ]
            );
    }
}
