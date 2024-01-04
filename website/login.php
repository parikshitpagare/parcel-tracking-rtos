<?php
require 'backend-php/db-credentials.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>FastDart Logistics</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
	<div class="background">
		<img src="assets/background-logistics.jpg" class="img-fluid" alt="background-image" style="width: 100vw; height: 100vh; object-fit: cover; filter: brightness(0.28); position: absolute">
	</div>

	<nav class="navbar navbar-expand-lg navbar-dark">
		<div class="container">
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
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-lg text-center">
		<div class="row justify-content-center">
			<div class="coloumn">
				<?php
				if ($error) {
					echo ('<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Sorry!</strong> Incorrect username or password.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
				} else if (!$error) {
					echo ("");
				}
				?>
			</div>
		</div>
	</div>

	<div class=" container-lg text-center">
		<div class="row position-absolute top-50 start-50 translate-middle bg-white rounded p-3">
			<div class="coloumn">
				<form action="login.php" method="POST">
					<h1>
						<div class="text-muted">Login</div>
					</h1>
					<div class="input-group input-group-lg mt-4">
						<input type="text" class="form-control border-3 border-danger " placeholder="Username" id="username" name="username">
					</div>
					<br>
					<div class="input-group input-group-lg mb-2">
						<input type="password" class="form-control border-3 border-danger" placeholder="Password" id="password" name="password">
					</div>
					<br>
					<button type="submit" class="btn btn-danger fs-4 fw-semibold mb-3 ">Submit</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>