<?php
session_start();

// Class View untuk mengatur tampilan
class View {
    public function tampilkanHeader() {
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Selamat Datang</title>
            <style>
                /* CSS untuk tampilan yang bagus */
                body {
                    margin: 0;
                    font-family: Arial, sans-serif;
                    background-color: #e2e1e1;
                }
            
                .container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
            
                .content {
                    text-align: center;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 80%;
                }
            
                .content h2 {
                    margin-bottom: 20px;
                    color: #333;
                }
            
                .navbar {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                    width: 200px;
                    background-color: #2dbd6e;
                    position: fixed;
                    height: 100%;
                    overflow: auto;
                    left: 0;
                }
            
                .navbar li a {
                    display: block;
                    color: white;
                    padding: 16px;
                    text-decoration: none;
                }
            
                .navbar li a:hover {
                    background-color: #a6f77b;
                }
            
                .menu-button {
                    display: none;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="content">
        HTML;
    }

    public function tampilkanFooter() {
        echo <<<HTML
                </div>
            </div>
        </body>
        </html>
        HTML;
    }
}

// Penggunaan kelas View untuk menampilkan halaman
$view = new View();
$view->tampilkanHeader();
echo "<h2>Selamat Datang</h2>";
echo "<h3>Peserta RUTILAHU: </h3>".$_SESSION['nama'];
$view->tampilkanFooter();
?>
