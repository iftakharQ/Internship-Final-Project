<style>
    .requestTable {
        max-height: 35rem;
        height: auto;
        overflow-y: auto;
    }

    .requestTable::-webkit-scrollbar {
        scrollbar-width: none;
    }

    .requestTable thead th {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 1;
    }
</style>


<!-- Alert Message -->
@if(session()->has('message'))

<script>
    Swal.fire({
        title: "{{ session()->get('message') }}",
        icon: "info"
    });
</script>

@endif


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $bookCount }}</h3>

                            <p>Total Books</p>
                        </div>
                        <div class="icon">
                        <i class="ion fa-solid fa-book-open"></i>
                            <!-- <i class="ion ion-bag"></i> -->
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $borrowedBooks }}</h3>

                            <p>Borrowed Books</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                            <!-- <i class="ion ion-stats-bars"></i> -->
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pendingRequests }}</h3>

                            <p>Pending Requests</p>
                        </div>
                        <div class="icon">
                        <i class="ion fa-regular fa-hourglass-half"></i>
                            <!-- <i class="ion ion-person-add"></i> -->
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $userCount }}</h3>

                            <p>Registere Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                            <!-- <i class="ion ion-pie-graph"></i> -->
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            {{-- My table --}}
            <div class="requestTable">

                <table class="table table-striped table-dark text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Book Image</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Username</th>
                            <th scope="col">See Details</th>
                        </tr>
                    </thead>
                    <tbody>



                        @foreach ($data as $item)
                        <!-- First row set -->
                        <tr class="row-set">
                            <td class="align-middle">
                                <img class="mx-auto" src="{{ asset('uploads/'.$item->book->book_image) }}" width="70px" height="120px">
                            </td>
                            <td class="align-middle">
                                <p style="word-break: break-all;">
                                    {{ $item->book->title }}
                                </p>
                            </td>
                            <td class="align-middle">
                                <p style="word-break: break-all;">
                                    {{ $item->user->name }}
                                </p>
                            </td>
                            <td class="align-middle px-5" id="requestExpand">
                                <button class="btn btn-secondary rounded-circle" type="button" data-target="#hidden{{ $item->id }}" style="height: 40px; width: 40px;">
                                    <i class="fa-solid fa-caret-down"></i>
                                </button>
                            </td>
                        </tr>

                        <tr class="collapse-row d-none" id="hidden{{ $item->id }}">
                            <td colspan="4">
                                <div class="card">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-dark">
                                            <b>Email:</b>
                                            <span class="mx-2">{{ $item->user->email }}</span>
                                        </li>
                                        <li class="list-group-item bg-dark">
                                            <b>Phone:</b>
                                            <span class="mx-2">{{ $item->user->phone }}</span>
                                        </li>
                                        <li class="list-group-item bg-dark">
                                            <b>Quantity:</b>
                                            <span class="mx-2">{{ $item->book->quantity }}</span>
                                        </li>
                                        <li class="list-group-item bg-dark">


                                            @if($item->status == 'approved')
                                            <b>Borrow Status:</b> <span class="badge badge-success mx-2 py-1">Approved</span>
                                            @endif



                                            @if($item->status == 'returned')
                                            <b>Borrow Status:</b> <span class="badge badge-info mx-2 py-1">Returned</span>
                                            @endif



                                            @if($item->status == 'Not approved')
                                            <b>Borrow Status:</b> <span class="badge badge-danger mx-2 py-1">Not approved</span>
                                            @endif

                                        </li>
                                        <li class="list-group-item bg-dark">
                                            <b>Change Status:</b>
                                            <div>
                                                <a href="{{ URL::to('status_approved/'.$item->id) }}" class="btn btn-outline-success m-2">Approved</a>
                                                <a href="{{ URL::to('status_returned/'.$item->id) }}" class="btn btn-outline-info m-2">Returned</a>
                                                <a href="{{ URL::to('status_not_approved/'.$item->id) }}" class="btn btn-outline-danger m-2">Not Approved</a>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </td>
                        </tr>
                        @endforeach



                        <script>
                            // Add event listener to each button with class 'rounded-circle'
                            document.querySelectorAll('#requestExpand .btn.btn-secondary.rounded-circle').forEach(button => {
                                button.addEventListener('click', function() {
                                    // Get the data-target attribute (ID of the row)
                                    const targetId = button.getAttribute('data-target');
                                    const targetRow = document.querySelector(targetId);

                                    // Toggle the 'd-none' class to show or hide the row
                                    targetRow.classList.toggle('d-none');

                                    // Get the icon element inside the button
                                    const icon = button.querySelector('i');

                                    // Toggle the icon between 'fa-caret-down' and 'fa-caret-up'
                                    if (targetRow.classList.contains('d-none')) {
                                        icon.classList.remove('fa-caret-up');
                                        icon.classList.add('fa-caret-down');
                                    } else {
                                        icon.classList.remove('fa-caret-down');
                                        icon.classList.add('fa-caret-up');
                                    }
                                });
                            });
                        </script>


                        <!-- Add more row sets as needed -->
                    </tbody>
                </table>

            </div>

            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

                <!-- Left col -->
                {{--
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        
                    </div>
                    <!-- /.card -->
                </section>    
                --}}
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->

                {{--
                    <section class="col-lg-5 connectedSortable">

                    <!-- Map card -->
                    <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Visitors
                            </h3>
                            <!-- card tools -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                    <i class="far fa-calendar-alt"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>
                        <!-- /.card-body-->
                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div id="sparkline-1"></div>
                                    <div class="text-white">Visitors</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div id="sparkline-2"></div>
                                    <div class="text-white">Online</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-4 text-center">
                                    <div id="sparkline-3"></div>
                                    <div class="text-white">Sales</div>
                                </div>
                                <!-- ./col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- Calendar -->
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>    
                --}}


                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>