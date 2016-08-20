 <?php
require_once ('queries.php');
 try{
  $pdo = new PDO('mysql:host=localhost;dbname=pdo', 'admin', 'admin');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $pdo->exec(SQL_CREATE_PERSON_TABLE);
  $pdo->exec(SQL_CREATE_ACCOUNT_TABLE);
 }
 catch(PDOException $e){
  exit($e->getMessage());
 }

 try{
  $pdo->beginTransaction(); // Начало транзакции
  $stmt = $pdo->prepare(MY_SQL_INSERT_PERSON); // подготовленный запрос
  $stmt->execute([
   ':firstname' => 'Hanna',
   ':lastname' => 'Kokhanava',
   ':patro' => 'Viat'
  ]);// передача значений в подготовленный запрос

  $id = $pdo->lastInsertId();// получение идентификатора последнего добавленного
  $stmt = $pdo->prepare(SQL_INSERT_ACCOUNT);// подготовленный запрос
  $stmt->execute([
    ':person_id'=>$id,
    ':username'=>'harnet',
    ':password'=>'12345'
  ]);
  $pdo->commit(); // фиксирование транзакции
 }
 catch(PDOException $e){
  echo $e->getMessage(); // вывод сообщения об ошибке
  $pdo->rollBack(); // отмена (откат) транзакции в случае возможных проблем
 }
?>
