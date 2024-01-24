<?php @include('header.php') ?>
<?php
// Assuming you have a database connection stored in $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $rawPassword = $_POST["password"]; // Get the raw password

    // Hash the password using MD5
    $hashedPassword = md5($rawPassword);

    $location = isset($_POST["location"]) ? $_POST["location"] : null; // Check if location is set

    // Determine the selected type
    $type = isset($_POST["user_type"]) ? $_POST["user_type"] : null;

    // Insert data into the appropriate table
    if ($type === "user") {
        // Insert into userdata table
        $sql = "INSERT INTO userdata (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$hashedPassword')";
    } elseif ($type === "garage") {
        // Insert into garagedata table with location
        $sql = "INSERT INTO garagedata (garageName, garageEmail, garagePhone, garagePassword, garageLocation) VALUES ('$name', '$email', '$phone', '$hashedPassword', '$location')";
    }

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  

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

  <!-- ======= Header ======= -->
  

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('assets/img/cover.jpg');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Sign Up</h2>
              <p>Signup to our website to ehnance your experience.</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Signup</li>
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
        <h4>Sign Up As</h4>
    </div>

    <input type="hidden" name="user_type" id="userType" value="user">
<div class="col-md-6">
    <span class="get-a-quote" onclick="showForm('user')">User</span>
    <span class="get-a-quote" onclick="showForm('garage')">Garage</span>
</div>

    <div class="col-lg-12">
        <h4>Your Personal Details</h4>
    </div>

    <div class="col-md-12">
        <input type="text" name="name" class="form-control" placeholder="Name" required>
    </div>

    <div class="col-md-12">
        <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>

    <div class="col-md-12">
        <input type="text" class="form-control" name="phone" placeholder="Phone" required>
    </div>

    <div class="col-md-12">
    <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <div class="input-group-append">
            <span class="input-group-text" id="password-toggle">
                <i class="fa fa-eye" id="toggle-icon"></i>
            </span>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="input-group">
        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
        <div class="input-group-append">
            <span class="input-group-text" id="cpassword-toggle">
                <i class="fa fa-eye" id="ctoggle-icon"></i>
            </span>
        </div>
    </div>
</div>


    <div class="col-md-12" id="locationInput" style="display:none;">
        <input type="text" class="form-control" name="location" placeholder="Enter your Location" >
    </div>

    <div class="col-md-12 text-center">
        <div class="loading">Loading</div>
        <div class="error-message"></div>
        <div class="sent-message">Your data have been saved successfully. Thank you!</div>

        <button type="submit">Sign Up</button><hr>

        <p id="toggleText">Already have an account? <a href="login.php" >Login</a></p>
    </div>

</div>
</form>

<script>
        // Your existing JavaScript code goes here
        function showForm(type) {
    var locationInput = document.getElementById('locationInput');
    var userTypeInput = document.getElementById('userType');

    if (type === 'garage') {
        locationInput.style.display = 'block';
       
        userTypeInput.value = 'garage';
    } else {
        locationInput.style.display = 'none';
       
        userTypeInput.value = 'user';
    }
}

    </script>

<!-- Your custom script to toggle password visibility -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Password toggle
        document.getElementById('password-toggle').addEventListener('click', function () {
            togglePasswordVisibility('password', 'toggle-icon');
        });

        // Confirm Password toggle
        document.getElementById('cpassword-toggle').addEventListener('click', function () {
            togglePasswordVisibility('cpassword', 'ctoggle-icon');
        });

        function togglePasswordVisibility(inputId, iconId) {
            var passwordField = document.getElementById(inputId);
            var icon = document.getElementById(iconId);

            // Change the type attribute of the password input field
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    });
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
  <!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>