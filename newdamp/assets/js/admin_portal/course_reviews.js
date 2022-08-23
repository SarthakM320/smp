function delete_course_review(id) {
    $.alert({
        title: '<h3 class="text-dark text-center text-monospace mb-1 mt-2">Confirmation</h3>',
        content: '<div>Are you sure you want to delete this Course Review?</div>',
        buttons:{
            OK: function () {
                $.ajax({
                    url: "../../assets/utils/admin_portal/delete_course_review.php",
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(result) {
                        let result_decoded = JSON.parse(result);
                        let status = result_decoded.status;

                        if(status === "S"){
                            $("#"+id).hide();
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
            CANCEL: function(){}
        }
    });
}

let table = $('#table-info').data('table');
if(table){
    table = table.trim();
}

function show_content(element) {
    let next_element = $(element).next();
    if(Number($(element).data("seeked")) === 0){
        let id = Number($(element).parent().parent().attr("id"));
        $.ajax({
            url: "../../assets/utils/admin_portal/get_info.php",
            data: {
                table: table,
                id: id
            },
            success: function(result) {
                let result_decoded = JSON.parse(result);
                let status = result_decoded.status;

                if(status === "S"){
                    let course_review = result_decoded.result; 
                    next_element.php(course_review.content);
                    next_element.slideToggle('slow');
                    $(element).data("seeked","1");
                    $(element).text("Show less");
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
    else{
        if(next_element.css("display") === "none"){
            $(element).text("Show less");
        }
        else{
            $(element).text("Show more");
        }
        next_element.slideToggle('slow');
    }
}

$(document).ready(function() {
    $('#dataTable').DataTable({
        processing: true,
        responsive: true,
        language: {
            emptyTable: function(){
                return "No Course Reviews uploaded yet";
            }
        },
        pagelength: 25,
        paging: true,
        ajax: {
            "url": "../../assets/utils/admin_portal/get_course_reviews.php",
            dataSrc: "course_reviews",
        },
        columns: [
            {data: "DT_RowId"},
            {data: null,
            render: function(data, type, row) {
                return('<div>' + row.department.toUpperCase() + ' ' + row.code + '</div>');
                }
            },
            {data: "title"},
            {data: "year"},
            {data: null,
            render: function() {
                return('<div onclick="show_content(this)" data-seeked="0" class="text-center" style="background-color: #aaaaaa; cursor: pointer;">Show more</div>' +
                '<div style="max-height: 500px; overflow: auto; display: none;"></div>');
                }
            },
            {data: "category"},
            {data: "DT_RowId",
            render: function(data) {
                return('<a href="edit_course_review.php?id=' + data + '" class="btn btn-sm btn-primary mx-1 text-white">Edit</a>' +
                '<button onclick="delete_course_review(\'' + data + '\')" class="btn btn-sm btn-danger mx-1">Delete</button>');
                }
            }
        ],
        columnDefs: [
            {"responsivePriority": 1, "targets": 1},
            {"responsivePriority": 2, "targets": 2},
            {"responsivePriority": 3, "targets": -1}
        ]
    });
});