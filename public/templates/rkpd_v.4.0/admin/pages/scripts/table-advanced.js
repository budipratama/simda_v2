

var TableAdvanced = function () {

    var initTable = function () {

        var table = $('#tableUtama');
		
		//var ajax_source_url_tmp = (typeof ajax_source_url != 'undefined')?ajax_source_url:null;
		var ajax_source_field_tmp = (typeof ajax_source_field != 'undefined')?ajax_source_field:null;

        if (typeof ajax_source_url != 'undefined'){
			var oTable = table.dataTable({

				"language": {
					"aria": {
						"sortAscending": ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					},
					"emptyTable": "Tidak ada data pada tabel ini",
					"info": "Data ke _START_ sampai _END_ dari _TOTAL_ data",
					"infoEmpty": "Tidak ada data yang sesuai",
					"infoFiltered": "(hasil pencarian dari _MAX_ data)",
					"lengthMenu": "Tampil _MENU_  baris",
					"search": "Cari: ",
					"zeroRecords": "Tidak ada baris yang sesuai",
					"sProcessing": "<img src='" + site_url + "public/templates/rkpd_v.4.0/admin/layout/img/ajax-loader.gif'>"
				},

				"order": [
					[0, 'asc']
				],
				"lengthMenu": [
					[10, 20, 30, -1],
					[10, 20, 30, "All"] // change per page values here
				],
				"pageLength": 10, // set the initial value,
				"columnDefs": [{  // set default column settings
					'orderable': false,
					'targets': [0]
				}, {
					"searchable": false,
					"targets": [0]
				}],
				"iDisplayLength": 10,
				"serverSide": true,
				"processing": true,
				"ajax": {
					"url" : ajax_source_url,
					"type" : "POST",
				},
				"columns": ajax_source_field_tmp
			});
		} else {
			var oTable = table.dataTable({

				"language": {
					"aria": {
						"sortAscending": ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					},
					"emptyTable": "Tidak ada data pada tabel ini",
					"info": "Data ke _START_ sampai _END_ dari _TOTAL_ data",
					"infoEmpty": "Tidak ada data yang sesuai",
					"infoFiltered": "(hasil pencarian dari _MAX_ data)",
					"lengthMenu": "Tampil _MENU_  baris",
					"search": "Cari: ",
					"zeroRecords": "Tidak ada baris yang sesuai",
					"sProcessing": "<img src='" + site_url + "public/templates/rkpd_v.4.0/admin/layout/img/ajax-loader.gif'>"
				},

				"order": [
					[0, 'asc']
				],
				"lengthMenu": [
					[10, 20, 30, -1],
					[10, 20, 30, "All"] // change per page values here
				],
				"pageLength": 10, // set the initial value,
				"columnDefs": [{  // set default column settings
					'orderable': false,
					'targets': [0]
				}, {
					"searchable": false,
					"targets": [0]
				}]
			});
		}

        var oTableColReorder = new $.fn.dataTable.ColReorder( oTable );

        var tableWrapper = $('#tableUtama_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    }
	
	//Table Custom
	var initTable2 = function () {

        var table = $('#tableCustom');
		
		//var ajax_source_url_tmp = (typeof ajax_source_url != 'undefined')?ajax_source_url:null;
		var ajax_source_field_tmp = (typeof ajax_source_field != 'undefined')?ajax_source_field:null;

        if (typeof ajax_source_url != 'undefined'){
			var oTable = table.dataTable({

				"language": {
					"aria": {
						"sortAscending": ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					},
					"emptyTable": "Tidak ada data pada tabel ini",
					"info": "Data ke _START_ sampai _END_ dari _TOTAL_ data",
					"infoEmpty": "Tidak ada data yang sesuai",
					"infoFiltered": "(hasil pencarian dari _MAX_ data)",
					"lengthMenu": "Tampil _MENU_  baris",
					"search": "Cari: ",
					"zeroRecords": "Tidak ada baris yang sesuai",
					"sProcessing": "<img src='" + site_url + "public/templates/rkpd_v.4.0/admin/layout/img/ajax-loader.gif'>"
				},

				"order": [
					[0, 'asc']
				],
				"lengthMenu": [
					[20, 50, 100, -1],
					[20, 50, 100, "All"] // change per page values here
				],
				"pageLength": 20, // set the initial value,
				"columnDefs": [{  // set default column settings
					'orderable': false,
					'targets': [0]
				}, {
					"searchable": false,
					"targets": [0]
				}],
				"iDisplayLength": 20,
				"serverSide": true,
				"processing": true,
				"ajax": {
					"url" : ajax_source_url,
					"type" : "POST",
				},
				"columns": ajax_source_field_tmp
			});
		} else {
			var oTable = table.dataTable({

				"language": {
					"aria": {
						"sortAscending": ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					},
					"emptyTable": "Tidak ada data pada tabel ini",
					"info": "Data ke _START_ sampai _END_ dari _TOTAL_ data",
					"infoEmpty": "Tidak ada data yang sesuai",
					"infoFiltered": "(hasil pencarian dari _MAX_ data)",
					"lengthMenu": "Tampil _MENU_  baris",
					"search": "Cari: ",
					"zeroRecords": "Tidak ada baris yang sesuai",
					"sProcessing": "<img src='" + site_url + "public/templates/rkpd_v.4.0/admin/layout/img/ajax-loader.gif'>"
				},

				"order": [
					[0, 'asc']
				],
				"lengthMenu": [
					[20, 50, 100, -1],
					[20, 50, 100, "All"] // change per page values here
				],
				"pageLength": 20, // set the initial value,
				"columnDefs": [{  // set default column settings
					'orderable': false,
					'targets': [0]
				}, {
					"searchable": false,
					"targets": [0]
				}]
			});
		}

        var oTableColReorder = new $.fn.dataTable.ColReorder( oTable );

        var tableWrapper = $('#tableCustom_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            console.log('me 1');

            initTable();
            initTable2();

            console.log('me 2');
        }

    };

}();