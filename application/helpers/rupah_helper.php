<?php
function Rp($angka)
{
    $rupiah = "Rp." . number_format($angka, 0, ',', '.');
    return $rupiah;
}

function Gr($angka)
{
    $gram = $angka / 1000 . "Kg";
    return $gram;
}
