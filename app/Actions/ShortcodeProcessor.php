<?php

namespace App\Actions;

class ShortcodeProcessor
{
    protected string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function process(): string
    {
        $this->content = $this->processShortcodes($this->content);

        return $this->content;
    }

    protected function processShortcodes(string $string): string
    {
        $string = str_replace('[[ WikiName ]]', \WikiSettings::$WikiName, $string);

        return $string;
    }
}