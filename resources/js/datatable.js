import jQuery from 'jquery';

if (!window.jQuery) { window.$ = window.jQuery = jQuery }

import 'datatables.net';

function factory($, window, document, undefined) {
    'use strict';
    const DataTable = $.fn.dataTable;


    /* Set the defaults for DataTables initialisation */
    $.extend(true, DataTable.defaults, {
        dom:
            "<'w-full flex flex-wrap items-center justify-center lg:justify-between'<'w-full text-center sm:w-1/2 sm:text-left sm:my-1'l><'w-full flex justify-center my-1 sm:justify-end sm:w-1/2'f>>" +
            "<'flex my-4'<'w-full overflow-y-auto'tr>>" +
            "<'flex flex-wrap'<'w-full my-2 sm:w-1/3'i><'w-full sm:w-2/3 text-right'p>>",

        /*dom: "<'flex my-4'<'w-full overflow-y-auto'tr>>" +
            "<'flex justify-center'<p>>",*/
        renderer: 'tailwindcss',
        autoWidth: false
    });

    /* Default class modification */
    $.extend(DataTable.ext.classes, {
        sWrapper: "w-full whitespace-nowrap drag-scroll",
        sTable: "w-full datatable bg-white",
        sFilter: "py-2 lg:py-0",
        sFilterInput: "p-2 ml-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50",
        sLength: "",
        sLengthSelect: "border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm",
        // sProcessing: "w-full p-4 text-center bg-blue-200",
        sProcessing: "absolute top-[50%] left-[50%] w-[200px] -ml-[100px] -mt-[26px] text-center p-1 z-10",
        sFooterTH: "p-2 font-semibold border border-gray-300",
        sHeaderTH: "relative p-2 pr-6 font-semibold border border-gray-300",
        sSortable: "cursor-pointer sortable",
        sStripeEven: "border border-gray-300",
        sStripeOdd: "border border-gray-300",
        sPaging: "relative z-0 inline-flex rounded-md shadow-sm",
        sPageButton: "relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 cursor-pointer hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700",
        sRowEmpty: "w-full p-4 !text-center bg-red-200",
        sInfo: "font-semibold",
    });


    /* Bootstrap paging button renderer */
    DataTable.ext.renderer.pageButton.tailwindcss = function (settings, host, idx, buttons, page, pages) {
        const api = new DataTable.Api(settings);
        const classes = settings.oClasses;
        const lang = settings.oLanguage.oPaginate;
        const aria = settings.oLanguage.oAria.paginate || {};
        let btnDisplay, btnClass, counter = 0;

        const attach = function (container, buttons) {
            let i, ien, node, button;
            const clickHandler = function (e) {
                e.preventDefault();
                if (!$(e.currentTarget).hasClass('disabled') && api.page() != e.data.action) {
                    api.page(e.data.action).draw('page');
                }
            };

            for (i = 0, ien = buttons.length; i < ien; i++) {
                button = buttons[i];

                if (Array.isArray(button)) {
                    attach(container, button);
                } else {
                    btnDisplay = '';
                    btnClass = '';
                    const disabledClass = ' bg-gray-200 cursor-not-allowed pointer-events-none'

                    switch (button) {
                        case 'ellipsis':
                            btnDisplay = '&#x2026;';
                            btnClass = disabledClass;
                            break;

                        case 'first':
                            btnDisplay = lang.sFirst;
                            btnClass = button + (page > 0 ?
                                '' : disabledClass);
                            break;

                        case 'previous':
                            btnDisplay = lang.sPrevious;
                            btnClass = button + (page > 0 ?
                                '' : disabledClass);
                            break;

                        case 'next':
                            btnDisplay = lang.sNext;
                            btnClass = button + (page < pages - 1 ?
                                '' : disabledClass);
                            break;

                        case 'last':
                            btnDisplay = lang.sLast;
                            btnClass = button + (page < pages - 1 ?
                                '' : disabledClass);
                            break;

                        default:
                            btnDisplay = button + 1;
                            btnClass = page === button ?
                                disabledClass : '';
                            break;
                    }

                    if (btnDisplay) {
                        node = $('<li>', {
                            'class': classes.sPageButton + ' ' + btnClass,
                            'id': idx === 0 && typeof button === 'string' ?
                                settings.sTableId + '_' + button :
                                null
                        })
                            .append($('<a>', {
                                    'href': '#',
                                    'aria-controls': settings.sTableId,
                                    'aria-label': aria[button],
                                    'data-dt-idx': counter,
                                    'tabindex': settings.iTabIndex,
                                    'class': 'page-link'
                                })
                                    .html(btnDisplay)
                            )
                            .appendTo(container);

                        settings.oApi._fnBindAction(
                            node, {action: button}, clickHandler
                        );

                        counter++;
                    }
                }
            }
        };

        let activeEl;
        try {
            activeEl = $(host).find(document.activeElement).data('dt-idx');
        } catch (e) {
        }

        attach(
            $(host).empty().html('<ul class="pagination"/>').children('ul'),
            buttons
        );

        if (activeEl !== undefined) {
            $(host).find('[data-dt-idx=' + activeEl + ']').trigger('focus');
        }
    };


    return DataTable;
}

factory(jQuery, window, document);

jQuery.fn.dataTableExt.aTypes.unshift(
    function (sData) {
        if (/^(fri|sat|sun|mon|tue|wed|thu),\s(jan|feb|mar|apr|may|jun|jul|aug|sep|oct|nov|dec)\s([0-2]?\d|3[0-1]),\s\d{4}\s\d\d?:\d\d?\s(am|pm)/i.test(sData)) {
            return 'day-date-string';
        }
        return null;
    }
);

jQuery.fn.dataTableExt.oSort['day-date-string-asc'] = function (a, b) {
    var ordA = new Date(a), ordB = new Date(b);
    return (ordA < ordB) ? -1 : ((ordA > ordB) ? 1 : 0);
};

jQuery.fn.dataTableExt.oSort['day-date-string-desc'] = function (a, b) {
    var ordA = new Date(a), ordB = new Date(b);
    return (ordA < ordB) ? 1 : ((ordA > ordB) ? -1 : 0);
};


window.actionIcons = function (options = {}) {
    let output = `<div class="flex item-center justify-end">`;
    if (options.show) {
        output += `<div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
            <a href="${options.show}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </a>
        </div>`;
    }
    if (options.check) {
        output += `<div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
            <a href="${options.check}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </a>
        </div>`;
    }
    if (options.edit) {
        output += `<div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
            <a href="${options.edit}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </a>
        </div>`;
    }
    if (options.cancel) {
        output += `<div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
           <a href="${options.cancel}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>`;
    }
    if (options.portal) {
        output += `<div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
           <a href="${options.portal}" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" class="transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </a>
        </div>`;
    }
    if (options.delete) {
        let token = document.querySelector('[name="csrf-token"]').content;
        output += `<div class="w-4 mr-2 transform hover:text-primary-500 hover:scale-110">
            <a onclick="confirm('Are you sure about your action?') && this.nextElementSibling.submit()" class="delete cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </a>
            <form action="${options.delete}" method="post">
            <input type="hidden" name="_method" value="DELETE"/>
            <input type="hidden" name="_token" value="` + token + `">
            </form>
        </div>`;
    }
    return output + `</div>`;
};
