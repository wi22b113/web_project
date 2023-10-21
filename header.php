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
                        <li><a class="dropdown-item" href="./sr_master_suite.php">Master Suite</a></li>
                        <li><a class="dropdown-item" href="./sr_junior_suite.php">Junior Suite</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./sr_superior_room.php">Superior Room</a></li>
                        <li><a class="dropdown-item" href="./sr_luxury_room.php">Luxury Room</a></li>
                        <li><a class="dropdown-item" href="./sr_luxury_e_room.php">Luxury Extended Room</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage === 'Impressum') {echo 'active';} ?>" aria-current="page" href="./impressum.php">Impressum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage === 'Hilfe') {echo 'active';} ?>" aria-current="page" href="./hilfe.php">Hilfe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage === 'Login') {echo 'active';} ?>" aria-current="page" href="./login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($currentPage === 'Registrierung') {echo 'active';} ?>" aria-current="page" href="./register.php">Registrierung</a>
                </li>
            </ul>
        </div>
    </div>
</nav>