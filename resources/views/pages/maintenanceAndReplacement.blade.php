@section('title', 'Maintenance And Replacement')
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
            margin-right: 15px !important;
        }

        .vgf-input-fixed-lg {
            width: 250px !important;
            margin-right: 15px !important;
        }

        .vgf-input-fixed-md {
            width: 200px !important;
            margin-right: 15px !important;
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
            width: 600px;
        }

        .bsat-tree-select-lg .vue-treeselect__menu {
            max-height: 500px !important;
            width: 900px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-lg .vue-treeselect__list {
            width: 1800px;
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
            width: 210px;
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

        .bsat-maintenance-replacement-entry {
            width: 2010px;
        }

        .radio-list > label {
            margin: 10px;
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

        .file {
            height: 34px !important;
        }

        #accordionMaintenanceResultsTable {
            width: 1400px;
        }

        #maintenanceResultTable tr > th:not(:first-child), td:not(:first-child) {
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
            <h2>Maintenance and replacement</h2>
            This section accounts for the maintenance and replacement aspect of the building where building materials or
            components may be replaced according to their service life. Calculations are automatically performed based
            on the input provided by the user in the early stages. The user can edit the results, if necessary, as
            appropriate.
        </div>

        <div class="col-md-12">
            <!--  Maintenance App Accordion  -->
            <div id="subStructureApp">
                <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                </div>
            </div>

            <div id="superStructureApp">
                <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                </div>
            </div>

            <div id="internalExternalApp">
                <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                </div>
            </div>
            <!--  End Maintenance App Accordion  -->

            <!--  Results Accordion  -->
            <div class="accordion bsat-accordion" id="accordionMaintenanceReplacementResults">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseMaintenanceReplacementResults" aria-expanded="false"
                                aria-controls="collapseMaintenanceReplacementResults">
                            Results
                        </button>
                    </h2>
                </div>
                <div id="collapseMaintenanceReplacementResults" class="accordion-collapse collapse"
                     aria-labelledby="accordionMaintenanceReplacementResults"
                     data-bs-parent="#accordionMaintenanceReplacementResults">
                    <div class="accordion-body">
                        <div class="col-md-12">
                            <p class="bsat-result-description">
                                The global warming potential (kg CO2 – eq) related to Maintenance and replacement during
                                Operation phase are displayed with respect to machinery, material, transport, energy and
                                water related impacts. The user can use this information to further analyze the hotspots
                                of different construction activities and operations.
                            </p>
                        </div>
                        <!-- Result Table Accordion  -->
                        <div class="accordion bsat-accordion" id="accordionMaintenanceResultsTable">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseMaintenanceResultsTable"
                                            aria-expanded="false"
                                            aria-controls="collapseMaintenanceResultsTable">
                                        <div class="bsat-sub-phase-label">Table View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseMaintenanceResultsTable" class="accordion-collapse collapse"
                                 aria-labelledby="accordionMaintenanceResultsTable"
                                 data-bs-parent="#accordionMaintenanceResultsTable">
                                <div class="accordion-body">
                                    <div class="justify-content-center">
                                        <h3 class="text-center">Global Warming Potential of Maintenance and Replacement
                                            Activities</h3>
                                        <table id="maintenanceResultTable" data-unique-id="id" class="table">
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
                        <div class="accordion bsat-accordion" id="accordionMaintenanceResultsChart">
                            <div class="accordion-item bsat-accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseMaintenanceResultsChart"
                                            aria-expanded="false"
                                            aria-controls="collapseMaintenanceResultsChart">
                                        <div class="bsat-sub-phase-label">Chart View</div>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseMaintenanceResultsChart" class="accordion-collapse collapse"
                                 aria-labelledby="accordionMaintenanceResultsChart"
                                 data-bs-parent="#accordionMaintenanceResultsChart">
                                <div class="accordion-body">
                                    <div>
                                        <canvas id="maintenanceResultsChart"></canvas>
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

    <!-- MainPhase Template -->
    <template id="maintenanceMainPhase">
        <div class="accordion bsat-accordion" :id="field.accordionId">
            <div class="accordion-item bsat-accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            :data-bs-target="field.collapseTarget" aria-expanded="false"
                            :aria-controls="field.collapseId">
                        @{{ field.main_phase_label }}
                    </button>
                </h2>
            </div>
            <div :id="field.collapseId" class="accordion-collapse collapse bsat-maintenance-replacement-entry"
                 :aria-labelledby="field.accordionId"
                 :data-bs-parent="field.accordionParent">
                <div class="accordion-body">

                    <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                    </div>

                </div>
            </div>
        </div>
    </template>
    <!-- End MainPhase Template -->


    <!-- Maintenance SubPhase Entry Template -->
    <template id="maintenanceSubPhase">


        <!--  Generated SubPhase  -->
        <div class="accordion bsat-accordion" :id="field.accordionId">
            <div class="accordion-item bsat-accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            :data-bs-target="field.collapseTarget" aria-expanded="false"
                            :aria-controls="field.collapseId">
                        @{{ field.sub_phase_label }}
                    </button>
                </h2>
            </div>
            <div :id="field.collapseId" class="accordion-collapse collapse bsat-maintenance-replacement-entry"
                 :aria-labelledby="field.accordionId"
                 :data-bs-parent="field.accordionParent">
                <div class="accordion-body">
                    <div id="retainingWalls">

                        <div v-if="fields.length" class="vue-form-generator" style="margin-bottom: -15px;">
                            <div>
                                <div class="form-group valid vgf-input-fixed-lg field-label"
                                     style="margin-left: -10px;">
                                    <label for="material">
                                        <span>Material</span>
                                    </label>
                                    <div class="field-wrap">
                                        <span id="material"></span>
                                    </div>
                                </div>
                                <div class="form-group valid vgf-input-fixed-md field-label"
                                     style="margin-left: -5PX;">
                                    <label for="no-of-replacements">
                                        <span>No. of Replacements</span>
                                    </label>
                                    <div class="field-wrap">
                                        <span id="no-of-replacements"></span>
                                    </div>
                                </div>
                                <div class="form-group valid vgf-input-fixed field-label">
                                    <label for="kg-co--eq"><span>kg CO ₂ eq</span></label>
                                    <div class="field-wrap">
                                        <span id="kg-co--eq"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="fields.length == 0" class="vue-form-generator" style="margin-bottom: -15px;">
                            Replacement Material Not Found
                        </div>

                        <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Generated SubPhase -->


    </template>
    <!-- Maintenance SubPhase Entry Template  -->

    <!-- Maintenance And Replacement Entry Template -->
    <template id="bsatMaintenanceReplacementEntry">
        <div class="" :id="field.id" style="">
            <div>
                <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div"
                                    :ref="vgfRef"
                                    @model-updated="onModelUpdated" @validated="onValidated">
                </vue-form-generator>
            </div>
        </div>
    </template>
    <!-- Maintenance And Replacement Entry Template  -->

    <script>
        const user_id = {{ Auth::user()->id }};
        const project_id = {{ $project_id }};
        const BUILDING_SERVICE_LIFE = {{ $building_service_life }};
        let resources;
        let maintenanceReplacementChart;
        let maintenance_replacement;
        let sub_structure;
        let super_structure;
        let internal_and_external_finishes;

        (function () {
            const promise1 = axios.get("/api/resources/" + project_id + "/maintenance-and-replacement");
            const promise2 = axios.get("/api/maintenance-replacement/" + project_id);

            Promise.all([promise1, promise2]).then(function (values) {
                resources = values[0].data;
                maintenance_replacement = values[1].data;
                init();
                loadingOverlay.classList.add('hide-loader');
            });
        })();

        async function init() {
            initMaintenanceReplacement();
            maintenanceReplacementChart = await generateMainPhaseResult("maintenance-and-replacement", "maintenanceResultTable",
                "maintenanceResultsChart", CHART_TITLES.maintenanceReplacementPhase, "maintenanceAndReplacement");
        }

        function initMaintenanceReplacement() {

            Vue.component('bsatMaintenanceReplacementEntry', {
                template: '#bsatMaintenanceReplacementEntry',
                props: ['field'],
                components: {
                    "vue-form-generator": VueFormGenerator.component
                },

                data: function () {
                    let new_model = {
                        material_name: "",
                        no_replacements: 0,
                        maintenance_material_co2e: 0,
                    }
                    let field = this.field;
                    let model = field.model;

                    if (undefined != field.model) {
                        model = field.model;
                        let material = resources.material_list.filter(i => i.id == model.material_id)[0];
                        model.material_name = material.label;
                    } else {
                        model = new_model;
                    }
                    return {
                        vgfRef: "bsatMaintenanceReplacementEntry",
                        model: model,
                        schema: {
                            fields: [
                                {
                                    type: "customInput",
                                    inputType: "text",
                                    model: "material_name",
                                    inputName: "material_name",
                                    styleClasses: 'vgf-input-fixed-lg',
                                    fieldClasses: 'vgf-input-fixed-lg',
                                    readonly: true,
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    model: "no_replacements",
                                    styleClasses: 'vgf-input-fixed-md',
                                    min: 0,
                                    validator: ["number", "integer", "required"],
                                    onChanged: function (model, newVal, oldVal) {
                                        this.$parent.$parent.$parent.$emit("calculate", this);
                                    }
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    model: "maintenance_material_co2e",
                                    styleClasses: 'vgf-input-fixed',
                                    readonly: true,
                                }
                            ],
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
                    },
                    addFormElement: function () {
                        this.$parent.$emit('addEntry');
                    },
                    iconOnClick(node, type) {
                        logToConsole("info iconOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    labelOnClick(node, type) {
                        logToConsole("labelOnClick", {node: node, type: type}, LOG_TYPES.EVENT);
                    },
                    itemInfo(node) {
                        console.log(node);
                    },
                    calculate() {
                        if (this.$refs.bsatMaintenanceReplacementEntry.validate()) {
                            let maintenance_material_co2e = this.model.total_material_co2e * this.model.no_replacements;
                            this.model.maintenance_material_co2e = truncateFloat(maintenance_material_co2e, 8);
                        }
                    },
                    onValidated(isValid, errors) {
                    },
                    onValidate: function ($event) {
                    },
                },
            });

            Vue.component('maintenanceMainPhase', {
                template: '#maintenanceMainPhase',
                props: ['field'],
                data: function () {
                    return {
                        fields: [],
                        count: 0,
                    }
                },
                mounted() {
                    this.$on('addEntry', this.addEntry);
                    this.generateModels(this.field.model, this.field.model);

                },
                methods: {
                    addEntry: function () {
                    },
                    removeEntry: async function (id, is_new, entry_id) {
                    },
                    generateModels: function (models) {

                        for (const [key, value] of Object.entries(models)) {
                            this.fields.push({
                                'type': "maintenanceSubPhase",
                                'id': this.count++,
                                'model': value.entries,
                                'accordion': "accordion" + key + this.count,
                                'accordionId': "accordion" + key + this.count,
                                'accordionParent': "#accordion" + key + this.count,
                                'collapseId': "collapse" + key + this.count,
                                'collapseTarget': "#collapse" + key + this.count,
                                'sub_phase': key,
                                'sub_phase_label': value.label,
                                'materials': resources.materials,
                            })
                        }
                    },
                    getModals: function () {
                    },

                    disableAddEntryBtn: function (disableBtn) {
                    }
                }
            });

            Vue.component('maintenanceSubPhase', {
                template: '#maintenanceSubPhase',
                props: ['field'],
                data: function () {
                    return {
                        fields: [],
                        count: 0,
                    }
                },
                mounted() {
                    this.$on('addEntry', this.addEntry);
                    this.generateModels(this.field.model, this.field.sub_phase);

                },
                methods: {
                    addEntry: function () {

                        this.fields.push({
                            'type': "bsatMaintenanceReplacementEntry",
                            'id': this.count,
                            'materials': resources.materials,
                        });
                        this.count++;
                    },
                    removeEntry: async function (id, is_new, entry_id) {

                    },
                    generateModels: function (models, subPhase) {
                        models.forEach((model) => {
                            let material = resources.material_list.filter(i => i.id == model.material_id)[0];
                            if (undefined != material) {
                                this.fields.push({
                                    'type': "bsatMaintenanceReplacementEntry",
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                })
                            }
                        });
                        logToConsole("generateModels - " + subPhase, {
                            models: models,
                        }, LOG_TYPES.EVENT);
                    },
                    getModals: function () {
                    },

                    disableAddEntryBtn: function (disableBtn) {
                    }
                }
            });


            let sub_structure_data = maintenance_replacement.sub_structure;
            let super_structure_data = maintenance_replacement.super_structure;
            let internal_and_external_finishes_data = maintenance_replacement.internal_and_external_finishes;
            sub_structure = generateApp("sub_structure", sub_structure_data.label, "#subStructureApp", "addEntry",
                "maintenanceMainPhase", sub_structure_data.entries);

            super_structure = generateApp("super_structure", super_structure_data.label, "#superStructureApp", "addEntry",
                "maintenanceMainPhase", super_structure_data.entries)

            internal_and_external_finishes = generateApp("internal_and_external_finishes", internal_and_external_finishes_data.label,
                "#internalExternalApp", "addEntry", "maintenanceMainPhase", internal_and_external_finishes_data.entries)

            function generateApp(slug, mainPhase, elem, addEntryBtnId, template, data) {
                return new Vue({
                    el: elem,
                    data: {
                        fields: [],
                        count: 0,
                    },
                    mounted() {
                        this.$on('addEntry', this.addEntry);
                        this.fields.push({
                            'type': template,
                            'id': this.count,
                            'main_phase_label': mainPhase,
                            'model': data,
                            'accordion': "accordion" + slug + this.count,
                            'accordionId': "accordion" + slug + this.count,
                            'accordionParent': "#accordion" + slug + this.count,
                            'collapseId': "collapse" + slug + this.count,
                            'collapseTarget': "#collapse" + slug + this.count,
                        });
                    },
                    methods: {
                        addEntry: function () {

                            this.fields.push({
                                'type': template,
                                'id': this.count,
                                'model': data,
                                'accordion': "accordion" + subPhase + this.count,
                                'accordionId': "accordion" + subPhase + this.count,
                                'accordionParent': "#accordion" + subPhase + this.count,
                                'collapseId': "collapse" + subPhase + this.count,
                                'collapseTarget': "#collapse" + subPhase + this.count,
                                'sub_phase': subPhase,
                                'materials': resources.materials,
                            });
                            this.count++;
                        },
                        removeEntry: async function (id, is_new, entry_id) {

                        },
                        generateModels: function (models, subPhase) {
                            models.forEach((model) => {
                                this.fields.push({
                                    'type': template,
                                    'id': this.count++,
                                    'model': model,
                                    'sub_phase': subPhase,
                                    'materials': resources.materials,
                                    'entry_id': model.id
                                })
                            });
                            logToConsole("generateModels - " + subPhase, {
                                models: models,
                            }, LOG_TYPES.EVENT);
                        },
                        getModals: function () {

                            let total_maintenance_material_co2e = 0;

                            let models = {};
                            let subPhases = [];
                            this.$children[0].$children.map(function (child) {
                                subPhases = [];
                                maintenance_material_co2e = 0;
                                child.$children.map(function (child) {
                                    maintenance_material_co2e = maintenance_material_co2e + child.model.maintenance_material_co2e;
                                    subPhases.push(child.model);
                                });
                                total_maintenance_material_co2e = total_maintenance_material_co2e +
                                    maintenance_material_co2e;
                                models[child.field.sub_phase] = {
                                    "entries": subPhases,
                                    "maintenance_material_co2e": maintenance_material_co2e
                                }
                            });

                            let resp = {
                                "maintenance_material_co2e": total_maintenance_material_co2e,
                                "entries": models || {},
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

            $("#btnSave").on("click", function () {
                if (validateEntries(sub_structure.$children[0], "maintenance-replacement", "")
                    && validateEntries(super_structure.$children[0], "maintenance-replacement", "")
                    && validateEntries(internal_and_external_finishes.$children[0], "maintenance-replacement", "")) {
                    saveMaintenanceReplacement();
                } else {
                    errorToast('Fill All Required Fields!');
                }
            });

        }

        async function saveMaintenanceReplacement() {
            let sub_structure_data = sub_structure.getModals();
            let super_structure_data = super_structure.getModals();
            let internal_and_external_finishes_data = internal_and_external_finishes.getModals();

            let data = {
                "sub_structure": sub_structure_data,
                "super_structure": super_structure_data,
                "internal_and_external_finishes": internal_and_external_finishes_data
            };

            await axios.post("/api/maintenance-replacement/" + project_id, {"data": data})
                .then(response => {
                    logToConsole("save maintenance and replacement resp", response, LOG_TYPES.HTTP_REQUEST);
                    successToast('Project Saved!');
                }).then(() => {

                    axios.get("/api/results/" + project_id + "/maintenance-and-replacement/type/chart")
                        .then(response => {
                            logToConsole("chart result resp", response, LOG_TYPES.HTTP_REQUEST);
                            updateSubPhaseChartDataSet(maintenanceReplacementChart, response.data.chart, "maintenanceAndReplacement");
                        }).catch(error => {
                        errorToast('Result Generation Failed!');
                        logToConsole("chart result resp error", error, LOG_TYPES.ERROR);
                    });

                    refreshSubPhaseTableData("maintenanceResultTable", "maintenance-and-replacement");
                }).catch(error => {
                    errorToast('Failed To Save!');
                    logToConsole("save maintenance and replacement error", error, LOG_TYPES.ERROR);
                });
        }

        async function navigate(location) {
            if (validateEntries(sub_structure.$children[0], "sub-structure", "")
                && validateEntries(super_structure.$children[0], "sub-structure", "")
                && validateEntries(internal_and_external_finishes.$children[0], "sub-structure", "")) {
                await saveMaintenanceReplacement(false);
                window.location.href = location;
            } else {
                errorToast('Fill All Required Fields!');
            }
        }
    </script>
@stop
