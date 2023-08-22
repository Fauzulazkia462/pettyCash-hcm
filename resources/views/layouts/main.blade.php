<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Start your development with Rubic landing page.">
        <meta name="author" content="Devcrud">
        <title>Petty Cash | INACO</title>

        {{-- Datatable --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        <link rel="stylesheet" href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/rubic.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('imgs/bar-chart.ico') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

        {{-- toastr --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        {{-- select search --}}
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" /> --}}

        
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
        @include('partials.header')
        @yield('content')

        <div class="modal fade" id="modalExport" tabindex="-1" role="dialog" aria-labelledby="exportModalTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title" id="modal">Export Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Jenis</b></label>
                                <select onchange="showExport(this.value);" class="form-control">
                                    <option value="" hidden selected>--</option>
                                    <option value="All">All</option>
                                    <option value="Kredit">Kredit</option>
                                    <option value="Debit">Debit</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            
                            <form action="{{ route('exportexcel') }}" method="post" id="debitExport" style="display: none;">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group pb-1">
                                        <label for=""><b>Dari Tanggal</b><span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" name="start_date" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group pb-1">
                                        <label for=""><b>Sampai Tanggal</b><span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" name="end_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary mt-3">Export</button>
                                </div>
                            </form>
                            <form action="{{ route('exportinexcel') }}" method="post" id="kreditExport" style="display: none;">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group pb-1">
                                        <label for=""><b>Dari Tanggal</b><span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" name="start_date" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group pb-1">
                                        <label for=""><b>Sampai Tanggal</b><span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" name="end_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary mt-3">Export</button>
                                </div>
                            </form>
                            <form action="{{ route('exportallexcel') }}" method="post" id="allExport" style="display: none;">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group pb-1">
                                        <label for=""><b>Dari Tanggal</b><span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" name="start_date" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group pb-1">
                                        <label for=""><b>Sampai Tanggal</b><span style="color: red;">*</span></label>
                                        <input type="date" class="form-control" name="end_date" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary mt-3">Export</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.footer')

        <script src="{{ asset('vendors/jquery/jquery-3.4.1.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>

        <script src="{{ asset('vendors/bootstrap/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('vendors/bootstrap/bootstrap.affix.js') }}"></script>
        <script src="{{ asset('js/rubic.js') }}"></script>
        <script src="{{ asset('js/Chart.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/date-1.1.2/r-2.3.0/datatables.min.js"></script>

        {{-- toastr --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- select --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}

        <script type="text/javascript"> 

            function showExport(value){
                if(value=="All"){
                    document.getElementById('allExport').style.display="block";
                    document.getElementById('debitExport').style.display="none";
                    document.getElementById('kreditExport').style.display="none";
                }
                
                else if(value=="Kredit") {
                    document.getElementById('allExport').style.display="none";
                    document.getElementById('debitExport').style.display="none";
                    document.getElementById('kreditExport').style.display="block";
                } else{
                    document.getElementById('allExport').style.display="none";
                    document.getElementById('debitExport').style.display="block";
                    document.getElementById('kreditExport').style.display="none";
                }
            }
        </script>

        @yield('script')
    </body>
</html>
