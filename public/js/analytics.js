function renderHouseholdsPerStreet(streetnames, householdsPerStreet) {
    Highcharts.chart("household_per_street", {
        chart: {
            type: "column",
        },
        title: {
            text: "Household density per street",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        subtitle: {},
        xAxis: {
            categories: streetnames,
            crosshair: true,
            labels: {
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        yAxis: {
            title: {
                useHTML: true,
                text: null,
            },
            labels: {
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        tooltip: {
            formatter: function () {
                return (
                    this.point.category +
                    "</b><br/>" +
                    "Number of households: " +
                    this.point.y
                );
            },
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        plotOptions: {
            column: {
                pointWidth: 100,
                borderRadius: 1,
                borderWidth: 3,
                borderColor: "#deebf7",
                colorByPoint: true,
            },
        },
        series: [
            {
                name: "Streets",
                data: householdsPerStreet,
            },
        ],
        legend: {
            itemStyle: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
                "font-weight": "normal",
            },
        },
        colors: [
            "#08306b",
            "#08519c",
            "#2171b5",
            "#4292c6",
            "#6baed6",
            "#9ecae1",
            "#c6dbef",
            "#deebf7",
        ],
        credits: {
            enabled: false,
        },
    });
}

function renderFamiliesPerStreet(streetnames, familiesPerStreet) {
    Highcharts.chart("families_per_street", {
        chart: {
            type: "column",
        },
        title: {
            text: "Number of Families per Street",
            style: {
                "font-family": "Ubuntu, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        subtitle: {},
        xAxis: {
            categories: streetnames,
            crosshair: true,
            labels: {
                style: {
                    "font-family": "Ubuntu, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        yAxis: {
            title: {
                useHTML: true,
                text: null,
            },
            labels: {
                style: {
                    "font-family": "Ubuntu, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        tooltip: {
            formatter: function () {
                return (
                    this.point.category +
                    "</b><br/>" +
                    "Number of families: " +
                    this.point.y
                );
            },
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Ubuntu, sans-serif",
            },
        },
        plotOptions: {
            column: {
                pointWidth: 100,
                borderRadius: 1,
                borderWidth: 3,
                borderColor: "#deebf7",
                colorByPoint: true,
            },
        },
        series: [
            {
                name: "Families",
                data: familiesPerStreet,
            },
        ],
        legend: {
            itemStyle: {
                "font-family": "Ubuntu, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
                "font-weight": "normal",
            },
        },
        colors: [
            "#08306b",
            "#08519c",
            "#2171b5",
            "#4292c6",
            "#6baed6",
            "#9ecae1",
            "#c6dbef",
            "#deebf7",
        ],
        credits: {
            enabled: false,
        },
    });
}

function renderResidentsPerStreet(streetnames, residentsPerStreet) {
    Highcharts.chart("residents_per_street", {
        chart: {
            type: "column",
        },
        title: {
            text: "Number of Residents per Street",
            style: {
                "font-family": "Ubuntu, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        subtitle: {},
        xAxis: {
            categories: streetnames,
            labels: {
                style: {
                    "font-family": "Ubuntu, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        yAxis: {
            title: {
                useHTML: true,
                text: null,
            },
            labels: {
                style: {
                    "font-family": "Ubuntu, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        tooltip: {
            formatter: function () {
                return (
                    this.point.category +
                    "</b><br/>" +
                    "Number of residents: " +
                    this.point.y
                );
            },
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Ubuntu, sans-serif",
            },
        },
        plotOptions: {
            column: {
                pointWidth: 100,
                borderRadius: 1,
                borderWidth: 3,
                borderColor: "#deebf7",
                colorByPoint: true,
            },
        },
        series: [
            {
                name: "Residents",
                data: residentsPerStreet,
            },
        ],
        legend: {
            itemStyle: {
                "font-family": "Ubuntu, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
                "font-weight": "normal",
            },
        },
        colors: [
            "#08306b",
            "#08519c",
            "#2171b5",
            "#4292c6",
            "#6baed6",
            "#9ecae1",
            "#c6dbef",
            "#deebf7",
        ],
        credits: {
            enabled: false,
        },
    });
}

function renderResidentAgePyramid(maleAgeArray, femaleAgeArray) {
    var categories = [
        "0-11 mos",
        "1-2 yrs",
        "3-5 yrs",
        "6-12 yrs",
        "13-17 yrs",
        "18-59 yrs",
        "60 above",
    ];

    Highcharts.chart("age", {
        chart: {
            type: "bar",
        },
        title: {
            text: "Age of Residents",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        subtitle: {
            // text: 'Percentage of resident per age group'
        },
        accessibility: {
            point: {
                valueDescriptionFormat:
                    "{index}. Age {xDescription}, {value}%.",
            },
        },
        xAxis: [
            {
                categories: categories,
                reversed: false,
                labels: {
                    step: 1,
                    style: {
                        "font-family": "Roboto, sans-serif",
                        color: "#353c4e",
                        "font-size": "1.1em",
                    },
                },

                accessibility: {
                    description: "Age (male)",
                },
            },
            {
                // mirror axis on right side
                opposite: true,
                reversed: false,
                categories: categories,
                linkedTo: 0,
                labels: {
                    step: 1,
                    style: {
                        "font-family": "Roboto, sans-serif",
                        color: "#353c4e",
                        "font-size": "1.1em",
                    },
                },
                accessibility: {
                    description: "Age (female)",
                },
            },
        ],
        yAxis: {
            title: {
                text: null,
            },
            labels: {
                formatter: function () {
                    return Math.abs(this.value) + "%";
                },
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
            accessibility: {
                description: "Percentage population",
                rangeDescription: "Range: 0 to 5%",
            },
        },

        plotOptions: {
            series: {
                stacking: "normal",
                pointWidth: 30,
                borderRadius: 1,
                borderWidth: 2,
                borderColor: "#deebf7",
            },
        },

        tooltip: {
            formatter: function () {
                return (
                    "<b>" +
                    this.series.name +
                    ", age " +
                    this.point.category +
                    "</b><br/>" +
                    "Population: " +
                    Highcharts.numberFormat(Math.abs(this.point.y), 1) +
                    "%"
                );
            },
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },

        series: [
            {
                name: "Male",
                data: maleAgeArray,
            },
            {
                name: "Female",
                data: femaleAgeArray,
            },
        ],
        legend: {
            itemStyle: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
                "font-weight": "normal",
            },
        },
        colors: ["#3d8af7", "#f06e9c"],
        credits: {
            enabled: false,
        },
    });
}

function renderGenderPieChart(malePercentage, femalePercentage) {
    Highcharts.chart("gender", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Gender Distribution",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: ["#3d8af7", "#f06e9c"],
                dataLabels: {
                    enabled: true,
                    format: "{point.name}<br>{point.percentage:.1f} %",
                    distance: -50,
                    style: {
                        color: "#fff",
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
            },
        },
        series: [
            {
                name: "Share",
                data: [
                    {
                        name: "Male",
                        y: malePercentage,
                    },
                    {
                        name: "Female",
                        y: femalePercentage,
                    },
                ],
            },
        ],
        credits: {
            enabled: false,
        },
    });
}

function renderEducationalAttainment(arrayEducationCategories, arrayEducation) {
    Highcharts.chart("education_attainment", {
        chart: {
            type: "bar",
        },
        title: {
            text: "Highest Educational Attainment",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        xAxis: {
            categories: arrayEducationCategories,
            title: {
                text: null,
            },
            labels: {
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        yAxis: {
            min: 0,
            title: {
                text: "Highest Educational Attainment",
                align: "high",
            },
            labels: {
                overflow: "justify",
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        tooltip: {
            formatter: function () {
                return (
                    this.point.category +
                    "</b><br/>" +
                    "Number of attainees: " +
                    this.point.y
                );
            },
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
                "font-size": "1.1em",
            },
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
                    color: "#414b62",
                    style: {
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                },
                colorByPoint: true,
                pointWidth: 20,
                borderRadius: 1,
                borderWidth: 2,
                borderColor: "#deebf7",
            },
        },
        legend: {
            layout: "vertical",
            align: "right",
            verticalAlign: "top",
            x: -40,
            y: 80,
            /* floating: true, */
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || "#FFFFFF",
            shadow: true,
        },
        credits: {
            enabled: false,
        },
        series: [
            {
                name: "",
                data: arrayEducation,
            },
        ],
        colors: [
            "#08306b",
            "#08519c",
            "#2171b5",
            "#4292c6",
            "#6baed6",
            "#9ecae1",
            "#c6dbef",
            "#deebf7",
        ],
    });
}

function renderIncomeClassResidents(
    residentPoor,
    residentLow,
    residentLowerMiddle,
    residentMiddle,
    residentUpperMiddle,
    residentHigh,
    residentRich
) {
    // Build the chart
    Highcharts.chart("resident_incomes", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Income Classification of Residents",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: [
                    "#08306b",
                    "#08519c",
                    "#2171b5",
                    "#4292c6",
                    "#6baed6",
                    "#9ecae1",
                    "#c6dbef",
                    "#deebf7",
                ],
                dataLabels: {
                    enabled: true,
                    format: "<b>{point.name}</b><br>{point.percentage:.1f} %",
                    distance: -10,
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
                showInLegend: true,
            },
        },
        credits: {
            enabled: false,
        },
        series: [
            {
                name: "Income Classification",
                data: [
                    {
                        name: "Poor",
                        y: residentPoor,
                    },
                    {
                        name: "Low income",
                        y: residentLow,
                    },
                    {
                        name: "Lower middle",
                        y: residentLowerMiddle,
                    },
                    {
                        name: "Middle",
                        y: residentMiddle,
                    },
                    {
                        name: "Upper middle",
                        y: residentUpperMiddle,
                    },
                    {
                        name: "High income",
                        y: residentHigh,
                    },
                    {
                        name: "Rich",
                        y: residentRich,
                    },
                ],
            },
        ],
    });
}
function renderIncomeClassHouseholds(
    householdPoor,
    householdLow,
    householdLowerMiddle,
    householdMiddle,
    householdUpperMiddle,
    householdHigh,
    householdRich
) {
    // Build the chart
    Highcharts.chart("household_incomes", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Income Classification of Households",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: [
                    "#08306b",
                    "#08519c",
                    "#2171b5",
                    "#4292c6",
                    "#6baed6",
                    "#9ecae1",
                    "#c6dbef",
                    "#deebf7",
                ],
                dataLabels: {
                    enabled: true,
                    format: "<b>{point.name}</b><br>{point.percentage:.1f} %",
                    distance: -10,
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
                showInLegend: true,
            },
        },
        credits: {
            enabled: false,
        },
        series: [
            {
                name: "Income Classification",
                data: [
                    {
                        name: "Poor",
                        y: householdPoor,
                    },
                    {
                        name: "Low income",
                        y: householdLow,
                    },
                    {
                        name: "Lower middle",
                        y: householdLowerMiddle,
                    },
                    {
                        name: "Middle",
                        y: householdMiddle,
                    },
                    {
                        name: "Upper middle",
                        y: householdUpperMiddle,
                    },
                    {
                        name: "High income",
                        y: householdHigh,
                    },
                    {
                        name: "Rich",
                        y: householdRich,
                    },
                ],
            },
        ],
    });
}

function renderJobClassifications(arrayJobCategories, arrayJob) {
    Highcharts.chart("job", {
        chart: {
            type: "bar",
        },
        title: {
            text: "Job Classification",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        xAxis: {
            categories: arrayJobCategories,
            title: {
                text: null,
            },
            labels: {
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        yAxis: {
            min: 0,
            title: {
                text: "Job Classification",
                align: "high",
            },
            labels: {
                overflow: "justify",
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        tooltip: {
            formatter: function () {
                return (
                    this.point.category +
                    "</b><br/>" +
                    "Number of workers: " +
                    this.point.y
                );
            },
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
                "font-size": "1.1em",
            },
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
                    color: "#414b62",
                    style: {
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                },
                colorByPoint: true,
                pointWidth: 20,
                borderRadius: 1,
                borderWidth: 2,
                borderColor: "#deebf7",
            },
        },
        legend: {
            layout: "vertical",
            align: "right",
            verticalAlign: "top",
            x: -40,
            y: 80,
            /* floating: true, */
            borderWidth: 1,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || "#FFFFFF",
            shadow: true,
        },
        credits: {
            enabled: false,
        },
        series: [
            {
                name: "",
                data: arrayJob,
            },
        ],
        colors: [
            "#08306b",
            "#08519c",
            "#2171b5",
            "#4292c6",
            "#6baed6",
            "#9ecae1",
            "#c6dbef",
            "#deebf7",
        ],
    });
}
function renderCivilStatus(civilStatusLabels, civilStatus) {
    Highcharts.chart("civil_status", {
        chart: {
            type: "column",
        },
        title: {
            text: "Civil Status of Residents",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        subtitle: {},
        xAxis: {
            categories: civilStatusLabels,
            crosshair: true,
            labels: {
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        yAxis: {
            title: {
                useHTML: true,
                text: null,
            },
            labels: {
                style: {
                    "font-family": "Roboto, sans-serif",
                    color: "#353c4e",
                    "font-size": "1.1em",
                },
            },
        },
        tooltip: {
            formatter: function () {
                return (
                    this.point.category +
                    "</b><br/>" +
                    "Number of residents: " +
                    this.point.y
                );
            },
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        plotOptions: {
            column: {
                pointWidth: 100,
                borderRadius: 1,
                borderWidth: 3,
                borderColor: "#deebf7",
                colorByPoint: true,
            },
        },
        series: [
            {
                name: "Civil Status",
                data: civilStatus,
            },
        ],
        legend: {
            itemStyle: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
                "font-weight": "normal",
            },
        },
        colors: [
            "#08306b",
            "#08519c",
            "#2171b5",
            "#4292c6",
            "#6baed6",
            "#9ecae1",
            "#c6dbef",
            "#deebf7",
        ],
        credits: {
            enabled: false,
        },
    });
}

function renderNationality(filipinosPercentage, nonfilipinosPercentage) {
    Highcharts.chart("nationality", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Nationality of Residents",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: ["#08306b", "#08519c", "#2171b5"],
                dataLabels: {
                    enabled: true,
                    format: "{point.name}<br>{point.percentage:.1f} %",
                    distance: -50,
                    style: {
                        color: "#fff",
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
            },
        },
        series: [
            {
                name: "Share",
                data: [
                    {
                        name: "Filipino",
                        y: filipinosPercentage,
                    },
                    {
                        name: "Non-Filipinos",
                        y: nonfilipinosPercentage,
                    },
                ],
            },
        ],
        credits: {
            enabled: false,
        },
    });
}
function renderReligion(catholicPercentage, incPercentage, othersPercentage) {
    Highcharts.chart("religion", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Religion",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: ["#08306b", "#08519c", "#2171b5"],
                dataLabels: {
                    enabled: true,
                    format: "{point.name}<br>{point.percentage:.1f} %",
                    distance: -50,
                    style: {
                        color: "#fff",
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
            },
        },
        series: [
            {
                name: "Percentage of residents",
                data: [
                    {
                        name: "Catholic",
                        y: catholicPercentage,
                    },
                    {
                        name: "INC",
                        y: incPercentage,
                    },
                    {
                        name: "Others",
                        y: othersPercentage,
                    },
                ],
            },
        ],
        credits: {
            enabled: false,
        },
    });
}
function renderWasteManagement(
    composting,
    incineration,
    recycled,
    waste_others
) {
    Highcharts.chart("waste_management", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Waste Management",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: ["#08306b", "#08519c", "#2171b5", "#4292c6", "#6baed6"],
                dataLabels: {
                    enabled: true,
                    format: "{point.name}<br>{point.percentage:.1f} %",
                    distance: -50,
                    style: {
                        color: "#fff",
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
            },
        },
        series: [
            {
                name: "Percentage of households",
                data: [
                    {
                        name: "Composting",
                        y: composting,
                    },
                    {
                        name: "Incineration",
                        y: incineration,
                    },
                    {
                        name: "Recycled",
                        y: recycled,
                    },
                    {
                        name: "Others",
                        y: waste_others,
                    },
                ],
            },
        ],
        credits: {
            enabled: false,
        },
    });
}
function renderToiletFacility(pail, flushed, toilet_others, no_toilet) {
    Highcharts.chart("toilet_facility", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Toilet Facility",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: ["#08306b", "#08519c", "#2171b5", "#4292c6", "#6baed6"],
                dataLabels: {
                    enabled: true,
                    format: "{point.name}<br>{point.percentage:.1f} %",
                    distance: -50,
                    style: {
                        color: "#fff",
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
            },
        },
        series: [
            {
                name: "Percentage of households",
                data: [
                    {
                        name: "Pail type",
                        y: pail,
                    },
                    {
                        name: "Flushed",
                        y: flushed,
                    },
                    {
                        name: "Others",
                        y: toilet_others,
                    },
                    {
                        name: "No toilet facility",
                        y: no_toilet,
                    },
                ],
            },
        ],
        credits: {
            enabled: false,
        },
    });
}

function renderDwellingType(concrete, semiconcrete, logwood, dwelling_others) {
    Highcharts.chart("dwelling_type", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Type of Dwelling",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: ["#08306b", "#08519c", "#2171b5", "#4292c6", "#6baed6"],
                dataLabels: {
                    enabled: true,
                    format: "{point.name}<br>{point.percentage:.1f} %",
                    distance: -50,
                    style: {
                        color: "#fff",
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
            },
        },
        series: [
            {
                name: "Percentage of households",
                data: [
                    {
                        name: "Concrete",
                        y: concrete,
                    },
                    {
                        name: "Semi-concrete",
                        y: semiconcrete,
                    },
                    {
                        name: "Log/Wood",
                        y: logwood,
                    },
                    {
                        name: "Others",
                        y: dwelling_others,
                    },
                ],
            },
        ],
        credits: {
            enabled: false,
        },
    });
}
function renderOwnershipType(
    rented,
    owned,
    sharedowner,
    sharedrenter,
    informalsettler
) {
    Highcharts.chart("ownership", {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: "pie",
        },
        title: {
            text: "Type of Ownership",
            style: {
                "font-family": "Roboto, sans-serif",
                color: "#353c4e",
                "font-size": "1.2em",
            },
        },
        tooltip: {
            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>",
            backgroundColor: "#414b62",
            style: {
                color: "#fff",
                "font-family": "Roboto, sans-serif",
            },
        },
        accessibility: {
            point: {
                valueSuffix: "%",
            },
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: "pointer",
                colors: ["#08306b", "#08519c", "#2171b5", "#4292c6", "#6baed6"],
                dataLabels: {
                    enabled: true,
                    format: "{point.name}<br>{point.percentage:.1f} %",
                    distance: -50,
                    style: {
                        color: "#fff",
                        "font-family": "Roboto, sans-serif",
                        "font-weight": "normal",
                    },
                    filter: {
                        property: "percentage",
                        operator: ">",
                        value: 4,
                    },
                },
            },
        },
        series: [
            {
                name: "Percentage of households",
                data: [
                    {
                        name: "Rented",
                        y: rented,
                    },
                    {
                        name: "Owned",
                        y: owned,
                    },
                    {
                        name: "Shared with owner",
                        y: sharedowner,
                    },
                    {
                        name: "Shared with renter",
                        y: sharedrenter,
                    },
                    {
                        name: "Informal settler",
                        y: informalsettler,
                    },
                ],
            },
        ],
        credits: {
            enabled: false,
        },
    });
}
