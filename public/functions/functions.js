function loadProviderForm() {
    $('.provider_form').toggle();
}

function sortCategoriesHome(categoryId) {

    $.ajax({
        type: "POST",
        url: '/home/sortCategories',
        data: {categoryId: categoryId},
        success: function (response) {
            let parsedData = JSON.parse(response)
            let htmlContent = ''

            if (parsedData.length !== 0) {
                for (let data of parsedData) {
                    htmlContent += '<div class="col-md-4">\n' +
                        '                <div class="card m-5">\n' +
                        '                    <div class="card-body">\n' +
                        '                        <h5 class="card-title">' + data.category_name + '</h5>\n' +
                        '                        <hr>\n' +
                        '                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: ' + data.appointmentTime + '</h6>\n' +
                        '                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>kerület: ' + data.service_district + '.</h6>\n' +
                        '                        <h6 class="card-subtitle mb-2 text-body-secondary"><span>megjegyzés: ' + data.service_description + '</h6>\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '            </div>'
                }
            } else {
                htmlContent += '<div class="text-center my-5">' +
                    '               <h4>Ebben a kategóriában éppen nincsen foglalható időpont.</h4>\n' +
                    '               <br><h5>Látogass vissza később!</h5>\n' +
                    '           </div>'
            }
            $('.category-sort').html(htmlContent)
        },
        error: function () {
            window.alert("Valami hiba történt.")
        }
    })
}

$(document).ready(function () {

    $('#email-r, #email-l, #last_name, #first_name, #oldPassword, #newPassword, #newPasswordAgain, #pass, #pass1, #pass2, #service_category, #company_name, #company_district, #company_street, #company_description, #company_housenumber').on('blur', function () {
        validateField($(this));
    });


    // If provider
    $('#provider_check').on('change', function () {
        $('.provider_form').toggle($(this).is(':checked'));
    });

    function validateField(field) {
        var fieldValue = (field.val() || '').trim();
        var fieldName = field.attr('name');
        var isValid = true;
        var errorMessage = '';

        hideError(field);

        // If empty
        if (fieldValue === '') {
            errorMessage = 'Kérjük, töltse ki ezt a mezőt';
            isValid = false;
        } else {
            // Validation for email
            if (fieldName === 'email') {
                var emailPattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!emailPattern.test(fieldValue)) {
                    errorMessage = 'Kérjük, egy valós e-mail címet írjon be';
                    isValid = false;
                }
            }

            //Validation for names to only contain letters
            if (fieldName === 'first_name' || fieldName === 'last_name') {
                var namePattern = /^[A-Za-zÁáÉéÍíÓóÖöŐőÚúÜüŰű]+$/;
                if (!namePattern.test(fieldValue)) {
                    errorMessage = 'A nevek csak betűket tartalmazhatnak';
                    isValid = false;
                }
            }

            // Password match validation
            if (fieldName === 'pass2') {
                var pass1Value = $('#pass1').val();
                if (fieldValue !== pass1Value) {
                    errorMessage = 'A jelszavak nem egyeznek.';
                    isValid = false;
                }
            }

            if (fieldName === 'newPassword') {
                var newPAValue = $('#newPasswordAgain').val();
                if (fieldValue !== newPAValue) {
                    errorMessage = 'A jelszavak nem egyeznek.';
                    isValid = false;
                }
            }

            // Password criteria validation
            if (fieldName === 'pass1' || fieldName === 'pass2' || fieldName === 'pass') {
                var passwordPattern = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])([a-zA-Z0-9]{6,10})+$/;
                if (!passwordPattern.test(fieldValue)) {
                    errorMessage = 'A jelszó nem felel meg a követelményeknek (legalább 6 karakter, egy nagybetű, egy kisbetű és egy szám).';
                    isValid = false;
                }
            }
        }
        // Provider specific fields validation
        if ($('#provider_check').is(':checked')) {
            switch (fieldName) {
                case 'service_category':
                case 'company_name':
                case 'company_district':
                case 'company_street':
                case 'company_housenumber':
                    if (fieldValue === '') {
                        errorMessage = 'Kérjük, töltse ki ezt a mezőt';
                        isValid = false;
                    }
                    break;
                case 'company_description':
                    if (fieldValue === '') {
                        errorMessage = 'Kérjük, mutassa be pár mondatban a céget';
                        isValid = false;
                    }
                    break;
            }

        }

        if (fieldName === 'company_street') {
            var namePattern = /^[A-Za-zÁáÉéÍíÓóÖöŐőÚúÜüŰű\s.]+$/;
            if (!namePattern.test(fieldValue)) {
                errorMessage = 'Az utca neve csak betűket tartalmazhat';
                isValid = false;
            }
        }

        if (fieldName === 'company_housenumber') {
            var housenumberPattern = /^[\w\d\s./ÁáÉéÍíÓóÖöŐőÚúÜüŰű]+$/;
            if (!housenumberPattern.test(fieldValue)) {
                errorMessage = 'Kérjük, érvényes házszámot adjon meg';
                isValid = false;
            }
        }

        // If field is pass1, show custom message on click
        if (fieldName === 'pass1') {
            field.off('click').on('click', function () {
                $('#errorMessages').empty().append('<div class="alert alert-info">A jelszónak legalább 6 karakter hosszúnak kell lennie és tartalmaznia kell legalább egy nagybetűt, egy kisbetűt és egy számot.</div>');
            });
        }

        if (!isValid) {
            showError(field, errorMessage);
            return false;
        }

        return true;
    }

    // Show error message
    function showError(field, message) {
        field.addClass('is-invalid');
        field.next('.invalid-feedback').text(message);

        // Append error message to #errorMessages container
        $('#errorMessages').append('<div class="alert alert-danger">' + message + '</div>');
    }

    function hideError(field) {
        field.removeClass('is-invalid');
        field.next('.invalid-feedback').text('');

        $('#errorMessages').find('.alert').remove();
    }

    $('#registrationForm').submit(function (event) {
        event.preventDefault();

        var isValid = true;
        var $inputsToValidate;

        if ($('#provider_check').is(':checked')) {
            $inputsToValidate = $('#registrationForm').find('input, select');
        } else {
            $inputsToValidate = $('#registrationForm').find('input, select').slice(0, 4);
        }

        $inputsToValidate.each(function () {
            if (!validateField($(this))) {
                isValid = false;
            }
        });

        if (isValid) {
            this.submit();
        } else {
            alert('Az összes mező kitöltése kötelező');
        }
    });
});

// <--- TRANSITION --->
function redirectToPage(destinationPage) {
    document.querySelector('.container').classList.add('hide');

    setTimeout(function () {
        window.location.href = destinationPage;
    }, 500);
}

function deleteAppointment(appointmentId) {

    $.ajax({
        type: "POST",
        url: '/service_profile/deleteAppointment',
        data: {appointmentId: appointmentId},
        success: function (response) {
            let parsedData = JSON.parse(response);
            let htmlContent = '';

            if (parsedData.length !== 0) {
                for (let data of parsedData) {
                    htmlContent += '<div class="col-md-4">\n' +
                        '            <div class="card m-5">\n' +
                        '               <div class="card-body">\n' +
                        '                   <h6 class="card-subtitle mb-2 text-body-secondary"><span>időpont: </span>' + data.appointmentTime +
                        '                   </h6>\n' +
                        '                   <h6 class="card-subtitle mb-2 text-body-secondary"><span>ár: </span>' + data.appointment_fee + 'Ft</h6>\n' +
                        '                       <button class="btn btnReserve"\n' +
                        '                           onClick="deleteAppointment(' + data.appointment_id + ');">Törlés</button>\n' +
                        '               </div>\n' +
                        '              </div>\n' +
                        '           </div>';
                }
            } else {
                htmlContent += '<div class="text-center">' +
                    '               <h4>Nincsenek meghírdetett szabad időpontjaid.</h4>\n' +
                    '           </div>';
            }

            $('.free-appointments').html(htmlContent);
        },
        error: function () {
            window.alert("Valami hiba történt.");
        }
    });
}

function displayProfileDel() {
    console.log('del')
    $('.profile-del').toggle();
}

function reserveAppointment(appointmentId) {
    console.log(appointmentId)
    $.ajax({
        type: "POST",
        url: '/appointments/reserveAppointment',
        data: {appointmentId: appointmentId},
        success: function () {
            window.location.href = '/seeker_profile'
        },
        error: function() {
            window.alert("Valami hiba történt.")
        }
    })
}

function sortCategories(categoryId, userRole) {
     $.ajax({
        type: "POST",
        url: '/appointments/sortCategories',
        data: {categoryId: categoryId},
        success: function (response) {
            let parsedData = JSON.parse(response)
            let htmlContent = ''

            if (parsedData.length !== 0) {
                for (let data of parsedData) {
                    htmlContent += `<div class="col-md-4">
                        <div class="card m-5">
                            <div class="card-body">
                                <h5 class="card-title">${data.category_name}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>szolgáltató: </span>${data.service_name}</h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>időpont: </span>${data.appointmentTime}</h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>helyszín: </span>${data.service_district}. kerület, ${data.service_address} ${data.service_housenumber}
                                </h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>ár: </span>${data.appointment_fee}</h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">
                                    <span>megjegyzés: </span>${data.service_description}
                                </h6>
                                ${userRole === 1 ?
                        `<a href="#" class="btn btnReserve" onclick="reserveAppointment(${data.appointment_id});">Foglalás</a>` : ''}
                            </div>
                        </div>
                    </div>`
                }
            } else {
                htmlContent += '<div class="text-center my-5">' +
                    '               <h4>Ebben a kategóriában éppen nincsen foglalható időpont.</h4>\n' +
                    '               <br><h5>Látogass vissza később!</h5>\n' +
                    '           </div>'
            }
            $('.appointment-sort').html(htmlContent)
        },
        error: function () {
            window.alert("Valami hiba történt.")
        }
    })
}
