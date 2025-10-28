@extends('layouts.app')
@section('title', 'Investidores')
@section('css')
<!-- Sweet Alert 2 -->
<link href="{{ asset('template/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
    type="text/css">
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sistema /</span>
        {{ $pageTitle }}
    </h4>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">

        <div class="card p-5">
            <h5 class="card-header">{{ $pageTitle }}</h5>

            <div class="row g-3 mt-3">

                <!-- Cores Tela / Fontes -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Cores da Tela / Fontes:</label>
                    <select name="cores_tela" id="cores_tela" class="form-select">
                        <option value="">Selecione um tema</option>
                        <option value="claro">Tema Claro</option>
                        <option value="escuro">Tema Escuro</option>
                        <option value="auto">Automático (baseado no sistema)</option>
                    </select>
                </div>

                <!-- Tibre Recibos -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Timbre dos Recibos:</label>
                    <input type="file" name="timbre_recibos" id="timbre_recibos" class="form-control">
                    <small class="text-muted">Formatos aceitos: JPG, PNG. Tamanho máximo 2MB.</small>
                </div>

                <!-- Tibre Relatórios -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Timbre dos Relatórios:</label>
                    <input type="file" name="timbre_relatorios" id="timbre_relatorios" class="form-control">
                    <small class="text-muted">Formatos aceitos: JPG, PNG. Tamanho máximo 2MB.</small>
                </div>

                <!-- Tipos de Fontes -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tipo de Fonte:</label>
                    <select name="tipo_fonte" id="tipo_fonte" class="form-select">
                        <option value="">Selecione a fonte</option>
                        <option value="arial">Arial</option>
                        <option value="roboto">Roboto</option>
                        <option value="times">Times New Roman</option>
                        <option value="open_sans">Open Sans</option>
                        <option value="poppins">Poppins</option>
                    </select>
                </div>

                <!-- Mudar Idioma -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">Idioma:</label>
                    <select name="idioma" id="idioma" class="form-select">
                        <option value="pt">Português (Brasil)</option>
                        <option value="es">Español</option>
                        <option value="en">English</option>
                        <option value="fr">Français</option>
                    </select>
                </div>

            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4">Salvar Configurações</button>
            </div>
        </div>
    </div>
    <hr class="my-5" />
</div>
<!-- Footer -->
@include('partials.footer')
<!-- / Footer -->
@endsection
@section('js')
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('template/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('template/assets/vendor/js/bootstrap.js') }}"></script>
<script
    src="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}">
</script>

<script src="{{ asset('template/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ asset('template/assets/js/main.js') }}"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Sweet Alert 2  -->
<script src="{{ asset('template/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
    window.APP_URL = "{{ url('/') }}";

</script>

<!-- Personalized Js -->
<script src="{{ asset('js/generalFunctions.js') }}"></script>
<script src="{{ asset('js/Investidores/IuViIndex.js') }}"></script>

<link href="{{ asset('template/assets/css/personalized_sweetalert.css') }}" rel="stylesheet"
    type="text/css" />

@endsection
