@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Lista de Gastos</h2>
        <button onclick="document.getElementById('newExpenseModal').classList.remove('hidden')" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Nuevo Gasto
        </button>
    </div>

    <!-- Filtros -->
    <div class="mb-6">
        <form action="{{ route('expenses.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Categoría</label>
                <select name="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Todas las categorías</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Filtrar
            </button>
        </form>
    </div>

    <!-- Resumen -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-gray-50 p-4 rounded">
            <h3 class="text-lg font-medium text-gray-700">Total de Gastos</h3>
            <p class="text-2xl font-bold text-gray-900">COP ${{ number_format($totalExpenses, 2) }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded">
            <h3 class="text-lg font-medium text-gray-700">Gastos por Categoría</h3>
            <ul class="mt-2">
                @foreach($expensesByCategory as $category => $total)
                    <li class="flex justify-between">
                        <span>{{ $category }}</span>
                        <span>COP ${{ number_format($total, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Lista de Gastos -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($expenses as $expense)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $expense->date->format('d/m/Y') }}</td>
                    <td class="px-6 py-4">{{ $expense->description }}</td>
                    <td class="px-6 py-4">{{ $expense->category->name }}</td>
                    <td class="px-6 py-4">COP ${{ number_format($expense->amount, 2) }}</td>
                    <td class="px-6 py-4 text-sm">
                        <button onclick="editExpense({{ $expense->id }}, '{{ $expense->description }}', {{ $expense->amount }}, {{ $expense->category_id }}, '{{ $expense->date->format('Y-m-d') }}')" 
                                class="text-indigo-600 hover:text-indigo-900">Editar</button>
                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-600 hover:text-red-900"
                                    onclick="return confirm('¿Estás seguro de querer eliminar este gasto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Nuevo Gasto -->
<div id="newExpenseModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Nuevo Gasto</h3>
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <input type="text" name="description" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" name="amount" step="0.01" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select name="category_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="date" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('newExpenseModal').classList.add('hidden')"
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

<!-- Modal Editar Gasto -->
<div id="editExpenseModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Gasto</h3>
            <form id="editExpenseForm" action="{{ route('expenses.update', 0) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <input type="text" name="description" id="editDescription" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Monto</label>
                    <input type="number" name="amount" id="editAmount" step="0.01" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Categoría</label>
                    <select name="category_id" id="editCategory" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="date" id="editDate" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="document.getElementById('editExpenseModal').classList.add('hidden')"
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

<script>
function editExpense(id, description, amount, category_id, date) {
    document.getElementById('editExpenseForm').action = `/expenses/${id}`;
    document.getElementById('editDescription').value = description;
    document.getElementById('editAmount').value = amount;
    document.getElementById('editCategory').value = category_id;
    document.getElementById('editDate').value = date;
    document.getElementById('editExpenseModal').classList.remove('hidden');
}
</script>
@endsection