/**
 * Price range slider
// Initialize the noUiSlider
 */
var priceSlider = document.getElementById('price-slider-round');

noUiSlider.create(priceSlider, {
  // start: [12998, 32998], // Starting values for the handles
  // connect: true, // Display a colored bar between the handles
  // range: {
  //   'min': 0,
  //   'max': 50000
  // }
  start: [2500, 35000], // Starting values for the handles
  connect: true, // Display a colored bar between the handles
  range: {
    min: 2500,
    max: 35000,
  },
  step: 100,
});

// Update the label when the slider value changes
priceSlider.noUiSlider.on('update', function (values, handle) {
  var value = values[handle];

  if (handle) {
    // if it's the upper handle
    document.getElementById('price-upper').innerHTML = `BDT ${parseFloat(
      value
    ).toLocaleString()}`;
    document.getElementById('maxPrice').value = `${parseFloat(value)}`;
  } else {
    // if it's the lower handle
    document.getElementById('price-lower').innerHTML = `BDT ${parseFloat(
      value
    ).toLocaleString()}`;
    document.getElementById('minPrice').value = `${parseFloat(value)}`;
  }
});

//price slider 2
var priceSlider2 = document.getElementById('price-slider-round2');
noUiSlider.create(priceSlider2, {
  start: [2500, 35000],
  connect: true,
  range: {
    min: 2500,
    max: 35000,
  },
  step: 100,
});

priceSlider2.noUiSlider.on('update', function (values, handle) {
  var value = values[handle];

  if (handle) {
    // if it's the upper handle
    document.getElementById('price-upper').innerHTML = `BDT ${parseFloat(
      value
    ).toLocaleString()}`;
    document.getElementById('maxPrice').value = `${parseFloat(value)}`;
  } else {
    // if it's the lower handle
    document.getElementById('price-lower').innerHTML = `BDT ${parseFloat(
      value
    ).toLocaleString()}`;
    document.getElementById('minPrice').value = `${parseFloat(value)}`;
  }
});

//price slider 3
var priceSlider3 = document.getElementById('price-slider-round3');
noUiSlider.create(priceSlider3, {
  start: [2500, 35000],
  connect: true,
  range: {
    min: 2500,
    max: 35000,
  },
  step: 100,
});

priceSlider3.noUiSlider.on('update', function (values, handle) {
  var value = values[handle];

  if (handle) {
    // if it's the upper handle
    document.getElementById('price-upper').innerHTML = `BDT ${parseFloat(
      value
    ).toLocaleString()}`;
    document.getElementById('maxPrice').value = `${parseFloat(value)}`;
  } else {
    // if it's the lower handle
    document.getElementById('price-lower').innerHTML = `BDT ${parseFloat(
      value
    ).toLocaleString()}`;
    document.getElementById('minPrice').value = `${parseFloat(value)}`;
  }
});

/**
 * countdown timer
 */
var totalSeconds = 30 * 60; // 30 minutes in seconds
var timerInterval = setInterval(function () {
  totalSeconds -= 1;
  var minutes = Math.floor(totalSeconds / 60);
  var seconds = totalSeconds % 60;
  document.getElementById('time').textContent =
    minutes.toString().padStart(2, '0') +
    ':' +
    seconds.toString().padStart(2, '0');

  if (totalSeconds <= 0) {
    clearInterval(timerInterval);
    document.body.classList.add('modal-open'); // Add class to body to simulate the modal background
    var myModal = new bootstrap.Modal(document.getElementById('timeoutModal'));
    myModal.show();
  }
}, 1000); // Run the function every 1 second

// $(document).ready(function() {
//   $("#fastestFlights").click(function() {
//     $(this).removeClass('btn-light');
//     $(this).addClass('btn-info');
//   });
// });

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
