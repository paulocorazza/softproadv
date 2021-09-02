@extends('site.template.page')

@section('body')
    <section class="register position-relative overflow-hidden">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-12">
                    <br>
                    <div class="section-title">
                        <h4>Seja Bem vindo</h4>
                        <h2>Estamos criando o ambiente virtual seguro para seu Escritório</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="register-form text-center z-index-1">

                        <p><strong>Vai levar alguns minutos e nós avisaremos você assim que tudo estiver pronto!</strong></p>
                        <p><strong>Você receberá em seu e-mail o acesso com o domínio escolhido no momento do seu cadastro, usuário e senha para acessar a plataforma.</strong></p>
                        <br/><br/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('java-script')
    <!--== contact-form -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/register.js') }}"></script>
@endsection


