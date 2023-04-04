<?php

namespace App\Form\TaskField;

use App\Entity\Task\Field\PreviewField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PreviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sheetKey', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(
                        allowNull: false,
                        message: 'Обязательно для заполнения',
                    ),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PreviewField::class,
            'allow_extra_fields' => true,
        ]);
    }
}
