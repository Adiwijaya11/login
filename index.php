
<?php
    session_start();
    include "konek/koneksi.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data"> 
            <div class="form">
                <form action="login.php" method="post">
                    <input class="input-id" type="name" name="id" placeholder="Masukan ID">
                    <input class="input-id" type="password" name="pass" placeholder="Masukan Password">
                    <div class="edit-tombol-id">
                        <button class="tombol-id" type="submit">Masuk</button>
                    </div>
                </form>
                
                
            </div>
        </form>


<?php

if (isset($_POST['id'])) {
    $id = $_POST["id"];
    $password = $_POST["pass"];

    
    $query = mysqli_query($koneksi, "SELECT * FROM tabel_login WHERE id_user='$id' AND password='$password'");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        $_SESSION['id'] = $user["id"];
        $_SESSION['username'] = $user['username'];
    }

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);

        $_SESSION["id_user"] = $data['id_user'];
        $_SESSION["role"] = $data['role'];

        
        if ($data['role'] === 'siswa') {
            header("Location: siswa/dashboard.php");
            exit();
        } elseif ($data['role'] === 'guru') {
            header("Location: guru/dashboard.php");
            exit();
        } elseif ($data['role'] === 'admin') {
            header("Location: admin/dashboard.php");
            exit();
        } else {
            echo '<script>alert("Role tidak dikenali.");</script>';
        }

    } else {
        echo '<script>alert("ID atau password salah.");</script>';
    }
}
?>






    </div>
</body>
</html>