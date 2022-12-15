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
                <a href="{{url('/customers/adduser')}}"> <button class="btn btn-primary"> <i class="bx bx-plus-circle mr-1"> </i> Add New Customer </button> </a>
            </div>

            @if(Session::has('message'))
                <div class="toast-container">
                    <div class="bs-toast toast-placement-ex m-5 top-0 end-0 toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
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
                        <th>Visits</th>
                        <th>Reference</th>
                    </tr>
                </thead>

                <tbody class="table-border-bottom-0 font-size:xx-small" >

                    <?php $no=1; ?>
                    @foreach($allcustomers as $value)
                    <tr>
                        <td> <p style="font-size:13px"> {{$no++}} </p> </td>
                        <td> <p style="font-size:13px"> {{$value->cname}} </p> </td>
                        <td> <p style="font-size:13px"> {{$value->ccontact}} </p> </td>
                        <td> <p style="font-size:13px"> {{$value->cemail}} </p> </td>
                        <td> <p style="font-size:13px"> {{$value->cdob}} </p> </td>
                        <td> <p style="font-size:13px"> {{$value->ctreatment}} </p> </td>
                        <td> <p style="font-size:13px"> {{$value->camount}} </p> </td>
                        <td> <p style="font-size:13px"> {{$value->cdisc}} </p> </td>
                        <td> <p style="font-size:13px"> Paid </p> </td>
                        <td> <p style="font-size:13px"> Balance </p> </td>
                        <td> <p style="font-size:13px"> Visits </p> </td>
                        <td> <p style="font-size:13px"> {{$value->creference}} </p> </td>
                        {{-- <td>{{$value->cname}}</td>
                        <td>{{$value->ccontact}}</td>
                        <td>{{$value->cemail}}</td>
                        <td>{{$value->cdob}}</td>
                        <td>{{$value->ctreatment}}</td>
                        <td>{{$value->camount}}</td>
                        <td>{{$value->cdisc}}</td>
                        <td>Paid</td>
                        <td>Balance</td>
                        <td>Visits</td>
                        <td>{{$value->creference}}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            </div>
            <!--/ Hoverable Table rows -->
         {{-- {{$allcustomers->links()}} --}}
        </div>

        <!-- / Content -->
        @if(Session::has('message'))
            <script> alert("{{Session('message')}}"); </script>
        @endif

    @endsection

@else
    <?php
        header('Location: /');
        die();
    ?>
@endif
