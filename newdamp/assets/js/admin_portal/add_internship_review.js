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

$(document).ready(function() {
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
                content: '<div>Are you sure you want to add this Internship Review?</div>',
                buttons:{
                    OK: function() {
                        let title = $('#title').val().trim();
                        let content = $('#content').val().trim();
                        $.ajax({
                            url: "../../assets/utils/admin_portal/add_internship_review.php",
                            type: "POST",
                            data: {
                                title: title,
                                content: content
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
                        preview_box.html("");
                        preview_box.append(`<h1>${title}</h1><br>`);
                        preview_box.append(result.converted_text);
                    }
                }
            });
        }
    });
});