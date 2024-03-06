<?php
    session_start();
    if (!isset($_SESSION["user"])){
        header("Location: login.php");
    }
?>
<?php
error_reporting(0);
require_once "database.php";

$query = "SELECT rating_number, FORMAT((total_points / rating_number),1) as average_rating FROM post_rating WHERE post_id = 1 AND status = 1";
$result = $conn->query($query);
$ratingRow = $result->fetch_assoc();
$email=$_SESSION["user"];


$DISC = $_GET['DISC'];

$sql="select * from full_recipy where rid='$DISC' ";
$resul=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($resul);

	$title =  	  $row['title'];
	$title_text=  $row['title_text'];
	$image = 	  $row['image'];
	$ing =  	  $row['ing'];
	$ing_text =   $row['ing_text'];
	$rid = 		  $row['rid'];
	$disc = 		  $row['disc'];
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Full-Recipes</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="rating.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="rating.js"></script>
<script language="javascript" type="text/javascript">
$(function() {
    $("#rating_star").codexworld_rating_widget({
        starLength: '5',
        initialValue: '',
        callbackFunctionName: 'processRating',
        imageDirectory: 'images/',
        inputAttr: 'postID'
    });
});

function processRating(val, attrVal){
    $.ajax({
        type: 'POST',
        url: 'rating.php',
        data: 'postID='+attrVal+'&ratingPoints='+val,
        dataType: 'json',
        success : function(data) {
            if (data.status == 'ok') {
                alert('You have rated '+val+' to <?php echo $title;?>');
                $('#avgrat').text(data.average_rating);
                $('#totalrat').text(data.rating_number);
            }else{
                alert('Some problem occured, please try again.');
            }
        }
    });
}
</script>
<style type="text/css">
    .overall-rating{font-size: 14px;margin-top: 5px;color: #8e8d8d;}
</style>
</head>
<body>
	<div class="header">
		<div>
			<a href="index.php"><img src="images/logo.png" alt="Logo"></a>
		</div>
		
	</div>
	<div class="body">
		<div>
			<div  style="min-height:10px;width: 410px;background-color:#e6dfd1;display:inline-block;border-radius:5px;">
			
				<ul>
				<input name="rating" value="0" id="rating_star" type="hidden" postID="1"  />
								<div  style="min-height:40px;width: 200px;background-color:;float:;">
								<p  style="display:inline-block;min-height:20px;width: 120px;background-color:;">
								(Average Rating):
								</p>
								<p  style="float:right;min-height:20px;width: 50px;background-color:;margin-right:30px;">
								<?php echo $ratingRow['average_rating']; ?>
								</p>
								<p  style="display:inline-block;height:20px;width: 120px;background-color:;">
								(based on):
								</p>
								<p  style="float:right;min-height:20px;width: 50px;background-color:;margin-right:30px;">
								<?php echo $ratingRow['rating_number']; ?>
								</p>
								</div>
								
					
					
					
					
					
				</ul>
			</div>
			<div class="header" style="margin-top:30px;">
			
				<ul>
					<li class="current">
						<a href="recipes.php">Recipes</a>
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
						<div>
						
						<?php
						
						echo	'<h3>'.$title.'</h3>';
						echo'<p>
									'.$title_text.'
								
							</p>';
						echo	"<img  style='width:650px;
	                         height:350px;
							 margin-top:5px;
							 margin-left:5px; 
							 border-radius:5px;
							' src='img/".$row['image']."' />";
						
						echo	'<h5>INGREDIENTS</h5>';
						
						
						
						
							echo		$ing_text;
							
							
							
							echo'<h5>DIRECTIONS</h5>';
	
							echo		$disc;

							
							if(isset($_POST["save"])){
								//select $email where $rid
								//if result empty then insert else dont
								//insert $email,$rid
								mysqli_query($conn,"INSERT INTO saved (email, rid) VALUES ('$email', '$rid')");
							}
							?>
					
				</div>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?" . htmlspecialchars($_SERVER["QUERY_STRING"]);?>" method="post">
					<input type = "submit" value = "Save" name="save" class="btn btn-warning">
				</form>
			</div>
		</div>
	</div>
</body>
</html>