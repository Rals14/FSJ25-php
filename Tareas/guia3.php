<?php
/*Problema de Ordenar Lista con Bubble Sort:
Escribe un programa que ordene una lista de números de forma descendente utilizando el algoritmo Bubble Sort. La lista puede contener duplicados y valores negativos. Asegúrate de manejar estos casos y muestra la lista antes y después de aplicar el algoritmo. */

//Definir la lista de números
$lista = [5, -5, 2, 0, 3, 1, 4, 2, 5, 3, 1, 4, 0, -5];

function bubbleSort($lista){
    $n = count($lista);
    for($i = 0; $i < $n; $i++){
        for($j = 0; $j < $n - $i - 1; $j++){
            if($lista[$j] < $lista[$j + 1]){
                $temp = $lista[$j];
                $lista[$j] = $lista[$j + 1];
                $lista[$j + 1] = $temp;
            }
        }
    }
    return $lista;
}

echo "Lista Original: ";
print_r($lista);
echo "Lista Ordenada: ";
print_r(bubbleSort($lista));


/*Problema de Ordenar Lista con Merge Sort:
Implementa una función que ordene una lista de palabras alfabéticamente utilizando el algoritmo Merge Sort. Muestra la lista antes y después de aplicar el algoritmo.*/

//Definir la lista de palabras
$lista = ["hola", "adios", "pupusas", "tamales", "café", "té", "chivo", "chucho", "chumpe"];

function mergeSort($lista){
    if(count($lista) == 1){
        return $lista;
    }
    $mitad = count($lista) / 2;
    $izquierda = array_slice($lista, 0, $mitad);
    $derecha = array_slice($lista, $mitad);
    $izquierda = mergeSort($izquierda);
    $derecha = mergeSort($derecha);
    return merge($izquierda, $derecha);
}

function merge($izquierda, $derecha){
    $resultado = [];
    while(count($izquierda) > 0 && count($derecha) > 0){
        if($izquierda[0] < $derecha[0]){
            array_push($resultado, array_shift($izquierda));
        }else{
            array_push($resultado, array_shift($derecha));
        }
    }
    while(count($izquierda) > 0){
        array_push($resultado, array_shift($izquierda));
    }
    while(count($derecha) > 0){
        array_push($resultado, array_shift($derecha));
    }
    return $resultado;
}

echo "Lista Original: ";
print_r($lista);
echo "Lista Ordenada: ";
print_r(mergeSort($lista));


/* Problema de Ordenar Lista con Insertion Sort:
Crea un script que ordene una lista de nombres en orden alfabético utilizando el algoritmo Insertion Sort. Muestra la lista antes y después de aplicar el algoritmo.*/

//Definir la lista de nombres
$lista = ["Juan", "Pedro", "Gabriela", "Irene", "Michelle", "Raúl", "José", "Alessandra", "Sofía", "Marta"];

function insertionSort($lista){
    $n = count($lista);
    for($i = 1; $i < $n; $i++){
        $key = $lista[$i];
        $j = $i - 1;
        while($j >= 0 && $lista[$j] > $key){
            $lista[$j + 1] = $lista[$j];
            $j = $j - 1;
        }
        $lista[$j + 1] = $key;
    }
    return $lista;
}

echo "Lista Original: ";
print_r($lista);
echo "Lista Ordenada: ";
print_r(insertionSort($lista));




?>
