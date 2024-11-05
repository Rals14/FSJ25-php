<?php
/*  
Problema de la serie Fibonacci:
Escribe una función llamada generar Fibonacci que reciba un número n como parámetro y genere los primeros n términos de la serie Fibonacci. La serie comienza con 0 y 1, y cada término subsiguiente es la suma de los dos anteriores. Por ejemplo, los primeros 10 términos de la serie Fibonacci son: 0, 1, 1, 2, 3, 5, 8, 13, 21, 34.
*/

function generarFibonacci($n){
    $a = 0;
    $b = 1;
    $c = 0;
    $serie = array();
    for($i = 0; $i < $n; $i++){
        $serie[] = $a;
        $c = $a + $b;
        $a = $b;
        $b = $c;
    }
    return $serie;
}

print_r(generarFibonacci(10));


/*Problema de números Primos:
Crea una función llamada esPrimo que determine si un número dado es primo o no. Un número primo es aquel que solo es divisible por 1 y por sí mismo.
*/

function esPrimo($n){
    if($n <= 1){
        return 'No es primo';
    }
    for($i = 2; $i < $n; $i++){
        if($n % $i == 0){
            return 'No es primo';
        }
    }
    return "El número {$n} es primo";
} 

print(esPrimo(7)."\n");


/*Problema de Palíndromos:
Implementa una función llamada esPalindromo que determine si una cadena de texto dada es un palíndromo. Un palíndromo es una palabra, frase o secuencia que se lee igual en ambas direcciones.
*/

function esPalindromo($texto){  
    $texto = strtolower($texto);
    $texto = str_replace(' ', '', $texto);
    $textoInvertido = strrev($texto);
    if($texto == $textoInvertido){
        return "El texto {$texto} es palíndromo";
    }
    return "El texto {$texto} no es palíndromo";
}

print(esPalindromo('Anita lava la tina')."\n");


?>