@section('title', 'Dashboard')
@extends('layouts.layout')


@section('content')
    @include('popups.deleteResourceConfirmModal')
    @include('popups.errorModal')
    @include('popups.successModal')

    <style>
        .create-project-warning {
            color: #fd0000;
            font-family: sans-serif;
            font-weight: 600;
            margin: 7px;
        }

        .bsat-product-description {
            text-align: justify;
        }

        .featured .helpText {
            width: 500px !important;
        }

        .bsat-tree-select .vue-treeselect__menu {
            max-height: 300px !important;
            width: 300px !important;
            overflow: auto !important;
        }

        .bsat-tree-select .vue-treeselect__list {
            width: 400px;
        }
    </style>

    <div style="padding: 2%">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <span class="h4">Projects</span>
                    </div>
                    <div class="card-body">
                        <div id="projectToolbar">
                            <button id="removeProjects" class="btn btn-danger" disabled
                                    onclick="deleteProjects(true, null)">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                        <table id="projects_table"
                               data-unique-id="id"
                               class="table"
                               data-toolbar="#projectToolbar"
                               data-click-to-select="true"
                               data-search="true">
                            <thead>
                            <tr>
                                <th data-field="id" data-visible="false"></th>
                                <th data-field="state" data-checkbox="true"></th>
                                <th data-field="name">Project Name</th>
                                <th data-field="site_clearance">Project</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <br/>
                <button type="button" class="btn btn-primary" onclick="createProject()">
                    Create Project
                </button>
            </div>
            <div class="col-md-6">
                <div style="text-align: center; width: 100%;">
                    <img src="/images/banner.png" width="100%">
                </div>
            </div>
        </div>
    </div>

    <div id="dataModalApp">
        <div class="modal fade" id="dataModal" tabindex="-1" role="dialog"
             aria-labelledby="dataModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 525px;" role="document">
                <form id="formId" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">@{{ title }}</h5>
                            <button type="button" class="close" v-on:click="closeDataModal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="create-project-warning">
                                            *Note that the data entered here CANNOT be edited later after saving. Please
                                            review carefully
                                            before you proceed further.
                                        </div>
                                        <div>
                                            <vue-form-generator :schema="schema" :model="model" :options="formOptions"
                                                                tag="div" :ref="vgfRef"
                                                                @model-updated="onModelUpdated"
                                                                @validated="onValidated">
                                            </vue-form-generator>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    v-on:click="closeDataModal">Close
                            </button>
                            <button type="button" v-on:click="validateInfoModal" class="btn btn-primary">
                                @{{ submitBtnText }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const user_id = {{ Auth::user()->id }};
        const project_id = ""; //{{ session('project_id') }};
        let projectsTable = $('#projects_table');
        let resources;
        let userProjects;


        (function () {
            const promise1 = axios.get("/api/projects");
            const promise2 = axios.get("/api/resources/dashboard");

            Promise.all([promise1, promise2]).then(function (values) {
                userProjects = values[0].data;
                resources = values[1].data;

                populateProjects(userProjects);
                init();

                projectsTable.on('check.bs.table uncheck.bs.table ' +
                    'check-all.bs.table uncheck-all.bs.table',
                    function () {
                        $('#removeProjects').prop('disabled', !projectsTable.bootstrapTable('getSelections').length)
                    });

                loadingOverlay.classList.add('hide-loader');

                logToConsole("getProjects resp", {
                    userProjects: userProjects,
                    resources: resources,
                }, LOG_TYPES.HTTP_REQUEST);
            });
        })();

        let projectModal = createDataModal("dataModal", "dataModal", "createProjectModal", "Create New Project", "Create");
        let deleteConfirmModal = createDeleteConfirmationModal('deleteRecordConfirmModal');

        function init() {
            projectModal.closeDataModal = function () {
                $('#dataModal').modal('hide');
            }

            projectModal.validateInfoModal = function () {
                if (projectModal.$refs.createProjectModal.validate()) {
                    saveProject();
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            projectModal.schema = {
                groups: [{
                    fields: [
                        {
                            type: "input",
                            inputType: "text",
                            label: BSAT_LABELS.createProjectModal.name,
                            model: "name",
                            help: BSAT_TOOLTIPS.createProjectModal.name,
                            inputName: "name",
                            readonly: false,
                            required: true,
                            disabled: false,
                            styleClasses: 'col-md-6 px-2',
                            validator: VueFormGenerator.validators.string
                        }, {
                            type: "select",
                            label: BSAT_LABELS.createProjectModal.projectType,
                            model: "project_type_id",
                            help: BSAT_TOOLTIPS.createProjectModal.projectType,
                            inputName: "project_type_id",
                            required: true,
                            styleClasses: 'col-md-6 px-2',
                            values: function () {
                                return resources.projectTypes
                            },
                            default: "en-US",
                            validator: VueFormGenerator.validators.required
                        }]
                },
                    {
                        legend: BSAT_LABELS.createProjectModal.projectLocation,
                        help: BSAT_TOOLTIPS.createProjectModal.projectLocation,
                        featured: true,
                        fields: [{
                            type: "treeSelect",
                            label: BSAT_LABELS.createProjectModal.country,
                            model: "country_id",
                            help: BSAT_TOOLTIPS.createProjectModal.country,
                            inputName: "country",
                            required: true,
                            styleClasses: 'col-md-6 px-2 bsat-tree-select',
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
                            type: "treeSelect",
                            label: BSAT_LABELS.createProjectModal.location,
                            model: "location_id",
                            help: BSAT_TOOLTIPS.createProjectModal.location,
                            inputName: "location",
                            required: true,
                            styleClasses: 'col-md-6 px-2 bsat-tree-select',
                            values: function () {
                                return resources.locations;
                            },
                            visible: function (model) {
                                if (model && model.country_id) {
                                    let country = resources.countries.filter(i => i.id === model.country_id)[0].label;
                                    return model && "Sri Lanka" === country;
                                }
                            },
                            options: resources.locations,
                            selectOptions: {
                                type: "locations",
                                searchable: true,
                                closeOnSelect: true,
                                showInfoIcon: false,
                                closeOnLabelClick: true,
                            },
                            validator: VueFormGenerator.validators.required
                        }, {
                            type: "input",
                            inputType: "text",
                            label: BSAT_LABELS.createProjectModal.location,
                            model: "other_location",
                            help: BSAT_TOOLTIPS.createProjectModal.location,
                            inputName: "other_location",
                            readonly: false,
                            required: true,
                            disabled: false,
                            styleClasses: 'col-md-6 px-2',
                            validator: VueFormGenerator.validators.string,
                            visible: function (model) {
                                if (model.country_id === undefined || model.country_id === null) {
                                    return true
                                }

                                if (model && model.country_id) {
                                    let country = resources.countries.filter(i => i.id === model.country_id)[0].label;
                                    return model && "Sri Lanka" != country;
                                }
                            },

                        }]
                    },
                    {
                        legend: BSAT_LABELS.createProjectModal.buildingDetails,
                        help: BSAT_TOOLTIPS.createProjectModal.buildingDetails,
                        fields: [
                            {
                                type: "select",
                                label: BSAT_LABELS.createProjectModal.buildingType,
                                model: "building_type_id",
                                help: BSAT_TOOLTIPS.createProjectModal.buildingType,
                                inputName: "building_type_id",
                                required: true,
                                styleClasses: 'col-md-6 px-2',
                                values: function () {
                                    return resources.buildingTypes
                                },
                                default: "en-US",
                                validator: VueFormGenerator.validators.required
                            }, {
                                type: "select",
                                label: BSAT_LABELS.createProjectModal.buildingForm,
                                model: "building_form_id",
                                help: BSAT_TOOLTIPS.createProjectModal.buildingForm,
                                inputName: "building_form_id",
                                required: true,
                                styleClasses: 'col-md-6 px-2',
                                values: function () {
                                    return resources.buildingForms
                                },
                                default: "en-US",
                                validator: VueFormGenerator.validators.required
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.createProjectModal.buildingHeight,
                                model: "building_height",
                                help: BSAT_TOOLTIPS.createProjectModal.buildingHeight,
                                inputName: "building_height",
                                min: 1,
                                validator: ["number", "double", "required"],
                                styleClasses: 'col-md-6 px-2',
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.createProjectModal.noFloors,
                                model: "no_floors",
                                help: BSAT_TOOLTIPS.createProjectModal.noFloors,
                                inputName: "no_floors",
                                min: 0,
                                styleClasses: 'col-md-6 px-2',
                                validator: ["number", "double", "required"],
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.createProjectModal.noFloorsAboveGround,
                                model: "floors_above_ground",
                                help: BSAT_TOOLTIPS.createProjectModal.noFloorsAboveGround,
                                inputName: "floors_above_ground",
                                min: 0,
                                styleClasses: 'col-md-6 px-2',
                                validator: ["number", "double", "required"],
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.createProjectModal.noFloorsBelowGround,
                                model: "floors_below_ground",
                                help: BSAT_TOOLTIPS.createProjectModal.noFloorsBelowGround,
                                inputName: "floors_below_ground",
                                min: 0,
                                styleClasses: 'col-md-6 px-2',
                                validator: ["number", "double", "required"],
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.createProjectModal.groundFloorArea,
                                model: "ground_floor_area",
                                help: BSAT_TOOLTIPS.createProjectModal.groundFloorArea,
                                inputName: "ground_floor_area",
                                min: 1,
                                required: true,
                                styleClasses: 'col-md-6 px-2',
                                validator: ["number", "double", "required"],
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.createProjectModal.buildingFootPrint,
                                model: "building_foot_print",
                                help: BSAT_TOOLTIPS.createProjectModal.buildingFootPrint,
                                inputName: "building_foot_print",
                                min: 1,
                                styleClasses: 'col-md-6 px-2',
                                validator: ["number", "double", "required"],
                            }, {
                                type: "input",
                                inputType: "number",
                                label: BSAT_LABELS.createProjectModal.buildingLifeExpectancy,
                                model: "building_life_expectancy",
                                help: BSAT_TOOLTIPS.createProjectModal.buildingLifeExpectancy,
                                inputName: "building_life_expectancy",
                                min: 1,
                                styleClasses: 'col-md-6 px-2',
                                required: true,
                                validator: ["number", "double", "required"],
                            }]
                    }, {
                        label: BSAT_LABELS.createProjectModal.buildingDescription,
                        help: BSAT_TOOLTIPS.createProjectModal.buildingDescription,
                        fields: [{
                            type: "textArea",
                            label: BSAT_LABELS.createProjectModal.description,
                            model: "description",
                            help: BSAT_TOOLTIPS.createProjectModal.description,
                            inputName: "description",
                            placeholder: "Project description",
                            styleClasses: 'col-md-12 px-2',
                            validator: VueFormGenerator.validators.required
                        },
                            {
                                type: "image",
                                label: BSAT_LABELS.createProjectModal.image,
                                model: "image",
                                help: BSAT_TOOLTIPS.createProjectModal.image,
                                inputName: "image",
                                browse: true,
                                preview: true,
                                styleClasses: 'col-md-12 px-2',
                                hideInput: true
                            }
                        ]
                    }
                ],
            }
        }

        function createProject() {
            projectModal.title = "Create New Project";
            projectModal.model = {
                id: 1,
                project_type_id: null,
                country_id: null,
                location_id: null,
                other_location: null,
                building_type_id: null,
                building_form_id: null,
                name: null,
                building_life_expectancy: null,
                building_height: null,
                no_floors: null,
                floors_above_ground: null,
                floors_below_ground: null,
                ground_floor_area: null,
                building_foot_print: null,
                description: null,
                image: null,
                status: true
            };

            projectModal.validateInfoModal = function () {
                if (projectModal.$refs.createProjectModal.validate()) {
                    saveProject();
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        function populateProjects(projects) {

            projectsTable.bootstrapTable({
                data: projects,
                pageSize: 10,
                pagination: true,
                classes: 'table',
                columns: [{}, {}, {},
                    {
                        field: 'operate',
                        title: 'Project',
                        align: 'center',
                        valign: 'middle',
                        clickToSelect: false,
                        formatter: function (value, row, index) {
                            return '<a target="_blank" href="/project/' + row.user_id + '/' + row.id +
                                '/earthworks">Link</a>';
                        }
                    },
                    {
                        field: 'operate',
                        title: 'Action',
                        align: 'center',
                        valign: 'middle',
                        clickToSelect: false,
                        formatter: function (value, row, index) {
                            return '<div><i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                                'onclick=\'deleteProjects(false,' + row.id + ')\'></i>' +
                                '</div>';
                        }
                    }
                ]
            });
            projectsTable.bootstrapTable('refresh')
            document.getElementById('projects_table').style.visibility = "visible";
        }

        async function saveProject() {
            let formData = new FormData(document.getElementById("formId"));
            formData.append("country_id", projectModal.model.country_id);
            formData.append("location_id", projectModal.model.location_id);

            if (formData.get('image').size == 0) {
                formData.delete('image');
            }
            await axios.post("api/projects", formData)
                .then(response => {
                    userProjects = response.data;

                    refreshTable("projects_table", "api/projects");
                    $('#dataModal').modal('hide');
                    successToast('Project Created!');

                    logToConsole("saveProject resp", {
                        response: response,
                    }, LOG_TYPES.HTTP_REQUEST);
                })
                .catch(error => {
                    $('#dataModal').modal('hide');

                    switch (error.response.status) {
                        case 422:
                            errorToast('Project image should be less than 1MB!');
                            break;
                        case 500:
                            errorToast(error.response.data.error);
                            break;
                        default:
                            errorToast('Project Creation Failed!');
                    }

                    logToConsole("saveProject error", error, LOG_TYPES.ERROR);
                });
        }

        function editProject(id) {
            let project = userProjects.filter((i) => i.id === id)[0];

            projectModal.title = "Edit Project";
            projectModal.submitBtnText = "Update";
            projectModal.model = project;

            $(".preview").css(
                "background-image",
                "url(" + encodeURI(project.image) + ")"
            );

            projectModal.validateInfoModal = function () {
                if (projectModal.$refs.createProjectModal.model.image != null
                    && projectModal.$refs.createProjectModal.model.image.length !== 0) {
                    if (projectModal.$refs.createProjectModal.validate()) {
                        updateProject(id);
                    } else {
                        errorToast('Fill All Required Fields!');
                    }
                } else {
                    errorToast('Upload Project Image!');
                }
            }
            $('#dataModal').modal('show');
        }

        async function deleteProjects(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("project");
            deleteConfirmModal.confirm = async () => {

                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("projects_table");
                    userProjects = await axios.post("api/projects/delete", {ids: selections})
                        .then(response => {
                            refreshTable("projects_table", "api/projects");

                            successToast('Resources Deleted!');

                            logToConsole("delete resources resp", {
                                response: response,
                            }, LOG_TYPES.HTTP_REQUEST);

                            return response.data;
                        })
                        .catch(error => {
                            $('#dataModal').modal('hide');
                            logToConsole("delete resources error", error, LOG_TYPES.ERROR);
                        });
                    $("#deleteRecordConfirmModal").modal('hide');
                } else {
                    await axios.delete("api/projects/" + deleteConfirmModal.id)
                        .then(response => {
                            userProjects = response.data;

                            refreshTable("projects_table", "api/projects");
                            successToast('Project Deleted!');

                            logToConsole("deleteProjects resp", {
                                response: response,
                            }, LOG_TYPES.HTTP_REQUEST);
                        })
                        .catch(error => {
                            logToConsole("deleteProjects error", error, LOG_TYPES.ERROR);
                        });
                    $("#deleteRecordConfirmModal").modal('hide');
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        async function updateProject(id) {
            let formData = new FormData(document.getElementById("formId"));
            formData.append("country_id", projectModal.model.country_id);
            formData.append("location_id", projectModal.model.location_id);
            await axios.post("api/projects/" + id + "/put", formData)
                .then(response => {
                    userProjects = response.data;

                    refreshTable("projects_table", "api/projects");
                    $('#dataModal').modal('hide');
                    successToast('Project Updated!');

                    logToConsole("updateProject resp", {
                        response: response,
                    }, LOG_TYPES.HTTP_REQUEST);
                })
                .catch(error => {
                    $('#dataModal').modal('hide');

                    if (error.response.status === 422) {
                        errorToast('Project image should be less than 1MB!');
                    } else {
                        errorToast('Project Update Failed!');
                    }

                    logToConsole("updateProject error", error, LOG_TYPES.ERROR);
                });
        }
    </script>
@stop
