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

function getCoursesData($pConn) {

    $conn = (isset($pConn)) ? $pConn : null;

    if (empty($conn)) return;

    $stmt = $conn->prepare("SELECT * FROM courses");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function getCourseDataByProgram($pConn, $pProgram) {

    $conn = (isset($pConn)) ? $pConn : null;
    $program = (isset($pProgram)) ? $pProgram : null;

    if (empty($conn) || empty($program)) return;

    $stmt = $conn->prepare("SELECT * FROM courses WHERE program = :program");
    if (isset($program)) { $stmt->bindParam(":program", $program); }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function getCourseDataByCreatedBy($pConn, $pCreatedBy) {

    $conn = (isset($pConn)) ? $pConn : null;
    $createdBy = (isset($pCreatedBy)) ? $pCreatedBy : null;

    if (empty($conn) || empty($createdBy)) return;

    $stmt = $conn->prepare("SELECT * FROM courses WHERE created_by = :created_by");
    if (isset($program)) { $stmt->bindParam(":created_by", $pCreatedBy); }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function getEnrolledData($pConn) {

    $conn = (isset($pConn)) ? $pConn : null;

    if (empty($conn)) return;

    $stmt = $conn->prepare("SELECT * FROM enrolled");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function getEnrolledDataByStudentId($pConn, $pId) {

    $conn = (isset($pConn)) ? $pConn : null;
    $id = (isset($pId)) ? $pId : null;

    if (empty($conn) || empty($pId)) return;

    $stmt = $conn->prepare("SELECT * FROM enrolled WHERE student_id = :student_id");
    $stmt->bindParam(":student_id", $id);
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

function acceptPendingStudentAccount($pConn, $pId) {

    $conn = (isset($pConn)) ? $pConn : null;
    $id = (isset($pId)) ? $pId : null;

    if (empty($conn) || empty($id)) return;

    $stmt = $conn->prepare("UPDATE students SET status = 'active' WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    exit();
    
}

function registerStudent($pConn, $pData) {

    // Validate connection and data
    if (empty($pConn) || empty($pData)) {
        error_log("Invalid database connection or data.");
        $_SESSION['error']['auth'] = "Registration failed. Please try again.";
        return false;
    }

    $conn = $pConn;

    // Set default status
    $status = 'pending';

    try {
        // Prepare SQL query
        $stmt = $conn->prepare(
            "INSERT INTO students(username, status, program, first_name, last_name, password) 
             VALUES (:username, :status, :program, :first_name, :last_name, :password)"
        );

        // Bind parameters
        $stmt->bindParam(":username", $pData['username']);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":program", $pData['program']);
        $stmt->bindParam(":first_name", $pData['first_name']);
        $stmt->bindParam(":last_name", $pData['last_name']);
        $stmt->bindParam(":password", $pData['password']);

        // Execute query
        $stmt->execute();

        // Log success
        error_log("User registered successfully: " . $pData['username']);
        return true;

    } catch (PDOException $e) {
        // Log error and set session error
        error_log("Database Error: " . $e->getMessage());
        $_SESSION['error']['auth'] = "Registration failed due to a database error. Please try again.";
        return false;
    }
}

function addFaculty($pConn, $pData) {

    $conn = (isset($pConn)) ? $pConn : null;
    $data = (isset($pData)) ? $pData : null;

    if (empty($conn) || empty($data)) return;

    $stmt = $conn->prepare("INSERT INTO accounts (username, role, email, first_name, last_name, password) VALUES (:username, :role, :email, :first_name, :last_name, :password)");
    $stmt->bindParam(":username", $data['username']);
    $stmt->bindParam(":role", $data['role']);
    $stmt->bindParam(":email", $data['email']);
    $stmt->bindParam(":first_name", $data['first_name']);
    $stmt->bindParam(":last_name", $data['last_name']);
    $stmt->bindParam(":password", $data['first_name']);
    $stmt->execute();

    exit();

}

function addCourse($pConn, $pData) {

    $conn = (isset($pConn)) ? $pConn : null;
    $data = (isset($pData)) ? $pData : null;

    if (empty($conn) || empty($data)) return;

    $stmt = $conn->prepare("INSERT INTO courses (title, description, program, created_by) VALUES (:title, :description, :program, :created_by)");
    $stmt->bindParam(":title", $data['title']);
    $stmt->bindParam(":description", $data['description']);
    $stmt->bindParam(":program", $data['program']);
    $stmt->bindParam(":created_by", $data['created_by']);
    $stmt->execute();

    exit();
    
}

function enrollCourse($pConn, $pStudentId, $pCourseId) {

    $conn = (isset($pConn)) ? $pConn : null;
    $studentId = (isset($pStudentId)) ? $pStudentId : null;
    $courseId = (isset($pCourseId)) ? $pCourseId : null;

    if (empty($conn) || empty($studentId) || empty($courseId)) return;

    $stmt = $conn->prepare("SELECT * FROM enrolled WHERE student_id = :student_id");
    $stmt->bindParam(":student_id", $studentId);
    $stmt->execute();
    $courseResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($courseResult) return;

    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = :id");
    $stmt->bindParam(":id", $courseId);
    $stmt->execute();
    $courseResult = $stmt->fetch(PDO::FETCH_ASSOC);

    $paid = 'false';
    $stmt = $conn->prepare("INSERT INTO enrolled (course, student_id, paid) VALUES (:course, :student_id, :paid)");
    $stmt->bindParam(":course", $courseResult['title']);
    $stmt->bindParam(":student_id", $studentId);
    $stmt->bindParam(":paid", $paid);
    $stmt->execute();

}

function payCourse($pConn, $pStudentId) {

    $conn = (isset($pConn)) ? $pConn : null;
    $studentId = (isset($pStudentId)) ? $pStudentId : null;

    if (empty($conn) || empty($studentId)) return;

    $paid = 'true';
    $stmt = $conn->prepare("UPDATE enrolled SET paid = :paid WHERE student_id = :student_id");
    $stmt->bindParam(":paid", $paid);
    $stmt->bindParam(":student_id", $studentId);
    $stmt->execute();

}

function getPaidEnrolledCourses($pConn, $pId) {

    $conn = (isset($pConn)) ? $pConn : null;
    $id = (isset($pId)) ? $pId : null;
    
    if (empty($conn) || empty($id)) return;

    $paid = "true";
    $stmt = $conn->prepare("SELECT * FROM enrolled WHERE student_id = :student_id AND paid = :paid");
    $stmt->bindParam(":student_id", $id);
    $stmt->bindParam(":paid", $paid);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

?>