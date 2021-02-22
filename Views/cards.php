<!-- MODELO 1 -->
<!-- *********************************************************************** -->
<?php   foreach($_SESSION['BOARD'] as $value){  
     $this->loadViewInTemplate('formulario', $value);
            if($tipo_card == $value['STATUS']){
                if($value['CURSO'] != ''){

       
?>
                    <div class="panel panel-default card">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-xs-9">
                                    <?php
                                        echo "<h5>".$value['CURSO']."</h5>"; 
                                    ?>
                                
                                    <div class="wrapper-professores">
                                    <?php for($i=0; $i < sizeof($value['PROFESSORES']);$i++){ 
                                        echo "<span class='label'>".$value['PROFESSORES'][$i]['NOME']."</span></br>";

                                    }?>
                                    </div>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <span class="label label-<?php echo $value['COR']?> label-num-aula">A<?php echo $value['NUM_AULA']?></span>
                                    <span class="label label-success label-ano"><?php echo $value['ANO']?></span>
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">

                            <!-- OS ÍCONES VÊM DA TABELA "material" DO BANCO DE DADOS -->
                            <?php for($i=0; $i < sizeof($value['MATERIAIS']);$i++){ 
                                        echo "<span class='glyphicon  ".$value['MATERIAIS'][$i]['ICONE']."' data-toggle='tooltip' data-placement='top' title='".$value['MATERIAIS'][$i]['MATERIAL']."' style='margin-right: 6px'></span>";

                                    }
                            ?>
                            
                            <div class="dropdown pull-right">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-move"></span>
                                    Mover <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header">Ações</li>
                                    <?php   if($value['ID_STATUS'] != 4){ ?>
                                                <li role="separator" class="divider"></li>
                                                <li><a onclick="cardProximo('<?php echo $value['ID_CARD']?>','<?php echo $value['ID_STATUS']?>')">&raquo; Prosseguir</a></li>
                                    <?php   } ?>
                                    <?php   if($value['ID_STATUS'] != 1){ ?>
                                                <li role="separator" class="divider"></li>
                                                <li><a onclick="cardVoltar('<?php echo $value['ID_CARD']?>','<?php echo $value['ID_STATUS']?>')">&laquo; Voltar</a></li>
                                    <?php   }?>
                                </ul>
                            </div>

                            <a class="pull-right" data-toggle="modal" data-target="#form-card_<?php echo $value['ID_CARD'];?>" style="margin-right: 10px">
                                <span class="glyphicon glyphicon-eye-open"></span> Visualizar
                            </a>

                        </div>
                    </div>

<?php       
        }else{
?>
                <div class="panel panel-default card aulao">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-xs-9">
                                <h5>AULÃO</h5>
                                <div class="wrapper-professores">
                                <?php for($i=0; $i < sizeof($value['PROFESSORES']);$i++){ 
                                        echo "<span class='label'>".$value['PROFESSORES'][$i]['NOME']."</span></br>";

                                    }?>
                                </div>
                            </div>
                            <div class="col-xs-3 text-right">
                                    <span class="label label-<?php echo $value['COR']?> label-num-aula">A<?php echo $value['NUM_AULA']?></span>
                                    <span class="label label-success label-ano"><?php echo $value['ANO']?></span>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer">


                        <!-- OS ÍCONES VÊM DA TABELA "material" DO BANCO DE DADOS -->
                        <?php for($i=0; $i < sizeof($value['MATERIAIS']);$i++){ 
                                    echo "<span class='glyphicon  ".$value['MATERIAIS'][$i]['ICONE']."' data-toggle='tooltip' data-placement='top' title='".$value['MATERIAIS'][$i]['MATERIAL']."' style='margin-right: 6px'></span>";

                                }
                        ?>
                        
                        <div class="dropdown pull-right">
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-move"></span>
                                Mover <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Ações</li>
                                <li role="separator" class="divider"></li>
                                <?php   if($value['ID_STATUS'] != 4){ ?>
                                            <li><a onclick="cardProximo('<?php echo $value['ID_CARD']?>','<?php echo $value['ID_STATUS'];?>')">&raquo; Prosseguir</a></li>
                                <?php   } ?>
                                <li role="separator" class="divider"></li>
                                <?php   if($value['ID_STATUS'] != 1){ ?>
                                            <li><a onclick="cardVoltar('<?php echo $value['ID_CARD']?>','<?php echo $value['ID_STATUS'];?>')">&laquo; Voltar</a></li>
                                <?php   }?>
                            </ul>
                        </div>

                        <a href="javascript:;" class="pull-right" data-toggle="modal" data-target="#form-card_<?php echo $value['ID_CARD'];?>" style="margin-right: 10px">
                            <span class="glyphicon glyphicon-eye-open"></span> Visualizar
                   
                        </a>

                    </div>
                </div>
<?php 
        }
        
    } 
}
?>
<!-- MODELO 2 -->
<!-- *********************************************************************** -->

