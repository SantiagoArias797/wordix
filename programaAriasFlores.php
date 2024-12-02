<?php
include_once("wordix.php");
/*Apellido: Arias, Nombre: Santiago.
Legajo: FAI-4797. 
Carrera:Tec. Uni. En Desarrollo Web. 
Mail: santiago.arias@est.fi.uncoma.edu.ar. 
Usuario Github: Santiago4797.

Apellido: Flores Aroca, Nombre: Esteban.
Legajo: FAI-4798. 
Carrera:Tec. Uni. En Desarrollo Web. 
Mail: esteban.aroca@est.fi.uncoma.edu.ar. 
Usuario Github: EstebanEmanuel.*/

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
        echo"1) Jugar al Wordix con una palabra elegida \n";
        echo"2) Jugar al Wordix con una palabra aleatoria \n";
        echo"\e[1;37;34m3) Mostrar\e[0m una partida \n";
        echo"\e[1;37;34m4) Mostrar\e[0m la primer partida ganadora \n";
        echo"\e[1;37;34m5) Mostrar\e[0m resumen de Jugador \n";
        echo"\e[1;37;34m6) Mostrar\e[0m listado de partidas ordenadas por jugador y por palabra \n";
        echo"7) Agregar una palabra de 5 letras a Wordix \n";
        echo"\e[1;37;41m 8) SALIR \e[0m\n";
        echo"***************************************************\n";
        echo"Ingrese la opcion: ";
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
    escribirMensajeBienvenida($nombreUsuario);
    mostrarMenu();
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1
            $palabraElegida = leerPalabra5letras();
            
            $partida = jugarWordix($palabraElegida, $nombreUsuario);
            
            echo "¿Desea seguir jugando? (si/no) ";
            $respuestaContinuacion = trim(fgets(STDIN));
            if(strtolower($respuestaContinuacion) != "si"){
                $opcion = 8; 
            }


            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2
            $palabraAleatoria = cargarColeccionPalabras();
            $claveAleatoria = array_rand($palabraAleatoria);
            $partida = jugarWordix($palabraAleatoria[$claveAleatoria], $nombreUsuario);

            echo "¿Desea seguir jugando? (si/no)";
            $respuestaContinuacion = trim(fgets(STDIN));
            if(strtolower($respuestaContinuacion) != "si"){
                $opcion = 8; 
            }

            break;
        case 3: 

            
            echo "Palabra: " . $partida["palabraWordix"]."\n";
            echo "Jugador: " . $partida["jugador"]."\n";
            echo "Intentos: " . $partida["intentos"]."\n";
            echo "Puntaje: " . $partida["puntaje"]."\n";

            echo "¿Desea seguir jugando? (si/no)";
            $respuestaContinuacion = trim(fgets(STDIN));
            if(strtolower($respuestaContinuacion) != "si"){
                $opcion = 8; 
            }

            break;

        case 4:



            break;

        case 5:

            break;

        case 6:

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
