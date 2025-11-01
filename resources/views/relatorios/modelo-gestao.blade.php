@extends('layouts.app')
@section('title', 'Modelo de Gestão')
@section('css')
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <i class="bx bx-file-blank text-primary"></i> Relatório - Modelo de Gestão
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white"><i class="bx bx-filter me-2"></i>Filtros do Relatório</h5>
                </div>
                <div class="card-body">
                    <form id="frmRelatorioGestao">
                        <div class="row g-3">
                            
                            <!-- Filtro por Nome -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Buscar por Nome (opcional):</label>
                                <input type="text" name="nome_filtro" id="nome_filtro" class="form-control" 
                                    placeholder="Digite o nome para filtrar ou deixe vazio para todos">
                            </div>

                            <!-- Filtro por Tipo de Cliente -->
                            <div class="col-12">
                                <label class="form-label fw-bold d-block">Selecione o(s) Tipo(s) de Cliente:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tipo_associados" name="tipo_associados" value="1" checked>
                                    <label class="form-check-label" for="tipo_associados">Associados</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tipo_investidores" name="tipo_investidores" value="1" checked>
                                    <label class="form-check-label" for="tipo_investidores">Investidores</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tipo_outros" name="tipo_outros" value="1" checked>
                                    <label class="form-check-label" for="tipo_outros">Outros</label>
                                </div>
                            </div>

                        </div>

                        <div class="row justify-content-end mt-4">
                            <div class="col-12 col-md-4 col-lg-3">
                                <button type="submit" class="btn btn-primary btn-lg col-12">
                                    <i class="bx bx-file-blank me-2"></i>Gerar PDF
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
@include('partials.footer')
<!-- / Footer -->
@endsection
@section('js')
<!-- Core JS -->
<script src="/template/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/template/assets/vendor/libs/popper/popper.js"></script>
<script src="/template/assets/vendor/js/bootstrap.js"></script>
<script src="/template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/template/assets/vendor/js/menu.js"></script>

<!-- Main JS -->
<script src="/template/assets/js/main.js"></script>

<script>
    window.APP_URL = "{{ config('app.url') }}" || window.location.origin;
</script>

<script>
$(document).ready(function() {
    // Gerar relatório
    $('#frmRelatorioGestao').on('submit', function(e) {
        e.preventDefault();
        
        // Verificar se pelo menos um tipo está marcado
        const temMarcado = $('#tipo_associados').is(':checked') || 
                          $('#tipo_investidores').is(':checked') || 
                          $('#tipo_outros').is(':checked');
        
        if (!temMarcado) {
            alert('Por favor, selecione pelo menos um tipo de cliente!');
            return;
        }
        
        // Montar query string
        const params = new URLSearchParams();
        
        const nomeFiltro = $('#nome_filtro').val();
        if (nomeFiltro) {
            params.append('nome_filtro', nomeFiltro);
        }
        
        if ($('#tipo_associados').is(':checked')) {
            params.append('tipo_associados', '1');
        }
        if ($('#tipo_investidores').is(':checked')) {
            params.append('tipo_investidores', '1');
        }
        if ($('#tipo_outros').is(':checked')) {
            params.append('tipo_outros', '1');
        }
        
        // Abrir PDF em nova aba
        const url = APP_URL + `/relatorio/modelo-gestao/gerar?${params.toString()}`;
        window.open(url, '_blank');
    });
});
</script>
@endsection

