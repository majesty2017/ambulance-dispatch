/**
 * DataTables Basic
 */

$(function () {
    'use strict';

    var dt_basic_table = $('.datatables-basic'),
        dt_date_table = $('.dt-date'),
        assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }

    // DataTable with buttons
    // --------------------------------------------------------------------
        var dt_basic
    if (dt_basic_table.length) {
            dt_basic = dt_basic_table.DataTable({
            processing: true,
            ajax: '/requests/request-lists',
            columns: [
                {data: 'name'},
                { data: 'phone' },
                { data: 'request_method' },
                { data: 'location' },
                { data: 'message' },
                {
                    data: null,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            `<div class="d-inline-flex">
                            <a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">
                            ${feather.icons['more-vertical'].toSvg({ class: 'font-small-4' })}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:;" class="dropdown-item" onclick="view_e_request('${data.id}')">
                            ${feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' })}
                            Details
                            </a>
                            <a href="javascript:;" onclick="deleteAlert('e', '/request-destroy/', '${data.id}')" class="dropdown-item delete-record">
                            ${feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' })}
                            Delete</a>
                            </div>
                            </div>
                            <a href="javascript:;" onclick="edit_e_request('${data.id}')" class="item-edit">
                            ${feather.icons['edit'].toSvg({ class: 'font-small-4' })}
                            </a>`
                        );
                    }
                }
            ],
            order: ['0', 'asc'],
            dom:
                '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 25,
            lengthMenu: [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, 'All'],
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
                    text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add Emergency Request',
                    className: 'create-new btn btn-primary',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#add-e-request-modal'
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
        $('div.head-label').html('<h6 class="mb-0">Emergency Request Data Table</h6>');
    }

    // Flat Date picker
    if (dt_date_table.length) {
        dt_date_table.flatpickr({
            monthSelectorType: 'static',
            dateFormat: 'm/d/Y'
        });
    }

    // Add New record
    // ? Remove/Update this code as per your requirements ?
    let add_form = $('#add-e-request-form')
    add_form.submit(function (e) {
        e.preventDefault()
        $.ajax({
            url: add_form.attr('action'),
            type: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                if (data.status === 'fail') {
                    let msg = ''
                    $.each(data.error, function (a, b) {
                        msg = b
                        message('error', msg)
                    })
                } else {
                    add_form[0].reset()
                    dt_basic.ajax.reload()
                    hold_modal('add-e-request-modal', 'hide')
                    message('success', data.message)
                }
            }
        })
    })
    let edit_form = $('#edit-e-request-form')
    edit_form.submit(function (e) {
        e.preventDefault()
        $.ajax({
            url: edit_form.attr('action'),
            type: 'post',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                if (data.status === 'fail') {
                    let msg = ''
                    $.each(data.error, function (a, b) {
                        msg = b
                        message('error', msg)
                    })
                } else {
                    edit_form[0].reset()
                    dt_basic.ajax.reload()
                    hold_modal('edit-e-request-modal', 'hide')
                    message('success', data.message)
                }
            }
        })
    })
});
