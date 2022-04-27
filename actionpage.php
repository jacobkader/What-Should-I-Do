
<html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="currentcolour">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Coffee Box.">
    <link rel="stylesheet" href="CSS/movie box.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Movie Box</title>
   </head>
   <body>
    <div id="main" style=" border-radius: 10px;">
      <p class="logoDiv">
         <a href ="Welcome Page.html"><img src="Images/Logo.jpg" alt="Logo" class="logo"></a>
      </p>
  
      <div class="topnav">
         <a class="active" href="Index.html">Home</a>
         <a href="moviepicker.html">Movie Picker </a>
         <a href="#contact">Contact</a>
         <div class="search-container">
          <form action="/action_page.php">
            <input type="text" placeholder="Search.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
       </div>
	   <div class = "output">
	   	<?php
		$mood = $_POST['moodpick'];
		$genre = $_POST['genrepick'];
		$occasion = $_POST['occasionpick'];
		$year = $_POST['yearpick'];
		
		$arr = array($mood,$genre,$occasion);
		
		sort($arr);
		$maxcount = 1;
		$res = $arr[0];
		$currcount = 1;
		
		for ($i = 1; $i < 3; ++$i){
			if ($arr[$i] == $arr[$i- 1]){
				++$currcount;
			}
			else {
				if($currcount > $maxcount) {
					$maxcount = $currcount;
					$res = $arr[$i- 1];
				}
				$currcount = 1;
			}
			
		}
		
		if($currcount > $maxcount){
			$maxcount = $currcount;
			$res = $arr[$i- 1];
		}
		
		if ($res == 1){
			$resultgenre = "comedy";
		} elseif ($res == 2){
			$resultgenre = "action";
		} elseif ($res == 3){
			$resultgenre = "drama";
		} elseif ($res == 4){
			$resultgenre = "horror";
		}
		
		echo $resultgenre."<br>";
		
		if ($year == '2015'){
			$upboundyear = "2022";
			$lowboundyear = "2015";
		} elseif ($year == '2005'){
			$upboundyear = "2014";
			$lowboundyear = "2005";
		} elseif ($year == '1995'){
			$upboundyear = "2004";
			$lowboundyear = "1995";
		} elseif ($year == '1990'){
			$upboundyear = "1994";
			$lowboundyear = "1990";
		}
		
		$query ="SELECT  * FROM `movie_table` WHERE genre = '".$resultgenre."' AND year >= '".$lowboundyear."' AND year<='".$upboundyear."' LIMIT 5";
		
		
		
		$dbConection = new mysqli("localhost", "root", "", "movies");
		/* check connection */
		if ($dbConection->connect_errno) {
			echo "Connect failed ".$dbConection->connect_error;
			exit();
		}
		
		$result = $dbConection->query($query);
		
		if ($result != null) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "  Name: " . $row["movie_title"]. " year" . $row["year"]. "<br>";
			}
		} else {
			echo "0 results";
		}
		
		
		
		 
		/* close connection */
		$dbConection->close();
		
		?>
	   </div>


    </div>
      <footer>
        <p>Author: Movie Box</p><br>
        <a href="mailto:hege@example.com">MovieBox@gmail.com</a></p2>

      </footer>
	
	

	
	
	
	
	


	   
   </body>
</html>