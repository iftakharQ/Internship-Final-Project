@include('partials.header')

<style>
    @media (max-width: 768px) {
        .updateImage {
            width: 15rem;
            height: 23rem;
        }
    }
</style>

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

        <div class="card mb-5">

            <h3 class="text-center mt-4">Update Book</h3>

            <div class="row no-gutters">
                <div class="col-md-4 my-auto px-4 d-flex">
                    <img class="card-img updateImage mx-auto" src="{{ asset('uploads/'.$book->book_image) }}" alt="...">
                </div>
                <div class="col-md-8 my-auto">
                    <div class="card-body">
                        <form action="{{ URL::to('update_book') }}" method="post" class="form-horizontal" enctype="multipart/form-data">

                            @csrf

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-form-label">Book Title</label>
                                    <div>
                                        <input name="title" value="{{ $book->title }}" type="text" class="form-control" id="inputEmail3" placeholder="Add book title" required>
                                        <input type="hidden" name="id", value="{{ $book->id }}">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="inputEmail3" class="col-form-label">Author Name</label>
                                    <div>
                                        <input name="author" value="{{ $book->author }}" type="text" class="form-control" id="inputEmail3" placeholder="Add author name" required>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="inputEmail3" class="col-form-label">Description</label>
                                    <div>
                                        <textarea name="description" class="form-control" id="inputEmail3" placeholder="Add description" required>{{ $book->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="inputEmail3" class="col-form-label">Quantity</label>
                                    <div>
                                        <input name="quantity" value="{{ $book->quantity }}" type="number" class="form-control" id="inputEmail3" placeholder="Add quantity" required>
                                    </div>
                                </div>

                                <div class="form-group ">

                                    <label for="inputEmail3" class="col-form-label">Upload</label>
                                    <div>
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

                                <div class="form-group ">
                                    <label class="col-form-label">Category</label>
                                    <div>
                                        <select class="form-control" name="cat_id">
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ $item->cat_title == $book->category->cat_title ? 'selected' : '' }}>
                                                {{ $item->cat_title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-dark col-6">Update Book</button>
                            </div>

                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.content-wrapper -->

    <!-- main footer -->
    @include('admin.main_footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('partials.footer')