<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- import local assets/datatables.min.css -->
	<link rel="stylesheet" href="<?php echo base_url('assets/datatables.min.css'); ?>">
	<!-- import local assets/datatables.min.js -->
	<script src="<?php echo base_url('assets/datatables.min.js'); ?>"></script>
	<title>Document</title>
</head>

<body>
	<?php for ($i = 0; $i < 3; $i++) { ?>
		<div class="block">
			<div class="block-header block-header-default">
				<h3 class="block-title">Documents<small></small></h3>
			</div>
			<div class="block-content block-content-full">

				<div class="col-12">
					<br>
				</div>
				<!-- create tombol import to database on right side -->
				<div class="col-12 text-right">
					<button type="button" class="btn btn-alt-primary" id="save-table-<?php echo $i; ?>" onclick="saveAll(<?php echo $i; ?>)">Save All</button>
					<!-- create whitespace -->

				</div>
				<div class="col-12">
					<br>
				</div>
				<!-- create table to show data from excel -->
				<table id="shift<?php echo $i; ?>" class="table table-bordered table-striped table-vcenter js-dataTable-full ">
					<thead>
						<tr>
							<th class="text-center"></th>
							<th class="d-none d-sm-table-cell">Nama PIC</th>
							<th class="d-none d-sm-table-cell">Shift</th>
							<th class="d-none d-sm-table-cell" style="width: 15%;">Jam</th>
							<th class="text-center" style="width: 15%;">Tersedia</th>
							<th class="text-center" style="width: 15%;">Aktual</th>
							<th class="text-center" style="width: 15%;">No Wo</th>
							<th class="text-center" style="width: 15%;">Part number</th>
							<th class="text-center" style="width: 15%;">ct </th>
							<th class="text-center" style="width: 15%;">Plan cap</th>
							<th class="text-center" style="width: 15%;">actual</th>

							<th class="text-center" style="width: 15%;">act vs cap</th>
							<th class="text-center" style="width: 15%;">Jenis</th>
							<th class="text-center" style="width: 15%;">Proses</th>
							<th class="text-center" style="width: 15%;">Uraian</th>
							<th class="text-center" style="width: 15%;">Minute Breakdown</th>
							<th class="text-center" style="width: 15%;">Reject qty</th>
							<th class="text-center" style="width: 15%;">Reject jenis</th>
							<th class="text-center" style="width: 15%;">Action</th>



						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>

	<?php } ?>

</body>
<!-- script javascript -->
<script>
	let submittedForm = [
		[],
		[],
		[]
	];
	let usedRows = ["Nama PIC", "Shift", "Jam", "Tersedia", "Aktual", "No Wo", "Part number", "ct", "Plan cap", "Actual", "act vs cap", "Jenis", "Proses", "Uraian", "Minute Breakdown", "Reject qty", "Reject jenis", "Action"];
	let selectedPIC = [null, null, null];

	function getFormCell() {

	}




	function refreshDataTableAdd(indexTable) {

		$(`#shift${indexTable}`).DataTable().clear().draw();
		// used row is based on table header row
		let jenis_options = ["persiapan", "sample", "dandori"]
		let proses_options = ["option", "sample", "option3"]

		let pic_list = ["", "PIC 1", "PIC 2", "PIC 3", "PIC 4", "PIC 5", "PIC 6", "PIC 7", "PIC 8", "PIC 9", "PIC 10", ];
		//create row with forms inside it and in column action add button to add row
		var formsCell = [""];
		usedRows.forEach((key) => {
			if (key === "Nama PIC") {
				// create select option from pic_list
				let cell = `<select class="form-control" onChange="setSelectedPIC(this,${indexTable})" id="pic-${indexTable}">`;
				pic_list.forEach((pic) => {
					cell += `<option value="${pic}" ${pic === selectedPIC[indexTable] ? "selected" : ""}>${pic}</option>`;

					// cell += `<option value="${pic}" readonly>${pic}</option>`;
				});
				cell += "</select>";
				formsCell.push(cell);

				// formsCell.push('<select class="form-control" id="pic-' + indexTable + '"><option value="active" selected>Pilih PIC</option><option value="processing">Diproses</option></select>');
			} else if (key === "Shift") {
				formsCell.push(`<input type="text" class="form-control" value='Shift ${indexTable+1}' id="shift-${indexTable}" readonly>`);
			} else if (key === "Jam") {
				formsCell.push('<input type="text" class="form-control" value="static" id="jam-' + indexTable + '" readonly>');
			} else if (key === "Tersedia") {
				formsCell.push('<input type="text" class="form-control" id="tersedia-' + indexTable + '" value="80" readonly>');
			} else if (key === "Aktual") {
				formsCell.push('<input type="text" class="form-control" id="aktual-' + indexTable + '" value="70" readonly> ');
			} else if (key === "No Wo") {
				formsCell.push('<input type="text" class="form-control" id="no_wo-' + indexTable + '" value="saddadasd"  readonly>');
			} else if (key === "Part number") {
				formsCell.push('<input type="text" class="form-control" id="part_number-' + indexTable + '" value="saddadasd"  readonly>');
			} else if (key === "ct") {
				formsCell.push('<input type="text" class="form-control" id="ct-' + indexTable + '" value="3,5"  readonly>');
			} else if (key === "Plan cap") {
				formsCell.push('<input type="text" class="form-control" id="plan_cap-' + indexTable + '" value="166" readonly>');
			} else if (key === "Actual") {
				formsCell.push('<input type="text" class="form-control" id="actual-' + indexTable + '" value="">');
			} else if (key === "act vs cap") {
				formsCell.push('<input type="text" class="form-control" id="act_vs_cap-' + indexTable + '" value="51%" readonly>');
			} else if (key === "Jenis") {
				// create multiple select option from jenis_options
				let cell = `<select class="form-control" id="jenis-${indexTable}">`;
				jenis_options.forEach((jenis) => {
					cell += `<option value="${jenis}">${jenis}</option>`;
				});
				cell += "</select>";
				formsCell.push(cell);

			} else if (key === "Proses") {
				// create select option from proses_options
				let cell = `<select class="form-control" id="proses-${indexTable}">`;
				proses_options.forEach((proses) => {
					cell += `<option value="${proses}">${proses}</option>`;
				});
				cell += "</select>";
				formsCell.push(cell);
			} else if (key === "Uraian") {
				formsCell.push('<input type="text" class="form-control" id="uraian-' + indexTable + '" >');
			} else if (key === "Minute Breakdown") {
				formsCell.push('<input type="text" class="form-control" id="minute_breakdown-' + indexTable + '" value="12" readonly>');
			} else if (key === "Reject qty") {
				formsCell.push('<input type="text" class="form-control" id="reject_qty-' + indexTable + '" >');
			} else if (key === "Reject jenis") {
				formsCell.push('<input type="text" class="form-control" id="reject_jenis-' + indexTable + '" >');
			} else if (key === "Action") {
				formsCell.push('<button type="button" class="btn btn-primary" onclick="addThisRow(' + indexTable + ')">Add</button>');
			} else {
				formsCell.push('<input type="text" class="form-control" id="' + key + '-' + indexTable + '" >');
			}
		});

		$(`#shift${indexTable}`).DataTable().row.add(formsCell).draw();

		submittedForm[indexTable].forEach(function callback(row, index) {
			//usinf datatable add every row
			var cells = [(index + 1)];
			usedRows.forEach((key) => {
				if (key === "Nama PIC") {
					// create select option from pic_list and set selected value
					let cell = `<select class="form-control" id="pic-${index}-${indexTable}" readonly>`;
					pic_list.forEach((pic) => {
						cell += `<option value="${pic}" ${pic === row[key] ? "selected" : ""}>${pic}</option>`;
					});
					cell += "</select>";
					cells.push(cell);

					// formsCell.push('<select class="form-control" id="pic-' + indexTable + '"><option value="active" selected>Pilih PIC</option><option value="processing">Diproses</option></select>');
				} else if (key === "Shift") {
					cells.push(`<input type="text" class="form-control" value='${row[key]}' id="shift-${indexTable}" readonly>`);
				} else if (key === "Jam") {
					cells.push('<input type="text" class="form-control" value="static" id="jam-' + index + '-' + indexTable + '" readonly>');
				} else if (key === "Tersedia") {
					cells.push('<input type="text" class="form-control" id="tersedia-' + index + '-' + indexTable + '" value="' + row[key] + '" readonly>');
				} else if (key === "Aktual") {
					cells.push('<input type="text" class="form-control" id="aktual-' + indexTable + '" value="' + row[key] + '" readonly> ');
				} else if (key === "No Wo") {
					cells.push('<input type="text" class="form-control" id="no_wo-' + index + '-' + indexTable + '" value="' + row[key] + '"  readonly>');
				} else if (key === "Part number") {
					cells.push('<input type="text" class="form-control" id="part_number-' + indexTable + '" value="' + row[key] + '"  readonly>');
				} else if (key === "ct") {
					cells.push('<input type="text" class="form-control" id="ct-' + index + '-' + indexTable + '" value="' + row[key] + '"  readonly>');
				} else if (key === "Plan cap") {
					cells.push('<input type="text" class="form-control" id="plan_cap-' + index + '-' + indexTable + '" value="' + row[key] + '" readonly>');
				} else if (key === "Actual") {
					cells.push('<input type="text" class="form-control" id="actual-' + index + '-' + indexTable + '" value="' + row[key] + '">');
				} else if (key === "act vs cap") {
					cells.push('<input type="text" class="form-control" id="act_vs_cap-' + index + '-' + indexTable + '" value="' + row[key] + '" readonly>');
				} else if (key === "Jenis") {
					// create multiple select option from jenis_options
					let cell = `<select class="form-control" id="jenis-${index}-${indexTable}">`;
					jenis_options.forEach((jenis) => {
						// set selected true if jenis is in jenis_options on submittedForm
						cell += `<option value="${jenis}" ${row[key].includes(jenis) ? "selected" : ""}>${jenis}</option>`;
						// cell += `<option value="${jenis}">${jenis}</option>`;
					});
					cell += "</select>";
					cells.push(cell);
				} else if (key === "Proses") {
					// create select option from proses_options
					let cell = `<select class="form-control" id="proses-${index}-${indexTable}">`;
					proses_options.forEach((proses) => {
						// set selected true if jenis is in jenis_options on submittedForm
						cell += `<option value="${proses}" ${row[key].includes(proses) ? "selected" : ""}>${proses}</option>`;

						// cell += `<option value="${proses}">${proses}</option>`;
					});
					cell += "</select>";
					cells.push(cell);
				} else if (key === "Uraian") {
					cells.push('<input type="text" class="form-control" value="' + row[key] + '" id="uraian-' + index + '-' + indexTable + '" >');
				} else if (key === "Minute Breakdown") {
					cells.push('<input type="text" class="form-control" id="minute_breakdown-' + index + '-' + indexTable + '" value="' + row[key] + '" readonly>');
				} else if (key === "Reject qty") {
					cells.push('<input type="text" class="form-control" value="' + row[key] + '" id="reject_qty-' + index + '-' + indexTable + '" >');
				} else if (key === "Reject jenis") {
					cells.push('<input type="text" class="form-control" value="' + row[key] + '" id="reject_jenis-' + index + '-' + indexTable + '" >');
				} else if (key === "Action") {
					cells.push("<button class='btn btn-danger btn-sm' onClick='deleteThisRow(" + index + "," + indexTable + ")'><i class='fa fa-trash'></i>delete</button>");

					// cells.push('<button type="button" class="btn btn-primary" onclick="addRow(' + index + ')">Add</button>');
				} else {
					cells.push('<input type="text" class="form-control" value="' + row[key] + '" id="' + key + '-' + index + '-' + indexTable + '">');
				}
			});
			// add icon button to delete row using jquery $("table tr:eq(2)").remove();
			// cells.push("<button class='btn btn-danger btn-sm' onClick='deleteThisRow(" + index + ")'><i class='fa fa-trash'></i></button>");

			$(`#shift${indexTable}`).DataTable().row.add(cells).draw();
		})
	}

	function setSelectedPIC(selectObject, indexTable) {
		// get value from select option and set all select option to that value
		// let selected = $(`#shift${indexTable} select[name="Nama PIC"]`).val();
		var value = selectObject.value;
		selectedPIC[indexTable] = value;
		console.log(value);
		// set all submited form to that value
		submittedForm[indexTable] = submittedForm[indexTable].map((row) => {
			row["Nama PIC"] = value;
			return row;
		});


		console.log(submittedForm[indexTable]);

		// refresh datatable delayed
		setTimeout(() => {
			refreshDataTableAdd(indexTable);
		}, 100);
		// set selectObject to that value
		// $(`#shift${indexTable} select[name="Nama PIC"]`).val(value);



	}

	function saveAll(indexTable) {
		console.log(submittedForm[indexTable]);
		var jsonObjects = [];
		submittedForm[indexTable].forEach(function callback(row, index) {
			var jsonObject = {};
			usedRows.forEach((key) => {
				if (key === "Action") {

				} else if (typeof(row[key]) === 'undefined') {
					// change key to lowecase and replace space with underscore
					let label = key.toLowerCase().replace(/ /g, "_");
					jsonObject[label] = "";
				} else { // change key to lowecase and replace space with underscore
					let label = key.toLowerCase().replace(/ /g, "_");

					jsonObject[label] = row[key];
				}
			});
			jsonObjects.push(jsonObject);
		});
		console.log(JSON.stringify(jsonObjects));
		// var usedRows = ["nama_alat", "pabrik_pembuat", "kapasitas", "lokasi", "no_seri", "no_perijinan", "expired_date"];
		//then post raw json data to  document/imports
		$.ajax({
			url: `form/submit/${indexTable}`,
			type: 'POST',
			data: JSON.stringify(jsonObjects),
			success: function(data) {
				console.log(data);
				alert('success');
				//then locate to root path /
				// window.location.href = '<?php echo base_url(); ?>';
			},
			error: function(data) {
				console.log(data);
				// alert('error');
			},
		});
	}

	function deleteThisRow(index, indexTable) {
		submittedForm[indexTable].splice(index, 1);

		// console.log(index);
		// console.log($(`#shift${indexTable}`).DataTable().row(index).data());
		refreshDataTableAdd(indexTable);

	}

	function addThisRow(indexTable) {
		//get data from first cell form in datatable
		let nama_pic = $(`#pic-${indexTable}`).val();
		let shift = $(`#shift-${indexTable}`).val();
		let jam = $(`#jam-${indexTable}`).val();
		let tersedia = $(`#tersedia-${indexTable}`).val();
		let aktual = $(`#aktual-${indexTable}`).val();
		let no_wo = $(`#no_wo-${indexTable}`).val();
		let part_number = $(`#part_number-${indexTable}`).val();
		let ct = $(`#ct-${indexTable}`).val();
		let plan_cap = $(`#plan_cap-${indexTable}`).val();
		let actual = $(`#actual-${indexTable}`).val();
		let act_vs_cap = $(`#act_vs_cap-${indexTable}`).val();
		let jenis = $(`#jenis-${indexTable}`).val();
		let proses = $(`#proses-${indexTable}`).val();
		let uraian = $(`#uraian-${indexTable}`).val();
		let minute_breakdown = $(`#minute_breakdown-${indexTable}`).val();
		let reject_qty = $(`#reject_qty-${indexTable}`).val();
		let reject_jenis = $(`#reject_jenis-${indexTable}`).val();

		// push data to submittedForm array based on indexTable
		submittedForm[indexTable].push({
			"Nama PIC": nama_pic,
			"Shift": shift,
			"Jam": jam,
			"Tersedia": tersedia,
			"Aktual": aktual,
			"No Wo": no_wo,
			"Part number": part_number,
			"ct": ct,
			"Plan cap": plan_cap,
			"Actual": actual,
			"act vs cap": act_vs_cap,
			"Jenis": jenis,
			"Proses": proses,
			"Uraian": uraian,
			"Minute Breakdown": minute_breakdown,
			"Reject qty": reject_qty,
			"Reject jenis": reject_jenis,
		});
		// console.log(submittedForm);
		refreshDataTableAdd(indexTable);




	}

	$(document).ready(function() {
		for (let i = 0; i < 3; i++) {
			// console.log(i);
			refreshDataTableAdd(i);
		}

	});
</script>

</html>
