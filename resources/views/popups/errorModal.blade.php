<style>
    .error-modal {
        color: #636363;
        width: 400px;
        border: solid;
        border-width: 1px;
        border-radius: 5px;
        box-shadow: 0px 0px 18px 11px;
        z-index: 9999;
    }

    .error-modal .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }

    .error-modal .modal-header {
        border-bottom: none;
        position: relative;
    }

    .error-modal h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }

    .error-modal .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }

    .error-modal .modal-body {
        color: #999;
    }

    .error-modal .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }

    .error-modal .modal-footer a {
        color: #999;
    }

    .error-modal .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }

    .error-modal .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }

    .error-modal .btn, .error-modal .btn:active {
        color: #fff;
        border-radius: 4px;
        background: #60c7c1;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        min-width: 120px;
        border: none;
        min-height: 40px;
        border-radius: 3px;
        margin: 0 5px;
    }

    .error-modal .btn-secondary {
        background: #c1c1c1;
    }

    .error-modal .btn-secondary:hover, .error-modal .btn-secondary:focus {
        background: #a8a8a8;
    }

    .error-modal .btn-danger {
        background: #f15e5e;
    }

    .error-modal .btn-danger:hover, .error-modal .btn-danger:focus {
        background: #ee3535;
    }

    .top {
        z-index: 99999;
    }

    .delete-message-text {
        font-size: 18px;
        color: red;
    }
</style>

<div id="errorModal" class="modal fade top">
    <div class="modal-dialog error-modal" style="position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100">Error!</h4>
                <button type="button" v-on:click="closeModal" class="close"
                        aria-hidden="true">&times;
                </button>
            </div>
            <div class="modal-body">
                <p class="delete-message-text">@{{ message }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" v-on:click="closeModal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    let errorModal = new Vue({
        el: "#errorModal",
        data: function () {
            return {
                message: '',
            };
        },
        methods: {
            closeModal: function () {
                $("#errorModal").modal('hide');
            },
            confirm: function () {
            },
        }
    });
</script>
