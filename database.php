<!-- This is a common database connect/disconnect each element of our app uses. This helps with security and continuity.-->

<?php
class Database
{
    // These are our database variables
    private static $dbName = 'contacts' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'password';
    // This sets the connection to null 
    private static $cont  = null;
     
    // This is the constructor of the static database class. Since we do not want initialization, we use "die" to prevent misuse
    public function __construct() {
        die('Initialization of function is not allowed');
    }
     
    // The main function of this class. It allows for one database connection through whole application. 
    public static function connect()
    {
      // We use PDO (PHP Data Objects) rather than SQL extensions to provide a uniform method of access to multiple databases.
      // Because of the static method, we can use "Database::connect()" to create a connection.
      if ( null == self::$cont )
      {     
        try
        {
          // "self" refers to the current class and is used concurrently with static members
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
      }
      return self::$cont;
    }
     
    // This sets the database connection to null.
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
