<?php 
require_once 'Cache.class.php';

$cache = new Cache();

$cache->config([
    "dir"=>"onbellek"
]);

if(!$dizi = $cache->get("takimlar"))  // Eğer takimlar adlı cache dosyası yoksa önbelleğe kaydet varsa değeri oku
{
    $dizi  = array("Galatasaray","Fenerbahçe","Beşiktaş");
    $cache->save("takimlar",$dizi,20);  // 20 saniye önbelleğe al
}

print_r($dizi);





?>
