<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Articulo;
use App\Models\Banner;
use App\Models\Credencial;
use App\Models\Resena;
use App\Models\Configuracion;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $banners = Banner::where('activo', true)
            ->orderBy('orden')
            ->get();

        $marcas = Marca::where('activo', true)
            ->orderBy('orden')
            ->get();

        $credenciales = Credencial::where('activo', true)
            ->orderBy('orden')
            ->get();

        $productosDestacados = Producto::where('activo', true)
            ->where('destacado', true)
            ->with(['marca', 'categoria', 'imagenes'])
            ->take(8)
            ->get();

        $resenas = Resena::where('aprobado', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $articulos = Articulo::where('publicado', true)
            ->orderBy('fecha_publicacion', 'desc')
            ->take(3)
            ->get();

        $configuraciones = Configuracion::pluck('valor', 'clave');

        return view('frontend.index', compact(
            'banners',
            'marcas',
            'credenciales',
            'productosDestacados',
            'resenas',
            'articulos',
            'configuraciones'
        ));
    }

    public function nosotros()
    {
        $configuraciones = Configuracion::pluck('valor', 'clave');

        return view('frontend.nosotros', compact('configuraciones'));
    }

    public function productos(Request $request)
    {
        $query = Producto::where('activo', true)->with(['marca', 'categoria', 'imagenes']);

        // Filtro por categoría
        if ($request->has('categoria') && $request->categoria != '') {
            $query->where('categoria_id', $request->categoria);
        }

        // Filtro por marca
        if ($request->has('marca') && $request->marca != '') {
            $query->where('marca_id', $request->marca);
        }

        // Filtro por disponibilidad
        if ($request->has('disponible') && $request->disponible == '1') {
            $query->where('disponible', true);
        }

        // Filtro por destacados
        if ($request->has('destacado') && $request->destacado == '1') {
            $query->where('destacado', true);
        }

        // Ordenamiento
        $ordenar = $request->get('ordenar', 'recientes');
        switch ($ordenar) {
            case 'precio_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'nombre':
                $query->orderBy('nombre', 'asc');
                break;
            case 'populares':
                $query->orderBy('vistas', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $productos = $query->paginate(12);
        $categorias = Categoria::where('activo', true)->orderBy('nombre')->get();
        $marcas = Marca::where('activo', true)->orderBy('nombre')->get();
        $configuraciones = Configuracion::pluck('valor', 'clave');

        return view('frontend.productos', compact('productos', 'categorias', 'marcas', 'configuraciones'));
    }

    public function marcaProductos($slug)
    {
        $marca = Marca::where('slug', $slug)
            ->where('activo', true)
            ->firstOrFail();

        $productos = Producto::where('marca_id', $marca->id)
            ->where('activo', true)
            ->with(['categoria', 'imagenes'])
            ->paginate(12);

        $configuraciones = Configuracion::pluck('valor', 'clave');

        return view('frontend.marca-productos', compact('marca', 'productos', 'configuraciones'));
    }

    public function productoDetalle($slug)
    {
        $producto = Producto::where('slug', $slug)
            ->where('activo', true)
            ->with(['marca', 'categoria', 'imagenes', 'resenas' => function($query) {
                $query->where('aprobado', true)->orderBy('created_at', 'desc');
            }])
            ->firstOrFail();

        $productosRelacionados = Producto::where('marca_id', $producto->marca_id)
            ->where('id', '!=', $producto->id)
            ->where('activo', true)
            ->with(['marca', 'imagenes'])
            ->take(4)
            ->get();

        $configuraciones = Configuracion::pluck('valor', 'clave');

        return view('frontend.producto-detalle', compact('producto', 'productosRelacionados', 'configuraciones'));
    }

    public function blog()
    {
        $articulos = Articulo::where('publicado', true)
            ->orderBy('fecha_publicacion', 'desc')
            ->paginate(9);

        $configuraciones = Configuracion::pluck('valor', 'clave');

        return view('frontend.blog', compact('articulos', 'configuraciones'));
    }

    public function articuloDetalle($slug)
    {
        $articulo = Articulo::where('slug', $slug)
            ->where('publicado', true)
            ->with(['autor'])
            ->firstOrFail();

        $articulosRelacionados = Articulo::where('publicado', true)
            ->where('id', '!=', $articulo->id)
            ->orderBy('fecha_publicacion', 'desc')
            ->take(3)
            ->get();

        $configuraciones = Configuracion::pluck('valor', 'clave');

        return view('frontend.articulo-detalle', compact('articulo', 'articulosRelacionados', 'configuraciones'));
    }
}
