@props(['type' => 'success','title' => 'Thông báo'])
<div style="padding:10px;border-radius:8px;margin-bottom:10px;
        background: {{ $type==='success' ? '#ECFDF5' : '#FEF3C7' }};
        color: {{ $type==='success' ? '#065F46' : '#92400E' }};">
    <strong>{{ $title }}:</strong> {{ $slot }}
</div>