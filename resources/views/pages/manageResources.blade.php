@section('title', 'Manage Project Resources')
@extends('layouts.layout')


@section('content')
    @include('popups.deleteResourceConfirmModal')
    @include('popups.manageResourcesModals')
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

        .bsat-tree-select .vue-treeselect__menu {
            max-height: 300px !important;
            width: 300px !important;
            overflow: auto !important;
        }

        .bsat-tree-select .vue-treeselect__list {
            width: 400px;
        }

        .bsat-tree-select-md .vue-treeselect__menu {
            max-height: 300px !important;
            width: 450px !important;
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
            width: 1100px;
            margin-bottom: 10px;
        }

        .bsat-accordion-item {
            width: max-content;
        }

        .radio-list > label {
            margin: 10px;
        }

        .bsat-main-phase-description {
            margin-left: 25px;
            margin-bottom: 0px;
            text-align: justify;
        }

        .bsat-sub-phase-label {
            margin-right: 15px;
        }

        .b-sat-accordion-body {
            width: 750px;
            margin-left: 40px;
        }

        .b-sat-subscript-two {
            font-size: 19px;
        }

        .b-sat-add-resource-btn-container {
            margin-top: 10px
        }

        .bsat-container {
            margin-top: 20px;
        }

        .file {
            height: 34px !important;
        }
    </style>

    <div class="bsat-container">
        <div class="col-md-6 bsat-main-phase-description">
            <h2>Mange Project Resources</h2>
            Use this to enter new materials/ machinery/ transport options of your choice. Once you enter the
            required details, the added entries (new materials/ machinery/ transport) will appear under a
            section called ‘Custom’ in the drop down list under respective section.
        </div>

        <div class="col-md-12">

            <!--  Manage Materials Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageMaterials">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageMaterials" aria-expanded="false"
                                aria-controls="collapseManageMaterials">
                            <div class="bsat-sub-phase-label">Manage Materials</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageMaterials" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageMaterials"
                     data-bs-parent="#accordionManageMaterials">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">Project Materials</span>
                            </div>
                            <div class="card-body">
                                <table id="userMaterialsTable" data-unique-id="id" class="table">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="label">Material Name</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" onclick="addMaterial()">
                                Add Material
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Materials Accordion  -->

            <!--  Manage Machinery Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageMachinery">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageMachinery" aria-expanded="false"
                                aria-controls="collapseManageMachinery">
                            <div class="bsat-sub-phase-label">Manage Machinery</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageMachinery" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageMachinery"
                     data-bs-parent="#accordionManageMachinery">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">Project Machinery</span>
                            </div>
                            <div class="card-body">
                                <table id="userMachineryTable" data-unique-id="id" class="table">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="label">Machine Name</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" onclick="addMachinery()">
                                Add Machinery
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Machinery Accordion  -->

            <!--  Manage Vehicles Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageVehicles">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageVehicles" aria-expanded="false"
                                aria-controls="collapseManageVehicles">
                            <div class="bsat-sub-phase-label">Manage Vehicles</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageVehicles" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageVehicles"
                     data-bs-parent="#accordionManageVehicles">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">Project Vehicles</span>
                            </div>
                            <div class="card-body">
                                <table id="userVehiclesTable" data-unique-id="id" class="table">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="label">Vehicle Name</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" onclick="addVehicle()">
                                Add Vehicle
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Vehicles Accordion  -->

        </div>
    </div>

    <script>
        const user_id = {{ Auth::user()->id }};
        const project_id = {{ $project_id }};
        const PROJECT_SERVICE_LIFE = {{ $project_life }};
        let projectsTable = $('#projects_table');
        let resources;
        let userMaterials;
        let userMachines;
        let userVehicles;
        let materialSchema;
        let machinerySchema;
        let vehicleSchema;

        (function () {
            const promise1 = axios.get("/api/projects/" + project_id + "/resources/materials");
            const promise2 = axios.get("/api/projects/" + project_id + "/resources/machines");
            const promise3 = axios.get("/api/projects/" + project_id + "/resources/vehicles");
            const promise4 = axios.get("/api/resources/" + project_id + "/manage-resources");

            Promise.all([promise1, promise2, promise3, promise4]).then(function (values) {
                userMaterials = values[0].data;
                userMachines = values[1].data;
                userVehicles = values[2].data;
                resources = values[3].data;
                resources.materialCategories = values[3].data.material_categories;

                generateResourceTable("userMachineryTable", userMachines, machineryEditAction);
                generateResourceTable("userVehiclesTable", userVehicles, vehicleEditAction);
                generateResourceTable("userMaterialsTable", userMaterials, materialEditAction);

                logToConsole("resp", {
                    userMaterials: userMaterials,
                    userMachines: userMachines,
                    userVehicles: userVehicles,
                    resources: resources,
                    materialCategories: resources.materialCategories,
                }, LOG_TYPES.HTTP_REQUEST);
                init();
                loadingOverlay.classList.add('hide-loader');
            });
        })();

        function materialEditAction(value, row, index) {
            return '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editMaterial("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteMaterial("' + row.id + '")\'></i>' +
                '</div>';
        }

        function machineryEditAction(value, row, index) {
            return '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editMachinery("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteMachinery("' + row.id + '")\'></i>' +
                '</div>';
        }

        function vehicleEditAction(value, row, index) {
            return '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editVehicle("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteVehicle("' + row.id + '")\'></i>' +
                '</div>';
        }

        function generateResourceTable(tableId, data, editAction) {
            let resourceTable = $('#' + tableId);
            resourceTable.bootstrapTable({
                data: data,
                pageSize: 10,
                pagination: true,
                classes: 'table',
                columns: [{}, {}, {},
                    {
                        field: 'operate',
                        title: 'Action',
                        align: 'center',
                        valign: 'middle',
                        clickToSelect: false,
                        formatter: editAction
                    }
                ]
            });
        }

        async function getResources() {
            await axios.get("api/resources/dashboard")
                .then(response => {
                    resources = response.data;
                    logToConsole("getResources resp", {
                        response: response,
                    }, LOG_TYPES.HTTP_REQUEST);
                }).then(() => {
                    init();
                })
                .catch(error => {
                    logToConsole("getResources error", error, LOG_TYPES.ERROR);
                });
        }

        let dataModal = createDataModal("dataModal", "dataModal", "dataModal", "Add New Machinery", "Add Machinery");
        let deleteConfirmModal = createDeleteConfirmationModal('deleteRecordConfirmModal');

        function init() {
            dataModal.closeDataModal = function () {
                $('#dataModal').modal('hide');
            }

            materialSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMaterialSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        required: true,
                        disabled: false,
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.material,
                        min: 5,
                        max: 150,
                        validator: ["string", "validateCustomInput"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.userMaterialSchema.category,
                        model: "category_id",
                        inputName: "category_id",
                        required: true,
                        styleClasses: 'col-md-6 px-2 bsat-tree-select-md',
                        help: BSAT_TOOLTIPS.userMaterialSchema.category,
                        values: function () {
                            return resources.materialCategories;
                        },
                        options: resources.materialCategories,
                        selectOptions: {
                            type: "categories",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        validator: VueFormGenerator.validators.required
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.userMaterialSchema.country,
                        model: "countries",
                        inputName: "country",
                        required: true,
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.userMaterialSchema.country,
                        values: function () {
                            return resources.countries;
                        },
                        options: resources.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        validator: VueFormGenerator.validators.required
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userMaterialSchema.year,
                        model: "year",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMaterialSchema.standard,
                        model: "standard",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.standard,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMaterialSchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userMaterialSchema.serviceLife,
                        model: "service_life",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.serviceLife,
                        required: true,
                        min: 0,
                        max: 10000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMaterialSchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userMaterialSchema.bulkingDensity,
                        model: "bulking_density",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.bulkingDensity,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userMaterialSchema.bulkingFactor,
                        model: "bulking_factor",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.bulkingFactor,
                        readonly: true,
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMaterialSchema.unit,
                        model: "unit",
                        required: true,
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.unit,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userMaterialSchema.wastage,
                        model: "wastage",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.wastage,
                        required: true,
                        min: 0,
                        max: 100,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userMaterialSchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMaterialSchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            machinerySchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMachinerySchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        required: true,
                        disabled: false,
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMachinerySchema.material,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.userMachinerySchema.country,
                        model: "countries",
                        inputName: "country",
                        required: true,
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.userMachinerySchema.country,
                        values: function () {
                            return resources.countries;
                        },
                        options: resources.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        validator: VueFormGenerator.validators.required
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userMachinerySchema.year,
                        model: "year",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMachinerySchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMachinerySchema.standard,
                        model: "standard",
                        help: BSAT_TOOLTIPS.userMachinerySchema.standard,
                        styleClasses: 'col-md-6 px-2',
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMachinerySchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMachinerySchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userMachinerySchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMachinerySchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userMachinerySchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMachinerySchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: VERTICAL_ALIGINMENT_SPAN + BSAT_LABELS.userMachinerySchema.unit,
                        model: "unit",
                        required: true,
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userMachinerySchema.unit,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }
                ]
            }

            vehicleSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userVehicleSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        required: true,
                        disabled: false,
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userVehicleSchema.material,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.userVehicleSchema.country,
                        model: "countries",
                        inputName: "country",
                        required: true,
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.userVehicleSchema.country,
                        values: function () {
                            return resources.countries;
                        },
                        options: resources.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        validator: VueFormGenerator.validators.required
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userVehicleSchema.year,
                        model: "year",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userVehicleSchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userVehicleSchema.standard,
                        model: "standard",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userVehicleSchema.standard,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userVehicleSchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userVehicleSchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userVehicleSchema.loadingCapacity,
                        model: "loading_capacity",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userVehicleSchema.loadingCapacity,
                        required: true,
                        validator: ["validateLoadCapacity"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userVehicleSchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userVehicleSchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.userVehicleSchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userVehicleSchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.userVehicleSchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.userVehicleSchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }
        }

        function addMaterial() {
            dataModal.title = "Add New Material";
            dataModal.submitBtnText = "Create";
            dataModal.model = {
                id: 1,
                project_id: project_id,
                category_id: null,
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                service_life: null,
                conversion_unit: "",
                technical_specification: null,
                bulking_density: null,
                bulking_factor: 1,
                gwp: null,
                unit: null,
                wastage: null
            };

            dataModal.schema = materialSchema;

            dataModal.validateInfoModal = async function () {
                if (dataModal.$refs.dataModal.validate()) {
                    $('#dataModal').modal('hide');
                    userMaterials = await save("/api/projects/" + project_id + "/resources/materials", dataModal
                        .model, "userMaterialsTable");
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        function editMaterial(id) {

            let material = _.clone(userMaterials.filter((i) => i.id === id)[0]);

            let materialName = material.label.split("Custom-")[1];
            material.label = materialName;

            dataModal.title = "Update Material";
            dataModal.submitBtnText = "Update";
            dataModal.model = material;
            dataModal.schema = materialSchema;

            dataModal.validateInfoModal = async function () {
                if (dataModal.$refs.dataModal.validate()) {
                    $('#dataModal').modal('hide');
                    userMaterials = await update("/api/projects/" + project_id + "/resources/materials", id,
                        material, "userMaterialsTable");
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        function deleteMaterial(id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.message = createDeleteMessage("material");
            deleteConfirmModal.confirm = async () => {
                userMaterials = await deleteResource("/api/projects/" + project_id + "/resources/materials", deleteConfirmModal.id, "userMaterialsTable")
            }
            $("#deleteRecordConfirmModal").modal('show');
        }


        function addMachinery() {
            dataModal.title = "Add New Machinery";
            dataModal.submitBtnText = "Create";
            dataModal.model = {
                id: 1,
                project_id: project_id,
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                technical_specification: null,
                gwp: null,
                unit: null
            };

            dataModal.schema = machinerySchema;

            dataModal.validateInfoModal = async function () {
                if (dataModal.$refs.dataModal.validate()) {
                    $('#dataModal').modal('hide');
                    userMachines = await save("/api/projects/" + project_id + "/resources/machines", dataModal
                        .model, "userMachineryTable");
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        function editMachinery(id) {

            let machinery = userMachines.filter((i) => i.id === id)[0];

            dataModal.title = "Update Machinery";
            dataModal.submitBtnText = "Update";
            dataModal.model = machinery;
            dataModal.schema = machinerySchema;

            dataModal.validateInfoModal = async function () {
                if (dataModal.$refs.dataModal.validate()) {
                    $('#dataModal').modal('hide');
                    userMachines = await update("/api/projects/" + project_id + "/resources/machines", id,
                        machinery, "userMachineryTable");
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        function deleteMachinery(id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.message = createDeleteMessage("machine");
            deleteConfirmModal.confirm = async () => {
                userMachines = await deleteResource("/api/projects/" + project_id + "/resources/machines", deleteConfirmModal.id, "userMachineryTable")
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function addVehicle() {
            dataModal.title = "Add New Vehicle";
            dataModal.submitBtnText = "Create";
            dataModal.model = {
                id: 1,
                project_id: project_id,
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                loading_capacity: null,
                technical_specification: null,
                gwp: null,
                unit: null
            };

            dataModal.schema = vehicleSchema;

            dataModal.validateInfoModal = async function () {
                if (dataModal.$refs.dataModal.validate()) {
                    $('#dataModal').modal('hide');
                    userVehicles = await save("/api/projects/" + project_id + "/resources/vehicles", dataModal
                        .model, "userVehiclesTable");
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        function editVehicle(id) {

            let vehicle = userVehicles.filter((i) => i.id === id)[0];

            dataModal.title = "Update Vehicle";
            dataModal.submitBtnText = "Update";
            dataModal.model = vehicle;
            dataModal.schema = vehicleSchema;

            dataModal.validateInfoModal = async function () {
                if (dataModal.$refs.dataModal.validate()) {
                    $('#dataModal').modal('hide');
                    userVehicles = await update("/api/projects/" + project_id + "/resources/vehicles", id,
                        vehicle, "userVehiclesTable");
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        function deleteVehicle(id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.message = createDeleteMessage("vehicle");
            deleteConfirmModal.confirm = async () => {
                userVehicles = await deleteResource("/api/projects/" + project_id + "/resources/vehicles", deleteConfirmModal.id, "userVehiclesTable")
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        async function save(url, data, elem) {
            return await axios.post(url, data)
                .then(response => {
                    refreshTable(elem, url);

                    successToast('Resource Created!');

                    logToConsole("resource save resp", {
                        response: response,
                    }, LOG_TYPES.HTTP_REQUEST);

                    return response.data;
                })
                .catch(error => {
                    logToConsole("resource save error", error, LOG_TYPES.ERROR);
                });
        }

        async function update(url, id, data, elem) {
            return await axios.put(url + "/" + id, data)
                .then(response => {
                    refreshTable(elem, url);

                    successToast('Resource Updated!');

                    logToConsole("resource update resp", {
                        response: response,
                    }, LOG_TYPES.HTTP_REQUEST);

                    return response.data;
                })
                .catch(error => {
                    logToConsole("resource update error", error, LOG_TYPES.ERROR);
                });
        }

        async function deleteResource(url, id, elem) {
            return await axios.delete(url + "/" + id)
                .then(response => {
                    refreshTable(elem, url);

                    successToast('Resource Deleted!');

                    logToConsole("deleteResource resp", {
                        response: response,
                    }, LOG_TYPES.HTTP_REQUEST);
                    $("#deleteRecordConfirmModal").modal('hide');
                    return response.data;
                })
                .catch(error => {
                    $("#deleteRecordConfirmModal").modal('hide');
                    logToConsole("deleteResource error", error, LOG_TYPES.ERROR);
                });
        }

        async function navigate(location) {
            window.location.href = location;
        }
    </script>
@stop
