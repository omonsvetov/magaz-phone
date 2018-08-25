<?php 

/**
 * 
 */
class Search
{
	
	/**
     * Принимает поисковый запрос
     * Возвращает список искомых товаров
     * @return array <p>Массив с товарами</p>
     */
    public static function getSearchProducts($key)
    {
         
        // Соединение с БД
        $db = Db::getConnection();

       // Текст запроса к БД
        $sql = "SELECT id, code, name, price FROM product WHERE name LIKE '%$key%' ";
         
        // Используется  запрос
        $result = $db->query($sql);
        
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

            // Получение и возврат результатов
            /*$result = $db->query('SELECT id, code, name, price FROM product '
                    . 'WHERE id LIKE "%{$keywords}%" '
                    . 'OR code  LIKE "%{$keywords}%" '
                    . 'OR name  LIKE "%{$keywords}%" '
                    . 'OR price LIKE "%{$keywords}%" ');*/

        $i = 0;
        $searchAnswer = array();
        while ($row = $result->fetch()) {
            $searchAnswer[$i]['id'] = $row['id'];
            $searchAnswer[$i]['code'] = $row['code'];
            $searchAnswer[$i]['name'] = $row['name'];
            $searchAnswer[$i]['price'] = $row['price'];
            
            $i++;
        }
                       
        return $searchAnswer;
    }

}
