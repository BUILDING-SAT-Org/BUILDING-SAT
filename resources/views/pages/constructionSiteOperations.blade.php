@section('title', 'Construction Site Operations')
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

        .bsat-constructionOperation-entry {
            width: 635px;
        }

        .bsat-constructionOperation-entry-lg {
            width: 2140px;
        }

        .bsat-construction-operation-waste-entry {
            width: 1270px;
        }

        .bsat-construction-operation-waste-entry-lg {
            width: 1560px;
        }

        .bsat-construction-operation-waste-entry-xl {
            width: 2700px;
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

        .file {
            height: 34px !important;
        }

        #accordionConstructionOperationResultsTable {
            width: 1380px;
        }

        #constructionOperationResultTable tr > th:not(:first-child), td:not(:first-child) {
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



    {{-- add class row below if rquired to increase the width--}}
    <div>
        <div class="col-md-6 bsat-main-phase-description">
            <h2>Construction Site Operations</h2>
            Use this section to enter all materials related to construction operations carried out within the site, that
            was not accounted for before. This includes the electricity, fuel, water usage, waste generated etc.
        </div>

        <div class="col-md-12">
            <div id="constructionOperation">
                <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                </div>
            </div>

            <!--  Results Accordion  -->
            <div class="accordion bsat-accordion" id="accordionConstructionOperationResults">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseConstructionOperationResults" aria-expanded="false"
                                aria-controls="collapseConstructionOperationResults">
                            <div class="bsat-sub-phase-label">Results</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseConstructionOperationResults" class="accordion-collapse collapse"
                     aria-labelledby="accordionConstructionOperationResults"
                     data-bs-parent="#accordionConstructionOperationResults">
                    <div class="accordion-body" style="padding: 0rem 1.25rem;">
                        <div class="col-md-12">
                            <p class="bsat-result-description">
                                The global warming potential (kg CO2 – eq) related to Construction site operations
                                activities such as Electricity used on site, Fuel use on site, Water consumption on site
                                and waste generated on site are displayed with respect to machinery, material,
                                transport, energy and water related impacts. The user can use this information to
                                further analyze the hotspots of different construction activities and operations.
                            </p>
                        </div>
                        <!-- Result Table Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionConstructionOperationResultsTable">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseConstructionOperationResultsTable"
                                            aria-expanded="false"
                                            aria-controls="collapseConstructionOperationResultsTable">
                                        <div class="bsat-sub-phase-label">Table View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseConstructionOperationResultsTable" class="accordion-collapse collapse"
                                 aria-labelledby="accordionConstructionOperationResultsTable"
                                 data-bs-parent="#accordionConstructionOperationResultsTable">
                                <div class="accordion-body">
                                    <div class="justify-content-center">
                                        <h3 class="text-center">Global Warming Potential of Construction Site
                                            Operations</h3>
                                        <table id="constructionOperationResultTable" data-unique-id="id" class="table">
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
                        <div class="accordion bsat-accordion" id="accordionConstructionOperationResultsChart">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseConstructionOperationResultsChart"
                                            aria-expanded="false"
                                            aria-controls="collapseConstructionOperationResultsChart">
                                        <div class="bsat-sub-phase-label">Chart View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseConstructionOperationResultsChart" class="accordion-collapse collapse"
                                 aria-labelledby="accordionConstructionOperationResultsChart"
                                 data-bs-parent="#accordionConstructionOperationResultsChart">
                                <div class="accordion-body">
                                    <div>
                                        <canvas id="constructionOperationResultChart"></canvas>
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

    <!-- Construction Operation Template -->
    <template id="constructionOperationsSubPhase">

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
    <!-- End Construction Operation Template  -->

    <!-- Construction Operation Entry Template -->
    <template id="bsatConstructionOperationEntry">
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
    <!-- End Construction Operation Entry Template  -->

    <!-- Construction Operation Waste Entry Template -->
    <template id="bsatConstructionOperationWasteEntry">
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
    <!-- End Construction Operation Waste Entry Template  -->

    <script>
        let user_id = {{ Auth::user()->id }};
        let project_id = {{ $project_id }};
        const PROJECT_SERVICE_LIFE = {{ $project_life }};
        let resources;
        let constructionOperationChart;
        let constructionOperationEntries;
        let constructionOperation;

        (function () {
            const promise1 = axios.get("/api/resources/" + project_id + "/construction-site-operations");
            const promise2 = axios.get("/api/construction-site-operation-entries/" + project_id);

            Promise.all([promise1, promise2]).then(function (values) {
                resources = values[0].data;
                constructionOperationEntries = values[1].data;
                logToConsole("resp", {
                    resources: resources,
                    constructionOperationEntries: constructionOperationEntries
                }, LOG_TYPES.HTTP_REQUEST);
                init();
                loadingOverlay.classList.add('hide-loader');
            });
        })();

        async function init() {
            initConstructionOperations();
            constructionOperationChart = await generateMainPhaseResult("construction-site-operations", "constructionOperationResultTable",
                "constructionOperationResultChart", CHART_TITLES.constructionPhase, "constructionSiteOperations");
        }

        function initConstructionOperations() {

            Vue.component('bsatConstructionOperationEntry', {
                template: '#bsatConstructionOperationEntry',
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
                        vgfRef: "bsatConstructionOperationEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatConstructionOperationEntry.material,
                                model: "material_id",
                                help: BSAT_TOOLTIPS.bsatConstructionOperationEntry.material,
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
                                label: BSAT_LABELS.bsatConstructionOperationEntry.totalCo2e,
                                model: "total_co2e",
                                help: BSAT_TOOLTIPS.bsatConstructionOperationEntry.totalCo2e,
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
                        if (this.$refs.bsatConstructionOperationEntry.validate()) {

                            let material_gwp = this.model.data.material_data.gwp === undefined ? 0 :
                                this.model.data.material_data.gwp;

                            this.model.total_co2e = truncateFloat(this.model.quantity * material_gwp, 8);

                            this.model.total_co2e_label = parseExponential(this.model.total_co2e);

                            logToConsole("calculate: construction operation entry", {
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

            Vue.component('bsatConstructionOperationWasteEntry', {
                template: '#bsatConstructionOperationWasteEntry',
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
                        quantity: null,
                        total_bulking_quantity: null,
                        location_id: null,
                        other_location: null,
                        other_location_distance: null,
                        total_distance: null,
                        waste_transport_vehicle_id: null,
                        transport_co2e: null,
                        material_co2e: null,
                        total_co2e: null,
                        total_co2e_label: null,
                        data: {
                            material_data: 1,
                            transport_data: 1,
                        }
                    };
                    return {
                        vgfRef: "bsatConstructionOperationWasteEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatConstructionOperationWasteEntry.material,
                                model: "material_id",
                                help: BSAT_TOOLTIPS.bsatConstructionOperationWasteEntry.material,
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
                                    type: "waste",
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
                                label: BSAT_LABELS.bsatConstructionOperationWasteEntry.quantity,
                                model: "quantity",
                                help: BSAT_TOOLTIPS.bsatConstructionOperationWasteEntry.quantity,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                min: 0,
                                validator: ["number", "double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatConstructionOperationWasteEntry.location,
                                model: "location_id",
                                styleClasses: 'bsat-tree-select',
                                help: BSAT_TOOLTIPS.bsatConstructionOperationWasteEntry.location,
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
                                options: field.distances,
                                onChanged: function (model, newVal, oldVal, field) {
                                    setTimeout(() => {
                                        this.$parent.$parent.$parent.$emit("calculate", this);
                                    }, 100);
                                }
                            }, {
                                type: "input",
                                inputType: "text",
                                label: BSAT_LABELS.bsatConstructionOperationWasteEntry.otherLocation,
                                model: "other_location",
                                help: BSAT_TOOLTIPS.bsatConstructionOperationWasteEntry.otherLocation,
                                styleClasses: 'vgf-input-fixed',
                                required: true,
                                validator: ["validateText", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    if (undefined != this.$options.parent.$el) {
                                        if (model && model.location_id === -1) {
                                            this.$options.parent.$el.classList = ["bsat-entry " +
                                            "bsat-construction-operation-waste-entry-lg"];
                                        } else {
                                            this.$options.parent.$el.classList = ["bsat-entry"];
                                        }
                                    }
                                    return model && model.location_id === -1;
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatConstructionOperationWasteEntry.otherLocationDistance,
                                model: "other_location_distance",
                                min: 1,
                                help: BSAT_TOOLTIPS.bsatConstructionOperationWasteEntry.otherLocationDistance,
                                styleClasses: 'vgf-input-fixed bsat-label-margin-top',
                                required: true,
                                validator: ["double", "required"],
                                onChanged: function (model, newVal, oldVal, field) {
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                },
                                visible: function (model) {
                                    return model && model.location_id === -1;
                                }
                            }, {
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatConstructionOperationWasteEntry.wasteTransportVehicle,
                                model: "waste_transport_vehicle_id",
                                help: BSAT_TOOLTIPS.bsatConstructionOperationWasteEntry.wasteTransportVehicle,
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
                                options: field.vehicles,
                                onChanged: function (model, newVal, oldVal, field) {
                                    if (newVal !== undefined) {
                                        model.data.transport_data = field.options.filter(i => i.id === newVal)[0]

                                        if (model.data.transport_data === undefined) {
                                            model.data.transport_data = field.options.filter(i => i.id === "UV00")[0]
                                                .children.filter(i => i.id === newVal)[0];
                                        }

                                        logToConsole("local vehicle onChanged", {
                                            transport_data: model.data.transport_data,
                                        }, LOG_TYPES.EVENT);
                                    }
                                    this.$parent.$parent.$parent.$emit("calculate", this);
                                }
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatConstructionOperationWasteEntry.totalDistance,
                                model: "total_distance",
                                help: BSAT_TOOLTIPS.bsatConstructionOperationWasteEntry.totalDistance,
                                styleClasses: 'vgf-input-fixed',
                                readonly: true,
                                validator: ["double", "required"],
                                onChanged: function (model, newVal, oldVal) {
                                },
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.bsatConstructionOperationWasteEntry.totalCo2e,
                                model: "total_co2e",
                                help: BSAT_TOOLTIPS.bsatConstructionOperationWasteEntry.totalCo2e,
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
                        logToConsole("info iconOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    labelOnClick(node, type) {
                        logToConsole("labelOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    itemInfo(node) {
                    },
                    calculate() {
                        if (this.$refs.bsatConstructionOperationWasteEntry.validate()) {

                            let bulking_density = this.model.data.material_data.bulking_density === undefined ?
                                0 : this.model.data.material_data.bulking_density;

                            let bulking_factor = this.model.data.material_data.bulking_factor === undefined ? 0 :
                                this.model.data.material_data.bulking_factor;

                            let material_gwp = this.model.data.material_data.gwp === undefined ? 0 :
                                this.model.data.material_data.gwp;

                            let transport_gwp = this.model.data.transport_data.gwp === undefined ? 0 :
                                this.model.data.transport_data.gwp;

                            let loading_capacity = this.model.data.transport_data.loading_capacity === undefined ? 0 :
                                this.model.data.transport_data.loading_capacity;

                            this.model.total_bulking_quantity = this.model.quantity * bulking_factor * bulking_density;

                            this.model.material_co2e = truncateFloat(this.model.quantity * material_gwp, 8);

                            let distance_to_destination = 0;
                            if (this.model.location_id === -1) {
                                distance_to_destination = this.model.other_location_distance;
                            } else {
                                if (this.model.location_id !== undefined) {
                                    distance_to_destination = resources.destinations.filter(i => i.id ===
                                        this.model.location_id)[0].distance;
                                }
                                this.model.other_location = "";
                                this.model.other_location_distance = 0;
                            }
                            let no_trips = this.model.total_bulking_quantity / loading_capacity;

                            if (no_trips < 1) {
                                no_trips = 1;
                            }

                            let total_distance = distance_to_destination * no_trips;

                            this.model.total_distance = truncateFloat(total_distance, 3);

                            this.model.transport_co2e = truncateFloat(this.model.total_bulking_quantity *
                                total_distance *
                                transport_gwp, 8);

                            this.model.transport_co2e_label = parseExponential(this.model.transport_co2e);

                            this.model.total_co2e = truncateFloat(this.model
                                .transport_co2e + this.model.material_co2e,
                                8);


                            logToConsole("calculate: constructionOperation mortar", {
                                subPhase: this.field.sub_phase,
                                bulking_factor: bulking_factor,
                                bulking_density: bulking_density,
                                material_gwp: material_gwp,
                                transport_gwp: transport_gwp,
                                loading_capacity: loading_capacity,
                                material_co2e: this.model.material_co2e,
                                quantity: this.model.quantity,
                                total_bulking_quantity: this.model.total_bulking_quantity,
                                location_id: this.model.location_id,
                                distance_to_destination: distance_to_destination,
                                other_location_distance: this.model.other_location_distance,
                                no_trips: no_trips,
                                total_distance: this.model.total_distance,
                                transport_co2e: this.model.transport_co2e,
                                total_co2e: this.model.total_co2e,
                                formulas: {
                                    total_bulking_quantity: "quantity * bulking_factor * bulking_density",
                                    material_co2e: "quantity * material_gwp",
                                    transport_co2e: "total_bulking_quantity * total_distance * transport_gwp",
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

            Vue.component('constructionOperationsSubPhase', {
                template: '#constructionOperationsSubPhase',
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
                        if (subPhase === "waste_generated") {
                            this.cssClasses = "accordion-collapse bsat-construction-operation-waste-entry show";
                            this.fields.push({
                                'type': "bsatConstructionOperationWasteEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'distances': resources.distances,
                                'materials': resources.waste_types,
                                'vehicles': resources.vehicles,
                                'electricity_types': resources.electricity_types,
                                'is_new': 1
                            });
                        } else if (subPhase === "water_consumption_on_site") {
                            this.cssClasses = "accordion-collapse bsat-constructionOperation-entry show";
                            this.fields.push({
                                'type': "bsatConstructionOperationEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.water_types,
                                'quantity_label': BSAT_LABELS.bsatConstructionOperationEntry.quantityWater,
                                'quantity_tooltip': BSAT_TOOLTIPS.bsatConstructionOperationEntry.quantityWater,
                                'is_new': 1
                            });
                        } else if (subPhase === "fuel_use_on_site") {
                            this.cssClasses = "accordion-collapse bsat-constructionOperation-entry show";
                            this.fields.push({
                                'type': "bsatConstructionOperationEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.fuel_types,
                                'quantity_label': BSAT_LABELS.bsatConstructionOperationEntry.quantityFuel,
                                'quantity_tooltip': BSAT_TOOLTIPS.bsatConstructionOperationEntry.quantityFuel,
                                'is_new': 1
                            });
                        } else {
                            this.cssClasses = "accordion-collapse bsat-constructionOperation-entry show";
                            this.fields.push({
                                'type': "bsatConstructionOperationEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.electricity_types,
                                'quantity_label': BSAT_LABELS.bsatConstructionOperationEntry.quantityElectricity,
                                'quantity_tooltip': BSAT_TOOLTIPS.bsatConstructionOperationEntry.quantityElectricity,
                                'is_new': 1
                            });
                        }
                    },
                    generateModels: function (models, subPhase) {

                        if (subPhase === "waste_generated") {
                            this.cssClasses = "accordion-collapse bsat-construction-operation-waste-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatConstructionOperationWasteEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'distances': resources.distances,
                                    'materials': resources.waste_types,
                                    'vehicles': resources.vehicles,
                                    'is_new': 0,
                                    'entry_id': model.id
                                });
                            });
                        } else if (subPhase === "water_consumption_on_site") {
                            this.cssClasses = "accordion-collapse bsat-constructionOperation-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatConstructionOperationEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'materials': resources.water_types,
                                    'quantity_label': BSAT_LABELS.bsatConstructionOperationEntry.quantityWater,
                                    'quantity_tooltip': BSAT_TOOLTIPS.bsatConstructionOperationEntry.quantityWater,
                                    'is_new': 0,
                                    'entry_id': model.id
                                });
                            });
                        } else if (subPhase === "fuel_use_on_site") {
                            this.cssClasses = "accordion-collapse bsat-constructionOperation-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatConstructionOperationEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'materials': resources.fuel_types,
                                    'quantity_label': BSAT_LABELS.bsatConstructionOperationEntry.quantityFuel,
                                    'quantity_tooltip': BSAT_TOOLTIPS.bsatConstructionOperationEntry.quantityFuel,
                                    'is_new': 0,
                                    'entry_id': model.id
                                });
                            });
                        } else if (subPhase === "electricity_use_on_site") {
                            this.cssClasses = "accordion-collapse bsat-constructionOperation-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatConstructionOperationEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'materials': resources.electricity_types,
                                    'quantity_label': BSAT_LABELS.bsatConstructionOperationEntry.quantityElectricity,
                                    'quantity_tooltip': BSAT_TOOLTIPS.bsatConstructionOperationEntry.quantityElectricity,
                                    'is_new': 0,
                                    'entry_id': model.id
                                });
                            });
                        }
                    },
                    removeEntry: async function (id, is_new, entry_id, sub_phase, addEntryBtnId) {
                        const index = this.fields.findIndex(f => f.id === id);
                        this.fields.splice(index, 1);

                        if (!is_new) {
                            axios.delete('/api/construction-site-operation-entries/' + project_id + '/' + urlEncodeSlug(sub_phase) + '/' +
                                entry_id)
                                .then(async (response) => {
                                    logToConsole("removeEntry resp", response, LOG_TYPES.HTTP_REQUEST);
                                    await saveConstructionSiteOperations(false);
                                })
                                .catch(error => {
                                    logToConsole("removeEntry error", error, LOG_TYPES.ERROR);
                                });
                        }
                        let isValid = true;

                        await sleep(50);
                        for (let child of this.$children) {
                            if ((undefined != child.$refs.bsatConstructionOperationEntry && !child.$refs.bsatConstructionOperationEntry
                                .validate()) || (undefined != child.$refs.bsatConstructionOperationWasteEntry &&
                                !child.$refs.bsatConstructionOperationWasteEntry.validate())) {
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

            constructionOperation = generateComponent('#constructionOperation', constructionOperationEntries);

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

                            let subPhaseList = ["electricity_use_on_site", "fuel_use_on_site", "water_consumption_on_site",
                                "waste_generated"];

                            subPhaseList.forEach((subPhase) => {
                                let model = models[subPhase];
                                this.fields.push({
                                    'type': 'constructionOperationsSubPhase',
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
                            let total_water_co2e = 0;

                            let resp = {};

                            this.$children.map(function (child) {
                                total_material_co2e = 0;
                                total_transport_co2e = 0;
                                total_energy_co2e = 0;
                                total_water_co2e = 0;

                                let models;
                                if (child.field.sub_phase === "waste_generated") {
                                    models = child.$children.map(function (child) {
                                        total_material_co2e = total_material_co2e + child.model.material_co2e;
                                        total_transport_co2e = total_transport_co2e + child.model.transport_co2e;
                                        return child.model;
                                    });
                                } else if (child.field.sub_phase === "water_consumption_on_site") {
                                    models = child.$children.map(function (child) {
                                        total_water_co2e = total_water_co2e + child.model.total_co2e;
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
                                    "total_water_co2e": total_water_co2e,
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
                if (!validateEntries(constructionOperation, "construction-site-operations", "waste_generated")
                    && !validateEntries(constructionOperation, "construction-site-operations", "")) {
                    isValid = false;
                }

                if (isValid) {
                    saveConstructionSiteOperations(true);
                } else {
                    errorToast('Fill All Required Fields!');
                }
            });

        }

        async function saveConstructionSiteOperations(regenerateEntries) {
            let constructionOperation_data = constructionOperation.getModals();

            await axios.post("/api/construction-site-operation-entries/" + project_id, {"data": constructionOperation_data})
                .then(response => {
                    logToConsole("save construction site operations resp", response, LOG_TYPES.HTTP_REQUEST);

                    if (regenerateEntries) {
                        constructionOperation.fields = [];
                        constructionOperation.generateModels(response.data)
                        successToast('Project Saved!');
                    }

                }).then(() => {

                    axios.get("/api/results/" + project_id + "/construction-site-operations/type/chart")
                        .then(response => {
                            logToConsole("chart result resp", response, LOG_TYPES.HTTP_REQUEST);
                            updateSubPhaseChartDataSet(constructionOperationChart, response.data.chart, "constructionSiteOperations");
                        }).catch(error => {
                        errorToast('Result Generation Failed!');
                        logToConsole("chart result resp error", error, LOG_TYPES.ERROR);
                    });

                    refreshSubPhaseTableData("constructionOperationResultTable", "construction-site-operations");
                }).catch(error => {
                    errorToast('Failed To Save!');
                    logToConsole("save construction site operations error", error, LOG_TYPES.ERROR);
                });
        }

        async function navigate(location) {

            let isValid = true;
            if (!validateEntries(constructionOperation, "construction-site-operations", "foundation")) {
                isValid = false;
            }

            if (isValid) {
                await saveConstructionSiteOperations(false);
                window.location.href = location;
            } else {
                errorToast('Fill All Required Fields!');
            }

        }
    </script>
@stop
