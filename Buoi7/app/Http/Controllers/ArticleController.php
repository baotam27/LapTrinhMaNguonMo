<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Tạm thời dùng mảng mô phỏng dữ liệu
        $articles = [
            ['id' => 1, 'title' => 'Giới thiệu Laravel 12', 'body' => 'Nội

dung A'],

            ['id' => 2, 'title' => 'Blade Components', 'body' => 'Nội dung

B'],
        ];
        return view('articles.index', compact('articles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:10'],
        ]);
        // Tạm thời: giả lưu, thực tế sẽ lưu DB ở buổi sau
        return redirect()->route('articles.index')
            ->with('success', 'Tạo bài viết thành công (demo).');
    }
    /**
     * Display the specified resource.
     */
    /**

     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tạm dữ liệu mẫu
        $article = ['id' => $id, 'title' => 'Tiêu đề mẫu', 'body' => 'Nội
dung mẫu'];
        return view('articles.edit', compact('article'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'min:10'],
        ]);
        return redirect()->route('articles.index')
            ->with('success', "Cập nhật bài viết #$id thành công (demo).");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Giả lập xóa dữ liệu và trả về thông báo flash
        return redirect()->route('articles.index')
            ->with('success', "Đã xoá thành công bài viết #{$id} (demo).");
    }

    /**
     * Bài tập 06: Route Model Binding
     */
    public function show(Article $article)
    {
        // Nhờ Route Model Binding, $article sẽ tự động nhận giá trị ID từ Route
        // Ở đây ta mock tạm dữ liệu để hiển thị giao diện
        $article->title = $article->title ?? 'Bài viết mẫu #' . $article->id;
        $article->body = $article->body ?? 'Nội dung chi tiết của bài viết mẫu này.';

        return "<h1>" . e($article->title) . "</h1><p>" . e($article->body) . "</p>";
    }
}
