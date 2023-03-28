<?php

namespace App\Form\TaskField;

use App\Entity\Task\Field\ReplacebleField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReplacebleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sheetKey', TextType::class)
            ->add('documentKey', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReplacebleField::class,
            'allow_extra_fields' => true,
        ]);
    }
}
