<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <h4>Удалить телефон #<?php echo $id; ?></h4>


            <p>Вы действительно хотите удалить этот телефон?</p>

            <form method="post">
                <input type="submit" name="submit" value="Удалить" />
            </form>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

