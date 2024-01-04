<?php
session_start();

require 'backend-php/db-credentials.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>FastDart Logistics</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
	<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
	<div class="background">
		<img src="assets/background-logistics.jpg" class="img-fluid" alt="background-image" style="width: 100vw; height: 100vh; object-fit: cover; filter: brightness(0.28); position: absolute">
	</div>

	<div class="container-lg">
		<div class="row position-absolute top-50 translate-middle-y">
			<div class="coloumn col-lg-12">
				<div class="card bg-transparent border-0">
					<div class="card-body p-1">
						<div class="display-4 text-white ">Making logistics simple <br> in a complicated world.
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-dark">
		<div class="container-lg">
			<a class="navbar-brand fs-1 fw-semibold" href="#">FastDart</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link active fs-4 fw-semibold" aria-current="page" href="index.php">Home &nbsp;
							&nbsp;</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active fs-4 fw-semibold" aria-current="page" href="about.php">About &nbsp;
							&nbsp;</a>
					</li>
					<li class="nav-item">
						<?php
						if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
							echo ('<a class="btn btn-outline-light fs-4 fw-semibold" href="login.php" role="button">Track your
							package</a>');
							exit;
						} else if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == true) {
							echo ('<a class="btn btn-outline-light fs-4 fw-semibold" href="track.php" role="button">Track your
							package</a>');
							exit;
						}

						?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</body>

</html>