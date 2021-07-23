@section('title', 'EarthWorks')
    @extends('layouts.layout')


@section('content')
    <style>
        .accordion-item {
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, .125);
            margin: 25px;
            border-top: 1px solid rgba(0, 0, 0, .125) !important;
        }

        .my-input-class {
            width: 20px !important;
        }

        .display-inline label {
            display: inline !important;
        }

        input[name="color"] {
            color: beige;
            margin: 10px;
            margin-left: 50px;
        }

        .danger {
            color: red;
        }

        .help>.icon {
            margin-bottom: 0px !important
        }

        .d-label {
            font-size: 13px;
            letter-spacing: 0.04em;
            font-weight: 400;
            margin-bottom: 4px;
            color: #777777;
        }

        .custom-col-md-1 {
            max-width: 100% !important;
            width: 135px !important;
            padding-left: 5px !important;
            padding-right: 5px !important;
        }

        [for='resource-location13214'] span:nth-of-type(1) {
            width: 80px;
            margin-top: -24px;
        }

        [for='transport-local-distance13214'] span:nth-of-type(1) {
            margin-top: -46px;
            width: 84px;
        }

        [for='transport-overseas-distance13214'] span:nth-of-type(1) {
            margin-top: -70px;
            width: 85px;
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

        .vue-treeselect__menu {
            max-height: 500px !important;
            width: 900px !important;
            overflow: auto !important;
        }

        .vue-treeselect__list {
            width: 1800px;
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
            padding: 1%;
            border-style: solid;
            background-color: #e7f1ff;
            margin-left: 10px;
            margin-bottom: 15px
        }

        .radio-list>label {
            margin: 10px;
        }

        .bsat-entry-btn {
            margin-left: 10px;
        }

    </style>
    <h1>{{ session('user_id') }}</h1>
    <button type="button" onclick="save_data()">Save</button>
    <div class="row">
        <div class="col-md-12">
            <div class="accordion bsat-accordion" id="accordionSiteClearence">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSiteClearence" aria-expanded="false"
                            aria-controls="collapseSiteClearence">
                            Site Clearence
                        </button>
                    </h2>
                </div>
                <div id="collapseSiteClearence" class="accordion-collapse collapse" aria-labelledby="accordionSiteClearence"
                    data-bs-parent="#accordionSiteClearence">
                    <div class="accordion-body">
                        <div id="app4">
                            <div v-for="field in fields" v-bind:is="field.type" :key="field.id" :field="field">
                            </div>
                            <button id="add_entry_btn" class="btn btn-outline-primary bsat-entry-btn"
                                v-on:click="addFormElement2">Add
                                Entry</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="form-textarea3">
        <div class="bsat-entry" :id="field.id" style="">
            <div style="text-align: right">
                <i class="fa fa-window-close" style="color: red" v-on:click="removeFormElement"></i>
            </div>
            <div>
                <vue-form-generator :schema="schema" :model="model" :options="formOptions" tag="div"
                    @model-updated="onModelUpdated" @validated="onValidated">
                </vue-form-generator>
            </div>
        </div>
    </template>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var user_id = {{ session('user_id') }};
        var project_id = {{ session('project_id') }};
        var resources;
        (async function() {
            await $.ajax({
                url: "/earthworks/resources/" + user_id + "/" + project_id,
                type: "GET",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                complete: function complete() {},
                success: function success(result) {
                    resources = result;
                },
                error: function error() {
                    console.log("error");
                }
            });
        })();

        Vue.component('treeselect', VueTreeselect.Treeselect);

        Vue.component('form-textarea3', {
            template: '#form-textarea3',
            props: ['field'],
            components: {
                "vue-form-generator": VueFormGenerator.component
            },

            data: function() {
                var field = this.field;
                return {
                    model: {
                        id: 0,
                        is_updated: 0,
                        is_new: 1,
                        quantity: 1,
                        difficulty_level_id: 0,
                        machinery_id: 1,
                        machine_hours: 1,
                        machinery_co2e: 0,
                        machinery_co2e_label: 0,
                        spoil_transported_outside: 0,
                        total_quantity: 0,
                        spoil_transport_vehicle_id: 1,
                        location_id: 2,
                        other_location: "Location",
                        other_location_distance: 100,
                        total_distance: 0,
                        transport_co2e: 0,
                        transport_co2e_label: 0,
                        total_co2e: 0,
                        data: {
                            difficulty_data: 1,
                            machine_data: 1,
                            transport_data: 1,
                        }
                    },
                    schema: {
                        fields: [{
                            type: "input",
                            inputType: "number",
                            label: "Quantity(&#13221;)",
                            model: "quantity",
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            required: true,
                            validator: VueFormGenerator.validators.number,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {

                                let bulking_factor = this.model.data.difficulty_data
                                    .bulking_factor == undefined ? 1 :
                                    this.model.data.difficulty_data.bulking_factor;

                                let bulk_density = this.model.data.difficulty_data.bulk_density ==
                                    undefined ? 1 :
                                    this.model.data.difficulty_data.bulk_density;

                                let total_quantity = this.model.quantity * 0.2 * bulking_factor *
                                    bulk_density;

                                this.model.total_quantity = truncateFloat(total_quantity, 2);

                                console.log(total_quantity)
                                console.log('mmmk')

                                this.$parent.$parent.$parent.$emit("calculate", this);
                            }
                        }, {
                            type: "select",
                            label: "Difficulty Level",
                            model: "difficulty_level_id",
                            help: "This is an other longer help text",
                            styleClasses: 'bsat-tree-select',
                            required: true,
                            values: function() {
                                return field.difficulty_level;
                            },
                            onChanged: function(model, newVal, oldVal, field, schema, details) {

                                model.data.difficulty_data = field.values().filter(i => i.id ==
                                    newVal)[0]

                                let bulking_factor = this.model.data.difficulty_data
                                    .bulking_factor == undefined ? 1 :
                                    this.model.data.difficulty_data.bulking_factor;

                                let bulk_density = this.model.data.difficulty_data.bulk_density ==
                                    undefined ? 1 :
                                    this.model.data.difficulty_data.bulk_density;

                                let total_quantity = this.model.quantity * 0.2 * bulking_factor *
                                    bulk_density;

                                this.model.total_quantity = truncateFloat(total_quantity, 2);
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            }
                        }, {
                            type: "awesome",
                            label: "Machinery",
                            model: "machinery_id",
                            help: "This is an other longer help text",
                            styleClasses: 'bsat-tree-select',
                            required: true,
                            values: function() {
                                return field.machines;
                            },
                            onChanged: function(model, newVal, oldVal, field, schema) {
                                model.data.machine_data = field.values().filter(i => i.id ==
                                    newVal)[0]
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            }
                        }, {
                            type: "input",
                            inputType: "number",
                            label: "Machine Hours",
                            model: "machine_hours",
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            required: true,
                            validator: VueFormGenerator.validators.number,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            }
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "CO2e(kg)",
                            model: "machinery_co2e_label",
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            readonly: true,
                        }, {
                            type: "radios",
                            label: "Spoil Transported Outside",
                            model: "spoil_transported_outside",
                            values: [{
                                    name: "Yes",
                                    value: 1
                                },
                                {
                                    name: "No",
                                    value: 0
                                },
                            ],
                            help: "This is an other longer help text",
                            styleClasses: 'col-md-12 display-inline',
                            required: true,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            }
                        }, {
                            type: "input",
                            inputType: "number",
                            label: "Total Quantity",
                            model: "total_quantity",
                            min: 1,
                            step: 0.01,
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            required: true,
                            validator: VueFormGenerator.validators.number,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            },
                            visible: function(model) {
                                return model && model.spoil_transported_outside;
                            }
                        }, {
                            type: "awesome",
                            label: "Mode of Transport",
                            model: "spoil_transport_vehicle_id",
                            help: "This is an other longer help text",
                            styleClasses: 'bsat-tree-select',
                            required: true,
                            valueFormat: "object",
                            values: function() {
                                return field.vehicles;
                            },
                            onChanged: function(model, newVal, oldVal, field, schema) {

                                model.data.transport_data = field.values().filter(i => i.id ==
                                    newVal)[0]

                                this.$parent.$parent.$parent.$emit("calculate", this);
                            },
                            visible: function(model) {
                                return model && model.spoil_transported_outside;
                            }
                        }, {
                            type: "select",
                            label: "Unloading Destination",
                            model: "location_id",
                            styleClasses: 'bsat-tree-select',
                            help: "This is an other longer help text",
                            required: true,
                            values: function() {
                                return field.destinations;
                            },
                            onChanged: function(model, newVal, oldVal, field) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            },
                            visible: function(model) {

                                return model && model.spoil_transported_outside;
                            }
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "Location",
                            model: "other_location",
                            min: 1,
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            required: true,
                            validator: VueFormGenerator.validators.string,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            },
                            visible: function(model) {
                                if (model && model.spoil_transported_outside && model
                                    .location_id == 1) {
                                    $('accordionSiteClearence').removeClass('bsat-accordion');
                                    $('accordionSiteClearence').addClass('bsat-accordion-lg');
                                } else {
                                    $('accordionSiteClearence').addClass('bsat-accordion');
                                    $('accordionSiteClearence').removeClass('bsat-accordion-lg');
                                }
                                return model && model.spoil_transported_outside && model
                                    .location_id == 1;
                            }
                        }, {
                            type: "input",
                            inputType: "number",
                            label: "Distance",
                            model: "other_location_distance",
                            min: 1,
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            required: true,
                            validator: VueFormGenerator.validators.number,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            },
                            visible: function(model) {
                                if (model && model.spoil_transported_outside && model
                                    .location_id == 1) {
                                    $('#accordionSiteClearence').removeClass('bsat-accordion');
                                    $('#accordionSiteClearence').addClass('bsat-accordion-lg');
                                } else {
                                    $('#accordionSiteClearence').addClass('bsat-accordion');
                                    $('#accordionSiteClearence').removeClass('bsat-accordion-lg');
                                }
                                return model && model.spoil_transported_outside && model
                                    .location_id == 1;
                            }
                        }, {
                            type: "input",
                            inputType: "number",
                            label: "Total Distance",
                            model: "total_distance",
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            readonly: true,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            },
                            visible: function(model) {
                                return model && model.spoil_transported_outside;
                            }
                        }, {
                            type: "input",
                            inputType: "text",
                            label: "CO2e (kg)",
                            model: "transport_co2e_label",
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            readonly: true,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            },
                            visible: function(model) {
                                return model && model.spoil_transported_outside;
                            }
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
                this.$on('calculate', this.calculate);
            },

            methods: {
                onModelUpdated(newVal, schema) {
                    this.model.is_updated = 1;
                },
                removeFormElement: function() {
                    const id = this.$vnode.key;
                    this.$parent.$emit('removeFormElement', id);
                },
                addFormElement: function() {
                    this.$parent.$emit('addFormElement2');
                },
                node_value(node) {
                    console.log(node);
                },
                itemInfo(node) {
                    console.log(node);
                },
                calculate() {

                    let difficulty_factor = this.model.data.difficulty_data.difficulty_factor == undefined ? 1 :
                        this.model.data.difficulty_data.difficulty_factor;

                    let bulking_factor = this.model.data.difficulty_data.bulking_factor == undefined ? 1 :
                        this.model.data.difficulty_data.bulking_factor;

                    let bulk_density = this.model.data.difficulty_data.bulk_density == undefined ? 1 :
                        this.model.data.difficulty_data.bulk_density;

                    let machine_gwp = this.model.data.machine_data.gwp == undefined ? 1 :
                        this.model.data.machine_data.gwp;

                    let transport_gwp = this.model.data.transport_data.gwp == undefined ? 1 :
                        this.model.data.transport_data.gwp;

                    let loading_capacity = this.model.data.transport_data.loading_capacity == undefined ? 1 :
                        this.model.data.transport_data.loading_capacity;

                    this.model.machinery_co2e = truncateFloat(this.model.machine_hours * difficulty_factor *
                        machine_gwp, 2);
                    this.model.machinery_co2e_label = parseExponential(this.model.machinery_co2e);
                    console.log(this.model.machinery_co2e)
                    if (this.model.spoil_transported_outside) {

                        // let total_quantity = this.model.quantity * 0.2 * bulking_factor * bulk_density;

                        // this.model.total_quantity = total_quantity;

                        let distance_to_destination;
                        if (this.model.location_id == 1) {

                            distance_to_destination = this.model.other_location_distance;

                        } else {

                            distance_to_destination = resources.distances.filter(i => i.destination_id == this.model.location_id)[0].distance;
                            this.model.other_location = "";
                            this.model.other_location_distance = 0;

                        }
                        let no_trips = this.model.total_quantity / loading_capacity;

                        let total_distance = distance_to_destination * no_trips;

                        this.model.total_distance = truncateFloat(total_distance, 2);

                        this.model.transport_co2e = truncateFloat(this.model.total_quantity *
                            distance_to_destination *
                            transport_gwp, 2);

                        console.log(this.model.transport_co2e)

                        this.model.transport_co2e_label = parseExponential(this.model.transport_co2e);


                        this.model.total_co2e = truncateFloat(this.model.machinery_co2e + this.model.transport_co2e,
                            2);

                    } else {
                        this.model.total_co2e = truncateFloat(this.model.machinery_co2e, 2);
                    }

                },
                onValidated(isValid, errors) {

                    $('#add_entry_btn').prop('disabled', true)

                    if (isValid) {
                        $('#add_entry_btn').prop('disabled', false)
                    }
                }
            },
        });


        var site_clearence = new Vue({
            el: '#app4',
            data: {
                fields: [],
                count: 0,
                difficulty_level: []
            },
            mounted() {
                this.$on('removeFormElement', this.removeFormElement);
                this.$on('addFormElement2', this.addFormElement2);
                this.getDifficultyLevels(this.difficulty_level);
                // getResources();

                axios.get('/project/1/3/earthworks/entries')
                    .then(response => {
                        console.log(response.data);
                        this.generateModels(response.data);
                    })
                    .catch(error => {
                        console.log(error);
                    });
                // $.ajax({
                //     url: "/project/1/3/earthworks/entries",
                //     type: "GET",
                //     headers: {
                //         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                //             "content"
                //         ),
                //     },
                //     complete: function complete() {},
                //     success: function success(response) {
                //         console.log(response);
                //         this.generateModels(response);
                //     },
                //     error: function error() {
                //         console.log("error");
                //     }
                // });

            },
            methods: {
                addFormElement2: function() {
                    this.fields.push({
                        'type': 'form-textarea3',
                        'id': this.count++,
                        'difficulty_level': resources.site_clearence_difficulty,
                        'destinations': resources.destinations,
                        'machines': resources.machinery,
                        'vehicles': resources.vehicles,
                    })
                },
                addFormElement5: function(type) {
                    store.setData([{
                        name: "Sebastian Vettel",
                        id: "5",
                        group: "Formula 1"
                    }])
                },
                removeFormElement: function(id) {
                    const index = this.fields.findIndex(f => f.id === id);

                    this.fields.splice(index, 1);
                },
                generateModels: function(models) {
                    console.log(models)
                    models.forEach((model) => {
                        this.fields.push({
                            'type': 'form-textarea3',
                            'id': this.count++,
                            'model': model,
                            'difficulty_level': resources.site_clearence_difficulty,
                            'destinations': resources.destinations,
                            'machines': resources.machinery,
                            'vehicles': resources.vehicles,
                        })
                    })
                },
                getModals: function() {
                    let total_machinery_co2e = 0;
                    let total_transport_co2e = 0;

                    let models = this.$children.map(function(child) {
                        total_machinery_co2e = total_machinery_co2e + child.model.machinery_co2e;
                        total_transport_co2e = total_transport_co2e + child.model.transport_co2e;
                        return child.model;
                    });

                    const updatedModels = models.filter(item => item.is_updated && !item.is_new);
                    const newModels = models.filter(item => item.is_new);

                    let resp = {
                        "sub_phase": 1,
                        "total_machinery_co2e": total_machinery_co2e,
                        "total_transport_co2e": total_transport_co2e,
                        "new_entries": newModels,
                        "updated_entries": updatedModels,
                    }

                    return resp;
                },
                async getDifficultyLevels(difficulty_level) {
                    await $.ajax({
                        url: "/earthworks/difficulty/siteclearence",
                        type: "GET",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        complete: function complete() {},
                        success: function success(result) {
                            difficulty_level.push(result);
                        },
                        error: function error() {
                            console.log("error");
                        }
                    });
                },
            }
        })

        async function save_data() {
            var site_clearence_data = site_clearence.getModals();
            console.log(site_clearence_data)

            await $.ajax({
                url: "/project/" + user_id + "/" + project_id + "/earthworks",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                contentType: 'application/json',
                data: JSON.stringify(site_clearence_data),
                dataType: "json",
                complete: function complete() {
                    console.log("save_data complete");
                },
                success: function success(result) {
                    console.log("save_data success");
                },
                error: function error() {
                    console.log("error");
                }
            });
        }

        // function truncateFloat(float, n) {
        //     var num = ((float * n) / n).toFixed(2);
        //     return parseFloat(num);
        // }

        //TODO:: check for value conversions
        function parseExponential(number) {
            return (number).toExponential(2);
        }

        function truncateFloat(str, val) {
            str = str.toString();
            if (str.indexOf(".") != -1) {
                str = str.slice(0, (str.indexOf(".")) + val + 1);
            }
            return Number(str);
        }
    </script>

@stop
