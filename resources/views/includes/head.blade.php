<meta charset="utf-8">

<!-- Document title -->
<title>@yield('title')</title>

<link rel="shortcut icon" type="image/jpg" href="/images/favicon.ico"/>

<!-- Stylesheets & Fonts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
      integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/bootstrap-table.min.css"
      integrity="sha512-5RNDl2gYvm6wpoVAU4J2+cMGZQeE2o4/AksK/bi355p/C31aRibC93EYxXczXq3ja2PJj60uifzcocu2Ca2FBg=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link href="/css/vfg.css" rel="stylesheet">
<link href="/css/vue-treeselect.min.css" rel="stylesheet">

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"
        integrity="sha256-kXTEJcRFN330VirZFl6gj9+UM6gIKW195fYZeR3xDhc=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.19.1/bootstrap-table.min.js"
        integrity="sha512-SoNdA/8QMSSlEcJAXKdAALavPMfGJnoh/96Tosg3qxQhdktSAttyHT7ePJghxJNvLCeyJYtXcdrTgLvHHsbRcQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"
        integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
        integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.33.1/apexcharts.min.js"
        integrity="sha512-oyNqW6ArxqcGtg9kzTbOQqKC+q7+tS9Ab09S44+VbZiKY6xJtMNA6v13vJwoqiKLGJuQQwams0W5E19QnLfxWw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"
        integrity="sha512-3oappXMVVac3Ge3OndW0WqpGTWx9jjRJA8SXin8RxmPfc8rg87b31FGy14WHG/ZMRISo9pBjezW9y00RYAEONA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/js/vue-treeselect.umd.min.js?version=2"></script>
<script src="/js/vfg.js?version=5"></script>
<script src="/js/utils/constants.js?version=5"></script>
<style>
    /* fallback */
    @font-face {
        font-family: 'Material Icons';
        font-style: normal;
        font-weight: 400;
        src: url(https://fonts.gstatic.com/s/materialicons/v125/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
    }

    .material-icons {
        font-family: 'Material Icons';
        font-weight: normal;
        font-style: normal;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
    }

    .modal-backdrop {
        width: 100% !important;
        height: 100% !important;
    }

    #bg {
        position: fixed;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        z-index: -1;
    }

    #bg img {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto;
        min-width: 50%;
        min-height: 50%;
    }

    .logo {
        width: 100%;
        height: 100%;
    }

    .logo-container {
        width: 450px;
        height: 150px;
        margin: 15px;
    }

    .tree-select-label-info-container {
        margin-left: 5px;
    }

    .scrollToTop {
        border-radius: 50%;
        color: white;
        cursor: pointer;
        width: 34px;
        padding: 0px;

        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 100;
        opacity: 0;
        transform: translateY(100px);
        transition: all .5s ease
    }

    .showScrollToTop {
        opacity: 1;
        transform: translateY(0)
    }

    .vue-form-generator span.help .helpText {
        z-index: 999;
    }

    .container-center {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 100%;
    }

    .link-text-white {
        text-decoration: none;
        color: white;
    }

    .link-text-white:hover {
        text-decoration: none;
        color: white;
        cursor: pointer;
    }

    .bsat-nav-bar {
        padding: 10px;
    }

    .bsat-logo {
        width: inherit;
        height: inherit;
    }

    div.loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(16, 16, 16, 0.5);
        z-index: 999;
    }

    @-webkit-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-ms-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .uil-ring-css {
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 200px;
        height: 200px;
    }

    .uil-ring-css > div {
        position: absolute;
        display: block;
        width: 160px;
        height: 160px;
        top: 20px;
        left: 20px;
        border-radius: 80px;
        box-shadow: 0 6px 0 0 #ffffff;
        -ms-animation: uil-ring-anim 1s linear infinite;
        -moz-animation: uil-ring-anim 1s linear infinite;
        -webkit-animation: uil-ring-anim 1s linear infinite;
        -o-animation: uil-ring-anim 1s linear infinite;
        animation: uil-ring-anim 1s linear infinite;
    }

    .hide-loader {
        display: none !important;
    }

    .bsat-tree-select-overseas .vue-treeselect__menu {
        right: -220px;
    }

    .bsat-result-description {
        text-align: justify;
    }

    textarea#description {
        height: 100px !important;
    }

    .col-md-12.disabled.field-image.form-group.px-2.valid > label {
        font-style: normal;
    }
</style>
<script>
    Vue.component('treeselect', VueTreeselect.Treeselect);

    function logToConsole(msg, data, logType) {
        if ({{env("APP_LOG_CLIENT")}}) {
            if ({{env("APP_LOG_CLIENT_EVENTS")}} && logType === LOG_TYPES.EVENT) {
                collapsedLog(msg, data);
            } else if ({{env("APP_LOG_CLIENT_CALCULATIONS")}} && logType === LOG_TYPES.CALCULATION) {
                collapsedLog(msg, data);
            } else if ({{env("APP_LOG_CLIENT_MODELS")}} && logType === LOG_TYPES.MODEL) {
                collapsedLog(msg, data);
            } else if ({{env("APP_LOG_CLIENT_HTTP_REQUEST")}} && logType === LOG_TYPES.HTTP_REQUEST) {
                collapsedLog(msg, data);
            } else if ({{env("APP_LOG_CLIENT_ERRORS")}} && logType === LOG_TYPES.ERROR) {
                collapsedLog(msg, data);
            }
        }
    }

    function collapsedLog(msg, data) {
        console.groupCollapsed(msg);
        console.log(data);
        console.groupCollapsed('trace');
        console.trace();
        console.groupEnd();
        console.groupEnd();
    }

    $(document).on('hidden.bs.modal', function () {
        if ($('.modal.show').length) {
            $('body').addClass('modal-open');
        }
    });
</script>
<script src="/js/utils/utils.js?version=10"></script>
