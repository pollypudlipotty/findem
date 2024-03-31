<!DOCTYPE html>

<head>
    <html lang="hun">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindEM</title>
    <!-- BOOTSTRAP LINKEK-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/styles/style.css">
    <!-- BETŰTÍPUS -->
    <link href='https://fonts.googleapis.com/css?family=IBM Plex Mono' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/public/functions/functions.js"></script>
</head>

<body>

<div class="container">
    <!--NAVBAR AUTHORIZED-->
    <nav class="navbar navbar-expand-lg bg-primary p-0" data-bs-theme="dark">
        <div id="navbar" class="container-fluid py-3">
            <a href="/home">
                <img id="findemLogo" src="/public/images/findEM_logo2.png" alt="FindEM" class="img-fluid">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./freeDates.html">Szabad időpontok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about_us">Rólunk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Kapcsolat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/seeker_profile">Saját profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/seeker_profile/logout">Kijelentkezés</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <hr class="line">
    </div>