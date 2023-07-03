<div id="toast-container" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
    <div @class(['toast text-white py-2 px-3 m-3 rounded w-fit fixed z-50 right-0', match($type) {
            \App\Plugins\SimpleToast\ToastType::Success => 'bg-green-500',
            \App\Plugins\SimpleToast\ToastType::Error => 'bg-red-500',
            \App\Plugins\SimpleToast\ToastType::Info => 'bg-blue-500',
            \App\Plugins\SimpleToast\ToastType::Warning => 'bg-yellow-500',
        }])>
        {{ $message }}
    </div>
</div>
