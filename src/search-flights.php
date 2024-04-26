<?php

include_once __DIR__ . '../../config.php';
include "./inc/header.php";
include "./service/Airport.php";
include "./service/Airline.php";
include "./service/Flight.php";


$ap = new Airport();
$airports = $ap->fetchAirports();

$al = new Airline();
$airlines = $al->fetchAirlines();

$showflights = false;
$rowCount = 0;
$filter = false;

$flight = new Flight();

if (isset($_GET['source'])) {
  // Retrieve the data from the query string
  $src = $_GET['source'];
  $dst = $_GET['destination'];
  $dep = $_GET['departure'];
  $arv = $_GET['arrival'];
  $fastest = false;
  if (isset($_GET['fastest'])) {
    //echo "Fastest " . $_GET['fastest'];
    $fastest = $_GET['fastest'];
    //echo "Fastest var " . $fastest;
  }

  $filter = false;
  //echo "$src + $dst + $dep + $arv";
  $flights = $flight->filterFlights($src, $dst, $dep, $arv, urlencode($fastest));

  if ($flights) {
    $showflights = true;
    $rowCount = $flights->num_rows;
  } else {
    $showflights = false;
    $rowCount = 0;
  }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
  //print_r($_POST);
  // $flights = $flight->filterFlights(
  //   $_POST['source'],
  //   $_POST['destination'],
  //   $_POST['departure'],
  //   $_POST['arrival']
  // );

  // if ($flights)
  //   $showflights = true;
  // else
  //   $showflights = false;

  // header('Location: search-flights.php?source=' + $_POST['source'] + '&destination=' + $_POST['destination'] + '&departure=' + $_POST['departure'] + '&arrival=' + $_POST['arrival']);

  header('Location: search-flights.php?source=' . urlencode($_POST['source']) . '&destination=' . urlencode($_POST['destination']) . '&departure=' . urlencode($_POST['departure']) . '&arrival=' . urlencode($_POST['arrival']));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['filter'])) {
  //print_r($_POST['minPrice']);
  $filter = true;

  $flights = $flight->filterFlights(
    $_POST['source'],
    $_POST['destination'],
    $_POST['departure'],
    $_POST['arrival'],
    false, //fastest
    $_POST['minPrice'],
    $_POST['maxPrice'],
    $_POST['airline']
  );

  if ($flights) {
    //print_r($flights);
    // print_r($flights->fetch_assoc());
    $rowCount = $flights->num_rows;
    $showflights = true;
    //$filter = true;

    // while ($flight = $flights->fetch_assoc()) {
    //   print_r($flight);
    // }
    //print_r($rowCount);
  } else {
    $showflights = false;
    //$filter = false;
    $rowCount = 0;
  }

  //$showflights = true;
  //header("Location: search-flights.php");
}

?>


<style>
  .filter-bar {
    min-height: 40px;
    background-color: #ffffff;
  }

  .dual-range-slider {
    position: relative;
  }

  .price-range-labels {
    display: flex;
    justify-content: space-between;
    padding-top: 10px;
    /* Adjust as needed */
  }

  .min-price,
  .max-price {
    font-size: 0.875rem;
  }

  /* noUi slider */
  .slider-container {
    position: relative;
  }

  .price-range-labels {
    display: flex;
    justify-content: space-between;
    padding-top: 10px;
  }

  #price-lower,
  #price-upper {
    font-size: 0.875rem;
  }

  #price-slider-round,
  #price-slider-round2,
  #price-slider-round3 {
    height: 10px;
  }

  #price-slider-round .noUi-connect,
  #price-slider-round2 .noUi-connect,
  #price-slider-round3 .noUi-connect {
    background: blue;
  }

  #price-slider-round .noUi-handle,
  #price-slider-round2 .noUi-handle,
  #price-slider-round3 .noUi-handle {
    height: 18px;
    width: 18px;
    top: -5px;
    right: -9px;
    border-radius: 9px;
  }

  p {
    font-size: 0.9rem;
    margin-bottom: 8px;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link {
    color: #000;
    background-color: #b0caf1;
  }

  .nav-pills .nav-link {
    border-radius: 0;
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
              <!-- <a class="btn btn-lg btn-warning" href=""> Modify Search</a> -->
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- filter-bar -->
  <div class="container filter-bar mt-2">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li style="width: 20%;" class="pt-2">
        <strong> <i class="bi bi-funnel-fill"></i> Filters </strong>
      </li>
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
      <?php if ($rowCount >= 0) {
        echo <<<HTML
                  <li style="width: 20%;" class="pt-2">
                    <strong> Showing $rowCount Results </Strong>
                  </li>
                HTML;
        if ($filter) {
          // Construct the URL
          $removeFilterUrl = "search-flights.php?source=$src&destination=$dst&departure=$dep&arrival=$arv";

          echo <<<HTML
                  <li class="pt-2">
                    <a class="btn btn-sm btn-info text-start" href="$removeFilterUrl">
                      Remove Filter
                    </a>
                  </li>
                HTML;
        }
      }
      ?>

    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="empty-tab-pane" role="tabpanel" aria-labelledby="empty-tab" tabindex="0">
      </div>

      <div class="tab-pane fade" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
        <!-- <div class="row text-start pt-2">
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

        </div> -->
        <div class="pt-4 pb-4">
          <form id="filter-form" class="row " action="" method="post">
            <input type="hidden" id="source" name="source" value="<?php echo $src ?>">
            <input type="hidden" id="destination" name="destination" value="<?php echo $dst ?>">
            <input type="hidden" id="departure" name="departure" value="<?php echo $dep ?>">
            <input type="hidden" id="arrival" name="arrival" value="<?php echo $arv ?>">

            <div class="col-lg-4 text-start">
              <div class="col-lg-12">
                <div>
                  <b> Fare Type </b>
                </div>
                <div class="form-check form-switch pt-2">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Partially Refundable</label>
                </div>
              </div>

              <div class="col-lg-12 pt-2">
                <label for="priceRange" class="form-label"><b>Price Range</b></label>
                <div class="slider-container">
                  <!-- <div id="price-slider"></div> -->
                  <div class="slider-styled" id="price-slider-round"></div>
                  <div class="price-range-labels">
                    <div id="price-lower"></div>
                    <div id="price-upper"></div>
                  </div>
                </div>
                <input type="hidden" id="minPrice" name="minPrice" value="2500">
                <input type="hidden" id="maxPrice" name="maxPrice" value="35000">
              </div>
            </div>

            <div class="col-lg-4">
              <div class="col-lg-12">
                <div>
                  <b> Airlines </b>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Biman Bangladesh Airlines" id="airline1" name="airline[]">
                  <label class="form-check-label col-lg-9" for="airline1">
                    Biman Bangladesh Airlines
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="US Bangla" id="airline2" name="airline[]">
                  <label class=" form-check-label" for="airline2">
                    US Bangla
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Dubai Airways" id="airline3" name="airline[]">
                  <label class=" form-check-label" for="airline3">
                    Dubai Airways
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Qatar Airways" id="airline4" name="airline[]">
                  <label class=" form-check-label" for="airline4">
                    Qatar Airways
                  </label>
                </div>

              </div>
            </div>

            <div class="col-lg-4 ">
              <input type="submit" class="btn btn-lg btn-warning" name="filter" value="Apply Filter" />
            </div>
          </form>
        </div>
      </div>

      <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <div class="pt-4 pb-4">
          <form id="filter-form" class="row " action="" method="post">
            <input type="hidden" id="source" name="source" value="<?php echo $src ?>">
            <input type="hidden" id="destination" name="destination" value="<?php echo $dst ?>">
            <input type="hidden" id="departure" name="departure" value="<?php echo $dep ?>">
            <input type="hidden" id="arrival" name="arrival" value="<?php echo $arv ?>">

            <div class="col-lg-4 text-start">
              <div class="col-lg-12">
                <div>
                  <b> Fare Type </b>
                </div>
                <div class="form-check form-switch pt-2">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Partially Refundable</label>
                </div>
              </div>

              <div class="col-lg-12 pt-2">
                <label for="priceRange" class="form-label"><b>Price Range</b></label>
                <div class="slider-container">
                  <!-- <div id="price-slider"></div> -->
                  <div class="slider-styled" id="price-slider-round2"></div>
                  <div class="price-range-labels">
                    <div id="price-lower"></div>
                    <div id="price-upper"></div>
                  </div>
                </div>
                <input type="hidden" id="minPrice" name="minPrice" value="2500">
                <input type="hidden" id="maxPrice" name="maxPrice" value="35000">
              </div>
            </div>

            <div class="col-lg-4">
              <div class="col-lg-12">
                <div>
                  <b> Airlines </b>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Biman Bangladesh Airlines" id="airline1" name="airline[]">
                  <label class="form-check-label col-lg-9" for="airline1">
                    Biman Bangladesh Airlines
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="US Bangla" id="airline2" name="airline[]">
                  <label class=" form-check-label" for="airline2">
                    US Bangla
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Dubai Airways" id="airline3" name="airline[]">
                  <label class=" form-check-label" for="airline3">
                    Dubai Airways
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Qatar Airways" id="airline4" name="airline[]">
                  <label class=" form-check-label" for="airline4">
                    Qatar Airways
                  </label>
                </div>

              </div>
            </div>

            <div class="col-lg-4 ">
              <input type="submit" class="btn btn-lg btn-warning" name="filter" value="Apply Filter" />
            </div>
          </form>
        </div>
      </div>

      <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
        <div class="pt-4 pb-4">
          <form id="filter-form" class="row " action="" method="post">
            <input type="hidden" id="source" name="source" value="<?php echo $src ?>">
            <input type="hidden" id="destination" name="destination" value="<?php echo $dst ?>">
            <input type="hidden" id="departure" name="departure" value="<?php echo $dep ?>">
            <input type="hidden" id="arrival" name="arrival" value="<?php echo $arv ?>">

            <div class="col-lg-4 text-start">
              <div class="col-lg-12">
                <div>
                  <b> Fare Type </b>
                </div>
                <div class="form-check form-switch pt-2">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Partially Refundable</label>
                </div>
              </div>

              <div class="col-lg-12 pt-2">
                <label for="priceRange" class="form-label"><b>Price Range</b></label>
                <div class="slider-container">
                  <!-- <div id="price-slider"></div> -->
                  <div class="slider-styled" id="price-slider-round3"></div>
                  <div class="price-range-labels">
                    <div id="price-lower"></div>
                    <div id="price-upper"></div>
                  </div>
                </div>
                <input type="hidden" id="minPrice" name="minPrice" value="2500">
                <input type="hidden" id="maxPrice" name="maxPrice" value="35000">
              </div>
            </div>

            <div class="col-lg-4">
              <div class="col-lg-12">
                <div>
                  <b> Airlines </b>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Biman Bangladesh Airlines" id="airline1" name="airline[]">
                  <label class="form-check-label col-lg-9" for="airline1">
                    Biman Bangladesh Airlines
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="US Bangla" id="airline2" name="airline[]">
                  <label class=" form-check-label" for="airline2">
                    US Bangla
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Dubai Airways" id="airline3" name="airline[]">
                  <label class=" form-check-label" for="airline3">
                    Dubai Airways
                  </label>
                </div>
                <div class="form-check text-start">
                  <input class="form-check-input" type="checkbox" value="Qatar Airways" id="airline4" name="airline[]">
                  <label class=" form-check-label" for="airline4">
                    Qatar Airways
                  </label>
                </div>

              </div>
            </div>

            <div class="col-lg-4 ">
              <input type="submit" class="btn btn-lg btn-warning" name="filter" value="Apply Filter" />
            </div>
          </form>
        </div>
        <!-- <div class="row text-start pt-2">
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
              <label for="priceRange" class="form-label"><b>Price Range</b></label>
              <div class="dual-range-slider">
                <input type="range" class="form-range" id="minPrice" name="minPrice" min="0" max="50000" oninput="updateMinPriceValue(this.value);">
                <input type="range" class="form-range" id="maxPrice" name="maxPrice" min="0" max="50000" oninput="updateMaxPriceValue(this.value);">
                <div class="price-range-labels">
                  <div class="min-price" id="minPriceLabel">BDT 12,998</div>
                  <div class="max-price" id="maxPriceLabel">BDT 32,998</div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-3">
            <div class="col-lg-12">
              <div>
                <b> Airlines </b>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Biman Bangladesh Airlines" id="flexCheckDefault1">
                <label class="form-check-label" for="flexCheckDefault1">
                  Biman Bangladesh Airlines
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="US Bangla" id="flexCheckDefault2">
                <label class="form-check-label" for="flexCheckDefault2">
                  US Bangla
                </label>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>

  <!-- Flights -->
  <div class="container justify-content-center mt-4 mb-4">
    <div class="row ">
      <div class="col-lg-9">
        <div class="row ">
          <div class="col-lg-12 filter-bar">
            <div class="row pt-1">
              <div class="col-lg-6" style="border-right: solid thin #eeeeee">
                <?php
                // Construct the URL
                $url = "search-flights.php?source=$src&destination=$dst&departure=$dep&arrival=$arv";
                ?>
                <a class="col-lg-12 btn btn-sm btn-light text-start" href="<?php echo $url; ?>">
                  <b> Cheapest</b>
                  <p> Showing the cheapest flights in ascending order
                    <i class="bi bi-sort-down-alt"></i>
                  </p>
                </a>
              </div>
              <!-- <div class="vr" style="padding: 0;"></div> -->
              <div class="col-lg-6">
                <?php
                // Construct the URL
                $url = "search-flights.php?source=$src&destination=$dst&departure=$dep&arrival=$arv&fastest=true";
                ?>
                <a id="fastestFlights" class="col-lg-12 btn btn-sm btn-light text-start" href="<?php echo $url; ?>">
                  <b> Fastest</b>
                  <p> Click to see the fastest flights in ascending order
                    <i class="bi bi-sort-up-alt"></i>
                  </p>
                </a>
                <!-- 'Location: search-flights.php?source=' . urlencode($_POST['source']) . '&destination=' . urlencode($_POST['destination']) . '&departure=' . urlencode($_POST['departure']) . '&arrival=' . urlencode($_POST['arrival']) -->
              </div>
            </div>
          </div>
          <!-- show flights -->
          <?php
          if ($showflights) {
            $count = 1;
            while ($flight = $flights->fetch_assoc()) {
          ?>
              <div class=" card col-lg-12 text-center mt-4 " style=" min-height: 25vh;">
                <div class="card-body row pt-4">
                  <div class="col-lg-3">
                    <div class="row align-items-center">
                      <div class="col-lg-3" style="padding: 0;">
                        <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="100%" height="auto" />
                      </div>
                      <p class="col-lg-8">
                        <?php
                        echo $flight['airline'];
                        ?>
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-7">
                    <div class="row">
                      <div class="col-lg-3">
                        <p>
                          <?php echo
                          date('h:i A', strtotime($flight['departure']));
                          ?>
                        </p>
                        <p>
                          <?php
                          echo $ap->getCode($flight['source']);
                          ?>
                        </p>
                      </div>
                      <div class="col-lg-3">
                        <img src="<?php echo ROOT_URL; ?>../public/images/arrow2.png" width="100%" height="auto" />
                      </div>
                      <div class="col-lg-3">
                        <p>
                          <?php echo
                          date('h:i A', strtotime($flight['arrival']));
                          ?>
                        </p>
                        <p>
                          <?php
                          echo $ap->getCode($flight['destination']);
                          ?>
                        </p>
                      </div>
                      <div class="col-lg-3">
                        <p>
                          <?php
                          $duration = $flight['duration'];
                          // Calculate days, hours, and minutes
                          $days = intdiv($duration, 24 * 60);
                          $hours = intdiv($duration % (24 * 60), 60);
                          $minutes = $duration % 60;

                          echo $days . "d " . $hours . "h " . $minutes . "m";
                          ?>
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- Select Flight -->
                  <div class="col-lg-2 ">
                    <div class="row justify-content-center">
                      <p>
                        <?php echo "Flight  " . $flight['id'];
                        ?>
                      </p>
                      <h5 class="col-lg-12">
                        <?php echo "BDT  " . $flight['price'];
                        ?>
                      </h5>
                      <a href="booking.php?id=<?php echo $flight['id'] ?>" class="btn btn-sm btn-warning col-lg-12">Select
                        <span> <i class="bi bi-arrow-right"></i></span>
                      </a>
                    </div>
                  </div>
                  <!-- Flight Details -->
                  <div class="accordion mt-4" id="accordionExample<?php echo $count ?>">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne<?php echo $count ?>">
                        <button class="accordion-button collapsed  text-end" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $count ?>" aria-expanded="false" aria-controls="collapseOne<?php echo $count ?>">
                          Details
                        </button>
                      </h2>
                      <div id="collapseOne<?php echo $count ?>" class="accordion-collapse collapse" aria-labelledby="headingOne<?php echo $count ?>" data-bs-parent="#accordionExample<?php echo $count ?>">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-lg-6" style="border-right: solid thin #eeeeee;">
                              <p>
                                <?php
                                echo $ap->getCode($flight['source']);
                                echo " - ";
                                echo $ap->getCode($flight['destination']);
                                ?>
                              </p>
                              <div class="row align-items-center">
                                <div class="col-lg-8">
                                  <div class="row text-start align-items-center">
                                    <div class="col-lg-3">
                                      <img src="<?php echo ROOT_URL; ?>../public/images/airplane2.jpg" width="80%" />
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
                                  <p>Economy</p>
                                </div>
                              </div>

                              <hr />

                              <div class="row ">
                                <div class="col-lg-4 text-start">
                                  <p>
                                    <?php
                                    echo date('h:i A', strtotime($flight['departure']));
                                    echo "<br/>";
                                    echo date('l, d M, Y', strtotime($flight['departure']));
                                    echo "<br/>";
                                    echo $ap->getCode($flight['source']);
                                    ?>
                                  </p>
                                </div>
                                <div class="col-lg-4">
                                  <img src="../public/images/arrow-right.svg" style="width: 100px; height: 60%; opacity: .5" alt="Right Arrow">


                                </div>
                                <div class="col-lg-4 text-end">
                                  <p>
                                    <?php
                                    echo date('h:i A', strtotime($flight['arrival']));
                                    echo "<br/>";
                                    echo date('l, d M, Y', strtotime($flight['arrival']));
                                    echo "<br/>";
                                    echo $ap->getCode($flight['destination']);
                                    ?>
                                  </p>
                                </div>

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
                                  <table class="col-lg-12 table table-borderless">
                                    <tr>
                                      <th> Flight</th>
                                      <th> Cabin</th>
                                      <th> Check-in</th>
                                    </tr>
                                    <tr>
                                      <td>
                                        <p>
                                          <?php
                                          echo $ap->getCode($flight['source']);
                                          echo " - ";
                                          echo $ap->getCode($flight['destination']);
                                          ?>
                                        </p>
                                      </td>
                                      <td> 7 kg</td>
                                      <td> 20 kg</td>
                                    </tr>
                                  </table>

                                  <div class='row rounded-0 alert alert-primary show mt-4' role='alert'>
                                    <div class="col-md-6 text-start"> Total (1 Traveler)</div>
                                    <div class="col-md-6 text-end">
                                      <b>
                                        <?php
                                        $tax = $flight['price'] * 0.1;
                                        echo "BDT " . $flight['price'] + $tax;
                                        ?>
                                      </b>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pills-fare<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-fare-tab<?php echo $count ?>" tabindex="0">

                                  <table class="col-lg-12 table table-borderless">
                                    <tr>
                                      <th> Fare Summary</th>
                                      <th> Base Fare</th>
                                      <th> Tax</th>
                                    </tr>
                                    <tr>
                                      <td> Adult X 1 </td>
                                      <td>
                                        <?php
                                        echo $flight['price'];
                                        ?>
                                      </td>
                                      <td>
                                        <?php
                                        echo $flight['price'] * 0.1;
                                        /** 10% tax */
                                        ?>
                                      </td>
                                    </tr>
                                  </table>

                                  <div class='row rounded-0 alert alert-primary show mt-4'>
                                    <div class="col-md-6 text-start"> Total (1 Traveler)</div>
                                    <div class="col-md-6 text-end">
                                      <b>
                                        <?php
                                        $tax = $flight['price'] * 0.1;
                                        echo "BDT " . $flight['price'] + $tax;
                                        ?>
                                      </b>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pills-policy<?php echo $count ?>" role="tabpanel" aria-labelledby="pills-policy-tab<?php echo $count ?>" tabindex="0">
                                  <div class="d-block p-2 bg-info text-white">
                                    <?php
                                    echo $ap->getCode($flight['source']);
                                    echo " - ";
                                    echo $ap->getCode($flight['destination']);
                                    ?>
                                  </div>
                                  <div class='row text-start mt-4'>
                                    <p>Tax & Amount</p>
                                    <hr />
                                    <p> Tax = 10% of Base Fair </p>
                                    <p> Total Amount = Base Amount + Tax</p>
                                    <p> Cancellation</p>
                                    <hr />
                                    <p> Cancellation Fee = Airline's Fee + ARS Fee
                                      Refund Amount = Paid Amount - Cancellation Fee</p>
                                  </div>

                                  <div class='row rounded-0 alert alert-primary show mt-4'>
                                    <div class="col-md-6 text-start"> Total (1 Traveler)</div>
                                    <div class="col-md-6 text-end">
                                      <b>
                                        <?php
                                        $tax = $flight['price'] * 0.1;
                                        echo "BDT " . $flight['price'] + $tax;
                                        ?>
                                      </b>
                                    </div>
                                  </div>

                                </div>
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
          } else {
            echo <<<HTML
                <div class='alert alert-danger alert-dismissible fade show mt-4' role='alert'> 
              No flights Found..!! Plz search again.
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
              </button>
            </div>
HTML;
          }
          ?>
        </div>
      </div>

      <div class="col-lg-3">
        <div class="col-lg-12" style="background-color: #ffffff; padding: 12px;">
          <div id="timer" class="text-start" style="background-color: #ECF3FE; padding-left: 16px;">
            <i class="bi bi-clock-fill h2"></i>
            <span class="fs-1" id="time" style="padding-left: 16px;">
              30:00
            </span>
            <p style="padding-left: 70px; margin: 0px;"> min sec </p>
          </div>
        </div>

        <div class="card mt-4 ">
          <div class="card-header text-start" style="background-color: #0E70A4; color: #ffffff;">
            <h6> Need Help ?</h6>
          </div>

          <ul class="list-group list-group-flush text-start mt-4">
            <li class="list-group-item col-md-12" style="border: none">
              <span class="row align-items-center">
                <i class="bi bi-telephone-outbound-fill col-md-2 " style="font-size: 25px; color: orange;"></i>
                <h6 class="col-md-8"> +880-1643833992 </h6>
              </span>
            </li>
            <hr />
            <li class="list-group-item col-md-12" style="border: none">
              <span class="row align-items-center">
                <i class="bi bi-envelope-check col-md-2" style="font-size: 25px; color: orange;"></i>
                <h6 class="col-md-8"> admin@gamil.com </h6>
              </span>
            </li>
            <hr />
            <li class="list-group-item col-md-12" style="border: none">
              <span class="row align-items-center">
                <i class="bi bi-messenger col-md-2" style="font-size: 25px; color: orange;"></i>
                <h6 class="col-md-8"> m.me/admin </h6>
              </span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="timeoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #0E70A4; color: #ffffff">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">
            Session Expired
          </h1>
        </div>
        <div class="modal-body text-center">
          <h4><i class="bi bi-alarm-fill"></i></h4>
          <h3> Sorry, your session has expired</h3>
          <a href="index.php" class="btn btn-lg btn-primary mt-3">Search Again</a>
        </div>
      </div>
    </div>
  </div>


  <?php include "./inc/footer.php" ?>
  <!-- noUi slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>

  <!-- custom script -->
  <script src="libs/ars/search-flights.js"></script>

</body>

</html>