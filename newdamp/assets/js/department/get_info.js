(function($){
    let table = $('#table-info').data('table');
    if(table){
        table = table.trim();
    }

    let relative_path = $('#path-info').data('path').trim();
    
    $('document').ready(() => {
        $(".root-title").click((event) => {
            let target = event.currentTarget;
            let dropdown = $(target).next();
            let state = dropdown.css('display');
            
            let icon = $(target).children('i');
            if(state === 'none'){
                dropdown.slideToggle('slow');
                icon.removeClass('bx-plus').addClass('bx-minus');
            }
            else{
                dropdown.slideToggle('slow', () => {
                    dropdown.find('.leaf-drop-content').hide();
                    dropdown.find('.leaf-title i').removeClass('bx-minus').addClass('bx-plus');
                });
                icon.removeClass('bx-minus').addClass('bx-plus');
            }
        });
    
        $(".leaf-title").click((event) => {
            let target = event.currentTarget;
            let dropdown = $(target).next();
            let icon = $(target).children('i');
    
            if(Number(dropdown.data("seeked")) === 0){
                let id = Number($(target).parent().attr("id"));
                let location = relative_path + "assets/utils/department/get_info.php";
    
                $.ajax({
                    url: location,
                    data: {
                        table: table,
                        id: id
                    },
                    success: function(result) {
                        let result_decoded = JSON.parse(result);
                        let status = result_decoded.status;
    
                        if(status !== "F"){
                            let entry = result_decoded.result;
                            dropdown.append(entry.content);
                            dropdown.slideToggle('slow');
                            dropdown.data("seeked","1");
                            icon.removeClass('bx-plus').addClass('bx-minus');
                        }
                        else{
                            $.alert({
                                icon: 'bx bx-error',
                                title: 'Error!',
                                content: 'Sorry, there has been a technical problem.',
                                boxWidth: '300px',
                                useBootstrap: false,
                                theme: 'modern',
                                type: 'orange'
                            });
                        }
                    }
                });
            }
            else{
                let state = dropdown.css("display");
                dropdown.slideToggle('slow');
    
                if(state === "none"){
                    icon.removeClass('bx-plus').addClass('bx-minus');
                }
                else{
                    icon.removeClass('bx-minus').addClass('bx-plus');
                }
            }
        });
    
        $('.leaf-drop-content i').click((event) => {
            let target = event.currentTarget;
            let dropdown = $(target).parent();
            let icon = dropdown.prev().children('i');
            dropdown.slideToggle('slow');
            icon.removeClass('bx-minus').addClass('bx-plus');
        });
    })
    
    })(jQuery);