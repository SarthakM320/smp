// function update(id,status){

// 				$("#"+id).find('button')
// 					.php(((status === '0')?('Deactivate'):('Activate')))
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
function delete_faq(id){
	console.log(id);
	$.alert({
		title: '<h3 class="text-dark text-monospace mb-1 mt-2">Confirmation</h3>',
		content: '<div class="fontOpenSansRegular">Are you sure you want to delete this FAQ?</div>',
		buttons:{
			OK: function () {
				$.ajax({
					url: '../../assets/utils/smpcs/deleteFAQ.php',
					type: 'POST',
					// async:false,
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
			},
			CANCEL: function(){

			}
		}
	});
}
$(document).ready(function () {

	$("#download").click(function () {
		let csv='';
		$(this).php('Processing <i class="fa fa-spinner fa-pulse fa-fw"></i>');
		$.ajax({
			url: '../../assets/utils/smpcs/exportQuery.php',
			success: function (res) {
				if(res.trim()!=='' && res.trim()!=='F'){
					res=JSON.parse(res);
					console.log(res);
					// let names = [];
					let row = "Name,Email,Phone,Query,Category,Is Answered?,Answer,Timestamp";
					// for (let i=0 ; i<res.length ; i++){
					// 	names.push(res[i]['name']);
					// }
					// row = row + names.join(',');
					csv = csv+row+'\r\n';
					for(let i=0;i<res.length;i++){
						row = '"'+res[i]['name']+'","'+res[i]['email']+'","'+res[i]['phone']+'","'+res[i]['query']+'","'+res[i]['category']+'","'+res[i]['answered']+'","'+res[i]['answer']+'","'+res[i]['timestamp']+'","'+'"';
						csv = csv+row+'\r\n';
					}
					let file_name = 'Queries Sheet';
					let uri = 'data:text/csv;charset=utf-8,' + escape(csv);
					let link = document.createElement("a");
					link.href = uri;
					link.style = "visibility:hidden";
					link.download = file_name + ".csv";
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
					$("#download").php('Download Queries Sheet');
				}
				else {
					$.alert({
						title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
						content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
						buttons:{
							OK: function () {
								$("#download").php('Download Queries Sheet');
							}
						}
					});
				}
			}
		});
	});

	$('#dataTable').DataTable({
		"processing": true,
		"language": {
			"emptyTable": function(){
				return "No Queries left unanswered";
			}
		},
		"pageLength": 50,
		"select": true,
		"dom": ' <"search"fl><"top">rt<"bottom"ip><"clear">',
		"ajax": {
			"url": '../../assets/utils/smpcs/getQueryData.php',
			dataSrc: '',
		},
		"order": [[ 0, "desc" ]],
		"columns": [
			{ "data": "id", className: "dt-body-center" },
			{
				data: {"query":"query"},
				render:function (data){
					return('<div class="scrollable">' + data.query + '</div>');
				},
				className: "dt-body-center"
			},
			{
				data: {"category":"category"},
				render:function (data){
					return('<div class="scrollable">' + data.category + '</div>');
				},
				className: "dt-body-center"
			},
			{
				data: {"email":"email"},
				render:function (data){
					return('<div class="scrollable">' + data.email + '</div>');
				},
				className: "dt-body-center"
			},
			{
				data: {"timestamp":"timestamp"},
				render:function (data){
					let date = new Date(data.timestamp);
					return('<div class="scrollable">' + date.getDate() + '/' + (date.getMonth()+1) + '/' +date.getFullYear() + '</div>');
				},
				className: "dt-body-center"
			},
			{
				data: {"id":"id"},
				render:function(data){
					return ('<button class="btn btn-sm btn-outline-success w-100" onclick="window.location.href=\'answer.php?id=' + data.id + '\'">Answer</button>');
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
			{ className: "text-center", "targets": [3] },
		],
	});
});