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
                  <li class="breadcrumb-item active">Payment Collection</li>
                </ol>
            </nav>

            <div class="col-xxl mt-2">
                <div class="card mb-4">
                  <div class="card-body">

                    <form action="{{url('/reports/payments')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label class="col-sm-1 col-form-label" for="basic-icon-default-dob">From</label>
                            <div class="col-sm-3">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input class="form-control" type="date" value="{{old('paymentfromdt')}}" id="html5-date-input" name="paymentfromdt" />
                                @error('paymentfromdt')
                                    {{$message}}
                                  @enderror
                              </div>
                            </div>

                            <label class="col-sm-1 col-form-label" for="basic-icon-default-dob">To</label>
                            <div class="col-sm-3">
                              <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input class="form-control" type="date" value="{{old('paymenttodt')}}" id="html5-date-input" name="paymenttodt" />
                                @error('paymenttodt')
                                    {{$message}}
                                  @enderror
                              </div>
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="menu-icon tf-icons bx bx-search"></i> Show Collection</button>
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
                                    <th>Receipt No</th>
                                    <th>Receipt Date</th>
                                    <th>Customer Name</th>
                                    <th>Paid</th>
                                    <th>Mode</th>
                                    <th>Received By</th>
                                    <th>Branch</th>
                                </tr>
                            </thead>

                            <?php
                                $no=1;
                                $totalpaid=0;
                            ?>
                            @foreach($paydata as $value)
                            <?php
                                $totalpaid+=$value->pamount;
                                $getCustName = App\Http\Controllers\GenxController::GetCustomerName($value->cid);
                            ?>
                            <tr>
                                <td> <p style="font-size:13px"> {{$no++}} </p> </td>
                                <td> <div class= "d-flex justify-content-end">  <p style="font-size:13px"> {{$value->preceiptno}} </p> </div> </td>
                                <td> <p style="font-size:13px"> {{date('d-M-Y',strtotime($value->preceiptdt))}} </p> </td>
                                <td> <p style="font-size:13px"> {{$getCustName->cname}} </p> </td>
                                <td> <div class= "d-flex justify-content-end">  <p style="font-size:13px"> {{$value->pamount}} </p> </div> </td>
                                <td> <p style="font-size:13px"> {{$value->pmode}} </p> </td>
                                <td> <p style="font-size:13px"> {{$value->receivedby}} </p> </td>
                                <td> <p style="font-size:13px"> {{$value->branch}} </p> </td>
                            </tr>
                            @endforeach
                            <?php $no--; ?>
                            <thead>
                            <tr>
                                <td> <p style="font-size:13px">  </p> </td>
                                <td> <p style="font-size:13px">  </p> </td>
                                <td> <p style="font-size:13px">  </p> </td>
                                <td> <div class= "d-flex justify-content-end"> <p style="font-size:13px"> <b> Total Paid </b> </p> </div> </td>
                                <td> <div class= "d-flex justify-content-end"> <p style="font-size:13px"> <b> {{$totalpaid}} </b> </p> </div> </td>
                                <td> <p style="font-size:13px"> </p> </td>
                                <td> <p style="font-size:13px"> </p> </td>
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
