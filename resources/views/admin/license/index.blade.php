@extends('admin.layouts.main')

@section('title', $title)

@section('js')
    <script src="{{ asset('adminpanel/js/datatables_json.js') }}"></script>
    <script>
        $(".title-input").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $(".slug-input").val(Text);
        });

        $(".slug-input").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
            $(".slug-input").val(Text);
        });

        datatables_luxion(
            '.datatables-basic',
            '{{ route('license.json') }}',
            '{{ route('license.destroyall') }}',
            [{
                    data: 'responsive_id'
                },
                {
                    data: 'id',
                },
                {
                    data: 'license'
                },
                {
                    data: 'slug'
                },
                {
                    data: 'item'
                },
                {
                    data: 'type'
                },
            ]
        );
        Livewire.on('alert', ($data) => {
            if ($data['type'] == 'success') {
                $('#modalsaddnew').modal('hide');
                Swal.fire({
                    title: 'Success!',
                    text: $data['message'],
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
                $('.datatables-basic').DataTable().ajax.reload();
            }
        })
    </script>
@endsection




@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">{{ $title }}</h2>
                            <div class="breadcrumb-wrapper">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                </div>
            </div>
            <div class="content-body">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Item</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalsaddnew" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                @livewire('admin.add-license')
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@section('vendorcss')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminpanel') }}/vendors/css/forms/select/select2.min.css">
    @livewireStyles
@endsection

@section('vendorjs')
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('adminpanel') }}/vendors/js/forms/select/select2.full.min.js"></script>
    @stack('livewirejs')
    @livewireScripts
@endsection
