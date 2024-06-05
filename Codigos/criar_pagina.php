<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['title']) && isset($data['content']) && isset($data['author'])) {
        $title = $data['title'];
        $content = $data['content'];
        $author = $data['author'];
        
        
        $filename = urlencode(strtolower(str_replace(' ', '_', $title)) . '.html');
        
        
        $filePath = 'documentos/' . $filename;

        
        if (!file_exists('documentos')) {
            mkdir('documentos', 0777, true);
        }

        
        $htmlContent = "<!DOCTYPE html>
        <html lang=\"pt-BR\">
        <head>
            <meta charset=\"UTF-8\">
            <title>{$title}</title>
        </head>
        <body>
            {$content}
            <footer>
                <p>Autor: {$author}</p>
            </footer>
        </body>
        </html>";

        // Salva o arquivo no servidor
        if (file_put_contents($filePath, $htmlContent)) {
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "glassboard";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
                exit();
            }

            // Inserir os detalhes do documento no banco de dados
            $sql = "INSERT INTO documentos (title, filename, author) VALUES ('$title', '$filename', '$author')";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['success' => true, 'url' => $filePath]);
            } else {
                echo json_encode(['success' => false, 'error' => $conn->error]);
            }

            $conn->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to write file']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>
