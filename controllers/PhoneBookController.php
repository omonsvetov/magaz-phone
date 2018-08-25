<?php
/**
 * Телефонная книга
 */
class PhoneBookController
{

    public function actionIndex($page = 1)
    {
        // Список последних контактов
        $listPhones = Phonebook::getPhonesList($page);

        // Общее количетсво контактов (необходимо для постраничной навигации)
        $total = Phonebook::getTotalPhones($page);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Phonebook::SHOW_BY_DEFAULT, 'page-');

        // Подключаем вид
        require_once(ROOT . '/views/phonebook/index.php');
        return true;
    }

    /**
     * Action для страницы "SEARCH"
     */
    public function actionSearch()
    {
        // Обработка формы
        if (isset($_POST['submit'])) {
            $key = $_POST['title'];git

            $findPhones = Phonebook::getSearchPhones($key);

            //header("Location: /phonebook/search");
        }

        // Подключаем вид
        require_once(ROOT . '/views/phonebook/search.php');
        return true;
    }

    /**
     * Action для страницы "Добавить контакт"
     */
    public function actionCreate()
    {

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['fio'] = $_POST['fio'];
            $options['phone'] = $_POST['phone'];
            $options['email'] = $_POST['email'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['fio']) || empty($options['phone'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый контакт
                Phonebook::createPhone($options);

                // Перенаправляем пользователя
                header("Location: /phone");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/phonebook/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать контакт"
     */
    public function actionUpdate($id)
    {
        // Получаем данные о конкретном телефоне
        $upPhone = Phonebook::getPhoneById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $fio = $_POST['fio'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            // Сохраняем изменения
            Phonebook::updatePhoneById($id, $fio, $phone, $email);
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /phone");
        }

        // Подключаем вид
        require_once(ROOT . '/views/phonebook/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить контакт"
     */
    public function actionDelete($id)
    {

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем контакт
            Phonebook::deletePhoneById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /phone");
        }

        // Подключаем вид
        require_once(ROOT . '/views/phonebook/delete.php');
        return true;
    }

}