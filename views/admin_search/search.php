<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление товарами</li>
                </ol>
            </div>

            <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить товар</a>
            
            <h4>Список товаров</h4>

            <br/>


            <form class="navbar-form navbar-left" role="search" name="" action="search" method="post">
              <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default" name="submit">Find</button>
            </form>



            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID товара</th>
                    <th>Артикул</th>
                    <th>Название товара</th>
                    <th>Цена</th>
                    <th></th>
                    <th></th>
                </tr>

               
                <?php if (is_array($searchAnswer)): ?>

                    <?php foreach ($searchAnswer as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['code']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?></td>  
                            <td><a href="/admin/product/update/<?php echo $product['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td><a href="/admin/product/delete/<?php echo $product['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?> 

                <?php endif; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

