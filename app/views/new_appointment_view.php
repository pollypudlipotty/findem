<?php include 'inc/header.php'; ?>

<?php include 'inc/' . $nav; ?>

    <div class="container">
        <!--Új időpont feltöltése-->

        
        <img id="registration-logo" src="/public/images/newAppointment_logo.png" alt="Új időpont feltöltése"
             class="img-fluid mx-auto d-block">

        <div class="row">
            <h2 class="text-center m-b-4 titles"><span>Új időpont feltöltése<span></h2>

        </div>

        <div class="container registrationBox">
            <form action="/new_appointment/addNewAppointment" method="POST">
                <div id="errorMessages"></div>

                <?php if (isset($message) && !empty($message)): ?>
                    <div class="alert alert-danger"><?php echo htmlentities($message); ?></div>
                <?php endif; ?>


                <div class="mb-3">
                    <label for="date" class="form-label">Dátum:</label>
                    <input type="date" class="form-control" id="date" name="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label">Kezdete:</label>
                    <select name="start_time">
                        <?php
                        for ($hour = 7; $hour <= 22; $hour++) {
                            for ($minute = 0; $minute <= 30; $minute += 30) {
                                $time = sprintf('%02d:%02d', $hour, $minute);
                                echo "<option value=\"$time\">$time</option>";
                            }
                        }
                        ?>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="duration" class="form-label">Időtartama (perc):</label>
                    <select name="duration">
                        <?php
                        for ($minute = 30; $minute <= 180; $minute += 30) {
                            $hours = $minute / 60;
                            echo "<option value=\"$hours\">$minute</option>";
                        }
                        ?>
                    </select>


                </div>

                <div class="mb-3">
                    <label for="fee" class="form-label">Ára:</label>
                    <input type="text" class="form-control" id="fee" name="fee">
                </div>

                <button type="submit" class="btn btn-primary" onclick="redirectToPage('')">Időpont feltöltése</button>

            </form>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>
