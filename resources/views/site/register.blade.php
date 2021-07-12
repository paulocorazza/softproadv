@extends('site.template.page')

@section('body')
    <section class="register position-relative overflow-hidden">
        <div class="bg-animation">
            <img class="zoom-fade" src="images/pattern/03.png" alt="">
        </div>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-md-12">
                    <div class="section-title">
                        <div class="title-effect">
                            <div class="bar bar-top"></div>
                            <div class="bar bar-right"></div>
                            <div class="bar bar-bottom"></div>
                            <div class="bar bar-left"></div>
                        </div>
                        <h6>Registre-se Agora</h6>
                        <h2>E comece a usar o SoftPro Advogado</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="register-form text-center z-index-1">
                        {!! Form::open(['route' => 'register.company', 'class' => 'form', 'id' => 'formRegister']) !!}
                            <div class="messages"></div>
                            <div class="col-md-12">
                                <div class="container" id="novo_conteiner">

                                    @include('tenants.includes.alerts')

                                    <div class="form-group">
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome Completo Advogado(a)']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::text('cellphone', null, ['id' => 'cellphone', 'class' => 'form-control', 'placeholder' => '(DDD) Celular']) !!}
                                    </div>


                                    <div class="form-group">
                                        {!! Form::text('cpf', null, ['id' => 'cpf', 'class' => 'form-control', 'placeholder' => 'CPF (apenas numeros)']) !!}
                                    </div>


                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            {!! Form::text('oab', null, ['class' => 'form-control', 'placeholder' => 'N° OAB']) !!}
                                        </div>

                                        <div class="col-md-4 form-group">
                                            {!! Form::text('uf_oab', null, ['class' => 'form-control', 'placeholder' => 'UF OAB']) !!}
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        {!! Form::select('qtd_processes', [
                                            "100" => 'Tenho até 100 Processos',
                                            "101-500" => 'Tenho 101 à 500 Processos',
                                            "501-2000" => 'Tenho 501 à 2.000 Processos',
                                            "2001-5000" => 'Tenho 2.001 à 5.000 Processos',
                                            "5001-10000" => 'Tenho 5.001 à 10.000 Processos',
                                            "+10.000" => 'Tenho +10.000 Processos',
                                            "consultivo" => 'Atuo no Consultivo',
                                            "departamento_juridico" => 'Atuo em Departamento Jurídico',
                                            "estudante" => 'Sou Estudante de Direito',
                                        ], null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::text('email_confirmation', null, ['class' => 'form-control', 'placeholder' => 'Repita o email']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('subdomain', 'Crie um endereço exclusivo para sua empresa acessar o SoftPro Advogado', ['class' => 'control-label']); !!}
                                        <div class="input-group">
                                            {!! Form::text('subdomain', null, ['class' => 'form-control', 'placeholder' => 'SubDomínio']) !!}

                                            <div class="input-group-append">
                                                <span class="input-group-text">{{ env('APP_SUBDOMAIN') }}</span>
                                            </div>
                                        </div>

                                        <div class="form_load" style="display:none;">
                                            <img src="{{ url('assets/images/load.gif') }}" alt="[CARREGANDO...]" title="CARREGANDO..."/>
                                        </div>
                                        <span id="domainexists"></span>
                                    </div>


                                    <input type="checkbox" id="create_database" name="create_database" checked="checked"
                                           style="display: none"
                                           class="checkbox">

                                       {!! Form::submit('CRIAR MINHA CONTA', ['class' => 'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <div class="remember-checkbox d-inline-block mb-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">Eu aceito os termos de uso e privacidade</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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


