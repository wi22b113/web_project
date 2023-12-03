<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Hotel Tramonto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php if ($currentPage === 'SuitesAndRooms') {echo 'active';} ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Suites & Rooms
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./suites_rooms.php?sr=master_suite">Master Suite</a></li>
                        <li><a class="dropdown-item" href="./suites_rooms.php?sr=junior_suite">Junior Suite</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./suites_rooms.php?sr=superior_room">Superior Room</a></li>
                        <li><a class="dropdown-item" href="./suites_rooms.php?sr=luxury_room">Luxury Room</a></li>
                        <li><a class="dropdown-item" href="./suites_rooms.php?sr=luxury_e_room">Luxury Extended Room</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage === 'Posts') {echo 'active';} ?>" aria-current="page" href="./posts.php">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage === 'Impressum') {echo 'active';} ?>" aria-current="page" href="./impressum.php">Impressum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage === 'Hilfe') {echo 'active';} ?>" aria-current="page" href="./hilfe.php">Hilfe</a>
                </li>
                <?php if (!isset($_SESSION["user"])){
                    echo "<li class=\"nav-item\">";
                    echo "<a class=\"nav-link "; 
                    if ($currentPage === 'Registrierung') {echo 'active';} 
                    echo "\" aria-current=\"page\" href=\"./register.php\">Registrierung</a>";
                    echo "</li> ";

                    echo "<li class=\"nav-item\">";
                    echo "<a class=\"nav-link "; 
                    if ($currentPage === 'Login') {echo 'active';} 
                    echo "\" aria-current=\"page\" href=\"./login.php\">Login</a>";
                    echo "</li> ";
                }else{
                    echo "<li class=\"nav-item\">";
                    echo "<a class=\"nav-link "; 
                    if ($currentPage === 'Stammdaten') {echo 'active';} 
                    echo "\" aria-current=\"page\" href=\"./master_data.php\">Stammdaten</a>";
                    echo "</li> ";
                    echo "<li class=\"nav-item\">";
                    echo "<a class=\"nav-link "; 
                    if ($currentPage === 'Buchungen') {echo 'active';} 
                    echo "\" aria-current=\"page\" href=\"./manage_bookings.php\">Buchungen</a>";
                    echo "</li> ";
                    echo "<li class=\"nav-item\">";
                    echo "<a class=\"nav-link "; 
                    if ($currentPage === 'Generate-Post') {echo 'active';} 
                    echo "\" aria-current=\"page\" href=\"./generate_post.php\">Post erstellen</a>";
                    echo "</li> ";
                    echo "<li class=\"nav-item\">";
                    echo "<a class=\"nav-link\""; 
                    echo "aria-current=\"page\" href=\"?logout=true\">Hello " . $_SESSION['firstname'] . ", Logout?</a>";
                    echo "</li> ";
                } 
                ?> 
            </ul>
        </div>
    </div>
</nav>