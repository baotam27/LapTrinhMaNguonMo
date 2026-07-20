<nav style="margin-bottom: 16px; font-size: 14px; color: #4B5563;">
    <a href="{{ url('/') }}" style="color: #2563EB; text-decoration: none;">Trang chủ</a> 
    &gt; 
    <a href="{{ route('articles.index') }}" style="color: #2563EB; text-decoration: none;">Articles</a>

    @if(Route::currentRouteName() == 'articles.create')
        &gt; <span>Tạo bài viết</span>
    @elseif(Route::currentRouteName() == 'articles.edit')
        &gt; <span>Chỉnh sửa bài viết</span>
    @elseif(Route::currentRouteName() == 'articles.show')
        &gt; <span>Chi tiết bài viết</span>
    @endif
</nav>