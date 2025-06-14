
document.getElementById('confirmar-envio').addEventListener('click', function (e) {
    Swal.fire({
        title: 'Confirmar emissão',
        text: "Tens certeza que queres emitir esta fatura?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#16a34a', // verde
        cancelButtonColor: '#d33',     // vermelho
        confirmButtonText: 'Sim, emitir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submete o formulário
            this.closest('form').submit();
        }
    });
});

