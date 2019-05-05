// imagens do menu
var menu_home_on;
var menu_home_off;
var menu_curriculo_on;
var menu_curriculo_off;
var menu_programacao_on;
var menu_programacao_off;
var menu_web_on;
var menu_web_off;
var menu_games_on;
var menu_games_off;
var menu_contato_on;
var menu_contato_off;

// inicializa os rollovers
function initRollovers()
{
	if (document.images) 
	{
		// inicializa as imagens
		menu_home_on = new Image();
		menu_home_on.src = "images/home_1.png";
		menu_home_off = new Image();
		menu_home_off.src = "images/home_0.png";
		menu_curriculo_on = new Image();
		menu_curriculo_on.src = "images/curriculo_1.png";
		menu_curriculo_off = new Image();
		menu_curriculo_off.src = "images/curriculo_0.png";
		menu_programacao_on = new Image();
		menu_programacao_on.src = "images/programacao_1.png";
		menu_programacao_off = new Image();
		menu_programacao_off.src = "images/programacao_0.png";
		menu_web_on = new Image();
		menu_web_on.src = "images/web_1.png";
		menu_web_off = new Image();
		menu_web_off.src = "images/web_0.png";
		menu_games_on = new Image();
		menu_games_on.src = "images/games_1.png";
		menu_games_off = new Image();
		menu_games_off.src = "images/games_0.png";
		menu_contato_on = new Image();
		menu_contato_on.src = "images/contato_1.png";
		menu_contato_off = new Image();
		menu_contato_off.src = "images/contato_0.png";
	
		// pega os elementos que tem rollover
		var elems = getElementsByStyleClass('rollover');
		
		for (var i = 0; i < elems.length; i++)
		{
			// define os eventos over e out
			elems[i].onmouseover = function() {
				document.getElementById(this.name + '_img').src = eval(this.name + '_on.src');
			}
			elems[i].onmouseout = function() {
				document.getElementById(this.name + '_img').src = eval(this.name + '_off.src');
			}
		}
	}
}

// pega elementos pela classe
function getElementsByStyleClass (className) 
{
  var all = document.all ? document.all :
    document.getElementsByTagName('*');
  var elements = new Array();
  for (var e = 0; e < all.length; e++)
    if (all[e].className == className)
      elements[elements.length] = all[e];
  return elements;
}

// ao carregar a página... 
window.onload = function()
{
	initRollovers();
}
