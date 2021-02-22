<?php
namespace Models;

use \Core\Model;

class Board extends Model {

    public function getCurso(){
        $sql = "
                SELECT  C.ID_CURSO,
                        C.CURSO
                FROM TESTE_PHP.CURSO C
                ORDER BY C.CURSO
            ";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getQtdStatus($param){
        $sql = "
                SELECT IFNULL(COUNT(CA.ID_CARD),0) AS QTD,
                       ST.STATUS  
                FROM   TESTE_PHP.CARD CA RIGHT JOIN
                       TESTE_PHP.STATUS ST
                       ON CA.ID_STATUS = ST.ID_STATUS";

        if($param['filtro_professor'] != ''){
            $sql .= "     
                    AND CA.ID_CARD IN (
                        SELECT  DISTINCT(CP.ID_CARD) AS ID_CARD
                        FROM TESTE_PHP.CARD CA INNER JOIN 
                             TESTE_PHP.CARD_PROFESSOR CP	 
                        ON CP.ID_CARD = CA.ID_CARD 
                        INNER JOIN TESTE_PHP.PROFESSOR P
                        ON P.ID_PROFESSOR = CP.ID_PROFESSOR
                        WHERE SUBSTRING_INDEX(P.NOME, ' ', 1) LIKE :NOME OR SUBSTRING_INDEX(P.NOME, ' ', -1) LIKE :NOME
                    ORDER BY P.NOME
                    )";
        }
        if($param['filtro_curso'] != '' && $param['filtro_curso'] != 'n'){
            $sql .= " AND CA.ID_CURSO = :ID_CURSO";
        }
        
        if($param['num_aula'] != 'n' && $param['num_aula'] != ''){
            $sql .= " AND CA.NUM_AULA = :NUM_AULA";
        }

        $sql .= "
                GROUP  BY ST.STATUS
                ORDER  BY ST.ID_STATUS      ";

        $sql = $this->db->prepare($sql);

        if($param['filtro_curso'] != '' && $param['filtro_curso'] != 'n'){
            $sql->bindValue(':ID_CURSO', $param['filtro_curso']);
        }
        
        if($param['filtro_professor'] != ''){
            $sql->bindValue(':NOME', '%'.$param['filtro_professor'].'%');
        }  

        if($param['num_aula'] != 'n' && $param['num_aula'] != ''){
            $sql->bindValue(':NUM_AULA', $param['num_aula']);
        }   

        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getProfessor($param){
        $sql = "
                SELECT  PF.NOME, 
                        CP.ID_CARD_PROFESSOR, 
                        CP.ID_CARD, 
                        CP.ID_PROFESSOR
                FROM    TESTE_PHP.CARD_PROFESSOR CP INNER JOIN 
                        TESTE_PHP.PROFESSOR      PF 
                        ON CP.ID_PROFESSOR = PF.ID_PROFESSOR
                        WHERE CP.ID_CARD = :ID_CARD
                
            ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':ID_CARD', $param);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getNumAula(){
        $sql = "
                SELECT  DISTINCT(CA.NUM_AULA)
                FROM    TESTE_PHP.CARD CA
                ORDER   BY CA.NUM_AULA
            ";
            $sql = $this->db->prepare($sql);
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getMaterial($param){
        $sql = "
                SELECT  CM.ID_CARD,
                CM.ID_MATERIAL, 
                M.MATERIAL,
                M.ICONE
                FROM CARD_MATERIAL CM INNER JOIN
                     MATERIAL M
                     ON CM.ID_MATERIAL = M.ID_MATERIAL
                WHERE ID_CARD = :ID_CARD
        ";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':ID_CARD', $param);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCards($param){

        /* SQL DINAMICO DE ACORDO COM OS PARAMETROS DO FILTRO. */

        $sql = "
            SELECT  C.CURSO,
                    T.TIPO,
                    S.STATUS,
                    S.COR, 
                    CA.ID_CARD,
                    CA.ID_TIPO,
                    CA.ID_CURSO,
                    CA.ID_STATUS,
                    CA.DT_REGISTRO,
                    CA.ANO,
                    CA.NUM_AULA

            FROM    TESTE_PHP.CARD CA LEFT JOIN 
                    TESTE_PHP.CURSO C
                    ON CA.ID_CURSO = C.ID_CURSO

                    INNER JOIN TESTE_PHP.TIPO T
                    ON CA.ID_TIPO = T.ID_TIPO

                    INNER JOIN TESTE_PHP.STATUS S 
                    ON CA.ID_STATUS = S.ID_STATUS";
    
        if($param['filtro_curso'] != '' && $param['filtro_curso'] != 'n'){
            $sql .= " AND CA.ID_CURSO = :ID_CURSO";
        }
        
        if($param['num_aula'] != 'n' && $param['num_aula'] != ''){
            $sql .= " AND CA.NUM_AULA = :NUM_AULA";
        }
        if($param['filtro_professor'] != ''){
            $sql .= "     
                    AND CA.ID_CARD IN (
                        SELECT  DISTINCT(CP.ID_CARD) AS ID_CARD
                        FROM TESTE_PHP.CARD CA INNER JOIN 
                             TESTE_PHP.CARD_PROFESSOR CP	 
                        ON CP.ID_CARD = CA.ID_CARD 
                        INNER JOIN TESTE_PHP.PROFESSOR P
                        ON P.ID_PROFESSOR = CP.ID_PROFESSOR
                        WHERE SUBSTRING_INDEX(P.NOME, ' ', 1) LIKE :NOME OR SUBSTRING_INDEX(P.NOME, ' ', -1) LIKE :NOME
                    ORDER BY P.NOME
                    )";
        }

       /* ORDENAÇAO DE ACORDO COM O FILTRO, A ORDENÇAO POR NOME NAO É FEITA POR SQL E SIM POR UMA FUNÇAO PHP. */
        if($param['ordenar_por'] != 'professor'){
            if($param['ordenar_por'] != 'curso')
                $sql .= " ORDER BY CA.".$param['ordenar_por']." ".$param['ordenar_por_modo'];
            else
                $sql .= " ORDER BY C.".$param['ordenar_por']." ".$param['ordenar_por_modo'];
        }

        $sql = $this->db->prepare($sql);

        if($param['filtro_curso'] != '' && $param['filtro_curso'] != 'n'){
            $sql->bindValue(':ID_CURSO', $param['filtro_curso']);
        }

        if($param['filtro_professor'] != ''){
            $sql->bindValue(':NOME', '%'.$param['filtro_professor'].'%');
        }  

        if($param['num_aula'] != 'n' && $param['num_aula'] != ''){
            $sql->bindValue(':NUM_AULA', $param['num_aula']);
        }   
            
            $sql->execute();
            return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function cardExists($id_card){
        $sql = "
            SELECT *
            FROM   TESTE_PHP.CARD CA
            WHERE  CA.ID_CARD = :ID_CARD
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':ID_CARD', $id_card);
        $sql->execute();
        if($sql->rowCount() > 0){
			return true;
		} else {
			return false;
		}
    }

    public function getLastDate($id_card){
        /* PEGA A DATA DA ULTIMA MOVIMENTAÇAO DO CARD*/
        $sql = "
                SELECT MAX(DT_REGISTRO) AS DT_REGISTRO 
                FROM   TESTE_PHP.CARD_MOVIMENTACAO CM
                WHERE  CM.ID_CARD = :ID_CARD
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':ID_CARD', $id_card);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getLastStatus($id_card,$id_status){
        /* PEGA O ULTIMO STATUS DO CARD*/
        $sql = "
                SELECT MAX(CM.ID_STATUS) AS ULTIMO_STATUS
                FROM   TESTE_PHP.CARD_MOVIMENTACAO CM
                WHERE  CM.ID_CARD = :ID_CARD
                AND    CM.ID_STATUS <> :ID_STATUS
                AND    CM.ID_STATUS < :ID_STATUS
                ORDER BY CM.DT_REGISTRO
        ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':ID_CARD', $id_card);
        $sql->bindValue(':ID_STATUS', $id_status);
        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStatus($id_card,$id_status){
        if($this->cardExists($id_card) == true) {
            $sql = "UPDATE TESTE_PHP.CARD SET ID_STATUS = :ID_STATUS WHERE ID_CARD = :ID_CARD";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':ID_STATUS', $id_status);
            $sql->bindValue(':ID_CARD', $id_card);
            $sql->execute();
            $this->logMovimentacao($id_card,$id_status);
            return true;
		} else {
			return false;
		}
    }

    public function logMovimentacao($id_card,$id_status){
            $sql = "INSERT INTO TESTE_PHP.CARD_MOVIMENTACAO (ID_CARD, ID_STATUS, DT_REGISTRO) VALUES (:ID_CARD,:ID_STATUS,NOW())";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':ID_STATUS', $id_status);
            $sql->bindValue(':ID_CARD', $id_card);
            $sql->execute();
    }

   
}
?>