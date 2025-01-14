<header>
    <?php session_start(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            if (isset($_COOKIE['RECENT_SEARCHES'])) {
                $searches = json_decode($_COOKIE['RECENT_SEARCHES'], true);
                
                if (!(($index = array_search($_POST['search'], $searches)) === false)) {
                    unset($searches[$index]);
                }
                array_unshift($searches, $_POST['search']);
                
                $searches = array_slice($searches, 0, 10);
            } else {
                $searches = array($_POST['search']);
                
            }
            setcookie('RECENT_SEARCHES', json_encode($searches), time() + (86400 * 7), "/");
            header($_SERVER['PHP_SELF']);
        }
    ?>

    <h2>DiscussDen</h2>

    <!-- Tab Box -->
    <div id="tab-box" tabindex=0>
        <?php 
            if ($_SERVER['PHP_SELF'] == '/CCS222-Project/home.php') {
                echo '
                <div class="tab-option" first-option tabindex=-1>
                    <img src="img/home.png" alt="" class="icon">
                    <p>Home</p>
                </div>
                <div class="tab-option" onclick="window.location.href=\'communities.php\'" tabindex=-1>
                    <img src="img/add.png" alt="" class="icon">
                    <p>Communities</p>
                </div>
                <div class="tab-option" onclick="window.location.href=\'trending.php\'" tabindex=-1>
                    <img src="img/trend.png" alt="" class="icon">
                    <p>Trending</p>
                </div>
                ';
            }
            else if ($_SERVER['PHP_SELF'] == '/CCS222-Project/communities.php') {
                echo '
                <div class="tab-option" first-option tabindex=-1>
                    <img src="img/add.png" alt="" class="icon">
                    <p>Communities</p>
                </div>
                <div class="tab-option" onclick="window.location.href=\'home.php\'" tabindex=-1>
                    <img src="img/home.png" alt="" class="icon">
                    <p>Home</p>
                </div>
                <div class="tab-option" onclick="window.location.href=\'trending.php\'" tabindex=-1>
                    <img src="img/trend.png" alt="" class="icon">
                    <p>Trending</p>
                </div>
                ';
            }
            else if ($_SERVER['PHP_SELF'] == '/CCS222-Project/trending.php') {
                echo '
                <div class="tab-option" first-option tabindex=-1>
                    <img src="img/trend.png" alt="" class="icon">
                    <p>Trending</p>
                </div>
                <div class="tab-option" onclick="window.location.href=\'home.php\'" tabindex=-1>
                    <img src="img/home.png" alt="" class="icon">
                    <p>Home</p>
                </div>
                <div class="tab-option" onclick="window.location.href=\'communities.php\'" tabindex=-1>
                    <img src="img/add.png" alt="" class="icon">
                    <p>Communities</p>
                </div>
                ';
            }
        ?>

        <img src="img/drop down.png" alt="" class="dropdown icon">
    </div>

    <!-- Search bar -->
    <form action="" method="post" id="searchbar">
        <!-- Search box -->
        <div id="search-box">
            <!-- This is where the typed suggestion is placed -->
            <section></section> 

            <!-- Recent searches -->
            <?php if (isset($searches)) echo '<p>RECENT SEARCHES</p>' ?>
            <div id="recent-searches">
                <?php
                    if (isset($searches)) {
                        
                        foreach($searches as $search) {
                                echo '<section>' . $search . '</section>';
                        }
                    }
                ?>
            </div>

            <!-- Search suggestions -->
            <p id="search-suggest-label">SEARCH</p>
            <div id="search-suggestions"></div>
        </div>
        
        <img src="img/search.png" alt="" class="icon">
        <input name="search" type="search" placeholder="Search a post or article" autocomplete="off" tabindex=0>
    </form>

    <!-- User Button -->
    <?php if(isset($_SESSION['username'])) {
        echo '
        <div id="user-btn" tabindex=0>
            <svg width=50 height=50>
                <circle cx=25 cy=25 r=25 fill=black />
            </svg>
            <p class="username">' . $_SESSION['username'] . '</p>

            <div class="tab-option" name="logout" tabindex=-1>
                <img src="img/add.png" alt="" class="icon">
                <p>Log out</p>
            </div>
        </div>
        ';
    } else {
        echo '<a href="login.php" tabindex=3>Log In or Sign Up</a>';
    } ?>

    <script src="header.js"></script>
</header>