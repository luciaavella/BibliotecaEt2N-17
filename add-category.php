<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesaheet" href="style.css">
	<title>Agregar categoria</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light"
		style= "margin:0;
						padding:0;
						width:100%;
						color: #ffffff;
						border:#f4bfd4;
						font-size:20px;
    					font-weight: 600;
    					cursor: pointer;">
		  <div class="container-fluid">
		  <a class="navbar-brand" href="index.php">BIBLIOTECA<a style="color:#f4bfd4;">ET24</a></a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">

		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">Inventario</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-book.php">Agregar libro</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="add-category.php">Agregar categoría</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" 
		             href="add-author.php">Agregar autor</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="logout.php">Cerrar sesión</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
		<a href="admin.php" class="nd">
		<img src="img/back-arrow.PNG" width="32">
		</a>
		<form action="php/add-category.php"
           method="post" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

     	<h1 class="text-center"
		 style="font-weight:600;
		color:#f4bfd4;">
     		Nueva categoria
     	</h1>
     	<?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		
		    <input type="text" 
		           class="form-control" 
		           name="category_name">
		</div>

	    <button type="submit" 
	            class="btn btn-primary"
				style= "background:#f4bfd4;
				width:100%;
				height:40px;
						border: #f4bfd4;
						color: #ffffff;
						font-size:17px;
    					font-weight: 600;
    					cursor: pointer;">
	            Agregar</button>
     </form>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>