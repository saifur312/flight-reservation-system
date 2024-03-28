<!-- <h3> This is footer</h3> -->
<?php
include_once __DIR__ . '../../../config.php';
?>
<!-- jquery js -->
<script src="<?php echo ROOT_URL; ?>libs/jquery/jquery-3.7.1.js"></script>
<!-- Popperjs -->
<script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/popper.min.js"></script>
<!-- Bootstrap js  -->
<script src="<?php echo ROOT_URL; ?>libs/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
<!-- select2 js -->
<script src="<?php echo ROOT_URL; ?>libs/select2/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });



  // var alertList = document.querySelectorAll('.alert')
  // alertList.forEach(function(alert) {
  //   new bootstrap.Alert(alert)
  // })
</script>
</body>


</html>