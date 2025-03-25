<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <!-- ./row -->        
    <div class="container mt-5 mb-5">
      <div class="col-12">
          <div class="card p-3 card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                  <h3>Order Form</h3>
                  <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                      <li class="nav-item">
                          <button class="nav-link" id="new" 
                             data-bs-toggle="tab" href="#custom-tabs-four-home" 
                             role="tab" aria-controls="custom-tabs-four-home" 
                             aria-selected="true">New Order</button>
                      </li>
                      <li class="nav-item">
                          <button class="nav-link" id="lists" 
                             data-bs-toggle="tab" href="#custom-tabs-four-profile" 
                             role="tab" aria-controls="custom-tabs-four-profile" 
                             aria-selected="false">Order Lists</button>
                      </li>
                  </ul>
              </div>
  
              @if (session('message'))
              <div class="alert alert-success alert-dismissible fade show mt-2">
                  {{ session('message') }}
                  <button type="button" class="close btn btn-default float-end ms-5" 
                          data-bs-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
  
              <div class="card-body">
                  <div id="">
                      <!-- New Order Tab -->
                      <div class="tab-pane fade show active" id="new_page" 
                           role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                          <form action="{{ route('order.submit') }}" method="post">
                              @csrf
                              <div class="row">
                                  @foreach ($dishes as $dish)
                                  <div class="col-3 text-center mb-4">
                                      <div class="card">
                                          <div class="card-body">
                                              <div style="width: 100%; height: 150px; overflow: hidden;">
                                                  <img src="{{ asset('images/'.$dish->image) }}" 
                                                       alt="{{ $dish->name }}" 
                                                       style="width: 100%; height: 100%; object-fit: cover;"><br>
                                              </div>
                                              <label>{{ $dish->name }}</label><br>
                                              <input type="number" class="form-control" 
                                                     name="{{ $dish->id }}" placeholder="Quantity">
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
  
                              @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                              @endif
  
                              <select name="table_id" class="form-control">
                                  <option value="">Select Table No</option>
                                  @foreach ($tables as $table)
                                  <option value="{{ $table->number }}">Table : {{ $table->number }}</option>
                                  @endforeach
                              </select>
                              <button class="btn btn-success btn-sm mt-3 float-end" type="submit">Submit Order</button>
                          </form>
                      </div>
  
                      <!-- Order Lists Tab -->
                      <div id="list_page">
                          <table class="table table-bordered table-hover">
                              <tr>
                                  <th>Dish Name</th>
                                  <th>Table No</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                                
                                @forEach($orders as $order)
                                <tr>
                                    <td>{{ $order->dish_id }}</td>
                                    <td>{{ $order->table_id }}</td>
                                    <td>{{ $order->status }}</td>
                                </tr>
                                @endforeach
                            </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  <!-- Ensure Bootstrap Tabs Work -->
  <script>
    $(document).ready(function(){
        $("#list_page").hide();
        $("#new").addClass("active");

        $("#new").click(function(){
            $("#new_page").show();
            $("#list_page").hide();
            $("#new").addClass("active");
            $("#lists").removeClass("active");
        });

        $("#lists").click(function(){
            $("#new_page").hide();
            $("#list_page").show();
            $("#lists").addClass("active");
            $("#new").removeClass("active");
        }); 
    });
  </script>
  <script
  src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
  integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
  crossorigin="anonymous"
></script>
<!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
<script
  src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
  crossorigin="anonymous"
></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
  integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
  crossorigin="anonymous"
></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="../../dist/js/adminlte.js"></script>
<!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
  const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
  const Default = {
    scrollbarTheme: 'os-theme-light',
    scrollbarAutoHide: 'leave',
    scrollbarClickScroll: true,
  };
  document.addEventListener('DOMContentLoaded', function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
      OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
        scrollbars: {
          theme: Default.scrollbarTheme,
          autoHide: Default.scrollbarAutoHide,
          clickScroll: Default.scrollbarClickScroll,
        },
      });
    }
  });
</script>
<!--end::OverlayScrollbars Configure-->
<!-- OPTIONAL SCRIPTS -->
<!-- sortablejs -->
<script
  src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
  integrity="sha256-ipiJrswvAR4VAx/th+6zWsdeYmVae0iJuiR+6OqHJHQ="
  crossorigin="anonymous"
></script>
<!-- sortablejs -->
<script>
  const connectedSortables = document.querySelectorAll('.connectedSortable');
  connectedSortables.forEach((connectedSortable) => {
    let sortable = new Sortable(connectedSortable, {
      group: 'shared',
      handle: '.card-header',
    });
  });

  const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
  cardHeaders.forEach((cardHeader) => {
    cardHeader.style.cursor = 'move';
  });
</script>
<!-- apexcharts -->
<script
  src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
  integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
  crossorigin="anonymous"
></script>
<!-- ChartJS -->
<script>
  // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
  // IT'S ALL JUST JUNK FOR DEMO
  // ++++++++++++++++++++++++++++++++++++++++++

  const sales_chart_options = {
    series: [
      {
        name: 'Digital Goods',
        data: [28, 48, 40, 19, 86, 27, 90],
      },
      {
        name: 'Electronics',
        data: [65, 59, 80, 81, 56, 55, 40],
      },
    ],
    chart: {
      height: 300,
      type: 'area',
      toolbar: {
        show: false,
      },
    },
    legend: {
      show: false,
    },
    colors: ['#0d6efd', '#20c997'],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: 'smooth',
    },
    xaxis: {
      type: 'datetime',
      categories: [
        '2023-01-01',
        '2023-02-01',
        '2023-03-01',
        '2023-04-01',
        '2023-05-01',
        '2023-06-01',
        '2023-07-01',
      ],
    },
    tooltip: {
      x: {
        format: 'MMMM yyyy',
      },
    },
  };

  const sales_chart = new ApexCharts(
    document.querySelector('#revenue-chart'),
    sales_chart_options,
  );
  sales_chart.render();
</script>
<!-- jsvectormap -->
<script
  src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
  integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
  crossorigin="anonymous"
></script>
<script
  src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
  integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
  crossorigin="anonymous"
></script>
<!-- jsvectormap -->
<script>
$(document).ready(function () {
    $('#example').DataTable();
});

  const visitorsData = {
    US: 398, // USA
    SA: 400, // Saudi Arabia
    CA: 1000, // Canada
    DE: 500, // Germany
    FR: 760, // France
    CN: 300, // China
    AU: 700, // Australia
    BR: 600, // Brazil
    IN: 800, // India
    GB: 320, // Great Britain
    RU: 3000, // Russia
  };

  // World map by jsVectorMap
  const map = new jsVectorMap({
    selector: '#world-map',
    map: 'world',
  });

  // Sparkline charts
  const option_sparkline1 = {
    series: [
      {
        data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
      },
    ],
    chart: {
      type: 'area',
      height: 50,
      sparkline: {
        enabled: true,
      },
    },
    stroke: {
      curve: 'straight',
    },
    fill: {
      opacity: 0.3,
    },
    yaxis: {
      min: 0,
    },
    colors: ['#DCE6EC'],
  };

  const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
  sparkline1.render();

  const option_sparkline2 = {
    series: [
      {
        data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
      },
    ],
    chart: {
      type: 'area',
      height: 50,
      sparkline: {
        enabled: true,
      },
    },
    stroke: {
      curve: 'straight',
    },
    fill: {
      opacity: 0.3,
    },
    yaxis: {
      min: 0,
    },
    colors: ['#DCE6EC'],
  };

  const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
  sparkline2.render();

  const option_sparkline3 = {
    series: [
      {
        data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
      },
    ],
    chart: {
      type: 'area',
      height: 50,
      sparkline: {
        enabled: true,
      },
    },
    stroke: {
      curve: 'straight',
    },
    fill: {
      opacity: 0.3,
    },
    yaxis: {
      min: 0,
    },
    colors: ['#DCE6EC'],
  };

  const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
  sparkline3.render();
</script>
</body>  
</html>