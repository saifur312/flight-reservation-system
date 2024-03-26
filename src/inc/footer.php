<!-- <h3> This is footer</h3> -->
<?php
include_once __DIR__ . '../../../config.php';
?>
<!-- Bootstrap js  -->
<script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/popper.min.js"></script>
<script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
<!-- <script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script> -->

<script>
  var alertList = document.querySelectorAll('.alert')
  alertList.forEach(function(alert) {
    new bootstrap.Alert(alert)
  })
</script>
</body>

</html>