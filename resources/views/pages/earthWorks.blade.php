@section('title', 'EarthWorks')
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

        .display-inline label {
            display: inline !important;
        }

        input[name="color"] {
            color: beige;
            margin: 10px;
            margin-left: 50px;
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
            width: 165px !important;
            margin: 10px !important;
        }

        .bsat-tree-select {
            margin: 10px !important;
            width: 210px !important;
        }

        .bsat-tree-select .vue-treeselect__menu {
            max-height: 500px !important;
            width: 400px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-md .vue-treeselect__menu {
            max-height: 500px !important;
            width: 600px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-md .vue-treeselect__list {
            width: 600px;
        }

        .bsat-tree-select-lg .vue-treeselect__menu {
            max-height: 500px !important;
            width: 700px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-lg .vue-treeselect__list {
            width: 950px;
        }

        .bsat-accordion {
            width: 1095px;
            margin-bottom: 10px;
        }

        .bsat-accordion-item {
            width: max-content;
        }

        .bsat-entry {
            border-radius: 8px;
            border-width: 1px;
            border-color: #e0e0e0;
            padding: 1%;
            border-style: solid;
            background-color: #e7f1ff;
            margin-left: 10px;
            margin-bottom: 15px
        }

        .bsat-entry-lg {
            width: 1415px;
            margin-bottom: 10px;
        }

        .bsat-back-filling-entry-md {
            width: 1230px;
            margin-bottom: 10px;
        }

        .bsat-back-filling-entry-lg {
            width: 1600px;
            margin-bottom: 10px;
        }

        .radio-list > label {
            margin: 10px;
        }

        .bsat-entry-btn {
            margin-left: 10px;
        }

        .bsat-phase-description {
            margin-left: 25px;
            margin-bottom: 10px;
            text-align: justify;
        }

        .bsat-main-phase-description {
            margin-left: 25px;
            margin-bottom: 0px;
            text-align: justify;
        }

        .bsat-sub-phase-description {
            text-align: justify;
            margin-bottom: 20px;
        }

        .bsat-label-margin-top {
            margin-top: -15px !important;
        }

        .file {
            height: 34px !important;
        }

        .bsat-results-accordion {
            width: 1300px;
        }

        #earthWorksResultTable tr > th:not(:first-child), td:not(:first-child) {
            text-align: right;
        }
    </style>
    <div class="bsat-phase-description">
        <div class="row">
            <div class="col-md-6">
                <h1>Construction Phase</h1>
                Construction phase will be comprised of 5 sub sections: Earthworks, Substructure, Superstructure,
                Internal & External finishes, and Construction site operations. Accounting of inputs and emissions
                related to material usage, onsite operations, materials transportation, etc. (to and out of site) will
                be considered.
            </div>
        </div>
    </div>



    <div>
        <div class="col-md-6 bsat-main-phase-description">
            <h2>Earthworks</h2>
            Scope of earthwork comprises all the engineering works (cutting, levelling, backfilling, excavation etc.)
            carried out to reconfigure the topography of a site to ensure the required design levels are achieved.
            Earthwork subphase will be comprised of 4 sections: site clearance, soil excavation, rock excavation and
            back
            filling.
        </div>

        <div class="col-md-12">
            <!--  Site Clearance Accordion  -->
            <div class="accordion bsat-accordion" id="accordionSiteClearance">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSiteClearance" aria-expanded="false"
                                aria-controls="collapseSiteClearance">
                            Site Clearance
                        </button>
                    </h2>
                </div>
                <div id="collapseSiteClearance" class="accordion-collapse collapse"
                     aria-labelledby="accordionSiteClearance"
                     data-bs-parent="#accordionSiteClearance">
                    <div class="accordion-body">
                        <div id="siteClearance">
                            <div class="col-md-12 bsat-sub-phase-description">
                                This section accounts for the removal of 200 mm of topsoil including vegetation/
                                accumulated waste/ debris/ boulders from the site area to ensure that it is free from
                                hazards, obstacles, or any unsightly mess.
                            </div>
                            <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                            </div>
                            <button id="btnAddSiteClearanceEntry" class="btn btn-primary bsat-entry-btn"
                                    v-on:click="addEntry">Add Entry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  End Site Clearance Accordion  -->

            <!--  Soil Excavation Accordion  -->
            <div class="accordion bsat-accordion" id="accordionSoilExcavation">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSoilExcavation" aria-expanded="false"
                                aria-controls="collapseSoilExcavation">
                            Soil Excavation
                        </button>
                    </h2>
                </div>
                <div id="collapseSoilExcavation" class="accordion-collapse collapse"
                     aria-labelledby="accordionSoilExcavation"
                     data-bs-parent="#accordionSoilExcavation">
                    <div class="accordion-body">
                        <div id="soilExcavation">
                            <div class="col-md-12 bsat-sub-phase-description">
                                This involves the removal of the soil beneath the topsoil. This may include all
                                excavation works for foundations etc.
                            </div>
                            <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                            </div>
                            <button id="btnAddSoilExcavationEntry" class="btn btn-primary bsat-entry-btn"
                                    v-on:click="addEntry">Add Entry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  End Soil Excavation Accordion  -->

            <!--  Rock Excavation Accordion  -->
            <div class="accordion bsat-accordion" id="accordionRockExcavation">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseRockExcavation" aria-expanded="false"
                                aria-controls="collapseRockExcavation">
                            Rock Excavation
                        </button>
                    </h2>
                </div>
                <div id="collapseRockExcavation" class="accordion-collapse collapse"
                     aria-labelledby="accordionRockExcavation"
                     data-bs-parent="#accordionRockExcavation">
                    <div class="accordion-body">
                        <div id="rockExcavation">
                            <div class="col-md-12 bsat-sub-phase-description">
                                This involves the removal of rocks that usually requires special excavation methods
                            </div>
                            <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                            </div>
                            <button id="btnAddRockExcavationEntry" class="btn btn-primary bsat-entry-btn"
                                    v-on:click="addEntry">Add Entry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  End Rock Excavation Accordion  -->

            <!--  Back Filling Accordion  -->
            <div class="accordion bsat-accordion" id="accordionBackFilling">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseBackFilling" aria-expanded="false"
                                aria-controls="collapseBackFilling">
                            Back Filling
                        </button>
                    </h2>
                </div>
                <div id="collapseBackFilling" class="accordion-collapse collapse"
                     aria-labelledby="accordionBackFilling"
                     data-bs-parent="#accordionBackFilling">
                    <div class="accordion-body">
                        <div id="backFilling">
                            <div class="col-md-12 bsat-sub-phase-description">
                                Backfilling is defined here as processed of replacing or reusing the soil that was
                                removed during excavation to strengthen and support the structure’s foundation or any
                                other structural members. Backfilling material can vary between soil and other
                                preferable filling materials. Use this section to enter all material related to back
                                filling activities.
                            </div>
                            <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                            </div>
                            <button id="btnAddBackFillingEntry" class="btn btn-primary bsat-entry-btn"
                                    v-on:click="addEntry">Add Entry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  End Back Filling Accordion  -->

            <!--  Results Accordion  -->
            <div class="accordion bsat-accordion" id="accordionResults">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseResults" aria-expanded="false"
                                aria-controls="collapseResults">
                            Results
                        </button>
                    </h2>
                </div>
                <div id="collapseResults" class="accordion-collapse collapse"
                     aria-labelledby="accordionResults"
                     data-bs-parent="#accordionResults">
                    <div class="accordion-body">
                        <div class="col-md-12">
                            <p class="bsat-result-description">
                                The global warming potential (kg CO₂ - eq) related to Earthworks activities such as Site
                                clearance, Soil excavation, Rock excavation and Back filling are displayed with respect
                                to
                                machinery, material, transport, energy and water related impacts. The user can use this
                                information to further analyze the hotspots of different construction activities and
                                operations.
                            </p>
                        </div>
                        <!-- Result Table Accordion  -->
                        <div class="accordion bsat-results-accordion" id="accordionEarthWorksResultsTable">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseEarthWorksResultsTable" aria-expanded="false"
                                            aria-controls="collapseEarthWorksResultsTable">
                                        <div class="bsat-sub-phase-label">Table View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseEarthWorksResultsTable" class="accordion-collapse collapse"
                                 aria-labelledby="accordionEarthWorksResultsTable"
                                 data-bs-parent="#accordionEarthWorksResultsTable">
                                <div class="accordion-body">
                                    <div class="justify-content-center">
                                        <h3 class="text-center">Global Warming Potential of Earthwork Activities</h3>
                                        <table id="earthWorksResultTable" data-unique-id="id" class="table">
                                            <thead>
                                            <tr>
                                                <th data-field="id" data-visible="false"></th>
                                                <th data-field="sub_phase">Sub Phase</th>
                                                <th data-field="machinery_co2_emission">kg CO₂ - eq(Machinery)</th>
                                                <th data-field="material_co2_emission">kg CO₂ - eq(Material)</th>
                                                <th data-field="transport_co2_emission">kg CO₂ - eq(Transportation)</th>
                                                <th data-field="energy_co2_emission">kg CO₂ - eq(Energy)</th>
                                                <th data-field="water_co2_emission">kg CO₂ - eq(Water)</th>
                                                <th data-field="total_co2_emission">kg CO₂ - eq(Total)</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Result Table Accordion  -->


                        <!-- Result Chart Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionEarthWorksResultsChart">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseEarthWorksResultsChart" aria-expanded="false"
                                            aria-controls="collapseEarthWorksResultsChart">
                                        <div class="bsat-sub-phase-label">Chart View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseEarthWorksResultsChart" class="accordion-collapse collapse"
                                 aria-labelledby="accordionEarthWorksResultsChart"
                                 data-bs-parent="#accordionEarthWorksResultsChart">
                                <div class="accordion-body">
                                    <div>
                                        <canvas id="earthWorksResultChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Result Chart Accordion  -->

                    </div>
                </div>
            </div>
            <!-- End Results Accordion  -->


        </div>
    </div>

    <!-- Earth Work Entry Template -->
    <template id="bsatEarthWorkEntry">
        <div class="bsat-entry" :id="field.id" style="">
            <div style="text-align: right">
                <i class="fa fa-window-close" style="color: red"
                   v-on:click="removeEntry(field.is_new,field.entry_id)"></i>
            </div>
            <div>
                <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div"
                                    :ref="vgfRef"
                                    @model-updated="onModelUpdated" @validated="onValidated">
                </vue-form-generator>
            </div>
        </div>
    </template>
    <!-- End Earth Work Entry Template  -->

    <!-- Earth Work Back Filling Entry Template -->
    <template id="bsatEarthWorkBackFillingEntry">
        <div class="bsat-entry" :id="field.id" style="">
            <div style="text-align: right">
                <i class="fa fa-window-close" style="color: red"
                   v-on:click="removeEntry(field.is_new,field.entry_id)"></i>
            </div>
            <div>
                <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div" :ref="vgfRef"
                                    @model-updated="onModelUpdated" @validated="onValidated">
                </vue-form-generator>
            </div>
        </div>
    </template>
    <!-- End Earth Work Back Filling Entry Template  -->

    <script>
        let user_id = {{ Auth::user()->id }};
        let project_id = {{ $project_id }};
        let resources;
        let earthWorksChart;
        let siteClearance;
        let soilExcavation;
        let rockExcavation;
        let backFilling;

        (function () {
            const promise1 = axios.get("/api/resources/" + project_id + "/earth-works");

            Promise.all([promise1]).then(function (values) {
                resources = values[0].data;

                logToConsole("resources resp", {resources: resources}, LOG_TYPES.HTTP_REQUEST);
                init();
                loadingOverlay.classList.add('hide-loader');
            });
        })();

        async function init() {
            initEarthWorks();
            earthWorksChart = await generateMainPhaseResult("earth-works", "earthWorksResultTable",
                "earthWorksResultChart", CHART_TITLES.earthWorkPhase, "earthWorks");
        }

        function initEarthWorks() {

            Vue.component('bsatEarthWorkEntry', {
                template: '#bsatEarthWorkEntry',
                props: ['field'],
                components: {
                    "vue-form-generator": VueFormGenerator.component
                },

                data: function () {
                    let field = this.field;
                    let quantityLabel = field.quantity_label;
                    let quantityToolTip = field.quantity_tooltip;
                    let difficultyLevelToolTip = field.difficulty_level_tooltip;
                    let new_model = {
                        id: 0,
                        is_updated: 0,
                        is_new: 1,
                        quantity: 1,
                        difficulty_level_id: null,
                        machinery_id: null,
                        machine_hours: 1,
                        machinery_co2e: 0,
                        machinery_co2e_label: 0,
                        spoil_transported_outside: 0,
                        total_quantity: 0,
                        total_bulking_quantity: 0,
                        spoil_transport_vehicle_id: null,
                        location_id: null,
                        other_location: "Location",
                        other_location_distance: 100,
                        total_distance: 0,
                        transport_co2e: 0,
                        transport_co2e_label: 0,
                        total_co2e: 0,
                        data: {
                            difficulty_data: 1,
                            machine_data: 1,
                            transport_data: 1,
                        }
                    }
                    return {
                        vgfRef: "bsatEarthWorkEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "input",
                                inputType: "number",
                                label: quantityLabel,
                                model: "quantity",
                                help: quantityToolTip,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    if (field.sub_phase == "site-clearance") {
                                        model.total_quantity = truncateFloat(model.quantity * 0.2, 5);
                                    } else {
                                        model.total_quantity = truncateFloat(model.quantity, 5);
                                    }
                                    logToConsole("quantity onChanged", model.total_quantity, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "select",
                                label: BSAT_LABELS.bsatEarthWorkEntry.difficultyLevel,
                                model: "difficulty_level_id",
                                help: difficultyLevelToolTip,
                                styleClasses: 'bsat-tree-select',
                                required: true,
                                validator: ["integer", "required"],
                                values: function () {
                                    return field.difficulty_level;
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    model.data.difficulty_data = field.values().filter(i => i.id === newVal)[0];
                                    logToConsole("difficulty_level onChanged", model.data.difficulty_data, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatEarthWorkEntry.machinery,
                                model: "machinery_id",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.machinery,
                                styleClasses: 'bsat-tree-select bsat-tree-select-lg',
                                required: true,
                                validator: function (value, field, model) {
                                    if (!value) {
                                        return ["This field is required!"];
                                    } else {
                                        return []
                                    }
                                },
                                values: function () {
                                    return field.machines;
                                },
                                options: field.machines,
                                selectOptions: {
                                    type: "machine",
                                    searchable: true,
                                    closeOnSelect: false,
                                    showInfoIcon: true,
                                    closeOnLabelClick: true,
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    model.data.machine_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.machine_data = field.values().filter(i => i.id === newVal)[0];

                                        if (model.data.machine_data === undefined) {
                                            model.data.machine_data = field.values().filter(i => i.id === "UM00")[0].children
                                                .filter(i => i.id === newVal)[0];
                                        }
                                    }
                                    logToConsole("machine onChanged", model.data.machine_data, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkEntry.machineHours,
                                model: "machine_hours",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.machineHours,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkEntry.machineryCO2e,
                                model: "machinery_co2e",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.machineryCO2e,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true,
                            }, {
                                type: "radios",
                                label: BSAT_LABELS.bsatEarthWorkEntry.spoilTransportOutside,
                                model: "spoil_transported_outside",
                                values: [{
                                    name: "Yes",
                                    value: 1
                                },
                                    {
                                        name: "No",
                                        value: 0
                                    },
                                ],
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.spoilTransportOutside,
                                styleClasses: 'col-md-12 display-inline',
                                required: true,
                                validator: ["integer", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    setTimeout(() => {
                                        if (field.sub_phase == "site-clearance") {
                                            model.total_quantity = truncateFloat(model.quantity * 0.2, 5);
                                        } else {
                                            model.total_quantity = truncateFloat(model.quantity, 5);
                                        }
                                        logToConsole("spoil_transported_outside onChanged", model.total_quantity, LOG_TYPES.EVENT);
                                        this.$parent.$parent.$parent.$emit("calculate", this);
                                    }, 100);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkEntry.totalQuantity,
                                model: "total_quantity",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.totalQuantity,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatEarthWorkEntry.spoilTransportVehicle,
                                model: "spoil_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.spoilTransportVehicle,
                                styleClasses: 'bsat-tree-select bsat-tree-select-md',
                                required: true,
                                validator: ["required"],
                                valueFormat: "object",
                                selectOptions: {
                                    type: "vehicle",
                                    searchable: true,
                                    closeOnSelect: false,
                                    showInfoIcon: true,
                                    closeOnLabelClick: true,
                                },
                                values: function () {
                                    return field.vehicles;
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    model.data.transport_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.transport_data = field.values().filter(i => i.id === newVal)[0]

                                        if (model.data.transport_data === undefined) {
                                            model.data.transport_data = field.values().filter(i => i.id === "UV00")[0]
                                                .children.filter(i => i.id === newVal)[0];
                                        }
                                    }
                                    logToConsole("transport onChanged", model.data.transport_data, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatEarthWorkEntry.location,
                                model: "location_id",
                                styleClasses: 'bsat-tree-select',
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.location,
                                required: true,
                                validator: ["required"],
                                valueFormat: "object",
                                selectOptions: {
                                    type: "location",
                                    searchable: true,
                                    closeOnSelect: true,
                                    showInfoIcon: false,
                                    closeOnLabelClick: true,
                                },
                                values: function () {
                                    return resources.destinations;
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "input",
                                inputType: "text",
                                label: BSAT_LABELS.bsatEarthWorkEntry.otherLocation,
                                model: "other_location",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.otherLocation,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                validator: ["validateText", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    if (undefined != this.$options.parent.$el) {
                                        if (model && model.spoil_transported_outside && model.location_id === -1) {
                                            this.$options.parent.$el.classList.add("bsat-entry-lg");
                                        } else {
                                            this.$options.parent.$el.classList = ["bsat-entry"];
                                        }
                                    }
                                    return model && model.spoil_transported_outside && model.location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkEntry.otherLocationDistance,
                                model: "other_location_distance",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.otherLocationDistance,
                                styleClasses: 'vgf-input-fixed  bsat-label-margin-top',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.spoil_transported_outside && model.location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkEntry.totalDistance,
                                model: "total_distance",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.totalDistance,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true,
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkEntry.transportCO2e,
                                model: "transport_co2e",
                                help: BSAT_TOOLTIPS.bsatEarthWorkEntry.transportCO2e,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true,
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }]
                        },
                        formOptions: {
                            validateAfterLoad: true,
                            validateAfterChanged: true
                        }
                    };
                },

                mounted() {
                    this.$on('node_value', this.node_value);
                    this.$on('itemInfo', this.itemInfo);
                    this.$on('iconOnClick', this.iconOnClick);
                    this.$on('labelOnClick', this.labelOnClick);
                    this.$on('calculate', this.calculate);
                },

                methods: {
                    onModelUpdated(newVal, schema) {
                        this.model.is_updated = 1;
                    },
                    removeEntry: function (is_new, entry_id) {
                        const id = this.$vnode.key;
                        this.$parent.$emit('removeEntry', id, is_new, entry_id);
                    },
                    addFormElement: function () {
                        this.$parent.$emit('addEntry');
                    },
                    iconOnClick(node, type) {
                        let country_ids = node.raw.countries;
                        let countries;
                        if (Array.isArray(country_ids)) {
                            countries = resources.countries.filter((country) => {
                                if (country_ids.includes(country.id)) {
                                    return country;
                                }
                            })
                        } else {
                            countries = resources.countries.filter(i => i.id == country_ids);
                        }

                        let label = node.raw.label;
                        let year = node.raw.year;
                        let standard = node.raw.standard;
                        let data_source = node.raw.data_source;
                        let technical_specification = node.raw.technical_specification;
                        let gwp = node.raw.gwp + " " + node.raw.unit;
                        let infoList = {}
                        switch (type) {
                            case "vehicle":
                                infoList = {
                                    "Mode of Transport": label,
                                    "Country": countries,
                                    "Year": year,
                                    "Standard": standard,
                                    "Data Source": data_source,
                                    "Loading Capacity (tons)": node.raw.loading_capacity,
                                    "Technical Specification": technical_specification,
                                    "Global Warming Potential": gwp,
                                }
                                openInfoModal("Transport Mode Details", infoList);
                                break;
                            case "machine":
                                infoList = {
                                    "Machine Type": label,
                                    "Country": countries,
                                    "Year": year,
                                    "Standard": standard,
                                    "Data Source": data_source,
                                    "Technical Specification": technical_specification,
                                    "Global Warming Potential": gwp,
                                }
                                openInfoModal("Machinery Details", infoList);
                                break;
                        }
                        logToConsole("info iconOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    labelOnClick(node, type) {
                        logToConsole("labelOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    itemInfo(node) {
                        console.log(node);
                    },
                    calculate() {
                        if (this.$refs.bsatEarthWorkEntry.validate()) {

                            let difficulty_factor = this.model.data.difficulty_data.difficulty_factor === undefined ? 0 :
                                this.model.data.difficulty_data.difficulty_factor;

                            let bulking_factor = this.model.data.difficulty_data.bulking_factor === undefined ? 1
                                : this.model.data.difficulty_data.bulking_factor;

                            let bulking_density = this.model.data.difficulty_data.bulking_density === undefined ? 1 :
                                this.model.data.difficulty_data.bulking_density;

                            let machine_gwp = this.model.data.machine_data.gwp === undefined ? 0 :
                                this.model.data.machine_data.gwp;

                            let transport_gwp = this.model.data.transport_data.gwp === undefined ? 0 :
                                this.model.data.transport_data.gwp;

                            let loading_capacity = this.model.data.transport_data.loading_capacity === undefined ? 0 :
                                this.model.data.transport_data.loading_capacity;

                            this.model.machinery_co2e = truncateFloat(this.model.machine_hours * difficulty_factor *
                                machine_gwp, 8);

                            this.model.machinery_co2e_label = parseExponential(this.model.machinery_co2e);

                            this.model.total_bulking_quantity = this.model.total_quantity * bulking_factor *
                                bulking_density;

                            let no_trips;
                            let total_distance;
                            let distance_to_destination;
                            if (this.model.spoil_transported_outside) {

                                if (this.model.location_id === -1) {
                                    distance_to_destination = this.model.other_location_distance;
                                } else {
                                    distance_to_destination = 0;
                                    if (this.model.location_id !== undefined) {
                                        distance_to_destination = resources.destinations.filter(i => i.id ===
                                            this.model.location_id)[0].distance;
                                    }
                                    this.model.other_location = "";
                                    this.model.other_location_distance = 0;
                                }
                                no_trips = this.model.total_bulking_quantity / loading_capacity;

                                if (no_trips < 1) {
                                    no_trips = 1;
                                }

                                total_distance = distance_to_destination * no_trips;

                                this.model.total_distance = truncateFloat(total_distance, 3);

                                this.model.transport_co2e = truncateFloat(this.model.total_bulking_quantity *
                                    total_distance *
                                    transport_gwp, 8);

                                this.model.transport_co2e_label = parseExponential(this.model.transport_co2e);

                                this.model.total_co2e = truncateFloat(this.model.machinery_co2e + this.model.transport_co2e,
                                    8);

                            } else {
                                this.model.total_quantity = null;
                                this.model.total_bulking_quantity = null;

                                this.model.spoil_transport_vehicle_id = null;

                                this.model.location_id = null;
                                this.model.other_location = null;
                                this.model.other_location_distance = null;
                                this.model.total_distance = null;

                                this.model.transport_co2e = null;
                                this.model.transport_co2e_label = null;

                                this.model.total_co2e = truncateFloat(this.model.machinery_co2e, 8);
                            }

                            logToConsole("earthworks calculate", {
                                subPhase: this.field.sub_phase,
                                difficulty_factor: difficulty_factor,
                                bulking_factor: bulking_factor,
                                bulking_density: bulking_density,
                                machine_gwp: machine_gwp,
                                transport_gwp: transport_gwp,
                                loading_capacity: loading_capacity,
                                machinery_co2e: this.model.machinery_co2e,
                                quantity: this.model.quantity,
                                total_quantity: this.model.total_quantity,
                                total_bulking_quantity: this.model.total_bulking_quantity,
                                location_id: this.model.location_id,
                                distance_to_destination: distance_to_destination,
                                other_location_distance: this.model.other_location_distance,
                                no_trips: no_trips,
                                total_distance: this.model.total_distance,
                                transport_co2e: this.model.transport_co2e,
                                total_co2e: this.model.total_co2e,
                                formulas: {
                                    machinery_co2e: "machine_hours * difficulty_factor * machine_gwp",
                                    transport_co2e: "total_bulking_quantity * total_distance * transport_gwp",
                                }
                            }, LOG_TYPES.CALCULATION);
                        }
                    },
                    onValidated(isValid, errors) {

                        if (this.model.is_updated || this.model.is_new) {
                            this.$parent.$emit('disableAddEntryBtn', true);
                            if (isValid) {
                                this.$parent.$emit('disableAddEntryBtn', false);
                            }
                        }
                    },
                    onValidate: function ($event) {
                        let errors = this.$refs.vfg.validate();
                    },
                },
            });

            Vue.component('bsatEarthWorkBackFillingEntry', {
                template: '#bsatEarthWorkBackFillingEntry',
                props: ['field'],
                components: {
                    "vue-form-generator": VueFormGenerator.component
                },

                data: function () {
                    let field = this.field;
                    let new_model = {
                        id: 0,
                        is_updated: 0,
                        is_new: 1,
                        is_replaceable: 0,
                        is_salvage: 0,
                        material_id: null,
                        material_co2e: 0,
                        quantity: 1,
                        machinery_id: null,
                        machine_hours: 1,
                        machinery_co2e: 0,
                        machinery_co2e_label: 0,
                        spoil_transported_outside: 0,
                        total_quantity: 0,
                        wastage: 0,
                        total_bulking_quantity: 0,
                        spoil_transport_vehicle_id: null,
                        location_id: null,
                        other_location: "Location",
                        other_location_distance: 100,
                        total_distance: 0,
                        transport_co2e: 0,
                        transport_co2e_label: 0,
                        total_co2e: 0,
                        data: {
                            material_data: 1,
                            machine_data: 1,
                            transport_data: 1,
                        }
                    }
                    return {
                        vgfRef: "bsatEarthWorkBackFillingEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.material,
                                model: "material_id",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.material,
                                styleClasses: 'bsat-tree-select bsat-tree-select-lg',
                                required: true,
                                validator: function (value, field, model) {
                                    if (!value) {
                                        return ["This field is required!"];
                                    } else {
                                        return []
                                    }
                                },
                                values: function () {
                                    return field.materials;
                                },
                                options: field.materials,
                                selectOptions: {
                                    type: "material",
                                    searchable: true,
                                    closeOnSelect: false,
                                    showInfoIcon: true,
                                    closeOnLabelClick: true,
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    model.data.material_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.material_data = resources.material_list.filter(i => i.id ===
                                            newVal)[0];
                                        model.wastage = model.data.material_data.wastage;

                                        model.is_replaceable = model.data.material_data.is_replaceable;
                                        model.is_salvage = model.data.material_data.is_salvage;

                                        if (model.spoil_transported_outside) {

                                            let bulking_factor = model.data.material_data.bulking_factor === undefined ? 1
                                                : model.data.material_data.bulking_factor;

                                            model.wastage = model.data.material_data.wastage;
                                            let wastage = (model.wastage + 100) / 100;
                                            model.total_quantity = truncateFloat((model.quantity * bulking_factor *
                                                wastage * 10) / 10, 5);

                                            logToConsole("material onChanged", {
                                                material_data: model.data.material_data,
                                                bulking_factor: bulking_factor,
                                                wastage: model.wastage,
                                                wastage_cal: wastage,
                                                total_quantity: model.total_quantity,
                                            }, LOG_TYPES.EVENT);
                                        }
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.quantity,
                                model: "quantity",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.quantity,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal, field) {

                                    if (model.spoil_transported_outside) {

                                        let bulking_factor = model.data.material_data.bulking_factor === undefined ? 1
                                            : model.data.material_data.bulking_factor;

                                        let wastage = (model.wastage + 100) / 100;
                                        model.total_quantity = truncateFloat((model.quantity * bulking_factor *
                                            wastage * 10) / 10, 5);

                                        logToConsole("quantity onChanged", {
                                            bulking_factor: bulking_factor,
                                            wastage: model.wastage,
                                            wastage_cal: wastage,
                                            total_quantity: model.total_quantity,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.machinery,
                                model: "machinery_id",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.machinery,
                                styleClasses: 'bsat-tree-select bsat-tree-select-lg',
                                required: true,
                                validator: function (value, field, model) {
                                    if (!value) {
                                        return ["This field is required!"];
                                    } else {
                                        return []
                                    }
                                },
                                values: function () {
                                    return field.machines;
                                },
                                options: field.machines,
                                selectOptions: {
                                    type: "machine",
                                    searchable: true,
                                    closeOnSelect: false,
                                    showInfoIcon: true,
                                    closeOnLabelClick: true,
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    model.data.machine_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.machine_data = field.values().filter(i => i.id === newVal)[0];

                                        if (model.data.machine_data === undefined) {
                                            model.data.machine_data = field.values().filter(i => i.id === "UM00")[0].children
                                                .filter(i => i.id === newVal)[0];
                                        }

                                        logToConsole("machine onChanged", {
                                            machine_data: model.data.machine_data,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.machineHours,
                                model: "machine_hours",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.machineHours,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.machineryCO2e,
                                model: "machinery_co2e",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.machineryCO2e,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true,
                            }, {
                                type: "radios",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.spoilTransportInside,
                                model: "spoil_transported_outside",
                                values: [{
                                    name: "Yes",
                                    value: 1
                                },
                                    {
                                        name: "No",
                                        value: 0
                                    },
                                ],
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.spoilTransportInside,
                                styleClasses: 'col-md-12 display-inline',
                                required: true,
                                validator: ["integer", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    setTimeout(() => {

                                        if (newVal) {
                                            let bulking_factor = model.data.material_data.bulking_factor === undefined ? 1
                                                : model.data.material_data.bulking_factor;

                                            model.wastage = model.data.material_data.wastage;
                                            let wastage = (model.wastage + 100) / 100;
                                            model.total_quantity = truncateFloat((model.quantity * bulking_factor *
                                                wastage * 10) / 10, 5);

                                            logToConsole("spoil_transported_outside onChanged", {
                                                bulking_factor: bulking_factor,
                                                wastage: model.wastage,
                                                wastage_cal: wastage,
                                                total_quantity: model.total_quantity,
                                            }, LOG_TYPES.EVENT);
                                        }
                                        this.$parent.$parent.$parent.$emit("calculate", this);
                                    }, 100);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.totalQuantity,
                                model: "total_quantity",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.totalQuantity,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true,
                                visible: function (model) {
                                    if (model && model.spoil_transported_outside) {
                                    }
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.wastage,
                                model: "wastage",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.wastage,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                max: 100,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal, field) {

                                    let bulking_factor = model.data.material_data.bulking_factor === undefined ? 1
                                        : model.data.material_data.bulking_factor;

                                    let wastage = (newVal + 100) / 100;
                                    model.total_quantity = truncateFloat((model.quantity * bulking_factor *
                                        wastage * 10) / 10, 5);

                                    logToConsole("wastage onChanged", {
                                        wastage: wastage,
                                        bulking_factor: bulking_factor,
                                        quantity: model.quantity,
                                        total_quantity: model.total_quantity,
                                    }, LOG_TYPES.EVENT);

                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.spoilTransportVehicle,
                                model: "spoil_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.spoilTransportVehicle,
                                styleClasses: 'bsat-tree-select bsat-tree-select-md',
                                required: true,
                                validator: ["required"],
                                valueFormat: "object",
                                selectOptions: {
                                    type: "vehicle",
                                    searchable: true,
                                    closeOnSelect: false,
                                    showInfoIcon: true,
                                    closeOnLabelClick: true,
                                },
                                values: function () {
                                    return field.vehicles;
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    model.data.transport_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.transport_data = field.values().filter(i => i.id === newVal)[0]

                                        if (model.data.transport_data === undefined) {
                                            model.data.transport_data = field.values().filter(i => i.id === "UV00")[0]
                                                .children.filter(i => i.id === newVal)[0];
                                        }

                                        logToConsole("vehicle onChanged", {
                                            transport_data: model.data.transport_data,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.location,
                                model: "location_id",
                                styleClasses: 'bsat-tree-select',
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.location,
                                required: true,
                                validator: ["required"],
                                valueFormat: "object",
                                selectOptions: {
                                    type: "location",
                                    searchable: true,
                                    closeOnSelect: false,
                                    showInfoIcon: false,
                                    closeOnLabelClick: true,
                                },
                                values: function () {
                                    return resources.destinations;
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "input",
                                inputType: "text",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.otherLocation,
                                model: "other_location",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.otherLocation,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                validator: ["validateText", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    if (undefined != this.$options.parent.$el) {
                                        this.$options.parent.$el.classList = ["bsat-entry"];
                                        if (model && model.spoil_transported_outside) {
                                            this.$options.parent.$el.classList.add("bsat-back-filling-entry-md");
                                            if (model.location_id === -1) {
                                                this.$options.parent.$el.classList.add("bsat-back-filling-entry-lg");
                                            } else {
                                                this.$options.parent.$el.classList = ["bsat-entry " +
                                                "bsat-back-filling-entry-md"];
                                            }
                                        }
                                    }
                                    return model && model.spoil_transported_outside && model.location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.otherLocationDistance,
                                model: "other_location_distance",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.otherLocationDistance,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.spoil_transported_outside && model.location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.totalDistance,
                                model: "total_distance",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.totalDistance,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true,
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatEarthWorkBackFillingEntry.transportCO2e,
                                model: "total_co2e",
                                help: BSAT_TOOLTIPS.bsatEarthWorkBackFillingEntry.transportCO2e,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true,
                                visible: function (model) {
                                    return model && model.spoil_transported_outside;
                                }
                            }]
                        },
                        formOptions: {
                            validateAfterLoad: true,
                            validateAfterChanged: true
                        }
                    };
                },

                mounted() {
                    this.$on('node_value', this.node_value);
                    this.$on('itemInfo', this.itemInfo);
                    this.$on('iconOnClick', this.iconOnClick);
                    this.$on('labelOnClick', this.labelOnClick);
                    this.$on('calculate', this.calculate);
                },

                methods: {
                    onModelUpdated(newVal, schema) {
                        this.model.is_updated = 1;
                    },
                    removeEntry: function (is_new, entry_id) {
                        const id = this.$vnode.key;
                        this.$parent.$emit('removeEntry', id, is_new, entry_id);
                    },
                    addFormElement: function () {
                        this.$parent.$emit('addEntry');
                    },
                    iconOnClick(node, type) {
                        let country_ids = node.raw.countries;
                        let countries;
                        if (Array.isArray(country_ids)) {
                            countries = resources.countries.filter((country) => {
                                if (country_ids.includes(country.id)) {
                                    return country;
                                }
                            })
                        } else {
                            countries = resources.countries.filter(i => i.id == country_ids);
                        }

                        let label = node.raw.label;
                        let year = node.raw.year;
                        let standard = node.raw.standard;
                        let data_source = node.raw.data_source;
                        let technical_specification = node.raw.technical_specification;
                        let gwp = node.raw.gwp + " " + (node.raw.unit == undefined ? node.raw.unit : node.raw.unit);
                        let infoList = {}
                        switch (type) {
                            case "vehicle":
                                infoList = {
                                    "Mode of Transport": label,
                                    "Country": countries,
                                    "Year": year,
                                    "Standard": standard,
                                    "Data Source": data_source,
                                    "Loading Capacity (tons)": node.raw.loading_capacity,
                                    "Technical Specification": technical_specification,
                                    "Global Warming Potential": gwp,
                                }
                                openInfoModal("Transport Mode Details", infoList);
                                break;
                            case "machine":
                                infoList = {
                                    "Machine Type": label,
                                    "Country": countries,
                                    "Year": year,
                                    "Standard": standard,
                                    "Data Source": data_source,
                                    "Technical Specification": technical_specification,
                                    "Global Warming Potential": gwp,
                                }
                                openInfoModal("Machinery Details", infoList);
                                break;
                            case "material":
                                infoList = {
                                    "Material Name": label,
                                    "Country": countries,
                                    "Year": year,
                                    "Standard": standard,
                                    "Data Source": data_source,
                                    "Technical Specification": technical_specification,
                                    "Global Warming Potential (Cradle to gate)": gwp,
                                }
                                openInfoModal("Material Details", infoList);
                                break;
                        }
                        logToConsole("iconOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    labelOnClick(node, type) {
                        logToConsole("labelOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    itemInfo(node) {
                        console.log(node);
                    },
                    calculate() {
                        if (this.$refs.bsatEarthWorkBackFillingEntry.validate()) {

                            let machine_gwp = this.model.data.machine_data.gwp === undefined ? 0 :
                                this.model.data.machine_data.gwp;

                            let material_gwp = this.model.data.material_data.gwp === undefined ? 0 :
                                this.model.data.material_data.gwp;

                            let bulking_factor = this.model.data.material_data.bulking_factor === undefined ? 1
                                : this.model.data.material_data.bulking_factor;

                            let bulking_density = this.model.data.material_data.bulking_density === undefined ? 1 :
                                this.model.data.material_data.bulking_density;

                            let transport_gwp = this.model.data.transport_data.gwp === undefined ? 0 :
                                this.model.data.transport_data.gwp;

                            let loading_capacity = this.model.data.transport_data.loading_capacity === undefined ? 0 :
                                this.model.data.transport_data.loading_capacity;

                            let wastage = (this.model.wastage + 100) / 100;

                            this.model.machinery_co2e = truncateFloat(this.model.machine_hours * machine_gwp, 8);

                            this.model.machinery_co2e_label = parseExponential(this.model.machinery_co2e);

                            let no_trips;
                            let total_quantity;
                            let total_distance;
                            let distance_to_destination;
                            if (this.model.spoil_transported_outside) {

                                this.model.total_bulking_quantity = this.model.quantity * bulking_factor *
                                    bulking_density * wastage;//done

                                total_quantity = this.model.quantity * bulking_factor * wastage;

                                this.model.material_co2e = truncateFloat(total_quantity * material_gwp, 8);

                                if (this.model.location_id === -1) {
                                    distance_to_destination = this.model.other_location_distance;
                                } else {
                                    distance_to_destination = 0;
                                    if (this.model.location_id !== undefined) {
                                        distance_to_destination = resources.destinations.filter(i => i.id ===
                                            this.model.location_id)[0].distance;
                                    }
                                    this.model.other_location = "";
                                    this.model.other_location_distance = 0;
                                }
                                no_trips = this.model.total_bulking_quantity / loading_capacity;

                                if (no_trips < 1) {
                                    no_trips = 1;
                                }

                                total_distance = distance_to_destination * no_trips;

                                this.model.total_distance = truncateFloat(total_distance, 3);

                                this.model.transport_co2e = truncateFloat(this.model.total_bulking_quantity *
                                    total_distance *
                                    transport_gwp, 8);

                                this.model.transport_co2e_label = parseExponential(this.model.transport_co2e);

                                this.model.total_co2e = truncateFloat(this.model
                                    .transport_co2e + this.model.material_co2e,
                                    8);

                            } else {

                                this.model.total_quantity = null;
                                this.model.total_bulking_quantity = null;

                                this.model.wastage = null;

                                this.model.spoil_transport_vehicle_id = null;

                                this.model.location_id = null;
                                this.model.other_location = null;
                                this.model.other_location_distance = null;
                                this.model.total_distance = null;

                                this.model.material_co2e = null;

                                this.model.transport_co2e = null;
                                this.model.transport_co2e_label = null;

                                this.model.total_co2e = null;
                            }

                            logToConsole("earthworks calculate", {
                                subPhase: this.field.sub_phase,
                                bulking_factor: bulking_factor,
                                bulking_density: bulking_density,
                                material_gwp: material_gwp,
                                machine_gwp: machine_gwp,
                                transport_gwp: transport_gwp,
                                loading_capacity: loading_capacity,
                                wastage: wastage,
                                machinery_co2e: this.model.machinery_co2e,
                                material_co2e: this.model.material_co2e,
                                quantity: this.model.quantity,
                                total_quantity_m3: total_quantity,
                                total_quantity: this.model.total_quantity,
                                total_bulking_quantity: this.model.total_bulking_quantity,
                                location_id: this.model.location_id,
                                distance_to_destination: distance_to_destination,
                                other_location_distance: this.model.other_location_distance,
                                no_trips: no_trips,
                                total_distance: this.model.total_distance,
                                transport_co2e: this.model.transport_co2e,
                                total_co2e: this.model.total_co2e,
                                formulas: {
                                    machinery_co2e: "machine_hours * machine_gwp",
                                    material_co2e: "total_quantity * material_gwp",
                                    transport_co2e: "total_bulking_quantity * total_distance * transport_gwp",
                                }
                            }, LOG_TYPES.CALCULATION);
                        }
                    },
                    onValidated(isValid, errors) {

                        if (this.model.is_updated || this.model.is_new) {
                            this.$parent.$emit('disableAddEntryBtn', true);
                            if (isValid) {
                                this.$parent.$emit('disableAddEntryBtn', false);
                            }
                        }
                    },
                    onValidate: function ($event) {
                        let errors = this.$refs.vfg.validate();
                    },
                },
            });

            function generateComponent(subPhase, elem, addEntryBtnId, template) {
                return new Vue({
                    el: elem,
                    data: {
                        fields: [],
                        count: 0,
                        difficulty_level: []
                    },
                    mounted() {
                        this.$on('removeEntry', this.removeEntry);
                        this.$on('addEntry', this.addEntry);
                        this.$on('disableAddEntryBtn', this.disableAddEntryBtn);

                        axios.get("/api/earthwork-entries/" + project_id + "/entries/" + subPhase)
                            .then(response => {
                                logToConsole("generate earthwork-entries resp - " + subPhase, {
                                    response: response,
                                }, LOG_TYPES.HTTP_REQUEST);
                                this.generateModels(response.data, subPhase);
                            })
                            .catch(error => {
                                logToConsole("generateComponent error", error, LOG_TYPES.ERROR);
                            });
                    },
                    methods: {
                        addEntry: function () {
                            let difficulty_level_data = [];
                            let quantityLabel = "";
                            let quantityTooltip = "";
                            let difficultyLevelToolTip = "";

                            if (subPhase == "site-clearance" || subPhase == "soil-excavation" || subPhase == "rock-excavation") {
                                switch (subPhase) {
                                    case "site-clearance":
                                        difficulty_level_data = resources.site_clearance_difficulty;
                                        difficultyLevelToolTip = BSAT_TOOLTIPS.bsatEarthWorkEntry.difficultyLevelSiteClearance;
                                        quantityLabel = BSAT_LABELS.bsatEarthWorkEntry.quantitySiteClearance;
                                        quantityTooltip = BSAT_TOOLTIPS.bsatEarthWorkEntry.quantitySiteClearance;
                                        break;
                                    case "soil-excavation":
                                        difficulty_level_data = resources.soil_excavation_difficulty;
                                        difficultyLevelToolTip = BSAT_TOOLTIPS.bsatEarthWorkEntry.difficultyLevelSoilExcavation;
                                        quantityLabel = BSAT_LABELS.bsatEarthWorkEntry.quantity;
                                        quantityTooltip = BSAT_TOOLTIPS.bsatEarthWorkEntry.quantity;
                                        break;
                                    case "rock-excavation":
                                        difficulty_level_data = resources.rock_excavation_difficulty;
                                        difficultyLevelToolTip = BSAT_TOOLTIPS.bsatEarthWorkEntry.difficultyLevelRockExcavation;
                                        quantityLabel = BSAT_LABELS.bsatEarthWorkEntry.quantity;
                                        quantityTooltip = BSAT_TOOLTIPS.bsatEarthWorkEntry.quantity;
                                        break;
                                }
                                this.fields.push({
                                    'type': template,
                                    'id': this.count++,
                                    'sub_phase': subPhase,
                                    'quantity_label': quantityLabel,
                                    'quantity_tooltip': quantityTooltip,
                                    'difficulty_level_tooltip': difficultyLevelToolTip,
                                    'difficulty_level': difficulty_level_data,
                                    'distances': resources.distances,
                                    'machines': resources.machines,
                                    'vehicles': resources.vehicles,
                                    'is_new': 1
                                })
                            } else {
                                this.fields.push({
                                    'type': template,
                                    'id': this.count++,
                                    'sub_phase': subPhase,
                                    'distances': resources.distances,
                                    'materials': resources.materials,
                                    'machines': resources.machines,
                                    'vehicles': resources.vehicles,
                                    'is_new': 1
                                });
                            }
                        },
                        addFormElement5: function (type) {
                            store.setData([{
                                name: "Sebastian Vettel",
                                id: "5",
                                group: "Formula 1"
                            }])
                        },
                        removeEntry: async function (id, is_new, entry_id) {
                            const index = this.fields.findIndex(f => f.id === id);

                            this.fields.splice(index, 1);

                            if (!is_new) {
                                axios.delete('/api/earthwork-entries/' + project_id + '/' + entry_id)
                                    .then(async (response) => {
                                        logToConsole("removeEntry resp", response, LOG_TYPES.HTTP_REQUEST);
                                        await saveEarthworks(false);
                                    })
                                    .catch(error => {
                                        logToConsole("removeEntry error", error, LOG_TYPES.ERROR);
                                    });
                            }
                            let isValid = true;

                            await sleep(50);
                            for (let child of this.$children) {
                                if ((undefined != child.$refs.bsatEarthWorkEntry && !child.$refs.bsatEarthWorkEntry
                                    .validate()) || (undefined != child.$refs.bsatEarthWorkBackFillingEntry &&
                                    !child.$refs.bsatEarthWorkBackFillingEntry.validate())) {
                                    this.$emit('disableAddEntryBtn', true);
                                    isValid = false;
                                    break;
                                }
                            }

                            if (isValid) {
                                this.$emit('disableAddEntryBtn', false);
                            }

                        },
                        generateModels: function (models, subPhase) {
                            let difficulty_level_data = [];
                            let quantityLabel = "";
                            let quantityTooltip = "";
                            let difficultyLevelToolTip = "";

                            if (subPhase == "site-clearance" || subPhase == "soil-excavation" || subPhase == "rock-excavation") {
                                switch (subPhase) {
                                    case "site-clearance":
                                        difficulty_level_data = resources.site_clearance_difficulty;
                                        difficultyLevelToolTip = BSAT_TOOLTIPS.bsatEarthWorkEntry.difficultyLevelSiteClearance;
                                        quantityLabel = BSAT_LABELS.bsatEarthWorkEntry.quantitySiteClearance;
                                        quantityTooltip = BSAT_TOOLTIPS.bsatEarthWorkEntry.quantitySiteClearance;
                                        break;
                                    case "soil-excavation":
                                        difficulty_level_data = resources.soil_excavation_difficulty;
                                        difficultyLevelToolTip = BSAT_TOOLTIPS.bsatEarthWorkEntry.difficultyLevelSoilExcavation;
                                        quantityLabel = BSAT_LABELS.bsatEarthWorkEntry.quantity;
                                        quantityTooltip = BSAT_TOOLTIPS.bsatEarthWorkEntry.quantity;
                                        break;
                                    case "rock-excavation":
                                        difficulty_level_data = resources.rock_excavation_difficulty;
                                        difficultyLevelToolTip = BSAT_TOOLTIPS.bsatEarthWorkEntry.difficultyLevelRockExcavation;
                                        quantityLabel = BSAT_LABELS.bsatEarthWorkEntry.quantity;
                                        quantityTooltip = BSAT_TOOLTIPS.bsatEarthWorkEntry.quantity;
                                        break;
                                }
                                models.forEach((model) => {
                                    this.fields.push({
                                        'type': template,
                                        'id': this.count++,
                                        'model': model,
                                        'sub_phase': subPhase,
                                        'difficulty_level': difficulty_level_data,
                                        'quantity_label': quantityLabel,
                                        'quantity_tooltip': quantityTooltip,
                                        'difficulty_level_tooltip': difficultyLevelToolTip,
                                        'distances': resources.distances,
                                        'machines': resources.machines,
                                        'vehicles': resources.vehicles,
                                        'is_new': 0,
                                        'entry_id': model.id
                                    })
                                });
                            } else {
                                models.forEach((model) => {
                                    this.fields.push({
                                        'type': template,
                                        'id': this.count++,
                                        'model': model,
                                        'distances': resources.distances,
                                        'materials': resources.materials,
                                        'machines': resources.machines,
                                        'vehicles': resources.vehicles,
                                        'is_new': 0,
                                        'entry_id': model.id
                                    });
                                });
                            }
                        },
                        getModals: function () {
                            let total_machinery_co2e = 0;
                            let total_transport_co2e = 0;
                            let total_material_co2e = 0;

                            let models = this.$children.map(function (child) {
                                total_machinery_co2e = total_machinery_co2e + child.model.machinery_co2e;
                                total_transport_co2e = total_transport_co2e + child.model.transport_co2e;
                                total_material_co2e = total_material_co2e + child.model.material_co2e;
                                return child.model;
                            });

                            const updatedModels = models.filter(item => item.is_updated && !item.is_new);
                            const newModels = models.filter(item => item.is_new);

                            let resp = {
                                "sub_phase": subPhase,
                                "total_machinery_co2e": total_machinery_co2e,
                                "total_material_co2e": total_material_co2e,
                                "total_transport_co2e": total_transport_co2e,
                                "new_entries": newModels || {},
                                "updated_entries": updatedModels || {},
                            }

                            return resp;
                        },

                        disableAddEntryBtn: function (disableBtn) {
                            if (disableBtn) {
                                $(addEntryBtnId).prop('disabled', true);
                            } else {
                                $(addEntryBtnId).prop('disabled', false);
                            }
                        }
                    }
                })
            }

            siteClearance = generateComponent("site-clearance", '#siteClearance', '#btnAddSiteClearanceEntry', 'bsatEarthWorkEntry');
            soilExcavation = generateComponent("soil-excavation", '#soilExcavation', '#btnAddSoilExcavationEntry', 'bsatEarthWorkEntry');
            rockExcavation = generateComponent("rock-excavation", '#rockExcavation', '#btnAddRockExcavationEntry', 'bsatEarthWorkEntry');
            backFilling = generateComponent("back-filling", '#backFilling',
                '#btnAddBackFillingEntry', 'bsatEarthWorkBackFillingEntry');

            $("#btnSave").on("click", function () {
                let isValid = true;
                if (!validateEntries(siteClearance, "earth-works", "siteClearance") ||
                    !validateEntries(soilExcavation, "earth-works", "soilExcavation") ||
                    !validateEntries(rockExcavation, "earth-works", "rockExcavation") ||
                    !validateEntries(backFilling, "earth-works", "backFilling")) {
                    isValid = false;
                }

                if (isValid) {
                    saveEarthworks(true);
                } else {
                    errorToast('Fill all required fields!');
                }
            });
        }

        async function saveEarthworks(regenerateEntries) {
            let site_clearance_data = siteClearance.getModals();
            let soil_excavation_data = soilExcavation.getModals();
            let rock_excavation_data = rockExcavation.getModals();
            let back_filling_data = backFilling.getModals();

            let data = {
                "site_clearance": site_clearance_data,
                "soil_excavation": soil_excavation_data,
                "rock_excavation": rock_excavation_data,
                "back_filling": back_filling_data
            };

            await axios.post("/api/earthwork-entries/" + project_id, data)
                .then(response => {
                    logToConsole("saveEarthworks resp", response, LOG_TYPES.HTTP_REQUEST);

                    if (regenerateEntries) {
                        siteClearance.fields = [];
                        soilExcavation.fields = [];
                        rockExcavation.fields = [];
                        backFilling.fields = [];
                        siteClearance.generateModels(response.data.site_clearance, "site-clearance");
                        soilExcavation.generateModels(response.data.soil_excavation, "soil-excavation");
                        rockExcavation.generateModels(response.data.rock_excavation, "rock-excavation");
                        backFilling.generateModels(response.data.back_filling, "back-filling");

                        successToast('Saved Successfully!');
                    }
                }).then(() => {

                    axios.get("/api/results/" + project_id + "/earth-works/type/chart")
                        .then(response => {
                            logToConsole("chart result resp", response, LOG_TYPES.HTTP_REQUEST);
                            updateSubPhaseChartDataSet(earthWorksChart, response.data.chart, "earthWorks");
                        }).catch(error => {
                        errorToast('Result Generation Failed!');
                        logToConsole("chart result resp error", error, LOG_TYPES.ERROR);
                    });

                    refreshSubPhaseTableData("earthWorksResultTable", "earth-works");
                }).catch(error => {
                    errorToast('Failed To Save!');
                    logToConsole("saveEarthworks error", error, LOG_TYPES.ERROR);
                });
        }

        async function navigate(location) {

            let isValid = true;
            if (!validateEntries(siteClearance, "earth-works", "siteClearance") ||
                !validateEntries(soilExcavation, "earth-works", "soilExcavation") ||
                !validateEntries(rockExcavation, "earth-works", "rockExcavation") ||
                !validateEntries(backFilling, "earth-works", "backFilling")) {
                isValid = false;
            }

            if (isValid) {
                await saveEarthworks(false);
                window.location.href = location;
            } else {
                errorToast('Saving Failed! Fill all required fields!')
            }

        }
    </script>
@stop
