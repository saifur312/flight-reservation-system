<?php
require('../../inc/header.php');
include __DIR__ . "/../../service/Airport.php";

$airport = new Airport();
$airports = $airport->fetchAirports();

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
        <h2 class="fs-5">All Airports</h2>



        <div id="airportTable"></div>
      </div>
    </div>
  </div>

  <?php
  // Fetch your data
  $rows = [];
  while ($row = $airports->fetch_assoc()) {
    //var_dump($row);
    $rows[] = [
      htmlspecialchars($row['id']),
      htmlspecialchars($row['name']),
      htmlspecialchars($row['code']),
      htmlspecialchars($row['country']),
      htmlspecialchars($row['city']),
      htmlspecialchars($row['contact']),
      "<a href='update-airport.php?id=" . urlencode($row['id']) . "'> <i class='bi bi-pen-fill' style='color:orange'></i></a>",
      "<a href='#'><i class='bi bi-trash3-fill' style='color:red'></i></a>"
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
      columns: ["ID", "Name", "Code", "City", "Country", "Contact",
        {
          name: "Edit",
          formatter: (cell) => gridjs.html(cell) // Use the html formatter to parse HTML content
        },
        {
          name: "Delete",
          formatter: (cell) => gridjs.html(cell) // Use the html formatter to parse HTML content
        }
      ],
      data: rowData,
      search: true,
      sort: true,
      resizable: true,
      pagination: {
        limit: 5
      }
    }).render(document.getElementById("airportTable"));
  </script>
</body>

</html>