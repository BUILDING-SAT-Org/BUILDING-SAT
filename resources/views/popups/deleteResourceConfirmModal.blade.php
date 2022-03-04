<style>
    .delete-record-confirm-modal {
        color: #636363;
        width: 400px;
    }

    .delete-record-confirm-modal .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }

    .delete-record-confirm-modal .modal-header {
        border-bottom: none;
        position: relative;
    }

    .delete-record-confirm-modal h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }

    .delete-record-confirm-modal .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }

    .delete-record-confirm-modal .modal-body {
        color: #999;
    }

    .delete-record-confirm-modal .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }

    .delete-record-confirm-modal .modal-footer a {
        color: #999;
    }

    .delete-record-confirm-modal .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }

    .delete-record-confirm-modal .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }

    .delete-record-confirm-modal .btn, .delete-record-confirm-modal .btn:active {
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

    .delete-record-confirm-modal .btn-secondary {
        background: #c1c1c1;
    }

    .delete-record-confirm-modal .btn-secondary:hover, .delete-record-confirm-modal .btn-secondary:focus {
        background: #a8a8a8;
    }

    .delete-record-confirm-modal .btn-danger {
        background: #f15e5e;
    }

    .delete-record-confirm-modal .btn-danger:hover, .delete-record-confirm-modal .btn-danger:focus {
        background: #ee3535;
    }
</style>

<div id="deleteRecordConfirmModal" class="modal fade">
    <div class="modal-dialog delete-record-confirm-modal" style="position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" id="deleteRecordCancelIcon" v-on:click="closeModal" class="close"
                        aria-hidden="true">&times;
                </button>
            </div>
            <div class="modal-body">
                <p>@{{ message }}</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" v-on:click="closeModal">Cancel</button>
                <button type="button" class="btn btn-danger" v-on:click="confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
