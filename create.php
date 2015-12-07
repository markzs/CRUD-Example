<?php
     
    require 'database.php';
 
    // This checks to see if the form was submitted
    if ( !empty($_POST)) {
        // This keeps track of validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // These assign the post value variables.
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
         
        // Validating inputs
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter a Name';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter an Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            // Using PHP Filter to make sure email address is a valid format.
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Please enter a Phone Number';
            $valid = false;
        }
         
        // Using the database class, this inserts the data into the table
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO contacts (name,email,mobile) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$email,$mobile));
            Database::disconnect();
            // This is redirect back to index.php
            header("Location: index.php");
        }
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
                <h3>Create a Contact</h3>
            </div>
            <br>
            <!--Action shows what will be done upon submit-->
            <form class="form-horizontal" action="create.php" method="post">
                <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                    <label class="control-label">Name</label>
                    <div class="controls">
                        <!--This is our input. The value is currently null but will be held as a PHP variable on input and submit-->
                        <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                        <!--If empty on Submit, this shows our $Error-->
                        <?php if (!empty($nameError)): ?>
                            <span class="help-inline"><?php echo $nameError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                    <label class="control-label">Email Address</label>
                    <div class="controls">
                        <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                        <?php if (!empty($emailError)): ?>
                            <span class="help-inline"><?php echo $emailError;?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                    <label class="control-label">Mobile Number</label>
                    <div class="controls">
                        <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                        <?php if (!empty($mobileError)): ?>
                            <span class="help-inline"><?php echo $mobileError;?></span>
                        <?php endif;?>
                    </div>
                </div>
                <div class="form-actions">
                    <!--Clicking "Create" submits our input variables to the PHP code above to POST-->
                    <button type="submit" class="btn btn-success">Create</button>
                    <a class="btn" href="index.php">Back</a>
                </div>
            </form>
        </div>
                 
    </div>
  </body>
</html>
