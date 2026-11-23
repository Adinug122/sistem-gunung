<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 - Halaman Tidak Ditemukan</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body {
                font-family: 'Figtree', sans-serif;
            }
            .number-404 {
                background: linear-gradient(135deg, #0f0f0f 0%, #4a4a4a 50%, #0f0f0f 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
        </style>
    </head>
    <body class="bg-white min-h-screen flex flex-col items-center justify-center text-gray-900">
        <div class="text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-9xl md:text-[10rem] font-extrabold number-404 mb-0 tracking-tight leading-none">
                404
            </h1>

            <h2 class="mt-6 text-xl font-semibold text-gray-900">
                This page doesn't exist
            </h2>

            <p class="mt-2 text-sm text-gray-500 max-w-md mx-auto leading-relaxed">
                The link may be broken, or the page may have moved. Either way, there's nothing here but very large numbers.
            </p>

            <div class="mt-8">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white text-sm font-medium rounded-full hover:bg-[#1a1a1a] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                    <span class="mr-2">←</span> Back to homepage
                </a>
            </div>
        </div>
    </body>
</html>
