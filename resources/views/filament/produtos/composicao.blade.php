<div class="space-y-2">
    @forelse ($componentes as $componente)
        <div class="flex items-center justify-between rounded-lg border p-3">
            <span class="font-medium">{{ $componente->nome }}</span>
            <span class="text-sm text-gray-500">Quantidade: {{ $componente->pivot->quantidade }}</span>
        </div>
    @empty
        <p class="text-sm text-gray-500">Nenhum componente vinculado.</p>
    @endforelse
</div>
