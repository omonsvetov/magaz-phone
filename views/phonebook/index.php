<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>
            <a href="/phone/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить номер</a>
            <h4>Телефоны сотрудников</h4>

            <br/>

            <!--Форма поиска-->
            <form  class="navbar-form navbar-right" role="search" name="" action="search" method="post">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default" name="submit">Find</button>
            </form>
            <!--Форма поиска-->

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID сотрудника</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Почта</th>
                    <th></th>
                    <th></th>
                </tr>


                    <?php foreach ($listPhones as $phone): ?>
                        <tr>
                            <td><?= $phone['id']; ?></td>
                            <td><?= $phone['fio']; ?></td>
                            <td><?= $phone['phone']; ?></td>
                            <td><?= $phone['email']; ?></td>
                            <td><a href="/phone/update/<?= $phone['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td><a href="/phone/delete/<?= $phone['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>

            </table>
            <!-- Постраничная навигация -->
            <?php echo $pagination->get(); ?>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

