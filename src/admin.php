<?php

include_once __DIR__ . '../../config.php';

include_once "./inc/header.php";

?>

<body>
  <div class="main-container d-flex">
    <?php
    include_once "./inc/sidebar.php";
    ?>
    <div class="content text-center">
      <?php
      include_once "./inc/navbar.php";
      ?>

      <div class="dashboard-content px-3 pt-4">
        <h2 class="fs-5">Dashboard</h2>
        <h1> Welcome Admin</h1>
      </div>
    </div>
  </div>

  <?php
  include_once "./inc/footer.php";
  ?>
</body>

</html>