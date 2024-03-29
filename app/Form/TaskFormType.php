<?php

namespace App\Form;

use App\Entity\Task\Task;
use App\Form\TaskField\IndexType;
use App\Form\TaskField\PreviewType;
use App\Form\TaskField\ReplacebleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class TaskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(
                        allowNull: false,
                        message: 'Обязательно для заполнения',
                    ),
                ],
            ])
            ->add('spreadsheetId', GoogleSheetUrlType::class, [
                'required' => false,
                'constraints' => [
                    new NotBlank(
                        allowNull: false,
                        message: 'Обязательно для заполнения',
                    ),
                ],
            ])
            ->add('indexField', IndexType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('previewField', PreviewType::class, [
                'required' => false,
            ])
            ->add('replacebleFields', CollectionType::class, [
                'entry_type' => ReplacebleType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'prototype' => true,
                'label' => false,
                'allow_delete' => true,
                'required' => false,
            ])
            ->add('layouts', FileType::class, [
                'label' => 'Шаблоны',
                'mapped' => false,
                'multiple' => true,
                'required' => false,
                'data_class' => null,
                'attr' => [
                    'accept' => implode(',', [
                       '.docx', '.doc',
                    ]),
                    'multiple' => 'multiple',
                ],
                'constraints' => [
                    new All([
                        'constraints' => [
                            new File(
                                maxSize: '5m',
                                mimeTypes: [
                                    'application/msword',
                                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                ],
                            ),
                        ],
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'allow_extra_fields' => true,
        ]);
    }
}
