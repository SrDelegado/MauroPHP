<?php

function cicloCultivo(int $dias): string {
    if ($dias < 60) return "Corto";
    if ($dias <= 90) return "Medio";
    return "Tardío";
}
?>