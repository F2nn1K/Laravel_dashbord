<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $title ?? 'RELATORIO' }}</title>

  {{-- DomPDF trabaja mejor con estilos inline o en <style> --}}
  <style>
    @page { margin: 30px 25px; }
    body { font-family: "DejaVu Sans", sans-serif; font-size: 12px; color: #222; }
    header { text-align: center; margin-bottom: 10px; }
    .logo { width: 120px; height: auto; margin-bottom: 8px; }
    h1 { font-size: 16px; margin: 0; letter-spacing: 1px; }
    .subtitle { font-size: 11px; color: #555; margin-bottom: 8px; }

    .meta { width: 100%; margin: 10px 0 18px 0; display: flex; justify-content: space-between; align-items: center; }
    .meta .left, .meta .right { width: 48%; }
    .meta .right { text-align: right; }

    table { width: 100%; border-collapse: collapse; margin-bottom: 14px; }
    th, td { padding: 6px 8px; border: 1px solid #ccc; font-size: 12px; vertical-align: middle; }
    th { background: #f5f5f5; text-align: left; font-weight: 600; }

    .no-border { border: none; }
    .center { text-align: center; }
    .small { font-size: 11px; color: #444; }

    .signature-area { margin-top: 36px; display:flex; justify-content: space-between; }
    .signature { width: 48%; text-align: center; }
    .sig-line { margin-top: 50px; border-top: 1px solid #000; width: 80%; margin-left: auto; margin-right: auto; padding-top: 6px; }

    footer { position: fixed; bottom: 10px; left: 25px; right: 25px; text-align: center; font-size: 11px; color: #666; }
  </style>
</head>
<body>
  <header>
    @if(isset($logo_path))
      <img class="logo" src="{{ $logo_path }}" alt="Logo">
    @endif
    <h1>{{ $title ?? 'MODELO 1 - RELATÓRIO GERAL' }}</h1>
    <div class="subtitle">{{ $subtitle ?? 'Relatório gerado automaticamente' }}</div>
  </header>

  <div class="meta">
    <div class="left">
      <div><strong>Inscripción / Rampa:</strong> {{ $inscricao ?? '-' }}</div>
      <div><strong>Nombre Asociado:</strong> {{ $nombre_asociado ?? '-' }}</div>
    </div>
    <div class="right">
      <div><strong>Fecha:</strong> {{ $fecha ?? now()->format('d \\de F\\, Y') }}</div>
      <div class="small">{{ $location ?? '' }}</div>
    </div>
  </div>

  {{-- Ejemplo de tabla con actividades / items --}}
  <table>
    <thead>
      <tr>
        <th style="width:10%;">#</th>
        <th>Actividad / Descripción</th>
        <th style="width:18%;">Idioma (EN/PT/ES)</th>
        <th style="width:15%;">Observaciones</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items ?? [] as $i => $item)
        <tr>
          <td class="center">{{ $i + 1 }}</td>
          <td>{{ $item['descripcion'] ?? '' }}</td>
          <td class="center">{{ $item['idiomas'] ?? '' }}</td>
          <td>{{ $item['observaciones'] ?? '' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="center small">No hay actividades registradas.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  {{-- Bloque de texto largo (observaciones generales) --}}
  <div>
    <strong>Relatório Geral:</strong>
    <p class="small">
      {!! nl2br(e($general_notes ?? '')) !!}
    </p>
  </div>

  <div class="signature-area">
    <div class="signature">
      <div class="sig-line"></div>
      <div>Assinatura do Responsável</div>
    </div>
    <div class="signature">
      <div class="sig-line"></div>
      <div>{{ $signed_by ?? 'Responsável' }}</div>
    </div>
  </div>

  <footer>
Documento gerado em {{ now()->format('d/m/Y H:i') }}
  </footer>
</body>
</html>
