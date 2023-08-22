@extends('layouts.main')

@section('content')
<section class="section">
    <div class="container">

        {{-- @foreach($users as $u)
        <h6 class="display-5 text-center">Welcome, {{$u->name}}!</h6>
        @endforeach --}}

        {{-- @php
            $total = $totalKrd-$totalDbt;   
        @endphp --}}
        
        
        <div style="text-align: center">
            <span class="display-4 text-center" style="font-size: 30px; font-weight:bold;">Saldo : Rp. </span><span class="display-4 text-center currency" style="font-size: 30px; font-weight:bold;">{{$total}}</span>
        </div>

        {{-- <h6 class="display-5 text-center">Welcome!</h6> --}}

        <div class="has-line">
            <label for="" style="color: red; font-weight:bold; font-size:20px;">Debit</label>
            <table id="myTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tanggal</th>
                        <th>Uraian</th>
                        <th>Kategori</th>
                        <th>Quantity</th>
                        <th>Satuan</th>
                        <th>Harga Satuan(Rp)</th>
                        <th>Total(Rp)</th>
                        <th>Cost Center</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                        <th></th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{$d->id}}</td>
                            <td>{{$d->tgl}}</td>
                            <td>{{$d->uraian}}</td>
                            <td>{{$d->name_kat}}</td>
                            <td>{{$d->qty}}</td>
                            <td>{{$d->stn}}</td>
                            <td class="currency">{{$d->harga_stn}}</td>
                            <td class="currency">{{$d->total}}</td>
                            <td>{{$d->cost_center}}</td>
                            <td>{{$d->ket}}</td>
                            <td>
                                <a data-toggle="modal" href="#modalEdit" class="openModalEdit"
                                data-id="{{$d->id}}"
                                data-tgl="{{$d->tgl}}"
                                data-uraian="{{$d->uraian}}"
                                data-kategori="{{$d->id_kat}}"
                                data-qty="{{$d->qty}}"
                                data-stn="{{$d->stn}}"
                                data-harga_stn="{{$d->harga_stn}}"
                                data-total="{{$d->total}}"
                                data-cost_center="{{$d->cost_center}}"
                                data-ket="{{$d->ket}}">
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                </a>
                            </td>
                            <td>
                                <a data-toggle="modal" href="#modalDel" class="openModalDel"
                                data-id="{{$d->id}}">
                                    <button class="btn btn-sm btn-primary">Delete</button>
                                </a>
                            </td>
                            <td>
                                <a target="_blank" href="{{'http://127.0.0.1:8000/uploads/kwitansi/'. $d->filename .''}}">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="has-line">
            <table id="myTable2">
                <label for="" style="color: rgb(10, 194, 10); font-weight:bold; font-size:20px;">Kredit</label>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tanggal</th>
                        <th>Uraian</th>
                        <th>Total(Rp)</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data2 as $d)
                        <tr>
                            <td>{{$d->id}}</td>
                            <td>{{$d->tgl}}</td>
                            <td>{{$d->uraian}}</td>     
                            <td class="currency">{{$d->total}}</td>
                            <td>{{$d->ket}}</td>
                            <td>
                                <a data-toggle="modal" href="#modalEdit2" class="openModalEdit2"
                                data-id="{{$d->id}}"
                                data-tgl="{{$d->tgl}}"
                                data-uraian="{{$d->uraian}}"
                                data-total="{{$d->total}}"
                                data-ket="{{$d->ket}}">
                                    <button class="btn btn-sm btn-primary">Edit</button>
                                </a>
                            </td>
                            <td>
                                <a data-toggle="modal" href="#modalDel2" class="openModalDel2"
                                data-id="{{$d->id}}">
                                    <button class="btn btn-sm btn-primary">Delete</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</section>  

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exportModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modal">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/edit-data" method="post">             
                    @csrf
                    <div class="row mb-4">
                        <input type="hidden" name="idEdit" id="idEdit" value="">
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Tanggal</b><span style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="tglEdit" id="tglEdit" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Uraian</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="uraianEdit" id="uraianEdit" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Kategori</b><span style="color: red;">*</span></label>
                                <select name="kategori_idEdit" id="kategori_idEdit" class="form-control">
                                    @foreach($kategori as $k)
                                        <option value="{{$k->id_kat}}">{{$k->name_kat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Quantity</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="qtyEdit" id="qtyEdit" maxlength="100" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Satuan</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="stnEdit" id="stnEdit" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Harga Satuan(Rp)</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control currency" name="harga_stnEdit" id="harga_stnEdit" maxlength="20" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Total(Rp)</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control currency" name="totalEdit" id="totalEdit" maxlength="20" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Cost Center</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="cost_centerEdit" id="cost_centerEdit" maxlength="20" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Keterangan</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="ketEdit" id="ketEdit" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit2" tabindex="-1" role="dialog" aria-labelledby="exportModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modal">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/edit-in-data" method="post">             
                    @csrf
                    <div class="row mb-4">
                        <input type="hidden" name="idEdit" id="idEdit" value="">
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Tanggal</b><span style="color: red;">*</span></label>
                                <input type="date" class="form-control" name="tglEdit" id="tglEdit" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Uraian</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="uraianEdit" id="uraianEdit" required>
                            </div>
                        </div>  
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Total(Rp)</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control currency" name="totalEdit" id="totalEdit" maxlength="20" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group pb-1">
                                <label for=""><b>Keterangan</b><span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="ketEdit" id="ketEdit" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDel" tabindex="-1" role="dialog" aria-labelledby="exportModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modal">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/delete-data" method="post">
                    @csrf
                    <div class="col-md-6">
                        <input type="hidden" name="idDel" id="idDel" value="">
                        <div class="form-group pb-1">
                            <label for="ptk_amount"><b>Are you sure want to delete?</b></label>
                        </div>
                        <button class="btn btn-primary mt-3">Yes</button>
                        <button class="btn btn-primary mt-3" data-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDel2" tabindex="-1" role="dialog" aria-labelledby="exportModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modal">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/delete-in-data" method="post">
                    @csrf
                    <div class="col-md-6">
                        <input type="hidden" name="idDel" id="idDel" value="">
                        <div class="form-group pb-1">
                            <label for="ptk_amount"><b>Are you sure want to delete?</b></label>
                        </div>
                        <button class="btn btn-primary mt-3">Yes</button>
                        <button class="btn btn-primary mt-3" data-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            order: [],
            scrollX: true,
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#myTable2').DataTable({
            order: [],
        });
    });
</script>

<script>
    $(document).ready(function(){
        $(".currency").mask('000.000.000.000.000.000.000.000', {reverse: true});
    })
</script>

<script>
    $(document).on("click", ".openModalEdit", function(){
        var id = $(this).data('id');
        var tgl = $(this).data('tgl');
        var uraian = $(this).data('uraian');
        var kategori = $(this).data('kategori');
        var qty = $(this).data('qty');
        var stn = $(this).data('stn');
        var harga_stn = $(this).data('harga_stn');
        var total = $(this).data('total');
        var cost_center = $(this).data('cost_center');
        var ket = $(this).data('ket');
        
        $("#modalEdit #idEdit").val(id);
        $("#modalEdit #tglEdit").val(tgl);
        $("#modalEdit #uraianEdit").val(uraian);
        $("#modalEdit #kategori_idEdit").val(kategori)
        $("#modalEdit #qtyEdit").val(qty);
        $("#modalEdit #stnEdit").val(stn);
        $("#modalEdit #harga_stnEdit").val(harga_stn);
        $("#modalEdit #totalEdit").val(total);
        $("#modalEdit #cost_centerEdit").val(cost_center);
        $("#modalEdit #ketEdit").val(ket);
    })
</script>
<script>
    $(document).on("click", ".openModalEdit2", function(){
        var id = $(this).data('id');
        var tgl = $(this).data('tgl');
        var uraian = $(this).data('uraian');
        var total = $(this).data('total');
        var ket = $(this).data('ket');
        
        $("#modalEdit2 #idEdit").val(id);
        $("#modalEdit2 #tglEdit").val(tgl);
        $("#modalEdit2 #uraianEdit").val(uraian);
        $("#modalEdit2 #totalEdit").val(total);
        $("#modalEdit2 #ketEdit").val(ket);
    })
</script>

<script>
     $(document).on("click", ".openModalDel", function(){
        var id = $(this).data('id');
        
        $("#modalDel #idDel").val(id);
     })
</script>

<script>
    $(document).on("click", ".openModalDel2", function(){
       var id = $(this).data('id');
       
       $("#modalDel2 #idDel").val(id);
    })
</script>

<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="{{ asset ('js/jquery.mask.min.js')}}"></script>

@if(session('message'))
<script>

	toastr.success('{{ session('message')['type'] }}');

</script>
@endif

@if(session('hapus'))
<script>

	toastr.warning('{{ session('hapus')['type'] }}');

</script>
@endif

@endsection