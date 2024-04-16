<?php

//include "./inc/header.php";
include_once __DIR__ . '../../config.php';
include "./service/Airport.php";
include "./service/Airline.php";
include "./service/Flight.php";

// $loginmsg = Session::get('loginmsg');
// $username = Session::get('username');
// if (isset($loginmsg)) {
//   echo $loginmsg;
// }
// Session::set('loginmsg', NULL);

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$showflights = false;

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
//   $flight = new Flight();
//   $flights = $flight->filterFlights(
//     $_POST['source'],
//     $_POST['destination'],
//     $_POST['departure'],
//     $_POST['arrival']
//   );

//   if ($flights)
//     $showflights = true;
// }

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flight Reservation System</title>

  <!-- Bootstrap css  -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- select2 css -->
  <link href="<?php echo ROOT_URL; ?>libs/select2/select2.min.css" rel="stylesheet" />
  <!-- our customized style -->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>inc/custom-style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Noto Sans', sans-serif;
    }

    section {
      position: relative;
      height: 100vh;
      font-family: 'Poppins', sans-serif;
      background-image: url('../public/images/gozayan.png');
      background-size: cover;
      background-position: center;
    }

    section .section-center {
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
    }

    .navbar {
      background-color: #C5ECFB;
    }

    .additional {
      min-height: 100vh;
      background-color: #EBF0F4;
    }

    .additional .deals,
    .offers {
      padding-top: 5%;
      padding-bottom: 5%;
    }

    footer {
      height: 75vh;
      background-color: #1C3C6B;
      color: #ffffff;
      padding-top: 5%;
    }

    footer .footer-content {
      height: 50vh;
      border-bottom: solid thin #ffffff;
    }

    footer .payment-methods {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    footer .payment-methods li {
      display: inline-block;
      margin: 0 5px 5px 0;
    }

    footer .payment-methods li img {
      max-width: 45px;
      height: auto;
      border-radius: 4%;
    }

    .spinner-overlay {
      position: fixed;
      /* Full-screen overlay */
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.7);
      /* Semi-transparent white background */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1050;
      /* Higher than most elements */
    }

    /* Blurred background style */
    .blur-background {
      filter: blur(5px);
    }
  </style>

</head>

<body class="text-center">
  <section class="text-center">
    <!-- navbar -->
    <div class="container">
      <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
          <a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">
            <img src="<?php echo ROOT_URL; ?>../public/images/logo.png" class="logo-brand" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo ROOT_URL; ?>index.php">Home</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

    <!-- booking form -->
    <div class="container justify-content-center section-center">
      <div class="row ">
        <div class="col-lg-12 card mt-4">
          <form action="" method="post" class="row mt-4 card-body">
            <div class="col-lg-3 text-start">
              <div class="col-12 text-start">
                <label for="source" class="col-form-label">FROM </label>
              </div>
              <div class="col-12 text-start">
                <select class="form-select form-select-lg mb-3 select2" aria-label=".form-select-lg" name="source" required>
                  <option>Select One</option>
                  <?php
                  if ($airports) {
                    while ($airport = $airports->fetch_assoc()) {
                      echo <<<HTML
                    <option value="{$airport['name']}">{$airport['name']}</option>
                  HTML;
                    }
                    // Reset internal pointer of result set
                    $airports->data_seek(0);
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-lg-3 text-start">
              <div class="col-12 text-start">
                <label for="source" class="col-form-label">TO </label>
              </div>
              <div class="col-12 text-start">
                <select class="form-select form-select-lg mb-3 select2" aria-label=".form-select-lg" name="destination" required>
                  <option>Select One</option>
                  <?php
                  if ($airports) {
                    while ($airport = $airports->fetch_assoc()) {
                      echo <<<HTML
                    <option value="{$airport['name']}">{$airport['name']}</option>
                  HTML;
                    }
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="row justify-content-start">
                <div class="col-lg-4">
                  <div class="col-lg-12 text-start">
                    <label for="departure" class="col-form-label">Departure</label>
                  </div>
                  <div class="col-lg-12 text-start">
                    <input type="date" name="departure" class="form-control-lg" min="2024-03-29" max="2024-04-29">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="col-lg-12 text-start">
                    <label for="arrival" class="col-form-label">Return</label>
                  </div>
                  <div class="col-lg-12 text-start">
                    <input type="date" name="arrival" class="form-control-lg" min="2024-03-29" max="2024-04-29">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="col-lg-12 text-start">
                    <label for="role" class="col-form-label">Class</label>
                  </div>
                  <div class="col-lg-12 text-start">
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="class" required>
                      <option>First Class</option>
                      <option>Economy</option>
                      <option>Business</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-12 text-center">
              <input type="submit" id="search-btn" class="btn btn-lg btn-warning" name="search" value="search Flights" />
            </div>

          </form>
        </div>
      </div>
    </div>

    <!-- loader --><!-- The Bootstrap Spinner -->
    <!-- <div id="loading-spinner" class="spinner-overlay">
      <div class="spinner-border m-5" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> -->

    <!-- The Bootstrap Spinner (hidden initially) -->
    <!-- <div id="loading-spinner" class="spinner-overlay" style="display:none;">
      <div class="spinner-border text-primary m-5" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div> -->


  </section>

  <!-- show flights -->
  <div class="container justify-content-center section-center">
    <div class="row ">

      <?php
      if ($showflights) {
        $count = 1;
        while ($flight = $flights->fetch_assoc()) {
      ?>
          <div class="card col-lg-12 text-center mt-4 " style="min-height: 25vh;">
            <!-- <div class="card-header">
        Featured
      </div> -->
            <div class="card-body row">
              <div class="col-lg-3">
                <div class="row">
                  <div class="col-lg-4">
                    <img src="<?php echo ROOT_URL; ?>../public/images/airplane.jpg" width="100%" height="auto" />
                  </div>
                  <div class="col-lg-8">
                    <?php
                    echo $flight['airline'];
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-lg-4">
                    <?php echo
                    date('h:i A', strtotime($flight['departure']));
                    ?>
                  </div>
                  <div class="col-lg-4">
                  </div>
                  <div class="col-lg-4">
                    <?php echo
                    date('h:i A', strtotime($flight['arrival']));
                    ?>
                  </div>
                </div>
              </div>

              <div class="col-lg-3">
                <div class="row justify-content-center">
                  <h5>
                    <?php echo "Flight  " . $flight['id'];
                    ?>
                  </h5>
                  <div class="col-lg-12">
                    <?php echo "BDT  " . $flight['price'];
                    ?>
                  </div>

                  <a href="#" class="btn btn-warning col-lg-8">Select</a>
                </div>
              </div>
              <!-- <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
            <div class="card-footer text-body-secondary text-end">
              details
            </div>
          </div>

      <?php
          $count++;
        }
      }
      ?>
    </div>
  </div>

  <!-- hot deals, offers -->
  <div class="additional pt-4 pb-4">
    <div class="container text-start mt-4 deals">
      <h4 style="color: #1C3C6B"> <b> Hot Deals </b> </h4>
      <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <div class="col">
          <div class="card h-100">
            <img src="<?php echo ROOT_URL; ?>../public/images/qatar.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Save up to 10% on Business Class</h5>
              <!-- <p class="card-text text-end">
                <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
              </p> -->
            </div>
            <div class="card-footer text-end">
              <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="<?php echo ROOT_URL; ?>../public/images/cathay.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Enjoy Exclusive Fare</h5>
              <!-- <p class="card-text text-end">
                <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
              </p> -->
            </div>
            <div class="card-footer text-end">
              <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="<?php echo ROOT_URL; ?>../public/images/singapore.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Discover the world from Dhaka with exclusive fare deals</h5>
              <!-- <p class="card-text text-end">
                <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
              </p> -->
            </div>
            <div class="card-footer text-end">
              <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="container text-start mt-4 mb-4 offers">
      <h4 style="color: #1C3C6B"> <strong> Special Offers </strong> </h4>
      <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <div class="col">
          <div class="card h-100">
            <img src="<?php echo ROOT_URL; ?>../public/images/qatar.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Save up to 10% on Business Class</h5>
              <!-- <p class="card-text text-end">
                <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
              </p> -->
            </div>
            <div class="card-footer text-end">
              <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="<?php echo ROOT_URL; ?>../public/images/cathay.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Enjoy Exclusive Fare</h5>
              <!-- <p class="card-text text-end">
                <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
              </p> -->
            </div>
            <div class="card-footer text-end">
              <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <img src="<?php echo ROOT_URL; ?>../public/images/singapore.jpg" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">Discover the world from Dhaka with exclusive fare deals</h5>
              <!-- <p class="card-text text-end">
                <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
              </p> -->
            </div>
            <div class="card-footer text-end">
              <a href="#" class="btn btn-lg btn-warning "> Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <footer>
    <div class="container">
      <div class="row pt-4 footer-content">
        <div class="col-lg-3 text-start">
          <h6> Discover </h6>
        </div>
        <div class="col-lg-3 text-start">
          <h6> Payment Methods </h6>
          <ul class="payment-methods mt-2">
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/bkash.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/nagad.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/rocket.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/visa.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/bkash.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/nagad.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/rocket.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/visa.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/bkash.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/nagad.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/rocket.png">
            </li>
            <li class="payment-image">
              <img src="<?php echo ROOT_URL; ?>../public/images/visa.png">
            </li>
          </ul>
        </div>
        <div class="col-lg-3 text-start">
          <h6> Need Help? </h6>
        </div>
        <div class="col-lg-3 text-start">
          <h6> Contact </h6>
        </div>
      </div>

      <div class="row mt-4 text-start">
        <a class="navbar-brand" href="<?php echo ROOT_URL; ?>index.php">
          <img src="<?php echo ROOT_URL; ?>../public/images/logo.png" class="logo-brand" />
        </a>
      </div>

    </div>
  </footer>


  <!-- jquery js -->
  <script src="<?php echo ROOT_URL; ?>libs/jquery/jquery-3.7.1.js"></script>
  <!-- Popperjs -->
  <script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/popper.min.js"></script>
  <!-- Bootstrap js  -->
  <script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
  <!-- select2 js -->
  <script src="<?php echo ROOT_URL; ?>libs/select2/select2.min.js"></script>

  <script>
    // $(document).ready(function() {
    //   $('.select2').select2();
    // });

    $(document).ready(function() {

      // select2
      $('.select2').select2();

      // $('#search-btn').on('click', function() {
      //   var source = $("[name='source']").val();
      //   var destination = $("[name='destination']").val();
      //   var departure = $("[name='departure']").val();
      //   var arrival = $("[name='arrival']").val();

      //   //alert(source + " " + destination + " " + departure + " " + arrival);

      //   // Redirect after 2 seconds
      //   // setTimeout(function() {
      //   //   window.location.href = 'search-flights.php';
      //   // }, 1000);


      //   window.location.href = 'search-flights.php';
      // });

      $('#search-btn').on('click', function() {
        event.preventDefault(); // Prevent the form from submitting
        var source = encodeURIComponent($("[name='source']").val());
        var destination = encodeURIComponent($("[name='destination']").val());
        var departure = encodeURIComponent($("[name='departure']").val());
        var arrival = encodeURIComponent($("[name='arrival']").val());

        // Construct the URL with query parameters
        var url = 'search-flights.php?source=' + source + '&destination=' + destination +
          '&departure=' + departure + '&arrival=' + arrival;

        // Redirect to the constructed URL
        window.location.href = url;
      });



      // $('form').on('submit', function() {
      //   // Show the spinner and blur the page
      //   $('#loading-spinner').show();
      // });


      // $('form').on('submit', function(event) {
      //   event.preventDefault(); // Prevent the form from submitting the traditional way
      //   var formData = $(this).serialize(); // Get the form data

      //   // Show the spinner and blur the page
      //   $('#loading-spinner').show();
      //   $('body').addClass('blur-background');

      //   // Send form data with AJAX
      //   $.post('service/Flight.php', formData, function(response) {
      //     // This is the callback function that receives the response from your PHP script
      //     // If the PHP script returns a success message
      //     if (response.success) {
      //       // Redirect to search-flights.php
      //       window.location.href = 'search-flights.php';
      //     } else {
      //       // Handle error, hide spinner, etc.
      //       $('#loading-spinner').hide();
      //       $('body').removeClass('blur-background');
      //     }
      //   }, 'json'); // Expect a JSON response from your PHP script
      // });
    });
  </script>

  </script>
</body>


</html>