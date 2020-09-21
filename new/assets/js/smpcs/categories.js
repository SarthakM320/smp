// function update(id,status){

// 				$("#"+id).find('button')
// 					.html(((status === '0')?('Deactivate'):('Activate')))
// 					.removeClass((status === '0')?'btn-outline-success':'btn-outline-danger')
// 					.addClass((status === '1')?'btn-outline-success':'btn-outline-danger')
// 					.attr('onclick','update(\'' + id + '\',\'' + ((status === '0')?('1'):('0')) + '\')');
// 			}
// 			else{
// 				$.alert({
// 					title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
// 					content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
// 				});
// 			}
// 		}
// 	});
// }
function add_category(){
	$("#modal_header").html('Add Category');
	$("#modal-submit").attr('data-type-value','add');
	$("#category").val('');
	$("#category_modal").modal();
}
function edit_category(id,category){
	$("#modal_header").html('Edit Category');
	$("#modal-submit").attr('data-type-value','edit').attr('data-id',id);
	$("#category").val(category);
	$("#category_modal").modal();
}
function delete_category(id){
	$.ajax({
		url: '../../assets/utils/smpcs/deleteCategory.php',
		type: 'POST',
		data: {
			id: id,
		},
		success: function (res) {
			console.log(res);
			if (res === 'S') {
				$("#"+id).hide();
			} else {
				console.log(res);
				$.alert({
					title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
					content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>'
				});
			}
		}
	});
}
$(document).ready(function () {

	$("#modal-submit").click(function (e) {
		e.preventDefault();
		let type = $(this).attr('data-type-value');
		if(type === 'edit'){
			let id = $(this).attr('data-id');
			let category = $("#category").val().trim();
			$.ajax({
				url: '../../assets/utils/smpcs/updateCategory.php',
				type: 'POST',
				data: {
					id: id,
					category: category,
				},
				success: function (res) {
					console.log(res);
					if (res === 'S') {
						window.location.reload();
					} else {
						console.log(res);
						$.alert({
							title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
							content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>'
						});
					}
				}
			});
		}
		else{
			let category = $("#category").val().trim();
			$.ajax({
				url: '../../assets/utils/smpcs/addCategory.php',
				type: 'POST',
				data: {
					category: category,
				},
				success: function (res) {
					console.log(res);
					if (res === 'S') {
						window.location.reload();
					} else {
						console.log(res);
						$.alert({
							title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
							content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>'
						});
					}
				}
			});
		}
	})

	$('#dataTable').DataTable({
		"processing": true,
		"language": {
			"emptyTable": function(){
				return "No Categories uploaded yet";
			}
		},
		"pageLength": 50,
		"select": true,
		"dom": ' <"search"fl><"top">rt<"bottom"ip><"clear">',
		"ajax": {
			"url": '../../assets/utils/smpcs/getCategoriesData.php',
			dataSrc: '',
		},
		"columns": [
			{ "data": "id", className: "dt-body-center" },
			{
				data: {"category":"category"},
				render:function (data){
					return('<div class="scrollable">' + data.category + '</div>');
				},
				className: "dt-body-center"
			},
			{
				data: {"id":"id","category":"category"},
				render:function(data){
					return ('<button onclick="edit_category(\'' + data.id + '\',\'' + data.category + '\')" class="btn btn-sm btn-primary mx-1" title="Edit"><i class="fa fa-pencil"></i></button>' +
						'<button onclick="delete_category(\'' + data.id + '\')" class="btn btn-sm btn-danger mx-1" title="Delete"><i class="fa fa-trash"></i></button>');
				},
				className: "dt-body-center"
			}
		],
		"columnDefs": [
			{ className: "text-center", "targets": [0] },
			{ className: "text-center", "targets": [1] },
			{ className: "text-center", "targets": [2] },
			// {
			// 	className: "text-center", "targets": [1] ,
			// 	'createdCell':  function (td, cellData, rowData, row, col) {
			// 		$(td).css('text-transform','capitalize');
			// 	}
			// },
			// {
			// 	className: "text-center", "targets": [2] ,
			// 	'createdCell':  function (td, cellData, rowData, row, col) {
			// 		$(td).addClass('text-monospace');
			// 		$(td).css('letter-spacing','2px');
			// 		if(cellData.active === '0'){
			// 			$(row).addClass('bg-dark');
			// 		}
			// 	}
			// },
			// { className: "text-center", "targets": [3] },
		],
	});
});