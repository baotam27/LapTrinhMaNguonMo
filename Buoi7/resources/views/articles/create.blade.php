@extends('layouts.app')

@section('title', 'Tạo bài viết')

{{-- Bài tập 08: Dùng @push('styles') chèn CSS tùy biến riêng cho trang tạo bài viết --}}
@push('styles')
<style>
    .form-group {
        margin-bottom: 15px;
    }
    textarea {
        font-family: inherit;
        resize: vertical;
    }
</style>
@endpush

@section('content')
<h2>Tạo bài viết</h2>

<x-alert type="warning" title="Lưu ý">
    Dữ liệu hiện chỉ mô phỏng (chưa lưu DB).
</x-alert>

<form action="{{ route('articles.store') }}" method="post">
    @csrf
    
    <div class="form-group">
        <x-input name="title" label="Tiêu đề" />
    </div>

    <div class="form-group">
        <label style="display:block; margin:8px 0 4px">Nội dung</label>
        <textarea name="body" rows="6" style="width:100%; padding:8px; border:1px solid #e5e7eb; border-radius:6px">{{ old('body') }}</textarea>
        @error('body')
            <div style="color:#991B1B; margin-top:4px">{{ $message }}</div>
        @enderror
    </div>

    {{-- Bài tập 08: Sử dụng x-button biến thể primary --}}
    <x-button type="primary" style="margin-top: 10px;">
        Lưu bài viết
    </x-button>
</form>
@endsection