@extends('layouts.frontend')

@section('title', 'Productos - ' . ($configuraciones['site_name'] ?? 'DISTRINORT'))
@section('meta_description', 'Explora nuestro catálogo completo de productos para el cuidado del cabello.')

@section('content')
<!-- Hero Section -->
<section class="page-hero">
    <div class="container">
        <h1>Nuestros Productos</h1>
        <p>Descubre toda nuestra gama de productos profesionales</p>
    </div>
</section>

<!-- Productos Section -->
<section class="productos-listing-section">
    <div class="container">
        <div class="productos-layout">
            <!-- Sidebar Filtros -->
            <aside class="productos-sidebar">
                <div class="filtros-header">
                    <h3><i class="fas fa-filter"></i> Filtros</h3>
                    <button onclick="limpiarFiltros()" class="btn-limpiar">Limpiar</button>
                </div>

                <form id="filtrosForm" method="GET" action="{{ route('productos') }}">
                    <!-- Filtro Categorías -->
                    <div class="filtro-grupo">
                        <button type="button" class="filtro-titulo" onclick="toggleFiltro('categorias')">
                            <span>Categorías</span>
                            <i class="fas fa-chevron-down filtro-icon" id="icon-categorias"></i>
                        </button>
                        <div class="filtro-contenido" id="filtro-categorias">
                            @foreach($categorias as $categoria)
                            <label class="filtro-checkbox">
                                <input type="radio" name="categoria" value="{{ $categoria->id }}" 
                                    {{ request('categoria') == $categoria->id ? 'checked' : '' }}
                                    onchange="aplicarFiltros()">
                                <span>{{ $categoria->nombre }}</span>
                            </label>
                            @endforeach
                            <label class="filtro-checkbox">
                                <input type="radio" name="categoria" value="" 
                                    {{ !request('categoria') ? 'checked' : '' }}
                                    onchange="aplicarFiltros()">
                                <span>Todas</span>
                            </label>
                        </div>
                    </div>

                    <!-- Filtro Marcas -->
                    <div class="filtro-grupo">
                        <button type="button" class="filtro-titulo" onclick="toggleFiltro('marcas')">
                            <span>Marcas</span>
                            <i class="fas fa-chevron-down filtro-icon" id="icon-marcas"></i>
                        </button>
                        <div class="filtro-contenido" id="filtro-marcas">
                            @foreach($marcas as $marca)
                            <label class="filtro-checkbox">
                                <input type="radio" name="marca" value="{{ $marca->id }}" 
                                    {{ request('marca') == $marca->id ? 'checked' : '' }}
                                    onchange="aplicarFiltros()">
                                <span>{{ $marca->nombre }}</span>
                            </label>
                            @endforeach
                            <label class="filtro-checkbox">
                                <input type="radio" name="marca" value="" 
                                    {{ !request('marca') ? 'checked' : '' }}
                                    onchange="aplicarFiltros()">
                                <span>Todas</span>
                            </label>
                        </div>
                    </div>

                    <!-- Filtro Disponibilidad -->
                    <div class="filtro-grupo">
                        <button type="button" class="filtro-titulo" onclick="toggleFiltro('disponibilidad')">
                            <span>Disponibilidad</span>
                            <i class="fas fa-chevron-down filtro-icon" id="icon-disponibilidad"></i>
                        </button>
                        <div class="filtro-contenido" id="filtro-disponibilidad">
                            <label class="filtro-checkbox">
                                <input type="checkbox" name="disponible" value="1" 
                                    {{ request('disponible') ? 'checked' : '' }}
                                    onchange="aplicarFiltros()">
                                <span>Solo productos disponibles</span>
                            </label>
                            <label class="filtro-checkbox">
                                <input type="checkbox" name="destacado" value="1" 
                                    {{ request('destacado') ? 'checked' : '' }}
                                    onchange="aplicarFiltros()">
                                <span>Productos destacados</span>
                            </label>
                        </div>
                    </div>
                </form>
            </aside>

            <!-- Contenido Principal -->
            <main class="productos-main">
                <!-- Header con contador y ordenar -->
                <div class="productos-header">
                    <div class="productos-contador">
                        <span>Mostrando {{ $productos->count() }} de {{ $productos->total() }} productos</span>
                    </div>
                    <div class="productos-ordenar">
                        <label>Ordenar por:</label>
                        <select onchange="ordenarProductos(this.value)" class="select-ordenar">
                            <option value="recientes" {{ request('ordenar') == 'recientes' ? 'selected' : '' }}>Más recientes</option>
                            <option value="populares" {{ request('ordenar') == 'populares' ? 'selected' : '' }}>Más populares</option>
                            <option value="precio_asc" {{ request('ordenar') == 'precio_asc' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                            <option value="precio_desc" {{ request('ordenar') == 'precio_desc' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                            <option value="nombre" {{ request('ordenar') == 'nombre' ? 'selected' : '' }}>Nombre A-Z</option>
                        </select>
                    </div>
                </div>

                <!-- Grid de Productos -->
                @if($productos->count() > 0)
                <div class="productos-grid-listing">
                    @foreach($productos as $producto)
                    <div class="producto-card-listing">
                        <!-- Badges -->
                        @if($producto->destacado)
                        <span class="producto-badge badge-popular">Más vendido</span>
                        @endif
                        @if($producto->created_at->diffInDays(now()) < 30)
                        <span class="producto-badge badge-nuevo">Nuevo</span>
                        @endif

                        <!-- Favorito -->
                        <button class="producto-favorito" onclick="toggleFavorito({{ $producto->id }})">
                            <i class="far fa-heart"></i>
                        </button>

                        <!-- Imagen -->
                        <a href="{{ route('producto.detalle', $producto->slug) }}" class="producto-imagen-link">
                            @if($producto->imagen_principal)
                            <img src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->nombre }}" class="producto-imagen">
                            @elseif($producto->imagenes->count() > 0)
                            <img src="{{ Storage::url($producto->imagenes->first()->ruta) }}" alt="{{ $producto->nombre }}" class="producto-imagen">
                            @else
                            <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $producto->nombre }}" class="producto-imagen">
                            @endif
                        </a>

                        <!-- Info -->
                        <div class="producto-info-listing">
                            <span class="producto-marca-listing">{{ $producto->marca->nombre }}</span>
                            <h3 class="producto-titulo-listing">
                                <a href="{{ route('producto.detalle', $producto->slug) }}">{{ $producto->nombre }}</a>
                            </h3>
                            
                            @if($producto->precio)
                            <div class="producto-precio-listing">
                                @if($producto->precio_oferta)
                                <span class="precio-anterior">S/ {{ number_format($producto->precio, 2) }}</span>
                                <span class="precio-actual">S/ {{ number_format($producto->precio_oferta, 2) }}</span>
                                @else
                                <span class="precio-actual">S/ {{ number_format($producto->precio, 2) }}</span>
                                @endif
                            </div>
                            @endif

                            <!-- Botón Consultar -->
                            <button class="btn-anadir" onclick="consultarProducto('{{ $producto->nombre }}')">
                                <i class="fab fa-whatsapp"></i> Consultar
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="paginacion">
                    {{ $productos->appends(request()->query())->links() }}
                </div>
                @else
                <div class="no-productos">
                    <i class="fas fa-box-open"></i>
                    <h3>No se encontraron productos</h3>
                    <p>Intenta ajustar los filtros para ver más resultados</p>
                    <button onclick="limpiarFiltros()" class="btn btn-primary">Ver todos los productos</button>
                </div>
                @endif
            </main>
        </div>
    </div>
</section>

<style>
.page-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0;
    text-align: center;
    color: white;
    margin-bottom: 40px;
}

.page-hero h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.productos-listing-section {
    padding: 40px 0 80px;
}

.productos-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 30px;
}

/* Sidebar Filtros */
.productos-sidebar {
    background: #fff0f6;
    padding: 24px;
    border-radius: 12px;
    height: fit-content;
    position: sticky;
    top: 100px;
}

.filtros-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #fce4ec;
}

.filtros-header h3 {
    font-size: 1.25rem;
    color: #333;
}

.btn-limpiar {
    background: none;
    border: none;
    color: #e91e63;
    font-size: 0.9rem;
    cursor: pointer;
    text-decoration: underline;
}

.filtro-grupo {
    margin-bottom: 20px;
    border-bottom: 1px solid #fce4ec;
    padding-bottom: 15px;
}

.filtro-titulo {
    width: 100%;
    background: none;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    cursor: pointer;
}

.filtro-icon {
    transition: transform 0.3s ease;
    color: #999;
}

.filtro-icon.rotate {
    transform: rotate(180deg);
}

.filtro-contenido {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.filtro-contenido.open {
    max-height: 500px;
    padding-top: 10px;
}

.filtro-checkbox {
    display: flex;
    align-items: center;
    padding: 8px 0;
    cursor: pointer;
}

.filtro-checkbox input {
    margin-right: 10px;
    cursor: pointer;
}

.filtro-checkbox span {
    color: #666;
    font-size: 0.95rem;
}

/* Contenido Principal */
.productos-main {
    min-height: 500px;
}

.productos-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding: 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.productos-contador {
    font-size: 1rem;
    color: #666;
}

.productos-ordenar {
    display: flex;
    align-items: center;
    gap: 10px;
}

.productos-ordenar label {
    color: #666;
    font-size: 0.95rem;
}

.select-ordenar {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 0.95rem;
    cursor: pointer;
}

/* Grid de Productos */
.productos-grid-listing {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

.producto-card-listing {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    position: relative;
}

.producto-card-listing:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

.producto-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 2;
}

.badge-popular {
    background: #ec4899;
    color: white;
}

.badge-nuevo {
    background: #3b82f6;
    color: white;
    top: 45px;
}

.producto-favorito {
    position: absolute;
    top: 12px;
    right: 12px;
    background: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 2;
    transition: all 0.3s ease;
}

.producto-favorito:hover {
    background: #e91e63;
    color: white;
}

.producto-imagen-link {
    display: block;
    padding: 20px;
    background: #fafafa;
}

.producto-imagen {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.producto-info-listing {
    padding: 16px;
}

.producto-marca-listing {
    display: block;
    color: #999;
    font-size: 0.85rem;
    margin-bottom: 6px;
}

.producto-titulo-listing {
    font-size: 1rem;
    line-height: 1.4;
    margin-bottom: 12px;
    height: 44px;
    overflow: hidden;
}

.producto-titulo-listing a {
    color: #333;
    text-decoration: none;
}

.producto-precio-listing {
    margin-bottom: 12px;
}

.precio-anterior {
    text-decoration: line-through;
    color: #999;
    font-size: 0.9rem;
    margin-right: 8px;
}

.precio-actual {
    color: #e91e63;
    font-size: 1.25rem;
    font-weight: bold;
}

.btn-anadir {
    width: 100%;
    padding: 10px;
    background: white;
    border: 2px solid #e91e63;
    color: #e91e63;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-anadir:hover {
    background: #e91e63;
    color: white;
}

.no-productos {
    text-align: center;
    padding: 80px 20px;
}

.no-productos i {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

.no-productos h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.paginacion {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

@media (max-width: 1200px) {
    .productos-grid-listing {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .productos-layout {
        grid-template-columns: 1fr;
    }
    
    .productos-sidebar {
        position: static;
    }
    
    .productos-grid-listing {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .productos-header {
        flex-direction: column;
        gap: 15px;
    }
}
</style>
@endsection

@push('scripts')
<script>
// Toggle filtros acordeón
function toggleFiltro(id) {
    const contenido = document.getElementById('filtro-' + id);
    const icon = document.getElementById('icon-' + id);
    
    contenido.classList.toggle('open');
    icon.classList.toggle('rotate');
}

// Abrir todos los filtros por defecto
document.addEventListener('DOMContentLoaded', function() {
    toggleFiltro('categorias');
    toggleFiltro('marcas');
    toggleFiltro('disponibilidad');
});

// Aplicar filtros
function aplicarFiltros() {
    document.getElementById('filtrosForm').submit();
}

// Limpiar filtros
function limpiarFiltros() {
    window.location.href = '{{ route("productos") }}';
}

// Ordenar productos
function ordenarProductos(valor) {
    const url = new URL(window.location.href);
    url.searchParams.set('ordenar', valor);
    window.location.href = url.toString();
}

// Toggle favorito
function toggleFavorito(productId) {
    const btn = event.currentTarget;
    const icon = btn.querySelector('i');
    
    if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        btn.style.background = '#e91e63';
        btn.style.color = 'white';
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        btn.style.background = 'white';
        btn.style.color = '#333';
    }
}
</script>
@endpush
