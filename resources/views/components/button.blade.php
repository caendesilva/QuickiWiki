@php($tag = $attributes->get('href') ? 'a' : 'button')
<{{ $tag }} {{ $attributes }}>
    {{ $slot }}
</{{ $tag }}>
