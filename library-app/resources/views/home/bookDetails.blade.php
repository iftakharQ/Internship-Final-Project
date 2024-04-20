@include('home.header')


<style>
  .footer {
    width: 100%;
    background-color: #f0f0f0;
    padding: 10px;
    text-align: center;
    bottom: 0;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
  }
</style>

<style>
  /* #bookDetailCard {

    background-color: var(--base-darker);
  } */

  #bookDetailCard .card-title {

    font-size: 30px;
    font-family: "Bona Nova", serif;
    font-weight: 700;
    font-style: italic;
  }

  #bookDetailCard .card-content {

    font-size: 18px;
  }

  #bookDetailCard textarea {
    width: 100%;
    /* max-height: 600px; */
    height: 100px;
    overflow: auto;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    background-color: #f9f9f9;
  }

  #bookDetailCard img {

    height: 300px;
    width: 200px;
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


<!-- Site wrapper -->
<div class="wrapper">

  <!-- Top Navbar -->
  @include('home.topnav')
  <!-- \Top Navbar -->

  <!-- Sidebar -->
  @include('home.sidebar')
  <!-- \Sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="contentWrapper" style="height: auto !important;">

    <div class="text-center pt-3 homeTitle">Book Details</div>

    <div class="main-content d-flex justify-content-center pb-4">

      <div class="container-fluid mx-md-4 mx-3" style="border-radius: 10px !important; background-color: var(--base-darker);">

        <div class="card" id="bookDetailCard">

          <img src="{{ asset('uploads/'.$book->book_image) }}" class="card-img-top mx-auto mt-4" alt="...">

          <div class="card-body">

            <div class="card-title">{{ $book->title }}</div>

            <div class="card-text my-2">
              <span class="text-primary">By </span>
              <span>{{ $book->author }}</span>
            </div>

            <div class="card-text mb-2">
              <span class="text-primary">Category</span>
              <span>{{ $book->category->cat_title }}</span>
            </div>

            <div class="card-text mb-2">
              <p class="mb-2">Description</p>
              <textarea readonly>{{ $book->description }}</textarea>
            </div>

            <div class="card-text mb-2 d-flex justify-content-between">
              <div>
                <span class="text-primary">Available books</span>
                <span>{{ $book->quantity }}</span>
              </div>
              <a href="{{ URL::to('borrow_book/'.$book->id) }}" class="btn btn-outline-purple">Apply to Borrow</a>
            </div>


          </div>
        </div>

      </div>

    </div>
    <!-- /.content-wrapper -->

    <div class="footer">
      &copy; 2024 Spellbound Pages Library | All rights reserved.
    </div>

  </div>
  <!-- ./wrapper -->

</div>


<!-- Control Sidebar -->
<!-- <aside class="control-sidebar control-sidebar-dark">
      
    </aside> -->
<!-- /.control-sidebar -->

@include('home.footer')