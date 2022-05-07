function validate(){
    let is_valid = true;
    $('input, textarea').each(function() {
        $(this).removeClass('is-invalid');
        $(this).parent().find('.invalid-feedback').hide();
        if(!$(this).val() || $(this).val().trim() === ""){
            $(this).addClass('is-invalid');
            $(this).parent().find('.invalid-feedback').show();
            is_valid = false;
        }
    })
    return is_valid;
}

var getUrlParameter = function getUrlParameter (sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function init() {
    $.ajax({
        url: "../../assets/utils/admin_portal/edit_internship_review_init.php",
        data: {
            id: getUrlParameter("id")
        },
        success: function(result) {
            let result_decoded = JSON.parse(result);
            let status = result_decoded.status;

            if(status === "S"){
                let internship_review = result_decoded.internship_review;
                $('#title').val(internship_review.title);
                $('#content').val(internship_review.content);
            }
            else{
                $.alert({
                    title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
                    content: '<div>Sorry, there has been a technical problem.</div>'
                });
            }
        }
    });
}

$(document).ready(function() {
    init();

    $('input, textarea').keydown(function() {
        $('input, select, textarea').each(function() {
            $(this).removeClass('is-invalid');
            $(this).parent().find('.invalid-feedback').hide();
        })
    });

    $('#edit').click(function(e) {
        e.preventDefault();
        let is_valid = validate();
        if(is_valid){
            $.alert({
                title: '<h3 class="text-dark text-center text-monospace mb-1 mt-2">Confirmation</h3>',
                content: '<div>Are you sure you want to edit this Internship Review?</div>',
                buttons:{
                    OK: function() {
                        let title = $('#title').val().trim();
                        let content = $('#content').val().trim();
                        $.ajax({
                            url: "../../assets/utils/admin_portal/edit_internship_review.php",
                            type: "POST",
                            data: {
                                id: getUrlParameter("id"),
                                title: title,
                                content: content
                            },
                            success: function(result) {
                                let result_decoded = JSON.parse(result);
                                let status = result_decoded.status;

                                if(status === "S"){
                                    window.location.href = "index.php";
                                }
                                else{
                                    $.alert({
                                        title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
                                        content: '<div>Sorry, there has been a technical problem.</div>'
                                    });
                                }
                            }
                        });
                    },
                    CANCEL: function() {}
                }
            });
        }
    });

    $('#preview').click(function() {
        let is_valid = validate();
        if(is_valid){
            let title = $('#title').val().trim();
            let content = $('#content').val().trim();
            $.ajax({
                url: "../../assets/utils/admin_portal/preview.php",
                data: {
                    text: content
                },
                success: function(result) {
                    if(result !== "F"){
                        result = JSON.parse(result);
                        let preview_box = $('#preview_text');
                        preview_box.html("");
                        preview_box.append(`<h1>${title}</h1><br>`);
                        preview_box.append(result.converted_text);
                    }
                }
            });
        }
    });
});