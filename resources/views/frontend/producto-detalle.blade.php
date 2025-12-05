@extends('layouts.frontend')

@section('title', $producto->nombre . ' - DISTRINORT')
@section('meta_description', $producto->descripcion_corta ?? $producto->nombre)
@section('meta_keywords', $producto->meta_keywords ?? $producto->nombre)

@push('styles')
<style>
    .producto-detalle-section {
        padding: 40px 0;
    }
    
    .producto-galeria {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }
    
    .galeria-main {
        width: 100%;
        max-width: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }
    
    .galeria-main::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, 
            transparent 30%, 
            rgba(37, 99, 235, 0.02) 50%, 
            transparent 70%);
        animation: shimmer 4s infinite;
    }
    
    @keyframes shimmer {
        0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }
    
    .galeria-main img {
        width: 100%;
        max-width: 350px;
        height: auto;
        object-fit: contain;
        border-radius: 12px;
        position: relative;
        z-index: 1;
    }
    
    .galeria-thumbnails {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .galeria-thumbnails img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    .galeria-thumbnails img:hover {
        border-color: #2563eb;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }
    
    .producto-detalle-info h1 {
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 20px;
        color: #1f2937;
    }
    
    .producto-badges {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-nuevo {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .badge-oferta {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    
    .badge-destacado {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    
    .producto-meta {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin: 20px 0;
        padding: 20px;
        background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
        border-radius: 12px;
        border-left: 4px solid #2563eb;
    }
    
    .producto-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
        color: #6b7280;
    }
    
    .producto-meta strong {
        color: #1f2937;
        font-weight: 600;
    }
    
    .producto-meta a {
        color: #2563eb;
        font-weight: 600;
        transition: color 0.3s ease;
    }
    
    .producto-meta a:hover {
        color: #1e40af;
        text-decoration: underline;
    }
    
    .producto-precio-detalle {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin: 25px 0;
        padding: 20px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border-radius: 12px;
    }
    
    .precio-actual {
        font-size: 2.5rem;
        font-weight: 800;
        color: #2563eb;
    }
    
    .precio-anterior {
        font-size: 1.5rem;
        color: #9ca3af;
        text-decoration: line-through;
    }
    
    .precio-ahorro {
        padding: 6px 14px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .producto-descripcion-corta,
    .producto-descripcion-larga {
        font-size: 1.05rem;
        line-height: 1.8;
        color: #4b5563;
        margin-bottom: 20px;
    }
    
    .producto-stock {
        margin: 20px 0;
    }
    
    .stock-disponible {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .stock-agotado {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    @media (max-width: 768px) {
        .producto-detalle-info h1 {
            font-size: 1.7rem;
        }
        
        .precio-actual {
            font-size: 2rem;
        }
        
        .precio-anterior {
            font-size: 1.2rem;
        }
    }
</style>
@endpush

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
                <div class="producto-descripcion-corta" style="margin-bottom: 15px;">
                    <p>{{ $producto->descripcion_corta }}</p>
                </div>
                @endif
                
                @if($producto->descripcion_larga)
                <div class="producto-descripcion-larga" style="margin-bottom: 20px; line-height: 1.6;">
                    {!! nl2br(e($producto->descripcion_larga)) !!}
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
                @if($producto->modo_uso)
                <button class="tab-button active" onclick="showTab('modo-uso')">Modo de Uso</button>
                @endif
                @if($producto->ingredientes)
                <button class="tab-button" onclick="showTab('ingredientes')">Ingredientes</button>
                @endif
                @if($producto->resenas->count() > 0)
                <button class="tab-button" onclick="showTab('resenas')">Reseñas ({{ $producto->resenas->count() }})</button>
                @endif
            </div>
            
            <div class="tabs-content">
                @if($producto->modo_uso)
                <div id="tab-modo-uso" class="tab-pane active">
                    {!! nl2br(e($producto->modo_uso)) !!}
                </div>
                @endif
                
                @if($producto->ingredientes)
                <div id="tab-ingredientes" class="tab-pane @if(!$producto->modo_uso) active @endif">
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
                    <img src="{{ Storage::url($relacionado->imagen_principal) }}" alt="{{ $relacionado->nombre }}" style="width: 200px; height: 200px; object-fit: cover;">
                    @elseif($relacionado->imagenes->count() > 0)
                    <img src="{{ Storage::url($relacionado->imagenes->first()->ruta) }}" alt="{{ $relacionado->nombre }}" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                    <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $relacionado->nombre }}" style="width: 200px; height: 200px; object-fit: cover;">
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
