@section('title', 'Manage Materials')
    @extends('layouts.layout')


@section('content')

    <style>
        /* .far .fa-edit:hover {
                                                                    color: blue !important;
                                                                    cursor: pointer !important;
                                                                } */

    </style>
    <h1>{{ session('user_id') }}</h1>
    <div style="padding: 2%">
        <div class="row">
            <div class="col-md-6">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" onclick="add_new_machinery()">
                    Add Machinery
                </button>

                <!-- Modal -->
                <div id="app">
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">@{{ title }}</h5>
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        onclick="$('#exampleModalCenter').modal('hide');">Close</button>
                                    <button type="button" class="btn btn-primary"
                                        v-on:click="save_machine">@{{ buttonTitle }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <span class="h4">Machines</span>
                    </div>
                    <div class="card-body">
                        <div id="toolbar">
                            <button id="remove" class="btn btn-danger" disabled>
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                        <table id="projects_table" data-unique-id="key" class="table">
                            <thead>
                                <tr>
                                    <th data-checkbox="true"></th>
                                    <th data-field="key" data-visible="false"></th>
                                    <th data-field="label">Name</th>
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
        var machines;
        var add_machine_modal = {
            is_new: 1,
            id: 1,
            label: "Name",
            countries: [],
            year: 2021,
            standard: "",
            data_source: "",
            technical_specification: "",
            gwp: 1,
            units: ""
        }


        var $remove = $('#remove')
        var selections = []


        Vue.component('treeselect', VueTreeselect.Treeselect);
        var user_id = {{ session('user_id') }};
        var project_id = {{ session('project_id') }};
        var new_machinery = new Vue({
            el: "#app",
            components: {
                "vue-form-generator": VueFormGenerator.component
            },

            data() {
                return {
                    title: 'Add New Machine',
                    buttonTitle: 'Add Machine',
                    model: add_machine_modal,
                    schema: {

                        fields: [{
                            type: "input",
                            inputType: "text",
                            label: "Name",
                            model: "label",
                            help: "This is an other longer help text",
                            // styleClasses: 'col-md-6',
                            required: true,
                            validator: VueFormGenerator.validators.string,
                        }, {
                            type: "treeSelect",
                            label: "Country",
                            model: "countries",
                            help: "This is an other longer help text",
                            // styleClasses: 'col-md-6',
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
                            max: new Date().getFullYear(),
                            min: 1900,
                            // styleClasses: 'col-md-6',
                            required: true,
                            validator: VueFormGenerator.validators.number,
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "Standard",
                            model: "standard",
                            help: "This is an other longer help text",
                            // styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.string,
                        }, {
                            type: "textArea",
                            inputType: "text",
                            label: "Data Source",
                            model: "data_source",
                            help: "This is an other longer help text",
                            // styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.string,
                        }, {
                            type: "textArea",
                            inputType: "text",
                            label: "Technical Specification",
                            model: "technical_specification",
                            help: "This is an other longer help text",
                            // styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.string,
                        }, {
                            type: "input",
                            inputType: "number",
                            label: "Global Warming Potential",
                            model: "gwp",
                            min: 0.0001,
                            step: 0.0001,
                            help: "This is an other longer help text",
                            // styleClasses: 'col-md-6',
                            validator: VueFormGenerator.validators.number,
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "Units",
                            model: "units",
                            help: "This is an other longer help text",
                            // styleClasses: 'col-md-6',
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
                save_machine: function() {

                    // console.log('Validated');
                    // var validation = this.$refs.vfg.validate();

                    // if (validation) {
                        if (this.is_new) {
                            axios.post('/project/' + user_id + '/' + project_id + '/machines', this.model)
                                .then(response => {
                                    console.log(response.data);
                                    $('#exampleModalCenter').modal('hide');
                                    console.log(response.data);
                                    machines = response.data;

                                    $projects_table.bootstrapTable('refreshOptions', {
                                        url: '/project/' + user_id + '/' + project_id +
                                            '/machines'
                                    });
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                        } else {
                            axios.put('/project/' + user_id + '/' + project_id + '/machines', this.model)
                                .then(response => {
                                    console.log(response.data);
                                    $('#exampleModalCenter').modal('hide');
                                    machines = response.data;
                                    $projects_table.bootstrapTable('refreshOptions', {
                                        url: '/project/' + user_id + '/' + project_id + '/machines'
                                    });
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                        }
                    // }
                },
                onValidated(isValid, errors) {
                    console.log("Validation result: ", isValid, ", Errors:", errors);
                }
            },
        });

        get_machines();

        var $projects_table = $('#projects_table');
        async function get_machines() {
            await $.ajax({
                url: '/project/' + user_id + '/' + project_id + '/machines',
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                complete: function complete() {},
                success: function success(result) {
                    machines = result;
                    console.log(result);
                    populate_machines(result);
                },
                error: function error() {
                    console.log("error");
                }
            });
        };

        function populate_machines(machines) {

            $projects_table.bootstrapTable({
                data: machines,
                pageSize: 10,
                pagination: true,
                classes: 'table',
                columns: [{}, {}, {},
                    {
                        field: 'operate',
                        title: 'Site Clearence',
                        align: 'center',
                        valign: 'middle',
                        clickToSelect: false,
                        formatter: function(value, row, index) {
                            return '';
                        }
                    },
                    {
                        field: 'operate',
                        title: 'Action',
                        align: 'center',
                        valign: 'middle',
                        clickToSelect: false,
                        formatter: function(value, row, index) {
                            return '<div class="container float-left"><span onclick=\'edit_machine("' + row
                                .key +
                                '")\' ><i class="far fa-edit"></i></span> <span onclick=\'delete_machine("' +
                                row.key +
                                '")\' ><i class="fas fa-trash"></i></span></span> ';
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

        function edit_machine(key) {
            let machine_model = machines.filter(i => i.key == key)[0]
            console.log(machines)
            console.log(machine_model)
            this.new_machinery.title = "Update Machinery";
            this.new_machinery.buttonTitle = "Update Machine";
            this.new_machinery.model = machine_model;
            this.new_machinery.is_new = 0;
            console.log('ffff')
            $('#exampleModalCenter').modal('show');
        }

        async function delete_machine(id) {
            await $.ajax({
                url: '/project/' + user_id + '/' + project_id + '/machines/' + id,
                type: "DELETE",
                success: function(res) {
                    console.log(res);
                    $projects_table.bootstrapTable('refreshOptions', {
                        url: '/project/' + user_id + '/' + project_id + '/machines'
                    });
                    $('#exampleModalCenter').modal('hide');
                },
                error: function(err) {
                    console.log(err);
                },
            });
        }

        function add_new_machinery() {
            this.new_machinery.title = "Add New Machine";
            this.new_machinery.buttonTitle = "Add Machine";
            this.new_machinery.is_new = 1;
            $('#exampleModalCenter').modal('show');
        }

        $projects_table.on('check.bs.table uncheck.bs.table ' +
            'check-all.bs.table uncheck-all.bs.table',
            function() {
                $remove.prop('disabled', !$projects_table.bootstrapTable('getSelections').length)

                // save your data, here just save the current page
                selections = getIdSelections()
                // push or splice the selections if you want to save all data selections
            })
        $projects_table.on('all.bs.table', function(e, name, args) {
            console.log(name, args)
        })
        $remove.click(function() {
            var ids = getIdSelections()
            $projects_table.bootstrapTable('remove', {
                field: 'key',
                values: ids
            })

            console.log(ids)

            axios.post('/project/' + user_id + '/' + project_id + '/machines/delete', {
                    "data": ids
                })
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });

            $remove.prop('disabled', true)
        })

        function getIdSelections() {
            return $.map($projects_table.bootstrapTable('getSelections'), function(row) {
                return row.key
            })
        }
    </script>
@stop
