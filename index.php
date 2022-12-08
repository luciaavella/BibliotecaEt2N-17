<?php 
session_start();

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
	<title>Inventario</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
		<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light;"
		
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
		          <a class="nav-link active" 
		             aria-current="page" 
		             href="index.php">Inventario</a>
		        </li>
				<li class="nav-item">
		          <a class="nav-link active" 
		             aria-current="page" 
		             href="pedidos.php">Reservar</a>
		        </li>
		      
		        <li class="nav-item">
		          <?php if (isset($_SESSION['user_id'])) {?>
		          	<a class="nav-link" 
		             href="admin.php">Admin</a>
		          <?php }else{ ?>
		          <a class="nav-link" 
		             href="login.php">Iniciar sesión</a>
		          <?php } ?>
				  <li> 

		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
		</header>
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
		<div class="d-flex pt-3">
			<?php if ($books == 0){ ?>
				<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" 
        	          width="100">
        	     <br>
			    No hay libros en la base de datos
		       </div>
			<?php }else{ ?>
			<div class="pdf-list d-flex flex-wrap">
				<?php foreach ($books as $book) { ?>
				<div class="card m-1"style="width:200px; height: fit-content;">
					<img 
					src="uploads/covers/<?=$book['cover']?>"
					     class="card-img-top">
					<div class="card-body">
						<h5 class="card-title">
							<?=$book['title']?>
						</h5>
						<p class="card-text">
							<i><b>Por:
								<?php foreach($authors as $author){ 
									if ($author['id'] == $book['author_id']) {
										echo $author['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
							<?=$book['description']?>
							<br><i><b>Categoría:
								<?php foreach($categories as $category){ 
									if ($category['id'] == $book['category_id']) {
										echo $category['name'];
										break;
									}
								?>

								<?php } ?>
							<br></b></i>
						</p>
						<a href="uploads/files/<?=$book['file']?>"
                          class="btn btn-success"
						  style="background:#f4bfd4;
							color: #ffffff;
							border:#f4bfd4;
							font-size:20px;
							font-weight: 600;
							cursor: pointer; "
						  >Abrir</a>

                        <a href="uploads/files/<?=$book['file']?>"
                          class="btn btn-primary"
                          download="<?=$book['title']?>"
						  style="background:#95b185;
							color: #ffffff;
							border:#d2f4bf;
							font-size:20px;
							font-weight: 600;
							cursor: pointer; ">Descargar</a>
					</div>
				</div>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="category">
			<!-- List of categories -->
			<div class="list-group">
				<?php if ($categories == 0){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active"
				   style="background:#f4bfd4;
							color: #ffffff;
							border:#f4bfd4;
							font-size:18px;
							font-weight: 600;"
							>Categorias</a>
				   <?php foreach ($categories as $category ) {?>
				  
				   <a href="category.php?id=<?=$category['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$category['name']?></a>
				<?php } } ?>
			</div>

			<!-- List of authors -->
			<div class="list-group mt-5">
				<?php if ($authors == 0){
					// do nothing
				}else{ ?>
				<a href="#"
				   class="list-group-item list-group-item-action active"
				   style="background:#f4bfd4;
							color: #ffffff;
							border:#f4bfd4;
							font-size:18px;
							font-weight: 600;">Autores</a>
				   <?php foreach ($authors as $author ) {?>
				  
				   <a href="author.php?id=<?=$author['id']?>"
				      class="list-group-item list-group-item-action">
				      <?=$author['name']?></a>
				<?php } } ?>
			</div>
		</div>
		</div>
	</div>
</body>
</html>
