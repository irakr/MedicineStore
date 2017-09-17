<?php
	
	include('includes/action.php');
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dynamically add or remove input fields</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
	<div class="jumbotron">
		<h1 align="center">Medicine Store <small>-by Namah Shrestha</small></h1>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-3"></div>
			<div class="col-xs-6">
				<div class="panel panel-primary">
					<div class="panel-heading">Enter Medicine Details</div>
					<div class="panel-body">
						<?php
							if(isset($_GET['delete'])){
								$id = $_GET['id'];
								$where = array("id"=>$id);
								$obj->delete_record("medicines",$where);
							}
						?>
						<?php
							if(isset($_GET['edit'])){
								$id = $_GET['id'];
								$where = array("id"=>$id);
								$r = $obj->select_record("medicines",$where);
								?>
								<form class="form-horizontal" action="includes/action.php" method="POST">
									<div class="form-group">	
										<table class="table table-hover">
											<tr>
												<td><input type="hidden" name="id" value="<?php echo $id; ?>"/></td>
											</tr>
											<tr>
												<td>Medicine Name</td>
												<td><input type="text" class="form-control" name="name" placeholder="Enter Medicine name" value="<?php echo $r["m_name"];?>"/></td>
											</tr>
											<tr>
												<td>Quantity</td>
												<td><input type="number" class="form-control" name="qty" placeholder="Enter Medicine quantity" value="<?php echo $r["qty"];?>"/></td>
											</tr>
											<tr>
												<td colspan="2" align="center">
													<input type="submit" class="btn btn-primary" name="edit" value="Update"/>
												</td>
											</tr>
										</table>
									</div>
								</form>
								<?php
							}else{
								?>	
								<form class="form-horizontal" action="includes/action.php" method="POST">
									<div class="form-group">	
										<table class="table table-hover">
											<tr>
												<td>Medicine Name</td>
												<td><input type="text" class="form-control" name="name" placeholder="Enter Medicine name"/></td>
											</tr>
											<tr>
												<td>Quantity</td>
												<td><input type="number" class="form-control" name="qty" placeholder="Enter Medicine quantity"/></td>
											</tr>
											<tr>
												<td colspan="2" align="center">
													<input type="submit" class="btn btn-primary" name="submit" value="Store"/>
												</td>
											</tr>
										</table>
									</div>
								</form>
							<?php 
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-2"></div>
			<div class="col-xs-8">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th align="center">#</th>
							<th align="center">Name</th>
							<th align="center">Stock</th>
							<th align="center">&nbsp;</th>
							<th align="center">&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$return_value = $obj->fetch_record("medicines");
							foreach($return_value as $row){
								//break point
								?>
								<tr>
									<td><?php echo $row["m_name"];?></td>
									<td><?php echo $row["qty"];?></td>
									<td><a href="index.php?edit=1&id=<?php echo $row["id"]?>" class="btn  btn-info" type="button" >Edit</a></td>
									<td><a href="index.php?delete=1&id=<?php echo $row['id']?>" class="btn btn-danger">Delete</a></td>
								</tr>
								<?php
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="col-xs-2"></div>
		</div>
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
	<!--Custom javascript code-->
	<script src="js/custom.js"></script>
  </body>
</html>