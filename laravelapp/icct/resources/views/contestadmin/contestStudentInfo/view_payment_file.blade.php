 @extends('masterlayouts.app')
 @section('content')
     @if(!empty($payment_file))
     <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header bg-card-blue" style="padding-bottom: 10px">
                  <h3 style="color: white; text-align: center">View Payment File</h3>
              </div>
                  <div class="content">
                      <div class="text-center">
                          <label class="control-label">Payment Date:<span>{{$payment_file[0]->payment_date}}</span></label>
                         <img src="{{asset('public/paymentFiles/'.$payment_file[0]->payment_file_path)}}" class="img-responsive" alt="File Not Found">
                      </div>
                      <hr>
                      <div class="row">
                          <div class="col-md-4 col-md-offset-8">
                              <a  href="{{route('viewAllInstitutes')}}" class="btn btn-primary btn-fill pull-right"><i class="fa fa-angle-left"></i>Go Back
                              </a>
                              <div class="clearfix"></div>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </div>
     @else
         <div class="jumbotron bg-card-blue">
             <h3 class="text-center" style="color: white">Currently No Information to Display</h3>
         </div>
     @endif
     @stop()