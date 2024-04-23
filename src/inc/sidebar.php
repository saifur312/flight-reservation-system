<div class="sidebar" id="side_nav">
  <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
    <h1 class="fs-4">
      <span class="bg-white text-dark rounded shadow px-2 me-2">
        <img src="<?php echo ROOT_URL; ?>../public/images/logo.png" class="logo-brand" />
      </span>
      <span class="text-white">ARS</span>
    </h1>
    <button class="btn d-md-none d-block close-btn px-1 py-0 text-white">
      <i class="fal fa-stream"></i>
    </button>
  </div>

  <ul class="list-unstyled px-2">
    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php') ? 'active' : ''; ?>">
      <a href="<?php echo ROOT_URL; ?>admin.php" class="text-decoration-none px-3 py-2 d-block">
        <i class="fal fa-home"></i> Dashboard
      </a>
    </li>
    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'users.php') ? 'active' : ''; ?>">
      <a href="<?php echo ROOT_URL; ?>auth/users.php" class="text-decoration-none px-3 py-2 d-block">
        <i class="bi bi-people-fill"></i> Users</a>
    </li>
    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'airports.php') ? 'active' : ''; ?>">
      <a href="<?php echo ROOT_URL; ?>setup/airport/airports.php" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-buildings"></i> Airports</a>
    </li>
    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'airlines.php') ? 'active' : ''; ?>">
      <a href="<?php echo ROOT_URL; ?>setup/airline/airlines.php" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-airplane-engines-fill"></i> Airlines</a>
    </li>
    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'flights.php') ? 'active' : ''; ?>">
      <a href="<?php echo ROOT_URL; ?>setup/flight/flights.php" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-airplane-fill"></i> Flights</a>
    </li>
    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'tickets.php') ? 'active' : ''; ?>">
      <a href="<?php echo ROOT_URL; ?>setup/ticket/tickets.php" class="text-decoration-none px-3 py-2 d-block"><i class="bi bi-ticket-fill"></i> Tickets</a>
    </li>
  </ul>
  <hr class="h-color mx-2" />

  <ul class="list-unstyled px-2">
    <li class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
      <a href="<?php echo ROOT_URL; ?>index.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i> View As Visitors</a>
    </li>
  </ul>
</div>