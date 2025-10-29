<div>
    <h1 class="text-2xl font-bold mb-6">Gerenciador de Camadas</h1>

    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-xl font-semibold mb-4">{{ $editingId ? 'Editar Camada' : 'Adicionar Nova Camada' }}</h2>
        <form wire:submit.prevent="{{ $editingId ? 'update' : 'save' }}">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nome da Camada:</label>
                <input type="text" id="name" wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="geojsonFile" class="block text-gray-700 font-bold mb-2">Arquivo GeoJSON (opcional ao editar):</label>
                <input type="file" id="geojsonFile" wire:model="geojsonFile" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('geojsonFile') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div wire:loading wire:target="geojsonFile" class="text-sm text-gray-500 mb-4">Carregando arquivo...</div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ $editingId ? 'Atualizar Camada' : 'Salvar Camada' }}
                </button>
                @if ($editingId)
                    <button type="button" wire:click="cancelEdit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Cancelar
                    </button>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">Camadas Existentes</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/4 text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                        <th class="w-1/2 text-left py-3 px-4 uppercase font-semibold text-sm">Nome</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Ações</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($layers as $layer)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4">{{ $layer->id }}</td>
                            <td class="py-3 px-4">{{ $layer->name }}</td>
                                <td class="py-3 px-4 flex items-center space-x-2">
                                    <button wire:click="edit({{ $layer->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-xs">
                                        Editar
                                    </button>
                                    <button wire:click="delete({{ $layer->id }})" wire:confirm="Tem certeza que deseja excluir esta camada?" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                                        Excluir
                                    </button>
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 px-4 text-center text-gray-500">Nenhuma camada cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>