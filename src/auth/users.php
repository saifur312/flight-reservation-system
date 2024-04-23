<?php

/**
 * include config.php and database.php file 
 */

// include '/../../config.php';
// include '/../db/database.php';

/* if include not working then do this */
require(__DIR__ . '/../inc/header.php');
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../db/database.php');

/* show content iff the user is logged in only */
//Session::checkSession();

?>



<?php
/** 
 * create an obj of Database class to access its members
 *  and store it into variable $db 
 */
$db = new Database();

/** 
 * write query that we want to execute here we write select query 
 */
$query = 'SELECT * FROM user';

/** 
 * call read() method to execute query and stores the result into var
 */
$data = $db->select($query);
//echo "<h3> $data </h3>";
?>

<?php
/* if ($data) {
  while ($row = $data->fetch_assoc()) {
    echo $row['id'];
    echo $row['username'];
    echo $row['password'];
    echo $row['role'];
  }
} else echo "<h3 style='color: red'> No data available in the table..!! <br> Insert data into table </h3>"; */

?>

<!-- 
  write some html code to show table 
-->

<head>
  <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
</head>

<body>
  <div class="main-container d-flex">
    <?php
    include_once "../inc/sidebar.php";
    ?>
    <div class="content text-center">
      <?php
      include_once "../inc/navbar.php";
      ?>

      <div class="dashboard-content px-3 pt-4">
        <h2 class="fs-5">Users</h2>

        <!-- <section>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">SL</th>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Password</th>
                <th scope="col">Role</th>
                <th scope="col" colspan="2">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // if ($data) {
              // $count = 1;
              // while ($row = $data->fetch_assoc()) {
              ?>
                  <tr>
                    <th>
                      <?php
                      // echo $count;
                      ?>
                    </th>
                    <th> <?php echo $row['id']; ?> </th>
                    <td> <?php echo $row['username']; ?> </td>
                    <td> <?php echo $row['password']; ?> </td>
                    <td> <?php echo $row['role']; ?> </td>
                    <td> <a href="update.php?id=<?php echo urlencode($row['id']); ?>">
                        Edit</td>
                    <td> <a href="update.php?id=<?php echo urlencode($row['id']); ?>">
                        Delete</td>
                  </tr>
              <?php
              //     $count++;
              //   }
              // }
              ?>
            </tbody>
          </table>
        </section> -->

        <div id="userTable"></div>

      </div>
    </div>
  </div>

  <?php
  // Fetch your data
  $rows = [];
  while ($row = $data->fetch_assoc()) {
    //var_dump($row);
    $rows[] = [
      htmlspecialchars($row['id']),
      htmlspecialchars($row['username']),
      htmlspecialchars($row['password']),
      htmlspecialchars($row['role']),
      "<a href='update.php?id=" . urlencode($row['id']) . "'> <i class='bi bi-pen-fill' style='color:orange'></i></a>",
      "<a href='delete.php?id=" . urlencode($row['id']) . "'><i class='bi bi-trash3-fill' style='color:red'></i></a>"
    ];
  }

  //var_dump($rows);
  ?>


  <?php
  include_once "../inc/footer-scripts.php";
  ?>

  <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>

  <script>
    // Pass PHP array to JavaScript
    var rowData = <?php echo json_encode($rows); ?>;

    new gridjs.Grid({
      // columns: ["ID", "Username", "Password", "Role", "Edit", "Delete"],
      columns: ["ID", "Username", "Password", "Role",
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
    }).render(document.getElementById("userTable"));
  </script>


</body>

</html>