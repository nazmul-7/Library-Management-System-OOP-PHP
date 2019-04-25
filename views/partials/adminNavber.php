
<?php

$signInLink = '<li class="nav-item">
                <a class="nav-link" href="'.BASE_URL.'/index/signIn">Login</a>
              </li>';
$signUpLink = '<li class="nav-item">
                <a class="nav-link" href="'.BASE_URL.'/index/signUp">Registration</a>
              </li>';
$logoutLink = '<li class="nav-item">
                <a class="nav-link" href="'.BASE_URL.'/usersController/userLogout">Logout</a>
              </li>';


?>
<!-- Navber -->


<nav class="navbar navbar-expand-lg   navbar-dark bg-dark mb-2">
  <a class="navbar-brand active" href="#">StackOverFlow</a>
  <a class="navbar-brand active" href="#">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link "href="<?php echo BASE_URL; ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link "href="<?php echo BASE_URL.'/adminIndex/showCatagory'; ?>">Catagory <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link "href="<?php echo BASE_URL.'/questionController/showAllQuestion'; ?>">All Question</a>
      </li>

      <?php

        if(session::get("login") == true)
            echo $logoutLink;
        else{
          echo $signInLink;
          echo $signUpLink;
        }

      
      
      
      ?>

      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>/index/signIn">Login</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>/index/signUp">Registration</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>/usersController/userLogout">Logout</a>
      </li> -->

      
     
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>