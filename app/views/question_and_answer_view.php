<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

 <!--GYIK-->

<div class="container">

    <img src="/public/images/QandA_logo.png" alt="About Us" class="img-fluid mx-auto d-block aboutUs-logo">

    <div class="row">
        <h2 class="text-center m-b-4 titles"><span>Gyakori kérdések és válaszok<span></h2>
    </div>

    <div class="accordion accordion-flush mt-4 mb-4" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed questionBox" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Hogyan tudok időpontot foglalni? 
            </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Az időpont foglaláshoz be kell jelentkezned.</div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed questionBox" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Hogyan adhatok fel hirdetést? 
                </button>
            </h2>
             <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">A regisztáció során jelöld be, hogy szolgáltatóként is regisztálsz. Bejelentkezés után az időpont feltöltés gonbra kattinva már egyszerűen feladhatsz hirdetést.</div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed questionBox" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Több időpontra is foglalhatok egyszerre?
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Egyszerre több időpontra is foglalhatsz, csak ne felejts el elmeni rájuk:)</div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>