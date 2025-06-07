@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Fazer o pagamento da Fatura Nº {{$fatura->numero}}</h2>

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

            <form method="POST" action="{{ route('faturas.recibo.store', $fatura->id) }}">
                @csrf
              



                {{-- CLIENTE --}}
                <div class="mb-4">
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="border rounded w-full" required>
                        <option value="{{$fatura->cliente->id}}">{{$fatura->cliente->nome}}</option>



                    </select>
                </div>

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
                    <strong>Total: <span id="total">{{ number_format($fatura->total, 2, ',', '.') }}</span> KZ</strong>
                    <input type="hidden" name="total" id="total-input" value="0.00">
                </div>

                <div class="mt-6 text-right">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Finalizar pagamento</button>
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
@endsection
