<?php

namespace App\Entity\File;

use App\Entity\Task\Layout;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class LayoutFile extends File
{
    #[ORM\OneToOne(mappedBy: 'file', targetEntity: Layout::class)]
    private Layout $layout;

    /**
     * @return Layout
     */
    public function getLayout(): Layout
    {
        return $this->layout;
    }

    /**
     * @param Layout $layout
     * @return LayoutFile
     */
    public function setLayout(Layout $layout): LayoutFile
    {
        $this->layout = $layout;
        return $this;
    }
}
