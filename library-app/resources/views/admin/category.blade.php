@include('partials.header')

<style>
    .categoryTable {

        max-width: 45rem;
        max-height: 25rem;
        height: auto;
        overflow: auto;
    }

    .categoryTable::-webkit-scrollbar {
        scrollbar-width: none;
    }

    .categoryTable thead th {
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


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper px-2 pt-5">

        <form action="{{ URL::to('add_category') }}" method="post" class="m-auto container admin-forms" style="max-width: 45rem;">

            @csrf

            <h1 class="text-center pb-3">Add Category</h1>

            <div class="input-group mb-3">
                <input name="cat_title" type="text" class="form-control" placeholder="Add a category" aria-label="Recipient's username" aria-describedby="button-addon2" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Add</button>
                </div>
            </div>
        </form>

        <div class="mx-auto categoryTable px-2">
            <table class="table table-striped table-dark text-center mx-auto" style="max-width: 45rem;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Categories</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $item)
                    <tr>
                        <td>
                            {{$item->cat_title}}
                        </td>
                        <td>
                            <a onclick="confirmation(event)" href="{{URL::to('delete_cat/'.$item->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <!-- /.content-wrapper -->

    {{-- Main Footer --}}
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
                    text: "The category has been deleted.",
                    icon: "success"
                }).then(() => {
                    window.location.href = redirectURL;
                });
            }
        })
    }
</script>

@include('partials.footer')