<?php
include_once("wordix.php");
/* Apellido: Arias, Nombre: Santiago.
Legajo: FAI-4797. 
Carrera:Tec. Uni. En Desarrollo Web. 
mail: santiago.arias@est.fi.uncoma.edu.ar. 
Usuario Github: Santiago4797.*/

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "MATES", "PERRO", "CAJON", "MOSCA", "YERBA",
    ];

    return ($coleccionPalabras);
}

function mostrarMenu(){
        echo"***************************************************\n";
        echo"Menu WORDIX! **\n";
        echo"\e[1;37;42m 1) Jugar\e[0m al Wordix con una palabra elegida \n";
        echo"\e[1;37;42m 2) Jugar\e[0m al Wordix con una palabra aleatoria \n";
        echo"\e[1;37;34m 3) Mostrar\e[0m una partida \n";
        echo"\e[1;37;34m 4) Mostrar\e[0m la primer partida ganadora \n";
        echo"\e[1;37;34m 5) Mostrar\e[0m resumen de Jugador \n";
        echo"\e[1;37;34m 6) Mostrar\e[0m listado de partidas ordenadas por jugador y por palabra \n";
        echo"7) Agregar una palabra de 5 letras a Wordix \n";
        echo"\e[1;37;41m 8) SALIR \e[0m\n";
        echo"***************************************************/n";
}

/* ****COMPLETAR***** */




/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:
$opcion=0;
$palabraElegida;
$nombreUsuario;
$respuestaContinuacion;
$palabraAleatoria;
$partida;

//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



do {
    echo"ingrese su nombre de usuario: ";
    $nombreUsuario = trim(fgets(STDIN));
    $escribirMensajeBienvenida($nombreUsuario);

    $opcion = trim(fgets(STDIN));


    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1
            $palabraElegida = leerPalabra5letras();
            jugarWordix($palabraElegida, $nombreUsuario);
            echo "¿Desea seguir jugando? (si/no)";
            $respuestaContinuacion = trim(fgets(STDIN));
            if(strtolower($respuestaContinuacion) != "si"){
                $opcion = 8; 
            }


            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2
            $palabraAleatoria = cargarColeccionPalabras();
            $claveAleatoria = array_rand($palabraAleatoria);
            jugarWordix($palabraAleatoria[$claveAleatoria], $nombreUsuario);

            echo "¿Desea seguir jugando? (si/no)";
            $respuestaContinuacion = trim(fgets(STDIN));
            if(strtolower($respuestaContinuacion) != "si"){
                $opcion = 8; 
            }

            break;
        
        
        case 7: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 7
            $palabraElegida = leerPalabra5Letras();
            $palabraAleatoria[] = $palabraElegida;

            // print_r ($palabraAleatoria); //prueba de dato arreglo.//
            
            echo "¿Desea seguir jugando? (si/no)";
            $respuestaContinuacion = trim(fgets(STDIN));
            if(strtolower($respuestaContinuacion) != "si"){
                $opcion = 8; 
            }
            break;
    }
} while ($opcion != 8);
