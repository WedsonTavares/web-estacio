document.getElementById('nextBtn').addEventListener('click', function() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
  });
  
  document.getElementById('searchAddress').addEventListener('click', function() {
    const cep = document.getElementById('cep').value;
    const addressResult = document.getElementById('addressResult');
  
    addressResult.innerHTML = '';
  
    if (cep.length !== 8 || isNaN(cep)) {
        addressResult.innerHTML = 'Por favor, insira um CEP válido.';
        return;
    }
  
    const url = `https://viacep.com.br/ws/${cep}/json/`;
  
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar o endereço.');
            }
            return response.json();
        })
        .then(data => {
            if (data.erro) {
                addressResult.innerHTML = 'CEP não encontrado.';
            } else {
                document.getElementById('logradouro').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
                addressResult.innerHTML = 'Endereço preenchido. Você pode editá-lo.';
            }
        })
        .catch(error => {
            addressResult.innerHTML = 'Erro ao buscar o endereço: ' + error.message;
        });
  });
  
  // Lidar com o envio do formulário
  document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Formulário enviado com sucesso!');
  });