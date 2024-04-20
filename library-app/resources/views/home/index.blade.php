@include('home.header')


<style>
  .homeBanner {
    width: 100%;
    /* height: 300px; */
    object-fit: cover;
  }

  .footer {
    width: 100%;
    /* Take 100% width */
    background-color: #f0f0f0;
    /* Set background color */
    padding: 10px;
    /* Add some padding */
    text-align: center;
    /* Center-align text */
    /* position: fixed; Make the footer stick to the bottom */
    bottom: 0;
    /* Position the footer at the bottom */
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    /* Add a slight shadow */
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
  <div class="content-wrapper" id="contentWrapper">

    <!-- Banner -->
    <img src="{{ asset('images/library banner.jpg') }}" class="homeBanner" alt="">

    <div class="text-center mt-4 homeTitle">Spotlight Reads</div>

    <div class="main-content d-flex justify-content-center pb-4">

      <div class="container-fluid mx-md-4 mx-3 elevation-1" style="border-radius: 10px !important;">

        <div class="container">

          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">

            @foreach ($books as $item)
            <div class="col mb-2">

              <div class="card h-80 mt-4 bookCard">

                <img src="{{ asset('uploads/'.$item->book_image) }}" class="card-img-top mx-auto mt-2 elevation-3" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $item->title }}</h5>

                  <p class="card-text mt-3"><small class="text-muted">Category : {{ $item->category->cat_title }}</small>
                  </p>

                  <div class="card-text mt-2">
                    Available
                    <i class="fa-solid fa-arrow-right mx-1"></i>
                    <span style="font-size: larger;">{{ $item->quantity }}</span>
                  </div>

                  <div class="card-text mt-2">
                    <a href="{{ URL::to('book_details/'.$item->id) }}" class="bookDetailLink">
                      View Book Details
                      <i class="fa-solid fa-arrow-right mx-2"></i>
                    </a>
                  </div>

                  <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                </div>

                <div class="card-footer">
                  <a href="{{ URL::to('borrow_book/'.$item->id) }}" class="btn btn-outline-purple w-100">Apply to Borrow</a>
                </div>

              </div>

            </div>
            @endforeach

          </div>

          <!-- Explore button -->
          <div class="mb-4 d-flex" style="height: 45px;" id="exploreButton">
            <a href="{{ URL::to('/explore') }}" class="btn btn-outline-purple m-auto d-flex px-5" style="height: 45px; font-weight: 600;">
              <i class="fa-regular fa-compass my-auto" style="font-size: x-large;"></i>
              <span class="my-auto mx-2" style="font-size: large;">Explore More</span>
              <i class="fa-solid fa-arrow-right my-auto" style="font-size: large;"></i>
            </a>
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