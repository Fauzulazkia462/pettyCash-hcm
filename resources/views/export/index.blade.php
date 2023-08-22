@extends('layouts.main')

@section('content')
<section class="section" id="input">
    <div class="container">
        <form action="{{ route('exportexcel') }}" method="get">
            <button class="btn btn-primary mt-3">Excel</button>
        </form>
    </div>
</section>
@endsection

@section('script')

@endsection