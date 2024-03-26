@extends('layouts.admin.base')
@section('title', 'Dashboard')
@section('content')
    @include('components.page-title',[
        'title' => 'Dashboard',
        'breadcrumbs' => [
            [
                'label' => 'Dashboard',
                'url' => route('admin.dashboard')
            ]
        ]
    ]) <!-- .page-title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Chauffeurs Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Chauffeurs <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $counts['chauffeurs'] }}</h6>
                                        <span class="text-success small pt-1 fw-bold">
                                            {{ round($counts['chauffeurs'] * 100 / $counts['users']) }}%
                                        </span>
                                        <span class="text-muted small pt-2 ps-1">des utilisateurs</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Chauffeurs Card -->

                    <!-- Client Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Clients <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $counts['clients'] }}</h6>
                                        <span class="text-success small pt-1 fw-bold">
                                            {{ round($counts['clients'] * 100 / $counts['users']) }}%
                                        </span>
                                        <span class="text-muted small pt-2 ps-1">des utilisateurs</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Client Card -->
                    <!-- Admin Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Administrateurs <span>| Total</span></h5>

                                <div class="d-flex align-items-center">
                                    <div
                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $counts['admins'] }}</h6>
                                        <span class="text-success small pt-1 fw-bold">
                                            {{ round($counts['admins'] * 100 / $counts['users']) }}%
                                        </span>
                                        <span class="text-muted small pt-2 ps-1">des utilisateurs</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End admins Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="card-body">
                                <h5 class="card-title">Revenu <span>| Ce Mois</span></h5>

                                <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $montantTotalPayements }} FCFA</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Locations Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Locations <span>| Totale</span></h5>

                                <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $counts['locations'] }}</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Locations Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Activités <span>/Aujourd'hui</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Sales',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Revenue',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'Customers',
                                                data: [15, 11, 32, 18, 9, 24, 11]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Chauffeurs <span>| en activités</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Vehicule</th>
                                        <th scope="col">Salaire</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topChauffeurs as /* @var App\Models\User $chauffeur */ $chauffeur)
                                            <tr>

                                            <th scope="row"><a href="#">#{{ $chauffeur->id }}</a></th>
                                            <td>
                                                <a href="{{ route('admin.users.show', $chauffeur) }}">
                                                    {{ $chauffeur->getFullName() }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="text-primary">
                                                    {{ $chauffeur->vehicule->matricule }}
                                                </a>
                                            </td>
                                            <td>{{ $chauffeur->contrat->salaire }} FCFA</td>
                                                <td>
                                                    {{ $chauffeur->notes->sum('value') }} <i class="bi bi-star"></i>
                                                </td>
                                            <td>
                                                @if($chauffeur->status)
                                                <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-success">Désactive</span>
                                                @endif
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->


                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Locations <span>| Récentes </span></h5>

                        <div class="activity">
                            @foreach($lastestLocations as /* @var App\Models\Location $location*/ $location)
                                <div class="activity-item d-flex">
                                    <div class="activite-label">{{ $location->created_at->diffInHours() }} hrs</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                    de <span class="fw-bold text-dark">{{ $location->lieu_depart }}</span> à
                                    <span class="fw-bold text-dark">{{ $location->lieu_destination }}</span> par
                                    <span class="fw-bold text-dark"> {{ $location?->chauffeur?->getFullName() }}</span>
                                    pour la distance de
                                    <span class="fw-bold text-dark"> {{ round($location->distance())}} km</span>
                                    </div>
                                </div><!-- End activity item-->
                            @endforeach
                        </div>

                    </div>
                </div><!-- End Recent Activity -->

                <!-- Stats globales -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Satistiques <span>| Globale</span></h5>
                        <div id="stats" data-variable="{{ json_encode($counts) }}"></div>

                        <div id="statsChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            const counts = document.getElementById('stats');
                            let countValue = counts.getAttribute('data-variable');
                            // obtenir la valeur de chauffeurs dans le json countValue
                            countValue = JSON.parse(countValue);
                            console.log(countValue)

                            document.addEventListener("DOMContentLoaded", () => {


                                echarts.init(document.querySelector("#statsChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'User stats',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [
                                            {
                                            value: countValue.chauffeurs,
                                            name: 'Chauffeurs'
                                            },
                                            {
                                                value: countValue.users,
                                                name: 'Utilisateurs'
                                            },
                                            {
                                                value: countValue.clients,
                                                name: 'Clients'
                                            },
                                            {
                                                value: countValue.locations,
                                                name: 'Locations'
                                            },
                                            {
                                                value: countValue.contrats,
                                                name: 'Contrats'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Stats globales-->

            </div><!-- End Right side columns -->

        </div>
    </section>

@endsection
