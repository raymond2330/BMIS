<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <figure class="highcharts-figure">

        <div id="container" style="height: 400px"></div>
    </figure>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        // Build the chart
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Income Classification of Residents',
                style: {
                    "font-family": 'Roboto, sans-serif',
                    "color": "#353c4e",
                    "font-size": '1.2em'
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
                backgroundColor: '#414b62',
                style: {
                    color: '#fff',
                    "font-family": 'Roboto, sans-serif',
                }
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    colors: ['#08306b',
                        '#08519c',
                        '#2171b5',
                        '#4292c6',
                        '#6baed6',
                        '#9ecae1',
                        '#c6dbef',
                        '#deebf7'
                    ],
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                        distance: -50,
                        filter: {
                            property: 'percentage',
                            operator: '>',
                            value: 4
                        }
                    }
                }
            },
            series: [{
                name: 'Income Classification',
                data: [{
                        name: <?php echo json_encode($incomes[0]->name); ?>,
                        y: <?php echo json_encode($incomes[0]->data); ?>
                    }, {
                        name: <?php echo json_encode($incomes[1]->name); ?>,
                        y: <?php echo json_encode($incomes[1]->data); ?>
                    },
                    {
                        name: <?php echo json_encode($incomes[2]->name); ?>,
                        y: <?php echo json_encode($incomes[2]->data); ?>
                    },
                    {
                        name: <?php echo json_encode($incomes[3]->name); ?>,
                        y: <?php echo json_encode($incomes[3]->data); ?>
                    },
                    {
                        name: <?php echo json_encode($incomes[4]->name); ?>,
                        y: <?php echo json_encode($incomes[4]->data); ?>
                    },
                    {
                        name: <?php echo json_encode($incomes[5]->name); ?>,
                        y: <?php echo json_encode($incomes[5]->data); ?>
                    },
                    {
                        name: <?php echo json_encode($incomes[6]->name); ?>,
                        y: <?php echo json_encode($incomes[6]->data); ?>
                    },



                ]
            }]

        });
    </script>
</body>

</html>