<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tampil Buku</title>
    <link rel="stylesheet" href="bootstrap-5.1.3-dist\css\bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-6.0.0-web\css\all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
<!-- Tautan ke Font Awesome CSS (untuk ikon) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font- awesome/5.15.3/css/all.min.css">
<!-- Tambahkan Pengaturan Halaman -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<br><br><br>
    <div class="wrapper">
        <div class="container-responsive">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="text-center">informasi buku</h2>
                        <a href="catatan.php" class="btn btn-success">Tambah Baru</a>
                       
                    </div>
                    <?php
                    // Include config file
                    require_once "koneksi.php";

                   // Attempt select query execution
                    $sql = "SELECT * FROM apk_catatan";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped table-responsive' style='width: 120%; text-align: center'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>No </th>";
                                        echo "<th>Judul </th>";
                                        echo "<th>Notes</th>";
                                        echo "<th>kategori</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['no'] . "</td>";
                                        echo "<td>" . $row['judul'] . "</td>";
                                        echo "<td>" . $row['notes'] . "</td>";
                                        echo "<td>" . $row['kategori'] . "</td>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
