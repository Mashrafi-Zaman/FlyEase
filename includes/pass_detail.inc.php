<?php
session_start();
if (isset($_POST['pass_but']) && isset($_SESSION['userId'])) {
    require '../helpers/init_conn_db.php';
    
    $mobile_flag = false;
    $flight_id = $_POST['flight_id'];
    $passengers = $_POST['passengers'];
    $mob_len = count($_POST['mobile']);
    
    // Check mobile numbers length
    foreach ($_POST['mobile'] as $mobile) {
        if (strlen($mobile) !== 11) {
            $mobile_flag = true;
            break;
        }
    }
    
    if ($mobile_flag) {
        header('Location: ../pass_form.php?error=moblen');
        exit();
    }
    
    
    
    // Check passenger profile existence
    $sql = 'SELECT * FROM Passenger_profile WHERE flight_id = ? AND user_id = ?';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../pass_form.php?error=sqlerror');
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, 'ii', $flight_id, $_SESSION['userId']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $pass_id = null;
        while ($row = mysqli_fetch_assoc($result)) {
            $pass_id = $row['passenger_id'];
        }
    }

    // If passenger profile doesn't exist, reset auto increment
    if (is_null($pass_id)) {
        $sql = 'ALTER TABLE Passenger_profile AUTO_INCREMENT = 1';
        if (!mysqli_query($conn, $sql)) {
            header('Location: ../pass_form.php?error=sqlerror');
            exit();
        }
    }

    // Insert passenger profiles
    $sql = 'INSERT INTO Passenger_profile (user_id, mobile, dob, f_name, m_name, l_name, flight_id) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ../pass_form.php?error=sqlerror');
        exit();
    } else {
        $flag = false;
        foreach ($_POST['date'] as $i => $date) {
            mysqli_stmt_bind_param($stmt, 'isssssi', $_SESSION['userId'], $_POST['mobile'][$i], $date, $_POST['firstname'][$i], $_POST['midname'][$i], $_POST['lastname'][$i], $flight_id);
            mysqli_stmt_execute($stmt);
            $flag = true;
        }
        if ($flag) {
            $_SESSION['flight_id'] = $flight_id;
            $_SESSION['class'] = $_POST['class'];
            $_SESSION['passengers'] = $passengers;
            $_SESSION['price'] = $_POST['price'];
            $_SESSION['type'] = $_POST['type'];
            $_SESSION['ret_date'] = $_POST['ret_date'];
            $_SESSION['pass_id'] = $pass_id + 1;
            header('Location: ../payment.php');
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header('Location: ../pass_form.php');
    exit();
}
?>
