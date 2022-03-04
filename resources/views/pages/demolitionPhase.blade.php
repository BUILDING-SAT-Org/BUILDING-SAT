@section('title', 'Demolition Phase')
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

        .vgf-input-fixed-lg {
            width: 250px !important;
            margin-right: 10px !important;
            margin-top: 4px;
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
            width: 700px;
        }

        .bsat-tree-select-lg .vue-treeselect__menu {
            max-height: 500px !important;
            width: 600px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-lg .vue-treeselect__list {
            width: 950px;
        }

        .bsat-accordion {
            width: 1050px;
            margin-bottom: 10px;
        }

        .bsat-accordion-lg {
            width: 1390px;
            margin-bottom: 10px;
        }

        .bsat-accordion-item {
            width: max-content;
        }

        .bsat-entry {
            border-radius: 8px;
            border-width: 1px;
            border-color: #e0e0e0;
            padding: 5px;
            border-style: solid;
            background-color: #e7f1ff;
            margin-left: 10px;
            margin-bottom: 15px
        }

        .bsat-entry-lg {
            width: 1335px;
            margin-bottom: 10px;
        }

        .bsat-demolition-entry {
            width: 635px;
        }

        .bsat-demolition-entry-lg {
            width: 2140px;
        }

        .bsat-landfill-salvage-entry {
            width: 1950px;
        }

        .bsat-landfill-salvage-entry-lg {
            width: 2070px;
        }

        .bsat-demolition-mortar-entry {
            width: 1270px;
        }

        .bsat-demolition-mortar-entry-lg {
            width: 1560px;
        }

        .bsat-demolition-mortar-entry-xl {
            width: 2700px;
        }

        .bsat-chemical-entry {
            width: 2005px;
        }

        .bsat-chemical-entry-lg {
            width: 2140px;
        }

        .bsat-back-filling-entry-md {
            width: 1165px;
            margin-bottom: 10px;
        }

        .bsat-back-filling-entry-lg {
            width: 1510px;
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
            width: 1000px;
        }

        .bsat-sub-phase-label {
            margin-right: 15px;
        }

        .bsat-label-margin-top {
            margin-top: -13px !important;
        }

        .bsat-label-margin-top > label > span:nth-of-type(1) {
            display: inline;
        }

        .landfill-salvage-header {
            width: 1900px;
            border-bottom: solid;
            border-width: 1px;
        }

        .file {
            height: 34px !important;
        }

        #accordionDemolitionResultsTable {
            width: 1350px;
        }

        #demolitionResultTable tr > th:not(:first-child), td:not(:first-child) {
            text-align: right;
        }

        .empty-span {
            width: 10px;
        }
    </style>
    <div class="bsat-phase-description">
        <div class="row">
            <div class="col-md-6">
                <h1>Demolition Phase</h1>
                This section accounts for the entries concerning electricity, fuel, and chemicals used during the
                demolition phase of the building at the end of its life.
            </div>
        </div>
    </div>


    <div>
        <div class="col-md-12">
            <div id="demolition">
                <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                </div>
            </div>

            <!--  Results Accordion  -->
            <div class="accordion bsat-accordion" id="accordionDemolitionResults">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseDemolitionResults" aria-expanded="false"
                                aria-controls="collapseDemolitionResults">
                            <div class="bsat-sub-phase-label">Results</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseDemolitionResults" class="accordion-collapse collapse"
                     aria-labelledby="accordionDemolitionResults"
                     data-bs-parent="#accordionDemolitionResults">
                    <div class="accordion-body" style="padding: 0rem 1.25rem;">
                        <div class="col-md-12">
                            <p class="bsat-result-description">
                                The global warming potential (kg CO2 – eq) related to Demolition phase are displayed
                                with respect to machinery, material, transport, energy and water related impacts. The
                                user can use this information to further analyze the hotspots of different construction
                                activities and operations.
                            </p>
                        </div>
                        <!-- Result Table Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionDemolitionResultsTable">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseDemolitionResultsTable"
                                            aria-expanded="false"
                                            aria-controls="collapseDemolitionResultsTable">
                                        <div class="bsat-sub-phase-label">Table View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseDemolitionResultsTable" class="accordion-collapse collapse"
                                 aria-labelledby="accordionDemolitionResultsTable"
                                 data-bs-parent="#accordionDemolitionResultsTable">
                                <div class="accordion-body">
                                    <div class="justify-content-center">
                                        <h3 class="text-center">Global Warming Potential of Demolition Activities</h3>
                                        <table id="demolitionResultTable" data-unique-id="id" class="table">
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
                        <div class="accordion bsat-accordion" id="accordionDemolitionResultsChart">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseDemolitionResultsChart"
                                            aria-expanded="false"
                                            aria-controls="collapseDemolitionResultsChart">
                                        <div class="bsat-sub-phase-label">Chart View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseDemolitionResultsChart" class="accordion-collapse collapse"
                                 aria-labelledby="accordionDemolitionResultsChart"
                                 data-bs-parent="#accordionDemolitionResultsChart">
                                <div class="accordion-body">
                                    <div>
                                        <canvas id="demolitionResultChart"></canvas>
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

    <!-- Demolition Template -->
    <template id="demolitionSubPhase">

        <!--  Generated SubPhase  -->
        <div class="accordion bsat-accordion" :id="field.accordionId">
            <div class="accordion-item bsat-accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            :data-bs-target="field.collapseTarget" aria-expanded="false"
                            :aria-controls="field.collapseId">
                        <div class="bsat-sub-phase-label">@{{ field.sub_phase_label }}</div>
                    </button>
                </h2>
            </div>
            <div :id="field.collapseId" class="accordion-collapse collapse" v-bind:class="cssClasses"
                 :aria-labelledby="field.accordionId"
                 :data-bs-parent="field.accordionParent">
                <div class="accordion-body">
                    <div class="col-md-12 bsat-sub-phase-description">
                        @{{ field.sub_phase_description }}
                    </div>
                    <div>
                        <div v-if="field.sub_phase == 'landfill_and_salvage'">

                            <div class="vue-form-generator landfill-salvage-header">
                                <div>
                                    <div class="form-group valid  bsat-tree-select bsat-tree-select-lg field-treeSelect">
                                        <label>
                                            <span class="empty-span"></span>
                                            <br/>
                                            <span>Material</span>
                                            <span class="help"><i class="icon"></i>
                                                <div class="helpText">Materials required for the activity</div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group valid  vgf-input-fixed field-input"
                                         style="margin-left: 40px !important;">
                                        <label>
                                            <span class="empty-span"></span>
                                            <br/>
                                            <span>Salvage %</span>
                                            <span class="help"><i class="icon"></i>
                                                <div class="helpText">Enter % of material to be salvaged</div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group valid readonly vgf-input-fixed field-input">
                                        <label>
                                            <span class="empty-span"></span>
                                            <br/>
                                            <span>Landfill %</span>
                                            <span class="help"><i class="icon"></i>
                                                <div class="helpText">Enter % to be used for landfill</div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group valid readonly vgf-input-fixed field-input"
                                         style="margin-left: 0px !important;">
                                        <label>
                                            <span>Salvage <br/> Quantity (tons)</span>
                                            <span class="help"><i class="icon"></i>
                                                <div class="helpText">Quantity used as salvage entered in the unit specified for the material type chosen</div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group valid readonly vgf-input-fixed field-input">
                                        <label>
                                            <span>Landfill <br/> Quantity (tons)</span>
                                            <span class="help"><i class="icon"></i>
                                                <div class="helpText">Quantity used for landfill entered in the unit specified for the material type chosen</div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group valid  bsat-tree-select field-treeSelect">
                                        <label>
                                            <span class="empty-span"></span>
                                            <br/>
                                            <span>Landfill Site Location</span>
                                            <span class="help"><i class="icon"></i>
                                                <div class="helpText">Choose location of landfill site</div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group valid  bsat-tree-select bsat-tree-select-md field-treeSelect">
                                        <label>
                                            <span class="empty-span"></span>
                                            <br/>
                                            <span>Mode of Transport</span>
                                            <span class="help"><i class="icon"></i>
                                                <div class="helpText">Choose appropriate transport with sufficient capacity</div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group valid  vgf-input-fixed field-input"
                                         style="margin-left: -5px !important;">
                                        <label>
                                            <span>Distance to <br>Landfill Site (km)</span>
                                            <span class="help"><i class="icon"></i>
                                                <div class="helpText">Total distance travelled in km (Only one- way distance is accounted for.)</div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group valid readonly vgf-input-fixed field-input">
                                        <label>
                                            <span>kg CO ₂ eq<br>Landfill</span>
                                        </label>
                                    </div>
                                    <div class="form-group valid readonly vgf-input-fixed field-input"
                                         style="width: 90px !important;">
                                        <label>
                                            <span>kg CO ₂ eq<br>Salvage</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                        </div>

                        <div v-if="field.sub_phase != 'landfill_and_salvage'">
                            <button :id="field.addEntryButtonId" class="btn btn-primary bsat-entry-btn"
                                    v-on:click="addEntry(field.sub_phase)">Add Entry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Generated SubPhase -->


    </template>
    <!-- End Demolition Template  -->

    <!-- Demolition Entry Template -->
    <template id="bsatDemolitionEntry">
        <div class="bsat-entry" :id="field.id" style="">
            <div style="text-align: right">
                <i class="fa fa-window-close" style="color: red"
                   v-on:click="removeEntry(field.is_new,field.entry_id,field.sub_phase)"></i>
            </div>
            <div>
                <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div"
                                    :ref="vgfRef"
                                    @model-updated="onModelUpdated" @validated="onValidated">
                </vue-form-generator>
            </div>
        </div>
    </template>
    <!-- End Demolition Entry Template  -->

    <!-- Chemical Entry Template -->
    <template id="bsatChemicalEntry">
        <div class="bsat-entry" :id="field.id" style="">
            <div style="text-align: right">
                <i class="fa fa-window-close" style="color: red"
                   v-on:click="removeEntry(field.is_new,field.entry_id,field.sub_phase)"></i>
            </div>
            <div>
                <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div"
                                    :ref="vgfRef"
                                    @model-updated="onModelUpdated" @validated="onValidated">
                </vue-form-generator>
            </div>
        </div>
    </template>
    <!-- End Chemical Entry Template  -->

    <!-- LandFill Salvage Entry Template -->
    <template id="bsatLandFillSalvageEntry">
        <div class="" :id="field.id" style="">
            <div>
                <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div"
                                    :ref="vgfRef"
                                    @model-updated="onModelUpdated" @validated="onValidated">
                </vue-form-generator>
            </div>
        </div>
    </template>
    <!-- End LandFill Salvage Entry Template  -->

    <script>
        let user_id = {{ Auth::user()->id }};
        let project_id = {{ $project_id }};
        const PROJECT_SERVICE_LIFE = {{ $project_life }};
        let resources;
        let demolitionChart;
        let demolitionEntries;
        let demolition;

        (function () {
            const promise1 = axios.get("/api/resources/" + project_id + "/demolition-phase");
            const promise2 = axios.get("/api/demolition-phase-entries/" + project_id);

            Promise.all([promise1, promise2]).then(function (values) {
                resources = values[0].data;
                demolitionEntries = values[1].data;
                logToConsole("resp", {
                    resources: resources,
                    demolitionEntries: demolitionEntries
                }, LOG_TYPES.HTTP_REQUEST);
                init();
                loadingOverlay.classList.add('hide-loader');
            });
        })();

        async function init() {
            initDemolition();
            demolitionChart = await generateMainPhaseResult("demolition-phase", "demolitionResultTable",
                "demolitionResultChart", CHART_TITLES.demolitionPhase, "demolitionPhase");
        }

        function initDemolition() {

            Vue.component('bsatChemicalEntry', {
                template: '#bsatChemicalEntry',
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
                        total_material_co2e: 0,
                        quantity: null,
                        total_bulking_quantity: 0,
                        service_life: null,
                        wastage: null,
                        location_id: null,
                        other_location: null,
                        local_distance: null,
                        local_transport_vehicle_id: null,
                        overseas_distance: null,
                        overseas_transport_vehicle_id: null,
                        local_transport_co2e: 0,
                        overseas_transport_co2e: 0,
                        total_transport_co2e: 0,
                        total_co2e: 0,
                        total_co2e_label: 0,
                        data: {
                            material_data: 1,
                            local_transport_data: 1,
                            overseas_transport_data: 1,
                        },
                    }
                    return {
                        vgfRef: "bsatChemicalEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatChemicalEntry.material,
                                model: "material_id",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.material,
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
                                        let material_data = resources.material_list.filter(i => i.id == newVal)[0];
                                        model.wastage = material_data.wastage;
                                        model.service_life = material_data.service_life === -1 ?
                                            PROJECT_SERVICE_LIFE : material_data.service_life;
                                        model.data.material_data = material_data;
                                        model.is_replaceable = material_data.is_replaceable;
                                        model.is_salvage = material_data.is_salvage;

                                        logToConsole("material onChanged", {
                                            material_data: model.data.material_data,
                                            service_life: model.service_life,
                                            wastage: model.wastage,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatChemicalEntry.quantity,
                                model: "quantity",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.quantity,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatChemicalEntry.serviceLife,
                                model: "service_life",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.serviceLife,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatChemicalEntry.wastage,
                                model: "wastage",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.wastage,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                max: 100,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatChemicalEntry.localResourceLocation,
                                model: "location_id",
                                styleClasses: 'bsat-tree-select bsat-label-margin-top',
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.localResourceLocation,
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
                                    if (newVal !== undefined) {
                                        if (newVal !== -1) {
                                            let distance = resources.destinations.filter(i => i.id ===
                                                newVal)[0].distance;
                                            model.local_distance = distance;
                                        } else {
                                            model.other_location = null;
                                            model.local_distance = null;
                                        }
                                        setTimeout(() => {
                                            this.$parent.$parent.$parent.$emit("calculate", this);
                                        }, 100);
                                    }
                                }
                            }, {
                                type: "input",
                                inputType: "text",
                                label: BSAT_LABELS.bsatChemicalEntry.otherLocation,
                                model: "other_location",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.otherLocation,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                validator: ["validateText", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    if (undefined != this.$options.parent.$el) {
                                        if (model && model.location_id === -1) {
                                            this.$options.parent.$el.classList.add("bsat-chemical-entry-lg");
                                        } else {
                                            this.$options.parent.$el.classList = ["bsat-entry"];
                                        }
                                    }
                                    return model && model.location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatChemicalEntry.localDistance,
                                model: "local_distance",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.localDistance,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatChemicalEntry.localTransport,
                                model: "local_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.localTransport,
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
                                    model.data.local_transport_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.local_transport_data = field.values().filter(i => i.id === newVal)[0]

                                        if (model.data.local_transport_data === undefined) {
                                            model.data.local_transport_data = field.values().filter(i => i.id === "UV00")[0]
                                                .children.filter(i => i.id === newVal)[0];
                                        }

                                        logToConsole("local vehicle onChanged", {
                                            local_transport_data: model.data.local_transport_data,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatChemicalEntry.overseasDistance,
                                model: "overseas_distance",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.overseasDistance,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                min: 0,
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatChemicalEntry.overseasTransport,
                                model: "overseas_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.overseasTransport,
                                styleClasses: 'bsat-tree-select bsat-tree-select-md bsat-tree-select-overseas',
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
                                    model.data.overseas_transport_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.overseas_transport_data = field.values().filter(i => i.id === newVal)[0]

                                        if (model.data.overseas_transport_data === undefined) {
                                            model.data.overseas_transport_data = field.values().filter(i => i.id === "UV00")[0]
                                                .children.filter(i => i.id === newVal)[0];
                                        }

                                        logToConsole("overseas vehicle onChanged", {
                                            overseas_transport_data: model.data.overseas_transport_data,
                                        }, LOG_TYPES.EVENT);
                                    } else {
                                        model.overseas_transport_vehicle_id = null;
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatChemicalEntry.totalCo2e,
                                model: "total_co2e",
                                help: BSAT_TOOLTIPS.bsatChemicalEntry.totalCo2e,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true
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
                    removeEntry: function (is_new, entry_id, sub_phase) {
                        const id = this.$vnode.key;
                        this.$parent.$emit('removeEntry', id, is_new, entry_id, sub_phase, "add" + sub_phase +
                            "EntryBtn");
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
                        logToConsole("info iconOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    labelOnClick(node, type) {
                        logToConsole("labelOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    itemInfo(node) {
                    },
                    calculate() {
                        if (this.$refs.bsatChemicalEntry.validate()) {

                            let material_gwp = this.model.data.material_data.gwp === undefined ? 0 :
                                this.model.data.material_data.gwp;

                            let bulking_factor = this.model.data.material_data.bulking_factor === undefined ? 1
                                : this.model.data.material_data.bulking_factor;

                            let bulking_density = this.model.data.material_data.bulking_density === undefined ? 1 :
                                this.model.data.material_data.bulking_density;

                            let local_transport_gwp = this.model.data.local_transport_data.gwp === undefined ? 0 :
                                this.model.data.local_transport_data.gwp;

                            let overseas_transport_gwp = this.model.data.overseas_transport_data.gwp === undefined ? 0 :
                                this.model.data.overseas_transport_data.gwp;

                            let local_transport_loading_capacity = this.model.data.local_transport_data
                                .loading_capacity === undefined ?
                                0 : this.model.data.local_transport_data.loading_capacity;

                            let overseas_transport_loading_capacity = this.model.data.overseas_transport_data.loading_capacity === undefined ?
                                0 : this.model.data.overseas_transport_data.loading_capacity;

                            let wastage_cal = (this.model.wastage + 100) / 100;

                            this.model.total_material_co2e = truncateFloat(this.model.quantity * bulking_factor *
                                wastage_cal * material_gwp, 8);

                            this.model.total_bulking_quantity = this.model.quantity * bulking_factor *
                                bulking_density * wastage_cal;

                            let no_trips_local = this.model.total_bulking_quantity / local_transport_loading_capacity;

                            if (no_trips_local < 1) {
                                no_trips_local = 1;
                            }

                            let distance = 0;

                            distance = this.model.local_distance;

                            let total_distance_local = distance * no_trips_local;

                            this.model.local_transport_co2e = truncateFloat(total_distance_local * this.model.total_bulking_quantity *
                                local_transport_gwp, 8);

                            let no_trips_overseas = 1;

                            let overseas_distance = isNaN(this.model.overseas_distance) ? 1 : this.model
                                .overseas_distance;

                            this.model.overseas_transport_co2e = truncateFloat(overseas_distance * no_trips_overseas * this.model
                                .total_bulking_quantity * overseas_transport_gwp, 8);

                            this.model.total_transport_co2e = truncateFloat(this.model.overseas_transport_co2e +
                                this.model.local_transport_co2e, 8);

                            this.model.total_co2e = truncateFloat(this.model.overseas_transport_co2e +
                                this.model.local_transport_co2e + this.model.total_material_co2e, 8);

                            this.model.total_co2e_label = parseExponential(this.model.total_co2e);


                            logToConsole("calculate: demolition phase entry", {
                                subPhase: this.field.sub_phase,
                                bulking_factor: bulking_factor,
                                bulking_density: bulking_density,
                                local_transport_gwp: local_transport_gwp,
                                overseas_transport_gwp: overseas_transport_gwp,
                                local_transport_loading_capacity: local_transport_loading_capacity,
                                overseas_transport_loading_capacity: overseas_transport_loading_capacity,
                                wastage_cal: wastage_cal,
                                quantity: this.model.quantity,
                                total_bulking_quantity: this.model.total_bulking_quantity,
                                location_id: this.model.location_id,
                                total_distance_local: total_distance_local,
                                overseas_distance: this.model.overseas_distance,
                                no_trips_local: no_trips_local,
                                no_trips_overseas: no_trips_overseas,
                                total_material_co2e: this.model.total_material_co2e,
                                local_transport_co2e: this.model.local_transport_co2e,
                                overseas_transport_co2e: this.model.overseas_transport_co2e,
                                total_transport_co2e: this.model.total_transport_co2e,
                                total_co2e: this.model.total_co2e,
                                formulas: {
                                    total_material_co2e: "quantity * bulking_factor * wastage_cal * material_gwp",
                                    total_bulking_quantity: "quantity * bulking_factor * bulking_density * wastage_cal",
                                    local_transport_co2e: "total_distance_local * total_bulking_quantity " +
                                        "* local_transport_gwp",
                                    overseas_transport_co2e: "overseas_distance * no_trips_overseas " +
                                        "* total_bulking_quantity * overseas_transport_gwp"
                                }
                            }, LOG_TYPES.CALCULATION);
                        }
                    },
                    onValidated(isValid, errors) {
                        if (this.model.is_updated || this.model.is_new) {
                            this.$parent.$emit('disableAddEntryBtn', "add" + this.field.sub_phase + "EntryBtn", true);
                            if (isValid) {
                                this.$parent.$emit('disableAddEntryBtn', "add" + this.field.sub_phase + "EntryBtn", false);
                            }
                        }
                    },
                    onValidate: function ($event) {
                        let errors = this.$refs.vfg.validate();
                    },
                },
            });


            Vue.component('bsatDemolitionEntry', {
                template: '#bsatDemolitionEntry',
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
                        quantity: null,
                        material_id: null,
                        total_co2e: 0,
                        total_co2e_label: 0,
                        data: {
                            material_data: 1,
                        },
                    }
                    return {
                        vgfRef: "bsatDemolitionEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatDemolitionEntry.material,
                                model: "material_id",
                                help: BSAT_TOOLTIPS.bsatDemolitionEntry.material,
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
                                        let material_data = field.options.filter(i => i.id == newVal)[0];
                                        model.data.material_data = material_data;
                                        logToConsole("material onChanged", {
                                            material_data: model.data.material_data,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: field.quantity_label,
                                model: "quantity",
                                help: field.quantity_tooltip,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatDemolitionEntry.totalCo2e,
                                model: "total_co2e",
                                help: BSAT_TOOLTIPS.bsatDemolitionEntry.totalCo2e,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true
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
                    removeEntry: function (is_new, entry_id, sub_phase) {
                        const id = this.$vnode.key;
                        this.$parent.$emit('removeEntry', id, is_new, entry_id, sub_phase, "add" + sub_phase +
                            "EntryBtn");
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
                        logToConsole("info iconOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    labelOnClick(node, type) {
                        logToConsole("labelOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    itemInfo(node) {
                    },
                    calculate() {
                        if (this.$refs.bsatDemolitionEntry.validate()) {

                            let material_gwp = this.model.data.material_data.gwp === undefined ? 0 :
                                this.model.data.material_data.gwp;

                            this.model.total_co2e = truncateFloat(this.model.quantity * material_gwp, 8);

                            this.model.total_co2e_label = parseExponential(this.model.total_co2e);

                            logToConsole("calculate: demolition phase entry", {
                                quantity: this.model.quantity,
                                material_gwp: material_gwp,
                                total_co2e: this.model.total_co2e,
                            }, LOG_TYPES.CALCULATION);
                        }
                    },
                    onValidated(isValid, errors) {
                        if (this.model.is_updated || this.model.is_new) {
                            this.$parent.$emit('disableAddEntryBtn', "add" + this.field.sub_phase + "EntryBtn", true);
                            if (isValid) {
                                this.$parent.$emit('disableAddEntryBtn', "add" + this.field.sub_phase + "EntryBtn", false);
                            }
                        }
                    },
                    onValidate: function ($event) {
                        let errors = this.$refs.vfg.validate();
                    },
                },
            });

            Vue.component('bsatLandFillSalvageEntry', {
                template: '#bsatLandFillSalvageEntry',
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
                        material_id: null,
                        salvage_percentage: null,
                        landfill_percentage: null,
                        salvage_quantity: null,
                        landfill_quantity: null,
                        landfill_location_id: null,
                        landfill_other_location: null,
                        landfill_distance: null,
                        landfill_transport_vehicle_id: null,
                        landfill_co2e: null,
                        salvage_co2e: null,
                        landfill_data: {
                            transport_data: 1,
                        },
                    }
                    let model = field.model;

                    if (undefined != field.model) {
                        let material = resources.material_list.filter(i => i.id == model.material_id)[0];
                        model.material_name = material.label;
                    }

                    return {
                        vgfRef: "bsatLandFillSalvageEntry",
                        model: model,
                        schema: {
                            fields: [
                                {
                                    type: "customInput",
                                    inputType: "text",
                                    model: "material_name",
                                    styleClasses: 'vgf-input-fixed-lg',
                                    fieldClasses: 'vgf-input-fixed-lg',
                                    readonly: true,
                                },
                                {
                                    type: "input",
                                    inputType: "number",
                                    model: "salvage_percentage",
                                    styleClasses: 'vgf-input-fixed',
                                    required: true,
                                    min: 0,
                                    max: 100,
                                    validator: ["number", "double", "required"],
                                    onChanged: function (model, newVal, oldVal) {

                                        if (newVal >= 0 && 100 - newVal >= 0) {
                                            model.landfill_percentage = 100 - newVal;

                                            let wastage = this.model.wastage === undefined ? 0 :
                                                this.model.wastage;

                                            let adjusting_factor = (100 - wastage) / 100;

                                            let material_bulking_density = this.model.data.material_data.bulking_density === undefined ? 1 :
                                                this.model.data.material_data.bulking_density;

                                            this.model.salvage_quantity = truncateFloat(this.model.quantity * (this.model.salvage_percentage / 100) *
                                                adjusting_factor * material_bulking_density, 5);

                                            this.model.landfill_quantity = truncateFloat(this.model.total_bulking_quantity * (this.model
                                                .landfill_percentage / 100), 5);

                                            this.$parent.$parent.$parent.$emit("calculate", this);
                                        }
                                    }
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    model: "landfill_percentage",
                                    styleClasses: 'vgf-input-fixed',
                                    readonly: true,
                                    onChanged: function (model, newVal, oldVal) {
                                    }
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    model: "salvage_quantity",
                                    styleClasses: 'vgf-input-fixed',
                                    readonly: true,
                                    onChanged: function (model, newVal, oldVal) {
                                    }
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    model: "landfill_quantity",
                                    styleClasses: 'vgf-input-fixed',
                                    readonly: true,
                                    onChanged: function (model, newVal, oldVal) {
                                    }
                                }, {
                                    type: "treeSelect",
                                    model: "landfill_location_id",
                                    styleClasses: 'bsat-tree-select',
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
                                        if (newVal !== undefined) {
                                            if (newVal !== -1) {
                                                let distance = resources.destinations.filter(i => i.id ===
                                                    newVal)[0].distance;
                                                model.landfill_distance = distance;
                                            } else {
                                                model.landfill_other_location = null;
                                            }
                                            setTimeout(() => {
                                                this.$parent.$parent.$parent.$emit("calculate", this);
                                            }, 100);
                                        } else {
                                            model.landfill_distance = null;
                                            model.salvage_co2e = null;
                                            model.landfill_co2e = null;
                                        }
                                    }
                                }, {
                                    type: "input",
                                    inputType: "text",
                                    model: "landfill_other_location",
                                    styleClasses: 'vgf-input-fixed',
                                    required: true,
                                    validator: ["validateText", "required"],
                                    onChanged: function (model, newVal, oldVal, field) {
                                        this.$parent.$parent.$parent.$emit("calculate", this);
                                    },
                                    visible: function (model) {
                                        return false;
                                    }
                                }, {
                                    type: "treeSelect",
                                    model: "landfill_transport_vehicle_id",
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
                                        model.landfill_data = {
                                            transport_data: 1,
                                        };
                                        if (newVal !== undefined) {
                                            model.landfill_data.transport_data = field.values().filter(i => i.id === newVal)[0]

                                            if (model.landfill_data.transport_data === undefined) {
                                                model.landfill_data.transport_data = field.values().filter(i => i.id === "UV00")[0]
                                                    .children.filter(i => i.id === newVal)[0];
                                            }

                                            logToConsole("local vehicle onChanged", {
                                                local_transport_data: model.landfill_data.transport_data,
                                            }, LOG_TYPES.EVENT);
                                        } else {
                                            model.salvage_co2e = null;
                                            model.landfill_co2e = null;
                                        }
                                        this.$parent.$parent.$parent.$emit("calculate", this);
                                    }
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    model: "landfill_distance",
                                    styleClasses: 'vgf-input-fixed',
                                    required: true,
                                    min: 0,
                                    validator: ["number", "double", "required"],
                                    onChanged: function (model, newVal, oldVal) {
                                        this.$parent.$parent.$parent.$emit("calculate", this);
                                    },
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    model: "landfill_co2e",
                                    styleClasses: 'vgf-input-fixed',
                                    readonly: true,
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    model: "salvage_co2e",
                                    styleClasses: 'vgf-input-fixed',
                                    readonly: true
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
                    removeEntry: function (is_new, entry_id, sub_phase) {
                        const id = this.$vnode.key;
                        this.$parent.$emit('removeEntry', id, is_new, entry_id, sub_phase, "add" + sub_phase +
                            "EntryBtn");
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
                            case "material":
                                infoList = {
                                    "Material Name": label,
                                    "Country": countries,
                                    "Year": year,
                                    "Standard": standard,
                                    "Data Source": data_source,
                                    "Technical Specification": technical_specification,
                                    "Global Warming Potential": gwp,
                                }
                                openInfoModal("Material Details", infoList);
                                break;
                        }
                        logToConsole("info iconOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    labelOnClick(node, type) {
                        logToConsole("labelOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    itemInfo(node) {
                    },
                    calculate() {
                        if (this.$refs.bsatLandFillSalvageEntry.validate()) {

                            let quantity = this.model.quantity === undefined ? 0 :
                                this.model.quantity;

                            let total_bulking_quantity = this.model.total_bulking_quantity === undefined ? 0 :
                                this.model.total_bulking_quantity;

                            let wastage = this.model.wastage === undefined ? 0 :
                                this.model.wastage;

                            let adjusting_factor = (100 - wastage) / 100;

                            let loading_capacity = this.model.landfill_data.transport_data.loading_capacity === undefined ? 0 :
                                this.model.landfill_data.transport_data.loading_capacity;

                            let transport_gwp = this.model.landfill_data.transport_data.gwp === undefined ? 0 :
                                this.model.landfill_data.transport_data.gwp;

                            let material_gwp = this.model.data.material_data.gwp === undefined ? 0 :
                                this.model.data.material_data.gwp;

                            let material_bulking_density = this.model.data.material_data.bulking_density === undefined ? 1 :
                                this.model.data.material_data.bulking_density;

                            let no_trips = truncateFloat(this.model.landfill_quantity / loading_capacity, 4);

                            this.model.landfill_co2e = truncateFloat(this.model.landfill_quantity * this.model.landfill_distance
                                * no_trips * transport_gwp, 8);

                            let salvage_co2e = truncateFloat(this.model.salvage_quantity * material_gwp
                                * (this.model.salvage_percentage / 100), 8);

                            this.model.salvage_co2e = -salvage_co2e;

                            logToConsole("calculate: landfill_and_salvage", {
                                subPhase: this.field.sub_phase,
                                quantity: quantity,
                                material_bulking_density: material_bulking_density,
                                total_bulking_quantity: total_bulking_quantity,
                                wastage: wastage,
                                adjusting_factor: adjusting_factor,
                                salvage_quantity: this.model.salvage_quantity,
                                landfill_quantity: this.model.landfill_quantity,
                                loading_capacity: loading_capacity,
                                transport_gwp: transport_gwp,
                                material_gwp: material_gwp,
                                landfill_distance: this.model.landfill_distance,
                                no_trips: no_trips,
                                landfill_co2e: this.model.landfill_co2e,
                                salvage_co2e: this.model.salvage_co2e,
                                formulas: {
                                    salvage_quantity: "quantity * (salvage_percentage / 100) * " +
                                        "adjusting_factor * material_bulking_density",
                                    landfill_quantity: "total_bulking_quantity * (landfill_percentage / 100)",
                                    landfill_co2e: "landfill_quantity * landfill_distance * no_trips " +
                                        "* transport_gwp",
                                    salvage_co2e: "- * (salvage_quantity * material_gwp * (salvage_percentage / 100))"
                                }
                            }, LOG_TYPES.CALCULATION);
                        }
                    }
                    ,
                    onValidated(isValid, errors) {
                        if (this.model.is_updated || this.model.is_new) {
                            this.$parent.$emit('disableAddEntryBtn', "add" + this.field.sub_phase + "EntryBtn", true);
                            if (isValid) {
                                this.$parent.$emit('disableAddEntryBtn', "add" + this.field.sub_phase + "EntryBtn", false);
                            }
                        }
                    }
                    ,
                    onValidate: function ($event) {
                        let errors = this.$refs.vfg.validate();
                    }
                    ,
                },
            });


            Vue.component('demolitionSubPhase', {
                template: '#demolitionSubPhase',
                props: ['field'],
                data: function () {
                    return {
                        cssClasses: "",
                        fields: [],
                        count: 0,
                    }
                },
                mounted() {
                    this.$on('removeEntry', this.removeEntry);
                    this.$on('addEntry', this.addEntry);
                    this.$on('disableAddEntryBtn', this.disableAddEntryBtn);
                    this.generateModels(this.field.model, this.field.sub_phase);
                },
                methods: {
                    addEntry: function (subPhase) {
                        if (subPhase === "chemicals") {
                            this.cssClasses = "accordion-collapse bsat-chemical-entry show";
                            this.fields.push({
                                'type': "bsatChemicalEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'distances': resources.distances,
                                'materials': resources.chemicals,
                                'vehicles': resources.vehicles,
                                'is_new': 1
                            });
                        } else if (subPhase === "water_consumption_on_site") {
                            this.cssClasses = "accordion-collapse bsat-demolition-entry show";
                            this.fields.push({
                                'type': "bsatDemolitionEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.water_types,
                                'is_new': 1
                            });
                        } else if (subPhase === "fuel_use_on_site") {
                            this.cssClasses = "accordion-collapse bsat-demolition-entry show";
                            this.fields.push({
                                'type': "bsatDemolitionEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.fuel_types,
                                'quantity_label': BSAT_LABELS.bsatDemolitionEntry.quantityFuel,
                                'quantity_tooltip': BSAT_TOOLTIPS.bsatDemolitionEntry.quantityFuel,
                                'is_new': 1
                            });
                        } else if (subPhase === "landfill_and_salvage") {
                            this.cssClasses = "accordion-collapse bsat-demolition-entry-lg show";
                            this.fields.push({
                                'type': "bsatLandFillSalvageEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.materials,
                                'distances': resources.distances,
                                'vehicles': resources.vehicles,
                                'is_new': 1,
                            });
                        } else {
                            this.cssClasses = "accordion-collapse bsat-demolition-entry show";
                            this.fields.push({
                                'type': "bsatDemolitionEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.electricity_types,
                                'quantity_label': BSAT_LABELS.bsatDemolitionEntry.quantityElectricity,
                                'quantity_tooltip': BSAT_TOOLTIPS.bsatDemolitionEntry.quantityElectricity,
                                'is_new': 1
                            });
                        }
                    },
                    generateModels: function (models, subPhase) {
                        switch (subPhase) {
                            case "chemicals":
                                this.cssClasses = "accordion-collapse bsat-chemical-entry";
                                models.forEach((model) => {
                                    this.fields.push({
                                        'type': "bsatChemicalEntry",
                                        'id': this.count++,
                                        'model': model,
                                        'sub_phase': subPhase,
                                        'distances': resources.distances,
                                        'materials': resources.chemicals,
                                        'vehicles': resources.vehicles,
                                        'is_new': 0,
                                        'entry_id': model.id
                                    });
                                });
                                break;
                            case "water_consumption_on_site":
                                this.cssClasses = "accordion-collapse bsat-demolition-entry";
                                models.forEach((model) => {
                                    this.fields.push({
                                        'type': "bsatDemolitionEntry",
                                        'id': this.count++,
                                        'model': model,
                                        'sub_phase': subPhase,
                                        'materials': resources.water_types,
                                        'is_new': 0,
                                        'entry_id': model.id
                                    });
                                });
                                break;
                            case "fuel_use_on_site":
                                this.cssClasses = "accordion-collapse bsat-demolition-entry";
                                models.forEach((model) => {
                                    this.fields.push({
                                        'type': "bsatDemolitionEntry",
                                        'id': this.count++,
                                        'model': model,
                                        'sub_phase': subPhase,
                                        'materials': resources.fuel_types,
                                        'quantity_label': BSAT_LABELS.bsatDemolitionEntry.quantityFuel,
                                        'quantity_tooltip': BSAT_TOOLTIPS.bsatDemolitionEntry.quantityFuel,
                                        'is_new': 0,
                                        'entry_id': model.id
                                    });
                                });
                                break;
                            case "electricity_use_on_site":
                                this.cssClasses = "accordion-collapse bsat-demolition-entry";
                                models.forEach((model) => {
                                    this.fields.push({
                                        'type': "bsatDemolitionEntry",
                                        'id': this.count++,
                                        'model': model,
                                        'sub_phase': subPhase,
                                        'materials': resources.electricity_types,
                                        'quantity_label': BSAT_LABELS.bsatDemolitionEntry.quantityElectricity,
                                        'quantity_tooltip': BSAT_TOOLTIPS.bsatDemolitionEntry.quantityElectricity,
                                        'is_new': 0,
                                        'entry_id': model.id
                                    });
                                });
                                break;
                            case "landfill_and_salvage":
                                this.cssClasses = "accordion-collapse bsat-landfill-salvage-entry";
                                models.forEach((model) => {
                                    let material = resources.material_list.filter(i => i.id == model.material_id)[0];
                                    if (undefined != material) {
                                        this.fields.push({
                                            'type': "bsatLandFillSalvageEntry",
                                            'id': this.count++,
                                            'model': model,
                                            'sub_phase': subPhase,
                                            'materials': resources.materials,
                                            'distances': resources.distances,
                                            'vehicles': resources.vehicles,
                                            'is_new': 0,
                                            'entry_id': model.id
                                        });
                                    }
                                });
                                break;
                        }
                    },
                    removeEntry: async function (id, is_new, entry_id, sub_phase, addEntryBtnId) {
                        const index = this.fields.findIndex(f => f.id === id);
                        this.fields.splice(index, 1);

                        if (!is_new) {
                            axios.delete('/api/demolition-phase-entries/' + project_id + '/' + urlEncodeSlug(sub_phase) + '/' +
                                entry_id)
                                .then(async (response) => {
                                    logToConsole("removeEntry resp", response, LOG_TYPES.HTTP_REQUEST);
                                    await saveDemolition(false);
                                })
                                .catch(error => {
                                    logToConsole("removeEntry error", error, LOG_TYPES.ERROR);
                                });
                        }
                        let isValid = true;

                        await sleep(50);
                        for (let child of this.$children) {
                            if ((undefined != child.$refs.bsatDemolitionEntry && !child.$refs.bsatDemolitionEntry
                                .validate()) || (undefined != child.$refs.bsatChemicalEntry &&
                                !child.$refs.bsatChemicalEntry.validate())) {
                                this.$emit('disableAddEntryBtn', addEntryBtnId, true);
                                isValid = false;
                                break;
                            }
                        }

                        if (isValid) {
                            this.$emit('disableAddEntryBtn', addEntryBtnId, false);
                        }
                    },

                    disableAddEntryBtn: function (btnId, disableBtn) {
                        if (disableBtn) {
                            $("#" + btnId).prop('disabled', true);
                        } else {
                            $("#" + btnId).prop('disabled', false);
                        }
                    }
                }
            });

            demolition = generateComponent('#demolition', demolitionEntries);

            function generateComponent(elem, data) {
                return new Vue({
                    el: elem,
                    data: {
                        fields: [],
                        count: 0,
                    },
                    mounted() {
                        this.generateModels(data);
                    },
                    methods: {
                        generateModels: function (models) {

                            let subPhaseList = ["electricity_use_on_site", "fuel_use_on_site", "chemicals", "landfill_and_salvage"];

                            subPhaseList.forEach((subPhase) => {
                                let model = models[subPhase];
                                this.fields.push({
                                    'type': 'demolitionSubPhase',
                                    'id': this.count,
                                    'model': model.entries,
                                    'accordion': "accordion" + subPhase + this.count,
                                    'accordionId': "accordion" + subPhase + this.count,
                                    'accordionParent': "#accordion" + subPhase + this.count,
                                    'collapseId': "collapse" + subPhase + this.count,
                                    'collapseTarget': "#collapse" + subPhase + this.count,
                                    'sub_phase': subPhase,
                                    'sub_phase_label': model.label,
                                    'sub_phase_description': model.description,
                                    'addEntryButtonId': "add" + subPhase + "EntryBtn",
                                })
                                this.count++;
                            });
                        },
                        getModals: function () {
                            let total_machinery_co2e = 0;
                            let total_transport_co2e = 0;
                            let total_material_co2e = 0;
                            let total_energy_co2e = 0;

                            let resp = {};

                            this.$children.map(function (child) {
                                total_material_co2e = 0;
                                total_transport_co2e = 0;
                                total_energy_co2e = 0;
                                let models;

                                if (child.field.sub_phase === "landfill_and_salvage") {
                                    let total_landfill_co2e = 0;
                                    let total_salvage_co2e = 0;
                                    models = child.$children.map(function (child) {

                                        if (undefined === child.model.landfill_location_id) {
                                            child.model.landfill_location_id = null
                                        }

                                        if (undefined === child.model.landfill_transport_vehicle_id) {
                                            child.model.landfill_transport_vehicle_id = null
                                        }

                                        total_landfill_co2e = total_landfill_co2e + child.model.landfill_co2e;
                                        total_salvage_co2e = total_salvage_co2e + child.model.salvage_co2e;
                                        return child.model;
                                    });

                                    const updatedModels = models.filter(item => item.is_updated && !item.is_new);

                                    resp[child.field.sub_phase] = {
                                        "sub_phase": child.field.sub_phase,
                                        "total_machinery_co2e": total_machinery_co2e,
                                        "total_material_co2e": total_salvage_co2e,
                                        "total_transport_co2e": total_landfill_co2e,
                                        "updated_entries": updatedModels || {},
                                    };
                                } else {
                                    if (child.field.sub_phase === "chemicals") {
                                        models = child.$children.map(function (child) {
                                            total_material_co2e = total_material_co2e + child.model.total_material_co2e;
                                            total_transport_co2e = total_transport_co2e + child.model.total_transport_co2e;
                                            return child.model;
                                        });
                                    } else {
                                        models = child.$children.map(function (child) {
                                            total_energy_co2e = total_energy_co2e + child.model.total_co2e;
                                            return child.model;
                                        });
                                    }

                                    const updatedModels = models.filter(item => item.is_updated && !item.is_new);
                                    const newModels = models.filter(item => item.is_new);

                                    resp[child.field.sub_phase] = {
                                        "sub_phase": child.field.sub_phase,
                                        "total_machinery_co2e": total_machinery_co2e,
                                        "total_material_co2e": total_material_co2e,
                                        "total_transport_co2e": total_transport_co2e,
                                        "total_energy_co2e": total_energy_co2e,
                                        "new_entries": newModels || {},
                                        "updated_entries": updatedModels || {},
                                    };
                                }
                            });
                            return resp;
                        }
                    }
                })
            }

            $("#btnSave").on("click", function () {
                let isValid = true;
                if (!validateEntries(demolition, "demolition-phase", "foundation")) {
                    isValid = false;
                }

                if (isValid) {
                    saveDemolition(true);
                } else {
                    errorToast('Fill All Required Fields!');
                }
            });

        }

        async function saveDemolition(regenerateEntries) {
            let demolition_data = demolition.getModals();

            await axios.post("/api/demolition-phase-entries/" + project_id, {"data": demolition_data})
                .then(response => {
                    logToConsole("saveDemolition resp", response, LOG_TYPES.HTTP_REQUEST);

                    if (regenerateEntries) {
                        demolition.fields = [];
                        demolition.generateModels(response.data)
                        successToast('Project Saved!');
                    }

                }).then(() => {

                    axios.get("/api/results/" + project_id + "/demolition-phase/type/chart")
                        .then(response => {
                            logToConsole("chart result resp", response, LOG_TYPES.HTTP_REQUEST);
                            updateSubPhaseChartDataSet(demolitionChart, response.data.chart, "demolitionPhase");
                        }).catch(error => {
                        errorToast('Result Generation Failed!');
                        logToConsole("chart result resp error", error, LOG_TYPES.ERROR);
                    });

                    refreshSubPhaseTableData("demolitionResultTable", "demolition-phase");
                }).catch(error => {
                    errorToast('Failed To Save!');
                    logToConsole("saveDemolition error", error, LOG_TYPES.ERROR);
                });
        }

        async function navigate(location) {
            let isValid = true;
            if (!validateEntries(demolition, "demolition-phase", "foundation")) {
                isValid = false;
            }

            if (isValid) {
                await saveDemolition(false);
                window.location.href = location;
            } else {
                errorToast('Fill All Required Fields!');
            }
        }
    </script>
@stop
