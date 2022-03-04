@section('title', 'Substructure')
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

        .bsat-tree-select .vue-treeselect__menu {
            max-height: 500px !important;
            width: 400px !important;
            overflow: auto !important;
        }

        .bsat-tree-select .vue-treeselect__list {

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
            width: 750px !important;
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

        .bsat-substructure-entry {
            width: 1965px;
        }

        .bsat-substructure-entry-lg {
            width: 2085px;
        }

        .bsat-substructure-mortar-entry {
            width: 2410px;
        }

        .bsat-substructure-mortar-entry-lg {
            width: 2530px;
        }

        .bsat-substructure-mortar-entry-xl {
            width: 2700px;
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

        .bsat-substructure-entry .bsat-entry div:nth-of-type(1) .field-input:nth-of-type(3) {
            width: 100px !important;
        }

        .bsat-entry .field-input:nth-of-type(3) span:nth-child(1) {
            display: inline;
        }

        .bsat-entry:nth-of-type(1) .field-treeSelect:nth-of-type(5) [for] span:nth-of-type(1) {
            display: inline;
        }

        .bsat-label-margin-top > label > span:nth-of-type(1) {
            display: inline;
        }

        .bsat-label-margin-top {
            margin-top: -14px !important;
        }

        .earth-support-accordion-header {
            width: 250px;
        }

        .termite-treatment-accordion-header {
            width: 400px;
        }

        .other-concrete-works-accordion-header {
            width: 250px;
        }

        .file {
            height: 34px !important;
        }

        #accordionSubStructureResultsTable {
            width: 1350px;
        }

        #subStructureResultTable tr > th:not(:first-child), td:not(:first-child) {
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
            <h2>Substructure</h2>
            Use this section to enter all the materials used in the construction of substructure including embankments,
            walls, earth support systems, formwork and mortar and plastering used in substructure.
        </div>

        <div class="col-md-12">
            <div id="subStructure">
                <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                </div>
            </div>

            <!--  Results Accordion  -->
            <div class="accordion bsat-accordion" id="accordionSubStructureResults">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSubStructureResults" aria-expanded="false"
                                aria-controls="collapseSubStructureResults">
                            <div class="bsat-sub-phase-label">Results</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseSubStructureResults" class="accordion-collapse collapse"
                     aria-labelledby="accordionSubStructureResults"
                     data-bs-parent="#accordionSubStructureResults">
                    <div class="accordion-body" style="padding: 0rem 1.25rem;">
                        <div class="col-md-12">
                            <p class="bsat-result-description">
                                The global warming potential (kg CO2 – eq) related to Substructure activities such as
                                Foundation, Retaining walls, Earth support systems, Formworks, Insulation, Termite
                                treatment and damp proof course, Other concrete works and Mortar in Substructure are
                                displayed with respect to machinery, material, transport, energy and water related
                                impacts. The user can use this information to further analyze the hotspots of different
                                construction activities and operations.
                            </p>
                        </div>
                        <!-- Result Table Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionSubStructureResultsTable">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSubStructureResultsTable" aria-expanded="false"
                                            aria-controls="collapseSubStructureResultsTable">
                                        <div class="bsat-sub-phase-label">Table View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSubStructureResultsTable" class="accordion-collapse collapse"
                                 aria-labelledby="accordionSubStructureResultsTable"
                                 data-bs-parent="#accordionSubStructureResultsTable">
                                <div class="accordion-body">
                                    <div class="justify-content-center">
                                        <h3 class="text-center">Global Warming Potential of Substructure Activities</h3>
                                        <table id="subStructureResultTable" data-unique-id="id" class="table">
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
                        <div class="accordion bsat-accordion" id="accordionSubStructureResultsChart">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSubStructureResultsChart" aria-expanded="false"
                                            aria-controls="collapseSubStructureResultsChart">
                                        <div class="bsat-sub-phase-label">Chart View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSubStructureResultsChart" class="accordion-collapse collapse"
                                 aria-labelledby="accordionSubStructureResultsChart"
                                 data-bs-parent="#accordionSubStructureResultsChart">
                                <div class="accordion-body">
                                    <div>
                                        <canvas id="subStructureResultChart"></canvas>
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

    <!-- SubStructure Template -->
    <template id="subStructureSubPhase">
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
                 :aria-labelledby="field.accordionId" :data-bs-parent="field.accordionParent">
                <div class="accordion-body">
                    <div class="col-md-12 bsat-sub-phase-description">@{{ field.sub_phase_description }}</div>
                    <div>
                        <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                        </div>
                        <button :id="field.addEntryButtonId" class="btn btn-primary bsat-entry-btn"
                                v-on:click="addEntry(field.sub_phase)">Add Entry
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Generated SubPhase -->
    </template>
    <!-- End SubStructure Template  -->

    <!-- SubStructure Entry Template -->
    <template id="bsatSubStructureEntry">
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
    <!-- SubStructure Entry Template  -->

    <!-- Sub Structure Mortar Entry Template -->
    <template id="bsatMortarSubStructureEntry">
        <div class="bsat-entry" :id="field.id" style="">
            <div style="text-align: right">
                <i class="fa fa-window-close" style="color: red"
                   v-on:click="removeEntry(field.is_new,field.entry_id,field.sub_phase)"></i>
            </div>
            <div>
                <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div" :ref="vgfRef"
                                    @model-updated="onModelUpdated" @validated="onValidated">
                </vue-form-generator>
            </div>
        </div>
    </template>
    <!-- End Sub Structure Mortar Entry Template  -->

    <script>
        let user_id = {{ Auth::user()->id }};
        let project_id = {{ $project_id }};
        const PROJECT_SERVICE_LIFE = {{ $project_life }};
        let resources;
        let subStructureChart;
        let subStructureEntries;
        let subStructure;

        (function () {
            const promise1 = axios.get("/api/resources/" + project_id + "/sub-structure");
            const promise2 = axios.get("/api/sub-structure-entries/" + project_id);

            Promise.all([promise1, promise2]).then(function (values) {
                resources = values[0].data;
                subStructureEntries = values[1].data;
                logToConsole("resp", {
                    resources: resources,
                    subStructureEntries: subStructureEntries
                }, LOG_TYPES.HTTP_REQUEST);
                init();
                loadingOverlay.classList.add('hide-loader');
            });
        })();

        async function init() {
            initSubStructure();
            subStructureChart = await generateMainPhaseResult("sub-structure", "subStructureResultTable",
                "subStructureResultChart", CHART_TITLES.subStructurePhase, "subStructure");
        }

        function initSubStructure() {

            Vue.component('bsatSubStructureEntry', {
                template: '#bsatSubStructureEntry',
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
                        vgfRef: "bsatSubStructureEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatSubStructureEntry.material,
                                model: "material_id",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.material,
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
                                label: BSAT_LABELS.bsatSubStructureEntry.quantity,
                                model: "quantity",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.quantity,
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
                                label: BSAT_LABELS.bsatSubStructureEntry.serviceLife,
                                model: "service_life",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.serviceLife,
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
                                label: BSAT_LABELS.bsatSubStructureEntry.wastage,
                                model: "wastage",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.wastage,
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
                                label: BSAT_LABELS.bsatSubStructureEntry.localResourceLocation,
                                model: "location_id",
                                styleClasses: 'bsat-tree-select bsat-label-margin-top',
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.localResourceLocation,
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
                                label: BSAT_LABELS.bsatSubStructureEntry.otherLocation,
                                model: "other_location",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.otherLocation,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                validator: ["validateText", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    if (undefined != this.$options.parent.$el) {
                                        if (model && model.location_id === -1) {
                                            this.$options.parent.$el.classList.add("bsat-substructure-entry-lg");
                                        } else {
                                            this.$options.parent.$el.classList = ["bsat-entry"];
                                        }
                                    }
                                    return model && model.location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatSubStructureEntry.localDistance,
                                model: "local_distance",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.localDistance,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatSubStructureEntry.localTransport,
                                model: "local_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.localTransport,
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
                                label: BSAT_LABELS.bsatSubStructureEntry.overseasDistance,
                                model: "overseas_distance",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.overseasDistance,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                min: 0,
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatSubStructureEntry.overseasTransport,
                                model: "overseas_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.overseasTransport,
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
                                label: BSAT_LABELS.bsatSubStructureEntry.totalCo2e,
                                model: "total_co2e",
                                help: BSAT_TOOLTIPS.bsatSubStructureEntry.totalCo2e,
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
                        if (this.$refs.bsatSubStructureEntry.validate()) {

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


                            logToConsole("calculate: substructure entry", {
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
                                    total_distance_local: "distance * no_trips_local",
                                    total_material_co2e: "quantity * bulking_factor * wastage_cal * material_gwp",
                                    total_bulking_quantity: "quantity * bulking_factor *bulking_density * wastage_cal",
                                    local_transport_co2e: "total_distance_local * total_bulking_quantity * local_transport_gwp",
                                    overseas_transport_co2e: "overseas_distance * no_trips_overseas * " +
                                        "total_bulking_quantity * overseas_transport_gwp",
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

            Vue.component('bsatMortarSubStructureEntry', {
                template: '#bsatMortarSubStructureEntry',
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
                        mortar_id: null,
                        area: null,
                        thickness: null,
                        service_life: null,
                        wastage: null,
                        sand_resource_location_id: null,
                        sand_resource_other_location: null,
                        sand_transport_distance: null,
                        sand_transport_vehicle_id: null,
                        cement_resource_location_id: null,
                        cement_resource_other_location: null,
                        cement_transport_distance: null,
                        cement_transport_vehicle_id: null,
                        sand_bulking_quantity: null,
                        cement_bulking_quantity: null,
                        sand_co2e: null,
                        cement_co2e: null,
                        sand_transport_co2e: null,
                        cement_transport_co2e: null,
                        total_material_co2e: null,
                        total_transport_co2e: null,
                        total_co2e: null,
                        total_co2e_label: null,
                        is_replaceable: 0,
                        is_salvage: 0,
                        data: {
                            mortar_data: 1,
                            sand_transport_data: 1,
                            cement_transport_data: 1,
                        }
                    };
                    return {
                        vgfRef: "bsatMortarSubStructureEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.material,
                                model: "mortar_id",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.material,
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
                                    return field.mortars;
                                },
                                options: field.mortars,
                                selectOptions: {
                                    type: "mortar",
                                    searchable: true,
                                    closeOnSelect: true,
                                    showInfoIcon: false,
                                    closeOnLabelClick: true,
                                },
                                onChanged: function (model, newVal, oldVal, field) {
                                    model.data.mortar_data = 1;
                                    if (newVal !== undefined) {
                                        let mortar_data = resources.mortars_list.filter(i => i.id == newVal)[0];
                                        model.wastage = mortar_data.wastage;
                                        model.service_life = mortar_data.service_life === -1 ?
                                            PROJECT_SERVICE_LIFE : mortar_data.service_life;
                                        model.is_replaceable = mortar_data.is_replaceable;
                                        model.is_salvage = mortar_data.is_salvage;
                                        model.data.mortar_data = mortar_data;

                                        logToConsole("material onChanged", {
                                            mortar_data: model.data.mortar_data,
                                            service_life: model.service_life,
                                            wastage: model.wastage,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.area,
                                model: "area",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.area,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    logToConsole("area onChanged", model.area, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.thickness,
                                model: "thickness",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.thickness,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    logToConsole("thickness onChanged", model.thickness, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.serviceLife,
                                model: "service_life",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.serviceLife,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    logToConsole("service_life onChanged", model.service_life, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.wastage,
                                model: "wastage",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.wastage,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                max: 100,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    logToConsole("wastage onChanged", model.wastage, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.sandResourceLocation,
                                model: "sand_resource_location_id",
                                styleClasses: 'bsat-tree-select bsat-label-margin-top',
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.sandResourceLocation,
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
                                            model.sand_transport_distance = distance;
                                        } else {
                                            model.sand_resource_other_location = null;
                                            model.sand_transport_distance = null;
                                        }
                                        setTimeout(() => {
                                            this.$parent.$parent.$parent.$emit("calculate", this);
                                        }, 100);
                                    }
                                }
                            }, {
                                type: "input",
                                inputType: "text",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.otherSandResourceLocation,
                                model: "sand_resource_other_location",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.otherSandResourceLocation,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                validator: ["validateText", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    if (undefined != this.$options.parent.$el) {
                                        if (model && model.sand_resource_location_id === -1
                                            && model.cement_resource_location_id === -1) {
                                            this.$options.parent.$el.classList = ["bsat-entry " +
                                            "bsat-substructure-mortar-entry-xl"];
                                        } else if (model && model.sand_resource_location_id === -1 || model
                                            .cement_resource_location_id === -1) {
                                            this.$options.parent.$el.classList = ["bsat-entry " +
                                            "bsat-substructure-mortar-entry-lg"];
                                        } else {
                                            this.$options.parent.$el.classList = ["bsat-entry"];
                                        }
                                    }
                                    return model && model.sand_resource_location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.sandTransportDistance,
                                model: "sand_transport_distance",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.sandTransportDistance,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    logToConsole("sand_transport_distance onChanged", model.sand_transport_distance, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.sandTransportVehicle,
                                model: "sand_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.sandTransportVehicle,
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
                                    model.data.sand_transport_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.sand_transport_data = field.values().filter(i => i.id === newVal)[0]

                                        if (model.data.sand_transport_data === undefined) {
                                            model.data.sand_transport_data = field.values().filter(i => i.id === "UV00")[0]
                                                .children.filter(i => i.id === newVal)[0];
                                        }

                                        logToConsole("local vehicle onChanged", {
                                            sand_transport_data: model.data.sand_transport_data,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.cementResourceLocation,
                                model: "cement_resource_location_id",
                                styleClasses: 'bsat-tree-select bsat-label-margin-top',
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.cementResourceLocation,
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
                                            model.cement_transport_distance = distance;
                                        } else {
                                            model.cement_resource_other_location = null;
                                            model.cement_transport_distance = null;
                                        }
                                        setTimeout(() => {
                                            this.$parent.$parent.$parent.$emit("calculate", this);
                                        }, 100);
                                    }
                                }
                            }, {
                                type: "input",
                                inputType: "text",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.otherCementResourceLocation,
                                model: "cement_resource_other_location",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.otherCementResourceLocation,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                validator: ["validateText", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    if (undefined != this.$options.parent.$el) {
                                        if (model && model.sand_resource_location_id === -1
                                            && model.cement_resource_location_id === -1) {
                                            this.$options.parent.$el.classList = ["bsat-entry " +
                                            "bsat-substructure-mortar-entry-xl"];
                                        } else if (model && model.cement_resource_location_id === -1 || model
                                            .sand_resource_location_id === -1) {
                                            this.$options.parent.$el.classList = ["bsat-entry " +
                                            "bsat-substructure-mortar-entry-lg"];
                                        } else {
                                            this.$options.parent.$el.classList = ["bsat-entry"];
                                        }
                                    }
                                    return model && model.cement_resource_location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.cementTransportDistance,
                                model: "cement_transport_distance",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.cementTransportDistance,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    logToConsole("cement_transport_distance onChanged", model.cement_transport_distance, LOG_TYPES.EVENT);
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.cementTransportVehicle,
                                model: "cement_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.cementTransportVehicle,
                                styleClasses: 'bsat-tree-select bsat-tree-select-md bsat-tree-select-overseas',
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
                                    model.data.cement_transport_data = 1;
                                    if (newVal !== undefined) {
                                        model.data.cement_transport_data = field.values().filter(i => i.id === newVal)[0]

                                        if (model.data.cement_transport_data === undefined) {
                                            model.data.cement_transport_data = field.values().filter(i => i.id === "UV00")[0]
                                                .children.filter(i => i.id === newVal)[0];
                                        }

                                        logToConsole("local vehicle onChanged", {
                                            cement_transport_data: model.data.cement_transport_data,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatMortarSubStructureEntry.totalCo2e,
                                model: "total_co2e",
                                help: BSAT_TOOLTIPS.bsatMortarSubStructureEntry.totalCo2e,
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
                        if (this.$refs.bsatMortarSubStructureEntry.validate()) {

                            let volume = this.model.area * this.model.thickness;

                            let mortar_percentage = this.model.data.mortar_data.mortar_percentage === undefined ? 0 :
                                this.model.data.mortar_data.mortar_percentage;

                            let cement_bulking_density = this.model.data.mortar_data.cement_bulking_density === undefined ? 0 :
                                this.model.data.mortar_data.cement_bulking_density;

                            let cement_bulking_factor = this.model.data.mortar_data.cement_bulking_factor === undefined ? 0 :
                                this.model.data.mortar_data.cement_bulking_factor;

                            let sand_bulking_density = this.model.data.mortar_data.sand_bulking_density === undefined ? 0 :
                                this.model.data.mortar_data.sand_bulking_density;

                            let sand_bulking_factor = this.model.data.mortar_data.sand_bulking_factor === undefined ? 0 :
                                this.model.data.mortar_data.sand_bulking_factor;

                            let sand_transport_gwp = this.model.data.sand_transport_data.gwp === undefined ? 0 :
                                this.model.data.sand_transport_data.gwp;

                            let cement_transport_gwp = this.model.data.cement_transport_data.gwp === undefined ? 0 :
                                this.model.data.cement_transport_data.gwp;

                            let sand_transport_loading_capacity = this.model.data.sand_transport_data.loading_capacity === undefined ? 0 :
                                this.model.data.sand_transport_data.loading_capacity;

                            let cement_transport_loading_capacity = this.model.data.sand_transport_data.loading_capacity ===
                            undefined ? 0 : this.model.data.sand_transport_data.loading_capacity;

                            let wastage_cal = (this.model.wastage + 100) / 100;

                            let mortar_volume = mortar_percentage * volume;

                            this.model.sand_bulking_quantity = 6 / 7 * mortar_volume * sand_bulking_factor *
                                wastage_cal * sand_bulking_density;

                            this.model.sand_co2e = truncateFloat(this.model.sand_bulking_quantity * 1000 * 0.003, 8);

                            let no_trips_sand = this.model.sand_bulking_quantity / sand_transport_loading_capacity;

                            if (no_trips_sand < 1) {
                                no_trips_sand = 1;
                            }

                            let total_sand_distance = this.model.sand_transport_distance * no_trips_sand;

                            this.model.sand_transport_co2e = truncateFloat(total_sand_distance * this.model.sand_bulking_quantity *
                                sand_transport_gwp, 8);

                            this.model.cement_bulking_quantity = 1 / 7 * mortar_volume * cement_bulking_factor *
                                wastage_cal * cement_bulking_density;

                            this.model.cement_co2e = truncateFloat(this.model.cement_bulking_quantity * 1000 * 0.94, 8);

                            let no_trips_cement = this.model.cement_bulking_quantity /
                                cement_transport_loading_capacity;

                            if (no_trips_cement < 1) {
                                no_trips_cement = 1;
                            }

                            let total_cement_distance = this.model.cement_transport_distance * no_trips_cement;

                            this.model.cement_transport_co2e = truncateFloat(total_cement_distance * this.model.cement_bulking_quantity *
                                cement_transport_gwp, 8);

                            let total_sand_co2e = this.model.sand_co2e + this.model.sand_transport_co2e;
                            let total_cement_co2e = this.model.cement_co2e + this.model.cement_transport_co2e;

                            this.model.total_material_co2e = truncateFloat(this.model.sand_co2e + this.model
                                .cement_co2e, 8);
                            this.model.total_transport_co2e = truncateFloat(this.model.sand_transport_co2e + this
                                .model.cement_transport_co2e, 8);

                            this.model.total_co2e = truncateFloat(this.model.total_material_co2e + this.model
                                .total_transport_co2e, 8);

                            this.model.total_co2e_label = parseExponential(this.model.total_co2e);

                            logToConsole("calculate: substructure mortar", {
                                subPhase: this.field.sub_phase,
                                volume: volume,
                                mortar_percentage: mortar_percentage,
                                cement_bulking_density: cement_bulking_density,
                                cement_bulking_factor: cement_bulking_factor,
                                sand_bulking_density: sand_bulking_density,
                                sand_bulking_factor: sand_bulking_factor,
                                sand_transport_gwp: sand_transport_gwp,
                                cement_transport_gwp: cement_transport_gwp,
                                sand_transport_loading_capacity: sand_transport_loading_capacity,
                                cement_transport_loading_capacity: cement_transport_loading_capacity,
                                wastage_cal: wastage_cal,
                                mortar_volume: mortar_volume,
                                sand_bulking_quantity: this.model.sand_bulking_quantity,
                                sand_co2e: this.model.sand_co2e,
                                no_trips_sand: no_trips_sand,
                                total_sand_distance: total_sand_distance,
                                sand_transport_co2e: this.model.sand_transport_co2e,
                                cement_bulking_quantity: this.model.cement_bulking_quantity,
                                cement_co2e: this.model.cement_co2e,
                                no_trips_cement: no_trips_cement,
                                total_cement_distance: total_cement_distance,
                                cement_transport_co2e: this.model.cement_transport_co2e,
                                total_sand_co2e: total_sand_co2e,
                                total_cement_co2e: total_cement_co2e,
                                total_material_co2e: this.model.total_material_co2e,
                                total_transport_co2e: this.model.total_transport_co2e,
                                total_co2e: this.model.total_co2e,
                                total_co2e_label: this.model.total_co2e_label,
                                formulas: {
                                    sand_bulking_quantity: "6 / 7 * mortar_volume * sand_bulking_factor * wastage_cal" +
                                        " * sand_bulking_density",
                                    sand_co2e: "sand_bulking_quantity * 1000 * 0.003",
                                    sand_transport_co2e: "total_sand_distance * this.model.sand_bulking_quantity * " +
                                        "sand_transport_gwp",
                                    cement_bulking_quantity: "1 / 7 * mortar_volume * cement_bulking_factor * " +
                                        "wastage_cal * cement_bulking_density",
                                    cement_co2e: "cement_bulking_quantity * 1000 * 0.94",
                                    cement_transport_co2e: "total_cement_distance * cement_bulking_quantity * " +
                                        "cement_transport_gwp",
                                }
                            }, LOG_TYPES.CALCULATION);
                        }
                    },
                    onValidated(isValid, errors) {
                        if (this.model.is_updated || this.model.is_new) {
                            this.$parent.$emit('disableAddEntryBtn', "add" + this.field.sub_phase + "EntryBtn", true);
                            if (isValid) {
                                this.$parent.$emit('disableAddEntryBtn', "add" + this.field.sub_phase + "EntryBtn",
                                    false);
                            }
                        }
                    },
                    onValidate: function ($event) {
                        let errors = this.$refs.vfg.validate();
                    },
                },
            });

            Vue.component('subStructureSubPhase', {
                template: '#subStructureSubPhase',
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
                        if (subPhase === "mortar_substructure") {
                            this.cssClasses = "accordion-collapse bsat-substructure-mortar-entry show";
                            this.fields.push({
                                'type': "bsatMortarSubStructureEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'distances': resources.distances,
                                'materials': resources.materials,
                                'mortars': resources.mortars,
                                'vehicles': resources.vehicles,
                                'is_new': 1
                            });
                        } else {
                            this.cssClasses = "accordion-collapse bsat-substructure-entry show";
                            this.fields.push({
                                'type': "bsatSubStructureEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'distances': resources.distances,
                                'materials': resources.materials,
                                'vehicles': resources.vehicles,
                                'is_new': 1
                            });
                        }
                    },
                    generateModels: function (models, subPhase) {

                        if (subPhase === "mortar_substructure") {
                            this.cssClasses = "accordion-collapse bsat-substructure-mortar-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatMortarSubStructureEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'distances': resources.distances,
                                    'materials': resources.materials,
                                    'mortars': resources.mortars,
                                    'vehicles': resources.vehicles,
                                    'is_new': 0,
                                    'entry_id': model.id
                                });
                            });
                        } else {
                            this.cssClasses = "accordion-collapse bsat-substructure-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatSubStructureEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'distances': resources.distances,
                                    'materials': resources.materials,
                                    'vehicles': resources.vehicles,
                                    'is_new': 0,
                                    'entry_id': model.id
                                })
                            });
                        }
                    },
                    removeEntry: async function (id, is_new, entry_id, sub_phase, addEntryBtnId) {
                        const index = this.fields.findIndex(f => f.id === id);
                        this.fields.splice(index, 1);

                        if (!is_new) {
                            axios.delete('/api/sub-structure-entries/' + project_id + '/' + urlEncodeSlug(sub_phase) + '/' +
                                entry_id)
                                .then(async (response) => {
                                    logToConsole("removeEntry resp", response, LOG_TYPES.HTTP_REQUEST);
                                    await saveSubStructure(false);
                                })
                                .catch(error => {
                                    logToConsole("removeEntry error", error, LOG_TYPES.ERROR);
                                });
                        }
                        let isValid = true;

                        await sleep(50);
                        for (let child of this.$children) {
                            if ((undefined != child.$refs.bsatSubStructureEntry && !child.$refs.bsatSubStructureEntry
                                .validate()) || (undefined != child.$refs.bsatMortarSubStructureEntry &&
                                !child.$refs.bsatMortarSubStructureEntry.validate())) {
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

            subStructure = generateComponent('#subStructure', subStructureEntries);

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

                            let subPhaseList = ["foundation", "retaining_walls", "earth_support_systems", "formwork",
                                "insulation", "termite_treatment_and_damp_proof_course", "other_concrete_works",
                                "mortar_substructure"]

                            subPhaseList.forEach((subPhase) => {
                                let model = models[subPhase];
                                this.fields.push({
                                    'type': 'subStructureSubPhase',
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

                            let resp = {};

                            this.$children.map(function (child) {
                                total_material_co2e = 0;
                                total_transport_co2e = 0;
                                let models = child.$children.map(function (child) {
                                    total_material_co2e = total_material_co2e + child.model.total_material_co2e;
                                    total_transport_co2e = total_transport_co2e + child.model.total_transport_co2e;
                                    return child.model;
                                });

                                const updatedModels = models.filter(item => item.is_updated && !item.is_new);
                                const newModels = models.filter(item => item.is_new);

                                resp[child.field.sub_phase] = {
                                    "sub_phase": child.field.sub_phase,
                                    "total_machinery_co2e": total_machinery_co2e,
                                    "total_material_co2e": total_material_co2e,
                                    "total_transport_co2e": total_transport_co2e,
                                    "new_entries": newModels || {},
                                    "updated_entries": updatedModels || {},
                                };
                            });
                            return resp;
                        }
                    }
                })
            }

            $("#btnSave").on("click", function () {
                let isValid = true;
                if (!validateEntries(subStructure, "sub-structure", "foundation")) {
                    isValid = false;
                }

                if (isValid) {
                    saveSubStructure(true);
                } else {
                    errorToast('Fill All Required Fields!');
                }
            });
        }

        async function saveSubStructure(regenerateEntries) {
            let subStructure_data = subStructure.getModals();

            await axios.post("/api/sub-structure-entries/" + project_id, {"data": subStructure_data})
                .then(response => {
                    logToConsole("saveSubStructure resp", response, LOG_TYPES.HTTP_REQUEST);

                    if (regenerateEntries) {
                        subStructure.fields = [];
                        subStructure.generateModels(response.data)
                        successToast('Project Saved!');
                    }

                }).then(() => {
                    axios.get("/api/results/" + project_id + "/sub-structure/type/chart")
                        .then(response => {
                            logToConsole("chart result resp", response, LOG_TYPES.HTTP_REQUEST);
                            updateSubPhaseChartDataSet(subStructureChart, response.data.chart, "subStructure");
                        }).catch(error => {
                        errorToast('Result Generation Failed!');
                        logToConsole("chart result resp error", error, LOG_TYPES.ERROR);
                    });
                    refreshSubPhaseTableData("subStructureResultTable", "sub-structure");
                }).catch(error => {
                    errorToast('Failed To Save!');
                    logToConsole("saveSubStructure error", error, LOG_TYPES.ERROR);
                });
        }

        async function navigate(location) {
            let isValid = true;
            if (!validateEntries(subStructure, "sub-structure", "foundation")) {
                isValid = false;
            }

            if (isValid) {
                await saveSubStructure(false);
                window.location.href = location;
            } else {
                errorToast('Fill All Required Fields!');
            }
        }
    </script>
@stop
