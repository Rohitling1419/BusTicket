<x-app-layout>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
    </div>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Number of Buses Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Number of Buses</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-bus-front"></i> 
                    </div>
                    <div class="ps-3">
                    <h6>{{ $numBuses }}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Number of Users Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Number of Users</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i> 
                    </div>
                    <div class="ps-3">
                      <h6>{{ $numUsers }}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Number of Cities Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Number of Cities</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-geo-alt"></i> 
                    </div>
                    <div class="ps-3">
                      <h6>{{ $numCities }}</h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

  </main>
</x-app-layout>
