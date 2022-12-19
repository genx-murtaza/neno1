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
                        <a href="{{url('/usermaster')}}">User Master</a>
                      </li>
                      <li class="breadcrumb-item active">Delete User</li>
                    </ol>
                </nav>

                <!-- Basic with Icons -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-body">

                      <form action="{{url('/usermaster/delete') . '/' . $data->id}}" method="post">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-username">Username</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-username" class="input-group-text">
                                      <i class="bx bx-user"></i>
                                  </span>
                                  <input type="text" class="form-control" value="{{$data->username}}" placeholder="Enter Unique Username" name="username" readonly />
                                  @error('username')
                                    {{$message}}
                                  @enderror
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Full Name</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname" class="input-group-text">
                                  <i class="bx bx-book-content">
                                  </i>
                                </span>
                                <input type="text" class="form-control" value ="{{$data->fullname}}" placeholder="Full Name" name="fullname" readonly/>
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
                                <span id="basic-icon-default-phone2" class="input-group-text" >
                                    <i class="bx bx-phone"></i>
                                </span>
                                <input type="text" class="form-control phone-mask" placeholder="0792381108" value="{{$data->contact}}" name="phone" readonly />
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
                              <input type="email" class="form-control" value="{{$data->email}}" name="email" readonly/>
                              @error('email')
                                  {{$message}}
                                @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-level">Level</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-badge"></i></span>
                                <select class="form-select" name="level" readonly>
                                    <option value="1" {{$data->level=="1" ? "Selected" : ""}}>Admin</option>
                                    <option value="2" {{$data->level=="2" ? "Selected" : ""}}>Director</option>
                                    <option value="3" {{$data->level=="3" ? "Selected" : ""}}>Sales</option>
                                    <option value="4" {{$data->level=="4" ? "Selected" : ""}}>Approval</option>
                                    <option value="5" {{$data->level=="5" ? "Selected" : ""}}>Only Reports</option>
                                  </select>
                              </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">
                                <i class="menu-icon tf-icons bx bx-trash"> </i> Delete</button>

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
