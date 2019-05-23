@extends('layouts.app2')

@section('page-title')
<li class="active"><a>Dashboard</a></li>
@endsection

@section('content')
  @if (\Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! \Session::get('success') !!}</li>
        </ul>
      </div>
      @endif
<div class="col-sm-12 col-lg-12">
  <div id="chart1"></div>

{!! $chart1 !!}
</div>

@endsection
