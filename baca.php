<?php
    include 'koneksi.php';
    session_start();
    $id_peminjaman=$_GET['id'];
    $id_user=$_SESSION['id_user'];



    $query="SELECT p.id_peminjaman, b.file_buku FROM peminjaman p JOIN buku b USING(id_buku) WHERE p.id_peminjaman='$id_peminjaman' AND p.id_user='$id_user' ";
    $stmt = $koneksi->prepare($query);
    if($stmt===false){
        die('Error prepare statement: ' . htmlspecialchars(string: $koneksi->error));

    }

    $stmt->execute();
    $result=$stmt->get_result();
    $rows=$result->fetch_assoc();


    $pdf=$rows['file_buku'];
    $pdfPath = htmlspecialchars('./assets/pdf/' . $pdf);


?>
<html>
    <head>
        <title>Bacaan</title>
    <link href="assets/img/logo/logobuku.jpg" rel="icon">
    </head>
    <body>
    <style>
        .pdf-viewer {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    padding: 0;
    background-color: #fff;
    overflow: hidden;
}

.pdf-viewer embed {
    width: 100%;
    height: 100%;
    border: none;
}

body {
    margin: 0;
    padding: 0;
    overflow: hidden;
}
    </style>
    <embed src="<?php echo $pdfPath; ?>#toolbar=0&navpanes=0" height="500" width="1000" sandbox="allow-scripts allow-same-origin"></embed>
    </body>
    <footer>

    </footer>
</html>