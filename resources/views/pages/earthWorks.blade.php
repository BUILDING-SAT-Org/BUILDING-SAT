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

    </style>
    <h1>{{ session('user_id') }}</h1>
    <div class="container">
        <div class="col-md-12">

            <div class="accordion" id="accordionExample">

                <div class="accordion-item" style="width: 210px;">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>

                </div>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse
                        plugin adds the appropriate classes that we use to style each element. These classes control the
                        overall
                        appearance, as well as the showing and hiding via CSS transitions. You can modify any of this
                        with
                        custom CSS or overriding our default variables. It's also worth noting that just about any HTML
                        can go
                        within the <code>.accordion-body</code>, though the transition does limit overflow.

                    </div>
                </div>


                <div class="accordion-item" style="width: 210px;">
                    <h2 class="accordion-header" id="headingThree1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree1" aria-expanded="false" aria-controls="collapseThree1">
                            Accordion Item #3
                        </button>
                    </h2>

                </div>
                <div id="collapseThree1" class="accordion-collapse collapse" aria-labelledby="headingThree1"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse
                        plugin adds the appropriate classes that we use to style each element. These classes control the
                        overall
                        appearance, as well as the showing and hiding via CSS transitions. You can modify any of this
                        with
                        custom CSS or overriding our default variables. It's also worth noting that just about any HTML
                        can go
                        within the <code>.accordion-body</code>, though the transition does limit overflow.

                    </div>
                </div>


                <div class="accordion-item" style="width: 210px;">
                    <h2 class="accordion-header" id="headingThree2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree2" aria-expanded="false" aria-controls="collapseThree2">
                            Accordion Item #3
                        </button>
                    </h2>

                </div>
                <div id="collapseThree2" class="accordion-collapse collapse" aria-labelledby="headingThree2"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse
                        plugin adds the appropriate classes that we use to style each element. These classes control the
                        overall
                        appearance, as well as the showing and hiding via CSS transitions. You can modify any of this
                        with
                        custom CSS or overriding our default variables. It's also worth noting that just about any HTML
                        can go
                        within the <code>.accordion-body</code>, though the transition does limit overflow.

                    </div>
                </div>


            </div>

        </div>
    </div>
@stop
