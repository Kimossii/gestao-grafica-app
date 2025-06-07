<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fatura {{ $fatura->numero }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f0f0f0; }
        .text-right { text-align: right; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>

    <div class="title">Fatura {{ $fatura->numero }}</div>

    <p><strong>Cliente:</strong> {{ $fatura->cliente->nome ?? 'N/A' }}</p>
    <p><strong>Data de Emissão:</strong> {{ \Carbon\Carbon::parse($fatura->data_emissao)->format('d/m/Y') }}</p>
    <p><strong>Hora de Emissão:</strong> {{ \Carbon\Carbon::parse($fatura->updated_at)->addHour()->format('H:i') }}</p>
        <p><strong>Método Pagamento:</strong> {{ ucfirst($fatura->metodo_pagamento) }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($fatura->status) }}</p>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fatura->itens as $item)
                <tr>
                    <td>{{ ucfirst($item->item_tipo) }}</td>
                    <td>{{ $item->nome ?? 'Item removido' }}</td>
                    <td>{{ $item->quantidade }}</td>
                    <td>{{ number_format($item->preco_unitario, 2, ',', '.') }} KZ</td>
                    <td>{{ number_format($item->subtotal, 2, ',', '.') }} KZ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="text-right" style="margin-top: 20px;"><strong>Total: {{ number_format($fatura->total, 2, ',', '.') }} KZ</strong></h2>

</body>
</html>
