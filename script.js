document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('nextBtn').addEventListener('click', function() {
      // Esconde a primeira etapa do formulário
      document.getElementById('step1').style.display = 'none';
      // Mostra a segunda etapa do formulário
      document.getElementById('step2').style.display = 'block';
    });
  
    // Adiciona um event listener ao botão "Buscar Endereço" para buscar o endereço com base no CEP
    document.getElementById('searchAddress').addEventListener('click', function() {
      
      const cep = document.getElementById('cep').value;
      const addressResult = document.getElementById('addressResult');
  
  
      // Verifica se o CEP é válido (deve ter 8 dígitos e ser numérico)
      if (cep.length !== 8 || isNaN(cep)) {
        addressResult.innerHTML = 'Por favor, insira um CEP válido.';
        return;
      }
      
  
      // URL da API para buscar o endereço com base no CEP
      const url = `https://viacep.com.br/ws/${cep}/json/`;
      console.log (cep)
  
      // Faz uma requisição à API para buscar o endereço
      fetch(url)
        .then(response => {
          // Verifica se a resposta da API é válida
          if (!response.ok) {
            throw new Error('Erro ao buscar o endereço.');
          }
          return response.json();
        })
        .then(data => {
          // Verifica se o CEP foi encontrado
          if (data.erro) {
            addressResult.innerHTML = 'CEP não encontrado.';
          } else {
            // Preenche os campos do formulário com os dados do endereço
            document.getElementById('logradouro').value = data.logradouro;
            document.getElementById('bairro').value = data.bairro;
            document.getElementById('cidade').value = data.localidade;
            document.getElementById('estado').value = data.uf; 
            console.log(data);
            
           
          }
        })
       
    });
  
    // Adiciona um event listener ao formulário para lidar com o envio
    document.getElementById('myForm').addEventListener('submit', function(event) {
    
      
      alert('Formulário enviado com sucesso!');
      window.open('PaginaFilme.html');
      
    });
  });


// Script de Validação da página de login

document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
  
    if (loginForm) {
      loginForm.addEventListener("submit", function (event) {
        event.preventDefault();
  
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
  
        let erroEmail = document.getElementById("erro-email");
        let erroPassword = document.getElementById("erro-password");
  
        erroEmail.textContent = "";
        erroPassword.textContent = "";
  
        let estaValido = true;
  
        if (email === "" || !email.includes("@")) {
          erroEmail.textContent = "Por favor, entre um email válido.";
          estaValido = false;
        }
  
        if (password === "" || password.length < 3) {
          erroPassword.textContent = "Por favor, entre uma senha válida.";
          estaValido = false;
        }
  
        if (estaValido) {
          window.location.href = "PaginaFilme.html";
        }
      });
    }
  });





  