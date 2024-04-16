<div class="container">
    <!--NAVBAR AUTHORIZED-->
    <nav class="navbar navbar-expand-lg bg-primary p-0" data-bs-theme="dark">
        <div id="navbar" class="container-fluid py-3">
            <a href="#">
                <img id="findemLogo" src="/public/images/findEM_logo.png" onclick="redirectToPage('/home')" alt="FindEM" class="img-fluid">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectToPage('/appointments')">Szabad időpontok</a>
                    </li>
                    <li class="nav-item">


                        <a class="nav-link" href="#" onclick="redirectToPage('/new_appointment')">Időpont feltöltés</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectToPage('/about_us')">Rólunk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectToPage('/contact')">Kapcsolat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectToPage('/service_profile')">Saját profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="redirectToPage('/service_profile/logout')">Kijelentkezés</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <hr class="line">
    </div>