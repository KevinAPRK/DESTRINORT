<?php

return [
    'empty' => [
        'heading' => 'No se encontraron registros',
        'description' => 'Crea un :label para comenzar.',
    ],
    
    'actions' => [
        'create' => [
            'label' => 'Nuevo :label',
        ],
        
        'delete' => [
            'label' => 'Eliminar',
            'modal' => [
                'heading' => 'Eliminar :label',
                'actions' => [
                    'delete' => [
                        'label' => 'Eliminar',
                    ],
                ],
            ],
        ],
        
        'edit' => [
            'label' => 'Editar',
        ],
        
        'view' => [
            'label' => 'Vista',
        ],
    ],
    
    'columns' => [
        'text' => [
            'more_list_items' => 'y :count más',
        ],
    ],
    
    'filters' => [
        'actions' => [
            'remove' => [
                'label' => 'Eliminar filtro',
            ],
            
            'remove_all' => [
                'label' => 'Eliminar todos los filtros',
                'tooltip' => 'Eliminar todos los filtros',
            ],
            
            'reset' => [
                'label' => 'Restablecer',
            ],
        ],
        
        'heading' => 'Filtros',
        
        'indicator' => 'Filtros activos',
        
        'multi_select' => [
            'placeholder' => 'Todos',
        ],
        
        'select' => [
            'placeholder' => 'Todos',
        ],
    ],
    
    'pagination' => [
        'label' => 'Navegación de paginación',
        
        'overview' => '{1} Mostrando 1 resultado|[2,*] Mostrando :first a :last de :total resultados',
        
        'fields' => [
            'records_per_page' => [
                'label' => 'Por Página',
            ],
        ],
        
        'actions' => [
            'go_to_page' => [
                'label' => 'Ir a la página :page',
            ],
            
            'next' => [
                'label' => 'Siguiente',
            ],
            
            'previous' => [
                'label' => 'Anterior',
            ],
        ],
    ],
    
    'search' => [
        'label' => 'Buscar',
        'placeholder' => 'Buscar',
        'indicator' => 'Búsqueda',
    ],
];
