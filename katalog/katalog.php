<?php
// 1. DATA PRODUK (Simulasi dari Database)
$produk = [
    [
        "id" => 1,
        "kode" => "PRD001",
        "nama" => "Kemeja Flanel",
        "kategori" => "Kemeja",
        "harga_modal" => 60000,
        "harga_jual" => 120000,
        "stok" => 25,
        "status" => "Aktif"
    ],
    [
        "id" => 2,
        "kode" => "PRD002",
        "nama" => "Celana Jeans",
        "kategori" => "Celana",
        "harga_modal" => 50000,
        "harga_jual" => 150000,
        "stok" => 18,
        "status" => "Aktif"
    ],
    [
        "id" => 3,
        "kode" => "PRD003",
        "nama" => "Gamis Motif",
        "kategori" => "Gamis",
        "harga_modal" => 100000,
        "harga_jual" => 200000,
        "stok" => 12,
        "status" => "Aktif"
    ],
    [
        "id" => 4,
        "kode" => "PRD004",
        "nama" => "Kaos Polos",
        "kategori" => "Kaos",
        "harga_modal" => 30000,
        "harga_jual" => 80000,
        "stok" => 30,
        "status" => "Aktif"
    ],
    [
        "id" => 5,
        "kode" => "PRD005",
        "nama" => "Jaket Hoodie",
        "kategori" => "Jaket",
        "harga_modal" => 120000,
        "harga_jual" => 250000,
        "stok" => 10,
        "status" => "Aktif"
    ],
    [
        "id" => 6,
        "kode" => "PRD006",
        "nama" => "Rok Panjang",
        "kategori" => "Rok",
        "harga_modal" => 70000,
        "harga_jual" => 110000,
        "stok" => 15,
        "status" => "Nonaktif"
    ]
];

// 2. LOGIKA FITUR FILTER & PENCARIAN
$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'Semua Kategori';
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'Semua Status';

$produk_tampil = array_filter($produk, function ($item) use ($search, $filter_kategori, $filter_status) {
    $match_search = empty($search) || (stripos($item['nama'], $search) !== false) || (stripos($item['kode'], $search) !== false);
    $match_kategori = ($filter_kategori === 'Semua Kategori') || ($item['kategori'] === $filter_kategori);
    $match_status = ($filter_status === 'Semua Status') || ($item['status'] === $filter_status);

    return $match_search && $match_kategori && $match_status;
});

// List dinamis untuk Dropdown Filter
$kategori_list = array_unique(array_column($produk, 'kategori'));
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk & Harga - POS Modern</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 flex flex-col h-screen overflow-hidden">

    <!-- TOP BAR -->
    <header class="bg-white border-b border-slate-200 h-16 px-6 flex items-center justify-between z-10 shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-sm shadow-indigo-200">
                <i class="fa-solid fa-bag-shopping text-base"></i>
            </div>
            <div>
                <h1 class="font-bold text-base text-slate-900 tracking-tight leading-none">Fashion Store</h1>
                <p class="text-[11px] text-slate-400 font-medium mt-1">Sistem Point of Sales</p>
            </div>
        </div>

        <div class="flex items-center gap-5 text-sm">
            <div class="hidden sm:flex items-center gap-2 bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-medium">
                <i class="fa-regular fa-clock text-indigo-600"></i>
                <span>30 Nov 2025 • 14:35</span>
            </div>

            <div class="h-5 w-[1px] bg-slate-200"></div>

            <div class="flex items-center gap-2.5 cursor-pointer group">
                <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs border border-indigo-100">
                    PT
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-xs font-semibold text-slate-700 group-hover:text-indigo-600 transition">Pemilik Toko</p>
                    <p class="text-[10px] text-slate-400">Administrator</p>
                </div>
                <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
            </div>

            <a href="#" title="Keluar"
                class="w-8 h-8 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 transition flex items-center justify-center text-xs">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </div>
    </header>

    <!-- WRAPPER UTAMA -->
    <div class="flex flex-1 overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between shrink-0">
            <div class="p-4">
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Menu Utama</p>
                <nav class="space-y-1">
                    <a href="#"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm hover:bg-slate-800/70 hover:text-white transition">
                        <i class="fa-solid fa-chart-pie w-5 text-slate-400"></i> Dashboard
                    </a>
                    <a href="#"
                        class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-950/50 transition">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-boxes-stacked w-5"></i> Data Produk
                        </span>
                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm hover:bg-slate-800/70 hover:text-white transition">
                        <i class="fa-solid fa-tags w-5 text-slate-400"></i> Kategori
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm hover:bg-slate-800/70 hover:text-white transition">
                        <i class="fa-solid fa-receipt w-5 text-slate-400"></i> Transaksi
                    </a>
                    <a href="#"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm hover:bg-slate-800/70 hover:text-white transition">
                        <i class="fa-solid fa-file-invoice-dollar w-5 text-slate-400"></i> Laporan
                    </a>
                </nav>

                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-500 mt-6 mb-2">Sistem</p>
                <nav class="space-y-1">
                    <a href="#"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm hover:bg-slate-800/70 hover:text-white transition">
                        <i class="fa-solid fa-gear w-5 text-slate-400"></i> Pengaturan
                    </a>
                </nav>
            </div>

            <div class="p-4 m-3 rounded-xl bg-slate-800/60 border border-slate-700/50">
                <a href="#"
                    class="flex items-center gap-2.5 text-xs text-slate-300 hover:text-white transition">
                    <i class="fa-solid fa-circle-info text-indigo-400 text-sm"></i>
                    <div>
                        <p class="font-semibold">Tentang Aplikasi</p>
                        <p class="text-[10px] text-slate-400">Versi 2.4.0</p>
                    </div>
                </a>
            </div>
        </aside>

        <!-- KONTEN -->
        <main class="flex-1 p-6 lg:p-8 flex flex-col overflow-y-auto">

            <!-- TITLE & BUTTON -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Produk & Harga</h2>
                    <p class="text-xs text-slate-500 mt-1">Atur katalog barang, pantau ketersediaan stok, dan perbarui harga jual.</p>
                </div>
                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-sm shadow-indigo-200 transition flex items-center justify-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-plus text-xs"></i> Tambah Produk
                </button>
            </div>

            <!-- SEARCH & FILTER BAR -->
            <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm mb-6">
                <form action="" method="GET" class="flex flex-wrap items-center gap-3">

                    <!-- Search -->
                    <div class="flex-1 min-w-[260px] relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                        <input type="text" name="q" placeholder="Cari nama produk atau kode SKU..."
                            value="<?= htmlspecialchars($search) ?>"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
                    </div>

                    <!-- Filter Kategori -->
                    <select name="kategori"
                        class="bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition min-w-[160px]">
                        <option value="Semua Kategori">Semua Kategori</option>
                        <?php foreach ($kategori_list as $kat): ?>
                            <option value="<?= $kat ?>" <?= $filter_kategori === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Filter Status -->
                    <select name="status"
                        class="bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition min-w-[150px]">
                        <option value="Semua Status" <?= $filter_status === 'Semua Status' ? 'selected' : '' ?>>Semua Status</option>
                        <option value="Aktif" <?= $filter_status === 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="Nonaktif" <?= $filter_status === 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>

                    <!-- Buttons -->
                    <button type="submit"
                        class="bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition shadow-sm">
                        Terapkan
                    </button>
                    <a href="katalog.php"
                        class="bg-white hover:bg-slate-50 text-slate-600 font-semibold text-sm px-4 py-2.5 rounded-xl transition border border-slate-200 flex items-center gap-1.5">
                        <i class="fa-solid fa-rotate-right text-xs"></i> Reset
                    </a>

                </form>
            </div>

            <!-- DAFTAR TABEL PRODUK -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm flex-1 flex flex-col justify-between overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80 text-slate-500 text-[11px] font-bold uppercase tracking-wider border-b border-slate-200">
                                <th class="py-3.5 px-4 w-12 text-center">No</th>
                                <th class="py-3.5 px-4">Kode</th>
                                <th class="py-3.5 px-4">Nama Produk</th>
                                <th class="py-3.5 px-4">Kategori</th>
                                <th class="py-3.5 px-4 text-right">Harga Modal</th>
                                <th class="py-3.5 px-4 text-right">Harga Jual</th>
                                <th class="py-3.5 px-4 text-center">Stok</th>
                                <th class="py-3.5 px-4 text-center">Status</th>
                                <th class="py-3.5 px-4 text-center w-32">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            <?php if (count($produk_tampil) > 0): ?>
                                <?php $no = 1;
                                foreach ($produk_tampil as $p): ?>
                                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                                        <td class="py-3.5 px-4 text-center font-medium text-slate-400"><?= $no++ ?></td>
                                        <td class="py-3.5 px-4">
                                            <span class="font-mono text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md">
                                                <?= $p['kode'] ?>
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 font-semibold text-slate-800"><?= $p['nama'] ?></td>
                                        <td class="py-3.5 px-4">
                                            <span class="bg-slate-100 text-slate-600 text-xs px-2.5 py-1 rounded-lg font-medium">
                                                <?= $p['kategori'] ?>
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-right font-medium text-slate-500">
                                            Rp<?= number_format($p['harga_modal'], 0, ',', '.') ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-right font-bold text-slate-900">
                                            Rp<?= number_format($p['harga_jual'], 0, ',', '.') ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-center">
                                            <?php if ($p['stok'] <= 15): ?>
                                                <span class="inline-flex items-center gap-1 text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200/60 px-2.5 py-0.5 rounded-md">
                                                    <?= $p['stok'] ?> pcs
                                                </span>
                                            <?php else: ?>
                                                <span class="text-xs font-semibold text-slate-700">
                                                    <?= $p['stok'] ?> pcs
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3.5 px-4 text-center">
                                            <?php if ($p['status'] === 'Aktif'): ?>
                                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200/60 text-xs px-2.5 py-1 rounded-full font-semibold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-500 border border-slate-200/60 text-xs px-2.5 py-1 rounded-full font-semibold">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <button title="Ubah Produk"
                                                    class="w-8 h-8 rounded-lg border border-slate-200 bg-white hover:border-indigo-500 hover:bg-indigo-50 hover:text-indigo-600 text-slate-500 transition flex items-center justify-center text-xs">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                                <button title="Hapus Produk"
                                                    class="w-8 h-8 rounded-lg border border-slate-200 bg-white hover:border-rose-500 hover:bg-rose-50 hover:text-rose-600 text-slate-500 transition flex items-center justify-center text-xs">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center py-14 text-slate-400">
                                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto mb-3 text-slate-400">
                                            <i class="fa-solid fa-box-open text-xl"></i>
                                        </div>
                                        <p class="font-medium text-slate-600 text-sm">Data produk tidak ditemukan</p>
                                        <p class="text-xs mt-0.5">Coba ubah kata kunci pencarian atau reset filter.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- FOOTER / PAGINATION -->
                <div class="bg-slate-50/70 border-t border-slate-200/80 px-6 py-3.5 flex items-center justify-between text-xs text-slate-500 shrink-0">
                    <div>
                        Menampilkan <span class="font-bold text-slate-800">1 - <?= count($produk_tampil) ?></span> dari
                        <span class="font-bold text-slate-800"><?= count($produk_tampil) ?></span> produk
                    </div>
                    <div class="flex items-center gap-1.5">
                        <button class="w-7 h-7 flex items-center justify-center border border-slate-200 bg-white rounded-lg text-slate-400 cursor-not-allowed"
                            disabled>
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </button>
                        <button class="w-7 h-7 flex items-center justify-center bg-indigo-600 text-white font-bold rounded-lg shadow-sm">1</button>
                        <button class="w-7 h-7 flex items-center justify-center border border-slate-200 bg-white rounded-lg text-slate-400 cursor-not-allowed"
                            disabled>
                            <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>

</html>