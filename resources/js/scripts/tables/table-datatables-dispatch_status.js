/**
 * DataTables Basic
 */

$(function () {
  'use strict';

  var dt_all_table = $('.datatables-dispatch_status'),
      dt_date_table = $('.dt-date'),
      assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_all_table.length) {
    let id = 0
    var dt_basic = dt_all_table.DataTable({
      ajax: '/dispatch_status/dispatch_status-lists',
      columns: [
        { data: '',
        render: function () {
          return ''
        }
        },
        { data: '',
          render: function (data, type, full, meta) {
            if (full.driver.other_name === null) full.driver.other_name = ''
            let name = full.driver.first_name + ' ' + full.driver.other_name + ' ' + full.driver.last_name
            return name
          }
        },
        { data: '',
          render: function (data, type, full, meta) {
            if (full.admin.other_name === null) full.admin.other_name = ''
            let name = full.admin.first_name + ' ' + full.admin.other_name + ' ' + full.admin.last_name
            return name
          }
        },
        { data: '',
          render: function (data, type, full, meta) {
            let name = full.request.name
            return name
          }
        },
        { data: '',
          render: function (data, type, full, meta) {
            if (full.status === 'Available') {
              return `<span class="badge badge-light-success">${full.status}</span>`
            } else {
              return `<span class="badge badge-light-danger">${full.status}</span>`
            }
          }
        },
        { data: '' }
      ],
      columnDefs: [
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
                '<div class="d-inline-flex">' +
                '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-right">' +
                '<a href="javascript:;" onclick="view_dispatch_status('+full.id+')" class="dropdown-item">' +
                feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) +
                'Details</a>' +
                '<a href="javascript:;" onclick="deleteAlert(\'dispatch_status\', \'/destroy/\', '+full.id+')" class="dropdown-item delete-record">' +
                feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                'Delete</a>' +
                '</div>' +
                '</div>' +
                '<a href="javascript:;" onclick="edit_dispatch_status('+full.id+')" class="item-edit">' +
                feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                '</a>'
            );
          }
        }
      ],
      order: [[0, 'asc']],
      dom:
          '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 10,
      lengthMenu: [
          [10, 25, 50, 100, 250, 500, -1],
          [10, 25, 50, 100, 250, 500, "All"]
      ],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle mr-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [3, 4, 5, 6, 7] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add New Dispatch Status',
          className: 'create-new btn btn-primary',
          attr: {
            'data-toggle': 'modal',
            'data-target': '#add-dispatch_status-modal'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              console.log(columns);
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                  ? '<tr data-dt-row="' +
                  col.rowIndex +
                  '" data-dt-column="' +
                  col.columnIndex +
                  '">' +
                  '<td>' +
                  col.title +
                  ':' +
                  '</td> ' +
                  '<td>' +
                  col.data +
                  '</td>' +
                  '</tr>'
                  : '';
            }).join('');

            return data ? $('<table class="table"/>').append(data) : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
    $('div.head-label').html('<h6 class="mb-0">Dispatch Status Info Data Table</h6>');
  }

  // Flat Date picker
  if (dt_date_table.length) {
    dt_date_table.flatpickr({
      monthSelectorType: 'static',
      dateFormat: 'm/d/Y'
    });
  }

//  Create dispatch_status info
  let add_dispatch_status_form = $('#add-dispatch_status-form')
  add_dispatch_status_form.submit(function (e) {
    e.preventDefault()
    $.ajax({
      url: add_dispatch_status_form.attr('action'),
      type: 'post',
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status === 'fail') {
          let msg
          $.each(data.error, function (a, b) {
            msg = b
            message('error', msg)
          })
        }
        add_dispatch_status_form[0].reset()
        dt_basic.ajax.reload()
        message('success', data.message)
        hold_modal('add-dispatch_status-modal', 'hide')
      }
    })
  })

//  Edit dispatch_status info
  let edit_dispatch_status_form = $('#edit-dispatch_status-form')
  edit_dispatch_status_form.submit(function (e) {
    e.preventDefault()
    $.ajax({
      url: edit_dispatch_status_form.attr('action'),
      type: 'post',
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.status === 'fail') {
          let msg
          $.each(data.error, function (a, b) {
            msg = b
            message('error', msg)
          })
        }
        add_dispatch_status_form[0].reset()
        dt_basic.ajax.reload()
        message('success', data.message)
        hold_modal('edit-dispatch_status-modal', 'hide')
      }
    })
  })
});
