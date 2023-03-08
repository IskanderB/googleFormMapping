<?php

namespace App\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Stringable;

#[ORM\Embeddable]
class Content implements Stringable
{
    #[ORM\Column(type: 'text', nullable: false)]
    private ?string $content = null;

    public function __construct(array $content)
    {
        $this->setContent($content);
    }

    public function setContent(array $content): void
    {
        $this->content = json_encode($content);
    }

    public function getContent(): array
    {
        return json_decode($this->content, true);
    }

    public function __toString(): string
    {
        return $this->content;
    }
}
