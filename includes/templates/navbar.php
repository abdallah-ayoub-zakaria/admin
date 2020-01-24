<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggl ing -->
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
      
      
         <li ><a href="members.php">Members </a></li>
       

      </ul>
      <ul class="nav navbar-nav navbar-right">
         <li><a href="members.php?do=Edit&userid=<?php  echo $_SESSION['ID']?>">Edit Profile</a></li>
      
            <li><a href="logout.php">Logout</a></li>
       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav> 