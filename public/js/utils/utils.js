$(window).keydown(function (event) {
    if (event.ctrlKey && event.keyCode === 83 && $("#btnSave")[0] !== undefined) {
        if (!$("#btnSave")[0].disabled) {
            $("#btnSave").click();
        } else {
            errorToast('Saving Failed! Fill all required fields!');
        }
        event.preventDefault();
    }
});

function parseExponential(number) {
    return (number).toExponential(2);
}

function truncateFloat(str, val) {
    str = str.toFixed(val);
    return Number(str);
}

function openInfoModal(title, infoList) {
    resourceInfoApp.clearData();
    resourceInfoApp.title = title;
    resourceInfoApp.infoList = infoList;
    $('#resourceInfoModal').modal('show');
}

function generateResultView(tableId, chartId, tableData, chartData, chartTitle) {
    generateSubPhaseTable(tableId, tableData);
    return generateSubPhaseChart(chartId, chartData, chartTitle);
}

function generateMainPhaseResult(mainPhase, tableId, chartId, chartTitle, mainPhaseSlug) {
    return axios.get("/api/results/" + project_id + "/" + mainPhase)
        .then(response => {
            logToConsole("results", {response: response}, LOG_TYPES.HTTP_REQUEST);
            generateSubPhaseTable(tableId, response.data.table);
            let chartData = orderBarChartData(response.data.chart, mainPhaseSlug);

            return generateSubPhaseChart(chartId, chartData, chartTitle);
        })
        .catch(error => {
            console.log(error);
        });
}

function generateSubPhaseTable(id, data) {
    let earthWorksResultTable = $('#' + id);
    earthWorksResultTable.bootstrapTable({
        data: data,
        pagination: false,
        classes: 'table',
    });
}

function refreshSubPhaseTableData(id, mainPhase) {
    let earthWorksResultTable = $('#' + id);
    let url = "/api/results/" + project_id + "/" + mainPhase + "/type/table";
    earthWorksResultTable.bootstrapTable('refreshOptions', {
        url: url
    });
}

function orderBarChartData(chartData, mainPhase) {
    let sortedSlugs = CHART_SLUG_ORDER[mainPhase];

    let sorted_labels = [];
    let sorted_co2e_machinery = [];
    let sorted_co2e_material = [];
    let sorted_co2e_transport = [];
    let sorted_co2e_total = [];

    sortedSlugs.forEach((slug) => {
        let index = chartData.slugs.indexOf(slug);
        sorted_labels.push(chartData.labels[index]);
        sorted_co2e_machinery.push(chartData.co2e_machinery[index]);
        sorted_co2e_material.push(chartData.co2e_material[index]);
        sorted_co2e_transport.push(chartData.co2e_transport[index]);
        sorted_co2e_total.push(chartData.co2e_total[index]);
    });

    chartData.labels = sorted_labels;
    chartData.co2e_machinery = sorted_co2e_machinery;
    chartData.co2e_material = sorted_co2e_material;
    chartData.co2e_transport = sorted_co2e_transport;
    chartData.co2e_total = sorted_co2e_total;

    return chartData
}

function generateSubPhaseChart(elemId, chartData, chartTitle) {
    const ctx = $("#" + elemId);
    const labels = chartData.labels;
    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Machinery',
                data: chartData.co2e_machinery,
                backgroundColor: CHART_COLORS.machinery,
            },
            {
                label: 'Material',
                data: chartData.co2e_material,
                backgroundColor: CHART_COLORS.material,
            },
            {
                label: 'Transportation',
                data: chartData.co2e_transport,
                backgroundColor: CHART_COLORS.transportation,
            },
            {
                label: 'Energy',
                data: chartData.co2e_energy,
                backgroundColor: CHART_COLORS.energy,
            },
            {
                label: 'Water',
                data: chartData.co2e_water,
                backgroundColor: CHART_COLORS.water,
            },
        ]
    };

    const subPhaseChartConfig = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.dataset.label + ": " + context.parsed.y + GWP_UNIT;
                        },
                        footer: function (tooltipItem) {
                            tooltipItem = tooltipItem[0];
                            let data = tooltipItem.chart.data;
                            let total = 0;
                            for (let i = 0; i < data.datasets.length; i++) {
                                if (!isNaN(data.datasets[i].data[tooltipItem.dataIndex]) && data.datasets[i].data[tooltipItem.dataIndex] !== undefined)
                                    total += data.datasets[i].data[tooltipItem.dataIndex];
                            }
                            return 'Total (' + tooltipItem.label + ") = " + truncateFloat(total, 8) + GWP_UNIT;
                        }
                    }
                },
                title: {
                    display: true,
                    text: chartTitle,
                    color: CHART_COLORS.title,
                    font: {
                        family: 'Times',
                        weight: 'bold',
                        size: 30,
                        style: 'normal',
                        lineHeight: 1.2
                    },
                },
                legend: {
                    labels: {
                        color: CHART_COLORS.title,
                        font: {
                            size: 14
                        }
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                x: {
                    stacked: true,
                    title: {
                        display: true,
                        text: "Sub Activities",
                        color: CHART_COLORS.title,

                        font: {
                            family: 'Times',
                            weight: 'bold',
                            size: 25,
                            style: 'normal',
                            lineHeight: 1.2
                        },
                        padding: {top: 5, left: 0, right: 0, bottom: 30}
                    },
                    ticks: {
                        color: CHART_COLORS.title,
                        font: {
                            size: 12,
                        },
                    }
                },
                y: {
                    stacked: true,
                    display: true,
                    title: {
                        display: true,
                        text: GWP_UNIT,
                        color: CHART_COLORS.title,
                        font: {
                            family: 'Times',
                            weight: 'bold',
                            size: 20,
                            style: 'normal',
                            lineHeight: 1.2
                        },
                        padding: {top: 30, left: 0, right: 0, bottom: 30}
                    },
                    ticks: {
                        color: CHART_COLORS.title,
                        font: {
                            size: 12,
                        },
                    }
                }
            },
        }
    };
    return new Chart(ctx, subPhaseChartConfig);
}

function updateSubPhaseChartDataSet(chart, chartData, mainPhaseSlug) {
    chartData = orderBarChartData(chartData, mainPhaseSlug);
    let datasets = [
        {
            label: 'Machinery',
            data: chartData.co2e_machinery,
            backgroundColor: CHART_COLORS.machinery,
        },
        {
            label: 'Material',
            data: chartData.co2e_material,
            backgroundColor: CHART_COLORS.material,
        },
        {
            label: 'Transportation',
            data: chartData.co2e_transport,
            backgroundColor: CHART_COLORS.transportation,
        },
        {
            label: 'Energy',
            data: chartData.co2e_energy,
            backgroundColor: CHART_COLORS.energy,
        },
        {
            label: 'Water',
            data: chartData.co2e_water,
            backgroundColor: CHART_COLORS.water,
        },
    ];
    chart.data.labels = chartData.labels;
    chart.data.datasets = datasets;
    chart.update();
}

function generatePieChart(elemId, labels, dataSet, title) {

    var options = {
        series: dataSet,
        chart: {
            width: 900,
            type: 'pie',
        },
        dataLabels: {
            style: {
                fontSize: '20px',
                fontFamily: 'Times',
                fontWeight: 'bold',
            },
        },
        labels: labels,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 900
                }
            }
        }],
        legend: {
            position: 'bottom',
            fontSize: '16px',
            fontFamily: 'Times',
            fontWeight: 400,
        },
        colors: ['#a8840d', '#56ab1a', '#2577c4', '#ed5871', '#f3fa20'],
        title: {
            text: title,
            align: 'center',
            margin: 100,
            offsetX: 0,
            offsetY: 0,
            floating: false,
            style: {
                fontSize: '30px',
                fontWeight: 'bold',
                fontFamily: 'Times',
                color: CHART_COLORS.title
            },
        },
        tooltip: {
            followCursor: true,
            shared: false,
            custom: function ({series, seriesIndex, dataPointIndex, w}) {
                let currentTotal = 0;
                series.forEach(s => {
                    currentTotal += s;
                });
                return (
                    '<div class="custom-tooltip">' +
                    "<span>" +
                    "<b>" + w.globals.labels[seriesIndex] + "</b>" +
                    ": " +
                    series[seriesIndex] + GWP_UNIT +
                    "<br/></span>" +
                    "<span><b>Total: </b>" +
                    currentTotal + GWP_UNIT +
                    "</span>" +
                    "</div>"
                );
            },
            style: {
                fontSize: '12px',
                fontFamily: 'Times'
            },
        }
    };

    var chart = new ApexCharts(document.querySelector("#" + elemId), options);
    chart.render();
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function validateEntries(component, mainPhase, subPhase) {
    let is_valid = true;

    switch (mainPhase) {
        case "earth-works":
            if (subPhase === "backFilling") {
                component.$children.forEach((entry) => {
                    if (!entry.$refs.bsatEarthWorkBackFillingEntry.validate()) {
                        is_valid = false;
                        return;
                    }
                });
                return is_valid;
            } else {
                component.$children.forEach((entry) => {
                    if (!entry.$refs.bsatEarthWorkEntry.validate()) {
                        is_valid = false;
                        return;
                    }
                });
                return is_valid;
            }
        case "sub-structure":
            component.$children.forEach((entries) => {
                return entries.$children.forEach((entry) => {
                    if (entry.field.sub_phase === "mortar_substructure") {
                        if (undefined !== entry.$refs.bsatMortarSubStructureEntry && !entry.$refs.bsatMortarSubStructureEntry.validate()) {
                            is_valid = false;
                            return;
                        }
                    } else {
                        if (undefined !== entry.$refs.bsatSubStructureEntry && !entry.$refs.bsatSubStructureEntry.validate()) {
                            is_valid = false;
                            return;
                        }
                    }
                });
            });
            return is_valid;
        case "super-structure":
            component.$children.forEach((entries) => {
                return entries.$children.forEach((entry) => {
                    if (entry.field.sub_phase === "mortar_superstructure") {
                        if (undefined !== entry.$refs.bsatMortarSuperStructureEntry && !entry.$refs.bsatMortarSuperStructureEntry.validate()) {
                            is_valid = false;
                            return;
                        }
                    } else {
                        if (undefined !== entry.$refs.bsatSuperStructureEntry && !entry.$refs.bsatSuperStructureEntry.validate()) {
                            is_valid = false;
                            return;
                        }
                    }
                });
            });
            return is_valid;
        case "internal-and-external-finishes":
            component.$children.forEach((entries) => {
                return entries.$children.forEach((entry) => {
                    if (entry.field.sub_phase === "mortar_internal_and_external_finishes") {
                        if (undefined !== entry.$refs.bsatMortarInternalExternalEntry && !entry.$refs.bsatMortarInternalExternalEntry.validate()) {
                            is_valid = false;
                            return;
                        }
                    } else {
                        if (undefined !== entry.$refs.bsatInternalExternalEntry && !entry.$refs.bsatInternalExternalEntry.validate()) {
                            is_valid = false;
                            return;
                        }
                    }
                });
            });
            return is_valid;
        case "construction-site-operations":
            component.$children.forEach((entries) => {
                return entries.$children.forEach((entry) => {
                    if (entry.field.sub_phase === "waste_generated") {
                        if (undefined !== entry.$refs.bsatConstructionOperationWasteEntry && !entry.$refs.bsatConstructionOperationWasteEntry.validate()) {
                            is_valid = false;
                            return;
                        }
                    } else {
                        if (undefined !== entry.$refs.bsatConstructionOperationEntry && !entry.$refs.bsatConstructionOperationEntry.validate()) {
                            is_valid = false;
                            return;
                        }
                    }
                });
            });
            return is_valid;
        case "energy-consumption":
            component.$children.forEach((entries) => {
                return entries.$children.forEach((entry) => {
                    if (undefined !== entry.$refs.bsatEnergyConsumptionEntry && !entry.$refs.bsatEnergyConsumptionEntry.validate()) {
                        is_valid = false;
                        return;
                    }
                });
            });
            return is_valid;
        case "water-consumption":
            component.$children.forEach((entries) => {
                return entries.$children.forEach((entry) => {
                    if (undefined !== entry.$refs.bsatWaterConsumptionEntry && !entry.$refs.bsatWaterConsumptionEntry.validate()) {
                        is_valid = false;
                        return;
                    }
                });
            });
            return is_valid;
        case "maintenance-replacement":
            component.$children.forEach((entries) => {
                return entries.$children.forEach((entry) => {
                    if (undefined !== entry.$refs.bsatMaintenanceReplacementEntry && !entry.$refs.bsatMaintenanceReplacementEntry.validate()) {
                        is_valid = false;
                        return;
                    }
                });
            });
            return is_valid;
        case "demolition-phase":
            component.$children.forEach((entries) => {
                return entries.$children.forEach((entry) => {
                    if (entry.field.sub_phase !== "landfill_salvage") {
                        if (entry.field.sub_phase === "chemicals") {
                            if (undefined !== entry.$refs.bsatChemicalEntry && !entry.$refs.bsatChemicalEntry.validate()) {
                                is_valid = false;
                                return;
                            }
                        } else {
                            if (undefined !== entry.$refs.bsatDemolitionEntry && !entry.$refs.bsatDemolitionEntry.validate()) {
                                is_valid = false;
                                return;
                            }
                        }
                    }
                });
            });
            return is_valid;
    }

    return is_valid;
}

function successToast(msg) {
    successModal.message = msg;
    $("#successModal").modal('show');
}

function errorToast(msg) {
    errorModal.message = msg
    $("#errorModal").modal('show');
}

function refreshTable(elem, url) {
    let table = $("#" + elem);
    table.bootstrapTable('refreshOptions', {
        url: url
    });
}


VueFormGenerator.validators.validateYear = function (value) {
    if (value >= 1800 && value < 10000) {
        return []
    } else {
        return ["Invalid Year."];
    }
}

VueFormGenerator.validators.validatePercentage = function (value) {
    if (value != null && value >= 0 && value <= 100) {
        return []
    } else {
        return ["Invalid Percentage."];
    }
}

VueFormGenerator.validators.validateText = function (value) {
    let re = /\d+/;
    if (value != null && value.trim().length === 0) {
        return ["Location cannot be empty!"];
    } else if (value != null && re.test(value)) {
        return ["Location cannot contain numbers!"];
    } else {
        return []
    }
}

VueFormGenerator.validators.validateLoadCapacity = function (value) {
    if (value > 0 && value <= 10000000000) {
        return []
    } else {
        return ["Invalid number."];
    }
}

VueFormGenerator.validators.validateCustomInput = function (value) {
    let re = /^(custom\s*)\b/;
    if (value != null && re.test(value.toLowerCase())) {
        return ["Name cannot start with keyword - custom"];
    } else {
        return []
    }
}


function createDataModal(elemId, formId, ref, title, submitBtnText) {
    return new Vue({
        el: "#" + elemId,
        components: {
            "vue-form-generator": VueFormGenerator.component
        },
        data() {
            return {
                vgfRef: ref,
                formId: formId,
                title: title,
                modalCss: "",
                submitBtnText: submitBtnText,
                model: {},
                schema: {},
                formOptions: {
                    validateAfterLoad: true,
                    validateAfterChanged: true
                }
            };
        },
        methods: {
            closeDataModal: function () {
            },
            clearData: function () {
            },
            validateInfoModal: function () {
            },
            onValidated(isValid, errors) {
            },
            onValidate: function ($event) {
            },
            onModelUpdated(newVal, schema) {
            },
        }
    });
}

function urlEncodeSlug(slug) {
    return slug.replaceAll("_", "-");
}

function generateResourceTable(tableId, data) {
    let resourceTable = $('#' + tableId);
    resourceTable.bootstrapTable({
        data: data,
        pageSize: 10,
        pagination: true,
        classes: 'table',
    });
    return resourceTable;
}

function getIdSelections(tableId) {
    let table = $('#' + tableId);
    return $.map(table.bootstrapTable('getSelections'), function (row) {
        return row.id
    })
}

function createDeleteConfirmationModal(elemId) {
    return new Vue({
        el: "#" + elemId,
        data() {
            return {
                id: '',
                isMultiple: false,
                message: '',
            };
        },
        methods: {
            closeModal: function () {
                $("#" + elemId).modal('hide');
            },
            confirm: function () {
            },
        }
    });
}

function createDeleteMessage(type) {
    return 'Do you really want to delete this ' + type + '? This process cannot be undone.'
}
