@extends('layouts.app2')

@section('page-title')
    <li class="active"><a>Dashboard</a></li>
@endsection

@section('content')

    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count">{{ count($successOrder) }}</span>
                </h4>
                <p class="text-light">{{ __('message.order.success') }}</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count">{{ count($canceledOrder) }}</span>
                </h4>
                <p class="text-light">{{ __('message.order.canceled') }}</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-flat-color-1">
            <div class="card-body pb-0">
                <h4 class="mb-0">
                    <span class="count">{{ count($popularProduct) }}</span>
                </h4>
                <p class="text-light">{{ __('message.index.popular') }}</p>
            </div>
        </div>
    </div>

@endsection
