get_data();

$("#kategori").select2({
	width: "100%",
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

function previewFilename(fileId) {
	const input = document.getElementById(fileId);
	const fileName = input.files[0].name;

	const label = document.querySelector(`label[for=${fileId}]`);
	label.textContent = fileName;
}

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id = button.data("id");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data(" + id + ")");
});

function delete_error() {
	$("#error-nomor").hide();
	$("#error-kategori").hide();
	$("#error-keterangan").hide();
	$("#error-file").hide();
	$("#error-file2").hide();
}

function delete_form() {
	$("[name='nomor']").val("");
	$("#kategori").val("").trigger("change");
	$("[name='keterangan']").val("");
	resetFileInputLabel("file2");
	resetFileInputLabel("file");
}

function resetFileInputLabel(inputId) {
	// Get the input element
	var inputFile = document.getElementById(inputId);

	// Get the label element associated with the input
	var label = inputFile.nextElementSibling;

	// Reset the label text to "Pilih file"
	label.innerHTML = "Pilih file";
}

function get_data() {
	delete_error();
	$.ajax({
		url: base_url + _controller + "/get_data",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#example").DataTable({
				destroy: true,
				scrollY: 320,
				data: data,
				responsive: true,
				columns: [
					{ data: "nomor" },
					{ data: "nama" },
					{ data: "judul" },
					{ data: "created_at" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target=".bs-example-modal-center" title="hapus" data-id="' +
								row.id +
								'"><i class="ion-trash-b"></i></button> ' +
								'<button class="btn btn-success" title="unduh" onclick="downloadFile(\'' +
								row.file_name +
								'\')"><i class="ion-ios7-cloud-download"></i></button> ' +
								'<button class="btn btn-info" data-toggle="modal" data-target="#lihat" title="lihat" onclick="submit(' +
								row.id +
								')"><i class="ion-eye"></i></button>'
							);
						},
					},
				],
				initComplete: function () {
					$("th").css("text-align", "center");
					$("td").css("text-align", "center");
				},
			});
		},
		error: function (xhr, textStatus, errorThrown) {
			console.log(xhr.statusText);
		},
	});
}

function insert_data() {
	var formData = new FormData();
	formData.append("nomor", $("[name='nomor']").val());
	formData.append("kategori", $("#kategori").val());
	formData.append("keterangan", $("[name='keterangan']").val());

	var fileInput = $("[name='file']")[0];
	if (fileInput.files.length > 0) {
		formData.append("file", fileInput.files[0]);
	}

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/insert_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			delete_error();
			if (response.errors) {
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$(".bs-example-modal-lg").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function delete_data(x) {
	$.ajax({
		type: "POST",
		data: "id=" + x,
		dataType: "json",
		url: base_url + _controller + "/delete_data",
		success: function (response) {
			if (response.success) {
				$(".bs-example-modal-center").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
	});
}

function downloadFile(fileName) {
	var downloadUrl = base_url + _controller + "/download_file/" + fileName;

	var link = document.createElement("a");
	link.href = downloadUrl;
	link.download = fileName;
	document.body.appendChild(link);
	link.click();
	document.body.removeChild(link);
}

function submit(x) {
	$.ajax({
		type: "POST",
		data: "id=" + x,
		url: base_url + "/" + _controller + "/get_data_id",
		dataType: "json",
		success: function (hasil) {
			$("[name='id']").val(hasil[0].id);
			$("[name='nomor']").val(hasil[0].nomor);
			$("[name='kategori']").val(hasil[0].nama);
			$("[name='keterangan']").val(hasil[0].judul);
			$("[name='waktu']").val(hasil[0].created_at);
			var url = hasil[0].file_name;
			$("embed").attr("src", base_url + "assets/file/" + url);
			$("#btn-download").data("file-name", url);
		},
	});
	delete_error();
	delete_form();
}

function update_data() {
	var formData = new FormData();
	formData.append("id", $("[name='id']").val());

	var fileInput = $("[name='file2']")[0];
	if (fileInput.files.length > 0) {
		formData.append("file2", fileInput.files[0]);
	}

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/edit_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.errors) {
				delete_error();
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$("#lihat").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
