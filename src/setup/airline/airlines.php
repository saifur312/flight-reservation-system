<?php
require('../../inc/header.php');


?>

<section class="mt-4">

  <a class='btn btn-outline-primary' href="<?php echo ROOT_URL; ?>setup/airline/add-airline.php">Add New</a>
  <table class="table mt-4">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Code</th>
        <th scope="col">Country</th>
        <th scope="col">City</th>
        <th scope="col" colspan="2">Actions</th>
      </tr>
    </thead>
  </table>
</section>

<?php
require('../../inc/footer.php');
?>