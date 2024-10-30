


    $('.datepicker_mes_ano').datepicker({
        format: "mm/yyyy",         // Formato exibido no input
        minViewMode: 1,            // Exibe apenas mês e ano
        autoclose: true,           // Fecha o datepicker após selecionar
        todayHighlight: true,      // Destaca o mês/ano atual
        language: "pt-BR"          // Define o idioma (opcional)
    });


    $('.datepicker_inicio, .datepicker_fim, .datepicker_inicio_cronico,.datepicker_fim_cronico').datepicker({
        format: "dd/mm/yyyy",      // Formato exibido no input
        autoclose: true,           // Fecha o datepicker após selecionar
        todayHighlight: true,      // Destaca o mês/ano atual
        language: "pt-BR"          // Define o idioma (opcional)
    });

