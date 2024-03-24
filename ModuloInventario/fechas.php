<?php
// Crear un objeto DateTime con la fecha y hora actual
$fecha_actual = new DateTime();

// Formatear la fecha y hora actual
echo $fecha_actual->format('d-m-Y H:i:s').'</br>';

// Puedes agregar o restar intervalos de tiempo
$fecha_actual->modify('+1 day');
echo $fecha_actual->format('d-m-Y H:i:s').'</br>';

// También puedes comparar fechas
$otra_fecha = new DateTime('2024-02-29');
if ($fecha_actual > $otra_fecha) {
    echo 'La fecha actual es posterior a la otra fecha.'.'</br>';
} elseif ($fecha_actual < $otra_fecha) {
    echo 'La fecha actual es anterior a la otra fecha.'.'</br>';
} else {
    echo 'Las fechas son iguales.'.'</br>';
}
?>