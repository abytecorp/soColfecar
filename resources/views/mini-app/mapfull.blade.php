@extends('layouts.appminimenu')
@section('content')

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

@include('layouts.title')
<div class="row el-element-overlay">
        <div class="col-md-12">

<div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1"> <img src="{{ Storage::disk('public')->url('miniapp/mapfull.jpg') }}" alt="user" />
                    <div class="el-overlay">
                        <ul class="el-info">
                            <li><a class="btn default btn-outline image-popup-vertical-fit" href="../assets/images/users/1.jpg"><i class="icon-magnifier"></i></a></li>
                            <li><a class="btn default btn-outline" href="javascript:void(0);"><i class="icon-link"></i></a></li>
                        </ul>
                    </div>
                </div>
             
            </div>
        </div>
</div>
        </div>
</div>

@endsection