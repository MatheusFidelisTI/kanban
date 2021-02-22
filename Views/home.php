<script>carregaCard()</script>
<div class="row card-colunas">
    <div class="col-sm-6 col-md-3">

        <!-- DEMANDA -->
        <!-- *************************************************** -->

        <div class="panel panel-primary coluna">
            <div class="panel-heading">
                <p class="panel-title">
                    Demanda
                    <span class="badge badge-num-cards"><?php echo $QTD_STATUS[0]['QTD']; ?></span>
                </p>
            </div>
            <div id="cards-demanda" class="panel-body">

            <?php $viewData['tipo_card'] = 'Demanda';
            $this->loadViewInTemplate('cards',$viewData); ?>
            </div>
        </div>

    </div>
    <div class="col-sm-6 col-md-3">

        <!-- MATERIAL RECEBIDO -->
        <!-- *************************************************** -->

        <div class="panel panel-info coluna">
            <div class="panel-heading">
                <p class="panel-title">
                    Material Recebido
                    <span class="badge badge-num-cards"><?php echo $QTD_STATUS[1]['QTD']; ?></span>
                </p>
            </div>
            <div id="cards-material-recebido" class="panel-body">

            <?php $viewData['tipo_card'] = 'Material Recebido';
            $this->loadViewInTemplate('cards', $viewData); ?>

            </div>
        </div>

    </div>
    <div class="col-sm-6 col-md-3">

        <!-- EM CONFERÊNCIA -->
        <!-- *************************************************** -->

        <div class="panel panel-danger coluna">
            <div class="panel-heading">
                <p class="panel-title">
                    Em Conferência
                    <span class="badge badge-num-cards"><?php echo $QTD_STATUS[2]['QTD']; ?></span>
                </p>
            </div>
            <div id="cards-em-conferencia" class="panel-body">

            <?php $viewData['tipo_card'] = 'Em Conferência';
            $this->loadViewInTemplate('cards', $viewData); ?>

            </div>
        </div>

    </div>
    <div class="col-sm-6 col-md-3">

        <!-- CONFERIDO -->
        <!-- *************************************************** -->

        <div class="panel panel-success coluna">
            <div class="panel-heading">
                <p class="panel-title">
                    Conferido
                    <span class="badge badge-num-cards"><?php echo $QTD_STATUS[3]['QTD']; ?></span>
                </p>
            </div>
            <div id="cards-conferido" class="panel-body">

            <?php $viewData['tipo_card'] = 'Conferido';
            $this->loadViewInTemplate('cards', $viewData); ?>

            </div>
        </div>

    </div>
</div>