<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <h4>Редактировать телефон #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>ФИО</p>
                        <input type="text" name="fio" placeholder="" value="<?= $upPhone['fio']; ?>">

                        <p>Телефон</p>
                        <input type="text" name="phone" placeholder="" value="<?= $upPhone['phone']; ?>">

                        <p>Почта</p>
                        <input type="text" name="email" placeholder="" value="<?= $upPhone['email']; ?>">


                        <br/><br/>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        
                        <br/><br/>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

