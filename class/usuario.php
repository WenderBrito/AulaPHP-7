<?php
class Usuario{
    private $IdUsuario;
    private $DesLogin;
    private $DesSenha;
    private $DtCadastro;

     public function getIdUsuario(){
        return $this->IdUsuario;
     }
     public function setIdUsuario($value){
         $this->IdUsuario = $value;
     }

    public function getDesLogin()
    {
        return $this->DesLogin;
    }
    public function setDesLogin($value){
        $this->DesLogin = $value;
    }

    public function getDesSenha()
    {
        return $this->DesSenha;
    }
    public function setDesSenha($value)
    {
        $this->DesSenha = $value;
    }

    public function getDtCadastro()
    {
        return $this->DtCadastro;
    }
    public function setDtCadastro($value)
    {
        $this->DtCadastro = $value;
    }
    public function loadById($id)
    {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario =  :ID", array(
            ":ID" => $id
        ));
        if (count($results) > 0) {
            $this->setData($results[0]); 
        }}

        public static function getList(){
                $sql = new Sql();
                return $sql->select("SELECT * FROM tb_usuarios order by DesLogin;");
        }
        public static function search($Login){
            $sql = new Sql();
            return $sql->select("SELECT * FROM tb_usuarios WHERE DesLogin like :SEARCH order BY DesLogin", array(
                ':SEARCH'=>"%".$Login."%"
            ));
        }
        public function login($login, $password){
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE DesLogin = :LOGIN and DesSenha = :PASSWORD", array(
            ":LOGIN" => $login,
            ":PASSWORD"=> $password
        ));
        if (count($results) > 0) {
            $this->setData($results[0]); 
            
        }else{
            throw new Exception("Login ou senha Invalido.");
            
        }
    }

    public function setData($data){
        $this->setIdUsuario($data['idusuario']);
        $this->setDesLogin($data['deslogin']);
        $this->setDesSenha($data['dessenha']);
        $this->setDtCadastro(new DateTime($data['dtcadastro']));
        ;
    }

    public function insert(){
        $sql = new Sql();

       $results =  $sql -> select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
                ':LOGIN' => $this->getDesLogin(),
                ':PASSWORD' => $this->getDesSenha()
       ));
       if (count($results) > 0){
           $this->setData($results[0]);
       }
    }

    public function update($login, $password){
        
        $this->setDesLogin($login);
        $this->setDesSenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios set deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
            ':LOGIN' => $this->getDesLogin(),
            ':PASSWORD' => $this->getDesSenha(),
            ':ID' => $this->getIdUsuario()
        ));
    }

    public function __construct($login="", $password=""){
        $this->setDesLogin($login);
        $this->setDesSenha($password);
        
    }

    public function __toString(){
        return json_encode(array(
            "IdUsuario"=>$this->getIdUsuario(),
            "DesLogin"=>$this->getDesLogin(),
            "DesSenha"=>$this->getDesSenha(),
            "DtCadastro"=>$this->getDtCadastro()->format("d/m/Y H:i")
        ));
    }

}
?>