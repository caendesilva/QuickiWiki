<?php

namespace App\Plugins\SimpleToast;

enum ToastType: string
{
    case Success = 'success';
    case Error = 'error';
    case Info = 'info';
    case Warning = 'warning';
}
