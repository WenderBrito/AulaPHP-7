<?php
class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

     public function getIdusuario(){
        return $this->idusuario;
     }
     public function setIdusuario($value){
         $this->getIdusuario = $value;
     }

    public function getdeslogin()
    {
        return $this->deslogin;
    }
    public function setdeslogin($value){
        $this->deslogin = $value;
    }

    public function getdessenha()
    {
        return $this->dessenha;
    }
    public function setdessenha($value)
    {
        $this->dessenha = $value;
    }

    public function getdtcadastro()
    {
        return $this->dtcadastro;
    }
    public function setdtcadastro($value)
    {
        $this->dtcadastro = $value;
    }
    public function loadById($id)
    {
        $sql = new Sql();
        $results = $sql->select("select *from tb_ususarios where idusuario = :ID", array(
            ":ID" => $id
        ));
        if (count($results) > 0) {
            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setdeslogin($row['deslogin']);
            $this->setdessenha($row['dessenha']);
            $this->setdtcadastro(new DateTime($row['dtcadastro']));
        }}

        public static function getList(){
                $sql = new Sql();
                return $sql->select("select * from tb_usuarios order by deslogin;");
        }
        public static function search($Login){
            $sql = new Sql();
            return $sql->select("select * from tb_usuarios where deslogin like :SEARCH order BY deslogin", array(
                ':SEARCH'=>"%".$Login."%"
            ));
        }
        public function login($login, $password){
        $sql = new Sql();
        $results = $sql->select("select *from tb_usuarios where deslogin = :LOGIN and dessenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD"=> $password
        ));
        if (count($results) > 0) {
            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }else{
            throw new Exception("Login ou senha Invalido.");
            
        }
    }

    public function __toString(){
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getdeslogin(),
            "dessenha"=>$this->getdessenha(),
            "dtcadastro"=>$this->getdtcadastro()->format("d/m/Y H:i")
        ));
    }

}
?>