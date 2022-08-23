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

let categories2 = null;
function init() {
    $.ajax({
        url: "../../assets/utils/admin_portal/add_session_init.php",
        success: function(result) {
            let result_decoded = JSON.parse(result);
            let status = result_decoded.status;

            if(status === "S"){
                let category_box = $('#category1');
                $.each(result_decoded.categories1, function(index, category1) {
                    category_box.append(`<option value="${index}">${category1}</option>`);
                });
                categories2 = result_decoded.categories2;
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
    $('#category2').prop("disabled",true);
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

    $('#add, #add-continue').click(function(e) {
        e.preventDefault();
        let is_valid = validate();
        if(is_valid){
            $.alert({
                title: '<h3 class="text-dark text-center text-monospace mb-1 mt-2">Confirmation</h3>',
                content: '<div>Are you sure you want to add this Career Information?</div>',
                buttons:{
                    OK: function() {
                        let title = $('#title').val().trim();
                        let content = $('#content').val().trim();
                        let category1 = $('#category1').val().trim();
                        let category2 = $('#category2').val().trim();
                        $.ajax({
                            url: "../../assets/utils/admin_portal/add_session.php",
                            type: "POST",
                            data: {
                                title: title,
                                content: content,
                                category1: category1,
                                category2: category2
                            },
                            success: function(result) {
                                let result_decoded = JSON.parse(result);
                                let status = result_decoded.status;

                                if(status === "S"){
                                    if(Number($(e.target).data("continue")) === 1){
                                        location.reload();
                                    }
                                    else{
                                        window.location.href = "index.php";
                                    }
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
                        preview_box.php("");
                        preview_box.append(`<h1>${title}</h1><br>`);
                        preview_box.append(result.converted_text);
                    }
                }
            });
        }
    });
});