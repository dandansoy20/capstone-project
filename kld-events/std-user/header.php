<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.php" <?php if (!isset($_GET['page']) || $_GET['page'] == 'index')
                            echo 'class="active"'; ?>>Home</a></li>
                        <li><a href="?page=browse" <?php if (isset($_GET['page']) && $_GET['page'] == 'browse')
                            echo 'class="active"'; ?>>Events</a></li>
                        <li><a href="?page=details" <?php if (isset($_GET['page']) && $_GET['page'] == 'details')
                            echo 'class="active"'; ?>>Details</a></li>
                        <li><a href="?page=streams" <?php if (isset($_GET['page']) && $_GET['page'] == 'streams')
                            echo 'class="active"'; ?>>Streams</a></li>
                        <li><a href="?page=profile" <?php if (isset($_GET['page']) && $_GET['page'] == 'profile')
                            echo 'class="active"'; ?>>Profile <img src="assets/images/profile-header.jpg" alt=""></a>
                        </li>
                    </ul>

                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>