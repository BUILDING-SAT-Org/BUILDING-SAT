@section('title', 'Energy Consumption')
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

        .bsat-tree-select-md .vue-treeselect__menu {
            max-height: 500px !important;
            width: 300px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-md .vue-treeselect__list {
            width: 400px;
        }

        .bsat-tree-select-lg .vue-treeselect__menu {
            max-height: 500px !important;
            width: 400px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-lg .vue-treeselect__list {
            width: 600px;
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

        .bsat-energyConsumption-entry {
            width: 635px;
        }

        .bsat-energyConsumption-entry-lg {
            width: 2140px;
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

        .file {
            height: 34px !important;
        }

        #accordionEnergyConsumptionResultsTable {
            width: 1350px;
        }

        #energyConsumptionResultTable tr > th:not(:first-child), td:not(:first-child) {
            text-align: right;
        }
    </style>
    <div class="bsat-phase-description">
        <div class="row">
            <div class="col-md-6">
                <h1>Operation Phase</h1>
                Use this section to enter all materials, energy, water etc. related to the operational phase of the
                building only. Ensure that the entries made in the construction phase are not repeated here.
            </div>
        </div>
    </div>


    <div>
        <div class="col-md-6 bsat-main-phase-description">
            <h2>Energy Consumption</h2>
            This section is dedicated to entering all entries related to energy consumption during the operation or use
            stage of the building (consider full building life expectancy).
        </div>

        <div class="col-md-12">
            <div id="energyConsumption">
                <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                </div>
            </div>

            <!--  Results Accordion  -->
            <div class="accordion bsat-accordion" id="accordionEnergyConsumptionResults">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseEnergyConsumptionResults" aria-expanded="false"
                                aria-controls="collapseEnergyConsumptionResults">
                            <div class="bsat-sub-phase-label">Results</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseEnergyConsumptionResults" class="accordion-collapse collapse"
                     aria-labelledby="accordionEnergyConsumptionResults"
                     data-bs-parent="#accordionEnergyConsumptionResults">
                    <div class="accordion-body" style="padding: 0rem 1.25rem;">
                        <div class="col-md-12">
                            <p class="bsat-result-description">
                                The global warming potential (kg CO2 – eq) related to Energy consumption during
                                Operation phase such as Electricity used, fuel used and exported energy from the site
                                are displayed with respect to machinery, material, transport, energy and water related
                                impacts. The user can use this information to further analyze the hotspots of different
                                construction activities and operations.
                            </p>
                        </div>
                        <!-- Result Table Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionEnergyConsumptionResultsTable">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseEnergyConsumptionResultsTable"
                                            aria-expanded="false"
                                            aria-controls="collapseEnergyConsumptionResultsTable">
                                        <div class="bsat-sub-phase-label">Table View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseEnergyConsumptionResultsTable" class="accordion-collapse collapse"
                                 aria-labelledby="accordionEnergyConsumptionResultsTable"
                                 data-bs-parent="#accordionEnergyConsumptionResultsTable">
                                <div class="accordion-body">
                                    <div class="justify-content-center">
                                        <h3 class="text-center">Global Warming Potential of Energy Consumption
                                            Activities</h3>
                                        <table id="energyConsumptionResultTable" data-unique-id="id" class="table">
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
                        <div class="accordion bsat-accordion" id="accordionEnergyConsumptionResultsChart">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseEnergyConsumptionResultsChart"
                                            aria-expanded="false"
                                            aria-controls="collapseEnergyConsumptionResultsChart">
                                        <div class="bsat-sub-phase-label">Chart View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseEnergyConsumptionResultsChart" class="accordion-collapse collapse"
                                 aria-labelledby="accordionEnergyConsumptionResultsChart"
                                 data-bs-parent="#accordionEnergyConsumptionResultsChart">
                                <div class="accordion-body">
                                    <div>
                                        <canvas id="energyConsumptionResultChart"></canvas>
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

    <!-- Energy Consumption Template -->
    <template id="energyConsumptionSubPhase">

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
    <!-- End Energy Consumption Template  -->

    <!-- Energy Consumption Entry Template -->
    <template id="bsatEnergyConsumptionEntry">
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
    <!-- End Energy Consumption Entry Template  -->

    <script>
        let user_id = {{ Auth::user()->id }};
        let project_id = {{ $project_id }};
        const PROJECT_SERVICE_LIFE = {{ $project_life }};
        let resources;
        let energyConsumptionChart;
        let energyConsumptionEntries;
        let energyConsumption;

        (function () {
            const promise1 = axios.get("/api/resources/" + project_id + "/energy-consumption");
            const promise2 = axios.get("/api/energy-consumption-entries/" + project_id);

            Promise.all([promise1, promise2]).then(function (values) {
                resources = values[0].data;
                energyConsumptionEntries = values[1].data;
                logToConsole("resp", {
                    resources: resources,
                    energyConsumptionEntries: energyConsumptionEntries
                }, LOG_TYPES.HTTP_REQUEST);
                init();
                loadingOverlay.classList.add('hide-loader');
            });
        })();

        async function init() {
            initEnergyConsumption();
            energyConsumptionChart = await generateMainPhaseResult("energy-consumption", "energyConsumptionResultTable",
                "energyConsumptionResultChart", CHART_TITLES.energyConsumptionPhase, "energyConsumption");
        }

        function initEnergyConsumption() {

            Vue.component('bsatEnergyConsumptionEntry', {
                template: '#bsatEnergyConsumptionEntry',
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
                        vgfRef: "bsatEnergyConsumptionEntry",
                        model: field.is_new ? new_model : field.model,
                        schema: {
                            fields: [{
                                type: "treeSelect",
                                label: BSAT_LABELS.bsatEnergyConsumptionEntry.material,
                                model: "material_id",
                                help: BSAT_TOOLTIPS.bsatEnergyConsumptionEntry.material,
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
                                label: BSAT_LABELS.bsatEnergyConsumptionEntry.totalCo2e,
                                model: "total_co2e",
                                help: BSAT_TOOLTIPS.bsatEnergyConsumptionEntry.totalCo2e,
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
                        if (this.$refs.bsatEnergyConsumptionEntry.validate()) {

                            let material_gwp = this.model.data.material_data.gwp === undefined ? 0 :
                                this.model.data.material_data.gwp;

                            this.model.total_co2e = truncateFloat(this.model.quantity * material_gwp, 8);

                            if (this.field.sub_phase === "exported_energy_during_operation") {
                                this.model.total_co2e = -1 * this.model.total_co2e;
                            }

                            this.model.total_co2e_label = parseExponential(this.model.total_co2e);

                            logToConsole("calculate: energy consumption entry", {
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

            Vue.component('energyConsumptionSubPhase', {
                template: '#energyConsumptionSubPhase',
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
                        if (subPhase === "exported_energy_during_operation") {
                            this.cssClasses = "accordion-collapse bsat-energyConsumption-entry show";
                            this.fields.push({
                                'type': "bsatEnergyConsumptionEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.energy_types,
                                'quantity_label': BSAT_LABELS.bsatEnergyConsumptionEntry.quantityEnergy,
                                'quantity_tooltip': BSAT_TOOLTIPS.bsatEnergyConsumptionEntry.quantityEnergy,
                                'is_new': 1
                            });
                        } else if (subPhase === "fuel_used_during_operation") {
                            this.cssClasses = "accordion-collapse bsat-energyConsumption-entry show";
                            this.fields.push({
                                'type': "bsatEnergyConsumptionEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.fuel_types,
                                'quantity_label': BSAT_LABELS.bsatEnergyConsumptionEntry.quantityFuel,
                                'quantity_tooltip': BSAT_TOOLTIPS.bsatEnergyConsumptionEntry.quantityFuel,
                                'is_new': 1
                            });
                        } else {
                            this.cssClasses = "accordion-collapse bsat-energyConsumption-entry show";
                            this.fields.push({
                                'type': "bsatEnergyConsumptionEntry",
                                'id': this.count++,
                                'sub_phase': subPhase,
                                'materials': resources.electricity_types,
                                'quantity_label': BSAT_LABELS.bsatEnergyConsumptionEntry.quantityElectricity,
                                'quantity_tooltip': BSAT_TOOLTIPS.bsatEnergyConsumptionEntry.quantityElectricity,
                                'is_new': 1
                            });
                        }
                    },
                    generateModels: function (models, subPhase) {

                        if (subPhase === "exported_energy_during_operation") {
                            this.cssClasses = "accordion-collapse bsat-energyConsumption-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatEnergyConsumptionEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'materials': resources.energy_types,
                                    'quantity_label': BSAT_LABELS.bsatEnergyConsumptionEntry.quantityEnergy,
                                    'quantity_tooltip': BSAT_TOOLTIPS.bsatEnergyConsumptionEntry.quantityEnergy,
                                    'is_new': 0,
                                    'entry_id': model.id
                                });
                            });
                        } else if (subPhase === "fuel_used_during_operation") {
                            this.cssClasses = "accordion-collapse bsat-energyConsumption-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatEnergyConsumptionEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'materials': resources.fuel_types,
                                    'quantity_label': BSAT_LABELS.bsatEnergyConsumptionEntry.quantityFuel,
                                    'quantity_tooltip': BSAT_TOOLTIPS.bsatEnergyConsumptionEntry.quantityFuel,
                                    'is_new': 0,
                                    'entry_id': model.id
                                });
                            });
                        } else {
                            this.cssClasses = "accordion-collapse bsat-energyConsumption-entry";
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': "bsatEnergyConsumptionEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'materials': resources.electricity_types,
                                    'quantity_label': BSAT_LABELS.bsatEnergyConsumptionEntry.quantityElectricity,
                                    'quantity_tooltip': BSAT_TOOLTIPS.bsatEnergyConsumptionEntry.quantityElectricity,
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
                            axios.delete('/api/energy-consumption-entries/' + project_id + '/' + urlEncodeSlug(sub_phase) + '/' +
                                entry_id)
                                .then(async (response) => {
                                    logToConsole("removeEntry resp", response, LOG_TYPES.HTTP_REQUEST);
                                    await saveEnergyConsumption(false);
                                })
                                .catch(error => {
                                    logToConsole("removeEntry error", error, LOG_TYPES.ERROR);
                                });
                        }
                        let isValid = true;

                        await sleep(50);
                        for (let child of this.$children) {
                            if (undefined != child.$refs.bsatEnergyConsumptionEntry && !child.$refs.bsatEnergyConsumptionEntry
                                .validate()) {
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

            energyConsumption = generateComponent('#energyConsumption', energyConsumptionEntries);

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

                            let subPhaseList = ["electricity_used_during_operation", "fuel_used_during_operation", "exported_energy_during_operation"];

                            subPhaseList.forEach((subPhase) => {
                                let model = models[subPhase];
                                this.fields.push({
                                    'type': 'energyConsumptionSubPhase',
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
                                total_energy_co2e = 0;
                                let models;

                                models = child.$children.map(function (child) {
                                    total_energy_co2e = total_energy_co2e + child.model.total_co2e;
                                    return child.model;
                                });

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
                if (!validateEntries(energyConsumption, "energy-consumption", "foundation")) {
                    isValid = false;
                }

                if (isValid) {
                    saveEnergyConsumption(true);
                } else {
                    errorToast('Fill All Required Fields!');
                }
            });

        }

        async function saveEnergyConsumption(regenerateEntries) {
            let energyConsumption_data = energyConsumption.getModals();

            await axios.post("/api/energy-consumption-entries/" + project_id, {"data": energyConsumption_data})
                .then(response => {
                    logToConsole("save energy consumption resp", response, LOG_TYPES.HTTP_REQUEST);

                    if (regenerateEntries) {
                        energyConsumption.fields = [];
                        energyConsumption.generateModels(response.data)
                        successToast('Project Saved!');
                    }

                }).then(() => {

                    axios.get("/api/results/" + project_id + "/energy-consumption/type/chart")
                        .then(response => {
                            logToConsole("chart result resp", response, LOG_TYPES.HTTP_REQUEST);
                            updateSubPhaseChartDataSet(energyConsumptionChart, response.data.chart, "energyConsumption");
                        }).catch(error => {
                        errorToast('Result Generation Failed!');
                        logToConsole("chart result resp error", error, LOG_TYPES.ERROR);
                    });

                    refreshSubPhaseTableData("energyConsumptionResultTable", "energy-consumption");
                }).catch(error => {
                    errorToast('Failed To Save!');
                    logToConsole("save energy consumption error", error, LOG_TYPES.ERROR);
                });
        }

        async function navigate(location) {
            let isValid = true;
            if (!validateEntries(energyConsumption, "energy-consumption", "foundation")) {
                isValid = false;
            }

            if (isValid) {
                await saveEnergyConsumption(false);
                window.location.href = location;
            } else {
                errorToast('Fill All Required Fields!');
            }
        }
    </script>
@stop
