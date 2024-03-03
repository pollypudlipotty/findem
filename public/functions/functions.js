function loadProviderForm() {
    $('.provider_form').toggle();
}

function sortCategories(categoryId) {

    $.ajax({
        type: "POST",
        url: '/home/sortCategories',
        data: {categoryId: categoryId},
        success: function (response) {
            let parsedData = JSON.parse(response);
            let htmlContent = '';

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
                        '            </div>';
                }
            } else {
                htmlContent += '<div class="text-center">' +
                    '               <h3>Ebben a kategóriában éppen nincsen foglalható időpont.</h3>\n' +
                    '               <br><h5>Látogass vissza később!</h5>\n' +
                    '           </div>';
            }
            $('.category-sort').html(htmlContent);
        },
        error: function () {
            window.alert("Valami hiba történt.");
        }
    });
}

$(document).ready(function() {
    
    $('#email-r, #last_name, #first_name, #pass1, #pass2, #service_category, #company_name, #company_district, #company_address, #company_description').on('blur', function() {
        validateField($(this));
    });

    // If provider
    $('#provider_check').on('change', function() {
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
            if(fieldName === 'first_name' || fieldName === 'last_name') {
                var namePattern =  /^[A-Za-zÁáÉéÍíÓóÖöŐőÚúÜüŰű]+$/;
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

            // Password criteria validation
            if (fieldName === 'pass1' || fieldName === 'pass2') {
                var passwordPattern = /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])([a-zA-Z0-9]{6,10})+$/;
                if (!passwordPattern.test(fieldValue)) {
                    errorMessage = 'A jelszó nem felel meg a követelményeknek (legalább 6 karakter, egy nagybetű, egy kisbetű és egy szám).';
                    isValid = false;
                }
            }
        }
            // Provider specific fields validation
        if ($('#provider_check').is(':checked')) {
            switch(fieldName) {
                case 'service_category':
                case 'company_name':
                case 'company_district':
                case 'company_address':
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

        // If field is pass1, show custom message on click
        if (fieldName === 'pass1') {
            field.off('click').on('click', function() {
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
        $('#errorMessages').append('<div class="alert alert-info">' + message + '</div>');
    }

    function hideError(field) {
        field.removeClass('is-invalid');
        field.next('.invalid-feedback').text('');

        $('#errorMessages').find('.alert').remove();
    }

    $('#registrationForm').submit(function(event) {
        event.preventDefault();

        var isValid = true;
        var $inputsToValidate;

        if ($('#provider_check').is(':checked')) {
            $inputsToValidate = $('#registrationForm').find('input, select');
        } else {
            $inputsToValidate = $('#registrationForm').find('input, select').slice(0, 4);
        }

        $inputsToValidate.each(function() {
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