@section('title', 'Results')
@extends('layouts.layout')


@section('content')
    @include('popups.resourceInfoModal')
    @include('popups.errorModal')
    @include('popups.successModal')
    <style>
        .accordion-item {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, .125);
            margin: 25px;
            border-top: 1px solid rgba(0, 0, 0, .125) !important;
        }

        .help > .icon {
            margin-bottom: 0px !important
        }

        .vue-treeselect__input {
            padding: 0px !important;
        }

        .vue-treeselect__single-value {
            padding: 5px 15px !important;
        }

        .form-control {
            height: 42px !important;
        }

        .vue-treeselect__placeholder.vue-treeselect-helper-zoom-effect-off {
            padding: 5px 15px !important;
        }

        .vue-treeselect__control {
            height: 42px;
        }

        .vgf-input-fixed {
            width: 150px !important;
            margin: 10px !important;
        }

        .bsat-tree-select {
            margin: 10px !important;
            width: 210px !important;
        }

        .bsat-tree-select-md {
            width: 400px !important;
        }

        .bsat-tree-select-md .vue-treeselect__menu {
            max-height: 700px !important;
            width: 600px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-md .vue-treeselect__list {
            width: 700px;
        }

        .bsat-accordion {
            width: 1100px;
            margin-bottom: 10px;
        }

        .bsat-accordion-item {
            width: max-content;
        }

        .bsat-entry-btn {
            margin-left: 10px;
        }

        .bsat-phase-description {
            margin-left: 25px;
            margin-bottom: 10px;
            text-align: justify;
        }

        .bsat-sub-phase-description {
            text-align: justify;
            margin-bottom: 20px;
            width: 1000px;
        }

        .bsat-sub-phase-label {
            margin-right: 15px;
        }

        .b-sat-accordion-body {
            margin-top: -40px;
        }

        .bsat-pie-chart-container {
            width: 900px;
            margin-left: 140px;
        }

        .bsat-recommendation-remove-icon {
            color: red;
        }

        .bsat-recommendation-remove-icon-container {
            padding: 7px;
            width: max-content;
            float: right;
            margin-right: -55px;
            margin-top: -52px;
            border-radius: calc(.25rem - 1px);
            border: 1px solid rgba(0, 0, 0, .125);
        }

        .file {
            height: 34px !important;
        }

        .b-sat-summary-table {
            width: 450px;
            margin: 25px;
        }

        .b-sat-summary-table-td {
            text-align: right;
        }

        #accordionConstructionPhaseResultsTable, #accordionOperationPhaseResultsTable,
        #accordionDemolitionPhaseResultsTable, #accordionSummaryResultsTable {
            width: 1500px;
        }

        #constructionPhaseResultTable tr > th:not(:first-child), td:not(:first-child) {
            text-align: right;
        }

        #operationPhaseResultTable tr > th:not(:first-child), td:not(:first-child) {
            text-align: right;
        }

        #demolitionPhaseResultTable tr > th:not(:first-child), td:not(:first-child) {
            text-align: right;
        }

        #summaryResultTable tr > th:not(:first-child), td:not(:first-child) {
            text-align: right;
        }

        .b-sat-pie-chart-description {
            margin-top: 1%;
        }

    </style>
    <div class="bsat-phase-description">
        <div class="row">
            <div class="col-md-6">
                <h1>Project Results</h1>
                The final results are shown here with respect to the three life cycle phases; Construction phase,
                Operation phase and Demolition phase. Results are given in Table and chart format with respect to
                machinery, materials and transport used during each life cycle stage, under each sub phase and also as a
                total. A summary of the results are also presented for the project. Furthermore, you can give overall
                recommendations to improve project sustainability by selecting the suitable recommendations.
            </div>
        </div>
    </div>


    <div>

        <div class="col-md-12">

            <!--  Results Accordion  -->
            <div class="accordion bsat-accordion" id="accordionResults">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseResults" aria-expanded="false"
                                aria-controls="collapseResults">
                            <div class="bsat-sub-phase-label">Results</div>
                        </button>
                    </h2>
                </div>
                <!--  Results Body Accordion  -->
                <div id="collapseResults" class="accordion-collapse collapse"
                     aria-labelledby="accordionResults"
                     data-bs-parent="#accordionResults">
                    <div class="accordion-body b-sat-accordion-body">

                        <!-- Construction Phase Results Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionConstructionPhase">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseConstructionPhase"
                                            aria-expanded="false"
                                            aria-controls="collapseConstructionPhase">
                                        <div class="bsat-sub-phase-label">Construction Phase</div>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseConstructionPhase" class="accordion-collapse collapse"
                                 aria-labelledby="accordionConstructionPhase"
                                 data-bs-parent="#accordionConstructionPhase">
                                <div class="accordion-body b-sat-accordion-body">

                                    <!-- Result Table Accordion  -->
                                    <div class="accordion bsat-accordion" id="accordionConstructionPhaseResultsTable">
                                        <div class="accordion-item bsat-accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseConstructionPhaseResultsTable"
                                                        aria-expanded="false"
                                                        aria-controls="collapseConstructionPhaseResultsTable">
                                                    <div class="bsat-sub-phase-label">Table View</div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseConstructionPhaseResultsTable"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="accordionConstructionPhaseResultsTable"
                                             data-bs-parent="#accordionConstructionPhaseResultsTable">
                                            <div class="accordion-body">
                                                <div class="justify-content-center">
                                                    <h3 class="text-center">Global Warming Potential of Construction
                                                        Phase Activities</h3>
                                                    <table id="constructionPhaseResultTable" data-unique-id="id"
                                                           class="table">
                                                        <thead>
                                                        <tr>
                                                            <th data-field="id" data-visible="false"></th>
                                                            <th data-field="label">Sub Phase</th>
                                                            <th data-field="total_machinery_co2e">kg CO₂ -
                                                                eq(Machinery)
                                                            </th>
                                                            <th data-field="total_material_co2e">kg CO₂ - eq(Material)
                                                            </th>
                                                            <th data-field="total_transport_co2e">kg CO₂ -
                                                                eq(Transportation)
                                                            </th>
                                                            <th data-field="total_energy_co2e">kg CO₂ - eq(Energy)</th>
                                                            <th data-field="total_water_co2e">kg CO₂ - eq(Water)</th>
                                                            <th data-field="total_co2e">kg CO₂ - eq(Total)</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Result Table Accordion  -->

                                    <!-- Result Chart Accordion  -->
                                    <div class="accordion bsat-accordion" id="accordionConstructionPhaseResultsChart">
                                        <div class="accordion-item bsat-accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseConstructionPhaseResultsChart"
                                                        aria-expanded="false"
                                                        aria-controls="collapseConstructionPhaseResultsChart">
                                                    <div class="bsat-sub-phase-label">Chart View</div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseConstructionPhaseResultsChart"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="accordionConstructionPhaseResultsChart"
                                             data-bs-parent="#accordionConstructionPhaseResultsChart">
                                            <div class="accordion-body">
                                                <div>
                                                    <canvas id="constructionPhaseResultChart"></canvas>
                                                </div>
                                                <div>
                                                    <div class="bsat-pie-chart-container"
                                                         id="constructionPhaseResultPieChart"></div>
                                                </div>

                                                <div id="constructionPhaseResultPieChart1"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Result Chart Accordion  -->

                                </div>

                            </div>
                        </div>
                        <!-- Construction Phase Results Accordion  -->

                        <!-- Operation Phase Results Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionOperationPhase">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOperationPhase"
                                            aria-expanded="false"
                                            aria-controls="collapseOperationPhase">
                                        <div class="bsat-sub-phase-label">Operation Phase</div>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOperationPhase" class="accordion-collapse collapse"
                                 aria-labelledby="accordionOperationPhase"
                                 data-bs-parent="#accordionOperationPhase">
                                <div class="accordion-body b-sat-accordion-body">

                                    <!-- Result Table Accordion  -->
                                    <div class="accordion bsat-accordion" id="accordionOperationPhaseResultsTable">
                                        <div class="accordion-item bsat-accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOperationPhaseResultsTable"
                                                        aria-expanded="false"
                                                        aria-controls="collapseOperationPhaseResultsTable">
                                                    <div class="bsat-sub-phase-label">Table View</div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseOperationPhaseResultsTable"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="accordionOperationPhaseResultsTable"
                                             data-bs-parent="#accordionOperationPhaseResultsTable">
                                            <div class="accordion-body">
                                                <div class="justify-content-center">
                                                    <h3 class="text-center">Global Warming Potential of Operation
                                                        Phase Activities</h3>
                                                    <table id="operationPhaseResultTable" data-unique-id="id"
                                                           class="table">
                                                        <thead>
                                                        <tr>
                                                            <th data-field="id" data-visible="false"></th>
                                                            <th data-field="label">Sub Phase</th>
                                                            <th data-field="total_machinery_co2e">kg CO₂ -
                                                                eq(Machinery)
                                                            </th>
                                                            <th data-field="total_material_co2e">kg CO₂ - eq(Material)
                                                            </th>
                                                            <th data-field="total_transport_co2e">kg CO₂ -
                                                                eq(Transportation)
                                                            </th>
                                                            <th data-field="total_energy_co2e">kg CO₂ - eq(Energy)</th>
                                                            <th data-field="total_water_co2e">kg CO₂ - eq(Water)</th>
                                                            <th data-field="total_co2e">kg CO₂ - eq(Total)</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Result Table Accordion  -->

                                    <!-- Result Chart Accordion  -->
                                    <div class="accordion bsat-accordion" id="accordionOperationPhaseResultsChart">
                                        <div class="accordion-item bsat-accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOperationPhaseResultsChart"
                                                        aria-expanded="false"
                                                        aria-controls="collapseOperationPhaseResultsChart">
                                                    <div class="bsat-sub-phase-label">Chart View</div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseOperationPhaseResultsChart"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="accordionOperationPhaseResultsChart"
                                             data-bs-parent="#accordionOperationPhaseResultsChart">
                                            <div class="accordion-body">
                                                <div>
                                                    <canvas id="operationPhaseResultChart"></canvas>
                                                </div>
                                                <div>
                                                    <div class="bsat-pie-chart-container"
                                                         id="operationPhaseResultPieChart"></div>
                                                    <div class="bsat-pie-chart-container b-sat-pie-chart-description"
                                                         id="b-sat-pie-chart-description">
                                                        If the net energy consumption during the Operation phase is
                                                        negative, the pie chart will not be displaying any negative
                                                        values. Only positive values will be displayed on the pie chart.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Result Chart Accordion  -->

                                </div>

                            </div>
                        </div>
                        <!-- Operation Phase Results Accordion  -->

                        <!-- Demolition Phase Results Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionDemolitionPhase">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseDemolitionPhase"
                                            aria-expanded="false"
                                            aria-controls="collapseDemolitionPhase">
                                        <div class="bsat-sub-phase-label">Demolition Phase</div>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseDemolitionPhase" class="accordion-collapse collapse"
                                 aria-labelledby="accordionDemolitionPhase"
                                 data-bs-parent="#accordionDemolitionPhase">
                                <div class="accordion-body b-sat-accordion-body">

                                    <!-- Result Table Accordion  -->
                                    <div class="accordion bsat-accordion" id="accordionDemolitionPhaseResultsTable">
                                        <div class="accordion-item bsat-accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseDemolitionPhaseResultsTable"
                                                        aria-expanded="false"
                                                        aria-controls="collapseDemolitionPhaseResultsTable">
                                                    <div class="bsat-sub-phase-label">Table View</div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseDemolitionPhaseResultsTable"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="accordionDemolitionPhaseResultsTable"
                                             data-bs-parent="#accordionDemolitionPhaseResultsTable">
                                            <div class="accordion-body">
                                                <div class="justify-content-center">
                                                    <h3 class="text-center">Global Warming Potential of Demolition
                                                        Phase Activities</h3>
                                                    <table id="demolitionPhaseResultTable" data-unique-id="id"
                                                           class="table">
                                                        <thead>
                                                        <tr>
                                                            <th data-field="id" data-visible="false"></th>
                                                            <th data-field="label">Sub Phase</th>
                                                            <th data-field="total_machinery_co2e">kg CO₂ -
                                                                eq(Machinery)
                                                            </th>
                                                            <th data-field="total_material_co2e">kg CO₂ - eq(Material)
                                                            </th>
                                                            <th data-field="total_transport_co2e">kg CO₂ -
                                                                eq(Transportation)
                                                            </th>
                                                            <th data-field="total_energy_co2e">kg CO₂ - eq(Energy)</th>
                                                            <th data-field="total_water_co2e">kg CO₂ - eq(Water)</th>
                                                            <th data-field="total_co2e">kg CO₂ - eq(Total)</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Result Table Accordion  -->

                                    <!-- Result Chart Accordion  -->
                                    <div class="accordion bsat-accordion" id="accordionDemolitionPhaseResultsChart">
                                        <div class="accordion-item bsat-accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseDemolitionPhaseResultsChart"
                                                        aria-expanded="false"
                                                        aria-controls="collapseDemolitionPhaseResultsChart">
                                                    <div class="bsat-sub-phase-label">Chart View</div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseDemolitionPhaseResultsChart"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="accordionDemolitionPhaseResultsChart"
                                             data-bs-parent="#accordionDemolitionPhaseResultsChart">
                                            <div class="accordion-body">
                                                <div>
                                                    <canvas id="demolitionPhaseResultChart"></canvas>
                                                </div>
                                                <div>
                                                    <div class="bsat-pie-chart-container"
                                                         id="demolitionPhaseResultPieChart"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Result Chart Accordion  -->

                                </div>

                            </div>
                        </div>
                        <!-- Demolition Phase Results Accordion  -->

                        <!-- Summary Results Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionSummary">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSummary"
                                            aria-expanded="false"
                                            aria-controls="collapseSummary">
                                        <div class="bsat-sub-phase-label">Summary</div>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseSummary" class="accordion-collapse collapse"
                                 aria-labelledby="accordionSummary"
                                 data-bs-parent="#accordionSummary">
                                <div class="accordion-body b-sat-accordion-body">

                                    <div class="b-sat-summary-table">
                                        <h3>Project kg CO &#x2082; eq</h3>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>Total kg CO &#x2082; eq</td>
                                                <td class="b-sat-summary-table-td" id="totalCO2e"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Transport kg CO &#x2082; eq</td>
                                                <td class="b-sat-summary-table-td" id="totalTransportCO2e"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Material kg CO &#x2082; eq</td>
                                                <td class="b-sat-summary-table-td" id="totalMaterialCO2e"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Machinery kg CO &#x2082; eq</td>
                                                <td class="b-sat-summary-table-td" id="totalMachineryCO2e"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Energy kg CO &#x2082; eq</td>
                                                <td class="b-sat-summary-table-td" id="totalEnergyCO2e"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Water kg CO &#x2082; eq</td>
                                                <td class="b-sat-summary-table-td" id="totalWaterCO2e"></td>
                                            </tr>
                                            <tr>
                                                <td>kgCO&#x2082; - eq / M&sup2; / year</td>
                                                <td class="b-sat-summary-table-td" id="co2eM2"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Result Table Accordion  -->
                                    <div class="accordion bsat-accordion" id="accordionSummaryResultsTable">
                                        <div class="accordion-item bsat-accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseSummaryResultsTable"
                                                        aria-expanded="false"
                                                        aria-controls="collapseSummaryResultsTable">
                                                    <div class="bsat-sub-phase-label">Table View</div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseSummaryResultsTable"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="accordionSummaryResultsTable"
                                             data-bs-parent="#accordionSummaryResultsTable">
                                            <div class="accordion-body">
                                                <div class="justify-content-center">
                                                    <h3 class="text-center">Global Warming Potential of Project</h3>
                                                    <table id="summaryResultTable"
                                                           class="table">
                                                        <thead>
                                                        <tr>
                                                            <th data-field="label">Phase</th>
                                                            <th data-field="total_machinery_co2e">kg CO₂ -
                                                                eq(Machinery)
                                                            </th>
                                                            <th data-field="total_material_co2e">kg CO₂ - eq(Material)
                                                            </th>
                                                            <th data-field="total_transport_co2e">kg CO₂ -
                                                                eq(Transportation)
                                                            </th>

                                                            <th data-field="total_energy_co2e">kg CO₂ - eq(Energy)</th>
                                                            <th data-field="total_water_co2e">kg CO₂ - eq(Water)</th>
                                                            <th data-field="total_co2e">kg CO₂ - eq(Total)</th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Result Table Accordion  -->

                                    <!-- Result Chart Accordion  -->
                                    <div class="accordion bsat-accordion" id="accordionSummaryResultsChart">
                                        <div class="accordion-item bsat-accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapseSummaryResultsChart"
                                                        aria-expanded="false"
                                                        aria-controls="collapseSummaryResultsChart">
                                                    <div class="bsat-sub-phase-label">Chart View</div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapseSummaryResultsChart"
                                             class="accordion-collapse collapse"
                                             aria-labelledby="accordionSummaryResultsChart"
                                             data-bs-parent="#accordionSummaryResultsChart">
                                            <div class="accordion-body">
                                                <div>
                                                    <canvas id="summaryResultChart"></canvas>
                                                </div>
                                                <div>
                                                    <div class="bsat-pie-chart-container"
                                                         id="summaryResultPieChart"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Result Chart Accordion  -->

                                </div>

                            </div>
                        </div>
                        <!-- Summary Results Accordion  -->

                    </div>
                </div>
                <!--  Results Body Accordion  -->
            </div>
            <!-- End Results Accordion  -->

            <!-- Recommendation Accordion  -->
            <div class="accordion bsat-accordion" id="accordionRecommendation">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseRecommendation" aria-expanded="false"
                                aria-controls="collapseRecommendation">
                            <div class="bsat-sub-phase-label">Recommendations</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseRecommendation" class="accordion-collapse collapse"
                     aria-labelledby="accordionRecommendation"
                     data-bs-parent="#accordionRecommendation">
                    <div class="accordion-body">

                        <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div"
                                            :ref="vgfRef">
                        </vue-form-generator>

                        <button id="addRecommendationBtn" class="btn btn-primary bsat-entry-btn"
                                v-on:click="addRecommendation">Add Recommendation
                        </button>

                        <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Recommendation Accordion  -->
        </div>

        <template id="projectRecommendation">

            <!--  Recommendation Template  -->
            <div class="accordion bsat-accordion" :id="field.accordionId">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                :data-bs-target="field.collapseTarget" aria-expanded="false"
                                :aria-controls="field.collapseId">
                            <div class="bsat-sub-phase-label">@{{ field.title }}</div>
                        </button>
                        <div class="bsat-recommendation-remove-icon-container">
                            <i class="fa fa-window-close bsat-recommendation-remove-icon"
                               v-on:click="removeRecommendation(field.recommendationId)"></i>
                        </div>
                    </h2>
                </div>
                <div :id="field.collapseId" class="accordion-collapse collapse" v-bind:class="cssClasses"
                     :aria-labelledby="field.accordionId"
                     :data-bs-parent="field.accordionParent">
                    <div class="accordion-body">
                        <div class="col-md-12 bsat-sub-phase-description">
                            @{{ field.description }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recommendation Template -->
        </template>

        <script>
            const project_id = {{ $project_id }};
            const PROJECT_SERVICE_LIFE = {{ $project_life }};
            let results;
            let recommendations;
            let resources;
            let projectRecommendations;
            let constructionPhaseResultTable;
            let operationPhaseResultTable;
            let demolitionPhaseResultTable;
            let summaryResultTable;
            let constructionPhaseResultChartData;
            let operationPhaseResultChartData;
            let demolitionPhaseResultChartData;
            let summaryResultChartData;

            (function () {
                const promise1 = axios.get("/api/results/" + project_id);
                const promise2 = axios.get("/api/resources/recommendations");
                const promise3 = axios.get("/api/projects/" + project_id + "/resources/recommendations");
                const promise4 = axios.get("/api/resources/" + project_id + "/results");

                Promise.all([promise1, promise2, promise3, promise4]).then(function (values) {
                    results = values[0].data;

                    constructionPhaseResultTable = values[0].data.tables.construction_phase;
                    operationPhaseResultTable = values[0].data.tables.operation_phase;
                    demolitionPhaseResultTable = values[0].data.tables.demolition_phase;

                    constructionPhaseResultChartData = values[0].data.charts.construction_phase;
                    operationPhaseResultChartData = values[0].data.charts.operation_phase;
                    demolitionPhaseResultChartData = values[0].data.charts.demolition_phase;

                    summaryResultTable = values[0].data.summary.table;
                    summaryResultChartData = values[0].data.summary.chart;

                    recommendations = values[1].data;
                    projectRecommendations = values[2].data;
                    resources = values[3].data;

                    let summary = values[0].data.summary.summary;

                    $('#totalCO2e').text(summary.project_co2e);
                    $('#totalTransportCO2e').text(summary.project_transport_co2e);
                    $('#totalMaterialCO2e').text(summary.project_material_co2e);
                    $('#totalMachineryCO2e').text(summary.project_machinery_co2e);
                    $('#totalEnergyCO2e').text(summary.project_energy_co2e);
                    $('#totalWaterCO2e').text(summary.project_water_co2e);
                    $('#co2eM2').text(summary.co2e_m2);

                    logToConsole("resp", {
                        results: values[0].data,
                        constructionPhaseResultTable: constructionPhaseResultTable,
                        operationPhaseResultTable: operationPhaseResultTable,
                        demolitionPhaseResultTable: demolitionPhaseResultTable,
                        constructionPhaseResultChartData: constructionPhaseResultChartData,
                        operationPhaseResultChartData: operationPhaseResultChartData,
                        demolitionPhaseResultChartData: demolitionPhaseResultChartData,
                        summaryResultTable: summaryResultTable,
                        summaryResultChartData: summaryResultChartData,
                        recommendations: recommendations,
                        projectRecommendations: projectRecommendations,
                    }, LOG_TYPES.HTTP_REQUEST);
                    init();
                    loadingOverlay.classList.add('hide-loader');
                });
            })();

            function init() {
                let constructionPhaseResultChart = generateResultView("constructionPhaseResultTable",
                    "constructionPhaseResultChart", constructionPhaseResultTable, constructionPhaseResultChartData,
                    CHART_TITLES.constructionPhaseResult);

                let operationPhaseResultChart = generateResultView("operationPhaseResultTable",
                    "operationPhaseResultChart", operationPhaseResultTable, operationPhaseResultChartData,
                    CHART_TITLES.operationPhaseResult);

                let demolitionPhaseResultChart = generateResultView("demolitionPhaseResultTable",
                    "demolitionPhaseResultChart", demolitionPhaseResultTable, demolitionPhaseResultChartData,
                    CHART_TITLES.demolitionPhaseResult);

                let sum = _.sum(constructionPhaseResultChartData.co2e_total);
                if (sum > 0) {
                    generatePieChart("constructionPhaseResultPieChart", constructionPhaseResultChartData.labels,
                        constructionPhaseResultChartData.co2e_total, CHART_TITLES.constructionPhaseResult);
                    $("#constructionPhaseResultPieChart").attr("visibility", "visible");
                }
                sum = _.sum(operationPhaseResultChartData.co2e_total);
                if (sum > 0) {
                    generatePieChart("operationPhaseResultPieChart", operationPhaseResultChartData.labels,
                        operationPhaseResultChartData.co2e_total, CHART_TITLES.operationPhaseResult);
                    $("#operationPhaseResultPieChart").attr("visibility", "visible");
                }

                sum = _.sum(demolitionPhaseResultChartData.co2e_total);
                if (sum > 0) {
                    generatePieChart("demolitionPhaseResultPieChart", demolitionPhaseResultChartData.labels,
                        demolitionPhaseResultChartData.co2e_total, CHART_TITLES.demolitionPhaseResult);
                    $("#demolitionPhaseResultPieChart").attr("visibility", "visible");
                }

                generateResultView("summaryResultTable", "summaryResultChart", summaryResultTable,
                    summaryResultChartData, CHART_TITLES.summaryResult);

                sum = _.sum(summaryResultChartData.co2e_total);
                if (sum > 0) {
                    generatePieChart("summaryResultPieChart", summaryResultChartData.labels,
                        summaryResultChartData.co2e_total, CHART_TITLES.summaryResult);
                    $("#summaryResultPieChart").attr("visibility", "visible");
                }

                generateComponent("elem", "data");

                $('#b-sat-pie-chart-description').hide();
                if ($('#operationPhaseResultPieChart').attr('visibility') === "visible") {
                    $('#b-sat-pie-chart-description').show();
                }
            }

            Vue.component('projectRecommendation', {
                template: '#projectRecommendation',
                props: ['field'],
                data: function () {
                    return {
                        cssClasses: "",
                    }
                },
                methods: {
                    removeRecommendation: function (recommendationId) {

                        axios.delete("/api/projects/" + project_id + "/resources/recommendations/" + recommendationId)
                            .then(async (response) => {
                                logToConsole("removeRecommendation resp", response, LOG_TYPES.HTTP_REQUEST);
                                successToast('Recommendation Removed!');
                                projectRecommendations = response.data;
                                this.$parent.$emit('generateRecommendations', projectRecommendations);
                            })
                            .catch(error => {
                                logToConsole("removeRecommendation error", error, LOG_TYPES.ERROR);
                            });
                    },
                }
            });

            function generateComponent(elem, data) {

                let vm = new Vue({
                    el: "#accordionRecommendation",

                    components: {
                        "vue-form-generator": VueFormGenerator.component
                    },

                    data() {
                        return {
                            fields: [],
                            count: 0,
                            vgfRef: "bsatProjectRecommendation",
                            model: {
                                recommendation: null
                            },
                            schema: {
                                fields: [
                                    {
                                        type: "treeSelect",
                                        label: BSAT_LABELS.projectRecommendationsSchema.recommendation,
                                        model: "recommendation",
                                        help: BSAT_TOOLTIPS.projectRecommendationsSchema.recommendation,
                                        styleClasses: 'bsat-tree-select bsat-tree-select-md',
                                        validator: ["required"],
                                        valueFormat: "object",
                                        selectOptions: {
                                            type: "recommendation",
                                            searchable: true,
                                            closeOnSelect: true,
                                            showInfoIcon: false,
                                            closeOnLabelClick: true,
                                        },
                                        values: function () {
                                            return recommendations;
                                        },
                                        onChanged: function (model, newVal, oldVal, field) {
                                        }
                                    }
                                ]
                            },

                            formOptions: {
                                validateAfterLoad: true,
                                validateAfterChanged: true
                            }
                        };
                    },
                    mounted() {
                        this.$on('generateRecommendations', this.generateRecommendations);
                        this.generateRecommendations(projectRecommendations);
                    },
                    methods: {
                        addRecommendation: async function () {

                            let recommendation = recommendations.filter(recommendation => recommendation.id ===
                                this.model.recommendation)[0];

                            if (recommendation !== undefined) {
                                if (projectRecommendations.filter(i => i.recommendation_id === recommendation.id)[0]
                                    !== undefined) {
                                    errorToast('Recommendation Already Added!');
                                } else {
                                    Promise.all([saveRecommendation({recommendation_id: recommendation.id})]).then(function (values) {
                                        projectRecommendations = values[0].data;

                                        vm.generateRecommendations(projectRecommendations);
                                    });
                                }
                            } else {
                                errorToast('Recommendation Not Selected!');
                            }
                        },
                        generateRecommendations: function (entries) {
                            this.fields = [];
                            entries.forEach((entry) => {
                                this.fields.push({
                                    'type': "projectRecommendation",
                                    'id': entry.id,
                                    'title': entry.label,
                                    'description': entry.description,
                                    'accordion': "accordion" + this.count,
                                    'accordionId': "accordion" + this.count,
                                    'accordionParent': "#accordion" + this.count,
                                    'collapseId': "collapse" + this.count,
                                    'collapseTarget': "#collapse" + this.count,
                                    'recommendationId': entry.id,
                                });
                                this.count++;
                            });
                        }
                    },
                });
            }

            async function saveRecommendation(recommendation) {
                return await axios.post("/api/projects/" + project_id + "/resources/recommendations", recommendation)
                    .then(response => {
                        logToConsole("saveRecommendation resp", response, LOG_TYPES.HTTP_REQUEST);
                        successToast('Recommendation Added!');
                        return response;
                    }).catch(error => {
                        errorToast('Failed To Add Recommendation!');
                        logToConsole("saveRecommendation error", error, LOG_TYPES.ERROR);
                    });
            }

            async function navigate(location) {
                window.location.href = location;
            }
        </script>
@stop
