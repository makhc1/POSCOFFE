Illuminate\Contracts\View\ViewCompilationException
vendor\laravel\framework\src\Illuminate\View\Compilers\Concerns\CompilesLoops.php:106
Malformed @foreach statement.

LARAVEL
13.31.0
PHP
8.5.8
UNHANDLED
CODE 0
500
GET
http://127.0.0.1:8000/menu

Exception trace
11 vendor frames

Illuminate\View\Factory->renderComponent()
resources\views\layouts\app.blade.php:53

48</head>
49<body class="antialiased min-h-[100dvh] flex flex-col selection:bg-[#4E342E] selection:text-[#FDFBF7]">
50    <div class="grain-overlay"></div>
51    <div class="fixed inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#8D6E63]/[0.08] via-[#FDFBF7]/0 to-transparent pointer-events-none z-[-1]"></div>
52
53    <x-ui.navbar-5 />
54
55    <main class="flex-grow pt-32 pb-40">
56        @yield('content')
57    </main>
58
59    @include('components.footer')
60
61    @stack('scripts')
62</body>
63</html>
64
7 vendor frames

Illuminate\View\View->render()
resources\views\menu\index.blade.php:138

57 vendor frames

Illuminate\Foundation\Application->handleRequest(object(Illuminate\Http\Request))
public\index.php:20

1 vendor frame

Queries
1-5 of 5
mysql
select * from `sessions` where `id` = 'Z4BYG1bchnuMzC3Opi9ePUaZzAhPwgbiGDB0Dm8r' limit 1
4.11ms
mysql
select `categories`.*, (select count(*) from `products` where `categories`.`id` = `products`.`category_id`) as `products_count` from `categories` order by `sort_order` asc
3.06ms
mysql
select count(*) as `aggregate` from `products` where `is_available` = 1
0.51ms
mysql
select * from `products` where `is_available` = 1 order by `is_best_seller` desc, `id` asc limit 12 offset 0
0.53ms
mysql
select * from `categories` where `categories`.`id` in (1, 2, 3, 4)
0.49ms
Headers
host
127.0.0.1:8000
connection
keep-alive
cache-control
max-age=0
sec-ch-ua
"Brave";v="153", "Not_A Brand";v="8", "Chromium";v="153"
sec-ch-ua-mobile
?0
sec-ch-ua-platform
"Windows"
upgrade-insecure-requests
1
user-agent
Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36
accept
text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8
sec-gpc
1
sec-fetch-site
same-origin
sec-fetch-mode
navigate
sec-fetch-user
?1
sec-fetch-dest
document
referer
http://127.0.0.1:8000/
accept-encoding
gzip, deflate, br, zstd
accept-language
en-US,en;q=0.5
cookie
XSRF-TOKEN=eyJpdiI6ImplVGlEcDlnb1V1U2RMS2lrUkxYYnc9PSIsInZhbHVlIjoiTWZpcGFMb0ROV3BvRUd3K3F1WjlHdDFuUno2MlFpMjk3UkVKN25tUHBrSGpSWXhPWnR2dTdEUDRVVDl6Ym1jaGRJL3NGdmRiZFlrd3dlTHN4KzR2dThaWUU0NGdNVC9hdWdsRklKa1doZi9sVnpDTUVON01vWWEwSUVWU05aK2QiLCJtYWMiOiJjZWVmNjE1OGE5YzBmN2Q0YzIwNDEzMTJiNmFhZDFhMDBmNzg3N2UxNzY0NDllOWU2MjJhZTFjMjMzZDdkYzc2IiwidGFnIjoiIn0%3D; poscoffe-session=eyJpdiI6IjBhTzdmSm5sOEw3WHU4ekI5dWlpU1E9PSIsInZhbHVlIjoiQkxrMnpMZlZTRlZacWxsQ29Uczh4SVVUdzI5Q3M2dE1GWnlvbXEycXJEYnVVVlNSN0FqM0ozTmpabTJLYWRVZkZLVGh0MmI5SmYyK0dXdjB4bkhnVHpUelFLcU04SWtRb0g0Y2RkUGQzRW4rZXhiNzBVZERZRWhSZDhiWUF2V3oiLCJtYWMiOiI0YTRkY2RkZWI0NWUxMTYyMDhiYWY1NmNmN2U0NjY1NmY0ZWY4ZjU3MDZlYjU0Njc2ZDhmOTFiNmI5MTAxMzQ0IiwidGFnIjoiIn0%3D
Body
// No request body
Routing
controller
App\Http\Controllers\MenuController@index
route name
menu.index
middleware
web
Routing parameters
// No routing parameters
