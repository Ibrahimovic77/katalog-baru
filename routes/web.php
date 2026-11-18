<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Katalogcontroler;

Route::get('/', function () {
    return view('welcome');
});

Route::get('sapa', function () {
    return 'Halo, kelompok 4';
});

Route::get('/tes', function () {
    return view('tes');
});

declare(strict_types=1);
namespace Latihan;

class Produk {
    public function __construct(public string $nama, private int $harga) {}

    public function subtotal(int $jumlah): int {
        if ($jumlah < 1) {
            throw new \InvalidArgumentException('Jumlah minimal pembelian adalah 1.');
        }
        return $this->harga * $jumlah;
    }
}

$p1 = new Produk('Kopi', 15000);
$hasil1 = $p1->subtotal(2);

$p2 = new Produk('Roti', 8000);
$hasil2 = $p2->subtotal(3);

echo "{$p1->nama} x 2 = {$hasil1} | {$p2->nama} x 3 = {$hasil2} | 20 poin\n";

try {
    $p2->subtotal(0);
} catch (\InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>