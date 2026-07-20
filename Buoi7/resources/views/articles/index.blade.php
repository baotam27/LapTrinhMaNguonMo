@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
<h2>Danh sách bài viết</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($articles as $a)
            <tr>
                <td>{{ $a['id'] }}</td>
                <td>{{ $a['title'] }}</td>
                <td>
                    <a href="{{ route('articles.show', $a['id']) }}">Xem</a> |
                    <a href="{{ route('articles.edit', $a['id']) }}">Sửa</a> |
                    
                    <!-- Bài tập 07: Form xóa an toàn bằng Method Spoofing và Confirm JS -->
                    <form action="{{ route('articles.destroy', $a['id']) }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        
                        <!-- Bài tập 08: Sử dụng x-button biến thể danger -->
                        <x-button type="danger" onclick="return confirm('Bạn có chắc chắn muốn xoá bài viết này không?')">
                            Xoá
                        </x-button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Chưa có bài viết.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@push('scripts')
<script>
    // Demo stack scripts cho Bài tập 03
    console.log('Articles index loaded');
</script>
@endpush
@endsection