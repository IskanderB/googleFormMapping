<?php

namespace App\Form;

use App\Entity\Task\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;

class TaskFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('spreadsheetId', TextType::class)
            ->add('sheetName', TextType::class, [
                'required' => false,
            ])
            ->add('preview', TextType::class)
            ->add('fields', CollectionType::class, [
                'entry_type' => TaskFieldType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'prototype' => true,
                'label' => false
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
            ])
            ->add('save', SubmitType::class, ['label' => 'Save task']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'allow_extra_fields' => true,
        ]);
    }
}
