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

<link href="https://fonts.googleapis.com/css?family=Bubbler+One|Tangerine" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
    #res1{
      width:80%;
      background-color:#ffffff;
      margin-left:30%;

    }

    #res{
     
      padding:5px;
      float:left;
      width:15%;
      height:35%;
      list-style-type: none;

    }
    #navi{
    background-color: #000000;
    overflow:hidden;
    list-style-type: none;
    color:#ffffff;
    margin:0;
    padding: 0;
  }

  #navi1{
    float:right;
    padding: 15px;
  }

  #navi2{
    color:#ffffff;
    display:block;
    text-decoration: none;
  }

  #navi1:hover{
        background-color: #cc0000;
  }


    </style>
</head>
<body>
<ul id="navi"">
      <li id="navi1"><a href="#" id="navi2" >Home</a></li>
      <li id="navi1"><a href="#" id="navi2">Home</a></li>
      <li id="navi1"><a href="#" id="navi2">Home</a></li>
      <li id="navi1"><a href="#" id="navi2">Home</a></li>
    </ul>

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
$RESULTS_LIMIT=20;
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

if($results != 0)
{
?>   
   <!-- Displaying of the results -->
  <div id="#res1">
   <form action="" method="GET">
       <input name="search_term" type="text" style="margin-left:17%;width:60%;height:5%;margin-top:3%;padding:5px;" value="<?php echo $search_term; ?>">
        <input name="search_button" type="submit" value="Search" style="height:5%;"> 
    </form>
  <?PHP   
  
    while($row = mysqli_fetch_array($sql_result_query))
    {
      
      $bookid=$row['id'];

    ?>
   
    <ul style="margin-left:10%; margin-right:10%;" >
    <li id="res"><?php echo '<a  href="book.php?id='.$bookid.'"><img style="height:100%; width:100%;" src=" '.$row['link'].'"></a>' ?></li>
    </ul>
    
  <?PHP
    }
    ?>




    

<?PHP
}
//if nothing is found then displays a form and a message that there are nor results for the specified term
elseif($sql_query)     
{
?>

        <form action="" method="GET">
        
            <input name="search_term" type="text" style="margin-left:17%;width:60%;height:5%;margin-top:3%;padding:5px;" value="<?PHP echo $search_term; ?>">
            <input name="search_button" type="submit" value="Search" style="height:5%;">
        
        </form>

        <h1 style="text-align:center; font-family:'Tangerine', cursive;margin-top:4%;">Oops!!! We ran out of results for <?PHP echo $search_term; ?><br>How about trying something else?</h1>
    </div>
<?PHP
}
?>

</body>
</html>
