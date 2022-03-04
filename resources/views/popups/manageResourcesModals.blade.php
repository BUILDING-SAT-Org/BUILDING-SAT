<div id="dataModalApp">
    <div class="modal fade" id="dataModal" tabindex="-1" role="dialog"
         aria-labelledby="dataModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form enctype="multipart/form-data">
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
                        <button type="button" v-on:click="validateInfoModal" class="btn btn-primary">
                            @{{ submitBtnText }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
