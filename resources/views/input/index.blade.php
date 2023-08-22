@extends('layouts.main')

@section('content')
<section class="section" id="input">
    <div class="container">
        <h6 class="display-4 has-line text-center">INPUT DATA PETTY CASH</h6>
        <p class="mb-5 pb-2 text-center">Hati - hati dalam input, periksa kembali sebelum submit!</p>

        <div class="col-md-6">
            <div class="form-group pb-1">
                <label for=""><b>Jenis</b></label>
                <select onchange="showMe(this.value);" class="form-control">
                    <option value="" hidden selected>--</option>
                    <option value="Kredit">Kredit</option>
                    <option value="Debit">Debit</option>
                </select>
            </div>
        </div>

        <form action="/insert-data" method="post" id="debitForm" style="display: none;" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Tanggal</b><span style="color: red;">*</span></label>
                            <input type="date" class="form-control" name="tgl" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Judul</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="uraian" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Kategori</b><span style="color: red;">*</span></label>
                            <select name="kategori_id" class="form-control selectpicker" data-live-search="true" required>
                                <option value="" hidden selected>--</option>
                                @foreach($kategori as $k)
                                    <option value="{{$k->id_kat}}">{{$k->name_kat}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Quantity</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="qty" maxlength="100" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Satuan</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="stn" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Harga Satuan(Rp)</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control currency" name="harga_stn" maxlength="20" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Total(Rp)</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control currency" name="total" maxlength="20" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Cost Center</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="cost_center" maxlength="20" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Keterangan</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="ket" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Kwitansi</b><span style="color: red;">*</span></label>
                            <input type="file" class="form-control" name="file" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group pb-1">
                        <button class="btn btn-primary mt-3">Submit</button>
                    </div>
                </div>
            </div>
        </form>

        <form action="/insert-in-data" method="post" id="kreditForm" style="display: none;">
            @csrf
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Tanggal</b><span style="color: red;">*</span></label>
                            <input type="date" class="form-control" name="tglKredit" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Uraian</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="uraianKredit" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Total(Rp)</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control currency" name="totalKredit" maxlength="20" onkeypress="return ((event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode ==0)" ondrop="return false;" onpaste="return false;" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <label for=""><b>Keterangan</b><span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="ketKredit" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group pb-1">
                        <button class="btn btn-primary mt-3">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection


@section('script')

@if(session('message'))
<script>

	toastr.success('{{ session('message')['type'] }}');

</script>
@endif

<script>
    $(document).ready(function(){
        $(".currency").mask('000.000.000.000', {reverse: true});
    })
</script>

{{-- <script>
    $(function () {
        $('.theSelect').selectpicker();
    });
</script> --}}

<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="{{ asset ('js/jquery.mask.min.js')}}"></script>

<script type="text/javascript"> 

    function showMe(value){
        if(value=="Debit"){
            document.getElementById('debitForm').style.display="block";
            document.getElementById('kreditForm').style.display="none";
        }
        
        else {
            document.getElementById('debitForm').style.display="none";
            document.getElementById('kreditForm').style.display="block";
        }
    }
</script>

@endsection