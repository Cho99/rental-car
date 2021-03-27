@extends('layouts.client.layout')

@section('content')
    <section id="hero_2">
        <div class="intro_title animated fadeInDown">
            <h1>Place your order</h1>
            <div class="bs-wizard">

                <div class="col-xs-4 bs-wizard-step active">
                    <div class="text-center bs-wizard-stepnum">Your cart</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="cart.html" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum">Your details</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="payment.html" class="bs-wizard-dot"></a>
                </div>

                <div class="col-xs-4 bs-wizard-step disabled">
                    <div class="text-center bs-wizard-stepnum">Finish!</div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                    <a href="confirmation.html" class="bs-wizard-dot"></a>
                </div>

            </div>
            <!-- End bs-wizard -->
        </div>
        <!-- End intro-title -->
    </section>
@endsection
