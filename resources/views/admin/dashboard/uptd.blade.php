@extends('layouts.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content-admin')
    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="col-span-12 2xl:col-span-8">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center gap-2 MB-3">
                        <h6 class="mb-0 text-15 grow">Jumlah Transaksi
                            {{ \Carbon\Carbon::now()->locale('id_ID')->translatedFormat('F') }}</h6>
                        {{-- <div class="relative flex items-center gap-2 dropdown shrink-0">
                            <button type="button"
                                class="flex items-center justify-center p-0 text-xs text-white size-8 btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">All</button>
                            <button type="button"
                                class="flex items-center justify-center p-0 text-xs transition-all duration-200 ease-linear size-8 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 dark:bg-sky-500/20 dark:text-sky-400 dark:hover:bg-sky-500 dark:hover:text-white dark:focus:bg-sky-500 dark:focus:text-white dark:active:bg-sky-500 dark:active:text-white dark:ring-sky-400/20">1M</button>
                            <button type="button"
                                class="flex items-center justify-center p-0 text-xs transition-all duration-200 ease-linear size-8 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 dark:bg-sky-500/20 dark:text-sky-400 dark:hover:bg-sky-500 dark:hover:text-white dark:focus:bg-sky-500 dark:focus:text-white dark:active:bg-sky-500 dark:active:text-white dark:ring-sky-400/20">6M</button>
                            <button type="button"
                                class="flex items-center justify-center p-0 text-xs transition-all duration-200 ease-linear size-8 text-sky-500 btn bg-sky-100 hover:text-white hover:bg-sky-600 focus:text-white focus:bg-sky-600 focus:ring focus:ring-sky-100 active:text-white active:bg-sky-600 active:ring active:ring-sky-100 dark:bg-sky-500/20 dark:text-sky-400 dark:hover:bg-sky-500 dark:hover:text-white dark:focus:bg-sky-500 dark:focus:text-white dark:active:bg-sky-500 dark:active:text-white dark:ring-sky-400/20">1Y</button>
                        </div> --}}
                    </div>
                    <div id="applicationReceivedChart" class="apex-charts"
                        data-chart-colors='["bg-custom-500", "bg-green-500"]' dir="ltr"></div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <div class="flex items-center mb-3">
                        <h6 class="grow text-15">Penjualan Bulan
                            {{ \Carbon\Carbon::now()->locale('id_ID')->translatedFormat('F') }}</h6>
                    </div>
                    <div class="flex items-center gap-3 my-3">
                        <div
                            class="flex items-center justify-center text-green-500 rounded-md size-12 bg-green-50 shrink-0 dark:bg-green-500/10">
                            <i data-lucide="trending-up"></i>
                        </div>
                        <div class="grow">
                            <p class="mb-1 text-slate-500 dark:text-zink-200">Total Pendapatan</p>
                            <h5 class="text-15">Rp<span class="counter-value2" data-target="0"
                                    id="total_all_income">0</span>,-
                            </h5>
                        </div>
                    </div>
                    <div id="orderStatisticsChart" class="apex-charts" data-chart-colors='["bg-purple-500", "bg-sky-500"]'
                        dir="ltr"></div>
                </div>
            </div><!--end card-->
        </div><!--end col-->

        <div class="col-span-12 2xl:col-span-4">
            <div class="grid grid-cols-12 gap-x-5">
                <div class="col-span-12 card lg:col-span-6 2xl:col-span-12">
                    <div class="card-body">
                        <div class="flex items-center mb-3">
                            <h6 class="grow text-15">Ikan Terlaris</h6>
                            {{-- <div class="relative dropdown shrink-0">
                                <button type="button"
                                    class="flex items-center justify-center size-[30px] p-0 bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-700 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10 dropdown-toggle"
                                    id="customServiceDropdown" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" class="inline-block size-4"></i>
                                </button>

                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600"
                                    aria-labelledby="customServiceDropdown">
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="#!">1 Weekly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="#!">1 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="#!">3 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="#!">6 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200"
                                            href="#!">This Yearly</a>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>

                        <ul data-simplebar class="divide-y divide-slate-200 dark:divide-zink-500" style="height: 90vh;">
                            @foreach ($popularFish as $fish)
                                <li class="flex items-center gap-3 py-2 first:pt-0 last:pb-0">
                                    <div class="w-8 h-8 rounded-full shrink-0 bg-slate-100 dark:bg-zink-600">
                                        <img src="{{ $fish->jenis_ikan->imageUrl }}" alt=""
                                            class="w-8 h-8 rounded-full">
                                    </div>
                                    <div class="grow">
                                        <h6 class="font-medium">{{ $fish->jenis_ikan->name }}</h6>
                                        <p class="text-slate-500 dark:text-zink-200">Terjual sebanyak:
                                            <strong>{{ $fish->total_quantity }}</strong>
                                        </p>
                                    </div>
                                    <div class="shrink-0">
                                        <h6>{{ rupiah($fish->total_price) }}</h6>
                                        @if ($fish->jenis_ikan->economic_value)
                                            <p class="text-slate-500 dark:text-zink-200">Ekonomis:
                                                <strong>{!! $fish->jenis_ikan->economicLabel !!}</strong>
                                            </p>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end col-->

    </div><!--end grid-->
@endsection

@push('scripts')
    <!--apexchart js-->
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- vanila calendar -->
    <script src="{{ URL::asset('assets/libs/vanilla-calendar-pro/build/vanilla-calendar.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('dashboard') }}?uptd={{ auth()->user()->uptd_id ?? request('uptd') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    transactionCountChart(response.transactionCount);
                    transactionChart(response.transactions);

                    $('#total_uptd_income').attr('data-target', response.transactions.uptdTotal);
                    $('#total_tpi_income').attr('data-target', response.transactions.tpiTotal);
                    $('#total_all_income').attr('data-target', response.transactions.grandTotal);

                    counterDashboard();
                }
            });
            renderCalendar();
        });

        function counterDashboard() {
            const counters = document.querySelectorAll(".counter-value2");
            const speed = 250;

            if (counters.length) {
                counters.forEach((counter) => {
                    const target = +counter.getAttribute("data-target");
                    const inc = target / speed;

                    let count = 0;
                    const updateCount = () => {
                        count += inc;
                        if (count < target) {
                            counter.innerText = numberWithDots(count.toFixed(0)); // Changed to dots
                            setTimeout(updateCount, 1);
                        } else {
                            counter.innerText = numberWithDots(target); // Changed to dots
                        }
                    };
                    updateCount();
                });
            }

            // Replace commas with dots
            function numberWithDots(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }

        function renderCalendar() {
            const options = {
                settings: {
                    visibility: {
                        theme: 'light',
                    },
                    selected: {
                        month: "{{ now()->month - 1 }}",
                        year: "{{ now()->year }}",
                    },
                },
                //             popups: {
                //                 '2025-08-11': {
                //                     modifier: '!bg-orange-500 !text-white text-bold',
                //                     html: `<div>
            //     <p class="text-slate-500 dark:text-zink-200">Hospitality Project Discuses</p>
            //   </div>`,
                //                 },
                //             },
            };

            const calendar = new VanillaCalendar('#calendar', options);
            calendar.init();
        }

        function transactionCountChart(resp) {
            var applicationReceivedChart = "";
            var options = {
                series: resp.series,
                chart: {
                    height: 315,
                    type: 'line',
                    stacked: false,
                    margin: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    },
                    toolbar: {
                        show: false,
                    },
                },
                stroke: {
                    width: [2, 2],
                    curve: 'smooth'
                },
                plotOptions: {
                    bar: {
                        columnWidth: '50%'
                    }
                },

                fill: {
                    opacity: [0.03, 1],
                    gradient: {
                        inverseColors: false,
                        shade: 'light',
                        type: "vertical",
                        opacityFrom: 0.85,
                        opacityTo: 0.55,
                        stops: [0, 100, 100, 100]
                    }
                },
                labels: resp.labels,
                colors: ['#3b82f6'],
                markers: {
                    size: 0
                },
                grid: {
                    padding: {
                        top: -15,
                        right: 0,
                    }
                },
                yaxis: {
                    type: 'integer',
                    min: 0,
                    labels: {
                        formatter: function(value) {
                            return parseInt(value);
                        }
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0) + " ";
                            }
                            return y;

                        }
                    }
                }
            };

            if (applicationReceivedChart != "")
                applicationReceivedChart.destroy();
            applicationReceivedChart = new ApexCharts(document.querySelector("#applicationReceivedChart"), options);
            applicationReceivedChart.render();
        }

        function transactionChart(resp) {
            var applicationTransactionChart = "";
            var options = {
                series: resp.series,
                chart: {
                    type: 'line',
                    height: 310,
                    toolbar: {
                        show: false,
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                labels: resp.labels,
                colors: ['#3b82f6'],
                dataLabels: {
                    enabled: false
                },
                grid: {
                    show: true,
                    padding: {
                        top: -20,
                        right: 0,
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    y: {
                        formatter: function(y) {
                            if (typeof y !== "undefined") {
                                return 'Rp' + y.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ',-';
                            }
                            return y;

                        }
                    }
                },
                markers: {
                    hover: {
                        sizeOffset: 4
                    }
                }
            };

            if (applicationTransactionChart != "")
                applicationTransactionChart.destroy();
            applicationTransactionChart = new ApexCharts(document.querySelector("#orderStatisticsChart"), options);
            applicationTransactionChart.render();
        }
    </script>
@endpush
