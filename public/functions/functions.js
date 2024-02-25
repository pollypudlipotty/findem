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
