$(function() {
    let url = window.location.origin;

    $.ajax({
        type: "GET",
        url: url + '/admin/chart',
        dataType: "json",
        success: function(res) {
            var data = [];
            var months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

            var month = res.list.map(function(item) {
                return item.month;
            });

            var car = res.list.map(function(item) {
                return item.car;
            });

            var count = 0;
            for (let i = 0; i < months.length; i++) {
                if (month.includes(i + 1)) {
                    data.push(car[count]);
                    count++;
                } else {
                    data.push(0);
                }
            }

            var areaChartData = {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],

                datasets: [{
                    label: 'Xe ô tô',
                    backgroundColor: 'rgb(153, 204, 255)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: true,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    barPercentage: 0.5,
                    data: data,
                }]
            }

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: true,
                datasetFill: true,
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            stepSize: 2,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Xe ô tô'
                        }
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                          },
                        ticks: {
                            beginAtZero: true,
                            min: 0,
                            stepSize: 1,
                        },
                    }]
                },
               
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions,
            })
        }
    });

})