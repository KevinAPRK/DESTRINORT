// ============================================
// DISTRINORT Frontend JavaScript
// ============================================

// === Navbar Toggle ===
document.addEventListener('DOMContentLoaded', function() {
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');
    
    if (navbarToggle) {
        navbarToggle.addEventListener('click', function() {
            navbarMenu.classList.toggle('active');
        });
    }
});

// === WhatsApp Functions ===
function openWhatsApp() {
    const whatsappNumber = '51999999999'; // Reemplazar con el número real
    const message = encodeURIComponent('Hola, me gustaría obtener más información sobre sus productos.');
    window.open(`https://wa.me/${whatsappNumber}?text=${message}`, '_blank');
}

function consultarProducto(nombreProducto) {
    const whatsappNumber = '51999999999'; // Reemplazar con el número real
    const message = encodeURIComponent(`Hola, estoy interesado en el producto: ${nombreProducto}. ¿Podrían darme más información?`);
    window.open(`https://wa.me/${whatsappNumber}?text=${message}`, '_blank');
}

// === Chatbot Functions ===
let chatbotSessionId = null;

function toggleChatbot() {
    const chatbot = document.getElementById('chatbot');
    chatbot.classList.toggle('active');
    
    // Iniciar sesión si es la primera vez
    if (!chatbotSessionId && chatbot.classList.contains('active')) {
        initChatbotSession();
    }
}

function initChatbotSession() {
    // Crear una sesión única
    chatbotSessionId = 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    
    // Aquí puedes hacer una llamada AJAX para registrar la sesión en el backend
    fetch('/api/chatbot/session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({
            session_id: chatbotSessionId
        })
    }).catch(error => console.error('Error al iniciar sesión:', error));
}

function sendMessage() {
    const input = document.getElementById('chatbotInput');
    const message = input.value.trim();
    
    if (!message) return;
    
    // Mostrar mensaje del usuario
    addMessageToChat(message, 'user');
    input.value = '';
    
    // Enviar mensaje al backend
    fetch('/api/chatbot/message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({
            session_id: chatbotSessionId,
            mensaje: message
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Error response:', text);
                throw new Error('Error en el servidor: ' + response.status);
            });
        }
        return response.json();
    })
    .then(data => {
        // Mostrar respuesta del bot
        if (data.respuesta) {
            addMessageToChat(data.respuesta, 'bot');
        } else {
            console.error('No hay respuesta en los datos:', data);
            addMessageToChat('Lo siento, ha ocurrido un error. Por favor, intenta de nuevo.', 'bot');
        }
    })
    .catch(error => {
        console.error('Error completo:', error);
        addMessageToChat('Lo siento, ha ocurrido un error. Por favor, intenta de nuevo.', 'bot');
    });
}

function addMessageToChat(message, sender) {
    const chatbotBody = document.getElementById('chatbotBody');
    const messageDiv = document.createElement('div');
    messageDiv.className = `chatbot-message ${sender}-message`;
    
    const p = document.createElement('p');
    p.textContent = message;
    messageDiv.appendChild(p);
    
    chatbotBody.appendChild(messageDiv);
    chatbotBody.scrollTop = chatbotBody.scrollHeight;
}

// Permitir enviar mensaje con Enter
document.addEventListener('DOMContentLoaded', function() {
    const chatbotInput = document.getElementById('chatbotInput');
    if (chatbotInput) {
        chatbotInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
});

// === Image Gallery (Producto Detalle) ===
function changeMainImage(src) {
    const mainImage = document.getElementById('mainImage');
    if (mainImage) {
        mainImage.src = src;
    }
}

// === Product Tabs ===
function showTab(tabName) {
    // Ocultar todos los tabs
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Mostrar el tab seleccionado
    const selectedTab = document.getElementById('tab-' + tabName);
    const selectedButton = event.target;
    
    if (selectedTab) {
        selectedTab.classList.add('active');
    }
    
    if (selectedButton) {
        selectedButton.classList.add('active');
    }
}

// === Smooth Scroll ===
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});

// === Lazy Loading Images ===
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    observer.unobserve(img);
                }
            }
        });
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    });
}

// === Search Functionality (opcional) ===
function searchProducts(query) {
    if (query.length < 3) return;
    
    fetch(`/api/search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data);
        })
        .catch(error => console.error('Error en búsqueda:', error));
}

function displaySearchResults(results) {
    // Implementar la visualización de resultados
    console.log('Resultados de búsqueda:', results);
}

// === Form Validation ===
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return false;
    
    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('error');
            isValid = false;
        } else {
            field.classList.remove('error');
        }
    });
    
    return isValid;
}

// === Tracking Events (Analytics) ===
function trackEvent(category, action, label) {
    // Implementar tracking con Google Analytics o similar
    if (typeof gtag !== 'undefined') {
        gtag('event', action, {
            'event_category': category,
            'event_label': label
        });
    }
    
    // También enviar al backend
    fetch('/api/tracking/event', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({
            tipo_evento: action,
            categoria: category,
            detalles: label
        })
    }).catch(error => console.error('Error en tracking:', error));
}

// === Product View Tracking ===
document.addEventListener('DOMContentLoaded', function() {
    // Detectar si estamos en una página de producto
    const productSlug = document.querySelector('[data-product-slug]');
    if (productSlug) {
        trackEvent('Producto', 'Vista', productSlug.dataset.productSlug);
    }
});

// === Newsletter Form (si se implementa) ===
function subscribeNewsletter(email) {
    fetch('/api/newsletter/subscribe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('¡Gracias por suscribirte!');
        }
    })
    .catch(error => console.error('Error:', error));
}

// === Back to Top Button (opcional) ===
function createBackToTopButton() {
    const button = document.createElement('button');
    button.innerHTML = '<i class="fas fa-arrow-up"></i>';
    button.className = 'back-to-top';
    button.style.cssText = `
        position: fixed;
        bottom: 20px;
        left: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary-color);
        color: white;
        border: none;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 998;
        box-shadow: var(--shadow-lg);
        transition: var(--transition);
    `;
    
    document.body.appendChild(button);
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            button.style.display = 'flex';
        } else {
            button.style.display = 'none';
        }
    });
    
    button.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Inicializar Back to Top
document.addEventListener('DOMContentLoaded', createBackToTopButton);

// === Console Info ===
console.log('%c🚀 DISTRINORT ', 'background: #2563eb; color: white; font-size: 20px; padding: 10px;');
console.log('%cSitio web desarrollado para DISTRINORT E.I.R.L', 'color: #6b7280; font-size: 12px;');
