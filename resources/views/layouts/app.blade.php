<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Gastos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg mb-8">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Control de Gastos</h1>
                <div class="space-x-4">
                    <a href="{{ route('expenses.index') }}" class="text-gray-600 hover:text-gray-900">Gastos</a>
                    <a href="{{ route('categories.index') }}" class="text-gray-600 hover:text-gray-900">Categorías</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>