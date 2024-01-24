<!-- ======= Header ======= -->

<?php
@include('config.php');
 // Start a session for user authentication
 session_start();
// Assuming you have a database connection stored in $conn
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $rawPassword = $_POST["password"];

    // Hash the password using MD5 (Note: MD5 is not secure, consider using bcrypt or another secure hashing method)
    $hashedPassword = md5($rawPassword);

    // Perform a query to check if the user with the provided email and password exists in userdata table
    $userSql = "SELECT * FROM userdata WHERE email='$email' AND password='$hashedPassword'";
    $userResult = $conn->query($userSql);

    // Perform a query to check if the user with the provided email and password exists in garagedata table
    $garageSql = "SELECT * FROM garagedata WHERE garageEmail='$email' AND garagePassword='$hashedPassword'";
    $garageResult = $conn->query($garageSql);

    if ($userResult->num_rows > 0) {
        // User authentication successful in userdata table
        $_SESSION['user_email'] = $email; // Store user email in the session for future use
        header("Location: user_dashboard.php"); // Redirect to the user dashboard or any other authenticated page
        exit();
    } elseif ($garageResult->num_rows > 0) {
        // User authentication successful in garagedata table
        $_SESSION['garage_email'] = $email; // Store garage email in the session for future use
        header("Location: garage_dashboard.php"); // Redirect to the garage dashboard or any other authenticated page
        exit();
    } else {
        // User authentication failed in both tables
        echo "Invalid email or password";
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
  
    <title>Hamro Mechanic</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
  
    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  
    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
  

<style>
  .col-md-6 .get-a-quote,
  .col-md-6.get-a-quote:focus {
    background: var(--color-primary);
    padding: 8px 20px;
    margin-left: 30px;
    border-radius: 4px;
    color: #fff;
  }

  .col-md-6 .get-a-quote:hover,
  .col-md-6 .get-a-quote:focus:hover {
    color: #fff;
    background: #2756ff;
  }
  </style>
</head>


<body>


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/cover.jpg');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Login</h2>
              <p>Login to our website to ehnance your experience.</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Login</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Get a Quote Section ======= -->
    <section id="get-a-quote" class="get-a-quote">
      <div class="container" data-aos="fade-up">

        <div class="row g-0">

          <div class="col-lg-5 quote-bg" style="background-image: url(assets/img/6538623.jpg);"></div>

          <div class="col-lg-7">
          <form action="#" method="post" class="php-email-form" id="quoteForm">

<div class="row gy-4">
   

    <div class="col-lg-12">
        <h4>Login</h4>
    </div>
  
    <div class="col-md-12">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>


    <div class="col-md-12">
        <input type="text" class="form-control" name="password" placeholder="Password" required>
    </div>


    <div class="col-md-12 text-center">
        <!-- <div class="loading">Loading</div> -->
        <div class="error-message"></div>
        <div class="sent-message">Your have logged in successfully. Thank you!</div>

        <button type="submit">Login</button><hr>
        <p id="toggleText">Don't have an account? <a href="registration.php" >Sign Up</a></p>
    </div>

</div>
</form>

<script>
    function showForm(type) {
        var locationInput = document.getElementById('locationInput');

        if (type === 'garage') {
            locationInput.style.display = 'block';
        } else {
            locationInput.style.display = 'none';
        }
    }
</script>

          </div><!-- End Quote Form -->

        </div>

      </div>
    </section><!-- End Get a Quote Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php @include('footer.php') ?>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>