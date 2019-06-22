@extends('layouts.app')

@section('content')

<div class="row flex-row">
    <div class="col-xl-12 col-12">
        <div class="widget has-shadow">
            <div class="widget-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <p class="text-primary mt-2 mb-2">You are logged in!</p>
            </div>
        </div>
    </div>
</div>
@endsection
