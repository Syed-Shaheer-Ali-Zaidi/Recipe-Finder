<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: login.php");
    }
?>
<?php
 require_once "database.php";
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title >Recipes </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="header">
		<div>
			<a href="index.php"><img src="images/logo.png" alt="Logo"></a>
		</div>
		
	</div>
	<div class="body">
		<div>
			<div class="header">
				<ul>
					<li class="current">
						<a href="recipes.php"> Recipes</a>
					</li>
					<li class="current">
						<a href="savedrecipes.php">Saved Recipes</a>
					</li>
					<li class="current">
						<a href="logout.php">Log Out</a>
					</li>
					
				</ul>
			</div>
			<div class="body">
				<div id="content">
					<div>
						<ul>
						
	<?php					
		    $sql = "SELECT * FROM recipes ORDER BY rid DESC";
			$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result))
				{
						$rid =  $row['rid'];
						$rimage =  $row['rimage'];
						$rname =  $row['resname'];
						$rtext =  $row['rtext'];
					
				echo		'<li>';
				echo				"<a href=fullrecipy.php?DISC=".$row['rid']."><img  style='width:150px;
	                         height:180px;
							 margin-top:5px;
							 margin-left:5px; 
							 border-radius:5px;
							' src='img/".$row['rimage']."' ></a>";
				echo				'<div>';
				echo					"<h3><a href=fullrecipy.php?DISC=".$row['rid'].">$rname</a></h3>";
				echo					"<p>
										$rtext
									</p>";
				echo				'</div>';
				echo			'</li>';
				}		
			?>			
						
						
							
						
							
						</ul>
					</div>
				</div>
			</div>
		</div>
		</div>
</body>
</html>