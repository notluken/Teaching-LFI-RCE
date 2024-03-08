<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerabilidades LFI, RCE</title>
    <style>
        /* Estilos CSS para el modo oscuro */
        body {
            background-color: #111;
            color: #eeee;
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        /* Estilos CSS para los formularios y etiquetas */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            color: #eeee;
            margin-bottom: 0.5rem;
        }

        input {
            background-color: #2222;
            color: #eeee;
            border: none;
            padding: 0.5rem;
            border-radius: 0.25rem;
            transition: background-color 0.25s ease;
        }

        input:focus {
            outline: none;
            background-color: #3333;
        }

        input[type="submit"] {
            background-color: #4444;
            cursor: pointer;
            transition: background-color 0.25s ease;
        }

        input[type="submit"]:hover {
            background-color: #5555;
        }
    </style>
</head>
<body>
    <h1>Vulnerabilidades LFI, RCE</h1>
    <hr>

    <h2>1. Vulnerabilidad LFI (Inclusión Local de Archivos)</h2>
    <p>La vulnerabilidad LFI permite a un atacante leer archivos del sistema que no deberían ser accesibles a través de la aplicación web. Esto puede llevar a la exposición de información confidencial o incluso a la ejecución de código malicioso.</p>
    <form action="" method="GET">
        <label for="lfi_file">Archivo a incluir (local):</label>
        <input type="text" id="lfi_file" name="file" placeholder="/etc/passwd" required>
        <input type="submit" value="Incluir archivo">
    </form>
    <pre>
         <?php
      $file = $_GET['file'] ?? '';
      if (isset($file) && !empty($file)) {
        if (file_exists($file)) {
          echo file_get_contents($file);
        } else {
          echo "[!] El archivo no existe.";
        }
      }
    ?>
    </pre>

    <h2>2. Vulnerabilidad RCE (Ejecución Remota de Código)</h2>
    <p>La vulnerabilidad RCE permite a un atacante ejecutar código arbitrario en el servidor afectado. Esto puede llevar a la toma de control total del servidor y la ejecución de comandos maliciosos.</p>
    <form action="" method="GET">
        <label for="rce_command">Comando a ejecutar:</label>
        <input type="text" id="rce_command" name="command" placeholder="ls" required>
        <input type="submit" value="Ejecutar comando">
    </form>
    <pre>
     <?php
      $command = $_GET['command'] ?? '';
      if (isset($command) && !empty($command)) {
        if (strpos($command, ';') !== false || strpos($command, '|') !== false || strpos($command, '>') !== false || strpos($command, '`') !== false) {
          echo "[!] Comando no válido.";
        } else {
          $escapedCommand = escapeshellcmd($command);
          system($escapedCommand);
        }
      }
    ?>
    </pre>
</body>
</html>