<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesion;
use App\Models\Mensaje;
use App\Models\Intencion;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Faq;
use Illuminate\Support\Str;
use OpenAI;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * Crear una nueva sesión de chatbot
     */
    public function createSession(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string'
        ]);

        $sesion = Sesion::create([
            'session_id' => $request->session_id,
            'visitante_id' => $request->ip(),
            'timestamp_inicio' => now(),
            'timestamp_ultima_actividad' => now(),
            'ip_visitante' => $request->ip(),
            'agente_navegador' => $request->userAgent(),
            'estado' => 'abierta'
        ]);

        return response()->json([
            'success' => true,
            'sesion_id' => $sesion->id
        ]);
    }

    /**
     * Procesar mensaje del usuario
     */
    public function processMessage(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string',
            'mensaje' => 'required|string'
        ]);

        // Buscar o crear sesión
        $sesion = Sesion::where('session_id', $request->session_id)->first();
        
        if (!$sesion) {
            $sesion = Sesion::create([
                'session_id' => $request->session_id,
                'visitante_id' => $request->ip(),
                'timestamp_inicio' => now(),
                'timestamp_ultima_actividad' => now(),
                'ip_visitante' => $request->ip(),
                'agente_navegador' => $request->userAgent(),
                'estado' => 'abierta'
            ]);
        }

        // Guardar mensaje del usuario
        Mensaje::create([
            'sesion_id' => $sesion->id,
            'tipo_emisor' => 'visitante',
            'contenido' => $request->mensaje,
            'timestamp_envio' => now()
        ]);

        // Procesar el mensaje y generar respuesta
        $respuesta = $this->generateResponse($request->mensaje, $sesion);

        // Guardar respuesta del bot
        Mensaje::create([
            'sesion_id' => $sesion->id,
            'tipo_emisor' => 'chatbot',
            'contenido' => $respuesta,
            'timestamp_envio' => now()
        ]);

        // Actualizar última actividad
        $sesion->update([
            'timestamp_ultima_actividad' => now()
        ]);

        return response()->json([
            'success' => true,
            'respuesta' => $respuesta
        ]);
    }

    /**
     * Generar respuesta basada en el mensaje del usuario
     */
    private function generateResponse($mensaje, $sesion)
    {
        $mensaje = Str::lower($mensaje);

        // Intenciones de saludo
        if (preg_match('/\b(hola|buenos días|buenas tardes|buenas noches|hey|hi)\b/i', $mensaje)) {
            return "¡Hola! 👋 Bienvenido a DISTRINORT. ¿En qué puedo ayudarte hoy? Puedo ayudarte con:\n\n• Información sobre productos\n• Consultar marcas\n• Precios y ofertas\n• Métodos de pago\n• Horarios de atención";
        }

        // Intenciones sobre productos
        if (preg_match('/\b(producto|productos|artículo|item)\b/i', $mensaje)) {
            $productosDestacados = Producto::where('destacado', true)
                ->where('activo', true)
                ->take(3)
                ->get();

            $respuesta = "Contamos con una amplia variedad de productos para el cuidado del cabello. Estos son algunos de nuestros productos destacados:\n\n";
            
            foreach ($productosDestacados as $producto) {
                $respuesta .= "• {$producto->nombre} - S/ {$producto->precio}\n";
            }

            $respuesta .= "\n¿Te gustaría saber más sobre algún producto en particular?";
            return $respuesta;
        }

        // Intenciones sobre marcas
        if (preg_match('/\b(marca|marcas|brand)\b/i', $mensaje)) {
            $marcas = Marca::where('activo', true)
                ->orderBy('orden')
                ->take(5)
                ->get();

            $respuesta = "Trabajamos con las mejores marcas del mercado:\n\n";
            
            foreach ($marcas as $marca) {
                $respuesta .= "• {$marca->nombre}\n";
            }

            $respuesta .= "\n¿Qué marca te interesa?";
            return $respuesta;
        }

        // Buscar producto específico
        if (preg_match('/\b(shampoo|champú|acondicionador|tratamiento|mascarilla)\b/i', $mensaje)) {
            $palabraClave = '';
            if (preg_match('/shampoo|champú/i', $mensaje)) $palabraClave = 'shampoo';
            if (preg_match('/acondicionador/i', $mensaje)) $palabraClave = 'acondicionador';
            if (preg_match('/tratamiento/i', $mensaje)) $palabraClave = 'tratamiento';
            if (preg_match('/mascarilla/i', $mensaje)) $palabraClave = 'mascarilla';

            $productos = Producto::where('activo', true)
                ->where('disponible', true)
                ->where(function($query) use ($palabraClave) {
                    $query->where('nombre', 'like', "%{$palabraClave}%")
                          ->orWhere('descripcion_corta', 'like', "%{$palabraClave}%");
                })
                ->take(3)
                ->get();

            if ($productos->count() > 0) {
                $respuesta = "Encontré estos productos de {$palabraClave}:\n\n";
                foreach ($productos as $producto) {
                    $precio = $producto->precio_oferta ?? $producto->precio;
                    $respuesta .= "• {$producto->nombre} - S/ {$precio}\n";
                }
                $respuesta .= "\n¿Te gustaría saber más sobre alguno?";
                return $respuesta;
            }
        }

        // Intenciones sobre precios
        if (preg_match('/\b(precio|precios|costo|cuánto cuesta|valor)\b/i', $mensaje)) {
            return "Nuestros productos tienen precios muy competitivos. Los precios varían según el producto y la marca. ¿Hay algún producto específico del que quieras saber el precio?";
        }

        // Intenciones sobre pagos
        if (preg_match('/\b(pago|pagos|pagar|forma de pago|método de pago)\b/i', $mensaje)) {
            return "Aceptamos los siguientes métodos de pago:\n\n• Efectivo\n• Transferencia bancaria\n• Yape\n• Plin\n• Tarjetas de crédito y débito\n\n¿Tienes alguna otra consulta?";
        }

        // Intenciones sobre envíos
        if (preg_match('/\b(envío|envíos|delivery|entrega|despacho)\b/i', $mensaje)) {
            return "Realizamos envíos a todo el país. El costo y tiempo de entrega depende de tu ubicación. Para coordinar un envío, puedes contactarnos por WhatsApp y te daremos más detalles.";
        }

        // Intenciones sobre horarios
        if (preg_match('/\b(horario|horarios|abierto|cerrado|atención)\b/i', $mensaje)) {
            return "Nuestros horarios de atención son:\n\n📅 Lunes a Viernes: 8:00 AM - 6:00 PM\n📅 Sábados: 9:00 AM - 1:00 PM\n📅 Domingos: Cerrado\n\n¿Hay algo más en lo que pueda ayudarte?";
        }

        // Intenciones sobre ubicación
        if (preg_match('/\b(ubicación|dirección|dónde están|cómo llegar)\b/i', $mensaje)) {
            return "Nos encontramos en la ciudad de Trujillo. Para obtener nuestra dirección exacta y cómo llegar, por favor contáctanos por WhatsApp y te compartiremos nuestra ubicación. 📍";
        }

        // Intenciones sobre WhatsApp
        if (preg_match('/\b(whatsapp|contacto|teléfono|número|llamar)\b/i', $mensaje)) {
            return "¡Por supuesto! Puedes contactarnos directamente por WhatsApp haciendo clic en el botón flotante verde 📱 que está en la parte inferior derecha de la página. Estaremos encantados de atenderte personalmente.";
        }

        // Intenciones de despedida
        if (preg_match('/\b(gracias|muchas gracias|ok|vale|perfecto|adiós|chau|bye)\b/i', $mensaje)) {
            return "¡De nada! Gracias por contactarte con DISTRINORT. Si necesitas algo más, estaré aquí para ayudarte. 😊";
        }

        // Si no hay coincidencia, usar OpenAI
        return $this->getOpenAIResponse($mensaje, $sesion);
    }

    /**
     * Obtener respuesta de OpenAI cuando no hay coincidencia
     */
    private function getOpenAIResponse($mensaje, $sesion)
    {
        try {
            // Verificar si hay API key configurada
            if (!env('OPENAI_API_KEY')) {
                return "Entiendo que necesitas ayuda. Te puedo ayudar con:\n\n• Información sobre productos y marcas\n• Precios y ofertas\n• Métodos de pago y envíos\n• Horarios de atención\n\nTambién puedes contactarnos directamente por WhatsApp para una atención más personalizada. ¿En qué más puedo ayudarte?";
            }

            // Crear cliente con configuración HTTP personalizada para SSL
            $httpClient = \OpenAI::factory()
                ->withApiKey(env('OPENAI_API_KEY'))
                ->withHttpClient(new \GuzzleHttp\Client([
                    'verify' => false // Deshabilitar verificación SSL temporalmente
                ]))
                ->make();

            $client = $httpClient;

            // Obtener contexto de productos y marcas
            $productos = Producto::where('activo', true)
                ->where('disponible', true)
                ->take(10)
                ->get(['nombre', 'precio', 'descripcion_corta'])
                ->map(fn($p) => "{$p->nombre} - S/{$p->precio}")
                ->join(', ');

            $marcas = Marca::where('activo', true)
                ->pluck('nombre')
                ->join(', ');

            // Obtener historial reciente de la conversación
            $historial = Mensaje::where('sesion_id', $sesion->id)
                ->orderBy('timestamp_envio', 'desc')
                ->take(6)
                ->get()
                ->reverse()
                ->map(function($msg) {
                    return [
                        'role' => $msg->tipo_emisor === 'visitante' ? 'user' : 'assistant',
                        'content' => $msg->contenido
                    ];
                })
                ->toArray();

            // Preparar el contexto del sistema
            $systemPrompt = "Eres un asistente virtual de DISTRINORT, una distribuidora de productos para el cuidado del cabello en Perú. 

Tu objetivo es ayudar a los clientes con información sobre productos, precios, marcas, métodos de pago y horarios de atención.

INFORMACIÓN DE LA EMPRESA:
- Productos disponibles: {$productos}
- Marcas que manejamos: {$marcas}
- Métodos de pago: Efectivo, transferencia bancaria, Yape, Plin, tarjetas
- Horarios: Lunes a Viernes 8:00 AM - 6:00 PM, Sábados 9:00 AM - 1:00 PM
- Ubicación: Trujillo, Perú

INSTRUCCIONES:
1. Sé amable, profesional y conciso
2. Si te preguntan por un producto específico, usa la información proporcionada
3. Si no tienes la información exacta, invita al cliente a contactar por WhatsApp
4. Mantén las respuestas cortas (máximo 3-4 líneas)
5. Usa emojis ocasionalmente para ser más amigable
6. Siempre menciona que pueden contactar por WhatsApp para más información personalizada";

            $messages = array_merge([
                ['role' => 'system', 'content' => $systemPrompt]
            ], $historial, [
                ['role' => 'user', 'content' => $mensaje]
            ]);

            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
                'max_tokens' => 200,
                'temperature' => 0.7,
            ]);

            return $response->choices[0]->message->content;

        } catch (\Exception $e) {
            Log::error('Error OpenAI: ' . $e->getMessage());
            
            // Mensaje específico para rate limit
            if (str_contains($e->getMessage(), 'rate limit')) {
                return "Disculpa, estoy recibiendo muchas consultas en este momento. ⏱️\n\nPuedes:\n• Esperar un momento e intentar de nuevo\n• Contactarnos directamente por WhatsApp para atención inmediata\n\n¿Hay algo más en lo que pueda ayudarte?";
            }
            
            return "Entiendo que necesitas ayuda. Te puedo ayudar con:\n\n• Información sobre productos y marcas\n• Precios y ofertas\n• Métodos de pago y envíos\n• Horarios de atención\n\nTambién puedes contactarnos directamente por WhatsApp para una atención más personalizada. ¿En qué más puedo ayudarte?";
        }
    }
}
