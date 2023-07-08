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
        'success' => 'bg-green-500',
        'error' => 'bg-red-500',
        'info' => 'bg-blue-500',
        'warning' => 'bg-yellow-500',
    ];

    public static function listen(): ?HtmlString
    {
        return Session::has('toast') ? Session::pull('toast')->toHtml() : null;
    }

    public static function flash(string $message, string $type = 'info'): void
    {
        Session::flash('toast', new Toast($message, $type));
    }

    public function __construct(string $message, string $type = 'info')
    {
        if (! array_key_exists($type, static::TYPES)) {
            throw new \InvalidArgumentException("Invalid toast type: {$type}");
        }

        $this->message = $message;
        $this->type = $type;
    }

    public function toHtml(): HtmlString
    {
        return new HtmlString(view('components.plugins.simple-toast.toast', [
            'background' => static::TYPES[$this->type],
            'message' => $this->message,
            'type' => $this->type,
        ])->render());
    }
}