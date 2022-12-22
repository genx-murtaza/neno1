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
                    <a href="javascript:void(0);">Daily Register</a>
                  </li>
                  <li class="breadcrumb-item active">Visits</li>
                </ol>
            </nav>

            <div class="col-xxl mt-2">
                <div class="card mb-4">
                  <div class="card-body">

                    <form action="{{url('/visits')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Select Customer</label>
                            <div class="col-sm-7">
                                <input class="form-control" name="custid" list="datalistOptions" id="exampleDataList" placeholder="Type to search Customer..." required/>
                                <datalist id="datalistOptions">
                                    @foreach ($allcustname as $allcust)
                                        <option value="{{$allcust->cname}}"> {{$allcust->cname}} </option>
                                    @endforeach
                                </datalist>
                              </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="menu-icon tf-icons bx bx-search"></i> Find Customer</button>
                            </div>
                        </div>

                        @if(Session::get('paymentstatus') == '2' OR Session::get('paymentstatus') == '1')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Full Name</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname" class="input-group-text">
                                  <i class="bx bx-book-content">
                                  </i>
                                </span>
                                <input type="text" class="form-control" value="{{$check['cname']}}" name="fullname" readonly/>
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
                                  <input type="text" class="form-control" value="{{$check['ccontact']}}" name="phone" readonly/>
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
                                  <input type="text" class="form-control" value="{{$check['ctreatment']}}" name="treatment" readonly/>
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
                                  <input type="text" class="form-control" value="{{$check['camount']}}" name="amount" readonly/>
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
                                  <input type="text" class="form-control" value="{{$check['cdisc'] ? $check['cdisc'] : '0' }}" name="discount" readonly/>
                                  <span class="input-group-text">.00</span>
                              </div>
                            </div>
                        </div>

                        @php
                            $paid = App\Http\Controllers\GenxController::calculatePayment($check['cid']);
                            $balance = $check['camount'] - $check['cdisc'] - $paid;
                        @endphp

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-discount">Paid</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-discount" class="input-group-text">
                                      <i class="bx bx-dollar"></i>
                                  </span>
                                  <input type="text" class="form-control" value="{{$paid}}" name="discount" readonly/>
                                  <span class="input-group-text">.00</span>
                              </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-discount">balance</label>
                            <div class="col-sm-10">
                              <div class="input-group input-group-merge">
                                  <span id="basic-icon-default-discount" class="input-group-text">
                                      <i class="bx bx-dollar"></i>
                                  </span>
                                  <input type="text" class="form-control" value="{{$balance}}" name="discount" readonly/>
                                  <span class="input-group-text">.00</span>
                              </div>
                            </div>
                        </div>

                        @endif
                    </form>
                  </div>
                </div>
            </div>

                @if(Session::get('paymentstatus') == '2' OR Session::get('paymentstatus') == '1')
                    <div class= "d-flex justify-content-end mb-2 mt-2">
                        <a href="{{url('/visits/add')}}"> <button class="btn btn-primary"> <i class="bx bx-dollar mr-1"> </i> Add Visit </button> </a>
                    </div>
                @endif

                @if(Session::has('message'))
                <script>
                    let timerInterval
                    Swal.fire({
                    title: 'Action Successful',
                    html: 'Neno Laser Clinic',
                    timer: 5000,
                    timerProgressBar: false,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                    })
                </script>

                    {{-- <div class="toast-container">
                        <div class="bs-toast toast-placement-ex m-5 top-0 end-0 toast fade show" role="alert" aria-live="assertive" data-delay="2000" aria-atomic="true">
                            <div class="toast-header">
                                <i class="bx bx-bell me-2"></i>
                                <div class="me-auto fw-semibold">Neno Laser Clinic</div>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                {{Session('message')}}
                            </div>
                        </div>
                    </div> --}}
                @endif

                <!-- Hoverable Table rows -->
                <div class="card">
                    <div class="table-responsive text-nowrap">
                    <table class="table table-hover table-bordered">
                        @if(Session::get('paymentstatus') == '1' OR Session::get('paymentstatus') == '2')
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Visit Date</th>
                                <th>Settings</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        @endif

                        <tbody class="table-border-bottom-0">
                            @if(Session::get('paymentstatus') == '1')
                            <tr>
                                    <td colspan=13> <div class="alert alert-danger"> No Visits for Selected Customer </div> </td>
                                </tr>

                            @elseif(Session::get('paymentstatus') == '2')
                            <?php
                                $no=1;
                                $totalpaid=0;
                            ?>
                            @foreach($allpayments as $value)
                            <?php $totalpaid+=$value->pamount?>
                            <tr>
                                <td> <p style="font-size:13px"> {{$no++}} </p> </td>
                                <td> <p style="font-size:13px"> {{date('d-M-Y',strtotime($value->tdot))}} </p> </td>
                                <td> <p style="font-size:13px"> {{$value->settings}} </p> </td>
                                <td> <p style="font-size:13px"> {{$value->tcomments}} </p> </td>
                            </tr>
                            @endforeach
                            <?php $no--; ?>
                            <thead>
                            <tr>
                                <td> <p style="font-size:13px"> </p> </td>
                                <td> <div class= "d-flex justify-content-end"> <p style="font-size:13px"> <b> Total Visits </b> </p> </div> </td>
                                <td> <div class= "d-flex justify-content-end"> <p style="font-size:13px"> <b> {{$no}} </b> </p> </div> </td>
                                <td> <p style="font-size:13px"> </p> </td>
                            </tr>
                            </thead>
                            @endif
                        </tbody>
                    </table>

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
