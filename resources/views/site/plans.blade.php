@extends('site.template.page')

@section('body')
    <section id="pricing" class="position-relative">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-12">
                    <div class="section-title">
                        <h6>ESCOLHA SEU PLANO</h6>
                        <h2 class="title">Planos e preços do Softpro Advogado</h2>
                        <p>Nossos planos são flexíveis para se adequar a sua necessidade</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                @foreach( $plans as $plan)
                <div class="col-lg-4 col-md-12 mt-5 mt-lg-0">
                    <div class="price-table active">
                        <div class="price-inside">{{ $plan->description }}</div>
                        <div class="price-header">
                            <div class="price-value">
                                <h2><span style="margin-left: -16px;">R$</span>  {{ $plan->price_br }}</h2>

                                <span>Pacote Mensal</span>
                            </div>
                            <h3 class="price-title">{{ $plan->description }}</h3>
                        </div>
                        <a class="btn btn-theme btn-circle my-4"
                           href="{{ route('paypal.agreement', [session('company')['uuid'], $plan->key_paypal]) }}"
                           data-text="Assinar"> <span>A</span><span>s</span><span>s</span><span>i</span><span>n</span><span>a</span><span>r</span>
                        </a>
                        <div class="price-list">
                            <ul class="list-unstyled">
                                @foreach($plan->plan_details as $details)
                                    <li>{{$details->description}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('java-script')

@endsection


