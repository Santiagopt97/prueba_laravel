@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Categorías</h2>
        <button onclick="document.getElementById('newCategoryModal').classList.remove('hidden')" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Nueva Categoría
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($categories as $category)
                <tr>
                    <td class="px-6 py-4">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-sm">
                        <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}')" 
                                class="text-indigo-600 hover:text-indigo-900">Editar</button>
                        <button onclick="deleteCategory({{ $category->id }})" 
                                class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Nueva Categoría -->
<div id="newCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Nueva Categoría</h3>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('newCategoryModal').classList.add('hidden')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Categoría -->
<div id="editCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Categoría</h3>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="name" id="editCategoryName" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('editCategoryModal').classList.add('hidden')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar Categoría -->
<div id="deleteCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Eliminar Categoría</h3>
            <p>¿Estás seguro de que deseas eliminar esta categoría?</p>
            <form id="deleteCategoryForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" 
                            onclick="document.getElementById('deleteCategoryModal').classList.add('hidden')"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editCategory(id, name) {
        document.getElementById('editCategoryName').value = name;
        document.getElementById('editCategoryForm').action = `/categories/${id}`;
        document.getElementById('editCategoryModal').classList.remove('hidden');
    }

    function deleteCategory(id) {
        document.getElementById('deleteCategoryForm').action = `/categories/${id}`;
        document.getElementById('deleteCategoryModal').classList.remove('hidden');
    }
</script>
@endsection