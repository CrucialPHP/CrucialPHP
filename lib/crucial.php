<?php
class CrucialXML {
  function encode($obj) {
    return xmlrpc_encode($obj);
  }
  function decode($obj) {
    return xmlrpc_decode($obj);
  }
}
class CrucialJSON {
  function encode($obj) {
    return json_encode($obj);
  }
  function decode($obj) {
    return json_decode($obj);
  }
}
class CrucialSQL {
  private $conn = null;
  function connect($host, $user, $password, $database) {
    $this->conn = mysqli_connect($host, $user, $password, $database);
    if ($this->conn->connect_errno) {
      throw new Exception("CrucialSQL Connection Error: " . $this->conn->connect_error);
    }
    return $this->conn;
  }
  function prepared($sql, $data) {
    $conn = $this->conn;
    if (!$conn) {
      throw new Exception("CrucialSQL MySQL error! No connection!");
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    return $stmt->get_result();
  }
  function escape($str) {
    $conn = $this->conn;
    if (!$conn) {
      throw new Exception("CrucialSQL MySQL error! No connection!");
    }
    return mysqli_real_escape_string($conn, $str);
  }
  function evaluate($sql) {
    trigger_error("CrucialSQL MySQL warning: CrucialSQL->evaluate may result in unexpected results and is not recommended because it makes SQL injection easier. Use @ before using the function to suppress.");
    $conn = $this->conn;
    if (!$conn) {
      throw new Exception("CrucialSQL MySQL error! No connection!");
    }
    return $conn->query($sql);
  }
}
