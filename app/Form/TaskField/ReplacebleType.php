<?php

namespace App\Form\TaskField;

use App\Entity\Task\Field\ReplacebleField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReplacebleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sheetKey', TextType::class, [
                'label' => 'Поле в таблице',
                'label_attr' => [
                    'class' => 'task-form__collection--row-label',
                ],
                'attr' => [
                    'class' => 'task-form__sluggable-input',
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank(
                        allowNull: false,
                        message: 'Обязательно для заполнения',
                    ),
                ],
            ])
            ->add('documentKey', TextType::class, [
                'label' => 'Ключ в шаблоне',
                'label_attr' => [
                    'class' => 'task-form__collection--row-label',
                ],
                'attr' => [
                    'class' => 'task-form__sluggable-target',
                ],
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
            'data_class' => ReplacebleField::class,
            'allow_extra_fields' => true,
            'attr' => [
                'class' => 'task-form__collection--row'
            ],
        ]);
    }
}
