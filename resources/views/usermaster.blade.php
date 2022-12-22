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
                  <li class="breadcrumb-item active">User Master</li>
                </ol>
            </nav>

            <div class= "d-flex justify-content-end mb-2 mt-2">
                <a href="{{url('/usermaster/add')}}"> <button class="btn btn-primary"> <i class="bx bx-user-plus mr-1"> </i> Add User </button> </a>
            </div>

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
                            <a class="dropdown-item" href="{{route('usermaster.edit', ['id' => $value->id])}}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a class="dropdown-item" href="{{route('usermaster.delete', ['id' => $value->id])}}">
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
        {{-- @if(Session::has('message'))
            <script> alert("{{Session('message')}}"); </script>
        @endif --}}

    @endsection

@else
    <?php
        header('Location: /');
        die();
    ?>
@endif
