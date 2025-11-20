@extends('layouts.frontend')

@section('title', $articulo->titulo . ' - Blog DISTRINORT')
@section('meta_description', $articulo->meta_descripcion ?? $articulo->resumen)
@section('meta_keywords', $articulo->meta_keywords ?? $articulo->titulo)

@section('content')
<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a>
            <span>/</span>
            <a href="{{ route('blog') }}">Blog</a>
            <span>/</span>
            <span>{{ Str::limit($articulo->titulo, 50) }}</span>
        </nav>
    </div>
</section>

<!-- Artículo -->
<article class="articulo-detalle-section">
    <div class="container">
        <div class="articulo-header">
            <h1>{{ $articulo->titulo }}</h1>
            
            <div class="articulo-meta">
                <span><i class="far fa-calendar"></i> {{ $articulo->fecha_publicacion->format('d/m/Y') }}</span>
                @if($articulo->autor)
                <span><i class="far fa-user"></i> {{ $articulo->autor->name }}</span>
                @endif
                <span><i class="far fa-clock"></i> {{ $articulo->tiempo_lectura ?? 5 }} min lectura</span>
            </div>
        </div>
        
        @if($articulo->imagen_destacada)
        <div class="articulo-imagen-destacada">
            <img src="{{ Storage::url($articulo->imagen_destacada) }}" alt="{{ $articulo->titulo }}">
        </div>
        @endif
        
        <div class="articulo-content">
            {!! $articulo->contenido !!}
        </div>
        
        <div class="articulo-footer">
            <div class="articulo-compartir">
                <span>Compartir:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('articulo.detalle', $articulo->slug)) }}" target="_blank" class="btn-share btn-facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('articulo.detalle', $articulo->slug)) }}&text={{ urlencode($articulo->titulo) }}" target="_blank" class="btn-share btn-twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://wa.me/?text={{ urlencode($articulo->titulo . ' ' . route('articulo.detalle', $articulo->slug)) }}" target="_blank" class="btn-share btn-whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
    </div>
</article>

<!-- Artículos Relacionados -->
@if($articulosRelacionados->count() > 0)
<section class="articulos-relacionados-section">
    <div class="container">
        <div class="section-header">
            <h2>Artículos Relacionados</h2>
        </div>
        
        <div class="blog-grid">
            @foreach($articulosRelacionados as $relacionado)
            <article class="blog-card">
                <a href="{{ route('articulo.detalle', $relacionado->slug) }}" class="blog-image">
                    @if($relacionado->imagen_destacada)
                    <img src="{{ Storage::url($relacionado->imagen_destacada) }}" alt="{{ $relacionado->titulo }}">
                    @else
                    <img src="{{ asset('images/blog-default.jpg') }}" alt="{{ $relacionado->titulo }}">
                    @endif
                </a>
                
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> {{ $relacionado->fecha_publicacion->format('d/m/Y') }}</span>
                    </div>
                    
                    <h3><a href="{{ route('articulo.detalle', $relacionado->slug) }}">{{ $relacionado->titulo }}</a></h3>
                    
                    @if($relacionado->resumen)
                    <p>{{ Str::limit($relacionado->resumen, 120) }}</p>
                    @endif
                    
                    <a href="{{ route('articulo.detalle', $relacionado->slug) }}" class="btn btn-link">
                        Leer más <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
