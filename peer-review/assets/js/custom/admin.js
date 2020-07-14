function update(id,status){
	$.ajax({
		url: '../assets/utils/custom/updateStatus.php',
		type: 'POST',
		// async:false,
		data: {
			id:id,
			active:status
		},
		success: function (res) {
			console.log(res);
			if (res === 'S'){
				$("#"+id).find('button')
					.html(((status === '0')?('Deactivate'):('Activate')))
					.removeClass((status === '0')?'btn-outline-success':'btn-outline-danger')
					.addClass((status === '1')?'btn-outline-success':'btn-outline-danger')
					.attr('onclick','update(\'' + id + '\',\'' + ((status === '0')?('1'):('0')) + '\')');
			}
			else{
				$.alert({
					title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
					content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
				});
			}
		}
	});
}

$(document).ready(function () {
	$(".custom-file-input").on("change", function() {
		let fileName = $(this).val().split("\\").pop();
		if(fileName.trim()!=='') $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		else $(this).siblings(".custom-file-label").removeClass("selected").html('Choose file');
	});

	function validate(){
		$('input').each(function () {
			$(this).removeClass('is-invalid');
			$(this).parent().parent().parent().find('.invalid-feedback').hide();
			if($(this).val() === '') {
				$(this).addClass('is-invalid');
				$(this).parent().parent().parent().find('.invalid-feedback').show();
			}
		});
	}

	$('input').on('input',function () {
		$(this).removeClass('is-invalid');
		$(this).parent().parent().parent().find('.invalid-feedback').hide();
	})

	$("#upload").click(function () {
		let csv=$("#csv").val();
		validate();
		if (csv!=='') {
			$(this).html('Uploading <i class="fa fa-spinner fa-pulse fa-fw"></i>');
			let myFormData = new FormData();
			myFormData.append('csv',$('#csv')[0].files[0]);
			$.ajax({
				url: '../assets/utils/custom/importCSV.php',
				type: 'POST',
				processData: false,
				contentType: false,
				data: myFormData,
				success: function (res) {
					console.log(res);
					if (res === 'invalid_format'){
						csv.addClass('is-invalid');
						csv.parent().parent().parent().find('.invalid-feedback').show();
					}
					else if (res === 'S'){
						$.confirm({
							title: '<h3 class="text-success text-monospace mb-1 mt-2" style="font-weight: bold">Success</h3>',
							content: '<div class="fontOpenSansRegular">Data is uploaded Successfully</div>',
							buttons: {
								OK: function () {
									window.location.reload();
								}
							}
						});
					}
					else{
						$.alert({
							title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
							content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
						});
					}
				}
			});
		}
	});

	$("#download").click(function () {
		let csv='';
		$(this).html('Processing <i class="fa fa-spinner fa-pulse fa-fw"></i>');
		$.ajax({
			url: '../assets/utils/custom/exportCSV.php',
			success: function (res) {
				if(res.trim()!=='' && res.trim()!=='F'){
					res=JSON.parse(res);
					console.log(res);
					let names = [];
					let row = "Names,";
					for (let i=0 ; i<res.length ; i++){
						names.push(res[i]['name']);
					}
					row = row + names.join(',');
					csv = csv+row+'\r\n';
					for(let i=0;i<res.length;i++){
						row = res[i]['name']+',';
						if(res[i]['peer_ids'].trim()!==''){
							let pids = res[i]['peer_ids'].trim().split(",");
							console.log(pids);
							if(res[i]['data'] === null || res[i]['data'] === 'null'){
								for(let j=0;j<res.length;j++){
									if(pids.includes((j+1).toString())){
										row=row+'Not Submitted';
										row = row + ',';
									}
									else {
										row = row + ',';
									}
								}
								row = row.slice(0, -1);
							}
							else{
								console.log(res[i]['data']);
								let pdata = JSON.parse(res[i]['data']);
								console.log(pdata);
								for(let j=0;j<res.length;j++){
									if(pids.includes((j+1).toString())){
										let ind = pids.indexOf((j+1).toString());
										let data= pdata[ind];
										if(data[0] === undefined || data[0] === 'undefined'){
											row=row+'Skipped,';
											continue;
										}
										row=row+'"';
										row=row+'Q1-'+data[0]+',';
										row=row+'Q3-'+data[2]+',';
										row=row+'Q4-'+data[3]+',';
										row=row+'Q5-'+data[4]+',';
										row=row+'Q6-'+data[5]+',';
										row=row+'Q7-'+data[6]+'\n';
										row=row+'Q2-'+data[1]+'\n';
										row=row+'Q8-'+data[7]+'"';
										row = row + ',';
									}
									else {
										row = row + ',';
									}
								}
								row = row.slice(0, -1);
							}
						}
						else{
							for(let j=0;j<res.length;j++){
								row = row + ',';
							}
							row = row.slice(0, -1);
						}
						csv = csv+row+'\r\n';
					}
					let file_name = 'Form Submissions Sheet';
					let uri = 'data:text/csv;charset=utf-8,' + escape(csv);
					let link = document.createElement("a");
					link.href = uri;
					link.style = "visibility:hidden";
					link.download = file_name + ".csv";
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
					$("#download").html('Download Submission Sheet');
				}
				else {
					$.alert({
						title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
						content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
						buttons:{
							OK: function () {
								$("#download").html('Download Submission Sheet');
							}
						}
					});
				}
			}
		});
	});

	$("#download2").click(function () {
		let csv='';
		$(this).html('Processing <i class="fa fa-spinner fa-pulse fa-fw"></i>');
		$.ajax({
			url: '../assets/utils/custom/exportCSV2.php',
			success: function (res) {
				if(res.trim()!=='' && res.trim()!=='F'){
					res=JSON.parse(res);
					csv = '';
					let names = [];
					let row = "Names,Unique Form Code";
					csv = csv + row + '\r\n';
					for(let i=0;i<res.length;i++){
						row = res[i]['name']+',';
						row = row + res[i]['code'];
						csv = csv + row + '\r\n';
					}
					let file_name = 'Unique Codes Sheet';
					let uri = 'data:text/csv;charset=utf-8,' + escape(csv);
					let link = document.createElement("a");
					link.href = uri;
					link.style = "visibility:hidden";
					link.download = file_name + ".csv";
					document.body.appendChild(link);
					link.click();
					document.body.removeChild(link);
					$("#download2").html('Download Unique Codes Sheet');
				}
				else {
					$.alert({
						title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
						content: '<div class="fontOpenSansRegular">Sorry, there has been a technical problem.</div>',
						buttons:{
							OK: function () {
								$("#download2").html('Download Unique Codes Sheet');
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
				return "No data yet uploaded";
			}
		},
		"pageLength": 50,
		"select": true,
		"dom": ' <"search"fl><"top">rt<"bottom"ip><"clear">',
		"ajax": {
			"url": '../assets/utils/custom/getReviewLinkData.php',
			dataSrc: '',
		},
		"columns": [
			{ "data": "id", className: "dt-body-center" },
			{ "data": "name", className: "dt-body-center" },
			{ "data": "code", className: "dt-body-center" },
			{
				data: {"active":"active", "id":"id"},
				render:function(data){
					return ('<button class="btn btn-sm '+ ((data.active==='0')?('btn-outline-success'):('btn-outline-danger')) +' w-100" onclick="update(\'' + data.id + '\',\'' + data.active + '\')">' +
						((data.active==='0')?('Activate'):('Deactivate')) +
							'</button>');
				},
				className: "dt-body-center"
			}
		],
		"columnDefs": [
			{ className: "text-center", "targets": [0] },
			{
				className: "text-center", "targets": [1] ,
				'createdCell':  function (td, cellData, rowData, row, col) {
					$(td).css('text-transform','capitalize');
				}
			},
			{
				className: "text-center", "targets": [2] ,
				'createdCell':  function (td, cellData, rowData, row, col) {
					$(td).addClass('text-monospace');
					$(td).css('letter-spacing','2px');
					if(cellData.active === '0'){
						$(row).addClass('bg-dark');
					}
				}
			},
			{ className: "text-center", "targets": [3] },
		],
	});
});