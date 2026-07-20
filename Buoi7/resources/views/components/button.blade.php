@props(['type' => 'primary', 'btnType' => 'submit'])

@php
// Định nghĩa style tương ứng với biến thể primary hoặc danger
$bgColor = $type === 'danger' ? '#DC2626' : '#2563EB';
$hoverColor = $type === 'danger' ? '#B91C1C' : '#1D4ED8';
@endphp

<button type="{{ $btnType }}" {{ $attributes->merge(['style' => "background-color: {$bgColor}; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px;"]) }}>
    {{ $slot }}
</button>