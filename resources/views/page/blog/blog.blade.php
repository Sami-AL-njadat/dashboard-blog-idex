@extends('layout.master')

@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center mb-3">
                <div class="col-sm mb-2 mb-sm-0">
                    @if (isset($blogs) && count($blogs) > 0)
                        <h1 class="page-header-title">Blogs<span
                                class="badge bg-soft-dark text-dark ms-2">{{ $blogs->count() }}</span></h1>
                    @else
                        <h1 class="page-header-title">Blog <span class="badge bg-soft-dark text-dark ms-2"></span></h1>
                    @endif
                </div>
                <div class="col-sm-auto">
                    <a class="btn btn-primary" href="{{ route('blog.create') }}">New Article</a>
                </div>
            </div>

            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('blog.index') }}">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
         

        <div class="card">

            <div class="card-header card-header-content-md-between">
                <div class="mb-2 mb-md-0">
                    <form>
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend input-group-text">
                                <i class="bi-search"></i>
                            </div>
                            <input id="datatableSearch" type="search" class="form-control" placeholder="Search blogs"
                                aria-label="Search blogs">
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive datatable-custom">
                @if (isset($blogs) && count($blogs) > 0)
                    <table id="datatable"
                        class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{"order": []
                          "isResponsive": true,
                                "info": {
                 "totalQty": "#datatableWithPaginationInfoTotalQty"
               },
               "search": "#datatableSearch",
               "entries": "#datatableEntries",
                   "isShowPaging": true,
                   "pagination": "datatableWithPaginationPagination"
                        }'>
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Header</th>
                                <th>Image</th>
                                <th>Brife</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $num = 1;
                            @endphp
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $num }}</td>



                                    <td>


                                        <div class="scrollable-cell">
                                            <span>
                                                {{ $blog->header ?? 'No Header' }}
                                            </span>

                                        </div>
                                    </td>

                                    <td>
                                        <a class="d-flex align-items-center" href="{{ route('blog.edit', $blog->id) }}">
                                            <div class="flex-shrink-0">
                                                <img class="avatar avatar-lg"
                                                    src="{{ $blog->image ? asset($blog->image) : asset('images/no-image1.jpg') }}"
                                                    alt="blog Image">

                                            </div>
                                        </a>
                                    </td>
                                    <td>

                                        <div class="scrollable-cell">
                                            <span>
                                                {!! $blog->brief ?? 'No Brief' !!}
                                            </span>

                                        </div>

                                    </td>

                                    <td>

                                        @if ($blog->lang == 'en')
                                            <a class="d-flex align-items-center" href="{{ route('blog.edit', $blog->id) }}">
                                                <div class="flex-shrink-0">
                                                    <img class="avatar avatar-sm"
                                                        src="{{ asset('images/eng.png') ?? 'no image' }}" alt="Blog Image">
                                                </div>
                                            @else
                                                <a class="d-flex align-items-center"
                                                    href="{{ route('blog.edit', $blog->id) }}">
                                                    <div class="flex-shrink-0">
                                                        <img class="avatar avatar-sm"
                                                            src="{{ asset('images/ar.png') ?? 'no image' }}"
                                                            alt="Blog Image">
                                                    </div>
                                        @endif

                                        </a>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-white btn-sm"
                                            id="teamsDropdown{{ $blog->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            More <i class="bi-chevron-down ms-1"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end"
                                            aria-labelledby="teamsDropdown{{ $blog->id }}">
                                            <a class="dropdown-item" href="{{ route('blog.edit', $blog->id) }}">
                                          <i class="bi-pencil dropdown-item-icon"></i>
                                                Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $blog->id }}">
                                                <i class="bi-trash dropdown-item-icon"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </td>

                                     <div class="modal fade" id="deleteModal{{ $blog->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $blog->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $blog->id }}">
                                                        Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this Blog?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                                @php
                                    $num += 1;
                                @endphp
                            @endforeach
                        </tbody>

                    </table>
                @else
                    <div id="noDataMessage" class="text-center p-4">
                        <img class="mb-3" src="{{ asset('dist/assets/svg/illustrations/oc-error.svg') }}"
                            alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
                        <img class="mb-3" src="{{ asset('dist/assets/svg/illustrations-light/oc-error.svg') }}"
                            alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
                        <p class="mb-0">No data to show</p>
                    </div>
                @endif
            </div>

            <div class="card-footer">
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                            <span class="me-2">Showing:</span>

                            <div class="tom-select-custom">
                                <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto"
                                    autocomplete="on"
                                    data-hs-tom-select-options='{"searchInDropdown": true, "hideSearch": true  }'>

                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>

                                </select>

                            </div>

                            <span class="text-secondary me-2">of</span>

                            <span id="datatableWithPaginationInfoTotalQty"></span>
                        </div>
                    </div>

                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
 

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            var datatable = $('#datatable').DataTable({
                "columnDefs": [{
                    "orderable": true
                }],
                "order": [],
                "paging": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "searching": true,
                "lengthChange": true,
                "pageLength": 5,
                "language": {
                    "paginate": {
                        "previous": "<i class='bi bi-arrow-left '></i>",
                        "next": "<i class='bi bi-arrow-right'></i>"
                    }
                },
                "drawCallback": function() {
                    var api = this.api();
                    var pageInfo = api.page.info();

                    $('#datatableWithPaginationInfoTotalQty').text(pageInfo.recordsTotal);

                    var paginationHTML = '<li class="page-item previous' + (pageInfo.page === 0 ?
                        'd-none' : '') + '"><a class="page-link" href="#">Previous</a></li>';
                    for (var i = 0; i < pageInfo.pages; i++) {
                        var activeClass = (i === pageInfo.page) ? 'active' : '';
                        paginationHTML +=
                            `<li class="page-item ${activeClass}"><a class="page-link" href="#">${i + 1}</a></li>`;
                    }
                    paginationHTML += '<li class="page-item next ' + (pageInfo.page === pageInfo.pages -
                        1 ? 'd-none' : '') + '"><a class="page-link" href="#">Next</a></li>';

                    $('#datatablePagination').html(`<ul class="pagination">${paginationHTML}</ul>`);

                    $('#datatablePagination').find('a').off('click').on('click', function(e) {
                        e.preventDefault();
                        var pageIndex = $(this).text();
                        if (pageIndex === 'Previous') {
                            if (pageInfo.page > 0) {
                                api.page(pageInfo.page - 1).draw(false);
                            }
                        } else if (pageIndex === 'Next') {
                            if (pageInfo.page < pageInfo.pages - 1) {
                                api.page(pageInfo.page + 1).draw(false);
                            }
                        } else {
                            api.page(parseInt(pageIndex) - 1).draw(false);
                        }
                    });
                }
            });

            var debounceTimer;
            $('#datatableSearch').on('keyup', function() {
                clearTimeout(debounceTimer);
                var searchValue = $(this).val();
                debounceTimer = setTimeout(function() {
                    datatable.search(searchValue).draw();
                }, 300);
            });

            $('#datatableEntries').on('change', function() {
                datatable.page.len($(this).val()).draw();
            });

            $('#datatableSearch').on('mouseup', function() {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue === "") return;

                setTimeout(function() {
                    if ($input.val() === "") {
                        datatable.search('').draw();
                    }
                }, 1);
            });
        });
    </script>


    <script>
        (function() {
            window.onload = function() {


                new HSSideNav('.js-navbar-vertical-aside').init()


                new HSFormSearch('.js-form-search')



                HSBsDropdown.init()

                HSCore.components.HSTomSelect.init('.js-select')


            }
        })()
    </script>

@endsection
