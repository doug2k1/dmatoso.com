var diasTrabalhados = [];
var diasFolgas = [];

var meses = [
	'Janeiro',
	'Fevereiro',
	'Março',
	'Abril',
	'Maio',
	'Junho',
	'Julho',
	'Agosto',
	'Setembro',
	'Outubro',
	'Novembro',
	'Dezembro'
]

var dias = [
	'Domingo',
	'Segunda-feira',
	'Terça-feira',
	'Quarta-feira',
	'Quinta-feira',
	'Sexta-feira',
	'Sábado'
];

var fds = {'0':'dom', '6':'sab'};

function botaoEscalaFuncoes() {
	$('#addEscala').click(function(){
			var parent = $('.camposEscala');
			var html = "";
			var currentFields = $('.escalasContent').length;
			html += '<div class="escalasContent" id="escala_' + (currentFields + 1) + '">';
			html += '<label for="DiasDeTrabalho">Dias de trabalho <span class="required">*</span> </label><input maxlength="2" type="number" class="diasTrab ui-input-text ui-body-c" id="diasTrab_' + (currentFields + 1) + '"/>';
			html += '<label for="DiasDeFolga">Dias de Folga <span class="required">*</span> </label><input maxlength="2" type="number" class="diasFolg ui-input-text ui-body-c" id="diasFolg_' + (currentFields + 1) + '"/>';
      html += '<a href="javascript:void(0)" onclick="deleteMe(this)" class="deleteButton ui-icon ui-icon-delete ui-icon-shadow" title="Deletar jornada"></a> ';
			html += '</div>';
			parent.append(html);
			$('.optFolgas input:radio').prop("checked", false);
			var spanRadio = $('span.ui-icon-radio-on');			
			spanRadio.parent().parent().attr('data-icon', 'radio-off').removeClass('ui-radio-on').addClass('ui-radio-off');
			spanRadio.removeClass('ui-icon-radio-on').addClass('ui-icon-radio-off');
			if ($('.selecionarData').is(':visible')) {
				$('.selecionarData').hide();
			}
		});
}

function deleteMe(item) {
  $(item).parent().remove(); 
}

function setExibirFolgasFuncoes() {
	var messageBox = $('.message');
	$('#mostrarFolgas').click(function(){
		if ($('label.folgaAno').hasClass('ui-radio-on')) {			
			messageBox.hide().html('');
			calcularFolgas(true);
		}
		else if ($('label.folgaMes').hasClass('ui-radio-on')) {
			messageBox.hide().html('');
			calcularFolgas(false);
		}
		else {
			messageBox.show().html('<p>Por favor, selecione uma opção</p>');
			return false;
		}
	});
}

function setRadioButtonFuncoes() {	
	var messageBox = $('.message');
	$('.inpt-folgas').on('click', function() {		
		if ($('.escalasContent .diasFolg').length == 0) {
			messageBox.show().html('<p>Você precisa adicionar ao menos uma escala para dar continuidade</p>');
			return false;
		}
		if ($('.escalasContent .diasFolg').length != 0 
			&& $('.escalasContent .diasTrab').filter(function() { return this.value == ""; }).length == $('.escalasContent .diasTrab').length
			&& $('.escalasContent .diasFolg').filter(function() { return this.value == ""; }).length == $('.escalasContent .diasFolg').length) {
			messageBox.show().html('<p>Por favor, digite os valores necessários de suas escalas.</p>');
			return false;
			}
		if ($('.escalasContent .diasFolg').length != 0 && $('.escalasContent .diasFolg').filter(function() { return this.value == ""; }).length == $('.escalasContent .diasFolg').length) {
			messageBox.show().html('<p>Por favor, digite a quantidade de dias das Folgas para suas escalas</p>');
			return false;
		}
		if ($('.escalasContent .diasTrab').length != 0 && $('.escalasContent .diasTrab').filter(function() { return this.value == ""; }).length == $('.escalasContent .diasTrab').length) {
			messageBox.show().html('<p>Por favor, digite a quantidade de dias Trabalhados de suas escalas</p>');
			return false;
		}
		var valido = true;
		var msgErro = "";
		$('.escalasContent').each(function(key, val) {
			if ($.trim($(this).find('.diasFolg').val()) == '') {
				msgErro += "<strong>Escala " + (key + 1) + ":</strong> quantidade de dias de folga é obrigatório.<br/>";
				valido = false;
			}
			if ($.trim($(this).find('.diasTrab').val()) == '') {
				msgErro += "<strong>Escala " + (key + 1) + ":</strong> quantidade de dias de trabalho é obrigatório.<br/>";
				valido = false;
			}
			
		});		
		if (valido) {			
			messageBox.hide();
			diasDasEscalas();		
		}		
		else {
			var erro = "<h3>Alguns erros foram encontrados e precisam ser verificados antes de dar continuidade:</h3>"
			messageBox.show().html(erro + msgErro);	
			return false;			
		}
	});
}

function diasDasEscalas() {
	// Pegar as informações sobre escalas da pessoa:	
	var maiorEscalaFolgas = 0;
	var maiorEscalaDTrab = 0;	
	var dTrab = [];
	$('.escalasContent').each(function() {		
		var campo = $(this).find('.diasTrab');	
		var auxTrabalhados  = parseInt(campo.val());		
		if (auxTrabalhados > maiorEscalaDTrab) {
			maiorEscalaDTrab = auxTrabalhados;
			var aux = campo.attr('id').replace('diasTrab_', ''); 						
			maiorEscalaFolgas = parseInt($(this).find('#diasFolg_'+ aux).val());
		}
		var campoFolgas = $(this).find('.diasFolg'),
			foo = {};
		
		foo["id"] = campo.attr('id').replace("diasTrab_", "");
		foo["dias"] = auxTrabalhados;
			dTrab.push(foo);			
	});
	
	dTrab.sort(sortJsonProperty("dias"));
	$.each(dTrab, function(key, val) {
		diasTrabalhados.push(val.dias);
		diasFolgas.push(parseInt($('#diasFolg_'+val.id).val()));
	});	
	
	$('span.qtDiasMaiorEscala').text(maiorEscalaDTrab);
	$('span.qtFolgasMaiorEscala').text(maiorEscalaFolgas);	
	$('.selecionarData').slideDown(500, function() {
		var inputDataPosicao = Math.round($('input.ui-input-text').position().top);			
		window.scrollTo(0, inputDataPosicao);
	});		
}

function pegarValoresInseridos() {
	var splittedData = $('#mydate').val();
	var messageBox = $('.message');
	if ($.trim(splittedData) == '') {
		messageBox.hide().html('<p>Por favor, selecione uma data.</p>');	
		return false;
	}
	else {
		splittedData = splittedData.split('/');
		messageBox.hide().html('');
		return {
			dia: splittedData[0],
			mes: (splittedData[1] - 1),
			ano: splittedData[2]
		}
	}
}

function calcularValoresDasFolgas() {
	var diasdeFolga = [];			
		$.each(diasTrabalhados, function(key, val) {
			if (key == 0) {				
				for (var i = 1; i <= diasFolgas[key]; i++) {						
					diasdeFolga.push(val += 1);				
				}
			}
			else {
				var ultimoDiaInserido = diasdeFolga[diasdeFolga.length - 1];				
				var ultimoDiaTrabalho = ultimoDiaInserido + val;
				for (var k = 1; k <= diasFolgas[key]; k++) {					
					ultimoDiaTrabalho += 1;
					diasdeFolga.push(ultimoDiaTrabalho);
				}
			}										
		});		
	return diasdeFolga;
}

function calcularFolgas(doAno) {
	var dados = pegarValoresInseridos();
	if (dados) {
		var dataSelecionada = new Date(dados.ano, dados.mes, dados.dia);
		
		var pontoParada = (doAno) ? parseInt(dataSelecionada.getFullYear() + 1) : parseInt(dataSelecionada.getMonth() + 1);		
		var diasdeFolga = calcularValoresDasFolgas();		
		var ultimoDiaFolga = diasdeFolga[diasdeFolga.length - 1];
		var dia = 1;
		var html = '';
		html += '<h3>Minhas folgas: </h3><div class="folgas-content">';
    html += '<strong class="filtro">Filtrar por: </strong> <a href="javascript: void(0)" onclick="filtrar(\'t\')">Todos</a> | ';
    html += '<a href="javascript: void(0)" onclick="filtrar(\'f\')"> Finais de semana</a> |';
    html += '<a href="javascript: void(0)" onclick="filtrar(\'d\')"> Dias de semana</a>';
		html += '<ul class="minhas-folgas">';
		switch (doAno) {
			case true:
				while(dataSelecionada.getFullYear() < pontoParada)
         {
          var class_wd = (fds[dataSelecionada.getDay()] != null && fds[dataSelecionada.getDay()] != "undefined") ? "fds" : "semana";
          if ($.inArray(dia, diasdeFolga) != -1) {				
						html += '<li class="' + class_wd + '"">'
						html += dias[dataSelecionada.getDay()] + ', ';
						html += dataSelecionada.getDate() + ' de ';
						html += meses[dataSelecionada.getMonth()] + ' de ' + dataSelecionada.getFullYear();
						html += '</li>';
					}
					dataSelecionada.setDate(dataSelecionada.getDate() + 1);
					dia += 1;
					if (dia > ultimoDiaFolga) {
						dia = 1;
					}
				}
			break;
			default:
				while(dataSelecionada.getMonth() < pontoParada) {
					if ($.inArray(dia, diasdeFolga) != -1) {				
						html += '<li>'
						html += dias[dataSelecionada.getDay()] + ', ';
						html += dataSelecionada.getDate() + ' de ';
						html += meses[dataSelecionada.getMonth()] + ' de ' + dataSelecionada.getFullYear();
						html += '</li>';
					}
					dataSelecionada.setDate(dataSelecionada.getDate() + 1);
					dia += 1;
					if (dia > ultimoDiaFolga) {
						dia = 1;
					}
				}
			break;
		}		
		html += '</ul></div>';
		var folgasElemento = $('#folgas');
		folgasElemento.html(html);
		var folgasPosicao = Math.round(folgasElemento.position().top);		
		window.scrollTo(0, folgasPosicao);
	}
}

function filtrar(filtro) {
  switch (filtro) {
    case 't':
    default: 
      $('ul.minhas-folgas li').show();
    break;
    case 'f':
      $('ul.minhas-folgas li.fds').show();
      $('ul.minhas-folgas li.semana').hide();
    break;
    case 'd':
      $('ul.minhas-folgas li.fds').hide();
      $('ul.minhas-folgas li.semana').show();
    break;
  }
}

function sortJsonProperty(prop){
   return function(a,b){  
      if( a[prop] < b[prop]){
          return 1;
      }
      return 0;
   }
}
