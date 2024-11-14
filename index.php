<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Livraria</title>
  <style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        font-size: larger;
        background-color: rgb(13, 14, 27);
        color: white;
        justify-content: center;
        text-align: center;
        display: flex;
        flex-direction: column;
        min-height: 50vh;
        padding: 10%;
        display: flex;
    }
    .Formulario{
        padding: 15px;
        background-color: rgb(114, 115, 131);
        border-radius: 10px;
    }
    .Botao{
        padding: 10px;
        border-radius: 5px;
    }
    .Cabecalho{
        background-color: rgb(114, 115, 131);
        color: rgb(0, 0, 0);
    }
    .Itens{
        background-color: white;
        color: black;
    }
  </style>
  <script>
    function loadData() {
      fetch('database.php?action=read')
        .then(response => response.json())
        .then(data => {
          let table = document.getElementById('data');
          table.innerHTML = '';
          data.forEach(row => {
            table.innerHTML += `
              <tr>
                <td>${row.id}</td>
                <td>${row.titulo}</td>
                <td>${row.autor}</td>
                <td>${row.ano}</td>
                <td>
                  <button onclick="remove(${row.id})">Deletar</button>
                </td>
              </tr>
            `;
          });
        });
    }

    function save() {
      let titulo = document.getElementById('titulo').value;
      let autor = document.getElementById('autor').value;
      let ano = document.getElementById('ano').value;

      let formData = new FormData();
      formData.append('titulo', titulo);
      formData.append('autor', autor);
      formData.append('ano', ano);

      fetch(`add_book.php`, {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        alert(data);
        loadData();
        clearForm();
      });
    }

    function remove(id) {
      if (confirm('Tem certeza que deseja excluir?')) {
        fetch(`delete_book.php?action=delete&id=${id}`)
        .then(response => response.text())
        .then(data => {
          alert(data);
          loadData();
        });
      }
    }

    function clearForm() {
      document.getElementById('titulo').value = '';
      document.getElementById('autor').value = '';
      document.getElementById('ano').value = '';
    }

    window.onload = loadData;     
  </script>
</head>
<body>
  <h2>Banco de Dados da Livraria</h2>
  <form onsubmit="event.preventDefault(); save();" class="Formulario">
    <label for="titulo">Título do Livro:</label>
    <input type="text" id="titulo" name="titulo" required><br><br>

    <label for="autor">Autor do Livro:</label>
    <input type="text" id="autor" name="autor" required><br><br>

    <label for="ano">Ano de Publicação:</label>
    <input type="number" id="ano" name="ano" required><br><br>

    <input type="submit" value="Enviar" class="Botao">
  </form>

  <h3>Registros</h3>
  <table border="1">
    <thead>
      <tr class="Cabecalho">
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Ano de Publicação</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody id="data" class="Itens">
    </tbody>
  </table>
</body>
</html>
