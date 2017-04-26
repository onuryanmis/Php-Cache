Php Cache sistemi
================

Php ile hazırlanmış kullanılması kolay cache(önbellek) sistemi.

Kurulum
=======
İlk olarak sınıfı sayfamıza dahil ediyoruz.

``` php
require_once "Cache.class.php";

```

Kurulum işlemi bu kadar.


Kullanımı
=========

**Kurulum ve Ayarları**
İlk olarak sınıfımızı new anahtar sözcüğü ile kullanalım. Ve config metodu ile ayarlarımızı yapalım.

``` php
$cache = new Cache();

$cache->config([
    "dir"=>"onbellek"  // Cache dosyaları hangi klasörde saklanacak. Eğer klasör yoksa kendisi otomatik oluşturur.
]);

```

**Değeri önbelleğe kaydetme**
``` php
$cache->save("takimlar",$dizi,20);  // 1.parametre cache ismi, 2.Parametre hangi değerin önbelleğe alınacağı, 3.Parametre ne kadar süre saklanacağı eğer 3.parametre girilmezse sınırsız yani cache silinene kadar çalışır
```
**Önbellekteki değeri okuma**
``` php
$dizi = $cache->get("takimlar");  // Parametre olarak cache ismini giriyoruz. Eğer değer önbelleğe alınmamışsa false değeri döndürür alınmışsa değeri döndürür
```
**Önbellekte yoksa kaydet varsa oku**
``` php
if(!$dizi = $cache->get("takimlar"))
{
    $dizi  = array("Galatasaray","Fenerbahçe","Beşiktaş");
    $cache->save("takimlar",$dizi);
}
print_r($dizi);
```

**Cache silme**
``` php
$cache->delete("takimlar"); // Cache ismini yazıyoruz
```

**Tüm Cacheleri silme**
``` php
$cache->delete_all(); // Önbellekteki tüm dosyaları siler
```

**Yazar**
[Onur yanmış](http://www.webderslerim.com/)
