@section('title', 'Sign Up')
    @extends('layouts.layout')


@section('content')
    <style>
        .newsletter-container {}

        .radio-list {
            margin: 10px !important;
        }

    </style>

    <div class="container bg-light rounded-3 col-md-4" style="margin-top:20px;">
        <div id="app">
            <form action="/signup" method="POST" enctype="multipart/form-data">
                <vue-form-generator class="row" tag="div" :schema="schema" :model="model" :options="formOptions">
                </vue-form-generator>
                <div class="row" style="justify-content: flex-end;">
                    <div class="col-md-6">
                        <button class="btn btn-secondary" v-on:click="cancel">Cancel</button>
                        <button class="btn btn-warning" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>

        var vm = new Vue({
            el: "#app",

            components: {
                "vue-form-generator": VueFormGenerator.component
            },

            data() {
                return {
                    model: {
                        id: 1,
                        name: "45",
                        email: "45",
                        user_type: 35,
                        company: "35",
                        number: 35,
                        country: 35,
                        password: "John Doe",
                        city: "35ggg",
                        newsletter: 1,
                        cpassword: 1,
                        mpassword: 1,
                        password_confirm: 1,
                        password1: "",
                        password: "",
                    },
                    schema: {

                        fields: [{
                                type: "input",
                                inputType: "text",
                                label: "Full Name",
                                model: "name",
                                inputName: "name",
                                readonly: false,
                                featured: true,
                                required: true,
                                disabled: false,
                                placeholder: "User's name",
                                styleClasses: 'col-md-6 px-2',
                                validator: VueFormGenerator.validators.string
                            },
                            {
                                type: "input",
                                inputType: "email",
                                label: "Bussiness Email",
                                model: "email",
                                inputName: "email",
                                readonly: false,
                                featured: true,
                                required: true,
                                disabled: false,
                                placeholder: "User's name",
                                styleClasses: 'col-md-6 px-2',
                                validator: VueFormGenerator.validators.string
                            }, {
                                type: "select",
                                label: "User Type",
                                model: "user_type",
                                inputName: "user_type",
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
                            },
                            {
                                type: "input",
                                inputType: "text",
                                label: "Company / Organization",
                                model: "company",
                                inputName: "company",
                                readonly: false,
                                featured: true,
                                required: true,
                                disabled: false,
                                placeholder: "User's name",
                                styleClasses: 'col-md-6 px-2',
                                validator: VueFormGenerator.validators.string
                            }, {
                                type: "input",
                                inputType: "number",
                                label: "Phone Number",
                                model: "number",
                                inputName: "number",
                                min: 18,
                                validator: VueFormGenerator.validators.number,
                                styleClasses: 'col-md-6 px-2',
                            }, {
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
                                type: "input",
                                inputType: "password",
                                label: "Password",
                                model: "password",
                                inputName: "password",
                                min: 5,
                                validator: VueFormGenerator.validators.password,
                                styleClasses: 'col-md-6 px-2',
                            }, {
                                type: "input",
                                inputType: "password",
                                label: "Confirm Password",
                                model: "cpassword",
                                inputName: "password",
                                min: 5,
                                equals: 'password',
                                validator: ['string', isEqualTo],
                                styleClasses: 'col-md-6 px-2',
                            }, {
                                type: "input",
                                inputType: "text",
                                label: "City",
                                model: "city",
                                inputName: "city",
                                validator: VueFormGenerator.validators.string,
                                styleClasses: 'col-md-6 px-2',
                            },
                            {
                                type: "radios",
                                label: "Want to stay connected with us?",
                                model: "newsletter",
                                inputName: "newsletter",
                                values: [
                                    "Yes, inform me about newsletter and special offers.",
                                    "No, thank you I will receive only service emails.",
                                ],
                                styleClasses: 'newsletter-container'
                            }
                        ]
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
                },
                createProject: function() {
                    console.log('createProject');
                    var form_data = new FormData();
                    var data_model = vm.model;
                    for (var key in data_model) {
                        form_data.append(key, data_model[key]);
                    }

                    console.log(vm.model);
                    postData('/projects/' + vm.model.id, form_data)
                        .then(data => {
                            console.log(data); // JSON data parsed by `data.json()` call
                        });
                }
            },
        });

        function isEqualTo(value, field, model) {
            if (field.equals == undefined)
                return ['invalid field schema, missing `equals` property'];
            let a = model[field.equals];
            if (value == a)
                return [];
            return ['strings do not match'];
        }

    </script>

@stop
