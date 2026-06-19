<div class="overflow-hidden rounded-lg border">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 dark:bg-gray-800">
            <tr>
                <th class="px-3 py-2 text-left font-medium">Nome</th>
                <th class="px-3 py-2 text-left font-medium">Tipo</th>
                <th class="px-3 py-2 text-left font-medium">Peças/Chapa</th>
                <th class="px-3 py-2 text-left font-medium">Custo Unitário</th>
                <th class="px-3 py-2 text-left font-medium">Custo Chapa</th>
                <th class="px-3 py-2 text-left font-medium">Qtd. na Composição</th>
                <th class="px-3 py-2 text-right font-medium">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($getRecord()->componentes as $componente)
                <tr class="border-t">
                    <td class="px-3 py-2">{{ $componente->nome }}</td>
                    <td class="px-3 py-2">{{ match($componente->tipo) { 'principal' => 'Principal', 'componente' => 'Composição', 'unico' => 'Único' } }}</td>
                    <td class="px-3 py-2">{{ $componente->qtd_pecas_por_caixa }}</td>
                    <td class="px-3 py-2">R$ {{ number_format($componente->custo_unitario ?? 0, 2, ',', '.') }}</td>
                    <td class="px-3 py-2">{{ $componente->tipo === 'principal' ? '—' : 'R$ ' . number_format($componente->custo_caixa ?? 0, 2, ',', '.') }}</td>
                    <td class="px-3 py-2">{{ $componente->pivot->quantidade }}</td>
                    <td class="px-3 py-2 text-right">
                        <a
                            href="{{ \App\Filament\Resources\Produtos\ProdutoResource::getUrl('edit', ['record' => $componente]) }}"
                            class="fi-btn inline-flex items-center justify-center rounded-lg bg-primary-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-primary-500"
                        >
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-3 py-4 text-center text-gray-500">Nenhum componente vinculado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
