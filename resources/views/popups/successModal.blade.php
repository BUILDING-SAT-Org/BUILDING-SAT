<style>
    .success-modal {
        color: #636363;
        width: 400px;
    }

    .success-modal .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }

    .success-modal .modal-header {
        border-bottom: none;
        position: relative;
    }

    .success-modal h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }

    .success-modal .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }

    .success-modal .modal-body {
        color: #999;
    }

    .success-modal .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }

    .success-modal .modal-footer a {
        color: #999;
    }

    .success-modal .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #5ef1be;
    }

    .success-modal .icon-box i {
        color: #5ef1be;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }

    .success-modal .btn, .success-modal .btn:active {
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

    .success-modal .btn-secondary {
        background: #c1c1c1;
    }

    .success-modal .btn-secondary:hover, .success-modal .btn-secondary:focus {
        background: #a8a8a8;
    }

    .success-modal .btn-danger {
        background: #5ef1be;
    }

    .success-modal .btn-danger:hover, .success-modal .btn-danger:focus {
        background: #5ef1cf;
    }

    .success-message-text {
        font-size: 18px;
    }
</style>

<div id="successModal" class="modal fade">
    <div class="modal-dialog success-modal" style="position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xe5ca;</i>
                </div>
                <h4 class="modal-title w-100">Success!</h4>
                <button type="button" v-on:click="closeModal" class="close"
                        aria-hidden="true">&times;
                </button>
            </div>
            <div class="modal-body">
                <p class="success-message-text">@{{ message }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" v-on:click="closeModal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    let successModal = new Vue({
        el: "#successModal",
        data: function () {
            return {
                message: '',
            };
        },
        methods: {
            closeModal: function () {
                $("#successModal").modal('hide');
            },
            confirm: function () {
            },
        }
    });
</script>
