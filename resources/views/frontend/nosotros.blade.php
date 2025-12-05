@extends('layouts.frontend')

@section('title', 'Nosotros - ' . ($configuraciones['site_name'] ?? 'DISTRINORT'))
@section('meta_description', 'Conoce más sobre DISTRINORT, tu distribuidora de confianza.')

@section('content')
<!-- Hero Section -->
<section class="page-hero">
    <div class="container">
        <h1>Nosotros</h1>
        <p>Conoce más sobre nuestra empresa</p>
    </div>
</section>

<!-- Contenido Principal -->
<section class="nosotros-content">
    <div class="container">
        <div class="about-section">
            <div class="about-text">
                <h2>¿Quiénes Somos?</h2>
                <p>
                    DISTRINORT es una empresa dedicada a la distribución de productos de alta calidad, 
                    comprometida con brindar el mejor servicio a nuestros clientes en toda la región.
                </p>
                <p>
                    Con años de experiencia en el mercado, nos hemos consolidado como una de las 
                    distribuidoras más confiables, trabajando con las mejores marcas del sector.
                </p>
            </div>
            <div class="about-image">
                <img src="{{ asset('images/Logo.jpg') }}" alt="Sobre DISTRINORT">
            </div>
        </div>

        <div class="values-section">
            <h2>Nuestros Valores</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Compromiso</h3>
                    <p>Nos comprometemos a ofrecer productos y servicios de la más alta calidad.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Excelencia</h3>
                    <p>Buscamos la excelencia en cada aspecto de nuestro negocio.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Confianza</h3>
                    <p>Construimos relaciones duraderas basadas en la confianza mutua.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3>Innovación</h3>
                    <p>Nos mantenemos a la vanguardia con productos y servicios innovadores.</p>
                </div>
            </div>
        </div>

        <div class="mission-vision">
            <div class="mission">
                <div class="mv-icon">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h2>Nuestra Misión</h2>
                <p>
                    Distribuir productos de calidad que mejoren la vida de nuestros clientes, 
                    manteniendo los más altos estándares de servicio y compromiso con la excelencia.
                </p>
            </div>
            <div class="vision">
                <div class="mv-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h2>Nuestra Visión</h2>
                <p>
                    Ser la distribuidora líder en la región, reconocida por la calidad de nuestros 
                    productos, la excelencia en el servicio al cliente y nuestro compromiso con el desarrollo sostenible.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
.page-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0;
    text-align: center;
    color: white;
}

.page-hero h1 {
    font-size: 3rem;
    margin-bottom: 10px;
}

.nosotros-content {
    padding: 60px 0;
}

.about-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: center;
    margin-bottom: 80px;
}

.about-text h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #333;
}

.about-text p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #666;
    margin-bottom: 15px;
}

.about-image img {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.values-section {
    margin-bottom: 80px;
    text-align: center;
}

.values-section h2 {
    font-size: 2.5rem;
    margin-bottom: 40px;
    color: #333;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.value-card {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.value-card:hover {
    transform: translateY(-10px);
}

.value-icon {
    font-size: 3rem;
    color: #667eea;
    margin-bottom: 20px;
}

.value-card h3 {
    font-size: 1.5rem;
    margin-bottom: 15px;
    color: #333;
}

.value-card p {
    color: #666;
    line-height: 1.6;
}

.mission-vision {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

.mission, .vision {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px;
    border-radius: 10px;
    color: white;
    text-align: center;
}

.mv-icon {
    font-size: 3rem;
    margin-bottom: 20px;
}

.mission h2, .vision h2 {
    font-size: 2rem;
    margin-bottom: 20px;
}

.mission p, .vision p {
    font-size: 1.1rem;
    line-height: 1.8;
}

@media (max-width: 768px) {
    .about-section,
    .mission-vision {
        grid-template-columns: 1fr;
    }
    
    .page-hero h1 {
        font-size: 2rem;
    }
    
    .about-text h2,
    .values-section h2 {
        font-size: 2rem;
    }
}
</style>
@endsection
