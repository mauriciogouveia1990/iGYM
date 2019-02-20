<section class="section-login">
    <div class="container">
        <div class="align-self-center div-registo">
            <header class="align-self-center">
                <div class="row">

                    <div class="progress progress-striped linha-progresso">
                        <div class="progress-bar progress-bar-info" style="width: 55%"></div>
                    </div>

                    <div class="stepwizard">
                        <div class="row botao-progresso">

                            <div class="col-xs-1 text-center progresso1">
                                <a href="<?=base_url('utilizador/registo_plano');?>" type="button" class="btn btn-info btn-circle">1</a>
                            </div>
                            <div class="col-xs-1 col-xs-offset-2 text-center progresso2">
                                <a href="<?=base_url('utilizador/registo');?>" type="button" class="btn btn-info btn-circle">2</a>

                            </div>
                            <div class="col-xs-1 col-xs-offset-2 text-center progresso3">
                                <a href="#step-3" type="button" class="btn btn-info btn-circle">3</a>
                            </div>
                            <div class="col-xs-1 col-xs-offset-2 text-center progresso4">
                                <a href="#step-4" type="button" class="btn btn-info btn-circle" disabled="disabled">4</a>
                            </div>

                        </div> <!-- row botao-progresso -->
                    </div> <!-- stepwizard -->

                </div> <!-- row -->
            </header>

            <div id="exTab1" class="container">
                <div class="row">
                    <div class="form-group col-md-6 col-md-offset-3">
                        <ul class="nav nav-pills">
                            <li class="active">
                                <a href="#nav-tab-card" data-toggle="tab">
                                <i class="fa fa-credit-card"></i>Cartão de Crédito</a>
                            </li>
                            <li><a href="#nav-tab-paypal" data-toggle="tab">
                                <i class="fab fa-paypal"></i>Paypal</a>
                            </li>
                            <li><a href="#nav-tab-bank" data-toggle="tab">
                            <i class="fa fa-university"></i>Transferência Bancária</a>
                            </li>
                        </ul>
                    </div> <!-- form-group.// -->
                </div> <!-- row.// -->

                <div class="tab-content clearfix">

                    <div class="tab-pane active" id="nav-tab-card">
                        <form role="form">
                            <div class="row">
                                <div class="form-group col-xs-8 col-md-offset-2">
                                    <label for="nome-cartao">Nome completo escrito na parte frontal do cartão<span class="required">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" class="form-control" name="nome-cartao" placeholder="Coloque o nome" required>
                                    </div> <!-- input-group.// -->
                                </div> <!-- form-group.// -->
                    
                    
                                <div class="form-group col-xs-8 col-md-offset-2">
                                    <label for="numero-cartao">Número do Cartão<span class="required">*</span></label>
                                    <div class="input-group">
                                        <!-- <span class="input-group-addon"><span class="fa fa-credit-card"></span></span> -->
                                        <!-- <input type="number" class="form-control" name="numero-cartao" placeholder="Insira o número"> -->

                                        <input class="inputCard" type="number" min="1000" max="9999" name="numero-cartao1" id="numero-cartao1" required/>
                                        -
                                        <input class="inputCard" type="number" min="1000" max="9999" name="numero-cartao2" id="numero-cartao2" required/>
                                        -
                                        <input class="inputCard" type="number" min="1000" max="9999" name="numero-cartao3" id="numero-cartao3" required/>
                                        -
                                        <input class="inputCard" type="number" min="1000" max="9999"  name="numero-cartao4" id="numero-cartao4" required/>

                                    </div> <!-- input-group.// -->
                                </div> <!-- form-group.// -->
                            </div> <!-- row.// -->
                    
                            <div class="row">
                    
                                <div class="form-group col-md-4 col-md-offset-2">
                                    <label>Data de Expiração<span class="required">*</span></label>
                                    <input type="month" class="form-control" id="validade-cartao" name="validade-cartao" required>
                                </div> <!-- form-group end.// -->
                    
                                <div class="form-group col-md-4">
                                    <label>CVV<span class="required">*</span></label>
                                    <input type="number" class="form-control" placeholder="últimos 3 digitos na parte traseira do cartão"
                                        name="codigo-cvv" id="codigo-cvv" min="1000" max="9999" required>
                                </div> <!-- form-group end.// -->
                    
                            </div> <!-- row.// -->
                    

                            <div class="form-group col-md-4 col-md-offset-4 botao-pagamento">
                                <input type="submit" class="btn btn-info btn-block" value="Confirmar Pagamento" name="formRegisto" id="formRegisto"> 
                            </div> <!-- form-group// -->


                        </form>
                    </div> <!-- nav-tab-card.// -->


                    <div class="tab-pane" id="nav-tab-paypal">
                        <div class="row">
                            <div class="form-group col-md-4 col-md-offset-4 paypal">
                                <p>Paypal is easiest way to pay online</p>
                                <p>
                                    <button type="button" class="btn btn-primary"><i class="fab fa-paypal"></i>Log in my Paypal </button>
                                </p>
                                <p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                </p>
                            </div> <!-- form-group// -->
                        </div> <!-- row.// -->
                    </div> <!-- nav-tab-paypal.// -->

                    <div class="tab-pane" id="nav-tab-bank">
                        <div class="row">
                            <div class="form-group col-md-6 col-md-offset-3 banco">
                                <p>Bank accaunt details</p>
                                <dl class="param">
                                    <dt>BANK: </dt>
                                    <dd> THE WORLD BANK</dd>
                                </dl>
                                <dl class="param">
                                    <dt>Accaunt number: </dt>
                                    <dd> 12345678912345</dd>
                                </dl>
                                <dl class="param">
                                    <dt>IBAN: </dt>
                                    <dd> 123456789</dd>
                                </dl>
                                <p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                    do
                                    eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. </p>
                            </div> <!-- form-group// -->
                        </div> <!-- row.// -->
                    </div> <!-- nav-tab-bank.// -->

                </div> <!-- tab-content clearfix.// -->
            </div> <!-- container.// -->
        </div> <!-- div-registo.// -->
    </div> <!-- container.// -->
</section> <!-- container.// -->

            