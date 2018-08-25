<?php
/**
 * Класс Phonebook - модель для работы с телефонами пользователей
 */
class Phonebook
{
    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 5;

    /**
     * Возвращает список контактов
     * @return array <p>Массив контактов</p>
     */
    public static function getPhonesList($page = 1)
    {
        $limit = Phonebook::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT id, fio, phone, email FROM phonebook ORDER BY id ASC LIMIT :limit OFFSET :offset";

        // Используется  запрос
        $result = $db->prepare($sql);

        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение комaнды
        $result->execute();

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $phonesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $phonesList[$i]['id'] = $row['id'];
            $phonesList[$i]['fio'] = $row['fio'];
            $phonesList[$i]['phone'] = $row['phone'];
            $phonesList[$i]['email'] = $row['email'];
            $i++;
        }
        return $phonesList;
    }

    /**
     * Возвращает количество контактов
     */
    public static function getTotalPhones($page = 1)
    {
        $limit = Phonebook::SHOW_BY_DEFAULT;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM phonebook ';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Выполнение комaнды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Возвращает контакт с указанным id
     */
    public static function getPhoneById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM phonebook WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }

    /**
     * Удаляет контакт с указанным id
     * @param integer $id <p>id контакта</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deletePhoneById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM phonebook WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует контакт с заданным id
     * @param integer $id <p>id контакта</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updatePhoneById($id, $fio, $phone, $email)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE phonebook SET fio = :fio, phone = :phone, email = :email WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':fio', $fio, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_INT);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
    }

    /**
     * Добавляет новый контакт
     * @param array $options <p>Массив с информацией о контакте</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createPhone($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO phonebook '
            . '(fio, phone, email)'
            . 'VALUES '
            . '(:fio, :phone, :email)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':fio', $options['fio'], PDO::PARAM_STR);
        $result->bindParam(':phone', $options['phone'], PDO::PARAM_STR);
        $result->bindParam(':email', $options['email'], PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    /**
     * Принимает поисковый запрос
     * Возвращает список искомых контактов
     * @return array <p>Массив с контактами</p>
     */
    public static function getSearchPhones($key)
    {

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT id, fio, phone, email FROM phonebook WHERE fio LIKE '%$key%' ";

        // Используется  запрос
        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        /*$result = $db->query('SELECT id, fio, phone, email FROM phonebook '
                . 'WHERE id LIKE "%{$key}%" '
                . 'OR fio  LIKE "%{$key}%" '
                . 'OR phone  LIKE "%{$key}%" '
                . 'OR email LIKE "%{$key}%" ');*/

        $i = 0;
        $searchPhones = array();
        while ($row = $result->fetch()) {
            $searchPhones[$i]['id'] = $row['id'];
            $searchPhones[$i]['fio'] = $row['fio'];
            $searchPhones[$i]['phone'] = $row['phone'];
            $searchPhones[$i]['email'] = $row['email'];

            $i++;
        }
        // Возвращаем массив найденых телефонов
        return $searchPhones;
    }
}