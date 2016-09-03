$(function () {

    var inputTH = $('.typeahead');


    //var pacientes;
    inputTH.typeahead({
        items: 10,
        ajax: {
            url: inputTH.data('action'),
            timeout: 300,
            triggerLength: 1,
            method: "get",
            preDispatch: function (query) {
                return {
                    nome: query
                }
            },
            preProcess: function (json) {

                if (!json) return false;

                var itens = [];
                $.each(json, function (i, pac) {

                    itens.push({
                        id: JSON.stringify(pac),
                        name: pac.nome
                    });
                });

                return itens;
            }
        },
        onSelect: function (item) {

            var pac = JSON.parse(item.value);

            var endereco = pac.endereco.logradouro;
            endereco += ', n° ' + pac.endereco.numero;
            endereco += ', ' + pac.endereco.bairro;
            endereco += ', ' + pac.endereco.cidade;
            endereco += ' (' + pac.endereco.uf + ')';

            $('.pac-nome').text(pac.nome);
            $('.pac-endereco').text(endereco);
            $('.pac-telefone').text(pac.contato.telefone);
        }
    });


    $('main .dt').datetimepicker({
        locale: 'pt-br',
        tooltips: window.settings.datepicker.tooltips,
        format: 'DD/MM/YYYY',
        focusOnShow: false,
        showClose: true,
        showTodayButton: true
    });
});