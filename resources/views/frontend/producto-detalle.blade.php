@extends('layouts.frontend')

@section('title', $producto->nombre . ' - DISTRINORT')
@section('meta_description', $producto->descripcion_corta ?? $producto->nombre)
@section('meta_keywords', $producto->meta_keywords ?? $producto->nombre)

@section('content')
<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a>
            <span>/</span>
            <a href="{{ route('marca.productos', $producto->marca->slug) }}">{{ $producto->marca->nombre }}</a>
            <span>/</span>
            <span>{{ $producto->nombre }}</span>
        </nav>
    </div>
</section>

<!-- Producto Detalle -->
<section class="producto-detalle-section">
    <div class="container">
        <div class="producto-detalle-grid">
            <!-- Galería de Imágenes -->
            <div class="producto-galeria">
                <div class="galeria-main">
                    @if($producto->imagen_principal)
                    <img id="mainImage" src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->nombre }}">
                    @elseif($producto->imagenes->count() > 0)
                    <img id="mainImage" src="{{ Storage::url($producto->imagenes->first()->ruta) }}" alt="{{ $producto->nombre }}">
                    @else
                    <img id="mainImage" src="{{ asset('images/no-image.jpg') }}" alt="{{ $producto->nombre }}">
                    @endif
                </div>
                
                @if($producto->imagenes->count() > 0)
                <div class="galeria-thumbnails">
                    @if($producto->imagen_principal)
                    <img src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->nombre }}" onclick="changeMainImage(this.src)">
                    @endif
                    @foreach($producto->imagenes as $imagen)
                    <img src="{{ Storage::url($imagen->ruta) }}" alt="{{ $imagen->alt_text ?? $producto->nombre }}" onclick="changeMainImage(this.src)">
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- Información del Producto -->
            <div class="producto-detalle-info">
                <div class="producto-badges">
                    @if($producto->nuevo)
                    <span class="badge badge-nuevo">Nuevo</span>
                    @endif
                    @if($producto->precio_oferta)
                    <span class="badge badge-oferta">Oferta</span>
                    @endif
                    @if($producto->destacado)
                    <span class="badge badge-destacado">Destacado</span>
                    @endif
                </div>
                
                <h1>{{ $producto->nombre }}</h1>
                
                <div class="producto-meta">
                    <span><strong>Marca:</strong> <a href="{{ route('marca.productos', $producto->marca->slug) }}">{{ $producto->marca->nombre }}</a></span>
                    <span><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</span>
                    @if($producto->sku)
                    <span><strong>SKU:</strong> {{ $producto->sku }}</span>
                    @endif
                </div>
                
                @if($producto->precio)
                <div class="producto-precio-detalle">
                    @if($producto->precio_oferta)
                    <span class="precio-anterior">S/ {{ number_format($producto->precio, 2) }}</span>
                    <span class="precio-actual">S/ {{ number_format($producto->precio_oferta, 2) }}</span>
                    <span class="precio-ahorro">Ahorra S/ {{ number_format($producto->precio - $producto->precio_oferta, 2) }}</span>
                    @else
                    <span class="precio-actual">S/ {{ number_format($producto->precio, 2) }}</span>
                    @endif
                </div>
                @endif
                
                @if($producto->descripcion_corta)
                <div class="producto-descripcion-corta">
                    <p>{{ $producto->descripcion_corta }}</p>
                </div>
                @endif
                
                @if($producto->stock !== null)
                <div class="producto-stock">
                    @if($producto->stock > 0)
                    <span class="stock-disponible"><i class="fas fa-check-circle"></i> En stock</span>
                    @else
                    <span class="stock-agotado"><i class="fas fa-times-circle"></i> Agotado</span>
                    @endif
                </div>
                @endif
                
                <div class="producto-acciones">
                    <button class="btn btn-whatsapp-large" onclick="consultarProducto('{{ $producto->nombre }}')">
                        <i class="fab fa-whatsapp"></i> Consultar por WhatsApp
                    </button>
                </div>
                
                @if($producto->caracteristicas)
                <div class="producto-caracteristicas">
                    <h3>Características</h3>
                    <div class="caracteristicas-content">
                        {!! nl2br(e($producto->caracteristicas)) !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Tabs de Información -->
        <div class="producto-tabs">
            <div class="tabs-header">
                <button class="tab-button active" onclick="showTab('descripcion')">Descripción</button>
                @if($producto->modo_uso)
                <button class="tab-button" onclick="showTab('modo-uso')">Modo de Uso</button>
                @endif
                @if($producto->ingredientes)
                <button class="tab-button" onclick="showTab('ingredientes')">Ingredientes</button>
                @endif
                @if($producto->resenas->count() > 0)
                <button class="tab-button" onclick="showTab('resenas')">Reseñas ({{ $producto->resenas->count() }})</button>
                @endif
            </div>
            
            <div class="tabs-content">
                <div id="tab-descripcion" class="tab-pane active">
                    {!! $producto->descripcion !!}
                </div>
                
                @if($producto->modo_uso)
                <div id="tab-modo-uso" class="tab-pane">
                    {!! nl2br(e($producto->modo_uso)) !!}
                </div>
                @endif
                
                @if($producto->ingredientes)
                <div id="tab-ingredientes" class="tab-pane">
                    {!! nl2br(e($producto->ingredientes)) !!}
                </div>
                @endif
                
                @if($producto->resenas->count() > 0)
                <div id="tab-resenas" class="tab-pane">
                    <div class="resenas-list">
                        @foreach($producto->resenas as $resena)
                        <div class="resena-item">
                            <div class="resena-header">
                                <div>
                                    <strong>{{ $resena->nombre_cliente }}</strong>
                                    <div class="resena-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $resena->calificacion)
                                            <i class="fas fa-star"></i>
                                            @else
                                            <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <span class="resena-fecha">{{ $resena->created_at->format('d/m/Y') }}</span>
                            </div>
                            <p>{{ $resena->comentario }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Productos Relacionados -->
@if($productosRelacionados->count() > 0)
<section class="productos-relacionados-section">
    <div class="container">
        <div class="section-header">
            <h2>Productos Relacionados</h2>
            <p>También te pueden interesar estos productos de {{ $producto->marca->nombre }}</p>
        </div>
        
        <div class="productos-grid">
            @foreach($productosRelacionados as $relacionado)
            <div class="producto-card">
                <a href="{{ route('producto.detalle', $relacionado->slug) }}" class="producto-image">
                    @if($relacionado->imagen_principal)
                    <img src="{{ Storage::url($relacionado->imagen_principal) }}" alt="{{ $relacionado->nombre }}">
                    @elseif($relacionado->imagenes->count() > 0)
                    <img src="{{ Storage::url($relacionado->imagenes->first()->ruta) }}" alt="{{ $relacionado->nombre }}">
                    @else
                    <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $relacionado->nombre }}">
                    @endif
                </a>
                
                <div class="producto-info">
                    <span class="producto-marca">{{ $relacionado->marca->nombre }}</span>
                    <h3><a href="{{ route('producto.detalle', $relacionado->slug) }}">{{ $relacionado->nombre }}</a></h3>
                    
                    <div class="producto-footer">
                        @if($relacionado->precio)
                        <div class="producto-precio">
                            @if($relacionado->precio_oferta)
                            <span class="precio-anterior">S/ {{ number_format($relacionado->precio, 2) }}</span>
                            <span class="precio-actual">S/ {{ number_format($relacionado->precio_oferta, 2) }}</span>
                            @else
                            <span class="precio-actual">S/ {{ number_format($relacionado->precio, 2) }}</span>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
    function changeMainImage(src) {
        document.getElementById('mainImage').src = src;
    }
    
    function showTab(tabName) {
        // Ocultar todos los tabs
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('active');
        });
        
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Mostrar el tab seleccionado
        document.getElementById('tab-' + tabName).classList.add('active');
        event.target.classList.add('active');
    }
</script>
@endpush
