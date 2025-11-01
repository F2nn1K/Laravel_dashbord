@extends('layouts.app')
@section('title', 'Relatórios')
@section('css')
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <i class="bx bx-file-blank text-primary"></i> Relatório Total de Vendas
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white"><i class="bx bx-filter me-2"></i>Filtros do Relatório</h5>
                </div>
                <div class="card-body">
                    <form id="frmRelatorio">
                        <div class="row g-3">
                            
                            <!-- Período -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Período Inicial:</label>
                                <input type="date" name="data_inicial" id="data_inicial" class="form-control" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Período Final:</label>
                                <input type="date" name="data_final" id="data_final" class="form-control" required>
                            </div>

                            <!-- Filtro por Tipo de Cliente -->
                            <div class="col-12">
                                <label class="form-label fw-bold d-block">Filtrar por Tipo de Cliente:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="filter_associados" name="filter_associados" value="1" checked>
                                    <label class="form-check-label" for="filter_associados">Associados</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="filter_investidores" name="filter_investidores" value="1" checked>
                                    <label class="form-check-label" for="filter_investidores">Investidores</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="filter_outros" name="filter_outros" value="1" checked>
                                    <label class="form-check-label" for="filter_outros">Outros</label>
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
    // Definir data padrão: mês atual
    const hoje = new Date();
    const primeiroDia = new Date(hoje.getFullYear(), hoje.getMonth(), 1);
    const ultimoDia = new Date(hoje.getFullYear(), hoje.getMonth() + 1, 0);
    
    $('#data_inicial').val(primeiroDia.toISOString().split('T')[0]);
    $('#data_final').val(ultimoDia.toISOString().split('T')[0]);
    
    // Gerar relatório
    $('#frmRelatorio').on('submit', function(e) {
        e.preventDefault();
        
        const dataInicial = $('#data_inicial').val();
        const dataFinal = $('#data_final').val();
        
        if (!dataInicial || !dataFinal) {
            alert('Por favor, selecione o período!');
            return;
        }
        
        // Abrir PDF em nova aba
        const url = APP_URL + `/relatorio/vendas/${dataInicial}/${dataFinal}`;
        window.open(url, '_blank');
    });
});
</script>
@endsection
