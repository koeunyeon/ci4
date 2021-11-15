<?php

namespace App\Entities;

use Michelf\Markdown;

class PostEntity extends \CodeIgniter\Entity
{
    private function to_markdown($content)
    {
        $content = str_replace(PHP_EOL, "  " . PHP_EOL, $content);
        return Markdown::defaultTransform($content);
    }

    public function setContent($content)
    {
        $this->attributes['content'] = $content;
        $this->attributes['html_content'] = $this->to_markdown($content);
    }
}