<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "db_conn.php";

	# Book helper function
	include "php/func-book.php";
    $books = get_all_books($conn);

    # author helper function
	include "php/func-author.php";
    $authors = get_all_author($conn);

    # Category helper function
	include "php/func-category.php";
    $categories = get_all_categories($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesaheet" href="style.css">
	<title>ADMIN</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light "
		style= "margin:0;
						padding:0;
						width:100%;
						color: #ffffff;
						border:#f4bfd4;
						font-size:20px;
    					font-weight: 600;
    					cursor: pointer;">
		  <div class="container-fluid">
		  <a class="navbar-brand" href="index.php">BIBLIOTECA<a style="color:#f4bfd4;">ET24 </a></a>
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
		             href="add-category.php">Agregar categoria</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" 
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
       <form action="search.php"
             method="get" 
             style="width: 100%; max-width:700px">
       	<div class="input-group my-5">
		  <input type="text" 
		         class="form-control"
		         name="key" 
		         placeholder="Buscar libro..." 
		         aria-label="Buscar libro..." 
		         aria-describedby="basic-addon2">
		  <button class="input-group-text
		                 btn btn-primary" 
						 style= "background:#f4bfd4;
						border:#f4bfd4;
						font-size:20px;
    					font-weight: 600;
    					cursor: pointer;"
		          id="basic-addon2">Q</button>
		</div>
       </form>
       <div class="mt-5"></div>
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


        <?php  if ($books == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  No hay libros en la base de dato
		  </div>
        <?php }else {?>


        <!-- List of all books -->
		<h4>Todos los libros</h4>
		<table class="table table-bordered shadow">
			<thead>
				<tr>
					<th><3</th>
					<th>Título</th>
					<th>Autor</th>
					<th>Descripción</th>
					<th>Categoría</th>
					<th>--</th>
				</tr>
			</thead>
			<tbody>
			  <?php 
			  $i = 0;
			  foreach ($books as $book) {
			    $i++;
			  ?>
			  <tr>
				<td><?=$i?></td>
				<td>
					<img width=100
					     src="uploads/covers/<?=$book['cover']?>" >
					<a  class="link-dark d-block
					           text-center"
					    href="uploads/files/<?=$book['file']?>">
					   <?=$book['title']?>	
					</a>
						
				</td>
				<td>
					<?php if ($authors == 0) {
						echo "Indefinido";}else{ 

					    foreach ($authors as $author) {
					    	if ($author['id'] == $book['author_id']) {
					    		echo $author['name'];
					    	}
					    }
					}
					?>

				</td>
				<td><?=$book['description']?></td>
				<td>
					<?php if ($categories == 0) {
						echo "Indefinido";}else{ 

					    foreach ($categories as $category) {
					    	if ($category['id'] == $book['category_id']) {
					    		echo $category['name'];
					    	}
					    }
					}
					?>
				</td>
				<td>
					<a href="edit-book.php?id=<?=$book['id']?>" 
					   class="btn btn-warning"
					   style= "background:#f4bfd4;
						border: #f4bfd4;
						color: #ffffff;
						font-size:17px;
    					font-weight: 600;
    					cursor: pointer;">
					   Editar</a>

					<a href="php/delete-book.php?id=<?=$book['id']?>" 
					   class="btn btn-danger"
					   style= "background:#e2644b;
						
						color: #ffffff;
						font-size:17px;
    					font-weight: 600;
    					cursor: pointer;">
				       Borrar</a>
				</td>
			  </tr>
			  <?php } ?>
			</tbody>
		</table>
	   <?php }?>

        <?php  if ($categories == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  No hay categorias en la base de datos
		    </div>
        <?php }else {?>
	    <!-- List of all categories -->
		<h4 class="mt-5">Todas las categorias</h4>
		<table class="table table-bordered shadow">
			<thead>
				<tr>
					<th><3</th>
					<th>Nombre</th>
					<th>--</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$j = 0;
				foreach ($categories as $category ) {
				$j++;	
				?>
				<tr>
					<td><?=$j?></td>
					<td><?=$category['name']?></td>
					<td>
						<a href="edit-category.php?id=<?=$category['id']?>" 
						   class="btn btn-warning"
						   style= "background:#f4bfd4;
						border: #f4bfd4;
						color: #ffffff;
						font-size:17px;
    					font-weight: 600;
    					cursor: pointer;">
						   Editar</a>

						<a href="php/delete-category.php?id=<?=$category['id']?>" 
						   class="btn btn-danger"
						   style= "background:#e2644b;
						
						color: #ffffff;
						font-size:17px;
    					font-weight: 600;
    					cursor: pointer;">
					       Borrar</a>
					</td>
				</tr>
			    <?php } ?>
			</tbody>
		</table>
	    <?php } ?>

	    <?php  if ($authors == 0) { ?>
        	<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			  No hay autores en la base de datos
		    </div>
        <?php }else {?>
	    <!-- List of all Authors -->
		<h4 class="mt-5">Todos los autores</h4>
         <table class="table table-bordered shadow">
			<thead>
				<tr>
					<th><3</th>
					<th>Nombre</th>
					<th>--</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$k = 0;
				foreach ($authors as $author ) {
				$k++;	
				?>
				<tr>
					<td><?=$k?></td>
					<td><?=$author['name']?></td>
					<td>
						<a href="edit-author.php?id=<?=$author['id']?>" 
						   class="btn btn-warning"
						   style= "background:#f4bfd4;
						border: #f4bfd4;
						color: #ffffff;
						font-size:17px;
    					font-weight: 600;
    					cursor: pointer;">
						   Editar</a>

						<a href="php/delete-author.php?id=<?=$author['id']?>" 
						   class="btn btn-danger"
						   style= "background:#e2644b;
						
						color: #ffffff;
						font-size:17px;
    					font-weight: 600;
    					cursor: pointer;">
					       Borrar</a>
					</td>
				</tr>
			    <?php } ?>
			</tbody>
		</table> 
		<?php } ?>
	</div>
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>