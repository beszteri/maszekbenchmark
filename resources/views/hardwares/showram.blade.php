@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <a href="/hardwares/rams/1" class="btn btn-secondary">Go Back</a>
                </div>

                <div class="font-weight-bold">
                    <h1></h1>
                    Part: {{{$hardware->getPart()}}}  &emsp;
                    Brand: {{{$hardware->getBrand()}}} &emsp;
                    Model: {{{$hardware->getModel()}}} &emsp;
                    Score: {{{$hardware->getScore()}}}
                    <hr>
                </div>
                <h3>Compare with measured data</h3>
                <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
                <br>
                <hr>
                <h4>There are {{count($rams)}} measured {{$hardware->getModel()}} rams in the database</h4>
                <hr>
            </main>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
        const ctx = document.getElementById("myChart"),

            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [@foreach($labels as $key => $label) {{{$key}}}, @endforeach],
                    datasets: [{
                        data: [@foreach($labels as $label) {{{$label}}}, @endforeach],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        borderWidth: 4,
                        pointBackgroundColor: '#007bff'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: false,
                    }
                }
            });
    </script>

@endsection
