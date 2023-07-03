<?php

namespace App\Plugins\SimpleToast;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;

class Toast implements Htmlable
{
    public string $message;
    public ToastType $type;

    public static function listen(): ?HtmlString
    {
        return Session::has('toast') ? Session::pull('toast')->toHtml() : null;
    }

    public static function flash(string $message, ToastType|string $type = ToastType::Info): void
    {
        Session::flash('toast', new Toast($message, $type));
    }

    public function __construct(string $message, ToastType|string $type = ToastType::Info)
    {
        $this->message = $message;
        $this->type = $type instanceof ToastType ? $type : ToastType::from($type);
    }

    public function toHtml(): HtmlString
    {
        return new HtmlString(view('components.plugins.simple-toast.toast', [
            'message' => $this->message,
            'type' => $this->type,
        ])->render());
    }
}