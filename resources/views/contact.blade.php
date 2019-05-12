@extends('layouts.app_client')
@section('content')
<div class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      @if ( count( $errors ) > 0 )
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)

          <li>{{ $error }}</li>

          @endforeach
        </ul>
      </div>
      @endif
      @if (\Session::has('success'))
      <div class="alert alert-success">
        <ul>
          <li>{!! \Session::get('success') !!}</li>
        </ul>
      </div>
      @endif
      {{ Form::open(['method' => 'POST', 'route' => 'user.contact.post']) }}
      @csrf
      <div class="col-md-offset-3 col-md-6">
        <div class="billing-details">
          <div class="section-title">
            <h3 class="title">Liên Hệ</h3>
          </div>
          <div class="form-group">
            <input class="input" value="{{ old('name') }}" type="text" name="name" placeholder="Tên">
          </div>
          <div class="form-group">
            <input class="input" value="{{ old('email') }}" type="text" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <input class="input" value="{{ old('phone') }}" type="text" name="phone" placeholder="Số điện thoại">
          </div>
          <div class="form-group">
           <textarea name="message" rows="50" class="input" id="contact-message" aria-required="true" aria-invalid="false" placeholder="Your Message">{{ old('message') }}</textarea>
         </div>
         <div class="pull-right">
          <button class="primary-btn" type="submit">Gửi</button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
  <!-- /row -->
</div>
<!-- /container -->
</div>
@endsection
