<?php

class User extends Dbh{

    protected function getAllRecords($user_id){        
        $this->getBusinessRecords($user_id);
        $this->getCustomersRecords($user_id);
    }

    private function getRecords($user_id){
        $stmt = $this->connect()->prepare('SELECT * FROM records WHERE user_id = ?');
        if(!$stmt->execute([$user_id])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        
        echo '
        <table><thead><tr><th>#</th><th>Tipo</th><th>Fecha de Creación</th><th>Estado</th></tr></thead><tbody>
        ';
        if($stmt->rowCount()){           
            while($row = $stmt->fetch()){                
                echo '<tr><td>'.$row['table'].'</td><td>'
                .$row['create_datetime'].'</td><td>'.$row['status'].'</td></tr>';                
            }
        }
        echo '</tbody></table>';
        
    }

    private function getBusinessRecords($user_id){
        $stmt = $this->connect()->prepare('SELECT *, r.status AS rstatus, r.id AS rid FROM business AS b
        INNER JOIN records AS r
        ON b.id = r.id
        WHERE r.user_id = ?');
        if(!$stmt->execute([$user_id])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }        
       
        if($stmt->rowCount()){  
            echo '<h3>Business</h3>
            <table class="table"><thead><tr><th scope="col">Empresa</th><th scope="col">VAT</th><th scope="col">Email</th><th scope="col">Teléfono</th><th scope="col">Acciones</th></tr></thead><tbody>
            ';          
            while($row = $stmt->fetch()){                
                echo '
                <tr';
                if($row['rstatus']==0){
                    echo ' class="hidden deleted"';
                }
                echo '><td>'.$row['business_name'].'</td><td>'.$row['vat_number'].'</td><td>'
                .$row['email'].'</td><td>'.$row['phone'].'</td>
                <td><form action="../includes/crud.inc.php" method="post">
                <button type="submit" value="'.$row['rid'].'" name="edit">Editar</button>
                <button type="submit" value="'.$row['rid'].'" name="delete">Borrar</button>
                </form></td>
                </tr>';                
            }
        }
        echo '</tbody></table>';
        
    }

    private function getCustomersRecords($user_id){
        $stmt = $this->connect()->prepare('SELECT *, r.id AS rid, r.status AS rstatus FROM customer AS c
        INNER JOIN records AS r
        ON c.id = r.id
        WHERE r.user_id = ?');
        if(!$stmt->execute([$user_id])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }  
        
        if($stmt->rowCount()){            
            echo '<h3>Customers</h3>
            <table class="table"><thead><tr><th scope="col">Nombre</th><th scope="col">Apellido</th><th scope="col">Email</th><th scope="col">Teléfono</th><th scope="col">Acciones</th></tr></thead><tbody>
            ';
            while($row = $stmt->fetch()){                
                echo '
                <tr';
                if($row['rstatus']==0){
                    echo ' class="hidden deleted"';
                }
                echo '><td>'.$row['name'].'</td><td>'.$row['last_name'].'</td><td>'
                .$row['email'].'</td><td>'.$row['phone'].'</td>
                <td><form action="../includes/crud.inc.php" method="post">
                <button type="submit" value="'.$row['rid'].'" name="edit">Editar</button>
                <button type="submit" value="'.$row['rid'].'" name="delete">Borrar</button>
                </form></td>
                </tr>';                
            }
        }
        echo '</tbody></table>';
    }

    protected function createRecord($user_id, $table){
        /* The query on this method does not work, I still don't know why because the query works fine on the database. */
        $stmt = $this->connect()->prepare('INSERT INTO records(user_id, table) VALUES (?, ?)');
        if(!$stmt->execute([$user_id, $table])){
            $stmt = null;
            header('location: ../index.php?error=stmtfailed'.$table);
            exit();
        }
        $stmt = null;
    }

    protected function updateBusiness($id, $bname, $vat, $status, $email, $phone){
        $stmt = $this->connect()->prepare('UPDATE business SET business_name = ?, vat_number = ?, status = ?,
         email = ?, phone = ?
        WHERE id = ?');
        if(!$stmt->execute([$bname, $vat_number, $status, $email, $phone, $id])){
           $stmt = null;
           header("location: ../index.php?error=stmtfailed");
           exit();
       }   
       $stmt = null; 
    }

    protected function updateCustomer($id, $fname, $lname, $status, $email, $phone){
        $stmt = $this->connect()->prepare('UPDATE customer SET name = ?, last_name = ?, status = ?,
         email = ?, phone = ?
        WHERE id = ?');
        if(!$stmt->execute([$fname, $lname, $status, $email, $phone, $id])){
           $stmt = null;
           header("location: ../index.php?error=stmtfailed");
           exit();
       }   
       $stmt = null; 
    }
    
    protected function changeRecordStatus($record_id, $status){
     $stmt = $this->connect()->prepare('UPDATE records SET status = ? WHERE id = ?');
     if(!$stmt->execute([$status, $record_id])){
        $stmt = null;
        header("location: ../index.php?error=stmtfailed");
        exit();
    }   
    $stmt = null;    
    }
}
