<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', $configuraciones['site_description'] ?? 'DISTRINORT - Distribuidora de productos para el cuidado del cabello')">
    <meta name="keywords" content="@yield('meta_keywords', $configuraciones['site_keywords'] ?? 'productos cabello, peluquería, hair care')">
    <title>@yield('title', 'DISTRINORT - Distribuidora de Productos para el Cuidado del Cabello')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-top-content">
                    <div class="header-contact">
                        <a href="tel:{{ $configuraciones['telefono'] ?? '' }}">
                            <i class="fas fa-phone"></i> {{ $configuraciones['telefono'] ?? '' }}
                        </a>
                        <a href="mailto:{{ $configuraciones['email'] ?? '' }}">
                            <i class="fas fa-envelope"></i> {{ $configuraciones['email'] ?? '' }}
                        </a>
                    </div>
                    <div class="header-social">
                        @if(isset($configuraciones['facebook_url']))
                        <a href="{{ $configuraciones['facebook_url'] }}" target="_blank"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if(isset($configuraciones['instagram_url']))
                        <a href="{{ $configuraciones['instagram_url'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(isset($configuraciones['tiktok_url']))
                        <a href="{{ $configuraciones['tiktok_url'] }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="navbar">
            <div class="container">
                <div class="navbar-content">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        @if(isset($configuraciones['logo']))
                        <img src="{{ Storage::url($configuraciones['logo']) }}" alt="DISTRINORT">
                        @else
                        <span>DISTRINORT</span>
                        @endif
                    </a>
                    
                    <button class="navbar-toggle" id="navbarToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    
                    <ul class="navbar-menu" id="navbarMenu">
                        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle">Marcas <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                @foreach(\App\Models\Marca::where('activo', true)->orderBy('orden')->get() as $marca)
                                <li><a href="{{ route('marca.productos', $marca->slug) }}">{{ $marca->nombre }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') || request()->routeIs('articulo.detalle') ? 'active' : '' }}">Blog</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                    
                    <button class="btn-whatsapp-header" onclick="openWhatsApp()">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <h3>DISTRINORT</h3>
                    <p>{{ $configuraciones['site_description'] ?? 'Distribuidora líder en productos para el cuidado del cabello.' }}</p>
                    <div class="footer-social">
                        @if(isset($configuraciones['facebook_url']))
                        <a href="{{ $configuraciones['facebook_url'] }}" target="_blank"><i class="fab fa-facebook"></i></a>
                        @endif
                        @if(isset($configuraciones['instagram_url']))
                        <a href="{{ $configuraciones['instagram_url'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if(isset($configuraciones['tiktok_url']))
                        <a href="{{ $configuraciones['tiktok_url'] }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                        @endif
                    </div>
                </div>
                
                <div class="footer-col">
                    <h4>Marcas</h4>
                    <ul>
                        @foreach(\App\Models\Marca::where('activo', true)->orderBy('orden')->take(5)->get() as $marca)
                        <li><a href="{{ route('marca.productos', $marca->slug) }}">{{ $marca->nombre }}</a></li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Información</h4>
                    <ul>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                        <li><a href="#sobre-nosotros">Sobre Nosotros</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Contacto</h4>
                    <ul class="footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i> {{ $configuraciones['direccion'] ?? '' }}</li>
                        <li><i class="fas fa-phone"></i> {{ $configuraciones['telefono'] ?? '' }}</li>
                        <li><i class="fas fa-envelope"></i> {{ $configuraciones['email'] ?? '' }}</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} DISTRINORT E.I.R.L. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <button class="whatsapp-float" onclick="openWhatsApp()">
        <i class="fab fa-whatsapp"></i>
    </button>

    <!-- Chatbot Widget -->
    <div class="chatbot-widget" id="chatbot">
        <div class="chatbot-header">
            <h4><i class="fas fa-comment-dots"></i> Asistente Virtual</h4>
            <button class="chatbot-close" onclick="toggleChatbot()"><i class="fas fa-times"></i></button>
        </div>
        <div class="chatbot-body" id="chatbotBody">
            <div class="chatbot-message bot-message">
                <p>¡Hola! Soy tu asistente virtual. ¿En qué puedo ayudarte hoy?</p>
            </div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chatbotInput" placeholder="Escribe tu mensaje...">
            <button onclick="sendMessage()"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
    
    <button class="chatbot-toggle" onclick="toggleChatbot()">
        <i class="fas fa-comment-dots"></i>
    </button>

    <!-- Custom JS -->
    <script src="{{ asset('js/frontend.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
