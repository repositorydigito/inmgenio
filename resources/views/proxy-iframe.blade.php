<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Power BI Embed</title>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        #embed-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <div id="embed-container"></div>

    <script>
        // La URL está codificada en base64 para que no sea visible en el código fuente
        document.addEventListener('DOMContentLoaded', function() {
            // Crear un iframe dinámicamente
            var iframe = document.createElement('iframe');
            
            // URL del dashboard de Power BI codificada en base64
            var encodedUrl = '{{ base64_encode($url) }}';
            var url = atob(encodedUrl); // Decodificar base64
            
            // Configurar iframe
            iframe.setAttribute('src', url);
            iframe.setAttribute('frameborder', '0');
            iframe.setAttribute('allowfullscreen', 'true');
            iframe.setAttribute('style', 'width: 100%; height: 100%; border: none;');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.setAttribute('scrolling', 'no');
            
            // Añadir iframe al documento
            document.getElementById('embed-container').appendChild(iframe);
            
            // Ajustar tamaño si es necesario
            window.addEventListener('resize', function() {
                // Asegurar que el iframe siempre ocupe todo el espacio disponible
                iframe.style.width = '100%';
                iframe.style.height = '100%';
            });
        });
    </script>
</body>
</html> 