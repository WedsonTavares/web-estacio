// Adiciona um event listener ao botão "Próximo" para avançar para a próxima etapa do formulário
document.getElementById('nextBtn').addEventListener('click', function() {
    // Esconde a primeira etapa do formulário
    document.getElementById('step1').style.display = 'none';
    // Mostra a segunda etapa do formulário
    document.getElementById('step2').style.display = 'block';
});

// Adiciona um event listener ao botão "Buscar Endereço" para buscar o endereço com base no CEP
document.getElementById('searchAddress').addEventListener('click', function() {
    // Obtém o valor do campo de CEP
    const cep = document.getElementById('cep').value;
    // Obtém o elemento onde os resultados do endereço serão exibidos
    const addressResult = document.getElementById('addressResult');

    // Limpa qualquer mensagem anterior
    addressResult.innerHTML = '';

    // Verifica se o CEP é válido (deve ter 8 dígitos e ser numérico)
    if (cep.length !== 8 || isNaN(cep)) {
        addressResult.innerHTML = 'Por favor, insira um CEP válido.';
        return;
    }

    // URL da API para buscar o endereço com base no CEP
    const url = `https://viacep.com.br/ws/${cep}/json/`;

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
                addressResult.innerHTML = 'Endereço preenchido. Você pode editá-lo.';
            }
        })
        .catch(error => {
            // Exibe uma mensagem de erro se a requisição falhar
            addressResult.innerHTML = 'Erro ao buscar o endereço: ' + error.message;
        });
});

// Adiciona um event listener ao formulário para lidar com o envio
document.getElementById('myForm').addEventListener('submit', function(event) {
    // Previne o comportamento padrão de envio do formulário
    event.preventDefault();
    // Exibe uma mensagem de sucesso
    alert('Formulário enviado com sucesso!');
});



//               VALIDAÇÃO DO FORMULÁRIO DE CADASTRO

function validaForm() {
    const nome = document.getElementById("nome").value;
    const endereco = document.getElementById(
        "endereco"
    ).value;
    const email = document.getElementById("email").value;

    let erroNome = document.getElementById("erro-nome");
    let erroEndereco = document.getElementById(
        "erro-endereco"
    );
    let erroEmail = document.getElementById("erro-email");

    erroNome.textContent = "";
    erroEndereco.textContent = "";
    erroEmail.textContent = "";

    let estaValido = true;

    if (nome === "" || /\d/.test(nome)) {
        erroNome.textContent = 
            "Por favor, entre um nome apropriado.";
        estaValido = false;
    }

    if (endereco === "") {
        erroEndereco.textContent = 
            "Por favor, entre um endereço válido";
        estaValido = false;
    }

    if (email === "" || !email.includes("@")) {
        erroEmail.textContent = 
            "Por favor, entre um email válido";
        estaValido = false;
    }

    return estaValido;
}