@if (session()->has('username'))

@if (session()->has('customerID'))
    @extends('layouts.main')
    @section('main-section')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                      <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Master</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="{{url('/visits')}}">Visits</a>
                      </li>
                      <li class="breadcrumb-item active">Add Visits</li>
                    </ol>
                </nav>

                <!-- Basic with Icons -->
                <div class="col-xxl">
                  <div class="card mb-4">

                    <div class="card-body">
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}} </div>
                        @endif

                      <form action="{{url('/visits/add')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="text" class="form-control" value="{{$custdetails->cid}}" name="custid" hidden/>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Full Name</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname" class="input-group-text">
                                  <i class="bx bx-book-content">
                                  </i>
                                </span>
                                <input type="text" class="form-control" value="{{$custdetails->cname}}" name="fullname" Readonly/>
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-icon-default-phone">Phone No</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone" class="input-group-text">
                                    <i class="bx bx-phone"></i>
                                </span>
                                <input type="text" class="form-control" value="{{$custdetails->ccontact}}" name="phone" Readonly/>
                            </div>
                          </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-treatment">Treatment</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-treatment" class="input-group-text">
                                      <i class="bx bx-book-content"></i>
                                  </span>
                                  <input type="text" class="form-control" value="{{$custdetails->ctreatment}}" name="treatment" Readonly/>
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-amount">Amount Rs.</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-amount" class="input-group-text">
                                      <i class="bx bx-dollar"></i>
                                  </span>
                                  <input type="text" class="form-control" value="{{$custdetails->camount}}" name="amount" Readonly/>
                                  <span class="input-group-text">.00</span>
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-discount">Discount Rs.</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-discount" class="input-group-text">
                                      <i class="bx bx-dollar"></i>
                                  </span>
                                  <input type="text" class="form-control" value="{{$custdetails->cdisc?$custdetails->cdisc:'0'}}" name="discount" readonly/>
                                  <span class="input-group-text">.00</span>
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-amount">Amount Paid (Rs.)</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-amount" class="input-group-text">
                                      <i class="bx bx-dollar"></i>
                                  </span>
                                  <input type="text" class="form-control" value="{{$paymentdone}}" name="amount" Readonly/>
                                  <span class="input-group-text">.00</span>
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-balance"> <B> Balance (Rs.) </B></label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-balance" class="input-group-text">
                                      <i class="bx bx-dollar"></i>
                                  </span>
                                  <input type="text" class="form-control" value="{{$custdetails->camount-$paymentdone-$custdetails->cdisc}}" name="balance" Readonly/>
                                  <span class="input-group-text">.00</span>
                              </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-visitdate">Visit Date</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-visitdate" class="input-group-text">
                                      <i class="bx bx-calendar"></i>
                                  </span>
                                  <input class="form-control" type="date" value="{{old('visitdate')}}" id="html5-date-input" name="visitdate" />
                                  @error('visitdate')
                                    {{$message}}
                                  @enderror
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-settings">Laser Settings</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-settings" class="input-group-text">
                                      <i class="bx bx-pencil"></i>
                                  </span>
                                  <input type="text" class="form-control" Placeholder ="Enter Laser Settings" value="{{old('settings')}}" name="settings"/>
                                  @error('settings')
                                  {{$message}}
                                @enderror
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-comments">Comments</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-settings" class="input-group-text">
                                      <i class="bx bx-pencil"></i>
                                  </span>
                                  <textarea class="form-control" value="{{old('comments')}}" name="comments"></textarea>
                                  @error('comments')
                                  {{$message}}
                                @enderror
                              </div>
                            </div>
                        </div>


                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                <i class="menu-icon tf-icons bx bx-save"></i> Save Visit</button>

                            <a href="{{url('/visits')}}">
                                <button type="button" class="btn btn-primary">
                                    <i class="menu-icon tf-icons bx bx-block"></i> Cancel</button>
                            </a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>

              </div>
            </div>
            <!-- / Content -->
    @endsection

@else
    <?php
        header('Location: /payments');
        die();
    ?>
@endif

@else
    <?php
        header('Location: /');
        die();
    ?>
@endif
