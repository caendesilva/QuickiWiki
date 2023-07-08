<div id="toast-container" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
    <div @class(['toast text-white py-2 px-3 m-3 rounded w-fit fixed z-50 right-0', \App\Plugins\SimpleToast\Toast::TYPES[$type]])>
        {{ $message }}
    </div>
</div>
