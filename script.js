new Vue({
    el: "#appCep",
    data : {
        endereco: {
            cep: null,
            logradouro: null,
            uf: null,
            localidade: null,
            bairro: null,
            siafi: null,
            ibge: null,
            ddd: null,
            gia: null,
        }
    },
    methods: {
        cepEvento(){
            axios({
                method: "get",
                url: `https://viacep.com.br/ws/${this.endereco.cep}/json`,
                respondeType: "application/json"
            }).then(response => {
                var bean = response.data;
                this.endereco.logradouro = bean.logradouro;
                this.endereco.uf = bean.uf;
                this.endereco.localidade = bean.localidade;
                this.endereco.bairro = bean.bairro;
                this.endereco.siafi = bean.siafi;
                this.endereco.ibge = bean.ibge;
                this.endereco.ddd = bean.ddd;
                this.endereco.gia = bean.gia;
            });
        }
    }
});

