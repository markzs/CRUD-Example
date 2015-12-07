<?php
    require 'database.php';
    $id = 0;
    // This captures the id from a GET request 
    // Once one has been determined, it shows a confirmation page
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    // This is the code that executes upon clicking "Yes" below
    if ( !empty($_POST)) {
        // This keeps track of the POST values
        $id = $_POST['id'];
         
        // This deletes the data from the table
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM contacts  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        // Redirect back to index.php
        header("Location: index.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete a Contact</h3>
                    </div>
                    <br>
                     
                    <form class="form-horizontal" action="delete.php" method="post">
                      <!--The hidden type stores the GET id to be deleted-->
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="index.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div>
  </body>
</html>
