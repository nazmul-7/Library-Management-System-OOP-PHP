<!DOCTYPE html>
<html>
<head>
	<title>
		Library Management System
	</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style type="text/css">
	nav
	{
		float: right;
		word-spacing: 30px;
		padding: 20px;
	}
	nav li 
	{
		display: inline-block;
		line-height: 80px;
	}
</style>
</head>


<body>
	<div class="wrapper">
		<header>
		<div class="logo">
			<img src="img/book1.jpg">
			<h6 style="color: white;"> LIBRARY MANAGEMENT SYSTEM</h6>
		</div>

			<nav >
				<ul>
					<li><a href="index.html">HOME</a></li>
					<li><a href="">BOOKS</a>
                         <ul>
						<li> <a href="Biographies.html">Biographies</a>


                          </li>
                         

							 
                          </li><li> <a href="robindro.html">Robindro </a>

							 
                          </li><li> <a href="nazrul.html">Nazrul</a>
                          	<li> <a href="technology.html">Technology</a>
                          		
                          	<!-- <li> <a href="history.html">History</a> -->
                          				


							 
                          </li>

							 
                          </li>

							 
                          </li>

							 
                          </li>

							 
                          </li>

							 
                          </li>
						
					      </ul>





					</li>
					<li><a href="">LOGIN</a>
					  <ul>
						<li> <a href="admin_login.html">Admin </a></li>
						<li> <a href="user_login.html"> User </a></li>
						<li> <a href="contributor_login.html"> Contributor </a></li>
					        </ul>
					</li>
					<!-- <li><a href="reader_login.html">READER LOGIN</a></li> -->
					<!-- <li><a href="">CONTRIBUTOR LOGIN</a></li> -->
                    <li><a href="review.html">REVIEW</a></li>
				</ul>
			</nav>
		</header>
		<section>
		<img width="1364px" height="513px" src="img/center.jpg">
			


		

<script type="text/javascript">
	var a=0;
	carousel();

	function carousel()
	{
		var i;
		var x= document.getElementsByClassName("mySlides");

		for(i=0; i<x.length; i++)
		{
			x[i].style.display="none";
		}

		a++;  
		if(a > x.length) {a = 1}
			x[a-1].style.display = "block";
			setTimeout(carousel, 5000);
	}
</script>
<!--
			<br><br><br>

			<div class="box">
				<br><br><br><br>
				<h1 style="text-align: center; font-size: 35px;">Welcom to library</h1><br><br>
				<h1 style="text-align: center;font-size: 25px;">Opens at: 09:00 </h1><br>
				<h1 style="text-align: center;font-size: 25px;">Closes at: 15:00 </h1><br>
			</div>
-->
		</div>
		</section>
		<footer>
			
			<p style="color:white;text-align: center;">
				<br>
				Email:&nbsp library@gmail.com <br><br>
				Mobile:&nbsp &nbsp +880171*******
			</p>

		</footer>

	</div>
</body>
</html>