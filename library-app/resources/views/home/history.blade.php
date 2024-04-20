@include('home.header')


<style>
  .historyTable {
    max-height: 32rem;
    height: auto;
    overflow-y: auto;
  }

  .historyTable::-webkit-scrollbar {
    scrollbar-width: none;
  }

  .historyTable thead th {
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 1;
  }
</style>


<!-- Site wrapper -->
<div class="wrapper">

  <!-- Top Navbar -->
  @include('home.topnav')
  <!-- \Top Navbar -->

  <!-- Sidebar -->
  @include('home.sidebar')
  <!-- \Sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="contentWrapper">

    <div class="main-content d-flex justify-content-center">

      <div class="mx-4" style="width: 100%;">

        <div class="text-center my-2 homeTitle">My History</div>

        <!-- history table -->
        <div class="historyTable ">
          <table class="table text-center">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Book</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
              <tr>
                <td class="align-middle"> <!-- Added class "align-middle" -->
                  <img class="mx-auto" src="{{ URL::asset('uploads/'.$item->book->book_image) }}" width="70px" height="120px">
                </td>
                <td class="align-middle">
                  <p style="word-break: break-all;">{{ $item->book->title }}</p>
                </td> <!-- Added class "align-middle" -->
                <td class="align-middle">
                  <p style="word-break: break-all;">{{ $item->book->author }}</p>
                </td> <!-- Added class "align-middle" -->
                <td class="align-middle">
                  @if($item->status == 'approved')
                  <span class="badge badge-success mx-2 py-1">Approved</span>
                  @endif



                  @if($item->status == 'returned')
                  <span class="badge badge-info mx-2 py-1">Returned</span>
                  @endif



                  @if($item->status == 'Not approved')
                  <span class="badge badge-danger mx-2 py-1">Not approved</span>
                  @endif
                </td> <!-- Added class "align-middle" -->

                <td class="align-middle">
                  <div class="row">
                    <div class="col text-center">

                      @if($item->status == 'approved')

                      <i class="fa-regular fa-circle-check text-success" style="font-size: 40px;"></i>

                      @else
                      <a onclick="cancelRequestConfirm(event)" href="{{ URL::to('cancel_request/'.$item->id) }}" class="btn btn-warning btn-block">Cancel</a>

                      @endif

                    </div>
                  </div>
                </td> <!-- Added class "align-middle" -->
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- ./wrapper -->

</div>


<script>
  function cancelRequestConfirm(event) {

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
      confirmButtonText: "Yes, cancel it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Cancelled!",
          text: "The request has been cancelled.",
          icon: "success"
        }).then(() => {
          window.location.href = redirectURL;
        });
      }
    })
  }
</script>


@include('home.footer')