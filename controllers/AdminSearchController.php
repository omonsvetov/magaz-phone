<?php 
/**
 * 
 */
class AdminSearchController extends AdminBase
{
	
 	public function actionIndex()
    {

        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            $key = $_POST['title'];
            
            

            // Если форма отправлена. записываем поисковый запрос в переменную $key
            // осуществляем поиск
           $searchAnswer = Search::getSearchProducts($key);          

           // Перенаправляем пользователя на страницу управлениями товарами
           // header("Location: /admin/search");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_search/search.php');// serch
        return true;
    }
	
}