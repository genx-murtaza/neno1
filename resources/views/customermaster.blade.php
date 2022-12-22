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
                  <li class="breadcrumb-item active">Customers</li>
                </ol>
            </nav>

            <div class= "d-flex justify-content-end mb-2 mt-2">
                <a href="{{url('/customers/add')}}"> <button class="btn btn-primary"> <i class="bx bx-user-plus mr-1"> </i> Add New Customer </button> </a>
            </div>

                @if(Session::has('message'))
                    <div class="toast-container">
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
                    </div>
                @endif

            <!-- Hoverable Table rows -->
            <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>DOB</th>
                        <th>Treatment</th>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>Paid</th>
                        <th>Balance</th>
                        <th>Last Payment</th>
                        <th>Visits</th>
                        <th>Last Visit</th>
                        <th>Reference</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">

                    <?php $no=1; ?>
                    @foreach($allcustomers as $value)

                    @php
                        $lastPaymentDate = App\Http\Controllers\GenxController::LastPaymentDate($value->cid);
                        $firstvisit = App\Http\Controllers\GenxController::FirstVisits($value->cid);
                        $fouryear = date('Y-m-d', strtotime('-4 years'));
                        $lastvisit = App\Http\Controllers\GenxController::LastVisits($value->cid);

                        $totalvisits = App\Http\Controllers\GenxController::countVisits($value->cid);
                        $paid = App\Http\Controllers\GenxController::calculatePayment($value->cid);
                        $balance = $value->camount - $value->cdisc - $paid;
                    @endphp

                    <tr>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$no++}} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$value->cname}} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$value->ccontact ? $value->ccontact : ''}} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$value->cemail ? $value->cemail : '' }} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$value->cdob ? date('d-M-Y',strtotime($value->cdob)) : '' }} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$value->ctreatment}} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <div class= "d-flex justify-content-end"> <p style="font-size:13px"> {{$value->camount}} </div></p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <div class= "d-flex justify-content-end"> <p style="font-size:13px"> {{$value->cdisc ? $value->cdisc : '0'}} </div></p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <div class= "d-flex justify-content-end"> <p style="font-size:13px">{{$paid}}</div></p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <div class= "d-flex justify-content-end"> <p style="font-size:13px">{{$balance}}</div></p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$lastPaymentDate?date('d-M-Y',strtotime($lastPaymentDate)):''}} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$totalvisits}} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$lastvisit?date('d-M-Y',strtotime($lastvisit)):''}} </p> </td>
                    <td> @if ($firstvisit AND $fouryear > $firstvisit) <font color="red"> @endif <p style="font-size:13px"> {{$value->creference ? $value->creference : ''}} </p> </td>

                    <td>
                        <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('customers.edit', ['id' => $value->cid])}}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a class="dropdown-item" href="">
                                {{-- {{route('customers.delete', ['id' => $value->cid])}} --}}
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                        </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
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
