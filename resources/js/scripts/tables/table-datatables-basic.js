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
            ajax: '/user/user-lists',
            columns: [
                {
                    data: null,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $user_img = data.profile,
                            $name = data.first_name + ' ' + data.last_name,
                            $post = data.qualification;
                        if ($post === null) $post = ''
                        if ($user_img) {
                            // For Avatar image
                            var $output =
                                '<img src="' + assetPath + 'images/profile/user-uploads/' + $user_img + '" alt="Avatar" width="32" height="32">';
                        } else {
                            // For Avatar badge
                            var stateNum = full['status'];
                            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                            var $state = states[stateNum],
                                $name = full['full_name'],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + '</span>';
                        }

                        var colorClass = $user_img === '' ? ' bg-light-' + $state + ' ' : '';
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' mr-1">' +
                            $output +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<span class="emp_name text-truncate font-weight-bold">' +
                            $name +
                            '</span>' +
                            '<small class="emp_post text-truncate text-muted">' +
                            $post +
                            '</small>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                { data: 'email' },
                { data: 'phone' },
                { data: 'qualification' },
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
                            <a href="javascript:;" class="dropdown-item" onclick="view_user('${data.id}')">
                            ${feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' })}
                            Details
                            </a>
                            <a href="javascript:;" onclick="deleteAlert('user', '/user-destroy/', '${data.id}')" class="dropdown-item delete-record">
                            ${feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' })}
                            Delete</a>
                            </div>
                            </div>
                            <a href="javascript:;" onclick="edit_user('${data.id}')" class="item-edit">
                            ${feather.icons['edit'].toSvg({ class: 'font-small-4' })}
                            </a>`
                        );
                    }
                }
            ],
            order: [[0, 'desc']],
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
                    text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add User',
                    className: 'create-new btn btn-primary',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#add-user-modal'
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
        $('div.head-label').html('<h6 class="mb-0">Users Data Table</h6>');
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
    let add_user_form = $('#add-user-form')
    add_user_form.submit(function (e) {
        e.preventDefault()
        $.ajax({
            url: add_user_form.attr('action'),
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
                }
                add_user_form[0].reset()
                dt_basic.ajax.reload()
                hold_modal('add-user-modal', 'hide')
                message('success', data.message)
            }
        })
    })

    let edit_user_form = $('#edit-user-form')
    edit_user_form.submit(function (e) {
        e.preventDefault()
        $.ajax({
            url: edit_user_form.attr('action'),
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
                }
                edit_user_form[0].reset()
                dt_basic.ajax.reload()
                hold_modal('edit-user-modal', 'hide')
                message('success', data.message)
            }
        })
    })
});
