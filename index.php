<?php
// inisialisasi session
session_start();
require 'conn.php';
// cek user aktif apa ngak
if(!isset($_SESSION['user'])){
    // link untuk mengarah ke login
    header('location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alexandria</title>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Eagle+Lake&family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <!-- link icon search -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <!-- link css -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> 
    <!-- icon web -->
    <link rel="icon" sizes="32x32" href="asset/img/Alexandria.png" type="img/png">
</head>
<body>
    <?php
    if (isset($_POST['submit']) && isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $user_id = $_SESSION['user']['id_user'];
    
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png'];
    
        if (in_array($file_ext, $allowed_ext)) {
            $new_file_name = uniqid() . '.' . $file_ext;
            $target_dir = 'Profile/';
            $target_file = $target_dir . $new_file_name;
    
            // hapus file lama kalau ada
            $query = mysqli_query($conn, "SELECT profile FROM user WHERE id_user = '$user_id'");
            $data = mysqli_fetch_assoc($query);
            if (!empty($data['profile']) && file_exists($target_dir . $data['profile'])) {
                unlink($target_dir . $data['profile']);
            }
    
            if (move_uploaded_file($file_tmp, $target_file)) {
                $sql = "UPDATE user SET profile = '$new_file_name' WHERE id_user = '$user_id'";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['user']['profile'] = $new_file_name;
                    echo "Foto berhasil di-upload.";
                } else {
                    echo "Gagal menyimpan ke database.";
                }
            } else {
                echo "Gagal memindahkan file.";
            }
        } else {
            echo "Ekstensi file tidak diizinkan.";
        }
    } else {
        echo "Silakan pilih gambar sebelum meng-upload.";
    }
    

    $profile = isset($_SESSION['user']['profile']) && $_SESSION['user']['profile'] != null
    ? 'Profile/' . $_SESSION['user']['profile']
    : 'asset/img/default.jpg'; // jika NULL, pakai default
?>

    <div class="top_nav">
        <a href="#"><span>Alexandria</span></a>
        <div class="search">
            <span class="material-symbols-outlined">search</span>
            <input type="search" name="search" placeholder="Search book">
        </div>
        <div class="option">
            <a href="#" id="profileToggle"><?php echo $_SESSION['user']['name']?></a>
            <a href="#" id="profileToggleImg"><img src="<?php echo $profile;?>" alt=""></a>
        </div>
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="profile_picture" id="profilePanel">
        <div class="content">
            <form action="" method="post" autocomplete="off" enctype="multipart/form-data" class="upload-form">
            <label for="image" class="image-label">
                <img 
                    src="<?php echo $profile; ?>"
                    alt="Profile" 
                    class="profile-img"
                >
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
            </label>
            <button type="submit" name="submit" class="upload-btn">+</button>
            </form>
            <p><?php echo $_SESSION['user']['name']; ?></p>
            <a href="logout.php"><img src="asset/icon/logout.svg" alt="logout"><span>Log out</span></a>
        </div>
    </div>

     <div class="left_nav">
        <a href="#book" class="links"><img src="asset/icon/book.svg" alt="book"><span>Book</span></a>
        <a href="#favorite" class="links"><img src="asset/icon/star.svg" alt="star"><span>Favorite</span></a>
        <a href="#history" class="links"><img src="asset/icon/history.svg" alt="history"><span>History</span></a>
     </div>

    <div class="content1" id="book">
        <div class="card">
            <img src="asset/img/bumi.jpg" alt="gambar">
            <h3>Bumi</h3>
            <p>Tereliye</p>
            <p>Sciece fiction Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Comet.jpg" alt="gambar">
            <h3>Comet</h3>
            <p>Tereliye</p>
            <p>Sciece fiction Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Constatinopel.jpg" alt="gambar">
            <h3>Constatinopel</h3>
            <p>Roger Crowley</p>
            <p>History</p>
        </div>

        <div class="card">
            <img src="asset/img/Harry potter.jpg" alt="gambar">
            <h3>Harry Potter</h3>
            <p>J.K Rowling</p>
            <p>Magic Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Kisah TJ.jpg" alt="gambar">
            <h3>Kisah Tanah Jawa</h3>
            <p>Bonaventura D. Genta</p>
            <p>Mistical</p>
        </div>

        <div class="card">
            <img src="asset/img/hatta.jpg" alt="gambar">
            <h3>Hatta</h3>
            <p>Wartawan Tempo</p>
            <p>Biographie</p>
        </div>

        <div class="card">
            <img src="asset/img/Matahari.jpg" alt="gambar">
            <h3>Matahari</h3>
            <p>Tereliye</p>
            <p>Sciece fiction Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Siputih.jpg" alt="gambar">
            <h3>Si Putih</h3>
            <p>Tereliye</p>
            <p>Sciece fiction Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Night books.jpg" alt="gambar">
            <h3>NightBooks</h3>
            <p>J.A.White</p>
            <p>fiction Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Teh dan penghianatan.jpg" alt="gambar">
            <h3>Teh dan penghianatan</h3>
            <p>Iksaka Banu</p>
            <p>History</p>
        </div>

        <div class="card">
            <img src="asset/img/The Lovely Dark.jpg" alt="gambar">
            <h3>The Lovely Dark</h3>
            <p>Matthew fox</p>
            <p>fiction</p>
        </div>

        <div class="card">
            <img src="asset/img/The skeleton man.jpg" alt="gambar">
            <h3>The Skeleton Man</h3>
            <p>Joseph bruchac</p>
            <p>fiction Adventure</p>
        </div>

    </div>

    <div class="content2" id="favorite">
        <div class="card">
            <img src="asset/img/bumi.jpg" alt="gambar">
            <h3>Bumi</h3>
            <p>Tereliye</p>
            <p>Sciece fiction Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Comet.jpg" alt="gambar">
            <h3>Comet</h3>
            <p>Tereliye</p>
            <p>Sciece fiction Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Harry potter.jpg" alt="gambar">
            <h3>Harry Potter</h3>
            <p>J.K Rowling</p>
            <p>Magic Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Matahari.jpg" alt="gambar">
            <h3>Matahari</h3>
            <p>Tereliye</p>
            <p>Sciece fiction Adventure</p>
        </div>

        <div class="card">
            <img src="asset/img/Siputih.jpg" alt="gambar">
            <h3>Si Putih</h3>
            <p>Tereliye</p>
            <p>Sciece fiction Adventure</p>
        </div>

    </div>

    <div class="content3" id="history">
        <div class="card">
            <img src="asset/img/bumi.jpg" alt="gambar">
                <div>
                    <h3>Bumi</h3>
                    <p>Tereliye</p>
                    <p>Sciece fiction Adventure</p>
                </div>
            </div>

        <div class="card">
            <img src="asset/img/Comet.jpg" alt="gambar">
            <div>
                <h3>Comet</h3>
                <p>Tereliye</p>
                <p>Sciece fiction Adventure</p> 
            </div>
        </div>

        <div class="card">
            <img src="asset/img/Harry potter.jpg" alt="gambar">
                <div>
                    <h3>Harry Potter</h3>
                    <p>J.K Rowling</p>
                    <p>Magic Adventure</p>
                </div>
        </div>

        <div class="card">
            <img src="asset/img/Matahari.jpg" alt="gambar">
            <div>
                <h3>Matahari</h3>
                <p>Tereliye</p>
                <p>Sciece fiction Adventure</p>
            </div>
        </div>

        <div class="card">
            <img src="asset/img/Siputih.jpg" alt="gambar">
            <div>
                <h3>Si Putih</h3>
                <p>Tereliye</p>
                <p>Sciece fiction Adventure</p>
            </div>
        </div>

    </div>

    <!-- javascript -->
     <script src="java/script.js"></script>
</body>
</html>