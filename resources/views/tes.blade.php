<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segitiga Bintang Simetris</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f4f6f9;
        }
        .container {
            max-width: 500px;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        input[type="number"] {
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
            margin-top: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: #d9534f;
            background-color: #f2dede;
            padding: 10px;
            border-radius: 4px;
            margin-top: 15px;
        }
        .output {
            /* Menggunakan font monospace dan tag <pre> agar spasi terbaca akurat */
            font-family: 'Courier New', Courier, monospace;
            background-color: #222;
            color: #00ff88;
            padding: 20px;
            border-radius: 4px;
            margin-top: 15px;
            overflow-x: auto;
            line-height: 1.2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Generator Segitiga Bintang</h2>
    
    <!-- 2. Form untuk memasukkan tinggi segitiga -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="tinggi">Masukkan Tinggi Segitiga (1 - 20):</label>
            <input type="number" id="tinggi" name="tinggi" placeholder="Contoh: 5" required>
        </div>
        <button type="submit" name="submit">Buat Segitiga</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $input = $_POST['tinggi'];

        // 3. Validasi bilangan bulat 1 sampai 20
        // filter_var memastikan input benar-benar integer (bukan desimal seperti 5.5)
        if (filter_var($input, FILTER_VALIDATE_INT) !== false && $input >= 1 && $input <= 20) {
            $tinggi = (int)$input;
            
            // 4. Tag <pre> menjaga agar spasi kosong di HTML tidak terpotong otomatis
            echo '<pre class="output">';

            // 1. Perulangan bersarang (Nested Loop)
            // Loop luar untuk mengatur baris (1 sampai tinggi)
            for ($i = 1; $i <= $tinggi; $i++) {
                
                // Loop dalam pertama: mencetak spasi pendorong di sebelah kiri agar simetris
                for ($spasi = 1; $spasi <= ($tinggi - $i); $spasi++) {
                    echo " ";
                }

                // Loop dalam kedua: mencetak bintang beserta spasi pemisah
                for ($bintang = 1; $bintang <= $i; $bintang++) {
                    echo "* ";
                }

                // Pindah ke baris baru
                echo "\n";
            }

            echo '</pre>';
        } else {
            // Pesan jika masukan tidak valid
            echo '<div class="error"><strong>Input tidak valid!</strong> Harap masukkan bilangan bulat antara 1 sampai 20.</div>';
        }
    }
    ?>
</div>

</body>
</html>