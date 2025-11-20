@extends('layouts.frontend')

@section('title', 'Blog - DISTRINORT')
@section('meta_description', 'Artículos, consejos y novedades sobre el cuidado del cabello')

@section('content')
<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a>
            <span>/</span>
            <span>Blog</span>
        </nav>
    </div>
</section>

<!-- Blog Header -->
<section class="page-header">
    <div class="container">
        <h1>MUNDO DISTRINORT</h1>
        <p>Artículos, consejos y novedades sobre el cuidado del cabello</p>
    </div>
</section>

<!-- Blog Grid -->
<section class="blog-listing-section">
    <div class="container">
        @if($articulos->count() > 0)
        <div class="blog-grid">
            @foreach($articulos as $articulo)
            <article class="blog-card">
                <a href="{{ route('articulo.detalle', $articulo->slug) }}" class="blog-image">
                    @if($articulo->imagen_destacada)
                    <img src="{{ Storage::url($articulo->imagen_destacada) }}" alt="{{ $articulo->titulo }}">
                    @else
                    <img src="{{ asset('images/blog-default.jpg') }}" alt="{{ $articulo->titulo }}">
                    @endif
                </a>
                
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> {{ $articulo->fecha_publicacion->format('d/m/Y') }}</span>
                        @if($articulo->autor)
                        <span><i class="far fa-user"></i> {{ $articulo->autor->name }}</span>
                        @endif
                    </div>
                    
                    <h2><a href="{{ route('articulo.detalle', $articulo->slug) }}">{{ $articulo->titulo }}</a></h2>
                    
                    @if($articulo->resumen)
                    <p>{{ Str::limit($articulo->resumen, 150) }}</p>
                    @endif
                    
                    <a href="{{ route('articulo.detalle', $articulo->slug) }}" class="btn btn-link">
                        Leer más <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $articulos->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-newspaper"></i>
            <h3>No hay artículos disponibles</h3>
            <p>Pronto publicaremos nuevos artículos sobre el cuidado del cabello.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Volver al inicio</a>
        </div>
        @endif
    </div>
</section>
@endsection
