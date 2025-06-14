@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Emitir Nova Fatura Recibo</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-600 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-600 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('faturas.faturarecibo.store') }}">
                @csrf

                {{-- CLIENTE --}}
                <div class="mb-4">
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="border rounded w-full" required>
                        <option value="">Selecione</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ITENS --}}
                <div id="itens-container">
                    <div class="item-row flex gap-3 mb-3">
                        <select class="tipo border rounded" name="itens[0][tipo]">
                            <option value="produto">Produto</option>
                            <option value="servico">Serviço</option>
                        </select>

                        <select class="item-select border rounded" name="itens[0][id]" required>
                            <option value="">Selecione</option>
                            @foreach ($produtos as $produto)
                                <option value="produto-{{ $produto->id }}" data-tipo="produto"
                                    data-preco="{{ $produto->preco_base }}">
                                    {{ $produto->nome }}
                                </option>
                            @endforeach
                            @foreach ($servicos as $servico)
                                <option value="servico-{{ $servico->id }}" data-tipo="servico"
                                    data-preco="{{ $servico->preco }}">
                                    {{ $servico->nome }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Inputs escondidos para enviar nome, tipo e preço -->
                        <input type="hidden" name="itens[0][nome]" class="item-nome">

                        <input type="number" name="itens[0][quantidade]" class="quantidade border rounded w-16"
                            value="1" min="1">
                        <input type="text" readonly class="preco border rounded w-24 bg-gray-100" placeholder="0.00">
                        <input type="hidden" name="itens[0][preco_base]" class="preco_base" value="">
                        <input type="hidden" name="itens[0][subtotal]" class="subtotal" value="">

                        <button type="button" class="remove-item text-red-500 font-bold">X</button>
                    </div>
                </div>

                <button type="button" id="add-item" class="bg-blue-600 text-white px-4 py-2 rounded">+ Adicionar Item</button>

                <br><br>

                <div class="item-row flex gap-3 mb-3">
                    <label for="metodo_pagamento">Método pagamento</label>
                    <select class="item-select border rounded" name="metodo_pagamento" id="metodo_pagamento" required>
                        <option value="">Selecione</option>
                        <option value="Cache" {{ old('metodo_pagamento') == 'Cache' ? 'selected' : '' }}>Cache</option>
                        <option value="TPA" {{ old('metodo_pagamento') == 'TPA' ? 'selected' : '' }}>TPA</option>
                        <option value="Cache/TPA" {{ old('metodo_pagamento') == 'Cache/TPA' ? 'selected' : '' }}>Cache/TPA</option>
                    </select>
                </div>

                <div class="mt-6 text-right">
                    <strong>Total: <span id="total">0.00</span> KZ</strong>
                    <input type="hidden" name="total" id="total-input" value="0.00">
                </div>

                <div class="mt-6 text-right">
                    <button type="button" id="confirmar-envio" class="bg-green-600 text-white px-6 py-2 rounded">Emitir Fatura</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let itemIndex = 1;

        function aplicarEventos(row) {
            const tipo = row.querySelector('.tipo');
            const select = row.querySelector('.item-select');
            const quantidade = row.querySelector('.quantidade');
            const preco = row.querySelector('.preco');
            const precoBase = row.querySelector('.preco_base');
            const subtotalField = row.querySelector('.subtotal');
            const remover = row.querySelector('.remove-item');

            const atualizarSelect = () => {
                const tipoSelecionado = tipo.value;
                [...select.options].forEach(opt => {
                    const dataTipo = opt.getAttribute('data-tipo');
                    opt.style.display = (!dataTipo || dataTipo === tipoSelecionado) ? '' : 'none';
                });
                select.value = '';
                preco.value = '';
                precoBase.value = '';
                subtotalField.value = '';
                calcularTotal();
            };

            const atualizarPreco = () => {
                const option = select.selectedOptions[0];
                const precoUnitario = parseFloat(option?.dataset.preco || 0);
                const qtd = parseFloat(quantidade.value || 1);
                const subtotal = precoUnitario * qtd;

                preco.value = subtotal.toFixed(2);
                precoBase.value = precoUnitario.toFixed(2);
                subtotalField.value = subtotal.toFixed(2);

                 // Atualizar o nome oculto
                const inputNome = row.querySelector('.item-nome');
                inputNome.value = option?.textContent || '';


                calcularTotal();
            };

            tipo.addEventListener('change', atualizarSelect);
            select.addEventListener('change', atualizarPreco);
            quantidade.addEventListener('input', atualizarPreco);

            remover.addEventListener('click', () => {
                row.remove();
                calcularTotal();
            });

            atualizarSelect();
        }

        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('.preco').forEach(p => {
                total += parseFloat(p.value || 0);
            });
            document.getElementById('total').textContent = total.toFixed(2);
            document.getElementById('total-input').value = total.toFixed(2);
        }

        document.getElementById('add-item').addEventListener('click', () => {
            const container = document.getElementById('itens-container');
            const clone = container.querySelector('.item-row').cloneNode(true);

            clone.querySelectorAll('select, input').forEach(el => {
                if (el.name) {
                    el.name = el.name.replace(/\[\d+\]/, `[${itemIndex}]`);
                }
                if (el.classList.contains('quantidade')) el.value = 1;
                if (el.classList.contains('preco')) el.value = '';
                if (el.classList.contains('preco_base')) el.value = '';
                if (el.classList.contains('subtotal')) el.value = '';
                if (el.tagName === 'SELECT') el.value = '';
            });

            container.appendChild(clone);
            aplicarEventos(clone);
            itemIndex++;
        });

        document.querySelectorAll('.item-row').forEach(row => aplicarEventos(row));
    </script>
     <script src="{{ asset('js/botao/confirmacao.js') }}"></script>
@endsection
