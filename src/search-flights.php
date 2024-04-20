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

<?php include "./inc/header.php"; ?>

<style>
  .filter-bar {
    min-height: 40px;
    background-color: #ffffff;
  }
</style>

<body class="text-center">
  <section class="text-center">
    <!-- navbar -->
    <div id="navbar" class="container-fluid">
      <?php
      include "./inc/navbar.php";
      ?>
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
      <li>Filters</li>
      <li class="nav-item" role="presentation" style="display:none;">
        <button class="nav-link active" id="empty-tab" data-bs-toggle="tab" data-bs-target="#empty-tab-pane" type="button" role="tab" aria-controls="empty-tab-pane" aria-selected="true"></button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Price Range</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Airlines</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Airports</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="empty-tab-pane" role="tabpanel" aria-labelledby="empty-tab" tabindex="0"></div>
      <div class="tab-pane fade" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        <div class="row text-start pt-2">
          <div class="col-lg-3">
            <div class="col-lg-12">
              <div>
                <b> Fare Type </b>
              </div>
              <div class="form-check form-switch pt-2">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Partially Refundable</label>
              </div>
            </div>
            <div class="col-lg-12">
              <label for="customRange2" class="form-label"><b> Price Range </b></label>
              <input type="range" class="form-range" min="0" max="5" id="customRange2">
            </div>
          </div>
          <div class="col-lg-3">
            <div class="col-lg-12">
              <div>
                <b> Airlines </b>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                <label class="form-check-label" for="flexCheckDefault1">
                  Biman Bangladesh Airlines
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                <label class="form-check-label" for="flexCheckDefault2">
                  US Bangla
                </label>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <div class="row text-start pt-2">
          <div class="col-lg-3">
            <div class="col-lg-12">
              <div>
                <b> Fare Type </b>
              </div>
              <div class="form-check form-switch pt-2">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Partially Refundable</label>
              </div>
            </div>
            <div class="col-lg-12">
              <label for="customRange2" class="form-label"><b> Price Range </b></label>
              <input type="range" class="form-range" min="0" max="5" id="customRange2">
            </div>
          </div>
          <div class="col-lg-3">
            <div class="col-lg-12">
              <div>
                <b> Airlines </b>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                <label class="form-check-label" for="flexCheckDefault1">
                  Biman Bangladesh Airlines
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                <label class="form-check-label" for="flexCheckDefault2">
                  US Bangla
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
        <div class="row text-start pt-2">
          <div class="col-lg-3">
            <div class="col-lg-12">
              <div>
                <b> Fare Type </b>
              </div>
              <div class="form-check form-switch pt-2">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Partially Refundable</label>
              </div>
            </div>
            <div class="col-lg-12">
              <label for="customRange2" class="form-label"><b> Price Range </b></label>
              <input type="range" class="form-range" min="0" max="5" id="customRange2">
            </div>
          </div>
          <div class="col-lg-3">
            <div class="col-lg-12">
              <div>
                <b> Airlines </b>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                <label class="form-check-label" for="flexCheckDefault1">
                  Biman Bangladesh Airlines
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                <label class="form-check-label" for="flexCheckDefault2">
                  US Bangla
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Flights -->
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
                  <!-- Select Flight -->
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
                      <a href="booking.php?id=<?php echo $flight['id'] ?>" class="btn btn-warning col-lg-8">Select</a>
                    </div>
                  </div>
                  <!-- Flight Details -->
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
                            <!-- Baggage, Fare, Policy -->
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


  <?php include "./inc/footer.php" ?>

</body>

</html>