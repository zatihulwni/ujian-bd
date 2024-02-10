<?php
// Include config file
require_once "koneksi.php";

// Define variables and initialize with empty values
$judul = $notes = $kategori = "";
$judul_err = $notes_err = $kategori_err = "";

// Processing form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Validate Judul Buku
    $input_judul = trim($_POST["judul"]);
    if (empty($input_judul)) {
        $judul_err = "Masukkan Judul.";
    } else {
        $judul = $input_judul;
    }

    // Validate notes
    $input_notes = trim($_POST["notes"]);
    if (empty($input_notes)) {
        $notes_err = "Masukkan notes.";
    } else {
        $notes = $input_notes;
    }

    // Validate kategori
    $input_kategori = trim($_POST["kategori"]);
    if (empty($input_kategori)) {
        $kategori_err = "Masukkan kategori";
    } else {
        $kategori = $input_kategori;
    }

  
    // Check input errors before inserting into the database
    if (empty($judul_err) && empty($notes_err) && empty($kategori_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO apk_catatan (judul, notes, kategori) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_judul, $param_notes, $param_kategori);

            // Set parameters
            $param_judul = $judul;
            $param_notes = $notes;
            $param_kategori = $kategori;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to the landing page
                header("location: catatan.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>aplikasi catatan</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>APLIKASI CATATAN</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>">
                            <span class="help-block"><?php echo $judul_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($notes_err)) ? 'has-error' : ''; ?>">
                            <label>Notes</label>
                            <textarea type="text" name="notes" class="form-control" value="<?php echo $notes; ?>"></textarea> 
                            <span class="help-block"><?php echo $notes_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($kategori_err)) ? 'has-error' : ''; ?>">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" value="<?php echo $kategori; ?>">
                            <span class="help-block"><?php echo $kategori_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="view.php" class="btn btn-primary">tampil</a>
                        <a href="catatan.php" class="btn btn-primary">edit</a>
                        <a href="catatan.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>