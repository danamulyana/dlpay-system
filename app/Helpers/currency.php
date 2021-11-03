<?php

if (!function_exists('currencyIDRToNumeric')) {
    function curremcyIDRToNumeric($value)
    {
        return preg_replace('/\D/','',$value);
    }
}
if (!function_exists('currencyNumericToIDR')) {
    function currencyNumericToIDR($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    }
}
if (!function_exists('currencyNumericToIDRCostume')) {
    function currencyNumericToIDRCostume($angka){
        $hasil_rupiah = number_format($angka,2,',','.');
        return $hasil_rupiah;
    }
}
