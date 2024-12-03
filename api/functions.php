<?php

function getEntriesCount($pConn, $pTable, $pRole = null) {

    $conn = (isset($pConn)) ? $pConn : null;
    $table = (isset($pTable)) ? $pTable : null;
    $role = (isset($pRole)) ? $pRole : null;
    $sql;

    if (empty($conn) || empty($table)) return;

    $sql = (isset($role)) ? "SELECT COUNT(*) AS total_entries FROM $pTable WHERE role = :role" : "SELECT COUNT(*) AS total_entries FROM $pTable";

    $stmt = $conn->prepare($sql);
    if (isset($role)) $stmt->bindParam(":role", $pRole);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['total_entries'];

    return $count;

}

function getAccountsData($pConn, $pRole = null) {

    $conn = (isset($pConn)) ? $pConn : null;
    $role = (isset($pRole)) ? $pRole : null;
    $sql;

    if (empty($conn)) return;
    
    $sql = (empty($role)) ? "SELECT * FROM accounts" : "SELECT * FROM accounts WHERE role = :role";
    
    $stmt = $conn->prepare($sql);
    if (isset($role)) { $stmt->bindParam(":role", $role); }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function getStudentsData($pConn, $pStatus = null) {

    $conn = (isset($pConn)) ? $pConn : null;
    $status = (isset($pStatus)) ? $pStatus : null;
    $sql;

    if (empty($conn)) return;
    
    $sql = (empty($status)) ? "SELECT * FROM students" : "SELECT * FROM students WHERE status = :status";

    $stmt = $conn->prepare($sql);
    if (isset($status)) { $stmt->bindParam(":status", $status); }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function deleteData($pConn, $pTable, $pId) {

    $conn = (isset($pConn)) ? $pConn : null;
    $table = (isset($pTable)) ? $pTable : null;
    $id = (isset($pId)) ? $pId : null;

    if (empty($conn) || empty($table) || empty($id)) return;

    $stmt = $conn->prepare("DELETE FROM $table WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    exit();
}

?>