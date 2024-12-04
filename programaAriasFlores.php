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
/**Este modulo muestra el menu de seleccion */
function mostrarMenu(){
        echo"***************************************************\n";
        echo"Menu WORDIX! **\n";
        echo"1) Jugar al \e[1;37;42m Wordix \e[0m con una palabra elegida \n";
        echo"2) \e[32mJugar\e[0m al Wordix con una palabra aleatoria \n";
        echo"3) \e[33mMostrar\e[0m una partida \n";
        echo"4) \e[33mMostrar\e[0m la primer partida ganadora \n";
        echo"5) \e[33mMostrar\e[0m resumen de Jugador \n";
        echo"6) \e[33mMostrar\e[0m listado de partidas ordenadas por jugador y por palabra \n";
        echo"7) \e[33mAgregar\e[0m una palabra de 5 letras a Wordix \n";
        echo"8)\e[1;37;41m SALIR \e[0m\n";
        echo"***************************************************\n";
        echo"\nIngrese la opcion: ";
}
/*Este modulo muestra la cantidad total de partidas totales, la cantidad de victorias, su puntanje total 
y el intento en el que gano en cada una de sus partidas.
Este modulo recibe como parametro el arreglo $partidas y $nombreDelJugador, para analizar el arreglo con 
una partida jugada por el mismo jugador. Se analiza su nombre y si es igual, se almacenan ciertos datos.
Solo retorna valores a traves de la pantalla.*/
function mostrarPartidasDeUnJugador($partidas,$nombreDelJugador){

    $encontrado = false;
    $partidasTotales = 0;
    $puntajeTotal = 0;
    $victorias = 0;
    $en1Intento = 0;
    $en2Intento = 0;
    $en3Intento = 0;
    $en4Intento = 0;
    $en5Intento = 0;
    $en6Intento = 0;

    foreach($partidas as $partida){
        if($partida["jugador"] === $nombreDelJugador){       
            $partidasTotales = $partidasTotales+1;
            $puntajeTotal = $puntajeTotal + $partida["puntaje"];
            if($partida["puntaje"] > 0){
                $victorias = $victorias +1;
            }
            //Suma de intentos
            switch ($partida["intentos"]) {
                case 1:
                    $en1Intento = $en1Intento +1;
                    break; 
                case 2:
                    $en2Intento = $en2Intento +1;
                    break;
                case 3:
                    $en3Intento = $en3Intento +1;
                    break;
                case 4:
                    $en4Intento = $en4Intento +1;
                    break;
                case 5:  
                    $en5Intento = $en5Intento +1;
                    break;
                case 6:
                    $en6Intento = $en6Intento +1;
                    break;
            }
            $encontrado = true;
        }
    }

    $winrate = ($victorias / $partidasTotales ) * 100;
    
    if($encontrado){
        echo "\n***************************************************\n";
        echo "Nombre del Jugador: ".$nombreDelJugador."\n";
        echo "Cantidad total de partidas: ".$partidasTotales."\n";
        echo "Puntaje total: ".$puntajeTotal."\n";
        echo "Cantidad de victorias: ".$victorias."\n";
        echo "Porcentaje de Victorias: ".$winrate."%\n";
        echo "Adivinadas:\n";
        echo "           Intento 1: ".$en1Intento."\n";
        echo "           Intento 2: ".$en2Intento."\n";
        echo "           Intento 3: ".$en3Intento."\n";
        echo "           Intento 4: ".$en4Intento."\n";
        echo "           Intento 5: ".$en5Intento."\n";
        echo "           Intento 6: ".$en6Intento."\n";
        echo "***************************************************\n";
    }else{
        echo "No se encontro partida para el jugador: ".$nombreDelJugador;
    }

}

/*Es un modulo que se usa para ordenar un arreglo con la funcion uasort.
Este modulo usa como parametros $a y $b para comparar un jugador con el otro.
y retorna 0,1 o -1.*/
function cmp($a, $b){
    if ($a["palabraWordix"] == $b["palabraWordix"] && $a["jugador"] == $b["jugador"]){
        $orden = 0;
    }elseif ($a["palabraWordix"] < $b["palabraWordix"] && $a["jugador"] < $b["jugador"]) {
        $orden = -1;
    }else{
        $orden = 1;
    }

    return $orden;
}

/* ****COMPLETAR***** */

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
$palabraElegida;
$nombreUsuario;
$respuestaContinuacion;
$palabraAleatoria;
$partidaAuscar;
$primerPartidaGanadora;
//Inicialización de variables:
$partida;
$opcion=0;
$contadorDePartidas = 0;
$partidas = array(); // Este arreglo guarda todas las partidas jugadas
$numeroDeLaPartidaGanadora = 1; //indica el numero de la primer partida ganadora.
//Proceso:
//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);
do {
    echo"ingrese su nombre de usuario: ";
    $nombreUsuario = trim(fgets(STDIN));
    escribirMensajeBienvenida($nombreUsuario);    

    do {

        mostrarMenu();
        $opcion = trim(fgets(STDIN));

        switch ($opcion) {
            case 1: 
                //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1
                $palabraElegida = leerPalabra5letras();

                //Guarda la partida jugada en $partida
                $partida = jugarWordix($palabraElegida, $nombreUsuario);

                //Guarda la partida jugada en el arreglo $partidas
                array_push($partidas,$partida);

                echo "\n¿Desea seguir jugando con este usuario? (si/no): ";
                $respuestaContinuacion = trim(fgets(STDIN));
                if(strtolower($respuestaContinuacion) == "si"){
                    $opcion = 9; 
                }else{
                    $opcion = 8;
                }

                $contadorDePartidas = $contadorDePartidas + 1;


                break;
            case 2: 
                //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2
                $palabraAleatoria = cargarColeccionPalabras();
                $claveAleatoria = array_rand($palabraAleatoria);
                $partida = jugarWordix($palabraAleatoria[$claveAleatoria], $nombreUsuario);

                array_push($partidas,$partida);

                echo "\n¿Desea seguir jugando con este usuario? (si/no): ";
                $respuestaContinuacion = trim(fgets(STDIN));
                if(strtolower($respuestaContinuacion) == "si"){
                    $opcion = 9; 
                }else{
                    $opcion = 8;
                }

                $contadorDePartidas = $contadorDePartidas + 1;
                
                break;

            case 3:
                echo "\nIngrese el numero de la partida a buscar (entre: 1 y ".$contadorDePartidas."): ";
                $partidaBuscar = solicitarNumeroEntre(1,$contadorDePartidas);

                if ($partidaBuscar >= 1 && $partidaBuscar <= $contadorDePartidas){
                    
                    $partidaEncontrada = $partidas[$partidaBuscar-1];
                    echo "\n***************************************************\n";
                    echo "Partida numero ". $partidaBuscar ."\n";
                    echo "Jugador: ". $partidaEncontrada["jugador"]. "\n";
                    echo "Palabra Wordix: ".$partidaEncontrada["palabraWordix"]. "\n";
                    echo "Puntaje: ".$partidaEncontrada["puntaje"]. "\n";
                    echo "Intentos: ".$partidaEncontrada["intentos"]. "\n";
                    echo "***************************************************\n";

                }else{
                    echo "No se encontro la partida.\n";
                }
                

                //Salir al menu o del juego.
                echo "\n¿Desea seguir jugando con este usuario? (si/no): ";
                $respuestaContinuacion = trim(fgets(STDIN));
                if(strtolower($respuestaContinuacion) == "si"){
                    $opcion = 9; 
                }else{
                    $opcion = 8;
                }

                break;

            case 4:
                
                // Mostrar primera partida ganadora.
                foreach ($partidas as $puntos) {
                    if($puntos["puntaje"] > 0){
                        $primerPartidaGanadora = $puntos;
                        break;    
                    }
                    $numeroDeLaPartidaGanadora = $numeroDeLaPartidaGanadora + 1;
                }

                if($primerPartidaGanadora){
                    echo "\n***************************************************\n";
                    echo "-------------PRIMER PARTIDA GANADORA---------------\n";
                    echo "Partida numero ".$numeroDeLaPartidaGanadora."\n";
                    echo "Jugador: ". $primerPartidaGanadora["jugador"]. "\n";
                    echo "Palabra Wordix: ".$primerPartidaGanadora["palabraWordix"]. "\n";
                    echo "Puntaje: ".$primerPartidaGanadora["puntaje"]. "\n";
                    echo "Intentos: ".$primerPartidaGanadora["intentos"]. "\n";
                    echo "***************************************************\n";
                }else{
                    echo "No hay partida ganadora\n";
                }
                
                //Salir al menu o del juego.
                echo "\n¿Desea seguir jugando con este usuario? (si/no): ";
                $respuestaContinuacion = trim(fgets(STDIN));
                if(strtolower($respuestaContinuacion) == "si"){
                    $opcion = 9; 
                }else{
                    $opcion = 8;
                }

                break;

            case 5:
                //Mostrar todas las partidas del jugador
                mostrarPartidasDeUnJugador($partidas,$nombreUsuario);

                //Salir al menu o del juego.
                echo "\n¿Desea seguir jugando con este usuario? (si/no): ";
                $respuestaContinuacion = trim(fgets(STDIN));
                if(strtolower($respuestaContinuacion) == "si"){
                    $opcion = 9; 
                }else{
                    $opcion = 8;
                }

                break;

            case 6:

                
                uasort($partidas, 'cmp');

                print_r($partidas);



                //Salir al menu o del juego.
                echo "¿Desea seguir jugando con este usuario? (si/no): ";
                $respuestaContinuacion = trim(fgets(STDIN));
                if(strtolower($respuestaContinuacion) == "si"){
                    $opcion = 9; 
                }else{
                    $opcion = 8;
                }

                break;

            case 7: 
                //completar qué secuencia de pasos ejecutar si el usuario elige la opción 7
                $palabraElegida = leerPalabra5Letras();
                $palabraAleatoria[] = $palabraElegida;

                // print_r ($palabraAleatoria); //prueba de dato arreglo.//

                //Salir al menu o del juego.
                echo "¿Desea seguir jugando con este usuario? (si/no): ";
                $respuestaContinuacion = trim(fgets(STDIN));
                if(strtolower($respuestaContinuacion) == "si"){
                    $opcion = 9; 
                }else{
                    $opcion = 8;
                }
                break;
        }
    } while($opcion != 8);

    echo "¿Desea seguir jugando? (si/no): ";
    $respuestaContinuacion = trim(fgets(STDIN));
    if(strtolower($respuestaContinuacion) != "si"){
        $opcion = 8; 
    }else{
        $opcion = 9;
    }
} while ($opcion != 8);
