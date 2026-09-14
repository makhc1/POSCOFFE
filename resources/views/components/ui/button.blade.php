@props(['variant' => 'primary'])

@php
    $baseClasses = 'px-5 py-2 rounded-md font-medium transition-colors text-sm';
    $variantClasses = [
        'primary' => 'bg-[#2D2420] text-[#FDFBF7] hover:bg-[#4E342E]',
        'outline' => 'border border-[#2D2420]/20 bg-transparent hover:bg-[#2D2420]/5 text-[#2D2420]',
    ];
    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
