<?php

namespace App\Form;

use App\Entity\Task\Task;
use App\Url\GoogleSheetUrl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoogleSheetUrlType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'setter' => function (Task &$task, string $spreadsheetUrl, FormInterface $form) {
                $task->setSpreadsheetId(GoogleSheetUrl::fromUrl($spreadsheetUrl)->getCloudId());
            },
            'getter' => function (Task $task, FormInterface $form): ?string {
                $spreadsheetId = $task->getSpreadsheetId();

                return $spreadsheetId
                    ? GoogleSheetUrl::fromCloudId($spreadsheetId)->getUrl()
                    : null;
            },
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
