<?php

include_once __DIR__ . '../../config.php';

/* declare root_url as var to use it inside heredoc syntax; */
$root_url = ROOT_URL;

include "./service/Airport.php";
include "./service/Airline.php";
include "./service/Flight.php";

$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$showflights = false;

?>

<?php include "./inc/header.php"; ?>

<style>
  .navbar {
    background-color: #c5ecfb;
  }
</style>

<body class="text-center">
  <section class="section text-center">
    <!-- navbar -->
    <div class="container">
      <?php include "./inc/navbar.php"; ?>
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

    <!-- Special Offers -->
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



  <?php include "./inc/footer.php" ?>


</body>

</html>