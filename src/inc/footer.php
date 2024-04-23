<footer class="mt-4">
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


<?php
include_once 'footer-scripts.php';
?>


<script>
  // $(document).ready(function() {
  //   $('.select2').select2();
  // });

  $(document).ready(function() {

    // select2
    //$('.select2').select2();

    // function updateMinPriceValue(value) {
    //   var minPriceLabel = document.getElementById('minPriceLabel');
    //   var maxPrice = document.getElementById('maxPrice').value;

    //   // Prevent the min price from being greater than the max price
    //   if (parseInt(value) > parseInt(maxPrice)) {
    //     value = maxPrice;
    //     document.getElementById('minPrice').value = maxPrice;
    //   }

    //   minPriceLabel.textContent = `BDT ${parseInt(value).toLocaleString()}`;
    // }

    // function updateMaxPriceValue(value) {
    //   var maxPriceLabel = document.getElementById('maxPriceLabel');
    //   var minPrice = document.getElementById('minPrice').value;

    //   // Prevent the max price from being less than the min price
    //   if (parseInt(value) < parseInt(minPrice)) {
    //     value = minPrice;
    //     document.getElementById('maxPrice').value = minPrice;
    //   }

    //   maxPriceLabel.textContent = `BDT ${parseInt(value).toLocaleString()}`;
    // }

    // // Initialize default values
    // updateMinPriceValue(document.getElementById('minPrice').value);
    // updateMaxPriceValue(document.getElementById('maxPrice').value);


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