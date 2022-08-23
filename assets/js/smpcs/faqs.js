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
			url: '../../assets/utils/smpcs/exportFAQs.php',
			success: function (res) {
				if(res.trim()!=='' && res.trim()!=='F'){
					res=JSON.parse(res);
					console.log(res);
					// let names = [];
					let row = "Question,Answer,Category";
					// for (let i=0 ; i<res.length ; i++){
					// 	names.push(res[i]['name']);
					// }
					// row = row + names.join(',');
					csv = csv+row+'\r\n';
					for(let i=0;i<res.length;i++){
						row = '"'+res[i]['question'].replaceAll('<br>','\n').replaceAll('&nbsp;',' ')+'","'+res[i]['answer'].replaceAll('<br>','\n').replaceAll('&nbsp;',' ')+'","'+res[i]['category']+'"';
						csv = csv+row+'\r\n';
					}
					let file_name = 'FAQs Sheet';
					let uri = 'data:text/csv;charset=utf-8,' + escape(csv);
					let link = document.createElement("a");
					link.href = uri;
					link.style = "visibility:hidden";
					link.download = file_name + ".csv";
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
					$("#download").php('Download FAQs Sheet');
				}
				else {
					$.alert({
						title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
						content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
						buttons:{
							OK: function () {
								$("#download").php('Download FAQs Sheet');
							}
						}
					});
				}
			}
		});
	});

	// $("#download2").click(function () {
	// 	let csv='';
	// 	$(this).php('Processing <i class="fa fa-spinner fa-pulse fa-fw"></i>');
	// 	$.ajax({
	// 		url: '../../assets/utils/smpcs/exportCSV2.php',
	// 		success: function (res) {
	// 			if(res.trim()!=='' && res.trim()!=='F'){
	// 				res=JSON.parse(res);
	// 				csv = '';
	// 				let names = [];
	// 				let row = "Names,Unique Form Code";
	// 				csv = csv + row + '\r\n';
	// 				for(let i=0;i<res.length;i++){
	// 					row = res[i]['name']+',';
	// 					row = row + res[i]['code'];
	// 					csv = csv + row + '\r\n';
	// 				}
	// 				let file_name = 'Unique Codes Sheet';
	// 				let uri = 'data:text/csv;charset=utf-8,' + escape(csv);
	// 				let link = document.createElement("a");
	// 				link.href = uri;
	// 				link.style = "visibility:hidden";
	// 				link.download = file_name + ".csv";
	// 				document.body.appendChild(link);
	// 				link.click();
	// 				document.body.removeChild(link);
	// 				$("#download2").php('Download Unique Codes Sheet');
	// 			}
	// 			else {
	// 				$.alert({
	// 					title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
	// 					content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
	// 					buttons:{
	// 						OK: function () {
	// 							$("#download2").php('Download Unique Codes Sheet');
	// 						}
	// 					}
	// 				});
	// 			}
	// 		}
	// 	});
	// });

	$('#dataTable').DataTable({
		"processing": true,
		"language": {
			"emptyTable": function(){
				return "No FAQs uploaded yet";
			}
		},
		"pageLength": 50,
		"select": true,
		"dom": ' <"search"fl><"top">rt<"bottom"ip><"clear">',
		"ajax": {
			"url": '../../assets/utils/smpcs/getFAQsData.php',
			dataSrc: '',
		},
		"columns": [
			{ "data": "id", className: "dt-body-center" },
			{
				data: {"question":"question"},
				render:function (data){
					return('<div class="scrollable">' + data.question + '</div>');
				},
				className: "dt-body-center"
			},
			{
				data: {"answer":"answer"},
				render:function (data){
					return('<div class="scrollable">' + data.answer + '</div>');
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
				data: {"id":"id"},
				render:function(data){
					return ('<a href="edit_faq.php?id=' + data.id + '" class="btn btn-sm btn-primary mx-1 text-white" title="Edit"><i class="fa fa-pencil"></i></a>' +
						'<button onclick="delete_faq(\'' + data.id + '\')" class="btn btn-sm btn-danger mx-1" title="Delete"><i class="fa fa-trash"></i></button>');
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