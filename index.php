<!DOCTYPE html>
<html lang="en">
<!--References our Bootstrap files-->
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>My Contacts</h3>
            </div>
            <br>
            <div class="row">
                
                <!--Button to access the "Create" file-->
                
<!--1 Create "create.php"-->
                <!--<p>
                    <a href="create.php" class="btn btn-success">Create</a>
                </p>-->
                
                <!--This table is the main part of our file. In it we retrieve the data and show it in the grid-->
                <table class="table table-striped table-bordered">
                  <!--thead creates the fields for our data-->
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  <?php
                    // This is where the database is accessed in the HTML
                    include 'database.php';
                    // Connection to the database through the PDO
                    $pdo = Database::connect();
                    // Basic SQL Select statement
                    $sql = 'SELECT * FROM contacts ORDER BY id DESC';
                    // A loop through the data and displaying all of the results in a grid that mimics the above titles
                    foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td>'. $row['mobile'] . '</td>';
                            
                            /* Here we are doing inline styling in the HTML.
                            Good practice would normally suggest against doing this.
                            Because we are using Bootstrap for our main styles,
                            AND this is only one style, it is okay in this case.*/
                            echo '<td width=250>';
                            
                            // These are the Read, Update, and Delete buttons
                            
// 2 Create "read.php"
                            // The PK (id) of each row is held as a hidden variable in the link
                            // echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                            // echo ' ';

// 3 Create "update.php"
                            // echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                            // echo ' ';

// 4 Create "delete.php"
                            // echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                            // echo '</td>';
                            
                            echo '</tr>';
                   }
                   // After reading, we close the database connection
                   Database::disconnect();
                  ?>

                  </tbody>
            </table>
        </div>
    </div>
  </body>
</html>
