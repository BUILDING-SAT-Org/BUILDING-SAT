@section('title', 'Dashboard')
    @extends('layouts.layout')


@section('content')

    <h1>{{ session('user_id') }}</h1>
    <div style="padding: 2%">
        <div class="row">
            <div class="col-md-6">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                    Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container" id="app">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Form</div>
                                        <div class="panel-body">
                                            <form action="/projects" method="POST" enctype="multipart/form-data">
                                                <vue-form-generator class="row" tag="div" :schema="schema" :model="model"
                                                    :options="formOptions">
                                                </vue-form-generator>
                                                <div class="row" style="justify-content: flex-end;">
                                                    <div class="col-md-6">
                                                        <button class="btn btn-secondary"
                                                            v-on:click="cancel">Cancel</button>
                                                        <button class="btn btn-warning" type="submit">Create</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <span class="h4">Projects</span>
                    </div>
                    <div class="card-body">
                        <table id="projects_table" data-unique-id="id" class="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-visible="false"></th>
                                    <th data-field="name">Project Name</th>
                                    <th data-field="site_clearence">Site Clearence</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var user_id = {{ session('user_id') }};
        var vm = new Vue({
            el: "#app",

            components: {
                "vue-form-generator": VueFormGenerator.component
            },

            data() {
                return {
                    model: {
                        id: 1,
                        project_type: 45,
                        country: 35,
                        location: 35,
                        building_type: 35,
                        building_form: 35,
                        name: "John Doe",
                        building_life_expectancy: 35,
                        building_height: 35,
                        no_floors: 35,
                        floors_above_ground: 35,
                        floors_below_ground: 35,
                        ground_floor_area: 35,
                        building_foot_print: 35,
                        description: "",
                        image: "/home/sangeeth/Pictures/Screenshot from 2021-06-28 10-23-04.png",
                        status: true
                    },
                    schema: {

                        groups: [{
                                fields: [{
                                    type: "input",
                                    inputType: "text",
                                    label: "ID",
                                    model: "id",
                                    inputName: "id",
                                    readonly: true,
                                    featured: false,
                                    styleClasses: 'col-md-6 px-2',
                                }, {
                                    type: "input",
                                    inputType: "text",
                                    label: "Name",
                                    model: "name",
                                    inputName: "name",
                                    readonly: false,
                                    featured: true,
                                    required: true,
                                    disabled: false,
                                    placeholder: "User's name",
                                    styleClasses: 'col-md-6 px-2',
                                    validator: VueFormGenerator.validators.string
                                }, {
                                    type: "select",
                                    label: "Project Type",
                                    model: "project_type",
                                    inputName: "project_type",
                                    required: true,
                                    styleClasses: 'col-md-6 px-2',
                                    values: function() {
                                        return [{
                                                id: "en-GB",
                                                name: "English (GB)"
                                            },
                                            {
                                                id: "en-US",
                                                name: "English (US)"
                                            },
                                            {
                                                id: "de",
                                                name: "German"
                                            },
                                            {
                                                id: "it",
                                                name: "Italic"
                                            },
                                            {
                                                id: "fr",
                                                name: "French"
                                            }
                                        ]
                                    },
                                    default: "en-US",
                                    validator: VueFormGenerator.validators.required
                                }]
                            },
                            {

                                legend: "Building Location",
                                help: "This is an other longer help text",
                                fields: [{
                                    type: "select",
                                    label: "Country",
                                    model: "country",
                                    inputName: "country",
                                    required: true,
                                    styleClasses: 'col-md-6 px-2',
                                    values: function() {
                                        return [{
                                                id: "en-GB",
                                                name: "English (GB)"
                                            },
                                            {
                                                id: "en-US",
                                                name: "English (US)"
                                            },
                                            {
                                                id: "de",
                                                name: "German"
                                            },
                                            {
                                                id: "it",
                                                name: "Italic"
                                            },
                                            {
                                                id: "fr",
                                                name: "French"
                                            }
                                        ]
                                    },
                                    default: "en-US",
                                    validator: VueFormGenerator.validators.required
                                }, {
                                    type: "select",
                                    label: "Location",
                                    model: "location",
                                    inputName: "location",
                                    required: true,
                                    styleClasses: 'col-md-6 px-2',
                                    values: function() {
                                        return [{
                                                id: "en-GB",
                                                name: "English (GB)"
                                            },
                                            {
                                                id: "en-US",
                                                name: "English (US)"
                                            },
                                            {
                                                id: "de",
                                                name: "German"
                                            },
                                            {
                                                id: "it",
                                                name: "Italic"
                                            },
                                            {
                                                id: "fr",
                                                name: "French"
                                            }
                                        ]
                                    },
                                    default: "en-US",
                                    validator: VueFormGenerator.validators.required
                                }]

                            },
                            {
                                legend: "Building Details",
                                styleClasses: 'col-md-12',
                                fields: [{
                                    type: "select",
                                    label: "Building Type",
                                    model: "building_type",
                                    inputName: "building_type",
                                    required: true,
                                    styleClasses: 'col-md-6 px-2',
                                    values: function() {
                                        return [{
                                                id: "en-GB",
                                                name: "English (GB)"
                                            },
                                            {
                                                id: "en-US",
                                                name: "English (US)"
                                            },
                                            {
                                                id: "de",
                                                name: "German"
                                            },
                                            {
                                                id: "it",
                                                name: "Italic"
                                            },
                                            {
                                                id: "fr",
                                                name: "French"
                                            }
                                        ]
                                    },
                                    default: "en-US",
                                    validator: VueFormGenerator.validators.required
                                }, {
                                    type: "select",
                                    label: "Building Form",
                                    model: "building_form",
                                    inputName: "building_form",
                                    required: true,
                                    styleClasses: 'col-md-6 px-2',
                                    values: function() {
                                        return [{
                                                id: "en-GB",
                                                name: "English (GB)"
                                            },
                                            {
                                                id: "en-US",
                                                name: "English (US)"
                                            },
                                            {
                                                id: "de",
                                                name: "German"
                                            },
                                            {
                                                id: "it",
                                                name: "Italic"
                                            },
                                            {
                                                id: "fr",
                                                name: "French"
                                            }
                                        ]
                                    },
                                    default: "en-US",
                                    validator: VueFormGenerator.validators.required
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    label: "Building Life Expectancy",
                                    model: "building_life_expectancy",
                                    inputName: "building_life_expectancy",
                                    min: 18,
                                    styleClasses: 'col-md-6 px-2',
                                    validator: VueFormGenerator.validators.number
                                }]
                            },
                            {

                                legend: "Building Details",
                                fields: [{
                                    type: "input",
                                    inputType: "number",
                                    label: "Building Height",
                                    model: "building_height",
                                    inputName: "building_height",
                                    min: 18,
                                    validator: VueFormGenerator.validators.number,
                                    styleClasses: 'col-md-6 px-2',
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    label: "No Floors",
                                    model: "no_floors",
                                    inputName: "no_floors",
                                    min: 18,
                                    styleClasses: 'col-md-6 px-2',
                                    validator: VueFormGenerator.validators.number
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    label: "No Floors Above Ground",
                                    model: "floors_above_ground",
                                    inputName: "floors_above_ground",
                                    min: 18,
                                    styleClasses: 'col-md-6 px-2',
                                    validator: VueFormGenerator.validators.number
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    label: "No Floors Below Ground",
                                    model: "floors_below_ground",
                                    inputName: "floors_below_ground",
                                    min: 18,
                                    styleClasses: 'col-md-6 px-2',
                                    validator: VueFormGenerator.validators.number
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    label: "Ground Floor Area",
                                    model: "ground_floor_area",
                                    inputName: "ground_floor_area",
                                    min: 18,
                                    styleClasses: 'col-md-6 px-2',
                                    validator: VueFormGenerator.validators.number
                                }, {
                                    type: "input",
                                    inputType: "number",
                                    label: "Building Foot Print",
                                    model: "building_foot_print",
                                    inputName: "building_foot_print",
                                    min: 18,
                                    styleClasses: 'col-md-6 px-2',
                                    validator: VueFormGenerator.validators.number
                                }]
                            }, {
                                legend: "Building Description",
                                fields: [{
                                        type: "textArea",
                                        label: "Description",
                                        model: "description",
                                        inputName: "description",
                                        placeholder: "Project description",
                                        styleClasses: 'col-md-12 px-2',
                                        validator: VueFormGenerator.validators.required
                                    },
                                    {
                                        type: "image",
                                        label: "Image",
                                        model: "image",
                                        inputName: "image",
                                        required: true,
                                        browse: true,
                                        preview: true,
                                        styleClasses: 'col-md-12 px-2',
                                        hideInput: true
                                    }
                                ]
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
                $(".preview").css(
                    "background-image",
                    "url(http://localhost.bsat.com/storage/user/1/projects/4/Screenshot%20from%202021-06-27%2009-13-36.png)"
                );
            },

            methods: {
                cancel: function() {
                    console.log('cancel');
                }
            },
        });

        var $projects_table = $('#projects_table');
        get_projects();
        async function get_projects() {
            await $.ajax({
                url: "/projects/" + user_id,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                complete: function complete() {},
                success: function success(result) {
                    console.log(result);
                    populate_projects(result);
                },
                error: function error() {
                    console.log("error");
                }
            });
        }

        function populate_projects(projects) {

            $projects_table.bootstrapTable({
                data: projects,
                pageSize: 10,
                pagination: true,
                classes: 'table',
                columns: [{}, {},
                    {
                        field: 'operate',
                        title: 'Site Clearence',
                        align: 'center',
                        valign: 'middle',
                        clickToSelect: false,
                        formatter: function(value, row, index) {
                            return '<a target="_blank" href="/project/' + row.user_id + '/' + row.id +
                                '/siteclearence">Link</a>';
                        }
                    },
                    {
                        field: 'operate',
                        title: 'Action',
                        align: 'center',
                        valign: 'middle',
                        clickToSelect: false,
                        formatter: function(value, row, index) {
                            return '<div onclick=\'delete_project(' + row.id +
                                ')\' ><i class="fas fa-trash"></i></div> ';
                        }
                    }
                ]
            });
            $projects_table.bootstrapTable('refresh')
            document.getElementById('projects_table').style.visibility = "visible";
        }


        async function delete_project(project_id) {
            await $.ajax({
                url: "/projects/" + user_id + "/" + project_id,
                type: "DELETE",
                success: function(res) {
                    console.log(res);
                    $projects_table.bootstrapTable('refreshOptions', {
                        url: "/projects/" + user_id
                    });
                },
                error: function(err) {
                    console.log(err);
                },
            });
        }
    </script>
@stop
