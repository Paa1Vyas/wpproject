<?php include "db_conn.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<title>View</title>

</head>
<body>

<div style="width: 100%;">	

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<nav class="navbar navbar-expand-lg bg-body-tertiary">

  <div class="container-fluid">
  <a href="index.php">&#8592; Go Back </a>
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</div>
<div>
  
</div>


	
	<?php 
    $checkval = "c02";
    $productinfo = "P03";

    $sql = "SELECT * FROM customer JOIN product WHERE c_id = '$checkval' && pid = '$productinfo' ";
    $orderdate = date(("d-m-y"));
    echo $orderdate;

	$res = mysqli_query($conn, $sql);
    

	  if (mysqli_num_rows($res) > 0) {
		  while ($customer = mysqli_fetch_assoc($res)) { ?>
            
			  <br><div class="alb">
                
        <form action="process_order.php" method="post">        
				<p><strong>Customer Name:</strong> <?= $customer['c_name'] ?></p>
				<p><strong>Mobile Number:</strong> <?= $customer['mobilenumber'] ?></p>
				<p><strong>Email Address:</strong> <?= $customer['email_address'] ?></p>
        <p><b>Address:</b><?= $customer['Address'] ?></p>
				<p><strong>Product Name:</strong> <?= $customer['name'] ?></p>
        <p><strong>Price:</strong> <?= $customer['price'] ?></p>
				<p><strong>Category:</strong> <?= $customer['category'] ?></p>
        <input type="submit" value="Submit">
      </form>

			</div>
         
	<?php } }    

    ?>  
    
	
</body>
</html>
