<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Articles')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        }

        .container {
            max-width: 960px;
            margin: 24px auto;
        }

        .flash {
            padding: 10px;
            margin-bottom: 12px;
            background: #ECFDF5;
            color: #065F46;
            border-radius: 8px;
        }

        nav a {
            margin-right: 8px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }
    </style>
    @stack('styles')
</head>

<body>
    @include('partials.nav')

    <div class="container">
        {{-- Bài tập 09: Nhúng Partial Breadcrumb hiển thị đường dẫn theo Route hiện tại --}}
        @include('partials.breadcrumb')

        @if(session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    @include('partials.footer')
    @stack('scripts')
</body>

</html>