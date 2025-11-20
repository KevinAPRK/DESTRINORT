@extends('layouts.frontend')

@section('title', $marca->nombre . ' - DISTRINORT')
@section('meta_description', $marca->descripcion ?? 'Productos ' . $marca->nombre)

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
                    <img src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->nombre }}">
                    @elseif($producto->imagenes->count() > 0)
                    <img src="{{ Storage::url($producto->imagenes->first()->ruta) }}" alt="{{ $producto->nombre }}">
                    @else
                    <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $producto->nombre }}">
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
