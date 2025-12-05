@extends('layouts.frontend')

@section('title', $marca->nombre . ' - DISTRINORT')
@section('meta_description', $marca->descripcion ?? 'Productos ' . $marca->nombre)

@push('styles')
<style>
    .marca-header {
        padding: 60px 0;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    }
    
    .marca-header-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 50px;
        flex-wrap: wrap;
    }
    
    .marca-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 280px;
        height: 280px;
        background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }
    
    .marca-logo::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, 
            transparent 30%, 
            rgba(37, 99, 235, 0.03) 50%, 
            transparent 70%);
        transform: rotate(45deg);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0%, 100% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }
    
    .marca-logo:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 80px rgba(37, 99, 235, 0.15);
    }
    
    .marca-logo img {
        width: 100%;
        max-width: 220px;
        height: auto;
        object-fit: contain;
        position: relative;
        z-index: 1;
        transition: transform 0.3s ease;
    }
    
    .marca-logo:hover img {
        transform: scale(1.05);
    }
    
    .marca-info {
        flex: 1;
        max-width: 600px;
        text-align: center;
    }
    
    .marca-info h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .marca-info p {
        font-size: 1.2rem;
        color: #6b7280;
        line-height: 1.8;
    }
    
    @media (max-width: 768px) {
        .marca-header-content {
            flex-direction: column;
            gap: 30px;
        }
        
        .marca-logo {
            width: 220px;
            height: 220px;
            padding: 20px;
        }
        
        .marca-logo img {
            max-width: 180px;
        }
        
        .marca-info h1 {
            font-size: 2rem;
        }
        
        .marca-info p {
            font-size: 1rem;
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
            <span>{{ $marca->nombre }}</span>
        </nav>
    </div>
</section>

<!-- Marca Header -->
<section class="marca-header">
    <div class="container">
        <div class="marca-header-content">
            @if($marca->logo)
            <div class="marca-logo">
                <img src="{{ Storage::url($marca->logo) }}" alt="{{ $marca->nombre }}">
            </div>
            @endif
            
            <div class="marca-info">
                <h1>{{ $marca->nombre }}</h1>
                @if($marca->descripcion)
                <p>{{ $marca->descripcion }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Productos -->
<section class="productos-section">
    <div class="container">
        <div class="productos-header">
            <h2>Productos de {{ $marca->nombre }}</h2>
            <p>{{ $productos->total() }} producto(s) encontrado(s)</p>
        </div>
        
        @if($productos->count() > 0)
        <div class="productos-grid">
            @foreach($productos as $producto)
            <div class="producto-card">
                <a href="{{ route('producto.detalle', $producto->slug) }}" class="producto-image">
                    @if($producto->imagen_principal)
                    <img src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->nombre }}" style="width: 200px; height: 200px; object-fit: cover;">
                    @elseif($producto->imagenes->count() > 0)
                    <img src="{{ Storage::url($producto->imagenes->first()->ruta) }}" alt="{{ $producto->nombre }}" style="width: 200px; height: 200px; object-fit: cover;">
                    @else
                    <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $producto->nombre }}" style="width: 200px; height: 200px; object-fit: cover;">
                    @endif
                    @if($producto->nuevo)
                    <span class="badge badge-nuevo">Nuevo</span>
                    @endif
                    @if($producto->precio_oferta)
                    <span class="badge badge-oferta">Oferta</span>
                    @endif
                </a>
                
                <div class="producto-info">
                    <span class="producto-categoria">{{ $producto->categoria->nombre }}</span>
                    <h3><a href="{{ route('producto.detalle', $producto->slug) }}">{{ $producto->nombre }}</a></h3>
                    
                    @if($producto->descripcion_corta)
                    <p class="producto-descripcion">{{ Str::limit($producto->descripcion_corta, 80) }}</p>
                    @endif
                    
                    <div class="producto-footer">
                        @if($producto->precio)
                        <div class="producto-precio">
                            @if($producto->precio_oferta)
                            <span class="precio-anterior">S/ {{ number_format($producto->precio, 2) }}</span>
                            <span class="precio-actual">S/ {{ number_format($producto->precio_oferta, 2) }}</span>
                            @else
                            <span class="precio-actual">S/ {{ number_format($producto->precio, 2) }}</span>
                            @endif
                        </div>
                        @endif
                        
                        <button class="btn btn-whatsapp" onclick="consultarProducto('{{ $producto->nombre }}')">
                            <i class="fab fa-whatsapp"></i> Consultar
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $productos->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>No hay productos disponibles</h3>
            <p>Esta marca aún no tiene productos registrados.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Volver al inicio</a>
        </div>
        @endif
    </div>
</section>
@endsection
