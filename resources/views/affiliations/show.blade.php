@extends('layouts.app')
@section('content')

<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

@include('layouts.title')



                <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <center class="m-t-30"> <img src="{{ Storage::disk('public')->url($company->logo) }}" class="img-circle" width="150" />
                                        <h4 class="card-title m-t-10">{{ $company->bs_name }} {{ $company->last_bs_name }}</h4>
                                        <h6 class="card-subtitle">{{ $company->company_type['company_type'] }}</h6>
                                        <div class="row text-center justify-content-md-center">
                                           <contacts-cnt></contacts-cnt>
                                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                        </div>
                                    </center>
                                </div>
                                <div>
                                    <hr> </div>
                                <div class="card-body"> <small class="text-muted">Correo Electronico </small>
                                    <h6>{{ $company->email }}</h6> <small class="text-muted p-t-30 db">Celular</small>
                                    <h6>No registra</h6> <small class="text-muted p-t-30 db">Direccion</small>
                                    <h6>No registra</h6>
                                    <div class="map-box">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.5335443790664!2d-74.13149868534985!3d4.676907343165927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9c835cf50921%3A0xed5075e65ea84756!2sColfecar+Business+Center!5e0!3m2!1ses!2sco!4v1535465035200" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                                    </div> <small class="text-muted p-t-30 db">Perfil Social</small>
                                    <br/>
                                    <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                                    <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                                    <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-8 col-xlg-9 col-md-7">
                                <div class="card">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs profile-tab" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Informacion de ubicación</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Información Fiscal</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Contactos</a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="card-body">
                                                    <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                        <br>
                                                        <p class="text-muted">Johnathan Deo</p>
                                                    </div>
                                            </div>
                                        </div>
                                        <!--second tab-->
                                        <div class="tab-pane" id="profile" role="tabpanel">
                                            <div class="card-body">
                                                


                                                
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="settings" role="tabpanel">
                                            <div class="card-body">
                                                <form class="form-horizontal form-material">
                                                    <div class="form-group">
                                                        <label class="col-md-12">Full Name</label>
                                                        <div class="col-md-12">
                                                            <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="example-email" class="col-md-12">Email</label>
                                                        <div class="col-md-12">
                                                            <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Password</label>
                                                        <div class="col-md-12">
                                                            <input type="password" value="password" class="form-control form-control-line">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Phone No</label>
                                                        <div class="col-md-12">
                                                            <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-12">Message</label>
                                                        <div class="col-md-12">
                                                            <textarea rows="5" class="form-control form-control-line"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-12">Select Country</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control form-control-line">
                                                                <option>London</option>
                                                                <option>India</option>
                                                                <option>Usa</option>
                                                                <option>Canada</option>
                                                                <option>Thailand</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-success">Update Profile</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                </div>

                    
                    
                    
                    
    </div>
</div>
            
                    
                    
                    
@endsection