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
                        is_updated: 0,
                        is_new: 0,
                        quanitity: 1,
                        difficulty_level: 0,
                        machine_type: 1,
                        machine_hours: 1,
                        machinery_co2e: 0,
                        spoil_transported_outside: 0,
                        total_quantity: 0,
                        mode_of_transport: 1,
                        unloading_destination: 2,
                        other_location: "Location",
                        other_location_distance: 100,
                        total_distance: 0,
                        transport_co2e: 0,
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
                            model: "quanitity",
                            help: "This is an other longer help text",
                            styleClasses: 'vgf-input-fixed',
                            required: true,
                            validator: VueFormGenerator.validators.number,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {

                                let bulking_factor = this.model.data.difficulty_data.bulking_factor == undefined ? 1 :
                                this.model.data.difficulty_data.bulking_factor;

                                let bulk_density = this.model.data.difficulty_data.bulk_density == undefined ? 1 :
                                this.model.data.difficulty_data.bulk_density;

                                let total_quantity = this.model.quanitity * 0.2 * bulking_factor * bulk_density;

                                this.model.total_quantity = total_quantity;

                                this.$parent.$parent.$parent.$emit("calculate", this);
                            }
                        }, {
                            type: "select",
                            label: "Difficulty Level",
                            model: "difficulty_level",
                            help: "This is an other longer help text",
                            styleClasses: 'bsat-tree-select',
                            required: true,
                            values: function() {
                                return field.difficulty_level;
                            },
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                model.data.difficulty_data = field.values().filter(i => i.id ==
                                    newVal)[0]

                                let bulking_factor = this.model.data.difficulty_data.bulking_factor == undefined ? 1 :
                                this.model.data.difficulty_data.bulking_factor;

                                let bulk_density = this.model.data.difficulty_data.bulk_density == undefined ? 1 :
                                this.model.data.difficulty_data.bulk_density;

                                let total_quantity = this.model.quanitity * 0.2 * bulking_factor * bulk_density;

                                this.model.total_quantity = total_quantity;
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            }
                        }, {
                            type: "awesome",
                            label: "Machinery",
                            model: "machine_type",
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
                            inputType: "number",
                            label: "CO2e(kg)",
                            model: "machinery_co2e",
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
                            model: "mode_of_transport",
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
                            model: "unloading_destination",
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
                            validator: VueFormGenerator.validators.number,
                            onChanged: function(model, newVal, oldVal, field, schema, details) {
                                this.$parent.$parent.$parent.$emit("calculate", this);
                            },
                            visible: function(model) {
                                if (model && model.spoil_transported_outside && model
                                    .unloading_destination == 1) {
                                    $('accordionSiteClearence').removeClass('bsat-accordion');
                                    $('accordionSiteClearence').addClass('bsat-accordion-lg');
                                } else {
                                    $('accordionSiteClearence').addClass('bsat-accordion');
                                    $('accordionSiteClearence').removeClass('bsat-accordion-lg');
                                }
                                return model && model.spoil_transported_outside && model
                                    .unloading_destination == 1;
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
                                    .unloading_destination == 1) {
                                    $('#accordionSiteClearence').removeClass('bsat-accordion');
                                    $('#accordionSiteClearence').addClass('bsat-accordion-lg');
                                } else {
                                    $('#accordionSiteClearence').addClass('bsat-accordion');
                                    $('#accordionSiteClearence').removeClass('bsat-accordion-lg');
                                }
                                return model && model.spoil_transported_outside && model
                                    .unloading_destination == 1;
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
                            inputType: "number",
                            label: "CO2e (kg)",
                            model: "transport_co2e",
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

                    this.model.machinery_co2e = this.model.machine_hours * difficulty_factor * machine_gwp;

                    if (this.model.spoil_transported_outside) {

                        // let total_quantity = this.model.quanitity * 0.2 * bulking_factor * bulk_density;

                        // this.model.total_quantity = total_quantity;

                        let distance_to_destination;
                        if (this.model.unloading_destination == 1) {

                            distance_to_destination = this.model.other_location_distance;

                        } else {

                            distance_to_destination = resources.distances.filter(i => i.destination_id == this.model.unloading_destination)[0].distance;

                        }
                        let no_trips = this.model.total_quantity / loading_capacity;

                        let total_distance = distance_to_destination * no_trips;
                        
                        this.model.total_distance = total_distance;

                        this.model.transport_co2e = this.model.total_quantity * distance_to_destination * transport_gwp;

                        this.total_co2e = this.model.machinery_co2e + this.model.transport_co2e;

                    } else {
                        this.total_co2e = this.model.machinery_co2e;
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
                getModals: function() {
                    var total = 0;

                    var models = this.$children.map(function(child) {
                        total = total + child.model.quanitity;
                        return child.model;
                    });

                    var resp = {
                        "total": total,
                        "models": models
                    }
                    const updatedModels = models.filter(item => item.is_updated);

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
    </script>

@stop
