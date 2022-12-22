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
                    <a href="javascript:void(0);">Reports</a>
                  </li>
                  <li class="breadcrumb-item active">Treatment Record</li>
                </ol>
            </nav>

            <div class="col-xxl mt-2">
                <div class="card mb-4">
                  <div class="card-body">

                    <form action="{{url('/reports/visits')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-1 col-form-label" for="basic-icon-default-dob">From</label>
                            <div class="col-sm-3">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input class="form-control" type="date" value="{{old('visitfromdt')}}" id="html5-date-input" name="visitfromdt" />
                                @error('visitfromdt')
                                    {{$message}}
                                  @enderror
                              </div>
                            </div>

                            <label class="col-sm-1 col-form-label" for="basic-icon-default-dob">To</label>
                            <div class="col-sm-3">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input class="form-control" type="date" value="{{old('visittodt')}}" id="html5-date-input" name="visittodt" />
                                @error('visittodt')
                                    {{$message}}
                                  @enderror
                              </div>
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="menu-icon tf-icons bx bx-search"></i> Show Treatments</button>
                            </div>
                        </div>

                <!-- Hoverable Table rows -->
                <div class="card">
                    <div class="table-responsive text-nowrap">
                    @if(Session::get('paymentstatus') == '1')
                    <table class="table table-hover table-bordered">
                        <tbody class="table-border-bottom-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Visit Date</th>
                                    <th>Customer Name</th>
                                    <th>Settings</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>

                            <?php
                                $no=1;
                            ?>
                            @foreach($Visitdata as $value)
                            <?php
                                $getCustName = App\Http\Controllers\GenxController::GetCustomerName($value->cid);
                            ?>
                            <tr>
                                <td> <p style="font-size:13px"> {{$no++}} </p> </td>
                                <td> <p style="font-size:13px"> {{date('d-M-Y',strtotime($value->tdot))}} </p> </td>
                                <td> <p style="font-size:13px"> {{$getCustName->cname}} </p> </td>
                                <td> <p style="font-size:13px"> {{$value->settings}} </p> </td>
                                <td> <p style="font-size:13px"> {{$value->tcomments}} </p> </td>
                            </tr>
                            @endforeach
                            <?php $no--; ?>
                            <thead>
                            <tr>
                                <td> <p style="font-size:13px"> <b> {{$no}} </b> </p> </td>
                                <td> <p style="font-size:13px">  </p> </td>
                                <td> <p style="font-size:13px">  </p> </td>
                                <td> <p style="font-size:13px">  </p> </td>
                                <td> <p style="font-size:13px">  </p> </td>
                            </tr>
                            </thead>
                        </tbody>
                    </table>
                    @elseif(Session::get('paymentstatus') == '0')
                        <div class="alert alert-danger"> No Payment for Selected Dates </div>
                    @endif
                    </div>
                </div>
                <!--/ Hoverable Table rows -->
        </div>
    @endsection

@else
    <?php
        header('Location: /');
        die();
    ?>
@endif
