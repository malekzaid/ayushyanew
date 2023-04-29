<?php
    if(isset($_GET['name'])){
        extract($_GET);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ayushya Case</title>
            <link rel="stylesheet" href="css/card.css">
        </head>
        <body>
            <div class="card">
                <div class="card-header">
                    <h3>Ayushya Case</h3>
                </div>
                <div class="card-body">
                    <p><strong>CASE ID:</strong><?=$id?></p>
                    <p><strong>Patient Name:</strong><?=$name?></p>
                    <p><strong>Gender:</strong> <?=$gender?></p>
                    <p><strong>Date of Birth:</strong> <?=$dob?></p>
                    <p><strong>Contact:</strong> <?=$contact?></p>
                    <p><strong>Blood Group:</strong> <?=$blood?></p>
                </div>
                <div class="card-footer">
                    <p>Generated on: <?=date('d-m-Y')?></p>
                </div>
                <script>window.print()
                window.onafterprint = function() {
				window.location.href = "index.php";
			}</script>
            </div>
        </body>
        </html>
        

        <?php
    }
    // header("Location:index.php");
?>