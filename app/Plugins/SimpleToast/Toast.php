<?php

namespace App\Plugins\SimpleToast;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;

/**
 * @experimental 
 */
class Toast implements Htmlable
{
    public string $message;
    public string $type;

    public const TYPES = [
        'success',
        'error',
        'info',
        'warning',
    ];

    public static function flash(string $message, string $type = 'info'): void
    {
        Session::flash('toast', new Toast($message, $type));
    }

    public function __construct(string $message, string $type = 'info')
    {
        if (! in_array($type, static::TYPES)) {
            throw new \InvalidArgumentException("Invalid toast type: {$type}");
        }

        $this->message = $message;
        $this->type = $type;
    }

    public function toHtml(): HtmlString
    {
        return new HtmlString(view('components.plugins.simple-toast.toast', [
            'message' => $this->message,
            'type' => $this->type,
        ])->render());
    }
}