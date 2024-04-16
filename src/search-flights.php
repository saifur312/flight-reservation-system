<?php

include_once __DIR__ . '../../config.php';
include "./service/Airport.php";
include "./service/Airline.php";
include "./service/Flight.php";

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$showflights = false;

$flight = new Flight();

if (isset($_GET['source'])) {
  // Retrieve the data from the query string
  $src = $_GET['source'];
  $dst = $_GET['destination'];
  $dep = $_GET['departure'];
  $arv = $_GET['arrival'];

  //echo "$src + $dst + $dep + $arv";
  $flights = $flight->filterFlights($src, $dst, $dep, $arv);

  if ($flights) {
    $showflights = true;
  }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
  $flights = $flight->filterFlights(
    $_POST['source'],
    $_POST['destination'],
    $_POST['departure'],
    $_POST['arrival']
  );

  if ($flights)
    $showflights = true;
}

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
      background-color: #EBF0F4;
    }

    section {
      /* position: relative;
      height: 100vh;
      background-image: url('../public/images/gozayan.png');
      background-size: cover;
      background-position: center; */

      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
    }

    /* 
    section .section-center {
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
    } */

    .navbar {
      background-color: #ffffff;
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
      margin-top: 5%;
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

    .filter-bar {
      min-height: 40px;
      background-color: #ffffff;
    }
  </style>

</head>

<body class="text-center">
  <section class="text-center">
    <!-- navbar -->
    <div class="container-fluid">
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
    <div class="container-fluid justify-content-center ">
      <div class="row ">
        <div class="col-lg-12 card mt-4">
          <form action="" method="post" class="row mt-4 card-body align-items-center">
            <div class="col-lg-2 text-start">
              <div class="col-12 text-start">
                <label for="source" class="col-form-label">FROM </label>
              </div>
              <div class="col-12 text-start">
                <select class="form-select form-select-lg mb-3 select2" aria-label=".form-select-lg" name="source" required>
                  <option>Select One</option>
                  <?php
                  if ($airports) {
                    while ($airport = $airports->fetch_assoc()) {
                      $selected = '';
                      if ($src == $airport['name'])
                        $selected = 'selected';
                      echo <<<HTML
                    <option value="{$airport['name']}" {$selected}>{$airport['name']}</option>
                  HTML;
                    }
                    // Reset internal pointer of result set
                    $airports->data_seek(0);
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-lg-2 text-start">
              <div class="col-12 text-start">
                <label for="source" class="col-form-label">TO </label>
              </div>
              <div class="col-12 text-start">
                <select class="form-select form-select-lg mb-3 select2" aria-label=".form-select-lg" name="destination" required>
                  <option>Select One</option>
                  <?php
                  if ($airports) {
                    while ($airport = $airports->fetch_assoc()) {
                      $selected = '';
                      if ($dst == $airport['name'])
                        $selected = 'selected';
                      echo <<<HTML
                    <option value="{$airport['name']}" {$selected}> {$airport['name']}</option>
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
                    <input type="date" name="departure" class="form-control-lg" min="2024-03-29" max="2024-04-29" value="<?php echo $dep ?>">
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="col-lg-12 text-start">
                    <label for="arrival" class="col-form-label">Return</label>
                  </div>
                  <div class="col-lg-12 text-start">
                    <input type="date" name="arrival" class="form-control-lg" min="2024-03-29" max="2024-04-29" value="<?php echo $arv ?>">
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

            <div class="col-lg-2 text-center">
              <input type="submit" class="btn btn-lg btn-warning" name="search" value="Modify search" />
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- filter-bar -->
  <div class="container filter-bar mt-2">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation" style="display:none;">
        <button class="nav-link active" id="empty-tab" data-bs-toggle="tab" data-bs-target="#empty-tab-pane" type="button" role="tab" aria-controls="empty-tab-pane" aria-selected="true"></button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <!-- Add a corresponding empty tab-pane for the hidden tab -->
      <div class="tab-pane fade show active" id="empty-tab-pane" role="tabpanel" aria-labelledby="empty-tab" tabindex="0"></div>
      <div class="tab-pane fade" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">...</div>
      <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
      <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
    </div>
  </div>

  <div class="container justify-content-center mt-4">
    <div class="row ">
      <div class="col-lg-9">
        <div class="row ">
          <div class="col-lg-12 filter-bar">
            <div class="row pt-1">
              <div class="col-lg-6"> Cheapest</div>
              <div class="vr" style="padding: 0;"></div>
              <div class="col-lg-5"> Fastest</div>
            </div>
          </div>

          <!-- show flights -->
          <?php
          if ($showflights) {
            $count = 1;
            while ($flight = $flights->fetch_assoc()) {
          ?>
              <div class="card col-lg-12 text-center mt-4 " style="min-height: 25vh;">

                <div class="card-body row">
                  <div class="col-lg-3">
                    <div class="row align-items-center">
                      <div class="col-lg-4" style="padding: 0;">
                        <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="100%" height="auto" />
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
                        <h5>
                          <?php echo
                          date('h:i A', strtotime($flight['departure']));
                          ?>
                        </h5>
                        <h5>
                          <?php
                          echo $ap->getCode($flight['source']);
                          ?>
                        </h5>
                      </div>
                      <div class="col-lg-4">
                        <img src="<?php echo ROOT_URL; ?>../public/images/arrow2.png" width="100%" height="auto" />
                      </div>
                      <div class="col-lg-4">
                        <h5>
                          <?php echo
                          date('h:i A', strtotime($flight['arrival']));
                          ?>
                        </h5>
                        <h5>
                          <?php
                          echo $ap->getCode($flight['destination']);
                          ?>
                        </h5>
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
                  <div class="accordion mt-1" id="accordionExample<?php echo $count ?>">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne<?php echo $count ?>">
                        <button class="accordion-button collapsed  text-end" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $count ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $count ?>">
                          Details
                        </button>
                      </h2>
                      <div id="collapseOne<?php echo $count ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo $count ?>" data-bs-parent="#accordionExample<?php echo $count ?>">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <button class="btn btn-primary">
                                <?php
                                echo $ap->getCode($flight['source']);
                                echo " - ";
                                echo $ap->getCode($flight['destination']);
                                ?>
                              </button>
                              <div class="row">
                                <div class="col-lg-8">
                                  <div class="row text-start align-items-center">
                                    <div class="col-lg-4">
                                      <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="100%" />
                                    </div>
                                    <div class="col-lg-8">
                                      <p>
                                        <?php
                                        echo $flight['airline'];
                                        ?>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-4 text-end">
                                  Economy
                                </div>
                                <hr>

                              </div>
                            </div>

                            <div class="col-lg-6">
                              <ul class="nav nav-pills mb-3" id="pills-tab<?php echo $count ?>" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-baggage-tab<?php echo $count ?>" data-bs-toggle="pill" data-bs-target="#pills-baggage<?php echo $count ?>" type="button" role="tab" aria-controls="pills-baggage<?php echo $count ?>" aria-selected="true">Baggage</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-fare-tab<?php echo $count ?>" data-bs-toggle="pill" data-bs-target="#pills-fare<?php echo $count ?>" type="button" role="tab" aria-controls="pills-fare<?php echo $count ?>" aria-selected="false">Fare</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-policy-tab<?php echo $count ?>" data-bs-toggle="pill" data-bs-target="#pills-policy<?php echo $count ?>" type="button" role="tab" aria-controls="pills-policy<?php echo $count ?>" aria-selected="false">Policy</button>
                                </li>
                              </ul>
                              <div class="tab-content" id="pills-tabContent<?php echo $count ?>">
                                <div class="tab-pane fade show active" id="pills-baggage<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-baggage-tab<?php echo $count ?>" tabindex="0">
                                  Baggage
                                </div>
                                <div class="tab-pane fade" id="pills-fare<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-fare-tab<?php echo $count ?>" tabindex="0">Fare</div>
                                <div class="tab-pane fade" id="pills-policy<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-policy-tab<?php echo $count ?>" tabindex="0">Policy</div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="card-footer text-body-secondary text-end">
                  details
                </div> -->
              </div>

          <?php
              $count++;
            }
          }
          ?>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="card mt-4 ">
          <div class="card-header">
            Need Help
          </div>

          <ul class="list-group list-group-flush">
            <li class="list-group-item">Contact</li>
            <li class="list-group-item">Message</li>
            <li class="list-group-item">Email</li>
          </ul>
        </div>
      </div>
    </div>
  </div>



  <!-- footer -->
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
    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>
</body>


</html>