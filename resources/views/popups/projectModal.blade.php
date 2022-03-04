<div id="projectModalApp">
    <div class="modal fade" id="projectModal" tabindex="-1" role="dialog"
         aria-labelledby="dataModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    let projectModal = createDataModal("projectModal", "projectModal", "createProjectModal", "Create New Project", "Create");

    function editProject(id) {

        projectModal.closeDataModal = function () {
            $('#projectModal').modal('hide');
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
                        readonly: true,
                        styleClasses: 'col-md-6 px-2',
                        validator: VueFormGenerator.validators.string
                    }, {
                        type: "customInput",
                        inputType: "text",
                        label: BSAT_LABELS.createProjectModal.projectType,
                        model: "project_type",
                        help: BSAT_TOOLTIPS.createProjectModal.projectType,
                        inputName: "project_type",
                        readonly: true,
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
                    featured: false,
                    fields: [
                        {
                            type: "customInput",
                            inputType: "text",
                            model: "country_name",
                            label: BSAT_LABELS.createProjectModal.country,
                            inputName: "country_name",
                            styleClasses: 'col-md-6 px-2',
                            readonly: true,
                        },
                        {
                            type: "customInput",
                            inputType: "text",
                            model: "location_name",
                            label: BSAT_LABELS.createProjectModal.location,
                            inputName: "location_name",
                            styleClasses: 'col-md-6 px-2',
                            readonly: true,
                        }
                    ]
                },
                {
                    legend: BSAT_LABELS.createProjectModal.buildingDetails,
                    help: BSAT_TOOLTIPS.createProjectModal.buildingDetails,
                    fields: [
                        {
                            type: "customInput",
                            inputType: "text",
                            label: BSAT_LABELS.createProjectModal.buildingType,
                            model: "building_type",
                            help: BSAT_TOOLTIPS.createProjectModal.buildingType,
                            inputName: "building_type",
                            readonly: true,
                            styleClasses: 'col-md-6 px-2',
                            values: function () {
                                return resources.buildingTypes
                            },
                        }, {
                            type: "customInput",
                            inputType: "text",
                            label: BSAT_LABELS.createProjectModal.buildingForm,
                            model: "building_form",
                            help: BSAT_TOOLTIPS.createProjectModal.buildingForm,
                            inputName: "building_form",
                            featured: false,
                            readonly: true,
                            styleClasses: 'col-md-6 px-2',
                            values: function () {
                                return resources.buildingForms
                            },
                            default: "en-US",
                            validator: VueFormGenerator.validators.required
                        }, {
                            type: "input",
                            inputType: "number",
                            label: BSAT_LABELS.createProjectModal.buildingLifeExpectancy,
                            model: "building_life_expectancy",
                            help: BSAT_TOOLTIPS.createProjectModal.buildingLifeExpectancy,
                            inputName: "building_life_expectancy",
                            styleClasses: 'col-md-6 px-2',
                            readonly: true,
                            min: 0,
                            validator: ["number", "double", "required"],
                        }, {
                            type: "input",
                            inputType: "number",
                            label: BSAT_LABELS.createProjectModal.buildingHeight,
                            model: "building_height",
                            help: BSAT_TOOLTIPS.createProjectModal.buildingHeight,
                            inputName: "building_height",
                            min: 0,
                            readonly: true,
                            validator: ["number", "double", "required"],
                            styleClasses: 'col-md-6 px-2',
                        }, {
                            type: "input",
                            inputType: "number",
                            label: BSAT_LABELS.createProjectModal.noFloors,
                            model: "no_floors",
                            help: BSAT_TOOLTIPS.createProjectModal.noFloors,
                            inputName: "no_floors",
                            styleClasses: 'col-md-6 px-2',
                            min: 0,
                            readonly: true,
                            validator: ["number", "double", "required"],
                        }, {
                            type: "input",
                            inputType: "number",
                            label: BSAT_LABELS.createProjectModal.noFloorsAboveGround,
                            model: "floors_above_ground",
                            help: BSAT_TOOLTIPS.createProjectModal.noFloorsAboveGround,
                            inputName: "floors_above_ground",
                            styleClasses: 'col-md-6 px-2',
                            min: 0,
                            readonly: true,
                            validator: ["number", "double", "required"],
                        }, {
                            type: "input",
                            inputType: "number",
                            label: BSAT_LABELS.createProjectModal.noFloorsBelowGround,
                            model: "floors_below_ground",
                            help: BSAT_TOOLTIPS.createProjectModal.noFloorsBelowGround,
                            inputName: "floors_below_ground",
                            styleClasses: 'col-md-6 px-2',
                            min: 0,
                            readonly: true,
                            validator: ["number", "double", "required"],
                        }, {
                            type: "input",
                            inputType: "number",
                            label: BSAT_LABELS.createProjectModal.groundFloorArea,
                            model: "ground_floor_area",
                            help: BSAT_TOOLTIPS.createProjectModal.groundFloorArea,
                            inputName: "ground_floor_area",
                            styleClasses: 'col-md-6 px-2',
                            min: 0,
                            readonly: true,
                            validator: ["number", "double", "required"],
                        }, {
                            type: "input",
                            inputType: "number",
                            label: BSAT_LABELS.createProjectModal.buildingFootPrint,
                            model: "building_foot_print",
                            help: BSAT_TOOLTIPS.createProjectModal.buildingFootPrint,
                            inputName: "building_foot_print",
                            styleClasses: 'col-md-6 px-2',
                            min: 0,
                            readonly: true,
                            validator: ["number", "double", "required"],
                        }]
                }, {
                    label: BSAT_LABELS.createProjectModal.buildingDescription,
                    help: BSAT_TOOLTIPS.createProjectModal.buildingDescription,
                    featured: false,
                    fields: [
                        {
                            type: "textArea",
                            label: BSAT_LABELS.createProjectModal.description,
                            model: "description",
                            help: BSAT_TOOLTIPS.createProjectModal.description,
                            inputName: "description",
                            placeholder: "Project description",
                            styleClasses: 'col-md-12 px-2',
                            readonly: true,
                            validator: VueFormGenerator.validators.required
                        }, {
                            type: "image",
                            label: BSAT_LABELS.createProjectModal.image,
                            model: "image",
                            help: BSAT_TOOLTIPS.createProjectModal.image,
                            inputName: "image",
                            disabled: true,
                            browse: true,
                            preview: true,
                            styleClasses: 'col-md-12 px-2',
                            hideInput: true
                        }
                    ]
                }
            ],
        }

        let project;

        const promise1 = axios.get("/api/projects/" + project_id);

        Promise.all([promise1]).then(function (values) {
            project = values[0].data;

            logToConsole("resp", {
                project: project,
            }, LOG_TYPES.HTTP_REQUEST);

            projectModal.title = "Project Information";
            projectModal.model = project;

            let country_name = resources.countries.filter(i => i.id == project.country_id)[0].label;
            projectModal.model.country_name = country_name;

            let project_type = resources.projectTypes.filter(i => i.id == project.project_type_id)[0].name;
            projectModal.model.project_type = project_type;

            let building_type = resources.buildingTypes.filter(i => i.id == project.building_type_id)[0].name;
            projectModal.model.building_type = building_type;

            let building_form = resources.buildingForms.filter(i => i.id == project.building_form_id)[0].name;
            projectModal.model.building_form = building_form;

            if (project.location_id != null) {
                let location_name = resources.locations.filter(i => i.id == project.location_id)[0].label;
                projectModal.model.location_name = location_name;
            } else {
                projectModal.model.location_name = project.other_location;
            }

            if (project.image != null) {
                $(".preview").css(
                    "background-image",
                    "url(" + encodeURI(project.image) + ")"
                );
            }

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
            $('#projectModal').modal('show');
        });
    }
</script>
