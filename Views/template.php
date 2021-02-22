<?php header('Content-Type: text/html; charset=utf8'); ?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_BR">
    <head>
        <title>KANBAN</title>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
        <meta http-equiv="Last-Modified" content="<?= gmdate('D, d M Y H:i:s') . ' GMT'; ?>" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Cache" content="no-cache" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="rating" content="general" />
        <meta name="author" content="Sandro Alves Peres" />
        <meta name="title" content="KANBAN" />
        <meta name="robots" content="noindex,nofollow" />
        <meta name="googlebot" content="noindex,nofollow" />

        <!-- Mobile device meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4" />
        <meta name="x-blackberry-defaultHoverEffect" content="false" />
        <meta name="HandheldFriendly" content="true" />
        <meta name="MobileOptimized" content="240" />

        <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/imagens/trello-desktop.jpg" type="image/jpg" />
        <link rel="apple-touch-icon" href="<?php echo BASE_URL; ?>assets/imagens/trello-desktop.jpg" type="image/jpg" />
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/bootstrap-3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/toastr.min.css"/>
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/kanban.css" />

        
        <script src="<?php echo BASE_URL; ?>assets/js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/bootstrap-3.3.7/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/toastr.min.js"></script>
        <script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>

        <script type="text/javascript">
            $(function()
            {
                $('[data-toggle="tooltip"]').tooltip();
            });
           
        </script>
    </head>

    <?php flush(); ?>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Curso</label>
                        <select id="select-filtro-curso" class="form-control" onchange="carregaCard()">
                            <option value="n" selected>Selecione...</option>
                            <?php foreach($viewData['CURSOS'] as $array){
                                echo "<option value='".$array['ID_CURSO']."'>".$array['CURSO']."</option>";
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3 col-md-1">
                    <div class="form-group">
                        <label class="control-label">Nº Aula</label>
                        <select id="select-filtro-num-aula" class="form-control" onchange="carregaCard()">
                            <option value="n" selected>Selecione...</option>
                            <?php foreach($viewData['N_AULAS'] as $array){
                                echo "<option value='".$array['NUM_AULA']."'>".$array['NUM_AULA']."</option>";
                            } ?>
                        </select>
                        
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Professor</label>
                        <div class="input-group">
                            <input id="input-filtro-professor" type="text" class="form-control" />
                            <span class="input-group-addon" onclick="carregaCard()">
                                <span class="glyphicon glyphicon-search" ></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">Ordenar por</label>
                        <select id="select-filtro-ordenar-por" class="form-control" onchange="carregaCard()">
                            <option value="ano">Ano</option>
                            <option value="curso">Curso</option>
                            <option value="professor">Professor</option>
                            <option value="num_aula">Nº Aula</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">&nbsp;</label>
                        <select id="select-filtro-ordenar-por_modo" class="form-control" onchange="carregaCard()">
                            <option value="asc">Crescente</option>
                            <option value="desc">Decrescente</option>
                        </select>
                    </div>
                </div>
            </div>
            <script>carregaCard()</script>
            <div id="dados_card">
            </div>  
        </div>
    
    </body>
</html>