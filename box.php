<?php

if (isset($_POST['submit'])) {
    include("connection.php");
    // Sanitize input to prevent SQL injection
    $box_name = mysqli_real_escape_string($conn, $_POST['box_name']);
    $box_items = $_POST['box_items'];
    $box_items = json_encode($box_items);

    // SQL query to insert data
    $sql = "INSERT INTO box_table (box_name, box_items) VALUES ('$box_name', '$box_items')";

    // Execute the query
    $query = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($query) {
        echo "<script>alert('Data inserted');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

include("connection.php");
// // SQL query to fetch data
$sql = "SELECT * FROM allitems";
$result = mysqli_query($conn, $sql);

$box = mysqli_query($conn, "SELECT * FROM box_table");
?>

<!-- Query Part End -->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">

    <title>Wow Box</title>
    <style>
        .container {
            margin-top: 50px;
            width: 50%;
            margin-left: 25%;
        }
        #add {
            margin: 50px;
            border: 1px solid gainsboro;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Add Box</h2>

        <form method="POST" action="box.php">

            <div class="group">
                <label>Box Name</label>
                <input type="text" id="items" placeholder="Enter Box Name" name="box_name" required class="form-control">
                <span class="highlight"></span>
                <span class="bar"></span>
               <br>
               <select name="box_items[]" id="choices-multiple-remove-button" class="form-control" placeholder="Select Items" multiple>
                    <?php
                        $i = 1;
                        while ($res = mysqli_fetch_array($result)) {
                            echo "<option value=". $res['items'] . "> " . $res['items'] ."</option>";
                        }
                        ?>  
               </select>
               <br>
                <button type="submit" class="bnt btn-info" name="submit">Add</button>
            </div>
        </form>
    </div>

    <div class="out-session">
        <a class="btn btn-outline-danger mx-2" type="submit" href="logout.php">Logout</a>
    </div>

    </div>
    <section id="add">
	<a href="upload.php" class="btn btn-success text-decoration-none">Items</a>
		<div class="container">
			<h1 class="text-center mb-5 text-info">Box List</h1>
			<div class="table-responsive" id="printable_div">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th scope="col">Sl</th>
							<th scope="col">Box Name</th>
							<th scope="col">Box Items</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $i = 1;
                        while ($res = mysqli_fetch_array($box)) {
                            echo "<tr>";
                            echo    "<th scope='row'>" . $i++ . "</th>";
                            echo     "<td>" . $res['box_name'] . "</td>";
                            echo     "<td>" . $res['box_items'] . "</td>";
                        }
                        ?>
					</tbody>
				</table>
			</div>
            <button class="btn btn-warning" onclick="printDiv('printable_div')">Print</button>
		  </div>

		</div>
	</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script>
    $(document).ready(function(){
    
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
       removeItemButton: true,
       maxItemCount:5,
       searchResultLimit:5,
       renderChoiceLimit:5
     });
    
});

    function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
</body>

</html>