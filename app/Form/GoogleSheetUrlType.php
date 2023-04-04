<?php

namespace App\Form;

use App\Entity\Task\Task;
use App\Url\GoogleSheetUrl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class GoogleSheetUrlType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'setter' => function (Task &$task, ?string $spreadsheetUrl, FormInterface $form) {
                $task->setSpreadsheetId(
                    $spreadsheetUrl ? GoogleSheetUrl::fromUrl($spreadsheetUrl)->getCloudId() : null
                );
            },
            'getter' => function (Task $task, FormInterface $form): ?string {
                $spreadsheetId = $task->getSpreadsheetId();

                return $spreadsheetId
                    ? GoogleSheetUrl::fromCloudId($spreadsheetId)->getUrl()
                    : null;
            },
            'required' => false,
            'constraints' => [
                new NotBlank(
                    allowNull: false,
                    message: 'Обязательно для заполнения',
                ),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): string
    {
        return TextType::class;
    }
}
