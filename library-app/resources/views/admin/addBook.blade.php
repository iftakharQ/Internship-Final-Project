@include('partials.header')


<!-- Alert message -->
@if(session()->has('message'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        iconColor: 'white',
        customClass: {
            popup: 'colored-toast',
        },
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
    })

    Toast.fire({
        icon: 'success',
        title: "{{ session()->get('message') }}",
    })
</script>
@endif


<div class="wrapper">

    <!-- Navbar -->
    @include('admin.topnav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper px-3 pt-5">

        <!-- Horizontal Form -->
        <div class="card card-dark m-auto" style="max-width: 45rem;">
            <div class="card-header">
                <h3 class="m-0 text-center">Add Book</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ URL::to('add_book') }}" method="post" class="form-horizontal" enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Book Title</label>
                        <div class="col-sm-10">
                            <input name="title" type="text" class="form-control" id="inputEmail3" placeholder="Add book title" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Author Name</label>
                        <div class="col-sm-10">
                            <input name="author" type="text" class="form-control" id="inputEmail3" placeholder="Add author name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" id="inputEmail3" placeholder="Add description" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input name="quantity" type="number" class="form-control" id="inputEmail3" placeholder="Add quantity" required>
                        </div>
                    </div>

                    <div class="form-group row">

                        <label for="inputEmail3" class="col-sm-2 col-form-label">Upload</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input name="book_img" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="updateFileName()" required>
                                <label class="custom-file-label" for="inputGroupFile01" id="bookImage">Choose file</label>
                            </div>
                        </div>

                    </div>

                    <script>
                        function updateFileName() {
                            var fileName = document.getElementById("inputGroupFile01").files[0].name;
                            document.getElementById("bookImage").innerText = fileName;
                        }
                    </script>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="cat_id">
                                @foreach ($data as $item)
                                <option value="{{ $item->id }}">{{ $item->cat_title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark btn-lg col-6">Add Book</button>
                </div>

                <!-- /.card-footer -->
            </form>
        </div>
        <!-- /.card -->

    </div>
    <!-- /.content-wrapper -->

    <!-- main footer -->
    @include('admin/main_footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('partials.footer')