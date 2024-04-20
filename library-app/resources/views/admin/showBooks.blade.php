@include('partials.header')

<style>
    .bookTable {
        max-height: 35rem;
        height: auto;
        overflow-y: auto;
    }

    .bookTable::-webkit-scrollbar {
        scrollbar-width: none;
    }

    .bookTable thead th {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 1;
    }
</style>

<div class="wrapper">

    <!-- Navbar -->
    @include('admin.topnav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper px-3 pt-3">

        <h3 class="text-center">All Books</h3>

        <form action="{{ URL::to('') }}" method="post" class="m-auto container admin-forms" style="max-width: 45rem;">

            @csrf

            <div class="input-group mb-3">
                <input name="cat_title" type="text" class="form-control" placeholder="Search Books" aria-label="Recipient's username" aria-describedby="button-addon2" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-dark" type="submit" id="button-addon2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="bookTable bg-dark">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Book Image</th>
                        <th scope="col">Book Title</th>
                        <th scope="col" class="d-none d-md-table-cell">Author Name</th>
                        <th scope="col" class="d-none d-md-table-cell">Quantity</th>
                        <th scope="col" class="d-none d-md-table-cell">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="align-middle"> <!-- Added class "align-middle" -->
                            <img class="mx-auto" src="{{ URL::asset('uploads/'.$item->book_image) }}" width="70px" height="120px">
                        </td>
                        <td class="align-middle">{{ $item->title }}</td> <!-- Added class "align-middle" -->
                        <td class="d-none d-md-table-cell align-middle">{{ $item->author }}</td> <!-- Added class "align-middle" -->
                        <td class="d-none d-md-table-cell align-middle">{{ $item->quantity }}</td> <!-- Added class "align-middle" -->
                        <td class="d-none d-md-table-cell align-middle">{{ $item->category->cat_title }}</td> <!-- Added class "align-middle" -->
                        <td class="align-middle">
                            <div class="row">
                                <div class="col text-center">
                                    <a href="{{ url('edit_book', $item->id) }}" class="btn btn-primary btn-block">Update</a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col text-center">
                                    <a onclick="confirmation(event)" href="{{ URL::to('delete_book/'.$item->id) }}" class="btn btn-danger btn-block">Delete</a>
                                </div>
                            </div>
                        </td> <!-- Added class "align-middle" -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


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

<script>
    function confirmation(event) {

        event.preventDefault();
        var redirectURL = event.currentTarget.getAttribute('href');
        console.log(redirectURL)

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "The book has been deleted.",
                    icon: "success"
                }).then(() => {
                    window.location.href = redirectURL;
                });
            }
        })
    }
</script>

@include('partials.footer')