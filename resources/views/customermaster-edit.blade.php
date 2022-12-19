@if (session()->has('username'))
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
                        <a href="{{url('/customers')}}">Customer</a>
                      </li>
                      <li class="breadcrumb-item active">Update Customer</li>
                    </ol>
                </nav>

                <!-- Basic with Icons -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}} </div>
                        @endif

                      <form action="{{url('/customers/edit') . '/' . $data->cid}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Full Name</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname" class="input-group-text">
                                  <i class="bx bx-book-content">
                                  </i>
                                </span>
                                <input type="text" class="form-control" placeholder="Full Name" value="{{$data->cname}}" name="fullname"/>
                                @error('fullname')
                                  {{$message}}
                                @enderror
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
                                  <input type="text" class="form-control" placeholder="9033755110" value="{{$data->ccontact}}" name="phone" />
                                  @error('phone')
                                    {{$message}}
                                  @enderror
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-email" class="input-group-text" >
                                        <i class="bx bx-envelope"></i>
                                    </span>
                                    <input type="text" class="form-control phone-mask" placeholder="admin@neno.co.in" value="{{$data->cemail}}" name="email" />
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-icon-default-dob">Birthdate</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input class="form-control" type="date" value="{{$data->cdob}}" id="html5-date-input" name="dob" />
                                @error('dob')
                                    {{$message}}
                                    @enderror
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
                                    <input type="text" class="form-control" placeholder="Enter Treatment of Customer" value="{{$data->ctreatment}}" name="treatment" />
                                    @error('treatment')
                                        {{$message}}
                                    @enderror
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
                                    <input type="text" class="form-control" placeholder="Enter Treatent Total Amount in Rs." value="{{$data->camount}}" name="amount"/>
                                    <span class="input-group-text">.00</span>
                                    @error('amount')
                                      {{$message}}
                                    @enderror
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
                                    <input type="text" class="form-control" placeholder="Enter Discount Rs." value="{{$data->cdisc}}" name="discount" />
                                    <span class="input-group-text">.00</span>
                                    @error('discount')
                                      {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-reference">Reference By</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-reference" class="input-group-text">
                                        <i class="bx bx-user"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Reference By Person Name" value="{{$data->creference}}" name="reference" />
                                    @error('reference')
                                      {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                <i class="menu-icon tf-icons bx bx-save"></i> Save Changes</button>

                            <a href="{{url('/customers')}}">
                                <button type="button" class="btn btn-primary">
                                    <i class="menu-icon tf-icons bx bx-block"></i>Cancel</button>
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
        header('Location: /');
        die();
    ?>
@endif
