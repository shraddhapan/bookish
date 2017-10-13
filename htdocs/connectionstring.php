<?php

    session_start();
      $host="localhost";
$user="root";
$password="";

$db=mysqli_connect($host,$user,$password);
mysqli_select_db($db,"miniproject");


$url=$_SERVER['REQUEST_URI'];
$query= parse_url($url, PHP_URL_QUERY);
parse_str($query);

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<html>
<head>
    <style>
    #res1{
      width:80%;
      background-color:#ffffff;
      margin-left:10%;
    }

    #res{
      width:10%;
      height:30%;
      padding:5px;
      float:left;

    }
    </style>
</head>
<body>


<?PHP            // Search.php





$results = 0;
$sql_query = 0;
$first_pos = 0;
function getmicrotime()        
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
//initializing connection to the database 

//selecting table
mysqli_select_db($db,"miniproject") or die ( 'Unable to select database.' );
//max number of results on the page
$RESULTS_LIMIT=10;
if(('search_term') )
{
      $search_term = $_GET['search_term'];
    if(!isset($first_pos))
    {
        $first_pos = "0";
    }
    $start_search = getmicrotime();
      //initializing mysqli Quary  
    $sql_query = mysqli_query($db,"SELECT title FROM book WHERE MATCH(title,author,genre,publication,isbn) AGAINST('$search_term')");
    //additional check. Insurance method to re-search the database again in case of too many matches (too many matches cause returning of 0 results)
    if($results = mysqli_num_rows($sql_query) != 0)
            {
                $sql =  "SELECT * FROM book WHERE MATCH(title,author,genre,publication,isbn) AGAINST('$search_term') LIMIT $first_pos, $RESULTS_LIMIT";
                  $sql_result_query = mysqli_query($db,$sql);         
            }
    else
            {
                  $sql = "SELECT * FROM book WHERE (title LIKE '%".mysqli_real_escape_string($db,$search_term)."%' OR author LIKE '%".$search_term."%' OR genre LIKE '%".$search_term."%' OR publication LIKE '%".$search_term."%' OR isbn LIKE '%".$search_term."%') ";
                  $sql_query = mysqli_query($db,$sql);
                  $results = mysqli_num_rows($sql_query);
               
//$_SESSION['regName'] = $regValue; 
  $sql_result_query = mysqli_query($db,"SELECT * FROM book WHERE (title LIKE '%".$search_term."%' OR author LIKE '%".$search_term."%' OR genre LIKE '%".$search_term."%' OR publication LIKE '%".$search_term."%' OR isbn LIKE '%".$search_term."%' ) LIMIT $first_pos, $RESULTS_LIMIT ");
            }
    $stop_search = getmicrotime();
      //calculating the search time
    $time_search = ($stop_search - $start_search);
}
?>
<?PHP
if($results != 0)
{
?>   
   <!-- Displaying of the results -->
<table border="0" cellspacing="2" cellpadding="2">
  <tr>
   
   
  </tr>
  <tr>
    <form action="" method="GET">
      <td colspan="2" align="center"> <input name="search_term" type="text" value="<?PHP echo $search_term; ?>" size="40">
        <input name="search_button" type="submit" value="Search"> </td>
    </form>
  </tr>
  <div id="#res1">
  <?PHP   
  
    while($row = mysqli_fetch_array($sql_result_query))
    {
      
      $bookid=$row['id'];

    ?>
   
      <tr align="left">
 
    <div id="res"><?php echo '<a href="book.php?id='.$bookid.'"><img src=" '.$row['link'].'"></a>' ?>
    </div>
    </tr> 
  <?PHP
    }
    ?>
    </div>
</table>
<?PHP
}
//if nothing is found then displays a form and a message that there are nor results for the specified term
elseif($sql_query)     
{
?>
<table border="0" cellspacing="2" cellpadding="0">
    <tr>
        <td align="center">No results for   <?PHP echo "<i><b><font color=#000000>".$search_term."</font></b></i> "; ?></td>
    </tr>
    <tr>
        <form action="" method="GET">
        <td colspan="100" align="center">
            <input name="search_term" type="text" value="<?PHP echo $search_term; ?>">
            <input name="search_button" type="submit" value="Search">
        </td>
        </form>
    </tr>
</table>
<?PHP
}
?>

</body>
</html>
