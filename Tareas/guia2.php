<?php

/*  Problema de Lista Invertida:
Escribe un programa que tome un array de números y devuelva una nueva lista que contenga los mismos elementos en orden inverso.
*/

function listaInvertida($lista){
    $listaInvertida = array_reverse($lista);
    return $listaInvertida;
}

print_r(listaInvertida([1, 2, 3, 4, 5]));


/*  Problema de Suma de Números Pares:
Crea un script que sume todos los números pares en un array de números enteros.
*/

function sumaPares($lista){
    $suma = 0;
    foreach($lista as $numero){
        if($numero % 2 == 0){
            $suma += $numero;
        }
    }
    return $suma;
}

print(sumaPares([1, 2, 3, 4, 5]));


/*   Problema de Frecuencia de Caracteres:
Implementa una función que tome una cadena de texto y devuelva un array asociativo que muestre la frecuencia de cada carácter en la cadena.
*/

function frecuenciaCaracteres($texto){
    $frecuencia = [];
    $texto = str_split($texto);
    foreach($texto as $caracter){
        if(isset($frecuencia[$caracter])){
            $frecuencia[$caracter]++;
        }else{
            $frecuencia[$caracter] = 1;
        }
    }
    return $frecuencia;
}

print_r(frecuenciaCaracteres('hola mundo'));


/*  Problema de Bucle Anidado:
Escribe un programa que utilice bucles anidados para imprimir un patrón de asteriscos en forma de pirámide.
*/
 
function piramide($n){
    for($i = 1; $i <= $n; $i++){
        for($j = 1; $j <= $n - $i; $j++){
            echo " ";
        }
        for($k = 1; $k <= 2 * $i - 1; $k++){
            echo "*";
        }
        echo "\n";
    }
}

piramide(3);

?>