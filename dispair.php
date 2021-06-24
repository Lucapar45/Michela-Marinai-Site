$name = $_POST['name']
$surname = $_POST['surname']
$e_mail = $_POST['e_mail']
$password = $_POST['password']

if(!empty($name) || !empty($surname) || !empty($e_mail) || !empty($password)){
    $host = "bit.io";
    $dbUsername = "rickypucco@gmail.com";
    $dbPassword = "Life4521";
    $dbname = "Lucapar45/data-locker"."data-locker";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if(mysqli_connect_error()){
        die('Errore di Connessione: '.mysqli_connect_errno().mysqli_connect_error());
    } else{
        $SELECT = "SELECT e_mail From data-locker Where e_mail = ? Limit 1"
        $INSERT = "INSERT Into data-locker(name, surname, e_mail, password) values(?, ?, ?, ?)";
        
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param('s', $e_mail);
        $stmt->execute();
        $stmt->bind_result($resultEmail);
        $stmt->store_result();
        $stmt->fetch();
        $rnum = $stmt->num_rows();
        
        if($rnum == 0){
            $stmt->close();
            
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param('ssss', $name, $surname, $e_mail, $password)
            if($stmt->execute()){
                echo('Acount Creato con Successo!');
            
            } else {
                echo $stmt->error;
            }
        }else{
            echo('Email già in uso!')
        }
    $stmt->close();
    $conn->close();        

     }
}
