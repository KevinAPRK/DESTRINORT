@extends('layouts.frontend')

@push('styles')
<style>
/* Hero Section Enhancements */
.hero-overlay {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3));
}

.hero-title-animated {
    animation: fadeInUp 1s ease-out;
}

.hero-subtitle-animated {
    animation: fadeInUp 1.2s ease-out;
}

.hero-button-animated {
    animation: fadeInUp 1.4s ease-out;
    transition: all 0.3s ease;
}

.hero-button-animated:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.floating-element {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    pointer-events: none;
    animation: float 6s ease-in-out infinite;
}

.floating-element:nth-child(1) {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-element:nth-child(2) {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.floating-element:nth-child(3) {
    width: 60px;
    height: 60px;
    bottom: 15%;
    left: 25%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
    }
}

/* Section Headers Modern */
.section-header-modern {
    text-align: center;
    margin-bottom: 50px;
}

.section-badge {
    display: inline-block;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 15px;
}

.section-badge-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.section-badge-success {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.section-badge-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}

.section-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.divider-line {
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, transparent, #667eea, transparent);
}

.divider-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #667eea;
}

/* Marcas Modern Cards */
.marca-card-modern {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

.marca-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.marca-card-modern:hover::before {
    left: 100%;
}

.marca-card-modern:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
}

.marca-card-modern .fa-arrow-right {
    transition: transform 0.3s ease;
}

.marca-card-modern:hover .fa-arrow-right {
    transform: translateX(5px);
}

/* Productos Card Hover */
.producto-card-hover {
    transition: all 0.3s ease;
}

.producto-card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

.producto-image-zoom {
    overflow: hidden;
}

.producto-image-zoom img {
    transition: transform 0.5s ease;
}

.producto-image-zoom:hover img {
    transform: scale(1.1);
}

/* Testimonios Modern */
.testimonio-card-modern {
    position: relative;
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.testimonio-card-modern:hover {
    border-left-color: #667eea;
    transform: translateX(5px);
    box-shadow: -5px 10px 30px rgba(0,0,0,0.1);
}

.testimonio-card-modern::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 60px;
    color: rgba(102, 126, 234, 0.1);
    font-family: Georgia, serif;
}

/* Blog Cards Hover */
.blog-card-hover {
    transition: all 0.3s ease;
}

.blog-card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0,0,0,0.15);
}

.blog-card-hover .blog-image img {
    transition: transform 0.5s ease;
}

.blog-card-hover:hover .blog-image img {
    transform: scale(1.05);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .floating-element {
        display: none;
    }
    
    .section-badge {
        font-size: 10px;
        padding: 6px 15px;
    }
}
</style>
@endpush

@section('content')
<!-- Hero Section / Banners -->
<section class="hero-section">
    <div class="hero-slider">
        @forelse($banners as $banner)
        <div class="hero-slide">
            <img src="{{ Storage::url($banner->imagen) }}" alt="{{ $banner->titulo }}">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="container">
                    <h1 class="hero-title-animated">{{ $banner->titulo }}</h1>
                    @if($banner->subtitulo)
                    <p class="hero-subtitle-animated">{{ $banner->subtitulo }}</p>
                    @endif
                    @if($banner->enlace)
                    <a href="{{ $banner->enlace }}" class="btn btn-primary btn-hero-animated">{{ $banner->texto_boton ?? 'Ver más' }}</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="hero-slide hero-default">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="container">
                    <h1 class="hero-title-animated">BIENVENIDA A DISTRINORT</h1>
                    <p class="hero-subtitle-animated">Distribuidora líder en productos para el cuidado del cabello</p>
                    <button class="btn btn-primary btn-hero-animated" onclick="openWhatsApp()">Contáctanos</button>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    
    <!-- Elementos decorativos flotantes -->
    <div class="hero-decoration">
        <div class="floating-element element-1"></div>
        <div class="floating-element element-2"></div>
        <div class="floating-element element-3"></div>
    </div>
</section>

<!-- Marcas Section -->
<section class="marcas-section">
    <div class="container">
        <div class="section-header section-header-modern">
            <span class="section-badge">Nuestras Alianzas</span>
            <h2>DESCUBRE DISTRINORT</h2>
            <p>Trabajamos con las mejores marcas del mercado</p>
            <div class="section-divider">
                <span class="divider-dot"></span>
                <span class="divider-line"></span>
                <span class="divider-dot"></span>
            </div>
        </div>
        
        <div class="marcas-grid marcas-grid-modern">
            @foreach($marcas as $marca)
            <a href="{{ route('marca.productos', $marca->slug) }}" class="marca-card marca-card-modern">
                <div class="marca-card-inner">
                    @if($marca->logo)
                    <div class="marca-logo-wrapper">
                        <img src="{{ Storage::url($marca->logo) }}" alt="{{ $marca->nombre }}">
                    </div>
                    @endif
                    <div class="marca-info">
                        <h3>{{ $marca->nombre }}</h3>
                        @if($marca->descripcion)
                        <p>{{ Str::limit($marca->descripcion, 100) }}</p>
                        @endif
                        <span class="marca-arrow"><i class="fas fa-arrow-right"></i></span>
                    </div>
                </div>
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
        <div class="section-header section-header-modern">
            <span class="section-badge section-badge-primary">Destacados</span>
            <h2>PRODUCTOS DESTACADOS</h2>
            <p>Los productos más populares de nuestro catálogo</p>
            <div class="section-divider">
                <span class="divider-dot"></span>
                <span class="divider-line"></span>
                <span class="divider-dot"></span>
            </div>
        </div>
        
        <div class="productos-grid">
            @foreach($productosDestacados as $producto)
            <div class="producto-card producto-card-hover">
                <a href="{{ route('producto.detalle', $producto->slug) }}" class="producto-image producto-image-zoom">
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

<!-- Carrusel de Categorías -->
<section class="carousel-section">
    <div class="container">
        <div class="section-header">
            <h2>NUESTRAS CATEGORÍAS</h2>
            <p>Explora nuestra variedad de productos</p>
        </div>
        
        <div class="carousel-wrapper">
            <!-- Botón Anterior -->
            <button onclick="scrollCarousel('prev')" class="carousel-btn carousel-btn-prev" aria-label="Anterior">
                <i class="fas fa-chevron-left"></i>
            </button>
            
            <!-- Contenedor del Carrusel -->
            <div id="carouselContainer" class="carousel-container">
                <!-- Tarjeta 1 -->
                <div class="carousel-card">
                    <div class="carousel-card-inner">
                        <div class="carousel-card-header carousel-card-image">
                            <img src="{{ asset('images/categorias/limpieza-facial.jpg') }}" alt="Limpieza Facial">
                        </div>
                        <div class="carousel-card-body">
                            <h3>Limpieza Facial</h3>
                            <p>Productos especializados para el cuidado y limpieza del rostro.</p>
                            <a href="{{ route('productos') }}" class="btn btn-primary">Ver productos</a>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta 2 -->
                <div class="carousel-card">
                    <div class="carousel-card-inner">
                        <div class="carousel-card-header carousel-card-image">
                            <img src="{{ asset('images/categorias/shampoo.jpg') }}" alt="Shampoo">
                        </div>
                        <div class="carousel-card-body">
                            <h3>Shampoo</h3>
                            <p>Variedad de shampoos para todo tipo de cabello.</p>
                            <a href="{{ route('productos') }}" class="btn btn-primary">Ver productos</a>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta 3 -->
                <div class="carousel-card">
                    <div class="carousel-card-inner">
                        <div class="carousel-card-header carousel-card-image">
                            <img src="{{ asset('images/categorias/cuidado-infantil.jpg') }}" alt="Cuidado Infantil">
                        </div>
                        <div class="carousel-card-body">
                            <h3>Cuidado Infantil</h3>
                            <p>Productos suaves y seguros para el cuidado de los más pequeños.</p>
                            <a href="{{ route('productos') }}" class="btn btn-primary">Ver productos</a>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta 4 -->
                <div class="carousel-card">
                    <div class="carousel-card-inner">
                        <div class="carousel-card-header carousel-card-image">
                            <img src="{{ asset('images/categorias/proteccion-solar-corporal.jpg') }}" alt="Protección Solar Corporal">
                        </div>
                        <div class="carousel-card-body">
                            <h3>Protección Solar Corporal</h3>
                            <p>Protectores solares para cuidar tu piel del sol.</p>
                            <a href="{{ route('productos') }}" class="btn btn-primary">Ver productos</a>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta 5 -->
                <div class="carousel-card">
                    <div class="carousel-card-inner">
                        <div class="carousel-card-header carousel-card-image">
                            <img src="{{ asset('images/categorias/tratamientos.jpg') }}" alt="Tratamientos">
                        </div>
                        <div class="carousel-card-body">
                            <h3>Tratamientos</h3>
                            <p>Fórmulas avanzadas para el cuidado especializado.</p>
                            <a href="{{ route('productos') }}" class="btn btn-primary">Ver productos</a>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta 6 -->
                <div class="carousel-card">
                    <div class="carousel-card-inner">
                        <div class="carousel-card-header carousel-card-image">
                            <img src="{{ asset('images/categorias/jabones-naturales.jpg') }}" alt="Jabones Naturales">
                        </div>
                        <div class="carousel-card-body">
                            <h3>Jabones Naturales</h3>
                            <p>Jabones artesanales elaborados con ingredientes naturales.</p>
                            <a href="{{ route('productos') }}" class="btn btn-primary">Ver productos</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Botón Siguiente -->
            <button onclick="scrollCarousel('next')" class="carousel-btn carousel-btn-next" aria-label="Siguiente">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<style>
.carousel-section {
    padding: 60px 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.carousel-wrapper {
    position: relative;
    padding: 0 50px;
}

.carousel-container {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-behavior: smooth;
    scroll-snap-type: x mandatory;
    -ms-overflow-style: none;
    scrollbar-width: none;
    padding: 20px 0;
}

.carousel-container::-webkit-scrollbar {
    display: none;
}

.carousel-card {
    flex: 0 0 320px;
    scroll-snap-align: start;
}

.carousel-card-inner {
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.carousel-card-inner:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.carousel-card-header {
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.carousel-card-header i {
    font-size: 4rem;
    color: white;
}

.carousel-card-image {
    background: transparent !important;
}

.carousel-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.carousel-card-inner:hover .carousel-card-image img {
    transform: scale(1.1);
}

.carousel-card-body {
    padding: 24px;
}

.carousel-card-body h3 {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 12px;
    color: #333;
}

.carousel-card-body p {
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.carousel-card-body .btn {
    width: 100%;
}

.carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
}

.carousel-btn:hover {
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
}

.carousel-btn-prev {
    left: 0;
}

.carousel-btn-next {
    right: 0;
}

.carousel-btn i {
    font-size: 1.2rem;
    color: #333;
}

@media (max-width: 768px) {
    .carousel-wrapper {
        padding: 0 20px;
    }
    
    .carousel-card {
        flex: 0 0 280px;
    }
}
</style>

<!-- Reseñas / Testimonios Section -->
@if($resenas->count() > 0)
<section class="testimonios-section">
    <div class="container">
        <div class="section-header section-header-modern">
            <span class="section-badge section-badge-success">Testimonios</span>
            <h2>LO QUE DICEN NUESTROS CLIENTES</h2>
            <p>Testimonios reales de quienes confían en nosotros</p>
            <div class="section-divider">
                <span class="divider-dot"></span>
                <span class="divider-line"></span>
                <span class="divider-dot"></span>
            </div>
        </div>
        
        <div class="testimonios-grid">
            @foreach($resenas as $resena)
            <div class="testimonio-card testimonio-card-modern">
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
        <div class="section-header section-header-modern">
            <span class="section-badge section-badge-info">Blog</span>
            <h2>MUNDO DISTRINORT</h2>
            <p>Artículos, consejos y novedades sobre el cuidado del cabello</p>
            <div class="section-divider">
                <span class="divider-dot"></span>
                <span class="divider-line"></span>
                <span class="divider-dot"></span>
            </div>
        </div>
        
        <div class="blog-grid">
            @foreach($articulos as $articulo)
            <article class="blog-card blog-card-hover">
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
    
    // Carrusel de Tarjetas
    function scrollCarousel(direction) {
        const container = document.getElementById('carouselContainer');
        const scrollAmount = 350; // Ancho de la tarjeta + gap
        
        if (direction === 'next') {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        }
    }
    
    // Auto-scroll del carrusel (opcional)
    let carouselAutoScroll = setInterval(() => {
        const container = document.getElementById('carouselContainer');
        const maxScroll = container.scrollWidth - container.clientWidth;
        
        if (container.scrollLeft >= maxScroll - 10) {
            // Volver al inicio suavemente
            container.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
            scrollCarousel('next');
        }
    }, 5000);
    
    // Pausar auto-scroll al hover
    const carouselContainer = document.getElementById('carouselContainer');
    if (carouselContainer) {
        carouselContainer.addEventListener('mouseenter', () => {
            clearInterval(carouselAutoScroll);
        });
        
        carouselContainer.addEventListener('mouseleave', () => {
            carouselAutoScroll = setInterval(() => {
                const container = document.getElementById('carouselContainer');
                const maxScroll = container.scrollWidth - container.clientWidth;
                
                if (container.scrollLeft >= maxScroll - 10) {
                    container.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    scrollCarousel('next');
                }
            }, 5000);
        });
    }
</script>
@endpush
