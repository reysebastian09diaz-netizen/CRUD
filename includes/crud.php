<?php

require_once __DIR__ . '/../db/conexion.php';

function configuracion_modulo($tipo)
{
    $modulos = [
        'clientes' => [
            'titulo' => 'Clientes',
            'singular' => 'cliente',
            'tabla' => 'socio',
            'clave' => 'cedula',
            'campos' => ['cedula' => ['Cedula', 'text'], 'nombres' => ['Nombres', 'text'], 'apellidos' => ['Apellidos', 'text'], 'direccion' => ['Direccion', 'text'], 'telefono' => ['Telefono', 'tel']],
            'funciones' => ['lista' => 'obtener_clientes', 'registro' => 'obtener_cliente_por_cedula', 'opciones' => 'opciones_clientes'],
            'directorio' => 'clientes',
        ],
        'socios' => [
            'titulo' => 'Socios',
            'singular' => 'socio',
            'tabla' => 'socio',
            'clave' => 'cedula',
            'campos' => ['cedula' => ['Cedula', 'text'], 'nombres' => ['Nombres', 'text'], 'apellidos' => ['Apellidos', 'text'], 'direccion' => ['Direccion', 'text'], 'telefono' => ['Telefono', 'tel']],
            'funciones' => ['lista' => 'obtener_socios', 'registro' => 'obtener_socio_por_cedula', 'opciones' => 'opciones_socios'],
            'directorio' => 'socios',
        ],
        'barcos' => [
            'titulo' => 'Barcos',
            'singular' => 'barco',
            'tabla' => 'barco',
            'clave' => 'matricula',
            'campos' => ['matricula' => ['Matricula', 'text'], 'nombre' => ['Nombre', 'text'], 'amarre' => ['Amarre', 'text'], 'cuota_amarre' => ['Cuota de amarre', 'number'], 'socio_cedula' => ['Socio', 'select']],
            'funciones' => ['lista' => 'obtener_barcos', 'registro' => 'obtener_barco_por_matricula', 'opciones' => 'opciones_barcos'],
            'directorio' => 'barcos',
        ],
        'salidas' => [
            'titulo' => 'Salidas',
            'singular' => 'salida',
            'tabla' => 'salidas',
            'clave' => 'IdSalida',
            'campos' => ['Fecha' => ['Fecha', 'date'], 'Hora' => ['Hora', 'time'], 'Destino' => ['Destino', 'text'], 'Barcos_Matricula' => ['Barco', 'select']],
            'funciones' => ['lista' => 'obtener_salidas', 'registro' => 'obtener_salida_por_id', 'opciones' => 'opciones_salidas'],
            'directorio' => 'salidas',
        ],
    ];
    return $modulos[$tipo] ?? null;
}

function obtener_registros_modulo($config)
{
    return llamar_funcion_modulo($config, 'lista');
}

function obtener_registro_modulo($config, $id)
{
    return llamar_funcion_modulo($config, 'registro', $id);
}

function opciones_campo_modulo($campo)
{
    if ($campo === 'socio_cedula') return llamar_funcion_modulo(configuracion_modulo('clientes'), 'opciones', $campo);
    if ($campo === 'Barcos_Matricula') return llamar_funcion_modulo(configuracion_modulo('barcos'), 'opciones', $campo);
    return false;
}

function datos_modulo_validos($config, $datos)
{
    foreach ($config['campos'] as $campo => $definicion) {
        if (!isset($datos[$campo]) || trim((string) $datos[$campo]) === '') return false;
    }
    return true;
}

function llamar_funcion_modulo($config, $operacion, ...$argumentos)
{
    require_once __DIR__ . '/' . $config['directorio'] . '/funciones.php';
    return call_user_func($config['funciones'][$operacion], ...$argumentos);
}

function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
