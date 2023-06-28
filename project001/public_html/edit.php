<?php
require_once '../src/db_conn.php';

$id = $_GET['id'];

$sql = "SELECT * FROM EVENTOS WHERE id='$id'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>

<head>
	<title>Editar evento</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
	<div class="w-100 text-end">
		<a href="home.php"><button type="button" class="btn btn-dark mx-4 mt-4">Atrás</button></a>
	</div>
	<main class="container mb-5 col-md-6">
		<div class="w-100 my-3 text-center">
			<h3 class="m-0 p-2">EDITAR EVENTO</h3>
			<b>Modifique los datos que desee.</b>
		</div>
		<div class="text-center">
			<?php if (isset($_GET['error'])) {
				echo '<p class="badge rounded-pill bg-danger">' . $_GET['error'] . '</p>';
			} ?>
		</div>
		<form method="POST" action="controllers/admins/update.php?id=<?php echo trim($row['id']); ?>">
			<div class="form-group mb-3">
				<label for="name" class="mb-2">Name:</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
			</div>

			<div class="form-group mb-3">
				<label for="total" class="mb-2">Entradas Totales:</label>
				<input type="text" class="form-control" id="total" name="total" value="<?php echo $row['total']; ?>" required>
			</div>

			<div class="form-group mb-3">
				<label for="max" class="mb-2">Máximas entradas por compra:</label>
				<input type="text" class="form-control" id="max" name="max" value="<?php echo $row['max']; ?>" required>
			</div>

			<button type="submit" class="btn btn-dark w-100" style="bottom: 0px">Envíar cambios</button>
		</form>
	</main>
</body>

</html>