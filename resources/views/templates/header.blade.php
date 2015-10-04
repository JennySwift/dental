
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand fa fa-usd" href="#"></a>-->
        </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a ng-click="changeTab('entries')" href="<?php //echo $home;?>">home</a></li>
            </ul><!-- .navbar-nav -->

            <ul class="nav navbar-nav navbar-right">
                <!-- <li ng-show="loading"><a href="">Loading...</a></li> -->
                <?php
                    if (isset($_SESSION['database_username'])) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?php echo $_SESSION['database_username']; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li id="logout-btn">Logout</li>
                            </ul>
                        </li>
                <?php } ?>
              
                <li><a href="#" id="search_button" class="location_button fa fa-search"></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

