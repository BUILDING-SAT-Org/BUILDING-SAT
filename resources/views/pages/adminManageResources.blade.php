@section('title', 'Manage Resources')
@extends('layouts.layout')


@section('content')
    @include('popups.deleteResourceConfirmModal')
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
            max-height: 500px !important;
            width: 500px !important;
            overflow: auto !important;
        }

        .bsat-tree-select-md .vue-treeselect__list {
            width: 800px;
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

        .b-sat-subscript-two {
            font-size: 19px;
        }

        .b-sat-add-resource-btn-container {
            margin-top: 10px
        }

        table#bsatMaterialsTable > tbody > tr > td:nth-of-type(7) {
            width: 130px;
        }

        #collapseManageMaterials {
            width: 1500px;
        }

        .bsat-container {
            margin-top: 20px;
        }

        textarea#description {
            height: auto !important;
            resize: both;
        }

        div#accordionManageRecommendations {
            width: 700px;
        }

        .file {
            height: 34px !important;
        }

        .bsat-location-input {
            width: 400px;
        }
    </style>

    <div class="bsat-container">
        <div class="col-md-6 bsat-main-phase-description">
            <h2>Mange BSAT Resources</h2>
        </div>

        <div class="col-md-12">

            <!--  Manage Material Categories Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageCategories">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageCategories" aria-expanded="false"
                                aria-controls="collapseManageCategories">
                            <div class="bsat-sub-phase-label">Manage Material Categories</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageCategories" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageCategories"
                     data-bs-parent="#accordionManageCategories">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">Material Categories</span>
                            </div>
                            <div class="card-body">
                                <div id="categoriesToolbar">
                                    <button id="removeCategories" class="btn btn-danger" disabled
                                            onclick="deleteCategory(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatCategoriesTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#categoriesToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Category Name</th>
                                        <th data-field="is_salvage">Salvage</th>
                                        <th data-field="is_replaceable">Maintenance And Replacement</th>
                                        <th data-formatter="categoryEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addCategory">
                                Add Category
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Material Categories Accordion  -->

            <!--  Manage Mortar Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageMortar">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageMortar" aria-expanded="false"
                                aria-controls="collapseManageMortar">
                            <div class="bsat-sub-phase-label">Manage Mortar</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageMortar" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageMortar"
                     data-bs-parent="#accordionManageMortar">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">BSAT Mortar</span>
                            </div>
                            <div class="card-body">
                                <div id="mortarToolbar">
                                    <button id="removeMortar" class="btn btn-danger" disabled
                                            onclick="deleteMortar(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatMortarTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#mortarToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Mortar Name</th>
                                        <th data-field="mortar_percentage">Mortar Percentage</th>
                                        <th data-field="sand_bulking_factor">Sand Bulking Factor</th>
                                        <th data-field="sand_bulking_density">Sand Bulking Density</th>
                                        <th data-field="cement_bulking_factor">Cement Bulking Factor</th>
                                        <th data-field="cement_bulking_density">Cement Bulking Density</th>
                                        <th data-field="wastage">Wastage</th>
                                        <th data-field="service_life">Service Life</th>
                                        <th data-field="is_salvage">Salvage</th>
                                        <th data-field="is_replaceable">Maintenance And Replacement</th>
                                        <th data-formatter="mortarEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addMortar">
                                Add Mortar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Mortar Accordion  -->

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
                                <div id="materialToolbar">
                                    <button id="removeMaterials" class="btn btn-danger" disabled
                                            onclick="deleteMaterial(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatMaterialsTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#materialToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Material Name</th>
                                        <th data-field="category_label">Category</th>
                                        <th data-field="bulking_density">Bulking Density</th>
                                        <th data-field="bulking_factor">Bulking Factor</th>
                                        <th data-field="conversion_unit">Conversion Unit</th>
                                        <th data-field="wastage">Wastage</th>
                                        <th data-field="unit">Unit</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                        <th data-formatter="materialEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addMaterial">
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
                                <div id="machineryToolbar">
                                    <button id="removeMachinery" class="btn btn-danger" disabled
                                            onclick="deleteMachinery(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatMachineryTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#machineryToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Machine Name</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                        <th data-formatter="machineryEditActions" data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addMachinery">
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
                                <div id="vehiclesToolbar">
                                    <button id="removeVehicles" class="btn btn-danger" disabled
                                            onclick="deleteVehicle(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatVehiclesTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#vehiclesToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Vehicle Name</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                        <th data-formatter="vehicleEditActions" data-click-to-select="false">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addVehicle">
                                Add Vehicle
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Vehicles Accordion  -->

            <!--  Manage Electricity Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageElectricity">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageElectricity" aria-expanded="false"
                                aria-controls="collapseManageElectricity">
                            <div class="bsat-sub-phase-label">Manage Electricity</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageElectricity" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageElectricity"
                     data-bs-parent="#accordionManageElectricity">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">BSAT Electricity</span>
                            </div>
                            <div class="card-body">
                                <div id="electricityToolbar">
                                    <button id="removeElectricity" class="btn btn-danger" disabled
                                            onclick="deleteElectricity(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatElectricityTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#electricityToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Electricity Name</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                        <th data-formatter="electricityEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addElectricity">
                                Add Electricity
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Electricity Accordion  -->

            <!--  Manage Water Types Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageWaterTypes">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageWaterTypes" aria-expanded="false"
                                aria-controls="collapseManageWaterTypes">
                            <div class="bsat-sub-phase-label">Manage Water Types</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageWaterTypes" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageWaterTypes"
                     data-bs-parent="#accordionManageWaterTypes">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">BSAT Water Types</span>
                            </div>
                            <div class="card-body">
                                <div id="waterTypesToolbar">
                                    <button id="removeWaterType" class="btn btn-danger" disabled
                                            onclick="deleteWaterTypes(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatWaterTypesTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#waterTypesToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Water Type</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                        <th data-formatter="waterTypesEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addWaterType">
                                Add Water Type
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Water Types Accordion  -->

            <!--  Manage Waste Types Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageWasteTypes">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageWasteTypes" aria-expanded="false"
                                aria-controls="collapseManageWasteTypes">
                            <div class="bsat-sub-phase-label">Manage Waste Types</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageWasteTypes" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageWasteTypes"
                     data-bs-parent="#accordionManageWasteTypes">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">BSAT Waste Types</span>
                            </div>
                            <div class="card-body">
                                <div id="wasteTypesToolbar">
                                    <button id="removeWasteType" class="btn btn-danger" disabled
                                            onclick="deleteWasteTypes(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatWasteTypesTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#wasteTypesToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Waste Type</th>
                                        <th data-field="conversion_unit">Conversion Unit</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                        <th data-formatter="wasteTypesEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addWasteType">
                                Add Waste Type
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Waste Types Accordion  -->

            <!--  Manage Fuel Types Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageFuelTypes">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageFuelTypes" aria-expanded="false"
                                aria-controls="collapseManageFuelTypes">
                            <div class="bsat-sub-phase-label">Manage Fuel Types</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageFuelTypes" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageFuelTypes"
                     data-bs-parent="#accordionManageFuelTypes">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">BSAT Fuel Types</span>
                            </div>
                            <div class="card-body">
                                <div id="fuelTypesToolbar">
                                    <button id="removeFuelType" class="btn btn-danger" disabled
                                            onclick="deleteFuelTypes(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatFuelTypesTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#fuelTypesToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Fuel Type</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                        <th data-formatter="fuelTypesEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addFuelType">
                                Add Fuel Type
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Fuel Types Accordion  -->

            <!--  Manage Energy Types Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageEnergyTypes">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageEnergyTypes" aria-expanded="false"
                                aria-controls="collapseManageEnergyTypes">
                            <div class="bsat-sub-phase-label">Manage Energy Types</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageEnergyTypes" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageEnergyTypes"
                     data-bs-parent="#accordionManageEnergyTypes">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">BSAT Energy Types</span>
                            </div>
                            <div class="card-body">
                                <div id="energyTypesToolbar">
                                    <button id="removeEnergyType" class="btn btn-danger" disabled
                                            onclick="deleteEnergyTypes(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatEnergyTypesTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#energyTypesToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Energy Type</th>
                                        <th data-field="gwp">kg CO<span class="b-sat-subscript-two">&#x2082;</span> eq
                                        </th>
                                        <th data-formatter="energyTypesEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addEnergyType">
                                Add Energy Type
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Manage Energy Types Accordion  -->

            <!--  Manage Distances Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageDistances">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageDistances" aria-expanded="false"
                                aria-controls="collapseManageDistances">
                            <div class="bsat-sub-phase-label">Manage Distances</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageDistances" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageDistances"
                     data-bs-parent="#accordionManageDistances">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">Distances</span>
                            </div>
                            <div class="card-body">
                                <div id="distancesToolbar">
                                    <button id="removeDistance" class="btn btn-danger" disabled
                                            onclick="deleteDistances(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatDistancesTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#distancesToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="origin">Origin</th>
                                        <th data-field="destination">Destination</th>
                                        <th data-field="distance">Distance</th>
                                        <th data-formatter="distancesEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addDistance">
                                Add Distance
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Distances Accordion  -->

            <!--  Manage Locations Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageLocations">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageLocations" aria-expanded="false"
                                aria-controls="collapseManageLocations">
                            <div class="bsat-sub-phase-label">Manage Locations</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageLocations" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageLocations"
                     data-bs-parent="#accordionManageLocations">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">Locations</span>
                            </div>
                            <div class="card-body">
                                <div id="locationsToolbar">
                                    <button id="removeLocations" class="btn btn-danger" disabled
                                            onclick="deleteLocations(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatLocationsTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#locationsToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Label</th>
                                        <th data-formatter="locationsEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addLocation">
                                Add Location
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Locations Accordion  -->

            <!--  Manage Difficulty Level Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageDifficultyLevel">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageDifficultyLevel" aria-expanded="false"
                                aria-controls="collapseManageDifficultyLevel">
                            <div class="bsat-sub-phase-label">Manage Difficulty Level</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageDifficultyLevel" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageDifficultyLevel"
                     data-bs-parent="#accordionManageDifficultyLevel">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">Difficulty Level</span>
                            </div>
                            <div class="card-body">
                                <div id="difficultyLevelToolbar">
                                    <button id="removeDifficultyLevels" class="btn btn-danger" disabled
                                            onclick="deleteDifficultyLevels(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatDifficultyLevelsTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#difficultyLevelToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="name">Difficulty Level</th>
                                        <th data-field="sub_phase">Sub Phase</th>
                                        <th data-field="difficulty_factor">Difficulty Factor</th>
                                        <th data-field="bulking_density">Bulking Density</th>
                                        <th data-field="bulking_factor">Bulking Factor</th>
                                        <th data-formatter="difficultyLevelsEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addDifficultyLevel">
                                Add Difficulty Level
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Difficulty Level Accordion  -->

            <!--  Manage Recommendations Accordion  -->
            <div class="accordion bsat-accordion" id="accordionManageRecommendations">
                <div class="accordion-item bsat-accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseManageRecommendations" aria-expanded="false"
                                aria-controls="collapseManageRecommendations">
                            <div class="bsat-sub-phase-label">Manage Recommendations</div>
                        </button>
                    </h2>
                </div>
                <div id="collapseManageRecommendations" class="accordion-collapse collapse"
                     aria-labelledby="accordionManageRecommendations"
                     data-bs-parent="#accordionManageRecommendations">
                    <div class="accordion-body b-sat-accordion-body">
                        <div class="card">
                            <div class="card-header">
                                <span class="h4">Recommendations Level</span>
                            </div>
                            <div class="card-body">
                                <div id="recommendationsToolbar">
                                    <button id="removeRecommendations" class="btn btn-danger" disabled
                                            onclick="deleteRecommendations(true, null)">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                                <table id="bsatRecommendationsTable"
                                       data-unique-id="id"
                                       class="table"
                                       data-search="true"
                                       data-toolbar="#recommendationsToolbar"
                                       data-click-to-select="true">
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-visible="false"></th>
                                        <th data-field="state" data-checkbox="true"></th>
                                        <th data-field="label">Title</th>
                                        <th data-formatter="recommendationsEditActions"
                                            data-click-to-select="false">Action
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="b-sat-add-resource-btn-container">
                            <button type="button" class="btn btn-primary" id="addRecommendation">
                                Add Recommendation
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Recomendations Accordion  -->

        </div>


        <div id="dataModalApp">
            <div class="modal fade" id="dataModal" tabindex="-1" role="dialog"
                 aria-labelledby="dataModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" v-bind:class="modalCss" role="document">
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
                                                <vue-form-generator :schema="schema" :model="model"
                                                                    :options="formOptions"
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
    </div>

    <script>
        let projectsTable = $('#projects_table');
        let resources;
        let bsatMaterials;
        let bsatMachines;
        let bsatVehicles;
        let bsatMaterialCategorySchema;
        let bsatMaterialSchema;
        let bsatMachinerySchema;
        let bsatVehicleSchema;
        let bsatMaterialCategories;
        let bsatMortars;
        let bsatMortarSchema;
        let bsatElectricity;
        let bsatElectricitySchema;
        let bsatWaterTypeSchema;
        let bsatWasteTypeSchema;
        let bsatFuelTypeSchema;
        let bsatEnergyTypeSchema;
        let bsatDistanceSchema;
        let bsatEditDistanceSchema;
        let bsatLocationsSchema;
        let bsatDifficultyLevelsSchema;
        let bsatRecommendationsSchema;

        let resourcesObj = {};

        const RESOURCE_ENDPOINTS = {
            materials: "/api/resources/materials",
            machines: "/api/resources/machines",
            vehicles: "/api/resources/vehicles",
            categories: "/api/resources/categories",
            mortars: "/api/resources/mortars",
            electricity: "/api/resources/electricity-types",
            water: "/api/resources/water-types",
            waste: "/api/resources/waste-types",
            fuel: "/api/resources/fuel-types",
            energy: "/api/resources/energy-types",
            locations: "/api/resources/locations",
            distances: "/api/resources/distances",
            difficultyLevel: "/api/resources/difficulty-levels",
            subPhases: "/api/resources/difficulty-levels/earth-works/sub-phases",
            countries: "/api/resources/countries",
            recommendations: "/api/resources/recommendations",
        };

        (function () {
            const promise1 = axios.get(RESOURCE_ENDPOINTS.materials);
            const promise2 = axios.get(RESOURCE_ENDPOINTS.machines);
            const promise3 = axios.get(RESOURCE_ENDPOINTS.vehicles);
            const promise4 = axios.get(RESOURCE_ENDPOINTS.countries);
            const promise5 = axios.get(RESOURCE_ENDPOINTS.categories);
            const promise6 = axios.get(RESOURCE_ENDPOINTS.mortars);
            const promise7 = axios.get(RESOURCE_ENDPOINTS.electricity);
            const promise8 = axios.get(RESOURCE_ENDPOINTS.water);
            const promise9 = axios.get(RESOURCE_ENDPOINTS.waste);
            const promise10 = axios.get(RESOURCE_ENDPOINTS.fuel);
            const promise11 = axios.get(RESOURCE_ENDPOINTS.energy);
            const promise12 = axios.get(RESOURCE_ENDPOINTS.locations);
            const promise13 = axios.get(RESOURCE_ENDPOINTS.distances);
            const promise14 = axios.get(RESOURCE_ENDPOINTS.difficultyLevel);
            const promise15 = axios.get(RESOURCE_ENDPOINTS.subPhases);
            const promise16 = axios.get(RESOURCE_ENDPOINTS.recommendations);

            Promise.all([promise1, promise2, promise3, promise4, promise5, promise6, promise7, promise8, promise9,
                promise10, promise11, promise12, promise13, promise14, promise15, promise16])
                .then
                (function (values) {
                    bsatMaterials = values[0].data;
                    resourcesObj.bsatMaterials = values[0].data;
                    resourcesObj.bsatMachines = values[1].data;
                    resourcesObj.bsatVehicles = values[2].data;
                    resourcesObj.countries = values[3].data;
                    resourcesObj.bsatMaterialCategories = values[4].data;
                    resourcesObj.bsatMortars = values[5].data;
                    resourcesObj.bsatElectricity = values[6].data;
                    resourcesObj.bsatWaterTypes = values[7].data;
                    resourcesObj.bsatWasteTypes = values[8].data;
                    resourcesObj.bsatFuelTypes = values[9].data;
                    resourcesObj.bsatEnergyTypes = values[10].data;
                    resourcesObj.bsatLocations = values[11].data;
                    resourcesObj.bsatDistances = values[12].data;
                    resourcesObj.bsatDifficultyLevels = values[13].data;
                    resourcesObj.bsatSubPhases = values[14].data;
                    resourcesObj.recommendations = values[15].data;

                    let materialsTable = generateResourceTable("bsatMaterialsTable", resourcesObj.bsatMaterials);
                    let machineryTable = generateResourceTable("bsatMachineryTable", resourcesObj.bsatMachines);
                    let vehiclesTable = generateResourceTable("bsatVehiclesTable", resourcesObj.bsatVehicles);
                    let categoriesTable = generateResourceTable("bsatCategoriesTable", resourcesObj.bsatMaterialCategories);
                    let mortarTable = generateResourceTable("bsatMortarTable", resourcesObj.bsatMortars);
                    let electricityTable = generateResourceTable("bsatElectricityTable", resourcesObj.bsatElectricity);
                    let waterTable = generateResourceTable("bsatWaterTypesTable", resourcesObj.bsatWaterTypes);
                    let wasteTable = generateResourceTable("bsatWasteTypesTable", resourcesObj.bsatWasteTypes);
                    let fuelTable = generateResourceTable("bsatFuelTypesTable", resourcesObj.bsatFuelTypes);
                    let energyTable = generateResourceTable("bsatEnergyTypesTable", resourcesObj.bsatEnergyTypes);
                    let distancesTable = generateResourceTable("bsatDistancesTable", resourcesObj.bsatDistances);
                    let locationsTable = generateResourceTable("bsatLocationsTable", resourcesObj.bsatLocations);
                    let difficultyLevelTable = generateResourceTable("bsatDifficultyLevelsTable", resourcesObj.bsatDifficultyLevels);
                    let recommendationsTable = generateResourceTable("bsatRecommendationsTable", resourcesObj
                        .recommendations);

                    mortarTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeMortar').prop('disabled', !mortarTable.bootstrapTable('getSelections').length)
                        });

                    categoriesTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeCategories').prop('disabled', !categoriesTable.bootstrapTable('getSelections').length)
                        });

                    materialsTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeMaterials').prop('disabled', !materialsTable.bootstrapTable('getSelections').length)
                        });

                    machineryTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeMachinery').prop('disabled', !machineryTable.bootstrapTable('getSelections').length)
                        });

                    vehiclesTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeVehicles').prop('disabled', !vehiclesTable.bootstrapTable('getSelections').length)
                        });

                    electricityTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeElectricity').prop('disabled', !electricityTable.bootstrapTable('getSelections').length)
                        });

                    waterTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeWaterType').prop('disabled', !waterTable.bootstrapTable('getSelections').length)
                        });

                    wasteTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeWasteType').prop('disabled', !wasteTable.bootstrapTable('getSelections').length)
                        });

                    fuelTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeFuelType').prop('disabled', !fuelTable.bootstrapTable('getSelections').length)
                        });

                    energyTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeEnergyType').prop('disabled', !energyTable.bootstrapTable('getSelections').length)
                        });

                    distancesTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeDistance').prop('disabled', !distancesTable.bootstrapTable('getSelections').length)
                        });

                    locationsTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeLocations').prop('disabled', !locationsTable.bootstrapTable('getSelections').length)
                        });

                    difficultyLevelTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeDifficultyLevels').prop('disabled', !difficultyLevelTable.bootstrapTable('getSelections').length)
                        });

                    recommendationsTable.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table',
                        function () {
                            $('#removeRecommendations').prop('disabled', !recommendationsTable.bootstrapTable('getSelections').length)
                        });


                    logToConsole("resp", {
                        userMaterials: resourcesObj.bsatMaterials,
                        userMachines: resourcesObj.bsatMachines,
                        userVehicles: resourcesObj.bsatVehicles,
                        countries: resourcesObj.countries,
                        bsatMaterialCategories: resourcesObj.bsatMaterialCategories,
                        bsatMortars: resourcesObj.bsatMortars,
                        bsatElectricity: resourcesObj.bsatElectricity,
                        water: resourcesObj.bsatWaterTypes,
                        waste: resourcesObj.bsatWasteTypes,
                        fuel: resourcesObj.bsatFuelTypes,
                        energy: resourcesObj.bsatEnergyTypes,
                        distances: resourcesObj.bsatDistances,
                        locations: resourcesObj.bsatLocations,
                        difficultyLevels: resourcesObj.bsatDifficultyLevels,
                        recommendations: resourcesObj.recommendations,
                    }, LOG_TYPES.HTTP_REQUEST);
                    init();
                    loadingOverlay.classList.add('hide-loader');
                });
        })();

        function mortarEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editMortar("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteMortar(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function categoryEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editCategory(' + row.id + ')\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteCategory(false,' + row.id + ')\'></i>' +
                '</div>'
            ].join('');
        }

        function materialEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editMaterial("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteMaterial(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function machineryEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editMachinery("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteMachinery(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function vehicleEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editVehicle("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteVehicle(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function electricityEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editElectricity("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteElectricity(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function waterTypesEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editWaterType("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteWaterTypes(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function wasteTypesEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editWasteType("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteWasteTypes(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function fuelTypesEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editFuelType("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteFuelTypes(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function energyTypesEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editEnergyType("' + row.id + '")\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteEnergyTypes(false,"' + row.id + '")\'></i>' +
                '</div>'
            ].join('');
        }

        function distancesEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editDistance(' + row.id + ')\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteDistances(false,' + row.id + ')\'></i>' +
                '</div>'
            ].join('');
        }

        function locationsEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editLocation(' + row.id + ')\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteLocations(false,' + row.id + ')\'></i>' +
                '</div>'
            ].join('');
        }

        function difficultyLevelsEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editDifficultyLevel(' + row.id + ')\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteDifficultyLevels(false,' + row.id + ')\'></i>' +
                '</div>'
            ].join('');
        }

        function recommendationsEditActions(value, row, index) {
            return [
                '<div><i class="fas fa-edit" style="cursor: pointer;"' +
                'onclick=\'editRecommendation(' + row.id + ')\'></i>' +
                '<i class="fas fa-trash" style="margin-left: 10px;cursor: pointer;" ' +
                'onclick=\'deleteRecommendations(false,' + row.id + ')\'></i>' +
                '</div>'
            ].join('');
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

            bsatMaterialCategorySchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMaterialCategorySchema.label,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialCategorySchema.label,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "checkbox",
                        label: BSAT_LABELS.bsatMaterialCategorySchema.salvage,
                        model: "is_salvage",
                        help: BSAT_TOOLTIPS.bsatMaterialCategorySchema.salvage,
                        default: false,
                        required: true,
                    }, {
                        type: "checkbox",
                        label: BSAT_LABELS.bsatMaterialCategorySchema.maintenanceReplacement,
                        model: "is_replaceable",
                        help: BSAT_TOOLTIPS.bsatMaterialCategorySchema.maintenanceReplacement,
                        default: false,
                        required: true,
                    }
                ]
            }

            bsatMaterialSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMaterialSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatMaterialSchema.category,
                        model: "category_id",
                        inputName: "category_id",
                        styleClasses: 'col-md-6 px-2 bsat-tree-select-md',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.category,
                        values: function () {
                            return resourcesObj.bsatMaterialCategories;
                        },
                        options: resourcesObj.bsatMaterialCategories,
                        selectOptions: {
                            type: "categories",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatMaterialSchema.country,
                        model: "countries",
                        inputName: "country",
                        styleClasses: 'col-md-3 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.country,
                        values: function () {
                            return resourcesObj.countries;
                        },
                        options: resourcesObj.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMaterialSchema.year,
                        model: "year",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMaterialSchema.standard,
                        model: "standard",
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.standard,
                        styleClasses: 'col-md-6 px-2',
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMaterialSchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMaterialSchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMaterialSchema.serviceLife,
                        model: "service_life",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.serviceLife,
                        required: true,
                        min: -1,
                        max: 10000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMaterialSchema.conversionUnit,
                        model: "conversion_unit",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.conversionUnit,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMaterialSchema.bulkingDensity,
                        model: "bulking_density",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.bulkingDensity,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMaterialSchema.bulkingFactor,
                        model: "bulking_factor",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.bulkingFactor,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMaterialSchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMaterialSchema.wastage,
                        model: "wastage",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.wastage,
                        required: true,
                        min: 0,
                        max: 100,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMaterialSchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-3 px-1',
                        help: BSAT_TOOLTIPS.bsatMaterialSchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            bsatMortarSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMortarSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatMortarSchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMortarSchema.mortarPercentage,
                        model: "mortar_percentage",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMortarSchema.mortarPercentage,
                        required: true,
                        validator: ["validatePercentage"]
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMortarSchema.sandBulkingFactor,
                        model: "sand_bulking_factor",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMortarSchema.sandBulkingFactor,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMortarSchema.sandBulkingDensity,
                        model: "sand_bulking_density",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMortarSchema.sandBulkingDensity,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMortarSchema.cementBulkingFactor,
                        model: "cement_bulking_factor",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMortarSchema.cementBulkingFactor,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMortarSchema.cementBulkingDensity,
                        model: "cement_bulking_density",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMortarSchema.cementBulkingDensity,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMortarSchema.wastage,
                        model: "wastage",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMortarSchema.wastage,
                        required: true,
                        min: 0,
                        max: 100,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMortarSchema.serviceLife,
                        model: "service_life",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMortarSchema.serviceLife,
                        required: true,
                        min: -1,
                        max: 10000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "checkbox",
                        label: BSAT_LABELS.bsatMortarSchema.salvage,
                        model: "is_salvage",
                        help: BSAT_TOOLTIPS.bsatMortarSchema.salvage,
                        default: false,
                        required: true,
                    }, {
                        type: "checkbox",
                        label: BSAT_LABELS.bsatMortarSchema.maintenanceReplacement,
                        model: "is_replaceable",
                        help: BSAT_TOOLTIPS.bsatMortarSchema.maintenanceReplacement,
                        default: false,
                        required: true,
                    }
                ]
            }

            bsatMachinerySchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMachinerySchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatMachinerySchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatMachinerySchema.country,
                        model: "countries",
                        inputName: "country",
                        styleClasses: 'col-md-3 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatMachinerySchema.country,
                        values: function () {
                            return resourcesObj.countries;
                        },
                        options: resourcesObj.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMachinerySchema.year,
                        model: "year",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatMachinerySchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMachinerySchema.standard,
                        model: "standard",
                        help: BSAT_TOOLTIPS.bsatMachinerySchema.standard,
                        styleClasses: 'col-md-6 px-2',
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMachinerySchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMachinerySchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatMachinerySchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatMachinerySchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatMachinerySchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-3 px-1',
                        help: BSAT_TOOLTIPS.bsatMachinerySchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: VERTICAL_ALIGINMENT_SPAN + BSAT_LABELS.bsatVehicleSchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }
                ]
            }

            bsatVehicleSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatVehicleSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatVehicleSchema.country,
                        model: "countries",
                        inputName: "country",
                        styleClasses: 'col-md-3 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.country,
                        values: function () {
                            return resourcesObj.countries;
                        },
                        options: resourcesObj.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatVehicleSchema.year,
                        model: "year",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatVehicleSchema.standard,
                        model: "standard",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.standard,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatVehicleSchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatVehicleSchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatVehicleSchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-3 px-1',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: VERTICAL_ALIGINMENT_SPAN + BSAT_LABELS.bsatVehicleSchema.loadingCapacity,
                        model: "loading_capacity",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.loadingCapacity,
                        required: true,
                        validator: ["validateLoadCapacity"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: VERTICAL_ALIGINMENT_SPAN + BSAT_LABELS.bsatVehicleSchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-3 px-2',
                        help: BSAT_TOOLTIPS.bsatVehicleSchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }
                ]
            }

            bsatElectricitySchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatElectricitySchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatElectricitySchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatElectricitySchema.country,
                        model: "countries",
                        inputName: "country",
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatElectricitySchema.country,
                        values: function () {
                            return resourcesObj.countries;
                        },
                        options: resourcesObj.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatElectricitySchema.year,
                        model: "year",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatElectricitySchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatElectricitySchema.standard,
                        model: "standard",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatElectricitySchema.standard,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatElectricitySchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatElectricitySchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatElectricitySchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatElectricitySchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatElectricitySchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatElectricitySchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatElectricitySchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatElectricitySchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            bsatWaterTypeSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWaterTypeSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatWaterTypeSchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatWaterTypeSchema.country,
                        model: "countries",
                        inputName: "country",
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatWaterTypeSchema.country,
                        values: function () {
                            return resourcesObj.countries;
                        },
                        options: resourcesObj.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatWaterTypeSchema.year,
                        model: "year",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWaterTypeSchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWaterTypeSchema.standard,
                        model: "standard",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWaterTypeSchema.standard,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWaterTypeSchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWaterTypeSchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWaterTypeSchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWaterTypeSchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWaterTypeSchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWaterTypeSchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatWaterTypeSchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWaterTypeSchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            bsatWasteTypeSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWasteTypeSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatWasteTypeSchema.country,
                        model: "countries",
                        inputName: "country",
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.country,
                        values: function () {
                            return resourcesObj.countries;
                        },
                        options: resourcesObj.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatWasteTypeSchema.year,
                        model: "year",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWasteTypeSchema.standard,
                        model: "standard",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.standard,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWasteTypeSchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWasteTypeSchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatWasteTypeSchema.conversionUnit,
                        model: "conversion_unit",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.conversionUnit,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatWasteTypeSchema.bulkingDensity,
                        model: "bulking_density",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.bulkingDensity,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatWasteTypeSchema.bulkingFactor,
                        model: "bulking_factor",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.bulkingFactor,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatWasteTypeSchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: VERTICAL_ALIGINMENT_SPAN + BSAT_LABELS.bsatWasteTypeSchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatWasteTypeSchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }
                ]
            }

            bsatFuelTypeSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatFuelTypeSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatFuelTypeSchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatFuelTypeSchema.country,
                        model: "countries",
                        inputName: "country",
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatFuelTypeSchema.country,
                        values: function () {
                            return resourcesObj.countries;
                        },
                        options: resourcesObj.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatFuelTypeSchema.year,
                        model: "year",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatFuelTypeSchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatFuelTypeSchema.standard,
                        model: "standard",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatFuelTypeSchema.standard,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatFuelTypeSchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatFuelTypeSchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatFuelTypeSchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatFuelTypeSchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatFuelTypeSchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatFuelTypeSchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatFuelTypeSchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatFuelTypeSchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            bsatEnergyTypeSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatEnergyTypeSchema.material,
                        model: "label",
                        readonly: false,
                        featured: false,
                        disabled: false,
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatEnergyTypeSchema.material,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatEnergyTypeSchema.country,
                        model: "countries",
                        inputName: "country",
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatEnergyTypeSchema.country,
                        values: function () {
                            return resourcesObj.countries;
                        },
                        options: resourcesObj.countries,
                        selectOptions: {
                            type: "countries",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatEnergyTypeSchema.year,
                        model: "year",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatEnergyTypeSchema.year,
                        required: true,
                        validator: ["validateYear"]
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatEnergyTypeSchema.standard,
                        model: "standard",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatEnergyTypeSchema.standard,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatEnergyTypeSchema.dataSource,
                        model: "data_source",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatEnergyTypeSchema.dataSource,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatEnergyTypeSchema.technicalSpecification,
                        model: "technical_specification",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatEnergyTypeSchema.technicalSpecification,
                        min: 2,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatEnergyTypeSchema.unit,
                        model: "unit",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatEnergyTypeSchema.unit,
                        required: true,
                        min: 1,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatEnergyTypeSchema.gwp,
                        model: "gwp",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatEnergyTypeSchema.gwp,
                        required: true,
                        max: 100000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            bsatDistanceSchema = {
                fields: [
                    {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatDistanceSchema.origin,
                        model: "origin_id",
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatDistanceSchema.origin,
                        values: function () {
                            return resourcesObj.bsatLocations;
                        },
                        options: resourcesObj.bsatLocations,
                        selectOptions: {
                            type: "origin",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                        onChanged: function (model, newVal, oldVal) {
                            if (model.destination_id !== undefined && model.destination_id !== null) {
                                let origin = resourcesObj.bsatLocations.filter((i) => i.id === newVal)[0];
                                let destination = resourcesObj.bsatLocations.filter((i) => i.id === model.destination_id)[0];
                                model.label = origin.label + "/" + destination.label;
                            }
                        }
                    }, {
                        type: "treeSelect",
                        label: BSAT_LABELS.bsatDistanceSchema.destination,
                        model: "destination_id",
                        styleClasses: 'col-md-6 px-2 bsat-tree-select',
                        help: BSAT_TOOLTIPS.bsatDistanceSchema.destination,
                        values: function () {
                            return resourcesObj.bsatLocations;
                        },
                        options: resourcesObj.bsatLocations,
                        selectOptions: {
                            type: "destination",
                            searchable: true,
                            closeOnSelect: true,
                            showInfoIcon: false,
                            closeOnLabelClick: true,
                        },
                        required: true,
                        validator: ["required"],
                        onChanged: function (model, newVal, oldVal) {
                            if (model.origin_id !== undefined && model.destination_id !== undefined) {
                                let origin = resourcesObj.bsatLocations.filter((i) => i.id === model.origin_id)[0];
                                let destination = resourcesObj.bsatLocations.filter((i) => i.id === newVal)[0];
                                model.label = origin.label + "/" + destination.label;
                            }
                        }
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatDistanceSchema.distance,
                        model: "distance",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatDistanceSchema.distance,
                        required: true,
                        min: 0,
                        max: 1000000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            bsatEditDistanceSchema = {
                fields: [
                    {
                        type: "customInput",
                        inputType: "text",
                        label: BSAT_LABELS.bsatDistanceSchema.origin,
                        model: "origin",
                        help: BSAT_TOOLTIPS.bsatDistanceSchema.origin,
                        styleClasses: 'col-md-6 px-2',
                        readonly: true,
                    }, {
                        type: "customInput",
                        inputType: "text",
                        label: BSAT_LABELS.bsatDistanceSchema.destination,
                        model: "destination",
                        help: BSAT_TOOLTIPS.bsatDistanceSchema.destination,
                        styleClasses: 'col-md-6 px-2',
                        readonly: true,
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatDistanceSchema.distance,
                        model: "distance",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatDistanceSchema.distance,
                        required: true,
                        min: 0,
                        max: 1000000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            bsatLocationsSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatLocationsSchema.label,
                        model: "label",
                        styleClasses: 'bsat-location-input col-md-12',
                        help: BSAT_TOOLTIPS.bsatDistanceSchema.label,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    },
                ]
            }

            bsatDifficultyLevelsSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatDifficultyLevelsSchema.name,
                        model: "name",
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatDifficultyLevelsSchema.name,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    }, {
                        type: "select",
                        label: BSAT_LABELS.bsatDifficultyLevelsSchema.subPhase,
                        model: "sub_phase_id",
                        help: BSAT_TOOLTIPS.bsatDifficultyLevelsSchema.subPhase,
                        styleClasses: 'col-md-6 px-2',
                        required: true,
                        values: function () {
                            return resourcesObj.bsatSubPhases;
                        },
                        validator: ["required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatDifficultyLevelsSchema.difficultyFactor,
                        model: "difficulty_factor",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatDifficultyLevelsSchema.difficultyFactor,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatDifficultyLevelsSchema.bulkingDensity,
                        model: "bulking_density",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatDifficultyLevelsSchema.bulkingDensity,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }, {
                        type: "input",
                        inputType: "number",
                        label: BSAT_LABELS.bsatDifficultyLevelsSchema.bulkingFactor,
                        model: "bulking_factor",
                        styleClasses: 'col-md-6 px-2',
                        help: BSAT_TOOLTIPS.bsatDifficultyLevelsSchema.bulkingFactor,
                        required: true,
                        min: 0,
                        max: 1000,
                        validator: ["number", "double", "required"],
                    }
                ]
            }

            bsatRecommendationsSchema = {
                fields: [
                    {
                        type: "input",
                        inputType: "text",
                        label: BSAT_LABELS.bsatRecommendationsSchema.label,
                        model: "label",
                        styleClasses: 'col-md-12 px-2',
                        help: BSAT_TOOLTIPS.bsatRecommendationsSchema.label,
                        required: true,
                        min: 5,
                        max: 150,
                        validator: ["string"],
                    },
                    {
                        type: "textArea",
                        label: BSAT_LABELS.bsatRecommendationsSchema.description,
                        model: "description",
                        help: BSAT_TOOLTIPS.bsatRecommendationsSchema.description,
                        hint: BSAT_LABELS.bsatRecommendationsSchema.hint,
                        min: 5,
                        max: 1500,
                        rows: 10,
                        required: true,
                        validator: ["string"],
                    },
                ]
            }

        }

        $("#addMaterial").click(function () {
            let bsatMaterialModel = {
                category_id: null,
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                service_life: null,
                conversion_unit: null,
                technical_specification: null,
                bulking_density: null,
                bulking_factor: null,
                gwp: null,
                unit: null,
                wastage: null
            };
            dataModal.modalCss = "modal-lg";
            addResource(resourcesObj, "bsatMaterials", "Add New Material", "Create", bsatMaterialModel, bsatMaterialSchema,
                RESOURCE_ENDPOINTS.materials, "bsatMaterialsTable");
        });

        $("#addCategory").click(function () {
            let bsatCategoryModel = {
                label: null,
                is_salvage: 0,
                is_replaceable: 0
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatMaterialCategories", "Add New Category", "Create", bsatCategoryModel, bsatMaterialCategorySchema,
                RESOURCE_ENDPOINTS.categories, "bsatCategoriesTable");
        });

        $("#addMortar").click(function () {
            let bsatMortarModel = {
                label: null,
                mortar_percentage: null,
                sand_bulking_factor: null,
                sand_bulking_density: null,
                cement_bulking_factor: null,
                cement_bulking_density: null,
                wastage: null,
                service_life: null,
                is_salvage: 0,
                is_replaceable: 0
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatMortars", "Add New Mortar", "Create", bsatMortarModel, bsatMortarSchema,
                RESOURCE_ENDPOINTS.mortars, "bsatMortarTable");
        });

        $("#addMachinery").click(function () {
            let bsatMachineryModel = {
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                technical_specification: null,
                gwp: null,
                unit: null
            };
            dataModal.modalCss = "modal-lg";
            addResource(resourcesObj, "bsatMachines", "Add New Machine", "Create", bsatMachineryModel, bsatMachinerySchema,
                RESOURCE_ENDPOINTS.machines, "bsatMachineryTable");
        });

        $("#addVehicle").click(function () {
            let bsatVehicleModel = {
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                technical_specification: null,
                gwp: null,
                unit: null
            };
            dataModal.modalCss = "modal-lg";
            addResource(resourcesObj, "bsatVehicles", "Add New Vehicle", "Create", bsatVehicleModel, bsatVehicleSchema,
                RESOURCE_ENDPOINTS.vehicles, "bsatVehiclesTable");
        });

        $("#addElectricity").click(function () {
            let bsatElectricityModel = {
                id: 1,
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                technical_specification: null,
                gwp: null,
                unit: null
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatElectricity", "Add New Electricity", "Create", bsatElectricityModel, bsatElectricitySchema,
                RESOURCE_ENDPOINTS.electricity, "bsatElectricityTable");
        });

        $("#addWaterType").click(function () {
            let bsatWaterModel = {
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                technical_specification: null,
                gwp: null,
                unit: null
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatWaterTypes", "Add New Water Type", "Create", bsatWaterModel, bsatWaterTypeSchema,
                RESOURCE_ENDPOINTS.water, "bsatWaterTypesTable");
        });

        $("#addWasteType").click(function () {
            let bsatWasteModel = {
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                conversion_unit: null,
                technical_specification: null,
                bulking_density: null,
                bulking_factor: null,
                gwp: null,
                unit: null
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatWasteTypes", "Add New Waste Type", "Create", bsatWasteModel,
                bsatWasteTypeSchema, RESOURCE_ENDPOINTS.waste, "bsatWasteTypesTable");
        });

        $("#addFuelType").click(function () {
            let bsatFuelModel = {
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                technical_specification: null,
                gwp: null,
                unit: null
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatFuelTypes", "Add New Fuel Type", "Create", bsatFuelModel, bsatFuelTypeSchema,
                RESOURCE_ENDPOINTS.fuel, "bsatFuelTypesTable");
        });

        $("#addEnergyType").click(function () {
            let bsatEnergyModel = {
                countries: null,
                label: null,
                year: null,
                standard: null,
                data_source: null,
                technical_specification: null,
                gwp: null,
                unit: null
            }
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatEnergyTypes", "Add New Energy Type", "Create", bsatEnergyModel, bsatEnergyTypeSchema,
                RESOURCE_ENDPOINTS.energy, "bsatEnergyTypesTable");
        });

        $("#addDistance").click(function () {
            let bsatDistanceModel = {
                origin_id: null,
                destination_id: null,
                distance: null,
                label: null,
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatDistances", "Add New Distance", "Create", bsatDistanceModel, bsatDistanceSchema,
                RESOURCE_ENDPOINTS.distances, "bsatDistancesTable");
        });

        $("#addLocation").click(function () {
            let bsatLocationModel = {
                label: null,
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatLocations", "Add New Locations", "Create", bsatLocationModel, bsatLocationsSchema,
                RESOURCE_ENDPOINTS.locations, "bsatLocationsTable");
        });

        $("#addDifficultyLevel").click(function () {
            let bsatDifficultyLevelModel = {
                name: null,
                sub_phase_id: null,
                difficulty_factor: null,
                bulking_density: null,
                bulking_factor: null,
            };
            dataModal.modalCss = "";
            addResource(resourcesObj, "bsatDifficultyLevels", "Add New Difficulty Level", "Create", bsatDifficultyLevelModel, bsatDifficultyLevelsSchema,
                RESOURCE_ENDPOINTS.difficultyLevel, "bsatDifficultyLevelsTable");
        });

        $("#addRecommendation").click(function () {
            let bsatRecommendationModel = {
                label: null,
                description: null,
            }
            dataModal.modalCss = "";
            addResource(resourcesObj, "recommendations", "Add New Recommendation", "Create", bsatRecommendationModel, bsatRecommendationsSchema,
                RESOURCE_ENDPOINTS.recommendations, "bsatRecommendationsTable");
        });

        function editCategory(id) {
            dataModal.modalCss = ""
            let category = resourcesObj.bsatMaterialCategories.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatMaterialCategories", id, "Update Category", "Update", category,
                bsatMaterialCategorySchema, RESOURCE_ENDPOINTS.categories, "bsatCategoriesTable");
        }

        function deleteCategory(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("category");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatCategoriesTable");
                    bsatMaterials = await deleteSelection(RESOURCE_ENDPOINTS.categories, selections, "bsatCategoriesTable");
                } else {
                    bsatMaterials = await deleteResource(RESOURCE_ENDPOINTS.categories, deleteConfirmModal.id, "bsatCategoriesTable")
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editMortar(id) {
            dataModal.modalCss = ""
            let mortar = resourcesObj.bsatMortars.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatMortars", id, "Update Mortar", "Update", mortar,
                bsatMortarSchema, RESOURCE_ENDPOINTS.mortars, "bsatMortarTable");
        }

        function deleteMortar(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("mortar");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatMortarTable");
                    bsatMortars = await deleteSelection(RESOURCE_ENDPOINTS.mortars, selections, "bsatMortarTable");
                } else {
                    bsatMortars = await deleteResource(RESOURCE_ENDPOINTS.mortars, deleteConfirmModal.id, "bsatMortarTable")
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editMaterial(id) {
            dataModal.modalCss = "modal-lg"
            let material = resourcesObj.bsatMaterials.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatMaterials", id, "Update Material", "Update", material,
                bsatMaterialSchema, RESOURCE_ENDPOINTS.materials, "bsatMaterialsTable");
        }

        function deleteMaterial(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("material");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatMaterialsTable");
                    bsatMaterials = await deleteSelection(RESOURCE_ENDPOINTS.materials, selections, "bsatMaterialsTable");
                } else {
                    bsatMaterials = await deleteResource(RESOURCE_ENDPOINTS.materials, deleteConfirmModal.id, "bsatMaterialsTable")
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editMachinery(id) {
            dataModal.modalCss = "modal-lg"
            let machinery = resourcesObj.bsatMachines.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatMachines", id, "Update Machinery", "Update", machinery,
                bsatMachinerySchema, RESOURCE_ENDPOINTS.machines, "bsatMachineryTable");
        }

        function deleteMachinery(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("machine");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatMachineryTable");
                    bsatMachines = await deleteSelection(RESOURCE_ENDPOINTS.machines, selections, "bsatMachineryTable");
                } else {
                    bsatMachines = await deleteResource(RESOURCE_ENDPOINTS.machines, deleteConfirmModal.id, "bsatMachineryTable")
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editVehicle(id) {
            dataModal.modalCss = "modal-lg"
            let vehicle = resourcesObj.bsatVehicles.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatVehicles", id, "Update Vehicle", "Update", vehicle,
                bsatVehicleSchema, RESOURCE_ENDPOINTS.vehicles, "bsatVehiclesTable");
        }

        function deleteVehicle(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("vehicle");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatVehiclesTable");
                    bsatVehicles = await deleteSelection(RESOURCE_ENDPOINTS.vehicles, selections, "bsatVehiclesTable");
                } else {
                    bsatVehicles = await deleteResource(RESOURCE_ENDPOINTS.vehicles, deleteConfirmModal.id, "bsatVehiclesTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editElectricity(id) {
            dataModal.modalCss = ""
            let electricity = resourcesObj.bsatElectricity.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatElectricity", id, "Update Electricity", "Update", electricity,
                bsatElectricitySchema, RESOURCE_ENDPOINTS.electricity, "bsatElectricityTable");
        }

        function deleteElectricity(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("electricity type");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatElectricityTable");
                    bsatElectricity = await deleteSelection(RESOURCE_ENDPOINTS.electricity, selections, "bsatElectricityTable");
                } else {
                    bsatElectricity = await deleteResource(RESOURCE_ENDPOINTS.electricity, deleteConfirmModal.id, "bsatElectricityTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editWaterType(id) {
            dataModal.modalCss = ""
            let waterType = resourcesObj.bsatWaterTypes.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatWaterTypes", id, "Update Water Type", "Update", waterType,
                bsatWaterTypeSchema, RESOURCE_ENDPOINTS.water, "bsatWaterTypesTable");
        }

        function deleteWaterTypes(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("water type");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatWaterTypesTable");
                    resourcesObj.bsatWaterTypes = await deleteSelection(RESOURCE_ENDPOINTS.water, selections, "bsatWaterTypesTable");
                } else {
                    resourcesObj.bsatWaterTypes = await deleteResource(RESOURCE_ENDPOINTS.water, deleteConfirmModal.id, "bsatWaterTypesTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editWasteType(id) {
            dataModal.modalCss = ""
            let wasteType = resourcesObj.bsatWasteTypes.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatWasteTypes", id, "Update Waste Type", "Update", wasteType,
                bsatWasteTypeSchema, RESOURCE_ENDPOINTS.waste, "bsatWasteTypesTable");
        }

        function deleteWasteTypes(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("waste type");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatWasteTypesTable");
                    resourcesObj.bsatWasteTypes = await deleteSelection(RESOURCE_ENDPOINTS.waste, selections,
                        "bsatWasteTypesTable");
                } else {
                    resourcesObj.bsatWasteTypes = await deleteResource(RESOURCE_ENDPOINTS.waste, deleteConfirmModal.id, "bsatWasteTypesTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editFuelType(id) {
            dataModal.modalCss = ""
            let fuelType = resourcesObj.bsatFuelTypes.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatFuelTypes", id, "Update Fuel Type", "Update", fuelType,
                bsatFuelTypeSchema, RESOURCE_ENDPOINTS.fuel, "bsatFuelTypesTable");
        }

        function deleteFuelTypes(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("fuel type");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatFuelTypesTable");
                    resourcesObj.bsatFuelTypes = await deleteSelection(RESOURCE_ENDPOINTS.fuel, selections,
                        "bsatFuelTypesTable");
                } else {
                    resourcesObj.bsatFuelTypes = await deleteResource(RESOURCE_ENDPOINTS.fuel, deleteConfirmModal.id, "bsatFuelTypesTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editEnergyType(id) {
            dataModal.modalCss = ""
            let energyType = resourcesObj.bsatEnergyTypes.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatEnergyTypes", id, "Update Energy Type", "Update", energyType,
                bsatEnergyTypeSchema, RESOURCE_ENDPOINTS.energy, "bsatEnergyTypesTable");
        }

        function deleteEnergyTypes(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("energy type");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatEnergyTypesTable");
                    resourcesObj.bsatEnergyTypes = await deleteSelection(RESOURCE_ENDPOINTS.energy, selections,
                        "bsatEnergyTypesTable");
                } else {
                    resourcesObj.bsatEnergyTypes = await deleteResource(RESOURCE_ENDPOINTS.energy, deleteConfirmModal.id, "bsatEnergyTypesTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editDistance(id) {
            dataModal.modalCss = ""
            let distances = resourcesObj.bsatDistances.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatDistances", id, "Update Distance", "Update", distances,
                bsatEditDistanceSchema, RESOURCE_ENDPOINTS.distances, "bsatDistancesTable");
        }

        function deleteDistances(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("distance");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatDistancesTable");
                    resourcesObj.bsatDistances = await deleteSelection(RESOURCE_ENDPOINTS.distances, selections,
                        "bsatDistancesTable");
                } else {
                    resourcesObj.bsatDistances = await deleteResource(RESOURCE_ENDPOINTS.distances, deleteConfirmModal.id, "bsatDistancesTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editLocation(id) {
            dataModal.modalCss = ""
            let location = resourcesObj.bsatLocations.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatLocations", id, "Update Location", "Update", location,
                bsatLocationsSchema, RESOURCE_ENDPOINTS.locations, "bsatLocationsTable");
        }

        function deleteLocations(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("location");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatLocationsTable");
                    resourcesObj.bsatLocations = await deleteSelection(RESOURCE_ENDPOINTS.locations, selections,
                        "bsatLocationsTable");
                } else {
                    resourcesObj.bsatLocations = await deleteResource(RESOURCE_ENDPOINTS.locations, deleteConfirmModal.id, "bsatLocationsTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editDifficultyLevel(id) {
            dataModal.modalCss = ""
            let difficultyLevel = resourcesObj.bsatDifficultyLevels.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatDifficultyLevels", id, "Update Difficulty Level", "Update", difficultyLevel,
                bsatDifficultyLevelsSchema, RESOURCE_ENDPOINTS.difficultyLevel, "bsatDifficultyLevelsTable");
        }

        function deleteDifficultyLevels(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("difficulty level");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatDifficultyLevelsTable");
                    resourcesObj.difficultyLevel = await deleteSelection(RESOURCE_ENDPOINTS.difficultyLevel, selections,
                        "bsatDifficultyLevelsTable");
                } else {
                    resourcesObj.difficultyLevel = await deleteResource(RESOURCE_ENDPOINTS.difficultyLevel, deleteConfirmModal.id, "bsatDifficultyLevelsTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function editRecommendation(id) {
            dataModal.modalCss = ""
            let recommendation = resourcesObj.recommendations.filter((i) => i.id === id)[0];
            editResource(resourcesObj, "bsatRecommendations", id, "Update Recommendations", "Update", recommendation,
                bsatRecommendationsSchema, RESOURCE_ENDPOINTS.recommendations, "bsatRecommendationsTable");
        }

        function deleteRecommendations(isMultiple, id) {
            deleteConfirmModal.id = id;
            deleteConfirmModal.isMultiple = isMultiple;
            deleteConfirmModal.message = createDeleteMessage("recommendation");
            deleteConfirmModal.confirm = async () => {
                if (deleteConfirmModal.isMultiple) {
                    let selections = getIdSelections("bsatRecommendationsTable");
                    resourcesObj.recommendations = await deleteSelection(RESOURCE_ENDPOINTS.recommendations, selections,
                        "bsatRecommendationsTable");
                } else {
                    resourcesObj.recommendations = await deleteResource(RESOURCE_ENDPOINTS.recommendations, deleteConfirmModal.id, "bsatRecommendationsTable");
                }
            }
            $("#deleteRecordConfirmModal").modal('show');
        }

        function addResource(obj, index, title, submitBtnText, model, schema, url, tableId) {
            dataModal.title = title;
            dataModal.submitBtnText = submitBtnText;
            dataModal.model = model;
            dataModal.schema = schema;

            dataModal.validateInfoModal = async function () {
                if (dataModal.$refs.dataModal.validate()) {
                    $('#dataModal').modal('hide');
                    obj[index] = await save(url, dataModal
                        .model, tableId);
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        function editResource(obj, index, id, title, submitBtnText, model, schema, url, tableId) {
            dataModal.title = title;
            dataModal.submitBtnText = submitBtnText;
            dataModal.model = model;
            dataModal.schema = schema;

            dataModal.validateInfoModal = async function () {
                if (dataModal.$refs.dataModal.validate()) {
                    $('#dataModal').modal('hide');
                    obj[index] = await update(url, id, dataModal.model, tableId);
                } else {
                    errorToast('Fill All Required Fields!');
                }
            }
            $('#dataModal').modal('show');
        }

        async function deleteSelection(url, data, elem) {
            $("#deleteRecordConfirmModal").modal('hide');
            return await axios.post(url + "/delete", {ids: data})
                .then(response => {
                    refreshTable(elem, url);

                    successToast('Resources Deleted!');

                    logToConsole("delete resources resp", {
                        response: response,
                    }, LOG_TYPES.HTTP_REQUEST);

                    return response.data;
                })
                .catch(error => {
                    logToConsole("delete resources error", error, LOG_TYPES.ERROR);
                });
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
            $("#deleteRecordConfirmModal").modal('hide');
            return await axios.delete(url + "/" + id)
                .then(response => {
                    refreshTable(elem, url);

                    successToast('Resource Deleted!');

                    logToConsole("deleteResource resp", {
                        response: response,
                    }, LOG_TYPES.HTTP_REQUEST);

                    return response.data;
                })
                .catch(error => {
                    logToConsole("deleteResource error", error, LOG_TYPES.ERROR);
                });
        }
    </script>
@stop
