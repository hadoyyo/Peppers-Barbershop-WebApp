<nav id="navScroll" class="navbar navbar-dark bg-black fixed-top" tabindex="0">
    <div class="container">
        <a class="navbar-brand pe-md-4 fs-4 col-12 col-md-auto mx-auto" href="index.php" style="display:flex;justify-content: center;">
            <img src="img/logo.png" width="340rem">
        </a>
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 list-group list-group-horizontal">
            <li class="nav-item">
                <a class="nav-link fs-5" href="about.php">
                    O nas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fs-5" href="bookings.php" aria-label="A system message page">
                    Umów wizytę
                </a>
            </li>
        </ul>
        <div class="mx-auto">
            <?php if (!empty($userName)): ?>
                <a href="dashboard.php" class="btn custom-btn color-red">
                <i class="bi bi-person-fill"></i>
                <?php echo $userName;
                 ?>
                </a>
            <?php else: ?>
                <a href="login.php" class="btn custom-btn color-red">
                    <small>Zaloguj się</small>
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>