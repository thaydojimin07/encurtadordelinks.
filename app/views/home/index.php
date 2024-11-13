<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Encurtador de Links</title>
  <style>
    <?php include 'stylelinks.css';?>
  </style>
</head>

<body class="bg-white text-gray-800 w-full h-full">
  <div class="flex flex-col items-center justify-center bg-white rounded mt-32 p-8">
    <div class="w-full max-w-4xl mx-auto p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="flex flex-col justify-center items-center md:items-start text-center md:text-left">
        <h1 class="text-4xl font-bold mb-4">Encurtador de Links</h1>
        <p class="text-lg text-gray-600">Cole sua URL longa e encurte-a!</p>
      </div>
      <div class="flex flex-col justify-center items-center">
        <form id="shortener-form" class="flex flex-col">
          <input type="text" id="url-input" placeholder="Cole sua URL aqui" class="border border-gray-300 p-2 rounded mb-4 w-48" required>
          <button type="submit" class="bg-slate-900 text-white font-semibold text-lg py-2 px-4 rounded-full hover:bg-slate-600 w-48 text-center mb-4">
            Encurtar
          </button>
        </form>
        <div class="result" id="result-container">
          <span>Link encurtado:</span>
          <a href="#" id="shortened-link" class="shortened-link text-blue-500 hover:underline"></a>
        </div>
        <span class="mb-4 text-black">ou</span>
        <a href="/login" class="bg-slate-900 text-white font-semibold text-lg py-2 px-4 rounded-full hover:bg-slate-600 w-48 text-center mb-4">
          Login
        </a>
        <a href="/register" class="border border-blue-500 text-blue-500 font-semibold text-lg py-2 px-4 rounded-full hover:bg-blue-50 w-48 text-center">
          Cadastro
        </a>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('shortener-form').addEventListener('submit', function(event) {
      event.preventDefault(); // Evita o envio do formulário
      const urlInput = document.getElementById('url-input').value;
      const shortenedLink = `https://short.ly/${btoa(urlInput).substring(0, 8)}`; // Simulação de encurtamento
      document.getElementById('shortened-link').textContent = shortenedLink;
      document.getElementById('shortened-link').href = shortenedLink;
      document.getElementById('result-container').style.display = 'block'; // Mostra o link encurtado
    });
  </script>
</body>

</html>