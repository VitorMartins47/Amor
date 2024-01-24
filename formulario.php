<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a opção foi selecionada
    if (isset($_POST["opcao"])) {
        // Dados a serem enviados para o Firebase
        $data = [
            'opcao' => $_POST["opcao"]
        ];

        // Converte os dados para o formato JSON
        $json_data = json_encode($data);

        // URL do Firebase Realtime Database
        $firebaseURL = 'https://amor-df38d-default-rtdb.firebaseio.com/opcoes.json';

        // Configuração do cURL
        $ch = curl_init($firebaseURL);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data)
        ]);

        // Executa a requisição cURL
        $result = curl_exec($ch);

        // Verifica por erros
        if (curl_errno($ch)) {
            echo 'Erro ao enviar dados para o Firebase: ' . curl_error($ch);
        } else {
            echo 'Dados enviados para o Firebase com sucesso!';
        }

        // Fecha a sessão cURL
        curl_close($ch);
    }
}
?>
