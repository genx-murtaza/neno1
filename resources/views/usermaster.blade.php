@if (session()->has('username'))

    @extends('layouts.main')

    @section('main-section')

        <!-- Content wrapper -->
        <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master /</span> User Master</h4>
            <div class= "d-flex justify-content-end mb-2">
                <a href="{{url('/usermaster/adduser')}}"> <button class="btn btn-primary"> Add User </button> </a>
            </div>

            <!-- Hoverable Table rows -->
            <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Action</th>

                    {{-- <th>
                        Full Name
                        <span onclick="sortcolumn('fullname')" class="float-right text-sm" style="cursor: pointer">
                            <i class="menu-icon tf-icons bx bx-arrow-from-bottom"> </i>
                            <i class="menu-icon tf-icons bx bx-arrow-from-top"> </i>
                        </span>
                    </th>
                    <th>
                        Username
                        <span class="float-right text-sm" style="cursor: pointer">
                            <i class="menu-icon tf-icons bx bx-arrow-from-bottom"> </i>
                            <i class="menu-icon tf-icons bx bx-arrow-from-top"> </i>
                        </span>
                    </th>
                    <th>Contact</th>
                    <th>
                        Email
                        <span class="float-right text-sm" style="cursor: pointer">
                            <i class="menu-icon tf-icons bx bx-arrow-from-bottom"> </i>
                            <i class="menu-icon tf-icons bx bx-arrow-from-top"> </i>
                        </span>
                    </th>
                    <th>
                        Level
                        <span class="float-right text-sm" style="cursor: pointer">
                            <i class="menu-icon tf-icons bx bx-arrow-from-bottom"> </i>
                            <i class="menu-icon tf-icons bx bx-arrow-from-top"> </i>
                        </span>
                    </th>
                    <th>
                        Status
                        <span class="float-right text-sm" style="cursor: pointer">
                            <i class="menu-icon tf-icons bx bx-arrow-from-bottom"> </i>
                            <i class="menu-icon tf-icons bx bx-arrow-from-top"> </i>
                        </span>
                    </th> --}}

                    </tr>
                </thead>

                <tbody class="table-border-bottom-0">

                    <?php $no=1; ?>
                    @foreach($allusers as $value)

                    <tr>
                    <td>{{$no++}}</td>
                    <td>{{$value->fullname}}</td>
                    <td>{{$value->username}}</td>
                    <td>{{$value->contact}}</td>
                    <td>{{$value->email}}</td>
                    <td>
                        <?php
                            if ($value->level == "1")
                                $levelname = "Admin";
                            elseif ($value->level == "2")
                                $levelname = "Director";
                            elseif ($value->level == "3")
                                $levelname = "Sales";
                            elseif ($value->level == "4")
                                $levelname = "Approval";
                            elseif ($value->level == "5")
                                $levelname = "Only Reports";
                            else
                                $levelname = "Invalid";
                        ?>
                        {{$levelname}}
                    </td>
                    <td>
                        @if($value->active)
                            <a title = "Click to In-Active" href="{{route('usermaster.changeactive', ['id' => $value->id])}}">
                                <span class="badge badge-success"> Active </span>
                            </a>
                        @else
                            <a title = "Click to Active" href="{{route('usermaster.changeactive', ['id' => $value->id])}}">
                                <span class="badge badge-danger"> In-Active </span>
                            </a>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('usermaster.edituser', ['id' => $value->id])}}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a class="dropdown-item" href="{{route('usermaster.deleteuser', ['id' => $value->id])}}">
                                <i class="bx bx-trash me-1"></i> Delete
                            </a>
                            <a class="dropdown-item" href="{{route('usermaster.sendpassword', ['id' => $value->id])}}">
                                <i class="bx bx-link me-1"></i> Forget Password
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
