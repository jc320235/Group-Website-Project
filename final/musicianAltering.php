<?php
	session_start();
	error_reporting(E_ALL);
	
	if (++$_SESSION['lastRegeneration'] >= 10) {
		$_SESSION['last_regeneration'] = 0;
		session_regenerate_id(true);
	}
	
    include("dbconnect.php");
    //All php on this page written/repurposed by Christian Thorpe
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Musician Processing Submission</title>
    <link href="mainstyles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
    <h1>Results</h1>
        <?php
            echo "<h2>Database Alteration:</h2>";
            if ($_REQUEST['submit'] == "Delete"){
                $sql = "DELETE FROM Artists WHERE ArtistID = '$_REQUEST[artistID]'";
                if ($dbh->exec($sql)) {
                    echo "Successfully deleted artist.";
                    echo "<p><a href = 'musicians.php'>Return</a></p>";
                } else {
                    echo "Artist was not removed.";
                }
            }
            else if ($_REQUEST['submit'] == "Update") {
                $sql = "UPDATE Artists SET ArtistID = '$_REQUEST[artistID]', ArtistName = '$_REQUEST[artistName]', Details = '$_REQUEST[artistDetails]', Description = '$_REQUEST[artistDescription]', Email = '$_REQUEST[artistEmail]', PhoneNumber = '$_REQUEST[artistPhone]', Website = '$_REQUEST[artistWebsite]' WHERE ArtistID = '$_REQUEST[artistID]'";
                if ($dbh->exec($sql)){
                    echo "Updated database.";
                    echo "<p><a href = 'musicianInfo.php?tag=$_REQUEST[artistID]'>Return</a></p>";
                } else {
                    echo "The database was unable to be updated.";
                }
            }
            else {
                echo "This page did not come from a valid form submission.<br />\n";
            }
            echo "</p>\n";

            $dbh = null;
        ?>
    </div>
</body>
</html>