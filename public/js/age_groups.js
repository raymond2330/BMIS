var categories = [
    '0-11', '1-2', '3-5', '6-12', '13-17', '18-59', '60'
];

Highcharts.chart('age', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Age of Residents',
        style: {
            "font-family": 'Roboto, sans-serif'
        }
    },
    subtitle: {
        // text: 'Percentage of resident per age group'
    },
    accessibility: {
        point: {
            valueDescriptionFormat: '{index}. Age {xDescription}, {value}%.'
        }
    },
    xAxis: [{
        categories: categories,
        reversed: false,
        labels: {
            step: 1
        },
        accessibility: {
            description: 'Age (male)'
        }
    }, { // mirror axis on right side
        opposite: true,
        reversed: false,
        categories: categories,
        linkedTo: 0,
        labels: {
            step: 1
        },
        accessibility: {
            description: 'Age (female)'
        }
    }],
    yAxis: {
        title: {
            text: null
        },
        labels: {
            formatter: function() {
                return Math.abs(this.value) + '%';
            }
        },
        accessibility: {
            description: 'Percentage population',
            rangeDescription: 'Range: 0 to 5%'
        }
    },

    plotOptions: {
        series: {
            stacking: 'normal',
            pointWidth: 30,
            borderRadius: 1,

        }
    },

    tooltip: {
        formatter: function() {
            return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 1) + '%';
        },
        backgroundColor: '#414b62',
        style: {
            color: '#fff'
        }
    },

    series: [{
        name: 'Male',
        data: <?php echo json_encode($male_age_array); ?>

    }, {
        name: 'Female',
        data: <?php echo json_encode($female_age_array); ?>
    }],
    colors: ['#08519c', '#08306b'],
});