<div id="resourceInfoApp">
    <div class="modal fade" id="resourceInfoModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@{{ title }}</h5>
                    <button type="button" class="close" v-on:click="closeResourceInfoModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul>
                                    <li v-for="(value, key, index) in infoList">
                                        <div v-if="key === 'Country'">
                                            @{{ key }} :
                                            <ul>
                                                <li v-for="(value, key, index) in value">
                                                    @{{ value.label }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div v-else>
                                            @{{ key }} : @{{ value }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            v-on:click="closeResourceInfoModal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var resourceInfoApp = new Vue({
        el: "#resourceInfoApp",
        data() {
            return {
                title: '',
                infoList: []
            }
        },
        methods: {
            closeResourceInfoModal: function () {
                $('#resourceInfoModal').modal('hide');
            },
            clearData: function () {
                this.title = '';
                this.infoList = [];
            }
        }

    });
</script>
