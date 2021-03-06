<div id="page-wrapper ">
    <div class="container-fluid ">
        <!-- Page Heading -->
        <div class="row " id="main-admin">
            <h1 class="title-exercicios text-center">Aulas</h1>
            
            <a class="exercicios-link" href="<?=base_url('personalTrainer/marcarAula')?>">
                <div class="col-md-6 col-lg-4">
                    <div class="exercicios-item text-center">
                        <div class="exercicios-item-header">
                            <i class="fas fa-file-signature fa-5x "></i>
                        </div>
                        <div class="info">
                            <div class="exercicios-title">
                                Marcar Aula
                            </div>
                            <p class="exercicios-descricao"> Marcar uma aula num dia e uma hora possivel</p>
                        </div>

                        <div class="bottom">
                            <a href="<?=base_url('personalTrainer/marcarAula')?>" class="btn btn-primary exercicios-btn">Ver</a>
                        </div>
                    </div>
                </div>
            </a>

            <a class="exercicios-link" href="<?=base_url('personalTrainer/visualizarAulas')?>">
                <div class="col-md-6 col-lg-4">
                    <div class="exercicios-item ">
                        <div class="exercicios-item-header">
                            <i class="fas fa-file-signature fa-5x "></i>
                        </div>
                        <div class="info">
                            <div class="exercicios-title">
                                Visualizar Proximas aulas
                            </div>
                            <p class="exercicios-descricao"> Visualizar todas as informções de uma determinada aula (data, hora, gestão de clientes etc...)</p>
                        </div>

                        <div class="bottom">
                            <a class="btn btn-primary exercicios-btn" href="<?=base_url('personalTrainer/visualizarAulas')?>">Ver</a>
                        </div>
                    </div>
                </div>
            </a>
            <a class="exercicios-link" href="<?=base_url('personalTrainer/historicoAulas')?>">
                <div class="col-md-6 col-lg-4">
                    <div class="exercicios-item ">
                        <div class="exercicios-item-header">
                            <i class="fas fa-file-signature fa-5x "></i>
                        </div>
                        <div class="info">
                            <div class="exercicios-title">
                                Visualizar histórico de aulas
                            </div>
                            <p class="exercicios-descricao"> Visualizar o historico de aulas realizadas</p>
                        </div>

                        <div class="bottom">
                            <a class="btn btn-primary exercicios-btn" href="<?=base_url('personalTrainer/historicoAulas')?>">Ver</a>
                        </div>
                    </div>
                </div>
            </a>
              
            
                
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div><!-- /#wrapper -->