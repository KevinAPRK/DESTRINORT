@extends('layouts.frontend')

@section('title', $articulo->titulo . ' - Blog DISTRINORT')
@section('meta_description', $articulo->meta_descripcion ?? $articulo->resumen)
@section('meta_keywords', $articulo->meta_keywords ?? $articulo->titulo)

@push('styles')
<style>
    .articulo-detalle-section {
        padding: 40px 0;
    }
    
    .articulo-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .articulo-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 20px;
        color: #1f2937;
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .articulo-meta {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        color: #6b7280;
        font-size: 0.95rem;
    }
    
    .articulo-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .articulo-meta i {
        color: #2563eb;
    }
    
    .articulo-imagen-destacada {
        display: flex;
        justify-content: center;
        margin: 40px auto;
        max-width: 800px;
    }
    
    .articulo-imagen-destacada img {
        width: 100%;
        max-width: 700px;
        height: auto;
        border-radius: 16px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .articulo-imagen-destacada img:hover {
        transform: translateY(-5px);
    }
    
    .articulo-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
        font-size: 1.1rem;
        line-height: 1.8;
        color: #374151;
    }
    
    .articulo-content p {
        margin-bottom: 24px;
        text-align: justify;
    }
    
    .articulo-content h2,
    .articulo-content h3 {
        font-weight: 700;
        color: #1f2937;
        margin-top: 40px;
        margin-bottom: 20px;
        position: relative;
        padding-left: 20px;
    }
    
    .articulo-content h2::before,
    .articulo-content h3::before {
        content: "";
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 80%;
        background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
        border-radius: 2px;
    }
    
    .articulo-content h2 {
        font-size: 1.8rem;
    }
    
    .articulo-content h3 {
        font-size: 1.4rem;
    }
    
    .articulo-content strong {
        color: #1f2937;
        font-weight: 700;
    }
    
    .articulo-content ul,
    .articulo-content ol {
        margin: 24px 0;
        padding-left: 40px;
    }
    
    .articulo-content li {
        margin-bottom: 12px;
        position: relative;
    }
    
    .articulo-content ul li::marker {
        color: #2563eb;
        font-size: 1.2em;
    }
    
    .articulo-content ol li::marker {
        color: #2563eb;
        font-weight: 700;
    }
    
    .articulo-content blockquote {
        margin: 30px 0;
        padding: 20px 30px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border-left: 4px solid #2563eb;
        border-radius: 8px;
        font-style: italic;
        color: #1e40af;
    }
    
    .articulo-footer {
        max-width: 800px;
        margin: 40px auto 0;
        padding: 30px 20px;
        border-top: 2px solid #e5e7eb;
    }
    
    .articulo-compartir {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .articulo-compartir span {
        font-weight: 600;
        color: #374151;
    }
    
    .btn-share {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }
    
    .btn-share:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }
    
    .btn-facebook {
        background: #1877f2;
    }
    
    .btn-twitter {
        background: #1da1f2;
    }
    
    .btn-whatsapp {
        background: #25d366;
    }
    
    @media (max-width: 768px) {
        .articulo-header h1 {
            font-size: 1.8rem;
        }
        
        .articulo-imagen-destacada {
            max-width: 100%;
        }
        
        .articulo-imagen-destacada img {
            max-width: 100%;
        }
        
        .articulo-content {
            font-size: 1rem;
            padding: 20px 15px;
        }
        
        .articulo-content h2 {
            font-size: 1.5rem;
        }
        
        .articulo-content h3 {
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
        
        @if($articulo->imagen_portada)
        <div class="articulo-imagen-destacada">
            <img src="{{ Storage::url($articulo->imagen_portada) }}" alt="{{ $articulo->titulo }}">
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
                    @if($relacionado->imagen_portada)
                    <img src="{{ Storage::url($relacionado->imagen_portada) }}" alt="{{ $relacionado->titulo }}">
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
