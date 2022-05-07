function validate(){
    let is_valid = true;
    $('form > div.invalid-feedback').hide();

    $('input, select').each(function() {
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
    $('select').change(function() {
        $('form > div.invalid-feedback').hide();
        $('input, select').each(function() {
            $(this).removeClass('is-invalid');
            $(this).parent().find('.invalid-feedback').hide();
        })
    });
    $('input').keydown(function() {
        $('form > div.invalid-feedback').hide();
        $('input, select').each(function() {
            $(this).removeClass('is-invalid');
            $(this).parent().find('.invalid-feedback').hide();
        })
    });

    $('#submit').click(function(e) {
        e.preventDefault();
        let is_valid = validate();

        if(is_valid){
            let username = $('#username').val().trim();
            let password = $('#password').val().trim();
            let branch = $('#branch').val();
            $.ajax({
                url: "../assets/utils/admin_portal/login.php",
                type: "POST",
                data: {
                    username: username,
                    password: password,
                    branch: branch
                },
                success: function(result) {
                    if(result === "S"){
                        window.location.href = "home.php";
                    }
                    else{
                        $('form > div.invalid-feedback').show();
                    }
                }
            });
        }
    });
});