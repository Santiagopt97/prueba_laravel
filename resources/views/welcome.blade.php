@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800">Gestor de Gastos</h1>
        <p class="mt-4 text-lg text-gray-600">Gestiona tus gastos de manera eficiente</p>

        <div class="mt-10 space-x-4">
            <a href="{{ route('expenses.index') }}" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">Ver Gastos</a>
            <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Ver Categorías</a>
        </div>
    </div>
</div>
@endsection
