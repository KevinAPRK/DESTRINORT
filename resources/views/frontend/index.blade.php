@extends('layouts.frontend')

@section('content')
<!-- Hero Section / Banners -->
<section class="hero-section">
    <div class="hero-slider">
        @forelse($banners as $banner)
        <div class="hero-slide">
            <img src="{{ Storage::url($banner->imagen) }}" alt="{{ $banner->titulo }}">
            <div class="hero-content">
                <div class="container">
                    <h1>{{ $banner->titulo }}</h1>
                    @if($banner->subtitulo)
                    <p>{{ $banner->subtitulo }}</p>
                    @endif
                    @if($banner->enlace)
                    <a href="{{ $banner->enlace }}" class="btn btn-primary">{{ $banner->texto_boton ?? 'Ver más' }}</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="hero-slide hero-default">
            <div class="hero-content">
                <div class="container">
                    <h1>BIENVENIDA A DISTRINORT</h1>
                    <p>Distribuidora líder en productos para el cuidado del cabello</p>
                    <button class="btn btn-primary" onclick="openWhatsApp()">Contáctanos</button>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</section>

<!-- Marcas Section -->
<section class="marcas-section">
    <div class="container">
        <div class="section-header">
            <h2>DESCUBRE DISTRINORT</h2>
            <p>Trabajamos con las mejores marcas del mercado</p>
        </div>
        
        <div class="marcas-grid">
            @foreach($marcas as $marca)
            <a href="{{ route('marca.productos', $marca->slug) }}" class="marca-card">
                @if($marca->logo)
                <img src="{{ Storage::url($marca->logo) }}" alt="{{ $marca->nombre }}">
                @endif
                <h3>{{ $marca->nombre }}</h3>
                @if($marca->descripcion)
                <p>{{ Str::limit($marca->descripcion, 100) }}</p>
                @endif
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Credenciales Section -->
@if($credenciales->count() > 0)
<section class="credenciales-section">
    <div class="container">
        <div class="credenciales-grid">
            @foreach($credenciales as $credencial)
            <div class="credencial-card">
                @if($credencial->icono)
                <i class="{{ $credencial->icono }}"></i>
                @endif
                <h3>{{ $credencial->titulo }}</h3>
                <p>{{ $credencial->descripcion }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Productos Destacados Section -->
@if($productosDestacados->count() > 0)
<section class="productos-section">
    <div class="container">
        <div class="section-header">
            <h2>PRODUCTOS DESTACADOS</h2>
            <p>Los productos más populares de nuestro catálogo</p>
        </div>
        
        <div class="productos-grid">
            @foreach($productosDestacados as $producto)
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
                    <span class="producto-marca">{{ $producto->marca->nombre }}</span>
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
    </div>
</section>
@endif

<!-- Reseñas / Testimonios Section -->
@if($resenas->count() > 0)
<section class="testimonios-section">
    <div class="container">
        <div class="section-header">
            <h2>LO QUE DICEN NUESTROS CLIENTES</h2>
            <p>Testimonios reales de quienes confían en nosotros</p>
        </div>
        
        <div class="testimonios-grid">
            @foreach($resenas as $resena)
            <div class="testimonio-card">
                <div class="testimonio-rating">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $resena->calificacion)
                        <i class="fas fa-star"></i>
                        @else
                        <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <p class="testimonio-comentario">"{{ $resena->comentario }}"</p>
                <div class="testimonio-autor">
                    <strong>{{ $resena->nombre_cliente }}</strong>
                    @if($resena->producto)
                    <span>{{ $resena->producto->nombre }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Blog Section -->
@if($articulos->count() > 0)
<section class="blog-section">
    <div class="container">
        <div class="section-header">
            <h2>MUNDO DISTRINORT</h2>
            <p>Artículos, consejos y novedades sobre el cuidado del cabello</p>
        </div>
        
        <div class="blog-grid">
            @foreach($articulos as $articulo)
            <article class="blog-card">
                <a href="{{ route('articulo.detalle', $articulo->slug) }}" class="blog-image">
                    @if($articulo->imagen_portada)
                    <img src="{{ Storage::url($articulo->imagen_portada) }}" alt="{{ $articulo->titulo }}">
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
                    
                    <h3><a href="{{ route('articulo.detalle', $articulo->slug) }}">{{ $articulo->titulo }}</a></h3>
                    
                    @if($articulo->resumen)
                    <p>{{ Str::limit($articulo->resumen, 120) }}</p>
                    @endif
                    
                    <a href="{{ route('articulo.detalle', $articulo->slug) }}" class="btn btn-link">
                        Leer más <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="section-footer">
            <a href="{{ route('blog') }}" class="btn btn-outline">Ver todos los artículos</a>
        </div>
    </div>
</section>
@endif

<!-- Contacto Section -->
<section class="contacto-section" id="contacto">
    <div class="container">
        <div class="contacto-header">
            <h2>ENCUÉNTRANOS</h2>
            <p>Visítanos en nuestra ubicación en Piura</p>
        </div>
        
        <div class="contacto-map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.4961589856437!2d-80.63274668518425!3d-5.183847996243486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x904a1a6e1a1a1a1b%3A0x1a1a1a1a1a1a1a1a!2sUrb.%2021%20de%20Agosto%2C%20Piura!5e0!3m2!1ses!2spe!4v1700000000000!5m2!1ses!2spe" 
                width="100%" 
                height="400" 
                style="border:0; border-radius: 8px;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
        
        <div class="contacto-info-grid">
            <div class="contacto-info-card">
                <div class="contacto-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="contacto-info-content">
                    <h3>Dirección</h3>
                    <p>MZA. B LOTE. 20 URB. 21 DE AGOSTO</p>
                    <p>PIURA - PIURA - PIURA</p>
                </div>
            </div>
            
            <div class="contacto-info-card">
                <div class="contacto-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="contacto-info-content">
                    <h3>Horario de Atención</h3>
                    <p>Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                    <p>Sábados: 9:00 AM - 1:00 PM</p>
                </div>
            </div>
            
            <div class="contacto-info-card">
                <div class="contacto-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="contacto-info-content">
                    <h3>Teléfono</h3>
                    <p>{{ $configuraciones['telefono'] ?? '+51 912 173 821' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Hero Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    
    if (slides.length > 1) {
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 5000);
        
        slides[0].classList.add('active');
    }
</script>
@endpush
