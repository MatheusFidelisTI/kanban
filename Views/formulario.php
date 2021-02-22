<?php 
    $data_registro = new DateTime($DT_REGISTRO);
?>
<div id="form-card_<?php echo $ID_CARD;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Visualização do Card</h4>
            </div>
            <div class="modal-body">
    

                <!-- conteudo -->
                <div class="row">
                    <div class="col-sm-8 "><p style="font-weight: bold;">Registro</p></div>
                    <div class="col-sm-2"><p style="font-weight: bold;">Nº Aula</p></div>
                    <div class="col-sm-2"><p style="font-weight: bold;">Ano</p></div>
                </div>
                <div class="row">
                    <div class="col-sm-8"><span class="glyphicon glyphicon-calendar"></span> <?php echo $data_registro->format('d/m/Y'); ?>     <span class="glyphicon glyphicon-time"></span> <?php echo $data_registro->format('H:i'); ?></div>
                    <div class="col-sm-2"><span class="label label-<?php echo $COR?>">A<?php echo $NUM_AULA?></span></div>
                    <div class="col-sm-2"><span class="label label-success"><?php echo $ANO?></span></div>
                </div>
                </br>
                <div class="well">
                    <div class="row">
                        <div class="col-sm-8"><p style="font-weight: bold;">Curso</p></div>
                    </div>
                    <div class="row">
                <?php 
                    if($CURSO != ''){
                ?>      <div class="col-sm-8"><span class="glyphicon glyphicon-education"></span>  <?php echo $CURSO; ?></div>
                <?php } else { ?>
                        <div class="col-sm-8 aulao" style="background-color: #f5f5f5;"><h5>AULÃO</h5></div>
                <?php 
                } 
                ?>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> Professores</a></li>
                </ul>
                <div class="wrapper-professores">
                    <?php
                            for($i=0; $i < sizeof($PROFESSORES);$i++){ 
                                echo "<span class='glyphicon glyphicon glyphicon-play label' style='margin-right: 6px'><span class='label' style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 100%;'>".$PROFESSORES[$i]['NOME']."</span> </span>  ";

                            }
                    ?>
                </br>
                </br>
                </div>
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Materias</a></li>
                </ul>
                <div class="wrapper-professores">
                    <?php
                            for($i=0; $i < sizeof($MATERIAIS);$i++){ 
                                echo "<span class='glyphicon  ".$MATERIAIS[$i]['ICONE']." label' data-toggle='tooltip' data-placement='top'  style='margin-right: 6px'><span class='label' style='font-family: Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 100%;'>".$MATERIAIS[$i]['MATERIAL']."</span></span>";

                            }
                    ?>
                </br>
                </br>
                </div>
                <!-- conteudo -->


            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-10" style="text-align: left;"> <span style="font-size: 130%" class="glyphicon glyphicon-pushpin label label-<?php echo $COR; ?>"> <span style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 100%;"><?php echo $STATUS; ?></span></span></div>
                    <div class="col-sm-2"><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></div>
                </div>
               
               
            </div>
        </div>
    </div>
</div>