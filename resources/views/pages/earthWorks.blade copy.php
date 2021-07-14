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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the
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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden by default, until the
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


                        <div class="accordion" id="accordionExample1">
                            <div class="accordion-item" style="width: 210px;">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree1" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Accordion Item #3
                                    </button>
                                </h2>

                            </div>
                            <div id="collapseThree1" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                    the
                                    collapse
                                    plugin adds the appropriate classes that we use to style each element. These classes
                                    control the
                                    overall
                                    appearance, as well as the showing and hiding via CSS transitions. You can modify any of
                                    this
                                    with
                                    custom CSS or overriding our default variables. It's also worth noting that just about
                                    any HTML
                                    can go
                                    within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>

                            <div class="accordion-item" style="width: 210px;">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree2" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Accordion Item #3
                                    </button>
                                </h2>

                            </div>
                            <div id="collapseThree2" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                    the
                                    collapse
                                    plugin adds the appropriate classes that we use to style each element. These classes
                                    control the
                                    overall
                                    appearance, as well as the showing and hiding via CSS transitions. You can modify any of
                                    this
                                    with
                                    custom CSS or overriding our default variables. It's also worth noting that just about
                                    any HTML
                                    can go
                                    within the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@stop
