<?php echo $this->extend('Admin/layout/principal') ?>

<!--Enviamos para o template principal os estilos -->
<?php echo $this->section('titulo') ?>
<?php echo $titulo ?>
<?php echo $this->endSection() ?>

<!--Enviamos para o template principal os estilos -->
<?php echo $this->section('estilos') ?>

<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>" />

<?php echo $this->endSection() ?>

<!--Enviamos para o template principal os estilos -->
<?php echo $this->section('conteudo') ?>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $titulo ?></h4>

                <div class="ui-widget">
                    <input id="query" name="query" placeholder="pesquise por um usuario" class="form-control bg-light mb-5">
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Cpf</th>
                                <th>Ativo</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($usuarios as $usuario) : ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo site_url("admin/usuarios/show/$usuario->id"); ?>"><?php echo $usuario->nome; ?></a>
                                    </td>

                                    <td><?php echo $usuario->email; ?></td>
                                    <td><?php echo $usuario->cpf; ?></td>

                                    <td><?php echo ($usuario->ativo ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>') ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>


<?php echo $this->section('scripts') ?>
<!--Enviamos para o template principal os scripts -->

<script src="<?php echo site_url('/admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>


<script>

$( "#query" ).autocomplete({
      source: function(request, response){

        $.ajax({

            url: "<?php echo site_url('admin/usuarios/procurar'); ?>",
            dataType: "json",
            data:{
                term:request.term
            },
            success: function(data){
                if(data.length < 1){

                    var data = [
                        {
                            label: 'Usuario não encontrado',
                            value: -1
                        }
                    ];
                }
                response(data);
            },  
        });

      },
      midLenght: 1,
      select: function (event, ui) {
 
        if(ui.item.value == -1){
            $(this).val("");
            return false;
        }else{
            window.location.href = '<?php echo site_url('admin/usuarios/show/');?>' + ui.item.id;
        }
      }

    });

</script>

<?php echo $this->endSection() ?>