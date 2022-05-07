function validate(){
    let is_valid = true;
    $('input, select, textarea').each(function() {
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

let categories2 = null;
function init() {
    $.ajax({
        url: "../../assets/utils/admin_portal/edit_session_init.php",
        data: {
            id: getUrlParameter("id")
        },
        success: function(result) {
            let result_decoded = JSON.parse(result);
            let status = result_decoded.status;

            if(status === "S"){
                let session = result_decoded.session;
                let categories1 = result_decoded.categories1;
                categories2 = result_decoded.categories2;

                $('#title').val(session.title);
                $('#content').val(session.content);

                let category1_id = Number(session.category1);
                let category2_id = Number(session.category2);
                let category1_box = $('#category1');
                let category2_box = $('#category2');
                $.each(categories1, function(index, category1) {
                    if(index === category1_id){
                        category1_box.append(`<option selected value="${index}">${category1}</option>`);
                    }
                    else{
                        category1_box.append(`<option value="${index}">${category1}</option>`);
                    }
                });
                $.each(categories2[category1_id], function(index, category2) {
                    if(index === category2_id){
                        category2_box.append(`<option selected value="${index}">${category2}</option>`);
                    }
                    else{
                        category2_box.append(`<option value="${index}">${category2}</option>`);
                    }
                });
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

    $('#category1').change(function() {
        $('#category2').prop("disabled",false);
        let index1 = $(this).val();
        let category_box = $('#category2');
        category_box.empty();
        $.each(categories2[index1], function(index, category2) {
            category_box.append(`<option value="${index}">${category2}</option>`);
        });
    });

    $('select').change(function() {
        $('input, select, textarea').each(function () {
            $(this).removeClass('is-invalid');
            $(this).parent().find('.invalid-feedback').hide();
        });
    });
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
                content: '<div>Are you sure you want to edit this Session?</div>',
                buttons:{
                    OK: function() {
                        let title = $('#title').val().trim();
                        let content = $('#content').val().trim();
                        let category1 = $('#category1').val().trim();
                        let category2 = $('#category2').val().trim();
                        $.ajax({
                            url: "../../assets/utils/admin_portal/edit_session.php",
                            type: "POST",
                            data: {
                                id: getUrlParameter("id"),
                                title: title,
                                content: content,
                                category1: category1,
                                category2: category2
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