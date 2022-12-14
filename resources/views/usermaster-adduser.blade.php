@if (session()->has('username'))
    @extends('layouts.main')
    @section('main-section')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master / User Master / </span> Register New User</h4>

                <!-- Basic with Icons -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    {{-- <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-1">Basic with Icons</h5>
                      <small class="text-muted float-end">Merged input group</small>
                    </div> --}}
                    <div class="card-body">
                        @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}} </div>
                        @endif

                      <form action="{{url('/usermaster/adduser')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Full Name</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname" class="input-group-text">
                                  <i class="bx bx-book-content">
                                  </i>
                                </span>
                                <input type="text" class="form-control" placeholder="Full Name" value="{{old('fullname')}}" name="fullname" Required/>
                                @error('fullname')
                                  {{$message}}
                                @enderror
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-icon-default-username">Username</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-username" class="input-group-text">
                                    <i class="bx bx-user"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Enter Unique Username" value="{{old('username')}}" name="username" Required />
                                @error('username')
                                  {{$message}}
                                @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row mb-3 form-password-toggle">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-password">Password</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-password" class="input-group-text">
                                  <i class="bx bx-key">
                                  </i>
                                </span>
                                <input type="password" class="form-control" placeholder="Password" name="password"  Required/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                @error('password')
                                  {{$message}}
                                @enderror
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3 form-password-toggle">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-password">Retype Password</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-password" class="input-group-text">
                                  <i class="bx bx-key">
                                  </i>
                                </span>
                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" Required/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                @error('password_confirmation')
                                  {{$message}}
                                @enderror
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-phone">Phone No</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text" >
                                    <i class="bx bx-phone"></i>
                                </span>
                                <input type="text" class="form-control phone-mask" placeholder="0792381108" value="{{old('phone')}}" name="phone" Required />
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
                              <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                              <input type="text" class="form-control" placeholder="admin@masgroup.co.ke" value="{{old('email')}}" name="email" Required/>
                              @error('email')
                                  {{$message}}
                                @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-photo">Photo</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-camera"></i></span>
                                <input class="form-control" type="file" name="photo" accept="image/jpeg" />
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-level">Level</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-badge"></i></span>
                                <select class="form-select" name="level">
                                    <option value="1">Admin</option>
                                    <option value="2">Director</option>
                                    <option value="3" selected>Sales</option>
                                    <option value="4">Approval</option>
                                    <option value="5">Only Reports</option>
                                  </select>
                              </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                <i class="menu-icon tf-icons bx bx-save"></i> Register</button>

                            <a href="{{url('/usermaster')}}">
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
        header('Location: /');
        die();
    ?>
@endif
