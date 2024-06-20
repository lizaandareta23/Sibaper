<?php
// Class untuk menampilkan header dan footer halaman
class View {
    public function displayHeader() {
        echo <<<HTML
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="styles3.css">
            <title>Layout</title>
        </head>
        <body>
HTML;
    }

    public function displayFooter() {
        echo <<<HTML
        </body>
        </html>
HTML;
    }

    public function displayContent() {
        echo <<<HTML
        <div id="card">
            <div id="card-content">
                <div id="card-title">
                    <div class="container">
                        <div class="gambar">
                            <img src="karawang.png" alt="" width="150" height="100">
                        </div>
                        <div class="text">
                            <h3>PEMERINTAH</h3>
                            <h1>KABUPATEN KARAWANG</h1>
                            <h3>JAWABARAT</h3>
                        </div>
                    </div>
                    <div class="underline-title"></div>
                </div>
                <p class="sepasi"></p>
                <div class="text">
                    <h1>Dinas Perumahan Rakyat dan Kawasan Pemukiman
                    Gedung Pemda II Lt.2 Jl. Siliwangi, Kel.Karawang Wetan,
                    Kec. Karawang Timur, Kabupaten Karawang, Jawa Barat 41314.
                    </h1>
                </div>
            </div>
        </div>
HTML;
    }
}

// Penggunaan kelas View untuk menampilkan halaman
$view = new View();
$view->displayHeader();
$view->displayContent();
$view->displayFooter();
?>
