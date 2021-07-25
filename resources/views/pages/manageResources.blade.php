@section('title', 'Manage Materials')
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
                        <div class="modal-content" id="app">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Add New Machine</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <vue-form-generator class="row" tag="div" :schema="schema" :model="model"
                                                :options="formOptions">
                                            </vue-form-generator>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" v-on:click="add_machine">Add Machine</button>
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
        // (function() {
        //     $.ajax({
        //                 url: "/resources/countries",
        //                 type: "GET",
        //                 headers: {
        //                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
        //                         "content"
        //                     ),
        //                 },
        //                 complete: function complete() {},
        //                 success: function success(result) {
        //                     countries = result;
        //                     console.log('fs')
        //                 },
        //                 error: function error() {
        //                     console.log("error");
        //                 }
        //             })
        // })();

        var countries = [];
        Vue.component('treeselect', VueTreeselect.Treeselect);
        var user_id = {{ session('user_id') }};
        var project_id = "" //{{ session('project_id') }};
        var vm = new Vue({
            el: "#app",
            components: {
                "vue-form-generator": VueFormGenerator.component
            },

            data() {
                return {
                    model: {
                        id: 1,
                        label: "Name",
                        country_id: [],
                        year: 35,
                        standard: "",
                        data_source: "",
                        technical_specification: "",
                        gwp: 1,
                        units: ""
                    },
                    schema: {

                        fields: [{
                            type: "input",
                            inputType: "text",
                            label: "Name",
                            model: "label",
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-6',
                            required: true,
                            validator: VueFormGenerator.validators.string,
                        }, {
                            type: "treeSelect",
                            label: "Country",
                            model: "country_id",
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-6',
                            required: true,
                            values: function(model, schema) {
                                return []
                            },
                            options: [],
                            selectOptions: {
                                searchable: true,
                                multiple: true,
                                closeOnSelect: false,
                                clearable: true,
                                alwaysOpen: false,
                                clearOnSelect: false,
                                disableBranchNodes: true,
                                showInfoIcon: false,
                            }
                        }, {
                            type: "input",
                            inputType: "number",
                            label: "Year",
                            model: "year",
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-6',
                            required: true,
                            validator: VueFormGenerator.validators.number,
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "Standard",
                            model: "standard",
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.string,
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "Data Source",
                            model: "data_source",
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.string,
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "Technical Specification",
                            model: "technical_specification",
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.string,
                        }, {
                            type: "input",
                            inputType: "number",
                            label: "Global Warming Potential",
                            model: "gwp",
                            min: 0.0001,
                            step: 0.0001,
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.number,
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "Units",
                            model: "units",
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.string,
                        }]
                    },

                    formOptions: {
                        validateAfterLoad: true,
                        validateAfterChanged: true
                    }
                };
            },
            beforeMount() {
                axios.get('/resources/countries')
                    .then(response => {
                        console.log(response.data);
                        countries = response.data;
                        this.schema.fields[1].values = () => {
                            return countries;
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            methods: {
                cancel: function() {
                    console.log('cancel');
                },
                add_machine: function() {
                    console.log('add');
                }
            },
        });

        var $projects_table = $('#projects_table');
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
        };

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
                                '/earthworks">Link</a>';
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
