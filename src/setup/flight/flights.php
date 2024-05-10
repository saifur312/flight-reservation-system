<?php
require('../../inc/header.php');
include __DIR__ . "/../../service/Flight.php";

$flight = new Flight();
$flights = $flight->fetchFlights();

// $flights = $flight->filterFlights(
//   'Sylhet Intl. Airport',
//   'Chittagong Int. Airport',
//   '2024-03-30',
//   '2024-04-01'
// );

//print_r($flights->fetch_assoc());

?>

<head>
  <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
</head>

<body>
  <div class="main-container d-flex">
    <?php
    include_once "../../inc/sidebar.php";
    ?>
    <div class="content text-center">
      <?php
      include_once "../../inc/navbar.php";
      ?>

      <div class="dashboard-content px-3 pt-4">
        <h2 class="fs-5">All Flights</h2>

        <section class="mt-4 mb-4 pb-4">

          <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/flight/add-flight.php">Add New Flight</a>

          <div id="flightsTable"></div>
        </section>
      </div>
    </div>
  </div>

  <?php
  // Fetch your data
  $rows = [];
  while ($row = $flights->fetch_assoc()) {
    $editLink = "<a href='update-flight.php?id=" . urlencode($row['id']) . "'> <i class='bi bi-pen-fill' style='color:orange'></i></a>";
    $deleteLink = "<a href='#'><i class='bi bi-trash3-fill' style='color:red'></i></a>";

    //var_dump($row);
    $rows[] = [
      htmlspecialchars($row['id']),
      htmlspecialchars($row['source']),
      htmlspecialchars($row['destination']),
      htmlspecialchars(date('Y-m-d h:i A', strtotime($row['departure']))),
      htmlspecialchars(date('Y-m-d h:i A', strtotime($row['arrival']))),
      htmlspecialchars($row['class']),
      htmlspecialchars($row['price']),
      htmlspecialchars($row['airline']),
      $editLink . ' ' . $deleteLink  // Concatenate Edit and Delete links
      // "<a href='update-flight.php?id=" . urlencode($row['id']) . "'> <i class='bi bi-pen-fill' style='color:orange'></i></a>",
      // "<a href='#'><i class='bi bi-trash3-fill' style='color:red'></i></a>"
    ];
  }

  //var_dump($rows);
  ?>

  <?php
  include_once "../../inc/footer-scripts.php";
  ?>

  <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>

  <script>
    // Pass PHP array to JavaScript
    var rowData = <?php echo json_encode($rows); ?>;

    new gridjs.Grid({
      columns: ["ID", "From", "To", "Departure", "Arrival", "Class", "Price", "Airline", 
        {
          name: "Actions",
          formatter: (cell) => gridjs.html(cell) // Parse HTML content for combined actions
        }
        // {
        //   name: "Edit",
        //   formatter: (cell) => gridjs.html(cell) // Use the html formatter to parse HTML content
        // },
        // {
        //   name: "Delete",
        //   formatter: (cell) => gridjs.html(cell) // Use the html formatter to parse HTML content
        // }
      ],
      data: rowData,
      search: true,
      sort: true,
      resizable: true,
      pagination: {
        limit: 5
      }
    }).render(document.getElementById("flightsTable"));
  </script>
</body>

</html>