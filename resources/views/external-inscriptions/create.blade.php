@extends('layouts.external')

@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
   


<div class="row">
    <div class="col-md-12">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active"> <img class="img-responsive" src="{{ Storage::disk('public')->url($event->banner) }}" alt="First slide"> </div>
                                {{-- <div class="carousel-item"> <img class="img-responsive" src="../assets/images/big/img2.jpg" alt="Second slide"> </div>
                                <div class="carousel-item"> <img class="img-responsive" src="../assets/images/big/img3.jpg" alt="Third slide"> </div> --}}
                            </div>
                        </div>

<external-insc :event="{{$event->id}}">
</external-insc>

<hr>

                    </div>
                </div>
            </div>

        </div>


</div>   
                             

</div>


@endsection
