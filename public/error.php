<?php

    if (!isset($_SESSION)) { session_start(); }

    $code = (isset($_GET['code'])) ? $_GET['code'] : 500;

    function getHttpResponseCodeInfo($code) {

        $title;
        $description;

        switch ($code) {

            case 400:

                $title = 'Bad Request';
                $description = 'The request you made was invalid or malformed. Please check the URL or the request details and try again.';
                break;

            case 401:

                $title = 'Unauthorized';
                $description = 'You need to log in to access this page. You may have entered incorrect credentials or need to authenticate.';
                break;

            case 403:

                $title = 'Forbidden';
                $description = 'You don’t have permission to access this page. This could be because you’re not authorized or the server is blocking your request for some reason.';
                break;

            case 404:

                $title = 'Not Found';
                $description = 'The page you’re looking for doesn’t exist. This might happen if the URL is misspelled or if the page was moved or deleted.';
                break;

            default:

                $title = 'Internal Server Error';
                $description = 'The server encountered an unexpected condition that prevented it from fulfilling the request. This is a generic error message.';
                break;

        }

        return array('title' => $title, 'description' => $description);

    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $responseInfo = getHttpResponseCodeInfo($code);
        
        http_response_code($code);
        $_SESSION['error']['handler'] = array(
            'title' => $responseInfo['title'],
            'description' => $responseInfo['description']
        );

    }

    require_once __DIR__ . "/../src/error.view.php";
    session_write_close();
    exit();

?>