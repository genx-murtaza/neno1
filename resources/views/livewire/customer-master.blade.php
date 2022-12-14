@if (session()->has('username'))

    @extends('layouts.main')

    @section('main-section')

        <!-- Content wrapper -->
        <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> Customers</h4>
            <div class= "d-flex justify-content-end mb-2">
                <a href="{{url('/customers/adduser')}}"> <button class="btn btn-primary"> <i class="bx bx-plus-circle mr-1"> </i> Add New Customer </button> </a>
            </div>

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
