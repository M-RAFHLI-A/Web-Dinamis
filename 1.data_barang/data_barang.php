<?php
    $b_keripik = [
        [
            "foto" => "",
            "nama" => "Keripik Original",
            "ukuran" => "Kecil",
            "harga" => 5000,
            "stok" => 25,
            "kondisi" => [
                "Siap Jual = " . 18,
                "Finising  = " . 3,
                "Rusak     = " . 4
            ]
        ],
        [
            "foto" => "",
            "nama" => "Keripik Original",
            "ukuran" => "Besar",
            "harga" => 10000,
            "stok" => 15,
            "kondisi" => [
                "Siap Jual = " . 11,
                "Finising  = " . 3,
                "Rusak     = " . 1
            ]
        ],
        [
            "foto" => "",
            "nama" => "Keripik Pedas",
            "ukuran" => "Kecil",
            "harga" => 5000,
            "stok" => 30,
            "kondisi" => [
                "Siap Jual = " . 22,
                "Finising  = " . 6,
                "Rusak     = " . 2
            ]
        ],
        [
            "foto" => "",
            "nama" => "Keripik Pedas",
            "ukuran" => "Besar",
            "harga" => 10000,
            "stok" => 18,
            "kondisi" => [
                "Siap Jual = " . 15,
                "Finising  = " . 3,
                "Rusak     = " . 0
            ]
        ],
    ];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Atribut</title>
    </head>
<?php  ?> &nbsp;
    <body>
        <h3>Data Barang Jualan</h3>
        <?php foreach($b_keripik as $keripik) : ?>
            <ul>
                <li>Foto Produk &nbsp; : 
                    <?php echo $keripik["foto"]  ?>
                </li>
                <li>Nama Barang : <?php echo $keripik["nama"]  ?></li>
                <li>Ukuran/Size&nbsp;&nbsp;&nbsp;: <?php echo $keripik["ukuran"]  ?></li>
                <li>Harga Jual&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $keripik["harga"]  ?></li>
                <li>Stok Barang&nbsp;&nbsp; : <?php echo $keripik["stok"]  ?></li>
                <li>Kondisi nya&nbsp;&nbsp;&nbsp; : 
                    <?php for($i=0; $i<count($keripik["kondisi"]); $i++) : ?>
                        <?php if($i == 0) { ?>
                            <?php echo $keripik["kondisi"][$i] . "<br>" ?>  
                        <?php }else { ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo $keripik["kondisi"][$i] . "<br>" ?>
                        <?php } ?>                                            
                    <?php endfor ?>
                </li>
            </ul>
        <?php endforeach ?>
    </body>
</html>
